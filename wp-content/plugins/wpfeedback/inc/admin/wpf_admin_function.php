<?php
if (!function_exists('wpf_comment_button_admin')) {
    function wpf_comment_button_admin()
    {
        global $wpdb;
        $disable_for_admin = 0;
        $wpf_current_screen ='';
        if(is_admin()){
            $wpf_current_screen = get_current_screen();
            $wpf_current_screen = $wpf_current_screen->id;
        }
        $currnet_user_information = wpf_get_current_user_information();
        $current_role = $currnet_user_information['role'];
        $current_user_name = $currnet_user_information['display_name'];
        $current_user_id = $currnet_user_information['user_id'];
        $wpf_website_builder = get_option('wpf_website_developer');
        if($current_user_name=='Guest'){
            $wpf_website_client = get_option('wpf_website_client');
            $wpf_current_role = 'guest';
            if($wpf_website_client){
                $wpf_website_client_info = get_userdata($wpf_website_client);
                if($wpf_website_client_info){
                    if($wpf_website_client_info->display_name==''){
                        $current_user_name = $wpf_website_client_info->user_nicename;
                    }
                    else{
                        $current_user_name = $wpf_website_client_info->display_name;
                    }
                }
            }

        }
        else{
            $wpf_current_role = get_user_meta($current_user_id,'wpf_user_type',true);
        }

        if($wpf_current_role=='advisor'){
            $wpf_tab_permission_user = get_option('wpf_tab_permission_user_webmaster') ? 'true' : 'false';
            $wpf_tab_permission_priority = get_option('wpf_tab_permission_priority_webmaster') ? 'true' : 'false';
            $wpf_tab_permission_status = get_option('wpf_tab_permission_status_webmaster') ? 'true' : 'false';
            $wpf_tab_permission_screenshot = get_option('wpf_tab_permission_screenshot_webmaster') ? 'true' : 'false';
            $wpf_tab_permission_information = get_option('wpf_tab_permission_information_webmaster') ? 'true' : 'false';
            $wpf_tab_permission_delete_task = get_option('wpf_tab_permission_delete_task_webmaster') ? 'all' : 'own';
            $wpf_tab_permission_auto_screenshot = get_option('wpf_tab_auto_screenshot_task_webmaster') ? 'true' : 'false';
        }
        elseif ($wpf_current_role=='king'){
            $wpf_tab_permission_user = get_option('wpf_tab_permission_user_client') ? 'true' : 'false';
            $wpf_tab_permission_priority = get_option('wpf_tab_permission_priority_client') ? 'true' : 'false';
            $wpf_tab_permission_status = get_option('wpf_tab_permission_status_client') ? 'true' : 'false';
            $wpf_tab_permission_screenshot = get_option('wpf_tab_permission_screenshot_client') ? 'true' : 'false';
            $wpf_tab_permission_information = get_option('wpf_tab_permission_information_client') ? 'true' : 'false';
            $wpf_tab_permission_delete_task = get_option('wpf_tab_permission_delete_task_client') ? 'all' : 'own';
             $wpf_tab_permission_auto_screenshot = get_option('wpf_tab_auto_screenshot_task_client') ? 'true' : 'false';
        }
        elseif ($wpf_current_role=='council'){
            $wpf_tab_permission_user = get_option('wpf_tab_permission_user_others') ? 'true' : 'false';
            $wpf_tab_permission_priority = get_option('wpf_tab_permission_priority_others') ? 'true' : 'false';
            $wpf_tab_permission_status = get_option('wpf_tab_permission_status_others') ? 'true' : 'false';
            $wpf_tab_permission_screenshot = get_option('wpf_tab_permission_screenshot_others') ? 'true' : 'false';
            $wpf_tab_permission_information = get_option('wpf_tab_permission_information_others') ? 'true' : 'false';
            $wpf_tab_permission_delete_task = get_option('wpf_tab_permission_delete_task_others') ? 'all' : 'own';
            $wpf_tab_permission_auto_screenshot = get_option('wpf_tab_auto_screenshot_task_others') ? 'true' : 'false';
        }
        else{
            $wpf_tab_permission_user = 'false';
            $wpf_tab_permission_priority = 'false';
            $wpf_tab_permission_status = 'false';
            $wpf_tab_permission_screenshot = 'true';
            $wpf_tab_permission_information = 'true';
            $wpf_tab_permission_delete_task = 'own';
            $wpf_tab_permission_auto_screenshot = 'false';

        }

        global $wp;
        // $current_page_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $current_page_url = "//".$_SERVER['HTTP_HOST'].esc_url(add_query_arg( $wp->query_vars));
        $current_page_title = '';
        $current_page_id = '';

        $wpf_disable_for_admin = get_option('wpf_disable_for_admin');
        if($wpf_disable_for_admin == 'yes' && $current_role == 'administrator'){
            $disable_for_admin = 1;
        }else{
            $disable_for_admin = 0;
        }

        $wpf_show_front_stikers = get_option('wpf_show_front_stikers');

        $wpfb_users = do_shortcode('[wpf_user_list_front]');
        $ajax_url = admin_url('admin-ajax.php');
        $plugin_url = WPF_PLUGIN_URL;

        $sound_file = WPF_PLUGIN_URL.'images/wpf-screenshot-sound.mp3';
        $wpf_tag_enter_img = WPF_PLUGIN_URL.'images/enter.png';
        $wpf_reconnect_icon = WPF_PLUGIN_URL.'images/wpf_reconnect.png';

        $table =  $wpdb->prefix . 'postmeta';
        $latest_count = $wpdb->get_results("SELECT meta_value FROM $table WHERE meta_key = 'task_comment_id' ORDER BY meta_id DESC LIMIT 1 ");
        if($latest_count){
            $comment_count = $latest_count[0]->meta_value + 1;
        }
        else{
            $comment_count = 1;
        }

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        $wpf_powered_class = '_blank';
        $wpf_powered_by = get_option('wpf_powered_by');
        $enabled_wpfeedback = get_option('wpf_enabled');
        $selected_roles = get_option('wpf_selcted_role');
        $wpf_allow_backend_commenting = '';
        $wpf_allow_backend_commenting = get_option('wpf_allow_backend_commenting');
        $selected_roles = explode(',', $selected_roles);
        $wpf_powerbylink = 'https://wpfeedback.co/powered';
        $get_logoid = get_option('wpf_logo');
        $wpf_powerbylogo = esc_url(WPF_PLUGIN_URL . 'images/Logo-WPFeedback.svg');
        if ($wpf_powered_by == 'yes') {
            $wpf_powered_class = '_self';
            $wpf_powered_link = get_option('wpf_powered_link');
            if($wpf_powered_link!=''){
                $wpf_powerbylink = $wpf_powered_link;
                $wpf_powered_class = '_blank';
            }
            else{
                $wpf_powerbylink = "javascript:void(0)";
            }
            $get_logoid = get_option('wpf_logo');
            if ($get_logoid != '') {
                $wpf_powerbylogo = wp_get_attachment_url(get_option('wpf_logo'));
            } else {

                $wpf_powerbylogo = esc_url(WPF_PLUGIN_URL . 'images/Logo-WPFeedback.svg');
            }
        }
        $wpf_check_page_builder_active = wpf_check_page_builder_active();

        /*=====Start Check customize.php====*/
        if($wpf_check_page_builder_active == 0){
            if ( is_customize_preview() ) {
                $wpf_check_page_builder_active =1;
            }
            else {
                $wpf_check_page_builder_active = 0;
            }
        }
        /*=====END check customize.php====*/

         /*=====Start filter sidebar HTML Structure====*/
        $wpf_active = wpf_check_if_enable();
        $backend_btn ='';
        $wpf_report_btn = '';
        $wpf_go_to_dashboard_btn_tab = '';
        $wpf_report_btn_tab = '';
        $wpf_go_to_cloud_dashboard_btn_tab = '';
        if($current_user_id>0){
            $wpf_go_to_cloud_dashboard_btn_tab = '<a href="https://app.wpfeedback.co/login" target="_blank" class="wpf_filter_tab_btn cloud_dashboard_btn" title="WP FeedBack Dashboard"><svg id="wpf_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 730.450000 636.050000" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><path id="wpf_comment_box" d="M288.130000,655.410000C235.770000,643.640000,187.620000,623.580000,147.130000,596.200000C112.680000,572.900000,85.440000,545.440000,66.130000,514.590000C45.280000,481.250000,34.710000,445.590000,34.710000,408.590000C34.710000,371.590000,45.280000,335.910000,66.130000,302.590000C85.410000,271.740000,112.650000,244.280000,147.130000,220.980000C197.070000,187.190000,258.710000,164.560000,325.520000,154.900000L324.130000,229.800000C273,238.590000,226.390000,256.410000,188.520000,282C136.960000,316.880000,108.520000,361.810000,108.520000,408.520000C108.520000,455.230000,136.910000,500.160000,188.520000,535.040000C216.870000,554.230000,250.150000,569.040000,286.520000,578.990000C278.283648,603.880910,278.848506,630.845843,288.120000,655.370000ZM713.810000,587.770000C709.810000,579.010000,703.960000,566.210000,700.350000,556.850000C742.870000,513.520000,765.230000,462.580000,765.230000,408.560000C765.230000,371.560000,754.660000,335.880000,733.810000,302.560000C714.530000,271.710000,687.290000,244.250000,652.810000,220.950000C622.810000,200.670000,588.630000,184.400000,551.630000,172.550000L542.390000,247.310000C566.757008,255.992643,589.961727,267.643702,611.480000,282C663.040000,316.880000,691.430000,361.810000,691.430000,408.520000C691.430000,456.320000,662.280000,492.520000,637.820000,514.520000C614.890000,535.140000,625.540000,566.320000,629.040000,576.520000C632.720000,587.280000,638.090000,599.460000,643.600000,611.580000L633.210000,606.400000C592.210000,585.870000,564.720000,572.790000,541.920000,572.790000C536.609003,572.760887,531.324722,573.543244,526.250000,575.110000Q515.540000,578.440000,504.550000,581.180000C512.251226,606.243497,511.136012,633.188615,501.390000,657.530000Q522.810000,653.200000,543.510000,647C555.040000,649.800000,582.990000,663.790000,600.180000,672.390000C638.410000,691.530000,667.180000,705.920000,691.060000,705.920000C699.713640,706.033752,708.240690,703.834671,715.760000,699.550000C730.160000,691.320000,738.140000,676.240000,737.640000,658.170000C737.430000,650.690000,735.820000,642.590000,732.640000,632.690000C728.100000,619,720.830000,603.140000,713.810000,587.770000Z" transform="matrix(1 0 0 1 -34.77000000000000 -69.98000000000000)" fill="rgb(142,139,201)" stroke="none" stroke-width="1"/><circle id="wpf_exc_circle" r="84.900000" transform="matrix(1 0 0 1 360.41000000000003 544.97000000000003)" fill="rgb(5,32,85)" stroke="none" stroke-width="1"/><path id="wpf_exc_mark" d="M518.870000,106C514.710000,74,494.870000,75.070000,434.630000,70.560000C388,67,363.590000,80,359.070000,122.220000C355.490000,155.590000,342.070000,458.220000,349.940000,473.880000C357.810000,489.540000,451.070000,501.260000,463.160000,488.620000C475.250000,475.980000,523.380000,140.630000,518.870000,106Z" transform="matrix(1 0 0 1 -34.77000000000000 -69.98000000000000)" fill="rgb(5,32,85)" stroke="none" stroke-width="1"/></svg></a>';
            $sidebar_col = "wpf_col3";
            $backend_btn = ' <button class="wpf_tab_sidebar wpf_backend"  onclick="openWPFTab(\'wpf_backend\')" >'.__('Backend','wpfeedback').'</button>';
            $wpf_daily_report = get_option('wpf_daily_report');
            $wpf_weekly_report = get_option('wpf_weekly_report');

            /*================Go to dashboard Tabs HTML================*/
            $wpf_report_btn.='<div class="wpf_report_trigger"><label class="wpf_reports_title">Send Reports:</label>';
            if($wpf_daily_report=='yes'){
                /*================Daily report btn HTML================*/
                $wpf_report_btn.='<a href="javascript:wpf_send_report(\'daily_report\')">'.__('Last 24 Hours','wpfeedback').'</a>';
            }
            if($wpf_weekly_report=='yes'){
                /*================Weekly report btn HTML================*/
                $wpf_report_btn.='<a href="javascript:wpf_send_report(\'weekly_report\')">'.__('Last 7 Days','wpfeedback').'</a>';
            }
            $wpf_report_btn.='<span id="wpf_front_report_sent_span" class="wpf_hide text-success">'.__('Your report was sent','wpfeedback').'</span></div>';

             /*================Report Tabs HTML================*/
            $wpf_report_btn_tab = '<a href="javascript:void(0)" class="wpf_filter_tab_btn" data-tag="wpf_report_btn" title="Reports"><i class="fa fa-envelope-open-text"></i></a>';
        }
        else{
            $sidebar_col = "wpf_col2";
        }

        /*================filter Tabs Content HTML================*/
        $wpf_task_filter_btn = '<div id="wpf_filter_taskstatus" class=""><label class="wpf_filter_title"><i class="fa fa-exclamation-circle"></i> Filter by Status:</label>'.wp_feedback_get_texonomy_filter("task_status").'</div><div id="wpf_filter_taskpriority" class=""><label class="wpf_filter_title"><i class="fa fa-thermometer-half"></i> Filter by Priority:</label>'.wp_feedback_get_texonomy_filter("task_priority").'</div>';
        
        /*================visibility Tabs Content HTML================*/
        $wpf_task_visibility = '<label class="wpf_visibility_title">Tasks Visibility</label><div class="wpf_sidebar_checkboxes"><input type="checkbox" name="wpfb_display_tasks" id="wpfb_display_tasks" /> <label for="wpfb_display_tasks">'.__('Show Tasks','wpfeedback').'</label></div>
            <div class="wpf_sidebar_checkboxes"><input type="checkbox" name="wpfb_display_completed_tasks" id="wpfb_display_completed_tasks" /> <label for="wpfb_display_completed_tasks">'.__('Show Completed','wpfeedback').'</label></div>
            <label class="wpf_visibility_title">Sidebar Visibility</label><div class="wpf_display_all_taskmeta_div wpf_sidebar_checkboxes"><input type="checkbox" name="wpf_display_all_taskmeta" id="wpf_display_all_taskmeta" class="wpf_display_all_taskmeta" title="Display taskmeta"><label for="wpf_display_all_taskmeta">Show Details</label></div>';
        
         /*================Filter Tabs & Content HTML================*/
        $wpf_toggel_filter_tab = '<div class="wpf_sidebar_filter wpf_col2">
            <a href="javascript:void(0)" data-tag="wpf_task_filter_btn" class="wpf_filter_tab_btn" title="Filter"><i class="fa fa-sliders-h"></i></a></li>
            <a href="javascript:void(0)" class="wpf_filter_tab_btn" data-tag="wpf_task_visibility" title="Visibility"><i class="fa fa-eye"></i></a>
            '.$wpf_report_btn_tab.$wpf_go_to_cloud_dashboard_btn_tab.'
           <a href="javascript:void(0)" onclick="wpf_new_general_task(0)" class="wpf_general_task_thispage" title="General"><i class="fa fa-plus-circle"></i>General</a>
        <div style="clear: both;"></div>    
        <div id="container">
            <div class="wpf_list wpf_hide" id="wpf_task_filter_btn">'.$wpf_task_filter_btn.'</div>
            <div class="wpf_list wpf_hide" id="wpf_task_visibility">'.$wpf_task_visibility.'</div>
            <div class="wpf_list wpf_hide" id="wpf_report_btn">'.$wpf_report_btn.'</div>
        </div></div>';
        /*=====END filter sidebar HTML Structure====*/

        $wpf_nonce = wpf_wp_create_nonce();
        $wpf_task_filter_btn = '<div class="wpf_sidebar_filter wpf_col2">
        <!-- =================Current page filter Tabs================-->
        <button class="wpf_filter wpf_filter_taskstatus" onclick="wpf_show(\'wpf_filter_taskstatus\')">'.__("Task Status","wpfeedback").'</button>
        <button class="wpf_filter wpf_filter_taskpriority" onclick="wpf_show(\'wpf_filter_taskpriority\')">'.__("Task Urgency","wpfeedback").'</button></div>';

        require_once(WPF_PLUGIN_DIR . 'inc/wpf_popup_string.php');
        if ( $wpf_active == 1 && $wpf_check_page_builder_active == 0 && $wpf_allow_backend_commenting!='yes'){
            echo "<script>var wpf_reconnect_icon = '$wpf_reconnect_icon',wpf_tag_enter_img='$wpf_tag_enter_img', disable_for_admin='$disable_for_admin',wpf_nonce='$wpf_nonce', wpf_current_screen='$wpf_current_screen' ,ipaddress='$ipaddress', current_role='$current_role', wpf_current_role='$wpf_current_role', current_user_name='$current_user_name', current_user_id='$current_user_id', wpf_website_builder='$wpf_website_builder', wpfb_users = '$wpfb_users',  ajaxurl = '$ajax_url', current_page_url = '$current_page_url', current_page_title = '$current_page_title', current_page_id = '$current_page_id', wpf_screenshot_sound = '$sound_file', plugin_url = '$plugin_url', comment_count='$comment_count', wpf_show_front_stikers='$wpf_show_front_stikers', wpf_tab_permission_user=$wpf_tab_permission_user, wpf_tab_permission_priority=$wpf_tab_permission_priority, wpf_tab_permission_status=$wpf_tab_permission_status, wpf_tab_permission_screenshot=$wpf_tab_permission_screenshot, wpf_tab_permission_information=$wpf_tab_permission_information, wpf_tab_permission_delete_task='$wpf_tab_permission_delete_task',wpf_tab_permission_auto_screenshot=$wpf_tab_permission_auto_screenshot;</script>";
            if($disable_for_admin == 0){
                echo '<div id="wpf_already_comment" class="wpf_hide"><div class="wpf_notice_title">'.__("Task already exist for this element.","wpfeedback").'</div><div class="wpf_notice_text">'.__("Write your message in the existing thread. <br>Here, we opened it for you.","wpfeedback").'</div></div><div id="wpf_reconnecting_task" class="wpf_hide" style="display: none;"><div class="wpf_notice_title">'.__("Remapping task....","wpfeedback").'</div><div class="wpf_notice_text">'.__("Give it a few seconds. <br>Then, refresh the page to see the task in the new position.","wpfeedback").'</div></div><div id="wpf_reconnecting_enabled" class="wpf_hide" style="display: none;"><div class="wpf_notice_title">'.__("Remap task","wpfeedback").'</div><div class="wpf_notice_text">'.__("Place the task anywhere on the page to pinpoint the location of the request.","wpfeedback").'</div></div><div id="wpf_launcher" data-html2canvas-ignore="true"><div class="wpf_launch_buttons"><div class="wpf_start_comment"><a href="javascript:enable_comment();" title="'.__('Click to give your feedback!','wpfeedback').'" data-placement="left" class="comment_btn" id="wpf_enable_comment_btn"><i class="fa fa-plus"></i></a></div>
                <div class="wpf_expand"><a href="javascript:expand_sidebar()" id="wpf_expand_btn" title="WP FeedBack Sidebar"><svg id="wpf_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 730.450000 636.050000" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><path id="wpf_comment_box" d="M288.130000,655.410000C235.770000,643.640000,187.620000,623.580000,147.130000,596.200000C112.680000,572.900000,85.440000,545.440000,66.130000,514.590000C45.280000,481.250000,34.710000,445.590000,34.710000,408.590000C34.710000,371.590000,45.280000,335.910000,66.130000,302.590000C85.410000,271.740000,112.650000,244.280000,147.130000,220.980000C197.070000,187.190000,258.710000,164.560000,325.520000,154.900000L324.130000,229.800000C273,238.590000,226.390000,256.410000,188.520000,282C136.960000,316.880000,108.520000,361.810000,108.520000,408.520000C108.520000,455.230000,136.910000,500.160000,188.520000,535.040000C216.870000,554.230000,250.150000,569.040000,286.520000,578.990000C278.283648,603.880910,278.848506,630.845843,288.120000,655.370000ZM713.810000,587.770000C709.810000,579.010000,703.960000,566.210000,700.350000,556.850000C742.870000,513.520000,765.230000,462.580000,765.230000,408.560000C765.230000,371.560000,754.660000,335.880000,733.810000,302.560000C714.530000,271.710000,687.290000,244.250000,652.810000,220.950000C622.810000,200.670000,588.630000,184.400000,551.630000,172.550000L542.390000,247.310000C566.757008,255.992643,589.961727,267.643702,611.480000,282C663.040000,316.880000,691.430000,361.810000,691.430000,408.520000C691.430000,456.320000,662.280000,492.520000,637.820000,514.520000C614.890000,535.140000,625.540000,566.320000,629.040000,576.520000C632.720000,587.280000,638.090000,599.460000,643.600000,611.580000L633.210000,606.400000C592.210000,585.870000,564.720000,572.790000,541.920000,572.790000C536.609003,572.760887,531.324722,573.543244,526.250000,575.110000Q515.540000,578.440000,504.550000,581.180000C512.251226,606.243497,511.136012,633.188615,501.390000,657.530000Q522.810000,653.200000,543.510000,647C555.040000,649.800000,582.990000,663.790000,600.180000,672.390000C638.410000,691.530000,667.180000,705.920000,691.060000,705.920000C699.713640,706.033752,708.240690,703.834671,715.760000,699.550000C730.160000,691.320000,738.140000,676.240000,737.640000,658.170000C737.430000,650.690000,735.820000,642.590000,732.640000,632.690000C728.100000,619,720.830000,603.140000,713.810000,587.770000Z" transform="matrix(1 0 0 1 -34.77000000000000 -69.98000000000000)" fill="rgb(142,139,201)" stroke="none" stroke-width="1"/><circle id="wpf_exc_circle" r="84.900000" transform="matrix(1 0 0 1 360.41000000000003 544.97000000000003)" fill="rgb(5,32,85)" stroke="none" stroke-width="1"/><path id="wpf_exc_mark" d="M518.870000,106C514.710000,74,494.870000,75.070000,434.630000,70.560000C388,67,363.590000,80,359.070000,122.220000C355.490000,155.590000,342.070000,458.220000,349.940000,473.880000C357.810000,489.540000,451.070000,501.260000,463.160000,488.620000C475.250000,475.980000,523.380000,140.630000,518.870000,106Z" transform="matrix(1 0 0 1 -34.77000000000000 -69.98000000000000)" fill="rgb(5,32,85)" stroke="none" stroke-width="1"/></svg></a></div></div>
                <div class="wpf_sidebar_container" style="opacity: 0; margin-right: -300px";>
                <div class="wpf_sidebar_header">
                <!-- =================Top Tabs================-->
                <button class="wpf_tab_sidebar wpf_thispage wpf_active" onclick="openWPFTab_admin(\'wpf_thispage\')" >'.__('On This Page','wpfeedback').'</button>
                <button class="wpf_tab_sidebar wpf_allpages"  onclick="openWPFTab_admin(\'wpf_allpages\')" >'.__('All Pages','wpfeedback').'</button>
                <button class="wpf_tab_sidebar wpf_frontend"  onclick="openWPFTab_admin(\'wpf_frontend\')" >'.__('Frontend','wpfeedback').'</button>
                </div><div class="wpf_filter_tab">'.$wpf_toggel_filter_tab.'</div>            
                <div class="wpf_sidebar_content">
                    <div class="wpf_sidebar_loader wpf_hide"></div>
                    <div id="wpf_thispage" class="wpf_thispage_tab wpf_container wpf_active_filter"><ul id="wpf_thispage_container"></ul></div>
                    <div id="wpf_allpages" class="wpf_allpages_tab wpf_container" style="display:none";><ul id="wpf_allpages_container"></ul></div>
                    <div id="wpf_frontend" class="wpf_backend_tab wpf_container wpf_frontend_container" style="display:none";><ul id="wpf_frontend_container"></ul></div>
                </div>
                <div class="wpf_sidebar_footer"><a href="'.$wpf_powerbylink.'" target="'.$wpf_powered_class.'">'.__('Powered by','wpfeedback').' <img alt="Powered by WPFeedback" src="'.$wpf_powerbylogo.'" /></a></div>
                </div>
                </div>
                <div id="wpf_enable_comment" class="wpf_hide"><p>'.__('Commenting enabled','wpfeedback').'</p><a class="wpf_comment_mode_general_task" id="wpf_comment_mode_general_task" href="javascript:void(0)" onclick="wpf_new_general_task(0)"><i class="fa fa-plus-square"></i> '.__('General Task','wpfeedback').'</a><a href="javascript:disable_comment();" id="disable_comment_a">'.__('Cancel','wpfeedback').'</a></div>';
                require_once(WPF_PLUGIN_DIR . 'inc/frontend/wpf_general_task_modal.php');
            }
        }
    }
}
add_action('admin_footer', 'wpf_comment_button_admin');

