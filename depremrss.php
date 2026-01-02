<?php
/**
 * Plugin Name: Deprem RSS
 * Plugin URI: https://github.com/integrumart/depremrss
 * Description: Depremleri WordPress ile takip edin - RSS beslemesi üzerinden deprem verilerini görüntüleyin
 * Version: 1.0.0
 * Author: Integrum Art
 * Author URI: https://github.com/integrumart
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: depremrss
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('DEPREMRSS_VERSION', '1.0.0');
define('DEPREMRSS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DEPREMRSS_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Main DepremRSS Class
 */
class DepremRSS {
    
    private static $instance = null;
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        register_uninstall_hook(__FILE__, array('DepremRSS', 'uninstall'));
        
        // Admin hooks
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        
        // Frontend hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
        add_shortcode('deprem_listesi', array($this, 'shortcode_deprem_listesi'));
        
        // Widget
        add_action('widgets_init', array($this, 'register_widget'));
        
        // AJAX hooks
        add_action('wp_ajax_depremrss_refresh', array($this, 'ajax_refresh_feed'));
        add_action('wp_ajax_nopriv_depremrss_refresh', array($this, 'ajax_refresh_feed'));
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Set default options
        $default_options = array(
            'rss_url' => 'http://www.koeri.boun.edu.tr/scripts/lst0.asp',
            'cache_duration' => 300, // 5 minutes
            'display_count' => 10,
            'min_magnitude' => 0,
            'auto_refresh' => false,
            'refresh_interval' => 60
        );
        
