<?php
global $current_user;
if ($current_user->display_name == '') {
    $wpf_user_name = $current_user->user_nicename;
} else {
    $wpf_user_name = $current_user->display_name;
}
?>
<div class="wpf_backend_initial_setup">
    <div class="wpf_logo_wizard">
        <img src="<?php echo get_wpf_logo(); ?>" alt="WP Feedback">
    </div>
    <div class="wpf_backend_initial_setup_inner">
        <div class="wpf_loader_admin wpf_hide"></div>
        <form method="post" action="admin-post.php">
            <div id="wpf_initial_settings_first_step" class="wpf_initial_container">
                <div class="wpf_title_wizard"><?php _e("Let's get you up and running","wpfeedback"); ?> 🚀</div>
                <p><?php _e("Good to have you here","wpfeedback"); echo $wpf_user_name. _e("! There are only 4 steps.","wpfeedback"); ?></p>
                <input type="hidden" name="action" value="save_wpfeedback_options"/>
                <?php wp_nonce_field('wpfeedback'); ?>

                <div class="wpf_title"><?php _e("1. Add your license key.","wpfeedback"); ?></div>
                <p><?php _e("Found on your purchase confirmation email or within","wpfeedback"); ?> <a href="https://wpfeedback.co/my-account" target="_blank"><?php _e("your account.","wpfeedback"); ?> </a></p>

                <?php 
                $wpf_license_key = trim(get_option('wpf_license_key'));
                if($wpf_license_key){
                    if(!get_option('wpf_decr_key')){
                        $wpf_license_key=$wpf_license_key;
                    }
                    else{
                        $wpf_license_key=wpf_crypt_key($wpf_license_key,'d');
                    }
                }  
                ?>
                
                <div class="wpfeedback_licence_key_field">
                    <input type="text" name="wpfeedback_licence_key"
                           value="<?php echo $wpf_license_key; ?>"/>
                    <?php if (get_option('wpf_license') == 'valid') {
                        echo '<b><span class="dashicons dashicons-yes" id="wpf_license_key_valid" style="display:inline-block; font-size:40px; width:40px; height:40px; color: green;"></span></b>';
                        echo '<b><span class="dashicons dashicons-no-alt" id="wpf_license_key_invalid" style="display:none; font-size:40px; width:40px; height:40px; color: red;"></span></b>';
                    } else {
                        echo '<b><span class="dashicons dashicons-yes" id="wpf_license_key_valid" style="display:none; font-size:40px; width:40px; height:40px; color: green;"></span></b>';
                        echo '<b><span class="dashicons dashicons-no-alt" id="wpf_license_key_invalid" style="display:inline-block; font-size:40px; width:40px; height:40px; color: red;"></span></b>';
                    } ?>
                </div>

                <btn href="javascript:void(0);" class="wpf_button" id="wpf_initial_setup_first_step_button"> <?php _e("Validate Domain","wpfeedback"); ?></btn>
                <p id="wpf_license_validation_error" style="color: red; display: none;"><?php _e("Your domain is not validated,please visit your account on our website.","wpfeedback"); ?></p>
                <p><?php _e("The plugin will not work until you complete this step.","wpfeedback"); ?></p>
            </div>

            <div id="wpf_initial_settings_second_step" class="wpf_initial_container wpf_hide">
                <div class="wpf_title_wizard"> <?php _e("2. Who should comment?", "wpfeedback"); ?></div>
                <p><?php _e("The user roles that are allowed to create tickets and give feedback.","wpfeedback"); ?></p>
                <?php
                $editable_roles = get_editable_roles();
                echo '<ul class="wp_feedback_filter_checkbox user">';
                foreach ($editable_roles as $role => $details) {
                    $name = translate_user_role($details['name']);
                    if($role == 'administrator'){ 
                         echo '<li><input type="checkbox" name="roles_list" value="' . esc_attr($role) . '" checked class="wp_feedback_task" id="' . esc_attr($role) . '" /><label for="' . esc_attr($role) . '">' . esc_html($name) . '</label></li>';
                    }
                    else{
                        echo '<li><input type="checkbox" name="roles_list" value="' . esc_attr($role) . '" class="wp_feedback_task" id="' . esc_attr($role) . '" /><label for="' . esc_attr($role) . '">' . esc_html($name) . '</label></li>';
                    }  
                }
                echo '</ul>';
                ?>
                <hr>
                <div class="wpf_checkbox">
                    <p><input type="checkbox" name="wpf_allow_guest" value="yes"
                              id="wpf_allow_guest" <?php if (get_option('wpf_allow_guest') == 'yes') {
                            echo 'checked';
                        } ?>/>
                        <label for="wpf_allow_guest"><b><?php _e('Allow guests to create tickets, without the need to log in to the site.', 'wpfeedback'); ?></b></label>
                    </p>
                    <p><?php _e("This is great for staging sites or during the build, but not ideal for live websites. The real magic is getting your clients used to using WordPress by encouraging them to log in to their own website.","wpfeedback"); ?></p>
                </div>
                <hr>
                <div class="wpf_globals_container">
					<div class="wpf_title_wizard"> <?php _e("3. Global Settings", "wpfeedback"); ?></div>
					<div class="wpf_gsettings_toggle">
                    <i class="fas fa-poll-h"></i>
                    <label class="wpf_switch">
                        <input type="checkbox" name="wpf_global_settings" class="wpf_global_settings" <?php if(get_option('wpf_global_settings')=='yes'){ echo "checked"; }?> >
                        <span class="wpf_switch_slider wpf_switch_round"></span>
                    </label>
                    <i class="fas fa-cloud-download-alt"></i>
					</div>
					<div class="wpf_gsettings_text">
							<p>Apply the settings that are saved on your dashboard to this website.<br>Including white-label and notifications.</p>
						</div>
                </div>
                <p id="wpf_global_erro_msg" class="wpf_hide" style="color: red;"><?php _e("There seems to be some issue with enabling the global settings. Please contact support for help.","wpfeedabck"); ?></p>
                <br>
                <div class="wpf_wizard_footer">
                    <a href="javascript:void(0);" id="wpf_initial_setup_second_step_prev_button"><?php _e("<< Back","wpfeedback"); ?></a>
                    <btn href="javascript:void(0);" class="wpf_button wpf_next"
                         id="wpf_initial_setup_second_step_button"><?php _e("Next >>","wpfeedback"); ?>
                    </btn>
                </div>
            </div>

            <div id="wpf_initial_settings_third_step" class="wpf_initial_container wpf_hide">
                <div class="wpf_title_wizard"><?php _e("3. Choose notifications","wpfeedback"); ?></div>
                <p>
                    <b><?php _e("Which notifications would you like the plugin to send out?","wpfeedback"); ?></b><br>
					<?php _e("These are global settings. Each user can then choose their own notifications out of the options selected here.","wpfeedback"); ?>
                </p>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_every_new_task" value="yes"
                           id="wpf_every_new_task" checked />
                    <label for="wpf_every_new_task"><?php _e('Send email notification for every new task', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_every_new_comment" value="yes"
                           id="wpf_every_new_comment" checked />
                    <label for="wpf_every_new_comment"><?php _e('Send email notification for every new comment', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_every_new_complete" value="yes"
                           id="wpf_every_new_complete" checked />
                    <label for="wpf_every_new_complete"><?php _e('Send email notification when a task is marked as complete', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_every_status_change" value="yes"
                           id="wpf_every_status_change" checked />
                    <label for="wpf_every_status_change"><?php _e('Send email notification for every status change', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_daily_report" value="yes"
                           id="wpf_daily_report" checked />
                    <label for="wpf_daily_report"><?php _e('Send email notification for last 24 hours report', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_weekly_report" value="yes"
                           id="wpf_weekly_report" checked />
                    <label for="wpf_weekly_report"><?php _e('Send email notification for last 7 days report', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_auto_daily_report" value="yes"
                           id="wpf_auto_daily_report" checked />
                    <label for="wpf_auto_daily_report"><?php _e('Auto send email notification for daily report', 'wpfeedback'); ?></label>
                </div>
                <div class="wpf_checkbox">
                    <input type="checkbox" name="wpf_auto_weekly_report" value="yes"
                           id="wpf_auto_weekly_report" checked />
                    <label for="wpf_auto_weekly_report"><?php _e('Auto send email notification for weekly report', 'wpfeedback'); ?></label>
                </div>
                <br>
                <hr>
                <br>
                <div class="wpf_wizard_footer">
                    <a href="javascript:void(0);" id="wpf_initial_setup_third_step_prev_button"><?php _e("<< Back","wpfeedback"); ?></a>
                    <btn href="javascript:void(0);" class="wpf_button wpf_next"
                         id="wpf_initial_setup_third_step_button"><?php _e("Next >>","wpfeedback"); ?>
                    </btn>
                </div>
            </div>
            <div id="wpf_initial_settings_fourth_step" class="wpf_initial_container wpf_hide">
                <div class="wpf_title_wizard"><?php _e("4. All done!","wpfeedback"); ?> 👏👏👏</div>
                <p><?php _e("Watch this short video to show you how to use WP Feedback to its full potential, saving you loaaaads of time and getting your client to love you even more.","wpfeedback"); ?></p>
                <script src="https://fast.wistia.com/embed/medias/po8gy5uygu.jsonp" async></script>
                <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
                <div class="wistia_responsive_padding" style="padding:50.63% 0 0 0;position:relative;">
                    <div class="wistia_responsive_wrapper"
                         style="height:100%;left:0;position:absolute;top:0;width:100%;"><span
                                class="wistia_embed wistia_async_po8gy5uygu popover=true popoverAnimateThumbnail=true videoFoam=true"
                                style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span>
                    </div>
                </div>
                <br><br>
                <btn class="wpf_button" onclick="wpf_initial_setup_done('<?php echo WPF_SITE_URL; ?>')"><?php _e("Let's rock","wpfeedback"); ?> 🤘</btn>
            </div>
        </form>
    </div>
    <div class="wpf_skip_wizard"><a href="javascript:wpf_initial_setup_done()"><?php _e("Skip Wizard","wpfeedback"); ?></a></div>
</div>