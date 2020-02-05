<div class="wrap wpfeedback-settings">
    <style>
    div#wpf_launcher {
        display: none !important;
    }
    </style>
    <?php
    global $current_user;
    $wpf_user_name = $current_user->user_nicename;
    $wpf_user_email = $current_user->user_email;
    $wpfeedback_font_awesome_script = get_option('wpf_font_awesome_script');
    $wpf_user_type = wpf_user_type();
    if ($wpfeedback_font_awesome_script == 'yes') { ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
              integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
              crossorigin="anonymous">
    <?php } ?>
    <div class="wpf_logo">
        <img src="<?php echo get_wpf_logo(); ?>" alt="WP FeedBack">
    </div>

    <!-- ================= TOP TABS ================-->

    <div class="wpf_tabs_container" id="wpf_tabs_container">
        <button class="wpf_tab_item wpf_tasks active" onclick="location.href='admin.php?page=wpfeedback_page_tasks'"
                style="background-color: #efefef;"><?php _e('Tasks', 'wpfeedback'); ?>
        </button>

        <button class="wpf_tab_item wpf_graphics" onclick="openWPFTab('wpf_graphics')"
                style="background-color: #efefef;"><?php _e('Graphics', 'wpfeedback'); ?>
        </button>

        <?php if ($wpf_user_type == 'advisor') { ?>
            <button class="wpf_tab_item wpf_settings" onclick="location.href='admin.php?page=wpfeedback_page_settings'"
                    style="background-color: #efefef;"><?php _e('Settings', 'wpfeedback'); ?>
            </button>
        <?php }
        if ($wpf_user_type == 'advisor') { ?>
            <button class="wpf_tab_item wpf_misc" onclick="location.href='admin.php?page=wpfeedback_page_permissions'"
                    style="background-color: #efefef;"><?php _e('Permissions', 'wpfeedback'); ?>
            </button>
        <?php }
        if ($wpf_user_type == 'advisor' || $wpf_user_type == 'king') { ?>
            <button class="wpf_tab_item wpf_addons" onclick="location.href='admin.php?page=wpfeedback_page_integrate'"
                    style="background-color: #efefef;">
                <?php _e('Integrate', 'wpfeedback'); ?>
            </button>
        <?php }
        if ($wpf_user_type == 'advisor') { ?>
            <button class="wpf_tab_item wpf_support" onclick="location.href='admin.php?page=wpfeedback_page_support'"
                    style="background-color: #efefef;">
                <?php _e('Support', 'wpfeedback'); ?>
            </button>
            <a href="https://wpfeedback.co/login" target="_blank" class="wpf_tab_item"
               style="background-color: #efefef;">
                <button>
                    <?php _e('Upgrade', 'wpfeedback'); ?>
                </button>
            </a>
        <?php } ?>
    </div>

   

