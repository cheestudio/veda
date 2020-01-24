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
    wp_register_style('wpf_admin_bootstrap_style', WPF_PLUGIN_URL . 'css/bootstrap.min.css', false, WPF_VERSION);
    wp_enqueue_style('wpf_admin_bootstrap_style');

    wp_register_script('wpf_bootstrap_script', WPF_PLUGIN_URL . 'js/bootstrap.min.js', array('jquery'), WPF_VERSION, true);
    wp_enqueue_script('wpf_bootstrap_script');

    if ($wpfeedback_font_awesome_script == 'yes') { ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
              integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
              crossorigin="anonymous">
    <?php } ?>
     <script>
        jQuery(document).ready(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="wpf_logo">
        <img src="<?php echo get_wpf_logo(); ?>" alt="WP Feedback">
    </div>

    <!-- ================= TOP TABS ================-->

    <div class="wpf_tabs_container" id="wpf_tabs_container">
        <button class="wpf_tab_item wpf_tasks active" onclick="location.href='admin.php?page=wpfeedback_page_tasks'"
                style="background-color: #efefef;"><?php _e('Tasks', 'wpfeedback'); ?>
        </button>

        <?php if ($wpf_user_type == 'advisor') { ?>
            <button class="wpf_tab_item wpf_settings" onclick="location.href='admin.php?page=wpfeedback_page_settings'"
                    style="background-color: #efefef;"><?php _e('Settings', 'wpfeedback'); ?>
            </button>
        <?php }
        if ($wpf_user_type == 'advisor') { ?>
            <button class="wpf_tab_item wpf_misc" onclick="openWPFTab('wpf_misc')"
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

    <!-- ================= SETTINGS PAGE ================-->
    <?php if ($wpf_user_type == 'advisor'){ ?>
        <div id="wpf_misc" class="wpf_container" style="display:none">
            <div class="wpf_section_title"><?php _e('WP Feedback Permissions', 'wpfeedback'); ?></div>
            <form method="post" action="admin-post.php" >
                <input type="hidden" name="action" value="save_wpfeedback_misc_options"/>
                <?php wp_nonce_field('wpfeedback'); ?>
                <div class="wpf_settings_ctt_wrap">
                    <div class="wpf_settings_col">
                        <div class="wpfeedback_licence_key">
                            <div class="wpf_title"><?php _e('Validate Your Installation', 'wpfeedback'); ?> <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php _e('You can find your license key on your account page. If for some reason your license is not validating, please ensure you follow these steps.', ''); ?>"><i class="fa fa-question-circle"></i></a></div>
                            <span><?php _e('The plugin will not work unless you insert a valid license key and <a href="https://wpfeedback.co/knowledge-base/faq/installation/" target="_blank">link the domain</a>.', 'wpfeedback'); ?></span>
                            <div class="wpfeedback_licence_key_field">
                                <input type="password" name="wpfeedback_licence_key" id="wpfeedback_licence_key"
                                       value="00000000000000000000000000000000" autocomplete="off" disabled /><?php if (get_option('wpf_license') == 'valid') {
                                    echo '<b><span class="dashicons dashicons-yes" style="font-size:31px; width:28px; height:28px; color: green;"></span><a href="javascript:void(0)" onclick="wpf_edit_license()" class="dashicons"><i class="fa fa-edit"></i></a></b>';
                                } else {
                                    echo '<b><span class="dashicons dashicons-no-alt" style="font-size:31px; width:28px; height:28px; color: red;"></span><a href="javascript:void(0)" onclick="wpf_edit_license()" class="dashicons"><i class="fa fa-edit"></i></a></b>';
                                } ?>
                            </div>
                            <span><?php _e("If you don't have a valid license, <a href='https://wpfeedback.co/' target='_blank'>Please click here to get a new license key</a>", 'wpfeedback'); ?></span>
                            <?php $wpf_check_license_site = get_option('wpf_license');
                            if($wpf_check_license_site == 'site_inactive'){
                            ?>
                                <p style="color: red;"> <?php _e("Your license has been manually revoked from WP Feedback account. If you feel that this is a mistake, please contact the license owner to manually add the license to the site.","wpfeedabck"); ?></p>
                            <?php } ?>
                        </div>

                        <div class="wpfeedback_user_role_list">
                            <div class="wpf_title"><?php _e('User roles allowed to create tasks', 'wpfeedback'); ?> <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php _e('If a user role is not selected, they will not be able to see WP Feedback on the front-end, they will still be able to access the plugin settings though unless you restrict this someone else.', 'wpfeedback'); ?>"><i class="fa fa-question-circle"></i></a></div>
                            <span><?php _e("Hold down the CTRL key to choose multiple options", 'wpfeedback'); ?></span>
                            <select multiple="true" id="wpfeedback_user_role_list"
                                    name="wpfeedback_selcted_role[]"><?php echo wpfeedback_dropdown_roles(); ?></select>
                        </div>

                        <div class="wpfeedback_guest_allowed">
                            <div class="wpf_title">
                                <input type="checkbox" name="wpfeedback_guest_allowed" value="yes"
                                       id="wpfeedback_guest_allowed" <?php if (get_option('wpf_allow_guest') == 'yes') {
                                    echo 'checked';
                                } ?>/>
                                <label for="wpfeedback_guest_allowed"><?php _e('Guest allowed', 'wpfeedback'); ?></label> <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php _e('Enabling this will make WP Feedback visible to everyone who visits your site and will allow them to create tasks and comment on existing ones.', 'wpfeedback'); ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
                        </div>

                        <div class="wpfeedback_disable_for_admin">
                            <div class="wpf_title">
                                <input type="checkbox" name="wpfeedback_disable_for_admin" value="yes"
                                       id="wpfeedback_disable_for_admin" <?php if (get_option('wpf_disable_for_admin') == 'yes') {
                                    echo 'checked';
                                } ?>/>
                                <label for="wpfeedback_disable_for_admin"><?php _e('Stop comments for admins', 'wpfeedback'); ?></label> <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php _e('Stop comments for admins on front end.', 'wpfeedback'); ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
                        </div>
                        
												<img class="wpf_settings_image" src="<?php echo WPF_PLUGIN_URL.'images/wpfpermissions.png'; ?>"/>
                    </div>
                    <div class="wpf_settings_col">
                        <div class="wpfeedback_customisations">
                            <div class="wpf_title_section"><?php _e('Customisations ', 'wpfeedback'); ?> <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php _e('These names are for the setup wizard when you first installed the plugin. Every user who comes to the website after installation will have to go through it and you can name the 3 options here.', 'wpfeedback'); ?>"><i class="fa fa-question-circle"></i></a></div>
                            <label><b><?php _e('Client (Website Owner) ', 'wpfeedback'); ?></b><br><?php _e('Can do everything except: Choose and change status, Access the settings, support and upgrade screens. Can only delete his own tickets. ', 'wpfeedback'); ?></label><br/><input type="text" class="wpf_customise_field" name="wpf_customisations_client" value="<?php echo get_option('wpf_customisations_client'); ?>"><br/>
                            <label><b><?php _e('Webmaster', 'wpfeedback'); ?></b><br><?php _e('Super admin – he has full capabilities for all the plugin’s functions. ', 'wpfeedback'); ?></label><br/><input type="text" class="wpf_customise_field" name="wpf_customisations_webmaster" value="<?php echo get_option('wpf_customisations_webmaster'); ?>"><br/>
                            <label><b><?php _e('Others ', 'wpfeedback'); ?></b><br><?php _e('Can do everything except: Choose and change status and urgency, Access the settings, support, integration and upgrade screens. Can only delete his own tickets. ', 'wpfeedback'); ?></label><br/><input type="text" class="wpf_customise_field" name="wpf_customisations_others" value="<?php echo get_option('wpf_customisations_others'); ?>">
                        </div>
                    </div>
                    <div class="wpf_settings_col">
                        <div class="wpf_user_permissions">
                            <div class="wpf_title_section"><?php _e('User permissions', 'wpfeedback'); ?></div>
                                <table class="wpf_perm_table">
                                    <tr>
                                        <td class="wpf_perm_top"></td>
                                        <td class="wpf_perm_top"><?php echo get_option('wpf_customisations_client') ? get_option('wpf_customisations_client') : 'Client (Website Owner)'; ?></td>
                                        <td class="wpf_perm_top"><?php echo get_option('wpf_customisations_webmaster') ? get_option('wpf_customisations_webmaster') : 'Webmaster'; ?></td>
                                        <td class="wpf_perm_top"><?php echo get_option('wpf_customisations_others') ? get_option('wpf_customisations_others') : 'Others'; ?></td>
                                        <td class="wpf_perm_top"><?php _e('Guest ', 'wpfeedback'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Add User</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_user_client" value="yes" <?php if (get_option('wpf_tab_permission_user_client') == 'yes') { echo 'checked'; } ?> ></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_user_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_user_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_user_others" value="yes" <?php if (get_option('wpf_tab_permission_user_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_user_guest" value="yes" <?php if (get_option('wpf_tab_permission_user_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Priority</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_priority_client" value="yes" <?php if (get_option('wpf_tab_permission_priority_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_priority_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_priority_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_priority_others" value="yes" <?php if (get_option('wpf_tab_permission_priority_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_priority_guest" value="yes" <?php if (get_option('wpf_tab_permission_priority_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Status</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_status_client" value="yes" <?php if (get_option('wpf_tab_permission_status_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_status_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_status_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_status_others" value="yes" <?php if (get_option('wpf_tab_permission_status_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_status_guest" value="yes" <?php if (get_option('wpf_tab_permission_status_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Screenshot</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_screenshot_client" value="yes" <?php if (get_option('wpf_tab_permission_screenshot_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_screenshot_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_screenshot_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_screenshot_others" value="yes" <?php if (get_option('wpf_tab_permission_screenshot_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_screenshot_guest" value="yes" <?php if (get_option('wpf_tab_permission_screenshot_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Information</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_information_client" value="yes" <?php if (get_option('wpf_tab_permission_information_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_information_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_information_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_information_others" value="yes" <?php if (get_option('wpf_tab_permission_information_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_information_guest" value="yes" <?php if (get_option('wpf_tab_permission_information_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                    <tr>
                                        <td class="wpf_left_cell">Delete</td>
                                        <td><input type="checkbox" name="wpf_tab_permission_delete_task_client" value="yes" <?php if (get_option('wpf_tab_permission_delete_task_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_delete_task_webmaster" value="yes" <?php if (get_option('wpf_tab_permission_delete_task_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_delete_task_others" value="yes" <?php if (get_option('wpf_tab_permission_delete_task_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_permission_delete_task_guest" value="yes" <?php if (get_option('wpf_tab_permission_delete_task_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>

                                    <tr>
                                        <td class="wpf_left_cell">Auto Screenshot</td>
                                        <td><input type="checkbox" name="wpf_tab_auto_screenshot_task_client" value="yes" <?php if (get_option('wpf_tab_auto_screenshot_task_client') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_auto_screenshot_task_webmaster" value="yes" <?php if (get_option('wpf_tab_auto_screenshot_task_webmaster') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_auto_screenshot_task_others" value="yes" <?php if (get_option('wpf_tab_auto_screenshot_task_others') == 'yes') { echo 'checked'; } ?>></td>
                                        <td><input type="checkbox" name="wpf_tab_auto_screenshot_task_guest" value="yes" <?php if (get_option('wpf_tab_auto_screenshot_task_guest') == 'yes') { echo 'checked'; } ?>></td>
                                    </tr>
                                </table>
                        </div>
                        <?php
                            $wpfb_users_json = do_shortcode('[wpf_user_list_front]');
                            $wpfb_users = json_decode($wpfb_users_json);
                            $wpf_website_client = get_option('wpf_website_client');
                            $wpf_website_developer = get_option('wpf_website_developer');
                        ?>
                        <div class="wpf_title"><?php _e('Default users', 'wpfeedback'); ?></div>
                        <div class="wpf_website_developer">
                            <label><b><?php _e('The website builder', 'wpfeedback'); ?></b>
                                <br><?php _e('The website builder will add this user to all tasks by default, allowing the client to skip the "choose a user" tab when creating a task.', 'wpfeedback'); ?></label>
                            <select name="wpf_website_developer">
                                <option value="0"><?php _e('select', 'wpfeedback'); ?></option>
                                <?php
                                foreach ($wpfb_users as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php if ($wpf_website_developer == $key) {
                                        echo "selected";
                                    } ?> ><?php echo $val; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="wpf_website_client">
                            <label><b><?php _e('The client', 'wpfeedback'); ?></b>
                                <br><?php _e('Create a user for the client and assign it here to allow the client to comment in guest mode but still be assigned to the tickets for replies and notifications.', 'wpfeedback'); ?></label>
                            <select name="wpf_website_client">
                                <option value="0"><?php _e('select', 'wpfeedback'); ?></option>
                                <?php
                                foreach ($wpfb_users as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php if ($wpf_website_client == $key) {
                                        echo "selected";
                                    } ?>><?php echo $val; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type="submit" value="<?php _e('Save Changes', 'wpfeedback'); ?>" class="wpf_button"
                               id="wpf_save_setting"/>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
</div>