        add_option('depremrss_settings', $default_options);
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Clean up transients
        delete_transient('depremrss_feed_data');
    }
    
    /**
     * Plugin uninstall
     */
    public static function uninstall() {
        // Remove options
        delete_option('depremrss_settings');
        
        // Clean up transients
        delete_transient('depremrss_feed_data');
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            'Deprem RSS Ayarları',
            'Deprem RSS',
            'manage_options',
            'depremrss',
            array($this, 'render_admin_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('depremrss_settings_group', 'depremrss_settings', array($this, 'sanitize_settings'));
    }
    
    /**
     * Sanitize settings
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        $sanitized['rss_url'] = isset($input['rss_url']) ? esc_url_raw($input['rss_url']) : '';
        $sanitized['cache_duration'] = isset($input['cache_duration']) ? absint($input['cache_duration']) : 300;
        $sanitized['display_count'] = isset($input['display_count']) ? absint($input['display_count']) : 10;
        $sanitized['min_magnitude'] = isset($input['min_magnitude']) ? floatval($input['min_magnitude']) : 0;
        $sanitized['auto_refresh'] = isset($input['auto_refresh']) ? (bool)$input['auto_refresh'] : false;
        $sanitized['refresh_interval'] = isset($input['refresh_interval']) ? absint($input['refresh_interval']) : 60;
        
        return $sanitized;
    }
    
    /**
     * Render admin page
     */
    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        $settings = get_option('depremrss_settings');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <form method="post" action="options.php">
                <?php
                settings_fields('depremrss_settings_group');
                do_settings_sections('depremrss_settings_group');
                ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="rss_url">RSS Feed URL'si</label>
                        </th>
                        <td>
                            <input type="url" 
                                   id="rss_url" 
                                   name="depremrss_settings[rss_url]" 
                                   value="<?php echo esc_attr($settings['rss_url']); ?>" 
                                   class="regular-text" />
                            <p class="description">Deprem verilerinin çekileceği RSS feed URL'si</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="cache_duration">Önbellek Süresi (saniye)</label>
                        </th>
                        <td>
                            <input type="number" 
                                   id="cache_duration" 
                                   name="depremrss_settings[cache_duration]" 
                                   value="<?php echo esc_attr($settings['cache_duration']); ?>" 
                                   min="60" 
                                   step="1" />
                            <p class="description">RSS feed'in ne kadar süre önbellekte tutulacağı (saniye)</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="display_count">Gösterilecek Deprem Sayısı</label>
                        </th>
                        <td>
                            <input type="number" 
                                   id="display_count" 
                                   name="depremrss_settings[display_count]" 
                                   value="<?php echo esc_attr($settings['display_count']); ?>" 
                                   min="1" 
                                   max="100" 
                                   step="1" />
                            <p class="description">Görüntülenecek maksimum deprem sayısı</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="min_magnitude">Minimum Büyüklük</label>
                        </th>
                        <td>
                            <input type="number" 
                                   id="min_magnitude" 
                                   name="depremrss_settings[min_magnitude]" 
                                   value="<?php echo esc_attr($settings['min_magnitude']); ?>" 
                                   min="0" 
                                   max="10" 
                                   step="0.1" />
                            <p class="description">Gösterilecek minimum deprem büyüklüğü</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="auto_refresh">Otomatik Yenileme</label>
                        </th>
                        <td>
                            <input type="checkbox" 
                                   id="auto_refresh" 
                                   name="depremrss_settings[auto_refresh]" 
                                   value="1" 
                                   <?php checked($settings['auto_refresh'], true); ?> />
                            <label for="auto_refresh">Otomatik olarak yenile</label>
                            <p class="description">Sayfa yenilenmeden deprem listesini otomatik güncelle</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="refresh_interval">Yenileme Aralığı (saniye)</label>
                        </th>
                        <td>
                            <input type="number" 
                                   id="refresh_interval" 
                                   name="depremrss_settings[refresh_interval]" 
                                   value="<?php echo esc_attr($settings['refresh_interval']); ?>" 
                                   min="30" 
                                   step="1" />
                            <p class="description">Otomatik yenileme aralığı (saniye)</p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button('Ayarları Kaydet'); ?>
            </form>
            
            <hr>
            
            <h2>Kullanım</h2>
            <p>Deprem listesini göstermek için şu shortcode'u kullanın:</p>
            <code>[deprem_listesi]</code>
            
            <p>Veya parametrelerle özelleştirin:</p>
            <code>[deprem_listesi count="5" min_magnitude="3.0"]</code>
            
            <p>Widget'ı yan menüden ekleyebilirsiniz: Görünüm → Widget'lar → Deprem RSS Widget</p>
        </div>
        <?php
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ('settings_page_depremrss' !== $hook) {
            return;
        }
        
        wp_enqueue_style(
            'depremrss-admin',
            DEPREMRSS_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            DEPREMRSS_VERSION
        );
    }
    
    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_style(
            'depremrss-frontend',
            DEPREMRSS_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            DEPREMRSS_VERSION
        );
        
        $settings = get_option('depremrss_settings');
        if (isset($settings['auto_refresh']) && $settings['auto_refresh']) {
            wp_enqueue_script(
                'depremrss-frontend',
                DEPREMRSS_PLUGIN_URL . 'assets/js/frontend.js',
                array('jquery'),
                DEPREMRSS_VERSION,
                true
            );
            
            wp_localize_script('depremrss-frontend', 'depremrssAjax', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('depremrss_nonce'),
                'refresh_interval' => $settings['refresh_interval'] * 1000
            ));
        }
    }
    
    /**
     * Fetch RSS feed data
     */
    public function fetch_feed_data() {
        $settings = get_option('depremrss_settings');
        $cache_key = 'depremrss_feed_data';
        
        // Check cache
        $cached_data = get_transient($cache_key);
        if (false !== $cached_data) {
            return $cached_data;
        }
        
        // Fetch RSS feed
        $rss_url = isset($settings['rss_url']) ? $settings['rss_url'] : '';
        
        if (empty($rss_url)) {
            return array();
        }
        
        $feed = fetch_feed($rss_url);
        
        if (is_wp_error($feed)) {
            return array();
        }
        
        $maxitems = $feed->get_item_quantity(100);
        $items = $feed->get_items(0, $maxitems);
        
        $earthquakes = array();
        
        if (!empty($items)) {
            foreach ($items as $item) {
                $title = $item->get_title();
                $description = $item->get_description();
                $date = $item->get_date('Y-m-d H:i:s');
                $link = $item->get_permalink();
                
                // Parse earthquake data from title/description
                $earthquake = $this->parse_earthquake_data($title, $description);
                $earthquake['date'] = $date;
                $earthquake['link'] = $link;
                
                $earthquakes[] = $earthquake;
            }
        }
        
        // Cache the data
        $cache_duration = isset($settings['cache_duration']) ? $settings['cache_duration'] : 300;
        set_transient($cache_key, $earthquakes, $cache_duration);
        
        return $earthquakes;
    }
    
    /**
     * Parse earthquake data
     */
    private function parse_earthquake_data($title, $description) {
        $data = array(
            'magnitude' => 0,
            'location' => '',
            'depth' => 0,
            'title' => $title,
            'description' => $description
        );
        
        // Try to extract magnitude (e.g., "M 4.5" or "ML 3.2")
        if (preg_match('/M[LW]?\s*(\d+(?:\.\d+)?)/', $title . ' ' . $description, $matches)) {
            $data['magnitude'] = floatval($matches[1]);
        }
        
        // Try to extract depth (e.g., "10 km" or "15km")
        if (preg_match('/(\d+(?:\.\d+)?)\s*km/i', $title . ' ' . $description, $matches)) {
            $data['depth'] = floatval($matches[1]);
        }
        
        // Location is usually the title or part of it
        $data['location'] = $title;
        
        return $data;
    }
    
    /**
     * Shortcode handler
     */
    public function shortcode_deprem_listesi($atts) {
        $atts = shortcode_atts(array(
            'count' => null,
            'min_magnitude' => null
        ), $atts, 'deprem_listesi');
        
        $settings = get_option('depremrss_settings');
        
        $count = !is_null($atts['count']) ? absint($atts['count']) : $settings['display_count'];
        $min_magnitude = !is_null($atts['min_magnitude']) ? floatval($atts['min_magnitude']) : $settings['min_magnitude'];
        
        $earthquakes = $this->fetch_feed_data();
        
        // Filter by magnitude
        $earthquakes = array_filter($earthquakes, function($eq) use ($min_magnitude) {
            return $eq['magnitude'] >= $min_magnitude;
        });
        
        // Limit count
        $earthquakes = array_slice($earthquakes, 0, $count);
        
        return $this->render_earthquake_list($earthquakes);
    }
    
    /**
     * Render earthquake list
     */
    private function render_earthquake_list($earthquakes) {
        if (empty($earthquakes)) {
            return '<div class="depremrss-no-data">Henüz deprem verisi bulunmuyor.</div>';
        }
        
        ob_start();
        ?>
        <div class="depremrss-container">
            <div class="depremrss-header">
                <h3>Son Depremler</h3>
                <button class="depremrss-refresh-btn" data-action="refresh">
                    <span class="dashicons dashicons-update"></span> Yenile
                </button>
            </div>
            <ul class="depremrss-list">
                <?php foreach ($earthquakes as $earthquake): ?>
                    <li class="depremrss-item magnitude-<?php echo esc_attr($this->get_magnitude_class($earthquake['magnitude'])); ?>">
                        <div class="depremrss-magnitude">
                            <span class="magnitude-value"><?php echo esc_html(number_format($earthquake['magnitude'], 1)); ?></span>
                            <span class="magnitude-label">ML</span>
                        </div>
                        <div class="depremrss-details">
                            <div class="depremrss-location"><?php echo esc_html($earthquake['location']); ?></div>
                            <div class="depremrss-meta">
                                <span class="depremrss-depth">Derinlik: <?php echo esc_html($earthquake['depth']); ?> km</span>
                                <span class="depremrss-date"><?php echo esc_html($earthquake['date']); ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Get magnitude class for styling
     */
    private function get_magnitude_class($magnitude) {
        if ($magnitude >= 6.0) {
            return 'major';
        } elseif ($magnitude >= 5.0) {
            return 'strong';
        } elseif ($magnitude >= 4.0) {
            return 'moderate';
        } elseif ($magnitude >= 3.0) {
            return 'light';
        } else {
            return 'minor';
        }
    }
    
    /**
     * AJAX refresh handler
     */
    public function ajax_refresh_feed() {
        check_ajax_referer('depremrss_nonce', 'nonce');
        
        // Clear cache
        delete_transient('depremrss_feed_data');
        
        // Fetch fresh data
        $earthquakes = $this->fetch_feed_data();
        
        $settings = get_option('depremrss_settings');
        $count = $settings['display_count'];
        $min_magnitude = $settings['min_magnitude'];
        
        // Filter by magnitude
        $earthquakes = array_filter($earthquakes, function($eq) use ($min_magnitude) {
            return $eq['magnitude'] >= $min_magnitude;
        });
        
        // Limit count
        $earthquakes = array_slice($earthquakes, 0, $count);
        
        wp_send_json_success(array(
            'html' => $this->render_earthquake_list($earthquakes)
        ));
    }
    
    /**
     * Register widget
     */
    public function register_widget() {
        register_widget('DepremRSS_Widget');
    }
}

