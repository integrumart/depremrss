<?php
/**
 * Admin page template
 *
 * @package DepremRSS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap depremrss-admin">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="depremrss-content">
        <div class="depremrss-main">
            <form method="post" action="">
                <?php wp_nonce_field('depremrss_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="feed_url"><?php _e('Deprem Veri Kaynağı URL', 'depremrss'); ?></label>
                        </th>
                        <td>
                            <input type="url" id="feed_url" name="feed_url" value="<?php echo esc_attr($options['feed_url']); ?>" class="regular-text">
                            <p class="description"><?php _e('Deprem verilerinin alınacağı kaynak URL (KOERI varsayılan)', 'depremrss'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="cache_duration"><?php _e('Önbellek Süresi (saniye)', 'depremrss'); ?></label>
                        </th>
                        <td>
                            <input type="number" id="cache_duration" name="cache_duration" value="<?php echo esc_attr($options['cache_duration']); ?>" min="60" step="60">
                            <p class="description"><?php _e('Deprem verilerinin önbellekte tutulma süresi (saniye)', 'depremrss'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="display_limit"><?php _e('Gösterilecek Deprem Sayısı', 'depremrss'); ?></label>
                        </th>
                        <td>
                            <input type="number" id="display_limit" name="display_limit" value="<?php echo esc_attr($options['display_limit']); ?>" min="1" max="100">
                            <p class="description"><?php _e('Gösterilecek maksimum deprem sayısı', 'depremrss'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="min_magnitude"><?php _e('Minimum Büyüklük', 'depremrss'); ?></label>
                        </th>
                        <td>
                            <input type="number" id="min_magnitude" name="min_magnitude" value="<?php echo esc_attr($options['min_magnitude']); ?>" min="0" max="10" step="0.1">
                            <p class="description"><?php _e('Gösterilecek minimum deprem büyüklüğü', 'depremrss'); ?></p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(__('Ayarları Kaydet', 'depremrss'), 'primary', 'depremrss_save_settings'); ?>
            </form>
            
            <hr>
            
            <h2><?php _e('Kullanım', 'depremrss'); ?></h2>
            
            <h3><?php _e('RSS Feed URL', 'depremrss'); ?></h3>
            <p>
                <code id="depremrss-feed-url"><?php echo esc_url(home_url('/feed/deprem')); ?></code>
                <button type="button" class="button" id="depremrss-copy-feed-url">
                    <?php _e('Kopyala', 'depremrss'); ?>
                </button>
            </p>
            
            <h3><?php _e('Shortcode Kullanımı', 'depremrss'); ?></h3>
            <p><?php _e('Sayfa veya yazılarınızda deprem listesi göstermek için:', 'depremrss'); ?></p>
            <p><code>[depremrss]</code></p>
            <p><?php _e('Parametrelerle kullanım:', 'depremrss'); ?></p>
            <p><code>[depremrss limit="5" min_magnitude="4.0"]</code></p>
            
            <h3><?php _e('Widget', 'depremrss'); ?></h3>
            <p><?php _e('Görünüm > Widget\'lar menüsünden "Deprem RSS Widget" ekleyebilirsiniz.', 'depremrss'); ?></p>
        </div>
        
        <div class="depremrss-sidebar">
            <div class="depremrss-box">
                <h3><?php _e('Son Depremler', 'depremrss'); ?></h3>
                <?php
                $earthquakes = DepremRSS::get_instance()->get_earthquake_data();
                if (!empty($earthquakes)) {
                    echo '<ul class="depremrss-list">';
                    foreach (array_slice($earthquakes, 0, 5) as $eq) {
                        echo '<li>';
                        echo '<strong>' . esc_html(sprintf('%.1f', $eq['magnitude'])) . '</strong> - ';
                        echo esc_html($eq['location']) . '<br>';
                        echo '<small>' . esc_html($eq['date'] . ' ' . $eq['time']) . '</small>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>' . __('Deprem verisi bulunamadı.', 'depremrss') . '</p>';
                }
                ?>
            </div>
            
            <div class="depremrss-box">
                <h3><?php _e('Hakkında', 'depremrss'); ?></h3>
                <p><?php _e('Deprem RSS eklentisi, Türkiye\'deki son depremleri WordPress sitenizde göstermenizi sağlar.', 'depremrss'); ?></p>
                <p>
                    <strong><?php _e('Versiyon:', 'depremrss'); ?></strong> <?php echo DEPREMRSS_VERSION; ?><br>
                    <strong><?php _e('Geliştirici:', 'depremrss'); ?></strong> IntegrumArt
                </p>
            </div>
        </div>
    </div>
</div>