add_action('admin_enqueue_scripts', 'wpfeedback_add_stylesheet_to_admin');
if (!function_exists('wpfeedback_add_stylesheet_to_admin')) {
    function wpfeedback_add_stylesheet_to_admin()
    {

        $wpf_current_screen_id ='';
        if(is_admin()){
            $wpf_current_screen = get_current_screen();
            $wpf_current_screen_id = $wpf_current_screen->id;
        }

        $wpf_license = get_option('wpf_license');
        wp_register_style('wpf-graphics-admin-style', WPF_PLUGIN_URL . 'css/graphics-admin.css', false, WPF_VERSION);
        wp_enqueue_style('wpf-graphics-admin-style');

        wp_register_style('wpf_admin_style', WPF_PLUGIN_URL . 'css/admin.css', false, WPF_VERSION);
        wp_enqueue_style('wpf_admin_style');

        wp_register_script('wpf_admin_script', WPF_PLUGIN_URL . 'js/admin.js', array('jquery'), WPF_VERSION, true);
        wp_enqueue_script('wpf_admin_script');

        wp_register_script('wpf_jscolor_script', WPF_PLUGIN_URL . 'js/jscolor.js', array('jquery'), WPF_VERSION, true);
        wp_enqueue_script('wpf_jscolor_script');

        wp_register_script('wpf_browser_info_script', WPF_PLUGIN_URL . 'js/wpf_browser_info.js', array('jquery'), WPF_VERSION, true);
        wp_enqueue_script('wpf_browser_info_script');

        if ($wpf_license != 'valid'){
            wp_register_script('wpf_popper_script', WPF_PLUGIN_URL . 'js/popper.min.js', array('jquery'), WPF_VERSION, true);
            wp_enqueue_script('wpf_popper_script');
        }

        wp_enqueue_media();

        /* ===========Admin Side================ */
        $wpf_check_page_builder_active = wpf_check_page_builder_active();
        /*=====Start Check customize.php====*/
        if($wpf_check_page_builder_active == 0){
            if ( is_customize_preview() ) {
                $wpf_check_page_builder_active =1;
            }
            else {
                $wpf_check_page_builder_active = 0;
            }
        }
        /*=====END check customize.php====*/
        $enabled_wpfeedback = wpf_check_if_enable();
        $wpf_allow_backend_commenting = '';
        $wpf_allow_backend_commenting = get_option('wpf_allow_backend_commenting');

        if($wpf_allow_backend_commenting=='yes'){
            wp_register_script('wpf_jquery_ui_script', WPF_PLUGIN_URL . 'js/jquery-ui.js', array('jquery'), WPF_VERSION, true);
            //wp_enqueue_script('wpf_jquery_ui_script');

            wp_register_script('wpf_popper_script', WPF_PLUGIN_URL . 'js/popper.min.js', array('jquery'), WPF_VERSION, true);
            wp_enqueue_script('wpf_popper_script');

            wp_register_style('wpf_bootstrap_script', WPF_PLUGIN_URL . 'css/bootstrap.min.css', false, WPF_VERSION);
            wp_enqueue_style('wpf_bootstrap_script');

            wp_register_script('wpf_bootstrap_script', WPF_PLUGIN_URL . 'js/bootstrap.min.js', array('jquery'), WPF_VERSION, true);
            wp_enqueue_script('wpf_bootstrap_script');

        }
        $wpf_exclude_page = array("wp-feedback_page_wpfeedback_page_tasks", "wp-feedback_page_wpfeedback_page_settings", "wp-feedback_page_wpfeedback_page_graphics", "wp-feedback_page_wpfeedback_page_permissions", "wp-feedback_page_wpfeedback_page_support");
        if ($enabled_wpfeedback==1 && $wpf_allow_backend_commenting!='yes') {
            if(!in_array($wpf_current_screen_id,$wpf_exclude_page)){
                wp_register_style('wpf_wpfb-front_script', WPF_PLUGIN_URL . 'css/wpfb-front.css', false, WPF_VERSION);
                wp_enqueue_style('wpf_wpfb-front_script');
            }
            
            wp_register_style('wpf_bootstrap_script', WPF_PLUGIN_URL . 'css/bootstrap.min.css', false, WPF_VERSION);
            wp_enqueue_style('wpf_bootstrap_script');
            if ($wpf_check_page_builder_active == 0) {

                if( wpf_remove_ui_script() == 1){
                    wp_register_script('wpf_jquery_ui_script', WPF_PLUGIN_URL . 'js/jquery-ui.js', array('jquery'), WPF_VERSION, true);
                    wp_enqueue_script('wpf_jquery_ui_script');
                }

                wp_register_script('wpf_app_script', WPF_PLUGIN_URL . 'js/admin/admin_app.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_app_script');

                wp_register_script('wpf_html2canvas_script', WPF_PLUGIN_URL . 'js/html2canvas.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_html2canvas_script');

                wp_register_script('wpf_popper_script', WPF_PLUGIN_URL . 'js/popper.min.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_popper_script');

                wp_register_script('wpf_custompopover_script', WPF_PLUGIN_URL . 'js/custompopover.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_custompopover_script');

                wp_register_script('wpf_selectoroverlay_script', WPF_PLUGIN_URL . 'js/selectoroverlay.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_selectoroverlay_script');

                wp_register_script('wpf_xyposition_script', WPF_PLUGIN_URL . 'js/xyposition.js', array('jquery'), WPF_VERSION, true);
                wp_enqueue_script('wpf_xyposition_script');

                if (!defined('WDT_BASENAME') || !defined('WDT_ROOT_PATH')) {
                    wp_register_script('wpf_bootstrap_script', WPF_PLUGIN_URL . 'js/bootstrap.min.js', array('jquery'), WPF_VERSION, true);
                    wp_enqueue_script('wpf_bootstrap_script');
                }
            }
        }
    }
}


