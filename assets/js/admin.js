/**
 * Admin JavaScript for Deprem RSS
 *
 * @package DepremRSS
 */

(function() {
    'use strict';
    
    /**
     * Copy RSS feed URL to clipboard
     */
    function copyFeedURL() {
        var feedURL = depremrssAdmin.feedUrl;
        
        // Check if Clipboard API is available
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(feedURL)
                .then(function() {
                    alert(depremrssAdmin.copySuccess);
                })
                .catch(function() {
                    // Fallback if clipboard write fails
                    showCopyPrompt(feedURL);
                });
        } else {
            // Fallback for browsers without Clipboard API
            showCopyPrompt(feedURL);
        }
    }
    
    /**
     * Show prompt as fallback for clipboard copy
     */
    function showCopyPrompt(text) {
        prompt(depremrssAdmin.copyPrompt, text);
    }
    
    /**
     * Initialize event listeners
     */
    function init() {
        var copyButton = document.getElementById('depremrss-copy-feed-url');
        if (copyButton) {
            copyButton.addEventListener('click', copyFeedURL);
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
