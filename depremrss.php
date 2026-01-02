<?php
/**
 * Plugin Name: Deprem RSS
 * Plugin URI: https://github.com/integrumart/depremrss
 * Description: Kandilli Rasathanesi'nden deprem verilerini çekerek WordPress yazılarına ekler.
 * Version: 1.0.0
 * Author: DepremRSS
 * Text Domain: depremrss
 * License: GPL v2 or later
 */

// Güvenlik kontrolü
if (!defined('ABSPATH')) {
    exit;
}

class DepremRSS {
    
    private $rss_url = 'http://koeri.boun.edu.tr/rss/';
    private $option_name = 'depremrss_last_check';
    
    public function __construct() {
        // Aktivasyon ve deaktivasyon hook'ları
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Admin menü
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // WP-Cron ile otomatik güncelleme
        add_action('depremrss_fetch_earthquakes', array($this, 'fetch_and_create_posts'));
        
        // Admin AJAX için
        add_action('wp_ajax_depremrss_manual_fetch', array($this, 'manual_fetch_earthquakes'));
    }
    
    /**
     * Plugin aktivasyonu
     */
    public function activate() {
        // WP-Cron schedule oluştur (her 5 dakikada bir)
        if (!wp_next_scheduled('depremrss_fetch_earthquakes')) {
            wp_schedule_event(time(), 'hourly', 'depremrss_fetch_earthquakes');
        }
        
        // İlk çalıştırmada son kontrol zamanını ayarla
        if (!get_option($this->option_name)) {
            update_option($this->option_name, time());
        }
    }
    
