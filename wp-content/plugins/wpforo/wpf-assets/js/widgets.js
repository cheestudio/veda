jQuery(document).ready(function ($) {
    $(document).on("keydown", function (e) {
        if( e.which === 27 ) $('.wpf-notifications').slideUp(250, 'linear');
    });

    $(document).on('click', '.wpf-alerts', function () {
        if( $.active === 0 ){
            var notifications = $('.wpforo-subtop').find('.wpf-notifications');
            $('.wpf-notifications').not(notifications).slideUp(250, 'linear');
            if( notifications.is(':visible') ){
                notifications.slideUp(250, 'linear');
            }else{
                wpforo_load_notifications();
                notifications.slideDown(250, 'linear');
            }
        }
    });

    $(document).on('click', '.wpf-widget-alerts', function () {
        if( $.active === 0 ){
            var notifications = $('.wpf-widget-alerts').parents('.wpf-prof-wrap').find('.wpf-notifications');
            $('.wpf-notifications').not(notifications).slideUp(250, 'linear');
            if( notifications.is(':visible') ){
                notifications.slideUp(250, 'linear');
            }else{
                wpforo_load_notifications();
                notifications.slideDown(250, 'linear');
            }
        }
    });

    $(document).on('click', '.wpf-action.wpf-notification-action-clear-all', function(){
        var foro_n = $(this).data('foro_n');
        if( foro_n ){
            $('.wpf-notifications').slideUp(250, 'linear');
            $.ajax({
                type: 'POST',
                url: wpf_widget_ajax_obj.url,
                data:{
                    foro_n: foro_n,
                    action: 'wpforo_clear_all_notifications'
                }
            }).done(function(r){
                if(r){
                    $('.wpf-notifications .wpf-notification-actions').hide();
                    $('.wpf-notifications .wpf-notification-content').html(r);
                    wpforo_bell(0);
                }
            });
        }
    });

});

function wpforo_bell( wpf_alerts ){
    wpf_alerts = parseInt(wpf_alerts);
    if( wpf_alerts > 0 ){
        var wpforo_bell = '';
        var wpf_tooltip = '';
        if (jQuery.isFunction(window.wpforo_phrase)) {
            var wpforo_notification_phrase =  wpforo_phrase('You have a new notification');
            if( wpf_alerts > 1 ) wpforo_notification_phrase = wpforo_phrase('You have new notifications');
            wpf_tooltip = 'wpf-tooltip="' + wpforo_notification_phrase + '" wpf-tooltip-size="middle"';
        }
        wpforo_bell = '<div class="wpf-bell" ' + wpf_tooltip + '><i class="fas fa-bell"></i> <span class="wpf-alerts-count">' + wpf_alerts + '</span></div>';
        jQuery('.wpf-alerts').addClass('wpf-new');
        jQuery('.wpf-widget-alerts').addClass('wpf-new');
    } else {
        wpforo_bell = '<div class="wpf-bell"><i class="far fa-bell"></i></div>';
        jQuery('.wpf-alerts').removeClass('wpf-new');
        jQuery('.wpf-widget-alerts').removeClass('wpf-new');
    }
    jQuery('.wpf-alerts').html(wpforo_bell);
    jQuery('.wpf-widget-alerts').html(wpforo_bell);
}

var wpforo_check_notifications_timeout;
function wpforo_check_notifications( wpforo_check_interval ) {
    var getdata = jQuery('.wpf-notifications').is(':visible');
    jQuery.ajax({
        type: 'POST',
        url: wpf_widget_ajax_obj.url,
        data:{
            getdata: getdata,
            action: 'wpforo_notifications'
        },
        success: wpforo_notifications_ui_update,
        complete: function() {
            wpforo_check_notifications_timeout = setTimeout(wpforo_check_notifications, wpforo_check_interval, wpforo_check_interval);
        },
        error: function () {
            clearTimeout(wpforo_check_notifications_timeout);
        }
    });
}

function wpforo_load_notifications() {
    jQuery('.wpf-notifications .wpf-notification-content').html('<div class="wpf-nspin"><i class="fas fa-spinner fa-spin"></i></div>');
    jQuery.ajax({
        type: 'POST',
        url: wpf_widget_ajax_obj.url,
        data:{
            getdata: 1,
            action: 'wpforo_notifications'
        },
        success: wpforo_notifications_ui_update,
        error: function () {
            clearTimeout(wpforo_check_notifications_timeout);
        }
    });
}

function wpforo_notifications_ui_update(data){
    try{
        data = jQuery.parseJSON(data);
        if(typeof data === 'object' ){
            var wpf_alerts = parseInt(data.alerts);
            if( wpf_alerts > 0 ){
                jQuery('.wpf-notifications .wpf-notification-actions').show();
            } else {
                jQuery('.wpf-notifications .wpf-notification-actions').hide();
            }
            if( data.notifications ) jQuery('.wpf-notifications .wpf-notification-content').html( data.notifications );
            wpforo_bell( wpf_alerts );
        }
    }catch(e){
        console.log(e);
    }
}