<?php
/*
Template Name: graphics page
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
</head>
<style>
    body.wpf_graphics .wpfb-point {
        z-index: 99 !important;
    }
    .wpf_sidebar_header.wpf_col2, .wpf_sidebar_header.wpf_col3,a#wpf_comment_mode_general_task {
        display: none;
    }
    body.wpf_graphics .wpf_sidebar_container {
        height: calc(100vh - 75px);
    }
    body.wpf_graphics #wpf_launcher {
        top: 78px;
        z-index: 999 !important;
    }
    .wpf_sidebar_generaltask{display: none !important;}
    @media only screen and (max-width: 855px) {
        body.wpf_graphics #wpf_launcher {
            top: 102px;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 102px);
        }
    }
    @media only screen and (max-width: 650px) {
        body.wpf_graphics #wpf_launcher {
            top: 142px;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 142px);
        }
    }
    @media only screen and (max-width: 479px) {
        body.wpf_graphics #wpf_launcher {
            top: 122px;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 190px);
        }
    }
    <?php if(is_user_logged_in()){ ?>
    body.wpf_graphics .wpf_topbar {
        top: 32px;
    }
    body.wpf_graphics #wpf_launcher {
        top: 110px !important;
    }
    body.wpf_graphics .wpf_sidebar_container {
        height: calc(100vh - 107px) !important;
    }
    @media only screen and (max-width: 855px) {
        body.wpf_graphics #wpf_launcher {
            top: 135px !important;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 130px) !important;
        }
    }
    @media only screen and (max-width: 650px) {
        body.wpf_graphics #wpf_launcher {
            top: 175px !important;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 170px) !important;
        }
    }
    @media only screen and (max-width: 479px) {
        body.wpf_graphics #wpf_launcher {
            top: 155px !important;
        }
        body.wpf_graphics .wpf_sidebar_container {
            height: calc(100vh - 170px) !important;
        }
    }
    <?php } ?>
</style>
<body class="wpf_graphics">
<?php $wpf_graphics_color_name = get_option('wpf_graphics_color_name');
if($wpf_graphics_color_name == ''){
    $wpf_graphics_color_name = '#efefef';
}
global $current_user; //for this example only :)
$wpf_allow_guest = get_option('wpf_allow_guest');
if(is_user_logged_in()){
    $userid = $current_user->ID;
    $wpf_get_user_type = esc_attr(get_the_author_meta('wpf_user_type', $userid));
}else{
    $wpf_get_user_type = '';
}
?>
<div id="wpf_content" class="wpf_site-content">
    <div class="wpf-content-full wpf_container">
        <div class="wpf_topbar">
            <div class="wpf_topbar_left">
                <div class="wpf_graphics_logo">
                    <img alt="wpf_logo" src="<?php echo get_wpf_logo(); ?>" />
                </div>
                <div class="wpf_graphics_info">
                    <div class="wpf_graphics_title"><?php echo $post->post_title; ?></div>
                    <div class="wpf_graphics_description"><?php echo $post->post_excerpt; ?></div>
                </div>
            </div>
            <div class="wpf_topbar_right"><div class="wpf_topbar_icons"><a class="wpf_button_upload" href="javascript:wpf_upload_new_graphics()" title="upload design"><i class="fa fa-upload"></i></a><span id="graphics_color_picker"><a class="wpf_button_color" href="javascript:void(0)" title="Change color"><i class="fa fa-fill-drip"></i></a></span></div>
                <div class="wpf_graphics_version" id="wpf_graphics_version_content"><?php  echo wpf_grapgics_version_list($post->ID); ?></div>
                <div class="wpf_graphics_button" id="wpf_graphics_complete_content">
                    <?php $wpf_complete_graphics = get_post_meta($post->ID,'wpf_complete_graphics',true);
                    if( $wpf_get_user_type == 'advisor'){
                        if($wpf_complete_graphics != 'yes'){
                            ?>
                            <a class="wpf_button" id="wpf_graphics_complete" href="javascript:wpf_graphics_complete(<?php echo $post->ID; ?>);">Mark as complete</a>
                        <?php }
                        else{ ?>
                            <a class="wpf_button wpf_complete" id="wpf_graphics_complete" href="javascript:wpf_graphics_uncomplete(<?php echo $post->ID; ?>);">Completed</a>
                        <?php }
                    }else{
                        if($wpf_complete_graphics != 'yes'){ ?>
                            <a class="wpf_button" id="wpf_graphics_complete" href="javascript:void(0);">Mark as complete</a>
                        <?php } else{ ?>
                            <a class="wpf_button wpf_complete" id="wpf_graphics_complete" href="javascript:void(0);">Completed</a>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>

        <div class="wpf_body" style="background-color: <?php echo $wpf_graphics_color_name; ?>">
            <div class="wpf_graphics_loader wpf_hide"></div>
            <div class="wpf_graphics_container">
                <img id="wpf_graphics_img" alt="The graphic element" src="<?php echo get_the_post_thumbnail_url($post->ID,'full'); ?>"/>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
    <script type="text/javascript">
        <?php if(!is_user_logged_in() && $wpf_allow_guest != 'yes'){ ?>
        jQuery(window).load(function() {
            jQuery(document).find('#wpf_login_container').show();
        });
        <?php } ?>
        function change_graphics_version(sel){
            var wpf_graphics_id = sel.value;
            if(wpf_graphics_id){
                jQuery.ajax({
                    method: "POST",
                    url: wpf_ajax_login_object.ajaxurl,
                    data: {action: "wpf_get_graphics_version","wpf_graphics_id":wpf_graphics_id,"current_page_id":current_page_id,wpf_nonce:wpf_nonce},
                    beforeSend: function(){
                        jQuery('.wpf_graphics_loader').show();
                    },
                    success: function (data) {
                        jQuery('.wpf_graphics_loader').hide();
                        jQuery('#wpf_graphics_img').attr("src", data);
                    }
                });
            }
        }
        function wpf_upload_new_graphics(){
            <?php if(!is_user_logged_in()){ ?>
            jQuery(document).find('#wpf_login_container').show();
            return false;
            <?php } ?>
            var get_privious_all_graphics = '<?php $get_privious_all_graphics = get_post_meta('wpf_graphics_img_id'); ?>';
            (function($) {
                var file_frame; // variable for the wp.media file_frame
                // if the file_frame has already been created, just reuse it
                if ( file_frame ) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: $( this ).data( 'uploader_title' ),
                    button: {
                        text: $( this ).data( 'uploader_button_text' ),
                    },
                    multiple: false // set this to true for multiple file selection
                });
                file_frame.on( 'select', function() {
                    attachment = file_frame.state().get('selection').first().toJSON();
                    var wpf_graphics_img_id = attachment.id;
                    if(wpf_graphics_img_id){
                        // do something with the file here
                        $('#wpf_graphics_img').attr('src',attachment.url);
                        $( '#frontend-button' ).hide();
                        $( '#frontend-image' ).attr('src', attachment.url);
                        jQuery.ajax({
                            method: "POST",
                            url: wpf_ajax_login_object.ajaxurl,
                            data: {action: "wpf_update_graphics_image","wpf_graphics_img_id":wpf_graphics_img_id,"current_page_id":current_page_id,wpf_nonce:wpf_nonce},
                            beforeSend: function(){
                                jQuery('.wpf_graphics_loader').show();
                            },
                            success: function (data) {
                                jQuery('.wpf_graphics_loader').hide();
                                jQuery('#wpf_graphics_version_content').html(data);
                                //console.log(data);
                            }
                        });
                    }
                });
                file_frame.open();
            })(jQuery);
        }
        function wpf_graphics_complete(wpf_graphics_id){
            jQuery.ajax({
                method: "POST",
                url: wpf_ajax_login_object.ajaxurl,
                data: {action: "wpf_completed_graphics","wpf_graphics_id":wpf_graphics_id,"wpf_graphics_status":1,wpf_nonce:wpf_nonce},
                success: function (data) {
                    jQuery('#wpf_graphics_complete').attr('href','javascript:wpf_graphics_uncomplete('+wpf_graphics_id+');');
                    jQuery('#wpf_graphics_complete').text('Completed');
                    jQuery('#wpf_graphics_complete').css('background-color','green');
                    //console.log(data);
                }
            });
        }

        function wpf_graphics_uncomplete(wpf_graphics_id){
            jQuery.ajax({
                method: "POST",
                url: wpf_ajax_login_object.ajaxurl,
                data: {action: "wpf_completed_graphics","wpf_graphics_id":wpf_graphics_id,"wpf_graphics_status":2,wpf_nonce:wpf_nonce},
                success: function (data) {
                    jQuery('#wpf_graphics_complete').attr('href','javascript:wpf_graphics_complete('+wpf_graphics_id+');');
                    jQuery('#wpf_graphics_complete').text('Mark as complete');
                    jQuery('#wpf_graphics_complete').removeAttr('style');
                    //console.log(data);
                }
            });
        }

        jQuery(document).ready(function() {
            jQuery('#graphics_color_picker').iris('color', '<?php echo $wpf_graphics_color_name; ?>');
        });

        /* var wpf_graphics_color_name ="#002157";*/
        jQuery('#graphics_color_picker').iris({
            target: '#graphics_color_picker',
            // or in the data-default-color attribute on the input
            defaultColor: true,
            mode: 'rgb',
            // a callback to fire whenever the color changes to a valid color
            change: function(event, ui){
                //console.log(event);
                //console.log('colour as rgb', ui.color.toString());
                var wpf_graphics_color_name = ui.color.toString();
                jQuery('.wpf_body').css("background-color",  wpf_graphics_color_name);
                jQuery.ajax({
                    method: "POST",
                    url: wpf_ajax_login_object.ajaxurl,
                    data: {action: "wpf_update_graphics_color","wpf_graphics_color_name":wpf_graphics_color_name},
                    beforeSend: function(){
                        jQuery('.wpf_graphics_loader').show();
                    },
                    success: function (data) {
                        jQuery('.wpf_graphics_loader').hide();
                        //jQuery('.wpf_body').css("background-color",  wpf_graphics_color_name);
                    }
                });
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function() {},
            // hide the color picker controls on load
            hide: true,
            target: true,
            // show a group of common colors beneath the square
            palettes: true
        });
        jQuery("#graphics_color_picker").click(function(){
            jQuery("#graphics_color_picker .iris-picker.iris-border").toggle();
        });
    </script>
</div>
</body>
</html>
<!-- 
TESTING LINKS
Website mockup: https://cdn.dribbble.com/users/880427/screenshots/4700099/attachments/1060299/purpose-website-ui-kit-pricing-page.png
Flyer: https://cdn.dribbble.com/users/13774/screenshots/7060056/media/cf9eb03472de9f134b91d1629c5644a3.jpg
Logo: https://bcassetcdn.com/asset/logo/e33c12b4-1128-4129-b31f-2c31cb0878c7/logo?v=4&text=Logo+Text+Here
-->