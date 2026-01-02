/**
 * Deprem RSS - Frontend JavaScript
 */
(function($) {
    'use strict';
    
    var DepremRSSFrontend = {
        
        init: function() {
            this.bindEvents();
            this.startAutoRefresh();
        },
        
        bindEvents: function() {
            $(document).on('click', '.depremrss-refresh-btn', this.handleRefreshClick.bind(this));
        },
        
        handleRefreshClick: function(e) {
            e.preventDefault();
            this.refreshData();
        },
        
        refreshData: function() {
            var $container = $('.depremrss-container');
            var $btn = $('.depremrss-refresh-btn');
            
            // Add loading state
            $container.addClass('depremrss-loading');
            $btn.addClass('loading').prop('disabled', true);
            
            $.ajax({
                url: depremrssAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'depremrss_refresh',
                    nonce: depremrssAjax.nonce
                },
                success: function(response) {
                    if (response.success && response.data.html) {
                        // Replace the container content
                        var $newContent = $(response.data.html);
                        $container.replaceWith($newContent);
                        
                        // Show success message
                        DepremRSSFrontend.showNotification('Deprem listesi güncellendi.', 'success');
                    }
                },
                error: function() {
                    DepremRSSFrontend.showNotification('Güncelleme sırasında bir hata oluştu.', 'error');
                },
                complete: function() {
                    // Remove loading state
                    $container.removeClass('depremrss-loading');
                    $btn.removeClass('loading').prop('disabled', false);
                }
            });
        },
        
        startAutoRefresh: function() {
            if (typeof depremrssAjax === 'undefined' || !depremrssAjax.refresh_interval) {
                return;
            }
            
            setInterval(function() {
                DepremRSSFrontend.refreshData();
            }, depremrssAjax.refresh_interval);
        },
        
        showNotification: function(message, type) {
            var $notification = $('<div class="depremrss-notification depremrss-notification-' + type + '">' + message + '</div>');
            
            $('body').append($notification);
            
            setTimeout(function() {
                $notification.addClass('show');
            }, 100);
            
            setTimeout(function() {
                $notification.removeClass('show');
                setTimeout(function() {
                    $notification.remove();
                }, 300);
            }, 3000);
        }
    };
    
    // Initialize when document is ready
    $(document).ready(function() {
        DepremRSSFrontend.init();
    });
    
})(jQuery);
