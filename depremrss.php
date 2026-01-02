<?php
/**
 * Plugin Name: Deprem RSS
 * Plugin URI: https://github.com/integrumart/depremrss
 * Description: WordPress için deprem verilerini RSS olarak sunan eklenti. Türkiye'deki depremleri takip edin ve sitenizde gösterin.
 * Version: 1.0.0
 * Author: IntegrumArt
 * Author URI: https://github.com/integrumart
 * License: GPL-3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: depremrss
 * Domain Path: /languages
 *
 * @package DepremRSS
 */

// Exit if accessed directly
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
    
    /**
     * Instance of this class
     */
    private static $instance = null;
    
    /**
     * Get instance of this class
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
     * Initialize WordPress hooks
     */
    private function init_hooks() {
        // Activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Custom RSS feed
        add_action('init', array($this, 'add_custom_feed'));
        
        // Shortcode
        add_shortcode('depremrss', array($this, 'depremrss_shortcode'));
        
        // Widget
        add_action('widgets_init', array($this, 'register_widget'));
        
        // Admin styles and scripts
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        
        // Frontend styles
        add_action('wp_enqueue_scripts', array($this, 'frontend_enqueue_scripts'));
        
        // Load text domain
        add_action('plugins_loaded', array($this, 'load_textdomain'));
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Set default options
        if (!get_option('depremrss_options')) {
            $default_options = array(
                'feed_url' => 'http://www.koeri.boun.edu.tr/scripts/lst0.asp',
                'cache_duration' => 300, // 5 minutes
                'display_limit' => 10,
                'min_magnitude' => 0.0
            );
            add_option('depremrss_options', $default_options);
        }
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Load text domain for translations
     */
    public function load_textdomain() {
        load_plugin_textdomain('depremrss', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Deprem RSS', 'depremrss'),
            __('Deprem RSS', 'depremrss'),
            'manage_options',
            'depremrss',
            array($this, 'admin_page'),
            'dashicons-warning',
            30
        );
    }
    
    /**
     * Admin page content
     */
    public function admin_page() {
        // Save settings if form submitted
        if (isset($_POST['depremrss_save_settings']) && check_admin_referer('depremrss_settings')) {
            $options = array(
                'feed_url' => sanitize_text_field($_POST['feed_url']),
                'cache_duration' => intval($_POST['cache_duration']),
                'display_limit' => intval($_POST['display_limit']),
                'min_magnitude' => floatval($_POST['min_magnitude'])
            );
            update_option('depremrss_options', $options);
            
            // Clear cache
            delete_transient('depremrss_data');
            
            echo '<div class="notice notice-success"><p>' . __('Ayarlar kaydedildi.', 'depremrss') . '</p></div>';
        }
        
        // Get current options
        $options = get_option('depremrss_options');
        
        include DEPREMRSS_PLUGIN_DIR . 'includes/admin-page.php';
    }
    
    /**
     * Add custom RSS feed
     */
    public function add_custom_feed() {
        add_feed('deprem', array($this, 'generate_rss_feed'));
    }
    
    /**
     * Generate RSS feed
     */
    public function generate_rss_feed() {
        header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
        
        $earthquakes = $this->get_earthquake_data();
        
        echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?>';
        ?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title><?php echo esc_html(get_bloginfo('name') . ' - ' . __('Deprem RSS', 'depremrss')); ?></title>
        <link><?php echo esc_url(home_url('/')); ?></link>
        <description><?php echo esc_html(__('Son depremler', 'depremrss')); ?></description>
        <language><?php echo esc_html(get_bloginfo('language')); ?></language>
        <lastBuildDate><?php echo esc_html(date('r')); ?></lastBuildDate>
        <atom:link href="<?php echo esc_url(home_url('/feed/deprem')); ?>" rel="self" type="application/rss+xml"/>
        
        <?php if (!empty($earthquakes) && is_array($earthquakes)) : ?>
            <?php foreach ($earthquakes as $eq) : ?>
        <item>
            <title><?php echo esc_html(sprintf(__('Deprem: %.1f Büyüklüğünde - %s', 'depremrss'), $eq['magnitude'], $eq['location'])); ?></title>
            <link><?php echo esc_url(home_url('/')); ?></link>
            <pubDate><?php echo esc_html(date('r', strtotime($eq['date'] . ' ' . $eq['time']))); ?></pubDate>
            <guid><?php echo esc_url(home_url('/') . '?eq=' . md5($eq['date'] . $eq['time'] . $eq['location'])); ?></guid>
            <description><![CDATA[
                <?php echo sprintf(
                    __('Büyüklük: %.1f<br>Derinlik: %s km<br>Bölge: %s<br>Tarih: %s<br>Saat: %s', 'depremrss'),
                    $eq['magnitude'],
                    $eq['depth'],
                    $eq['location'],
                    $eq['date'],
                    $eq['time']
                ); ?>
            ]]></description>
        </item>
            <?php endforeach; ?>
        <?php endif; ?>
    </channel>
</rss>
        <?php
        exit;
    }
    
    /**
     * Get earthquake data
     */
    public function get_earthquake_data() {
        // Check cache first
        $cached_data = get_transient('depremrss_data');
        if (false !== $cached_data) {
            return $cached_data;
        }
        
        $options = get_option('depremrss_options');
        $earthquakes = array();
        
        // Sample earthquake data (in production, this would fetch from KOERI or another source)
        // For now, we'll return sample data structure
        $sample_data = array(
            array(
                'date' => date('Y.m.d'),
                'time' => date('H:i:s'),
                'latitude' => '38.4567',
                'longitude' => '27.1234',
                'depth' => '7.5',
                'magnitude' => '4.2',
                'location' => 'İZMİR KARABURUN AÇIKLARI',
                'quality' => 'İlksel'
            ),
            array(
                'date' => date('Y.m.d', strtotime('-1 hour')),
                'time' => date('H:i:s', strtotime('-1 hour')),
                'latitude' => '37.8765',
                'longitude' => '27.9876',
                'depth' => '12.3',
                'magnitude' => '3.8',
                'location' => 'EGE DENİZİ',
                'quality' => 'İlksel'
            )
        );
        
        // Filter by minimum magnitude
        $min_magnitude = isset($options['min_magnitude']) ? $options['min_magnitude'] : 0.0;
        foreach ($sample_data as $eq) {
            if (floatval($eq['magnitude']) >= $min_magnitude) {
                $earthquakes[] = $eq;
            }
        }
        
        // Limit results
        $limit = isset($options['display_limit']) ? intval($options['display_limit']) : 10;
        $earthquakes = array_slice($earthquakes, 0, $limit);
        
        // Cache the data
        $cache_duration = isset($options['cache_duration']) ? intval($options['cache_duration']) : 300;
        set_transient('depremrss_data', $earthquakes, $cache_duration);
        
        return $earthquakes;
    }
    
    /**
     * Shortcode handler
     */
    public function depremrss_shortcode($atts) {
        $atts = shortcode_atts(array(
            'limit' => 10,
            'min_magnitude' => 0.0
        ), $atts);
        
        $earthquakes = $this->get_earthquake_data();
        
        // Filter and limit
        $filtered = array();
        foreach ($earthquakes as $eq) {
            if (floatval($eq['magnitude']) >= floatval($atts['min_magnitude'])) {
                $filtered[] = $eq;
            }
        }
        $earthquakes = array_slice($filtered, 0, intval($atts['limit']));
        
        ob_start();
        include DEPREMRSS_PLUGIN_DIR . 'includes/shortcode-template.php';
        return ob_get_clean();
    }
    
    /**
     * Register widget
     */
    public function register_widget() {
        require_once DEPREMRSS_PLUGIN_DIR . 'includes/class-depremrss-widget.php';
        register_widget('DepremRSS_Widget');
    }
    
    /**
     * Enqueue admin scripts and styles
     */
    public function admin_enqueue_scripts($hook) {
        if ('toplevel_page_depremrss' !== $hook) {
            return;
        }
        
        wp_enqueue_style('depremrss-admin', DEPREMRSS_PLUGIN_URL . 'assets/css/admin.css', array(), DEPREMRSS_VERSION);
    }
    
    /**
     * Enqueue frontend scripts and styles
     */
    public function frontend_enqueue_scripts() {
        wp_enqueue_style('depremrss-frontend', DEPREMRSS_PLUGIN_URL . 'assets/css/frontend.css', array(), DEPREMRSS_VERSION);
    }
}

// Initialize the plugin
function depremrss_init() {
    return DepremRSS::get_instance();
}

// Start the plugin
depremrss_init();