add_action('wp_ajax_load_wpfb_tasks_admin','load_wpfb_tasks_admin');
add_action('wp_ajax_nopriv_load_wpfb_tasks_admin','load_wpfb_tasks_admin');
if (!function_exists('load_wpfb_tasks_admin')) {
    function load_wpfb_tasks_admin(){
        global $wpdb,$current_user;
        wpf_security_check();
        $current_user_id = $current_user->ID;
        $comment = "";
        $response = array();
        if($_POST['wpf_current_screen'] && $_POST['wpf_current_screen']!='' && $_POST['all_page'] !=1){
            $args = array(
                'post_type'   => 'wpfeedback',
                'numberposts' => -1,
                'post_status' => 'wpf_admin',
                'orderby'    => 'date',
                'order'      => 'DESC',
                'meta_query' => array(
                    array(
                        'key'       => 'wpf_current_screen',
                        'value'     => $_POST['wpf_current_screen'],
                        'compare'   => '=',
                    )
                )
            );
            $wpfb_tasks = get_posts( $args );
        }
        elseif ($_POST['task_id']){
            $args = array(
                'include'=>$_POST['task_id'],
                'post_type'=>'wpfeedback',
                'post_status' => 'wpf_admin',
            );
            $wpfb_tasks = get_posts( $args );
        }
        else{
            $args = array(
                'post_type'   => 'wpfeedback',
                'numberposts' => -1,
                'post_status' => 'wpf_admin',
                'orderby'    => 'date',
                'order'      => 'DESC',
                'meta_query' => array(
                    array(
                        'key'       => 'wpf_current_screen',
                        'value'     => '',
                        'compare'   => '!=',
                    )
                )
            );
            $wpfb_tasks = get_posts( $args );
        }

        foreach ($wpfb_tasks as $wpfb_task) {
            $task_date = get_the_time( '', $wpfb_task->ID );
            $metas = get_post_meta($wpfb_task->ID);
            $task_priority = get_the_terms( $wpfb_task->ID, 'task_priority' );
            $task_status = get_the_terms( $wpfb_task->ID, 'task_status' );
            $task_tags = get_the_terms( $wpfb_task->ID, 'wpf_tag' );
            $post_title = esc_html( get_the_title($wpfb_task->ID));
            $temp_tag_counter=0;
            foreach ($task_tags as $task_tag => $task_tags_value) {
                $response[$wpfb_task->ID]['wpf_tags'][$temp_tag_counter]['slug']=$task_tags_value->slug;
                $response[$wpfb_task->ID]['wpf_tags'][$temp_tag_counter]['name']=$task_tags_value->name;
                $temp_tag_counter++;
            }
            foreach ($metas as $key => $value) {
                if($key == 'task_title'){
                    $response[$wpfb_task->ID][$key] = $post_title;
                }else{
                    $response[$wpfb_task->ID][$key]=$value[0];
                }
                $response[$wpfb_task->ID]['task_priority']=$task_priority[0]->slug;
                $response[$wpfb_task->ID]['task_status']=$task_status[0]->slug;
                $response[$wpfb_task->ID]['current_user_id']=$current_user_id;

                $task_date1 = date_create($task_date);
                $task_date2 = new DateTime('now');

                $curr_comment_time = wpfb_time_difference($task_date1,$task_date2);

                $response[$wpfb_task->ID]['task_time']=$curr_comment_time['comment_time'];
            }

            $args = array(
                'post_id' => $wpfb_task->ID,
                'type' => 'wp_feedback'
            );
            $comments_info = get_comments( $args );

            if($comments_info){
                foreach($comments_info as $comment) {
                    $comment_type=0;
                    if (strpos($comment->comment_content, 'wp-content/uploads') !== false) {
                        //                    print_r(wp_check_filetype($comment->comment_content));
                        $temp_filetype = wp_check_filetype($comment->comment_content);
                        $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['filetype']=$temp_filetype;
                        if($temp_filetype['type']=='image/png' || $temp_filetype['type']=='image/gif' || $temp_filetype['type']=='image/jpeg'){
                            $comment_type=1;
                        }
                        else{
                            $comment_type=2;
                        }
                        $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message']=$comment->comment_content;

                    }
                    else if (wp_http_validate_url($comment->comment_content) && !strpos($comment->comment_content, 'wp-content/uploads')) {
                        $idVideo = $comment->comment_content;
                        $link = explode("?v=",$idVideo);
                        if ($link[0] == 'https://www.youtube.com/watch') {
                            $youtubeUrl = "http://www.youtube.com/oembed?url=$idVideo&format=json";
                            $docHead = get_headers($youtubeUrl);
                            if (substr($docHead[0], 9, 3) !== "404") {
                                $comment_type=3;
                                $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message'] = $link[1];
                            }
                            else {
                                $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message']=$comment->comment_content;
                            }
                        }else{
                            $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message']=get_comment_text($comment->comment_ID);
                        }

                    }
                    else{
                        $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message']=get_comment_text($comment->comment_ID);
                    }
                    /*$response[$wpfb_task->ID]['comments'][$comment->comment_ID]['message']=$comment->comment_content;*/
                    $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['comment_type']=$comment_type;
                    $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['author']=$comment->comment_author;

                    $datetime1 = date_create($comment->comment_date);

                    //              Old Logic to get current time. Was creating issues when displaying message
                    //              $datetime2 = new DateTime('now');

                    //              New Logic to get current time.
                    $wpf_wp_current_timestamp = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
                    $datetime2 = date_create($wpf_wp_current_timestamp);

                    $curr_comment_time = wpfb_time_difference($datetime1,$datetime2);

                    $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['time']=$curr_comment_time['comment_time'];
                    $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['time_full']=$curr_comment_time['interval'];
                    $response[$wpfb_task->ID]['comments'][$comment->comment_ID]['user_id']=$comment->user_id;
                }
            }
        }
        ob_clean();
        echo json_encode($response);
        exit;
    }
}

