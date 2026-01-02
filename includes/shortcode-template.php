<?php
/**
 * Shortcode template for displaying earthquakes
 *
 * @package DepremRSS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="depremrss-earthquakes">
    <?php if (!empty($earthquakes)) : ?>
        <table class="depremrss-table">
            <thead>
                <tr>
                    <th><?php _e('Tarih/Saat', 'depremrss'); ?></th>
                    <th><?php _e('Büyüklük', 'depremrss'); ?></th>
                    <th><?php _e('Derinlik', 'depremrss'); ?></th>
                    <th><?php _e('Bölge', 'depremrss'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($earthquakes as $eq) : ?>
                <tr class="depremrss-magnitude-<?php echo esc_attr(floor($eq['magnitude'])); ?>">
                    <td class="depremrss-datetime">
                        <?php echo esc_html($eq['date']); ?><br>
                        <small><?php echo esc_html($eq['time']); ?></small>
                    </td>
                    <td class="depremrss-magnitude">
                        <strong><?php echo esc_html(sprintf('%.1f', $eq['magnitude'])); ?></strong>
                    </td>
                    <td class="depremrss-depth">
                        <?php echo esc_html($eq['depth']); ?> km
                    </td>
                    <td class="depremrss-location">
                        <?php echo esc_html($eq['location']); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="depremrss-no-data"><?php _e('Henüz deprem verisi bulunmuyor.', 'depremrss'); ?></p>
    <?php endif; ?>
</div>
