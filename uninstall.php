<?php
/**
 * Uninstall script for Deprem RSS
 *
 * @package DepremRSS
 */

// Exit if uninstall not called from WordPress
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('depremrss_options');

// Delete transients
delete_transient('depremrss_data');

// For multisite installations
if (is_multisite()) {
    global $wpdb;
    
    // Get all blog IDs safely
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
    
    if (is_array($blog_ids) && !empty($blog_ids)) {
        $original_blog_id = get_current_blog_id();
        
        foreach ($blog_ids as $blog_id) {
            // Validate blog ID
            if (!is_numeric($blog_id)) {
                continue;
            }
            
            switch_to_blog((int) $blog_id);
            
            // Delete options
            delete_option('depremrss_options');
            
            // Delete transients
            delete_transient('depremrss_data');
        }
        
        switch_to_blog($original_blog_id);
    }
}

// Note: We don't remove custom feed endpoints as WordPress will handle that
// when rewrite rules are flushed
