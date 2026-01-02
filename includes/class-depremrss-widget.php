<?php
/**
 * Widget class for DepremRSS
 *
 * @package DepremRSS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * DepremRSS Widget Class
 */
class DepremRSS_Widget extends WP_Widget {
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'depremrss_widget',
            __('Deprem RSS Widget', 'depremrss'),
            array(
                'description' => __('Son depremleri gösterir', 'depremrss'),
                'classname' => 'depremrss-widget'
            )
        );
    }
    
    /**
     * Widget display
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('Son Depremler', 'depremrss');
        $limit = !empty($instance['limit']) ? intval($instance['limit']) : 5;
        $min_magnitude = !empty($instance['min_magnitude']) ? floatval($instance['min_magnitude']) : 0.0;
        
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
        
        $earthquakes = DepremRSS::get_instance()->get_earthquake_data();
        
        // Filter by magnitude
        $filtered = array();
        foreach ($earthquakes as $eq) {
            if (floatval($eq['magnitude']) >= $min_magnitude) {
                $filtered[] = $eq;
            }
        }
        
        // Limit results
        $earthquakes = array_slice($filtered, 0, $limit);
        
        if (!empty($earthquakes)) {
            echo '<ul class="depremrss-widget-list">';
            foreach ($earthquakes as $eq) {
                echo '<li class="depremrss-widget-item">';
                echo '<div class="depremrss-widget-magnitude">' . esc_html(sprintf('%.1f', $eq['magnitude'])) . '</div>';
                echo '<div class="depremrss-widget-details">';
                echo '<strong>' . esc_html($eq['location']) . '</strong><br>';
                echo '<small>' . esc_html($eq['date'] . ' ' . $eq['time']) . '</small><br>';
                echo '<small>' . esc_html(sprintf(__('Derinlik: %s km', 'depremrss'), $eq['depth'])) . '</small>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('Deprem verisi bulunamadı.', 'depremrss') . '</p>';
        }
        
        echo $args['after_widget'];
    }
    
    /**
     * Widget form
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Son Depremler', 'depremrss');
        $limit = !empty($instance['limit']) ? intval($instance['limit']) : 5;
        $min_magnitude = !empty($instance['min_magnitude']) ? floatval($instance['min_magnitude']) : 0.0;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('Başlık:', 'depremrss'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>">
                <?php _e('Gösterilecek Sayı:', 'depremrss'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('limit')); ?>" 
                   type="number" 
                   min="1" 
                   max="20" 
                   value="<?php echo esc_attr($limit); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('min_magnitude')); ?>">
                <?php _e('Minimum Büyüklük:', 'depremrss'); ?>
            </label>
            <input class="small-text" id="<?php echo esc_attr($this->get_field_id('min_magnitude')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('min_magnitude')); ?>" 
                   type="number" 
                   min="0" 
                   max="10" 
                   step="0.1" 
                   value="<?php echo esc_attr($min_magnitude); ?>">
        </p>
        <?php
    }
    
    /**
     * Widget update
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['limit'] = !empty($new_instance['limit']) ? intval($new_instance['limit']) : 5;
        $instance['min_magnitude'] = !empty($new_instance['min_magnitude']) ? floatval($new_instance['min_magnitude']) : 0.0;
        
        return $instance;
    }
}