/**
 * Widget Class
 */
class DepremRSS_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'depremrss_widget',
            'Deprem RSS Widget',
            array('description' => 'Son depremleri görüntüler')
        );
    }
    
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $count = !empty($instance['count']) ? absint($instance['count']) : 5;
        $min_magnitude = !empty($instance['min_magnitude']) ? floatval($instance['min_magnitude']) : 0;
        
        echo do_shortcode("[deprem_listesi count='{$count}' min_magnitude='{$min_magnitude}']");
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Son Depremler';
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        $min_magnitude = !empty($instance['min_magnitude']) ? $instance['min_magnitude'] : 0;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Başlık:</label>
            <input class="widefat" 
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Gösterilecek Sayı:</label>
            <input class="widefat" 
                   id="<?php echo esc_attr($this->get_field_id('count')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('count')); ?>" 
                   type="number" 
                   value="<?php echo esc_attr($count); ?>" 
                   min="1" 
                   max="50">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('min_magnitude')); ?>">Minimum Büyüklük:</label>
            <input class="widefat" 
                   id="<?php echo esc_attr($this->get_field_id('min_magnitude')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('min_magnitude')); ?>" 
                   type="number" 
                   value="<?php echo esc_attr($min_magnitude); ?>" 
                   min="0" 
                   max="10" 
                   step="0.1">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 5;
        $instance['min_magnitude'] = (!empty($new_instance['min_magnitude'])) ? floatval($new_instance['min_magnitude']) : 0;
        return $instance;
    }
}

// Initialize plugin
function depremrss_init() {
    DepremRSS::get_instance();
}
add_action('plugins_loaded', 'depremrss_init');