    /**
     * Plugin deaktivasyonu
     */
    public function deactivate() {
        // WP-Cron schedule'ı temizle
        $timestamp = wp_next_scheduled('depremrss_fetch_earthquakes');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'depremrss_fetch_earthquakes');
        }
    }
    
    /**
     * Admin menü ekle
     */
    public function add_admin_menu() {
        add_menu_page(
            'Deprem RSS',
            'Deprem RSS',
            'manage_options',
            'depremrss',
            array($this, 'admin_page'),
            'dashicons-location-alt',
            30
        );
    }
    
    /**
     * Admin sayfası
     */
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Deprem RSS Ayarları</h1>
            
            <div class="card">
                <h2>Kandilli Rasathanesi Deprem Verileri</h2>
                <p>Bu eklenti Kandilli Rasathanesi'nden deprem verilerini otomatik olarak çeker ve WordPress yazılarına ekler.</p>
                <p><strong>RSS Kaynağı:</strong> <?php echo esc_url($this->rss_url); ?></p>
                <p><strong>Son Kontrol:</strong> <?php echo date('d.m.Y H:i:s', get_option($this->option_name, time())); ?></p>
                
                <p>
                    <button type="button" class="button button-primary" id="depremrss-fetch-now">
                        Şimdi Depremleri Getir
                    </button>
                    <span id="depremrss-status" style="margin-left: 10px;"></span>
                </p>
            </div>
            
            <div class="card">
                <h2>Otomatik Güncelleme</h2>
                <p>Eklenti, her saat başı otomatik olarak yeni depremleri kontrol eder ve ekler.</p>
                <p><strong>Sonraki Kontrol:</strong> 
                    <?php 
                    $next_scheduled = wp_next_scheduled('depremrss_fetch_earthquakes');
                    echo $next_scheduled ? date('d.m.Y H:i:s', $next_scheduled) : 'Zamanlanmamış';
                    ?>
                </p>
            </div>
        </div>
        
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#depremrss-fetch-now').on('click', function() {
                var button = $(this);
                var status = $('#depremrss-status');
                
                button.prop('disabled', true);
                status.html('<span style="color: #0073aa;">Depremler getiriliyor...</span>');
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'depremrss_manual_fetch'
                    },
                    success: function(response) {
                        if (response.success) {
                            status.html('<span style="color: #46b450;">✓ ' + response.data + '</span>');
                        } else {
                            status.html('<span style="color: #dc3232;">✗ Hata: ' + response.data + '</span>');
                        }
                        button.prop('disabled', false);
                    },
                    error: function() {
                        status.html('<span style="color: #dc3232;">✗ Bir hata oluştu.</span>');
                        button.prop('disabled', false);
                    }
                });
            });
        });
        </script>
        <?php
    }
    
    /**
     * Manuel deprem getirme (AJAX)
     */
    public function manual_fetch_earthquakes() {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Yetkiniz yok.');
        }
        
        $result = $this->fetch_and_create_posts();
        
        if ($result !== false) {
            wp_send_json_success($result . ' deprem yazısı eklendi.');
        } else {
            wp_send_json_error('RSS besleme alınamadı.');
        }
    }
    
    /**
     * RSS'den depremleri çek ve yazı oluştur
     */
    public function fetch_and_create_posts() {
        // RSS feed'i al
        $rss = $this->fetch_rss_feed();
        
        if (!$rss) {
            error_log('DepremRSS: RSS feed alınamadı.');
            return false;
        }
        
        // Depremleri parse et
        $earthquakes = $this->parse_rss_feed($rss);
        
        if (empty($earthquakes)) {
            error_log('DepremRSS: Deprem verisi bulunamadı.');
            return 0;
        }
        
        $added_count = 0;
        
        // Her deprem için yazı oluştur
        foreach ($earthquakes as $earthquake) {
            if ($this->create_earthquake_post($earthquake)) {
                $added_count++;
            }
        }
        
        // Son kontrol zamanını güncelle
        update_option($this->option_name, time());
        
        return $added_count;
    }
    
    /**
     * RSS feed'i indir
     */
    private function fetch_rss_feed() {
        $response = wp_remote_get($this->rss_url, array(
            'timeout' => 30,
            'user-agent' => 'DepremRSS WordPress Plugin/1.0'
        ));
        
        if (is_wp_error($response)) {
            error_log('DepremRSS HTTP Error: ' . $response->get_error_message());
            return false;
        }
        
        $body = wp_remote_retrieve_body($response);
        
        if (empty($body)) {
            return false;
        }
        
        return $body;
    }
    
    /**
     * RSS feed'i parse et
     */
    private function parse_rss_feed($rss_content) {
        $earthquakes = array();
        
        // SimpleXML ile parse et
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($rss_content);
        
        if ($xml === false) {
            error_log('DepremRSS: XML parse hatası.');
            return $earthquakes;
        }
        
        // RSS item'larını işle
        if (isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $title = (string)$item->title;
                $description = (string)$item->description;
                $link = (string)$item->link;
                $pub_date = (string)$item->pubDate;
                
                // Deprem bilgilerini çıkar
                $earthquake = $this->extract_earthquake_data($title, $description, $link, $pub_date);
                
                if ($earthquake) {
                    $earthquakes[] = $earthquake;
                }
            }
        }
        
        return $earthquakes;
    }
    
    /**
     * Deprem verilerini çıkar
     */
    private function extract_earthquake_data($title, $description, $link, $pub_date) {
        // Başlıktan temel bilgileri çıkar
        // Örnek format: "4.2 Ege Denizi (IZMIR) 2024.01.15 14:30:25"
        
        $earthquake = array(
            'title' => $title,
            'description' => $description,
            'link' => $link,
            'pub_date' => $pub_date,
            'magnitude' => '',
            'location' => '',
            'date' => '',
            'time' => '',
            'depth' => '',
            'latitude' => '',
            'longitude' => ''
        );
        
        // Büyüklük (magnitude) - başlıktaki ilk sayı
        if (preg_match('/^([0-9.]+)/', $title, $matches)) {
            $earthquake['magnitude'] = $matches[1];
        }
        
        // Açıklamadan daha detaylı bilgiler çıkarılabilir
        // Description formatı farklı olabilir, bu yüzden esnek parse yapalım
        if (!empty($description)) {
            // Derinlik bilgisi
            if (preg_match('/Derinlik[:\s]*([0-9.]+)\s*km/i', $description, $matches)) {
                $earthquake['depth'] = $matches[1];
            }
            
            // Enlem/Boylam
            if (preg_match('/Enlem[:\s]*([0-9.]+)/i', $description, $matches)) {
                $earthquake['latitude'] = $matches[1];
            }
            if (preg_match('/Boylam[:\s]*([0-9.]+)/i', $description, $matches)) {
                $earthquake['longitude'] = $matches[1];
            }
        }
        
        return $earthquake;
    }
    
    /**
     * Deprem yazısı oluştur
     */
    private function create_earthquake_post($earthquake) {
        // Aynı başlıkla yazı var mı kontrol et
        $existing_post = get_page_by_title($earthquake['title'], OBJECT, 'post');
        
        if ($existing_post) {
            return false; // Zaten var, ekleme
        }
        
        // Yazı içeriğini hazırla
        $content = $this->prepare_post_content($earthquake);
        
        // Yazıyı oluştur
        $post_data = array(
            'post_title'    => $earthquake['title'],
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_category' => array(),
            'post_type'     => 'post'
        );
        
        // Tarih varsa kullan
        if (!empty($earthquake['pub_date'])) {
            $post_date = strtotime($earthquake['pub_date']);
            if ($post_date) {
                $post_data['post_date'] = date('Y-m-d H:i:s', $post_date);
                $post_data['post_date_gmt'] = gmdate('Y-m-d H:i:s', $post_date);
            }
        }
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id && !is_wp_error($post_id)) {
            // Meta bilgileri ekle
            update_post_meta($post_id, 'depremrss_magnitude', $earthquake['magnitude']);
            update_post_meta($post_id, 'depremrss_depth', $earthquake['depth']);
            update_post_meta($post_id, 'depremrss_latitude', $earthquake['latitude']);
            update_post_meta($post_id, 'depremrss_longitude', $earthquake['longitude']);
            update_post_meta($post_id, 'depremrss_source', 'Kandilli Rasathanesi');
            
            // Kategori ekle (Deprem kategorisi yoksa oluştur)
            $category = get_term_by('name', 'Deprem', 'category');
            if (!$category) {
                $category_id = wp_create_category('Deprem');
            } else {
                $category_id = $category->term_id;
            }
            wp_set_post_categories($post_id, array($category_id));
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Yazı içeriğini hazırla
     */
    private function prepare_post_content($earthquake) {
        $content = '<div class="deprem-detay">';
        
        if (!empty($earthquake['magnitude'])) {
            $content .= '<p><strong>Büyüklük:</strong> ' . esc_html($earthquake['magnitude']) . '</p>';
        }
        
        if (!empty($earthquake['depth'])) {
            $content .= '<p><strong>Derinlik:</strong> ' . esc_html($earthquake['depth']) . ' km</p>';
        }
        
        if (!empty($earthquake['latitude']) && !empty($earthquake['longitude'])) {
            $content .= '<p><strong>Konum:</strong> ' . esc_html($earthquake['latitude']) . '°N, ' . esc_html($earthquake['longitude']) . '°E</p>';
        }
        
        if (!empty($earthquake['description'])) {
            $content .= '<div class="deprem-aciklama">' . wpautop($earthquake['description']) . '</div>';
        }
        
        $content .= '<p><small>Kaynak: <a href="' . esc_url($earthquake['link']) . '" target="_blank" rel="noopener">Kandilli Rasathanesi</a></small></p>';
        
        $content .= '</div>';
        
        return $content;
    }
}

// Plugin'i başlat
new DepremRSS();