function wpf_custom_post_status(){
    register_post_status( 'wpf_admin', array(
        'label'                     => _x( 'admin', 'wpfeedback' ),
        'public'                    => true,
        'exclude_from_search'       => true,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => false,
        'post_type'                 => array( 'wpfeedback'),
        'label_count'               => _n_noop( 'Admin <span class="count">(%s)</span>', 'Admin <span class="count">(%s)</span>' ),
    ) );
}
add_action( 'init', 'wpf_custom_post_status' );

if (!function_exists('wpf_disable_comment_for_admin_page')) {
    function wpf_disable_comment_for_admin_page(){
        $response = 0;
        if(is_admin()){
            $wpf_current_screen = get_current_screen();
            if($wpf_current_screen){
                $wpf_current_screen_id = $wpf_current_screen->id;
                if($wpf_current_screen_id == 'toplevel_page_tvr-microthemer'){
                    remove_action('admin_footer', 'wpf_comment_button_admin');
                    wp_dequeue_script( 'wpf_app_script' ); ?>
                    <script>jQuery(window).load(function(){
                            jQuery("#viframe").contents().find("body").find("#wpf_launcher").css("display","none");
                            jQuery("#viframe").contents().find("body").find(".wpfb-point").css("display","none");
                        });</script>
                <?php }

                if($wpf_current_screen_id == 'nav-menus'){
                    if (function_exists('_QuadMenu')) {
                        remove_action('admin_footer', 'wpf_comment_button_admin');
                        remove_action('admin_enqueue_scripts', 'wpfeedback_add_stylesheet_to_admin');
                        wp_dequeue_script( 'wpf_app_script' );
                        wp_dequeue_script( 'wpf_bootstrap_script' );
                    }
                }
            }
        }
    }
}
add_action('admin_head', 'wpf_disable_comment_for_admin_page',10);
?>