<?php //if($wpf_user_type == 'advisor' || $wpf_user_type == 'king'){ ?>
    <div id="wpf_graphics" class="wpf_container" style="display:none">
        <div class="wpf_section_title"><?php _e('Graphic FeedBack', 'wpfeedback'); ?> <span class="wpf_report_buttons wpf_hide wpf_success" id="wpf_success_msg"><?php _e('Graphics Created successfully', 'wpfeedback'); ?></span></div>
           <?php require_once(WPF_PLUGIN_DIR . '/graphics/wpf_graphics_all_list.php'); ?> 
       
        <div class="wpf-graphics-modal" id="wpf_graphics_popup_form">
            <div class="graphics-modal-content">
				<div class="wpf-graphics-modal_title">Collaborate on a new graphic item</div>
            <button type="button" class="graphics-modal-close" onclick="javascript:wpf_create_graphics_buttons();"><i class="fa fa-times" aria-hidden="true"></i></button>
           <div class="wpf_inner_container">
            <div class="wpf_loader_admin hidden"></div>
                    <div class="wpfeedback_graphics">
                    <!-- <div class="wpf_title"><?php _e('Create Graphics', 'wpfeedback'); ?> </div> -->
                    <?php wp_enqueue_media(); ?>
                     <div class="wpfeedback_graphics_file">
                        <span class="wpf_success msg">Graphics Created successfully</span>
                        <div class="wpf_graphics_name_fields graphics_fields">
                            <div class="wpf_field_label"><b>Graphics Title</b></div>
                            <div class="wpf_field_input"><input onclick="wpf_hide_msg('graphics_name')" type='text' placeholder="Enter your Graphics name" name='wpfeedback_graphics_name' id='wpfeedback_graphics_name' value='' autocomplete="false"><span class="wpf_error graphics_name">Please enter graphics title</span></div>
                        </div>

                        <div class="wpf_graphics_excerpt graphics_fields">
                            <div class="wpf_field_label"><b>Graphics Discription</b></div>
                            <div class="wpf_field_input"><textarea name='wpfeedback_graphics_excerpt' placeholder="Enter your graphics discription" onclick="wpf_hide_msg('graphics_excerpt')" id="wpfeedback_graphics_excerpt"></textarea><span class="wpf_error graphics_excerpt">Please enter your graphics discription</span></div>
                        </div>

                        <div class="wpf_upload_image_button graphics_fields">
                            <div class="wpf_field_label">Upload Image</div>
                            <div class="wpf_field_input"><i class="far fa-image"></i>
                                <input id="upload_image_button" type="button" class="button" onclick="wpf_hide_msg('graphics_img')" value="<?php _e('Upload image','wpfeedback'); ?>"/>
                                <input type='hidden' name='wpfeedback_graphics' id='image_attachment_id' value=''>
                            </div>
                            <span class="wpf_preview_graphics_img wpf_hide"></span>
                            <span class="wpf_error graphics_img">Please select image</span>
                        </div>
                        </div>
                    </div>
                    <input type="button" value="Start Collaborating" class="wpf_graphics wpf_button" onclick="wpfeedback_submit_graphics()">
                </div>
        </div></div>
        </div>
    </div>
<?php //}?>

<script type="text/javascript">
    function wpfeedback_submit_graphics(){
        jQuery("#get_masg_loader").show();
        var wpf_graphics_name = jQuery('#wpfeedback_graphics_name').val();
        var wpf_graphics_excerpt = jQuery('#wpfeedback_graphics_excerpt').val();
        var wpf_feature_id = jQuery('.wpfeedback_graphics_file #image_attachment_id').val();
        var author_id = "<?php echo $current_user->ID ?>";
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        if(wpf_graphics_name == ''){
            jQuery('.wpf_error.graphics_name').show();
            return false;
        }
        if(wpf_feature_id == ''){
            jQuery('.wpf_error.graphics_img').show();
            return false;
        }

        jQuery.ajax({
            method: "POST",
            url: ajaxurl,
            data: {action: "wpf_create_graphics","wpf_graphics_name":wpf_graphics_name,"wpf_graphics_excerpt":wpf_graphics_excerpt,"wpf_feature_id":wpf_feature_id,wpf_nonce:wpf_nonce,},
            beforeSend: function(){
                jQuery('.wpf_loader_admin').show();
            },
            success: function (data) {
                jQuery('#wpfeedback_graphics_name').val('');
                jQuery('#wpfeedback_graphics_excerpt').val('');
                jQuery('.wpfeedback_graphics_file #image_attachment_id').val('');
                jQuery('.wpf_loader_admin').hide();

                jQuery('.wpf_success').show();
                jQuery('#wpf_success_msg').show();
                setTimeout(function(){
                    jQuery('.wpf_success').hide();
                    jQuery('#wpf_success_msg').hide();
                }, 5000);

                jQuery("#all_graphics_list").after(data);
                jQuery("#wpf_graphics_popup_form").hide();
                var $url = jQuery('#all_graphics_list_container .wpf_row .wpf-col-3 a').eq(1).attr('href');
                window.open($url);

            }
        });
    }
    function wpf_create_graphics_buttons(){
        jQuery("#wpf_graphics_popup_form").toggle();
    }

    function wpf_hide_msg(filter_type){
        if(filter_type == 'graphics_name'){
            jQuery('.wpf_error.graphics_name').hide();
        }

        if(filter_type == 'graphics_img'){
            jQuery('.wpf_error.graphics_img').hide();
        }
        if(filter_type == 'graphics_excerpt'){
            jQuery('.wpf_error.graphics_excerpt').hide();
        }

    }
</script>
