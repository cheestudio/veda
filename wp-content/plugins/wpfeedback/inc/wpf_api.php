<?php
define('WPF_CRM_API', 'https://api.wpfeedback.co/');

function wpf_website_details(){

    $valid = wpf_api_request_verification();
    if($valid==1){
        update_option('wpf_initial_sync',1,'no');
        $response_array = array();
        $response_array['blogname'] = get_option('blogname');
        $response_array['url'] = WPF_SITE_URL;

        $response_array['wpf_tab_permission_user_client'] = get_option('wpf_tab_permission_user_client');
        $response_array['wpf_tab_permission_user_webmaster'] = get_option('wpf_tab_permission_user_webmaster');
        $response_array['wpf_tab_permission_user_others'] = get_option('wpf_tab_permission_user_others');
        $response_array['wpf_tab_permission_priority_client'] = get_option('wpf_tab_permission_priority_client');
        $response_array['wpf_tab_permission_priority_webmaster'] = get_option('wpf_tab_permission_priority_webmaster');
        $response_array['wpf_tab_permission_priority_others'] = get_option('wpf_tab_permission_priority_others');
        $response_array['wpf_tab_permission_status_client'] = get_option('wpf_tab_permission_status_client');
        $response_array['wpf_tab_permission_status_webmaster'] = get_option('wpf_tab_permission_status_webmaster');
        $response_array['wpf_tab_permission_status_others'] = get_option('wpf_tab_permission_status_others');
        $response_array['wpf_tab_permission_screenshot_client'] = get_option('wpf_tab_permission_screenshot_client');
        $response_array['wpf_tab_permission_screenshot_webmaster'] = get_option('wpf_tab_permission_screenshot_webmaster');
        $response_array['wpf_tab_permission_screenshot_others'] = get_option('wpf_tab_permission_screenshot_others');
        $response_array['wpf_tab_permission_information_client'] = get_option('wpf_tab_permission_information_client');
        $response_array['wpf_tab_permission_information_webmaster'] = get_option('wpf_tab_permission_information_webmaster');
        $response_array['wpf_tab_permission_information_others'] = get_option('wpf_tab_permission_information_others');
        $response_array['wpf_tab_permission_delete_task_client'] = get_option('wpf_tab_permission_delete_task_client');
        $response_array['wpf_tab_permission_delete_task_webmaster'] = get_option('wpf_tab_permission_delete_task_webmaster');
        $response_array['wpf_tab_permission_delete_task_others'] = get_option('wpf_tab_permission_delete_task_others');
        $response_array['wpf_tab_permission_user_guest'] = get_option('wpf_tab_permission_user_guest');
        $response_array['wpf_tab_permission_priority_guest'] = get_option('wpf_tab_permission_priority_guest');
        $response_array['wpf_tab_permission_status_guest'] = get_option('wpf_tab_permission_status_guest');
        $response_array['wpf_tab_permission_screenshot_guest'] = get_option('wpf_tab_permission_screenshot_guest');
        $response_array['wpf_tab_permission_information_guest'] = get_option('wpf_tab_permission_information_guest');
        $response_array['wpf_tab_permission_delete_task_guest'] = get_option('wpf_tab_permission_delete_task_guest');

        $response_array['wpf_color'] = get_option('wpf_color');
        $response_array['wpf_selcted_role'] = get_option('wpf_selcted_role');
        $response_array['wpf_website_developer'] = get_option('wpf_website_developer');
        $response_array['wpf_show_front_stikers'] = get_option('wpf_show_front_stikers');
        $response_array['wpf_customisations_client'] = get_option('wpf_customisations_client');
        $response_array['wpf_customisations_webmaster'] = get_option('wpf_customisations_webmaster');
        $response_array['wpf_customisations_others'] = get_option('wpf_customisations_others');
        $response_array['wpf_from_email'] = get_option('wpf_from_email');
        $response_array['wpf_allow_guest'] = get_option('wpf_allow_guest');
        $response_array['wpf_disable_for_admin'] = get_option('wpf_disable_for_admin');
        $response_array['wpf_website_client'] = get_option('wpf_website_client');

        $wpf_license_key_enc = get_option('wpf_license_key');
        $wpf_license_key = wpf_crypt_key($wpf_license_key_enc,'d');
        $response_array['wpf_license_key'] = $wpf_license_key;

        $response_array['wpf_license'] = get_option('wpf_license');
        $response_array['wpf_license_expires'] = get_option('wpf_license_expires');
        $response_array['wpf_decr_key'] = get_option('wpf_decr_key');
        $response_array['wpf_decr_checksum'] = get_option('wpf_decr_checksum');
        $response_array['wpf_enabled'] = get_option('wpf_enabled');
        $response_array['wpf_font_awesome_script'] = get_option('wpf_font_awesome_script');
        $response_array['wpf_allow_backend_commenting'] = get_option('wpf_allow_backend_commenting');
        $response_array['wpf_more_emails'] = get_option('wpf_more_emails');
        $response_array['wpf_powered_by'] = get_option('wpf_powered_by');
        $response_array['wpf_every_new_task'] = get_option('wpf_every_new_task');
        $response_array['wpf_every_new_comment'] = get_option('wpf_every_new_comment');
        $response_array['wpf_every_new_complete'] = get_option('wpf_every_new_complete');
        $response_array['wpf_every_status_change'] = get_option('wpf_every_status_change');
        $response_array['wpf_daily_report'] = get_option('wpf_daily_report');
        $response_array['wpf_weekly_report'] = get_option('wpf_weekly_report');
        $response_array['wpf_auto_daily_report'] = get_option('wpf_auto_daily_report');
        $response_array['wpf_auto_weekly_report'] = get_option('wpf_auto_weekly_report');
        $response_array['wpf_initial_setup'] = get_option('wpf_initial_setup');
        $response_array['wpf_tutorial_video'] = get_option('wpf_tutorial_video');
        $response_array['wpf_logo'] = get_option('wpf_logo');

        $response = json_encode($response_array);

        $response_signature = hash_hmac('sha256', $response, $wpf_license_key);

        header("response-signature: ".$response_signature);
    }else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_details','wpf_website_details');
add_action('wp_ajax_nopriv_wpf_website_details','wpf_website_details');

function wpf_website_users(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $response = wpf_api_func_get_users();
        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_users','wpf_website_users');
add_action('wp_ajax_nopriv_wpf_website_users','wpf_website_users');

function wpf_website_pages(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $response = wpf_get_page_list('api');
        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_pages','wpf_website_pages');
add_action('wp_ajax_nopriv_wpf_website_pages','wpf_website_pages');

function wpf_website_tasks(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $response = wpf_api_func_get_tasks();
        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_tasks','wpf_website_tasks');
add_action('wp_ajax_nopriv_wpf_website_tasks','wpf_website_tasks');

function wpf_website_task_comments(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $response = wpf_api_func_get_task_comments($_REQUEST['wpf_task_id']);
        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_task_comments','wpf_website_task_comments');
add_action('wp_ajax_nopriv_wpf_website_task_comments','wpf_website_task_comments');

function wpf_website_task_update_meta(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $input_json = file_get_contents('php://input');
        $input = json_decode($input_json);
        $task_id = $input->task_id;

        switch ($input->method){
            case 'notify_users':
                $task_notify_users = $input->value;
                $response = wpf_api_func_update_task_notify_users($task_id,$task_notify_users);
                break;

            case 'status':
                $task_status = $input->value;
                $response = wpf_api_func_update_task_status($task_id,$task_status);
                break;

            case 'priority':
                $task_priority = $input->value;
                $response = wpf_api_func_update_task_priority($task_id,$task_priority);
                break;

            case 'new_comment':
                $author_name = $input->author_name;
                $author_id = $input->author_id;
                $message = $input->value;
                $response = wpf_api_func_task_new_comment($task_id,$author_name,$author_id,$message);
                break;

            case 'task_title':
                $new_title = $input->value;

                if (!empty($new_title) && $task_id !=''){
                    $my_post = array(
                        'ID' =>  $task_id,
                        'post_title'    => $new_title
                    );
                    $task_id = wp_update_post( $my_post );
                    if($task_id){
                        $response['status'] = 1;
                    }else{
                        $response['status'] = 0;
                    }
                }
                else{
                    $response['status'] = 0;
                }
                $response = json_encode($response);
                break;

            case 'update_tags':
                $tag = $input->value;

                $wpf_tag_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tag)));
                $wpf_task_tag_info['wpf_task_tag_slug'] = $wpf_tag_slug;
                $wpf_task_tags_obj = get_the_terms( $task_id, 'wpf_tag' );
                if ( ! empty( $wpf_task_tags_obj ) && ! is_wp_error( $wpf_task_tags_obj ) ) {
                    $task_list_tags_array = wp_list_pluck($wpf_task_tags_obj, 'slug');
                }
                if(in_array($wpf_tag_slug, $task_list_tags_array)){
                    $response['wpf_task_tag_name'] = $tag;
                    $response['wpf_msg'] = 0;
                    $response['wpf_tag_type'] = 'already_exit';
                }
                else{
                    $wpf_term = term_exists( $wpf_tag_slug, 'wpf_tag' );
                    if ( $wpf_term !== 0 && $wpf_term !== null ) {
                        $wpf_term = wp_set_object_terms($task_id, $wpf_tag_slug, 'wpf_tag', true);
                        if($wpf_term) {
                            $response['wpf_task_tag_name'] = $tag;
                            $response['wpf_task_tag_slug'] = $wpf_tag_slug;
                        } else {
                            $response['wpf_msg'] = 0;
                        }
                    }else{
                        $wpf_term = wp_set_object_terms($task_id, $tag, 'wpf_tag', true);
                        if($wpf_term) {
                            $response['wpf_task_tag_slug'] = $wpf_tag_slug;
                            $response['wpf_task_tag_name'] = $tag;
                        } else {
                            $response['wpf_msg'] = 0;
                        }
                    }
                }
                $response = json_encode($response);
                break;

            case 'delete_tags':
                $wpf_task_tag_slug = $input->slug;

                if($wpf_task_tag_slug !='' && $task_id != ''){
                    $wpf_delete_term =  wp_remove_object_terms($task_id,$wpf_task_tag_slug,'wpf_tag');
                    if($wpf_delete_term){
                        $response['wpf_task_tag_slug'] = $wpf_task_tag_slug;
                        $response['wpf_task_id'] = $task_id;
                        $response['wpf_msg'] = 1;
                    }else{
                        $response['wpf_msg'] = 0;
                    }
                }else{
                    $response['wpf_msg'] = 0;
                }
                $response = json_encode($response);
                break;

            default:
                echo 0;
        }

        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_task_update_meta','wpf_website_task_update_meta');
add_action('wp_ajax_nopriv_wpf_website_task_update_meta','wpf_website_task_update_meta');

function wpf_website_delete_task(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $input_json = file_get_contents('php://input');
        $input = json_decode($input_json);
        $task_id = $input->task_id;
        if(wp_delete_post($task_id)){
            $response = 1;
        }
        else{
            $response = 0;
        }
        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_delete_task','wpf_website_delete_task');
add_action('wp_ajax_nopriv_wpf_website_delete_task','wpf_website_delete_task');

function wpf_website_new_general_task(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $input_json = file_get_contents('php://input');
        $task_info = json_decode($input_json);

        $response = wpf_api_func_task_new_general_task($task_info);

        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_new_general_task','wpf_website_new_general_task');
add_action('wp_ajax_nopriv_wpf_website_new_general_task','wpf_website_new_general_task');

function wpf_website_update_general_setting(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $wpf_global_settings = get_option('wpf_global_settings');
        if($wpf_global_settings=='yes'){
            $input_json = file_get_contents('php://input');
            $task_info = json_decode($input_json);

            $response = wpf_api_update_single_general_settings($task_info);
        }
        else{
            $response = 'Global settings not enabled';
        }

        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_update_general_setting','wpf_website_update_general_setting');
add_action('wp_ajax_nopriv_wpf_website_update_general_setting','wpf_website_update_general_setting');


function wpf_website_resync(){
    $valid = wpf_api_request_verification();

    if($valid==1){
        $wpf_license_key_enc = get_option('wpf_license_key');
        $wpf_license_key = wpf_crypt_key($wpf_license_key_enc,'d');
        $response = wpf_initial_sync($wpf_license_key);

        $response_signature = wpf_generate_response_signature($response);
        header("response-signature: ".$response_signature);
    }
    else{
        $response = 'invalid request';
    }
    echo $response; exit;
}
add_action('wp_ajax_wpf_website_resync','wpf_website_resync');
add_action('wp_ajax_nopriv_wpf_website_resync','wpf_website_resync');

/*
 * Support functions start here
 */
function wpf_api_request_verification(){
    $response = 0;
    $request_reference = $_SERVER['HTTP_REQUEST_REFERENCE'];
    $request_signature = $_SERVER['HTTP_REQUEST_SIGNATURE'];

    $wpf_license_key_enc = get_option('wpf_license_key');
    $wpf_license_key = wpf_crypt_key($wpf_license_key_enc,'d');

    if ($request_signature == hash_hmac('sha256', $request_reference, $wpf_license_key)) {
        $response = 1;
    }

    return $response;
}

function wpf_api_func_get_users()
{
    $response = array();
    $all_role_cs = get_option('wpf_selcted_role');
    $wpf_website_developer = get_option('wpf_website_developer');
    $all_role_array = explode(",", $all_role_cs);
    if (!empty($all_role_array) && !is_wp_error($all_role_array)) {
        $wpfb_users = get_users(['role__in' => $all_role_array]);
        $wpf_temp_count=0;
        foreach ($wpfb_users as $user) {
            if($user->ID==$wpf_website_developer){
                $response[$wpf_temp_count]['is_admin'] = 1;
            }
            else{
                $response[$wpf_temp_count]['is_admin'] = 0;
            }
            $response[$wpf_temp_count]['wpf_id'] = $user->ID;
            $response[$wpf_temp_count]['wpf_display_name'] = htmlspecialchars($user->display_name, ENT_QUOTES, 'UTF-8');
            $response[$wpf_temp_count]['wpf_email'] = $user->user_email;
            if($user->ID==$wpf_website_developer){
                $response[$wpf_temp_count]['is_admin']=1;
            }
            else{
                $response[$wpf_temp_count]['is_admin']=0;
            }
            $wpf_temp_count++;
        }
    }
    return json_encode($response);
}

function wpf_api_func_get_tasks(){
    $response = array();
    $args = array(
        'post_type'   => 'wpfeedback',
        'numberposts' => -1,
        'post_status' => array('publish','wpf_admin'),
        'orderby'    => 'date',
        'order'       => 'DESC'
    );
    $wpfb_tasks = get_posts( $args );
    $wpf_temp_count=0;
    foreach ($wpfb_tasks as $wpfb_task) {
        $task_date = get_the_time('Y-m-d H:i:s', $wpfb_task->ID);
        $metas = get_post_meta($wpfb_task->ID);
        $task_priority = get_the_terms($wpfb_task->ID, 'task_priority');
        $task_status = get_the_terms($wpfb_task->ID, 'task_status');
        $response[$wpf_temp_count]['wpf_task_id']=$wpfb_task->ID;
        $response[$wpf_temp_count]['wpf_task_url']=wpf_api_func_get_task_url($wpfb_task->ID);
        if($wpfb_task->post_status=='wpf_admin'){
            $response[$wpf_temp_count]['is_admin_task']=1;
        }
        else{
            $response[$wpf_temp_count]['is_admin_task']=0;
        }
        foreach ($metas as $key => $value) {
            $response[$wpf_temp_count][$key]=$value[0];
            $response[$wpf_temp_count]['task_priority']=$task_priority[0]->slug;
            $response[$wpf_temp_count]['task_status']=$task_status[0]->slug;

            $task_date1 = date_create($task_date);
            $wpf_wp_current_timestamp = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
            $task_date2 = date_create($wpf_wp_current_timestamp);


            $curr_comment_time = wpfb_time_difference($task_date1,$task_date2);

            $response[$wpf_temp_count]['task_time']=$task_date;
        }
        $task_tags = get_the_terms( $wpfb_task->ID, 'wpf_tag' );
        $temp_tag_counter=0;
        foreach ($task_tags as $task_tag => $task_tags_value) {
            $response[$wpf_temp_count]['wpf_tags'][$temp_tag_counter]['slug']=$task_tags_value->slug;
            $response[$wpf_temp_count]['wpf_tags'][$temp_tag_counter]['name']=$task_tags_value->name;
            $temp_tag_counter++;
        }

        $comments_args = array(
            'post_id' => $wpfb_task->ID,
            'type' => 'wp_feedback'
        );
        $comments_info = get_comments( $comments_args );
        foreach ($comments_info as $comment){
            if($comment->comment_date_gmt=='0000-00-00 00:00:00'){
                $comment->comment_date_gmt = get_gmt_from_date($comment->comment_date);
            }
            $comment->comment_type = wpf_api_func_get_comment_type($comment);
        }
        $response[$wpf_temp_count]['comments'] = $comments_info;

        $wpf_temp_count++;
    }

    return json_encode($response);
}

function wpf_api_func_get_task_comments($task_id){
    $comments_args = array(
        'post_id' => $task_id,
        'type' => 'wp_feedback'
    );
    $comments_info = get_comments( $comments_args );
    foreach ($comments_info as $comment){
        if($comment->comment_date_gmt=='0000-00-00 00:00:00'){
            $comment->comment_date_gmt = get_gmt_from_date($comment->comment_date);
        }
        $comment->comment_type = wpf_api_func_get_comment_type($comment);
    }

    return json_encode($comments_info);
}

function wpf_api_func_update_task_notify_users($task_id,$task_notify_users){
    $task_notify_users = filter_var($task_notify_users,FILTER_SANITIZE_STRING);
    if (update_post_meta($task_id, 'task_notify_users', $task_notify_users)) {
        $response = 1;
    } else {
        $response = 0;
    }

    return $response;
}

function wpf_api_func_update_task_status($task_id,$task_status){
    $wpf_every_status_change = get_option('wpf_every_status_change');
    $wpf_every_new_complete = get_option('wpf_every_new_complete');
    $wpf_task_notify_users = get_option('task_notify_users');

    if (wp_set_object_terms($task_id, $task_status, 'task_status', false)) {
        if ($task_status == 'complete' && $wpf_every_new_complete == 'yes') {
            wpf_send_email_notification($task_id, 0, $wpf_task_notify_users, 'task_completed');
        } else {
            if ($wpf_every_status_change == 'yes') {
                wpf_send_email_notification($task_id, 0, $wpf_task_notify_users, 'task_status_changed');
            }
        }
        $response = 1;
    } else {
        $response = 0;
    }

    return $response;
}

function wpf_api_func_update_task_priority($task_id,$task_priority){
    if (wp_set_object_terms($task_id, $task_priority, 'task_priority', false)) {
        $response = 1;
    } else {
        $response = 0;
    }
    return $response;
}

function wpf_api_func_task_new_comment($task_id,$author_name,$author_id,$message){
    global $wpdb;

    $enabled_wpfeedback = wpf_check_if_enable($author_id);
    $wpf_every_new_comment = get_option('wpf_every_new_comment');
    $task_notify_users = get_post_meta($task_id,'task_notify_users',true);
    if($enabled_wpfeedback == 1){
        $comment_time = date('Y-m-d H:i:s', current_time('timestamp', 0));
        $task_comment_message = wpf_test_input($message);
        $commentdata = array(
            'comment_post_ID' => $task_id,
            'comment_author' => $author_name,
            'comment_author_email' => '',
            'comment_author_url' => '',
            'comment_content' => $task_comment_message,
            'comment_type' => 'wp_feedback',
            'comment_parent' => 0,
            'user_id' => $author_id,
            'comment_date' => $comment_time
        );

        $comment_id = $wpdb->insert("{$wpdb->prefix}comments", $commentdata);
        $comment_id = $wpdb->insert_id;
        if ($wpf_every_new_comment == 'yes') {
            wpf_send_email_notification($task_id, $comment_id, $task_notify_users, 'new_reply');
        }
        $response = json_encode(array('comment_ID'=>$comment_id));
    }else{
        $response = 0;
    }

    return $response;
}

function wpf_api_func_get_task_url($task_id){
    $task_page_url = get_post_meta($task_id, 'task_page_url', true);
    $task_type = get_post_meta($task_id, 'task_type', true);
    $task_comment_id = get_post_meta($task_id, 'task_comment_id', true);
    if($task_type=='general'){
        if (strpos($task_page_url,'wpf_taskid') !== false) {
            $filter_task_page_url = explode("?wpf_taskid", $task_page_url, 2);
            $task_page_url = $filter_task_page_url[0];
            $task_reply_url = $task_page_url . '?wpf_general_taskid=' . $task_id.'&wpf_login=1';
        } else {
            $task_reply_url = $task_page_url . '?wpf_general_taskid=' . $task_id.'&wpf_login=1';
        }

    }
    else{
        if (strpos($task_page_url,'wpf_general_taskid') !== false) {
            $filter_task_page_url = explode("?wpf_general_taskid", $task_page_url, 2);
            $task_page_url = $filter_task_page_url[0];
            $task_reply_url = $task_page_url . '?wpf_taskid=' . $task_id.'&wpf_login=1';
        } else {
            $task_reply_url = $task_page_url . '?wpf_taskid=' . $task_comment_id.'&wpf_login=1';
        }

    }

    return $task_reply_url;
}

function wpf_api_func_get_comment_type($comment){
    if (strpos($comment->comment_content, 'wp-content/uploads') !== false) {
        $temp_filetype = wp_check_filetype($comment->comment_content);
        if ($temp_filetype['type'] == 'image/png' || $temp_filetype['type'] == 'image/gif' || $temp_filetype['type'] == 'image/jpeg') {
            $comment_type = 'image';

        } else {
            $comment_type = 'file';

        }
    }
    else if (wp_http_validate_url($comment->comment_content) && !strpos($comment->comment_content, 'wp-content/uploads')) {
        $idVideo = $comment->comment_content;
        $link = explode("?v=",$idVideo);
        if ($link[0] == 'https://www.youtube.com/watch') {
            $youtubeUrl = "http://www.youtube.com/oembed?url=$idVideo&format=json";
            $docHead = get_headers($youtubeUrl);
            if (substr($docHead[0], 9, 3) !== "404") {
                $comment_type = 'youtube_video';
            }
            else {
                $comment_type = 'normal_text';
            }
        }else{
            $comment_type = 'normal_text';
        }
    }
    else {
        $comment_type = 'normal_text';
    }

    return $comment_type;
}

function wpf_api_func_task_new_general_task($task_info){
    global $wpdb;

    $current_user = get_userdata(get_option('wpf_website_developer'));
    $user_id = $current_user->ID;

//    Old logic to count latest task bubble number, was changed after the delete task feature was introduced
//    $comment_count_obj = wp_count_posts('wpfeedback');
//    $comment_count = $comment_count_obj->publish+1;

//    New logic to count latest task bubble number
    $table = $wpdb->prefix . 'postmeta';
    $latest_count = $wpdb->get_results("SELECT meta_value FROM $table WHERE meta_key = 'task_comment_id' ORDER BY meta_id DESC LIMIT 1 ");
    $comment_count = $latest_count[0]->meta_value + 1;

    $wpf_every_new_task = get_option('wpf_every_new_task');
    $task_data = (array)$task_info;

    foreach ($task_data as $key=>$val){
        $task_data[$key]=filter_var($val,FILTER_SANITIZE_STRING);
    }

    if ($task_data['task_page_title'] == '') {
        $task_data['task_page_title'] = get_the_title($task_data['current_page_id']);
    }
    if ($task_data['task_page_url'] == '') {
        $task_data['task_page_url'] = $current_page_url = get_permalink($task_data['current_page_id']);
    }

    if ($task_data['wpf_current_screen'] != '') {
        $wpf_current_screen = $task_data['wpf_current_screen'];
        $post_status = 'wpf_admin';
    } else {
        $wpf_current_screen = '';
        $post_status = 'publish';
    }

    $new_task = array(
        'post_content' => '',
        'post_status' => $post_status,
        'post_title' => stripslashes(html_entity_decode($task_data['task_title'], ENT_QUOTES, 'UTF-8')),
        'post_type' => 'wpfeedback',
        'post_author' => $user_id,
        'post_parent' => $task_data['current_page_id']
    );
    $task_id = wp_insert_post($new_task);

    add_post_meta($task_id, 'task_config_author_browser', $task_data['task_config_author_browser']);
    add_post_meta($task_id, 'task_config_author_browserVersion', $task_data['task_config_author_browserVersion']);
    add_post_meta($task_id, 'task_config_author_browserOS', $task_data['task_config_author_browserOS']);
    add_post_meta($task_id, 'task_config_author_ipaddress', $task_data['task_config_author_ipaddress']);
    add_post_meta($task_id, 'task_config_author_name', $task_data['task_config_author_name']);
    add_post_meta($task_id, 'task_config_author_id', $user_id);
    add_post_meta($task_id, 'task_config_author_resX', $task_data['task_config_author_resX']);
    add_post_meta($task_id, 'task_config_author_resY', $task_data['task_config_author_resY']);
    add_post_meta($task_id, 'task_title', $task_data['task_title']);
    add_post_meta($task_id, 'task_page_url', $task_data['task_page_url']);
    add_post_meta($task_id, 'task_page_title', $task_data['task_page_title']);
    add_post_meta($task_id, 'task_comment_message', $task_data['task_comment_message']);
    add_post_meta($task_id, 'task_element_path', $task_data['task_element_path']);
    add_post_meta($task_id, 'wpfb_task_bubble', $task_data['task_clean_dom_elem_path']);
    add_post_meta($task_id, 'task_element_html', $task_data['task_element_html']);
    add_post_meta($task_id, 'task_X', $task_data['task_X']);
    add_post_meta($task_id, 'task_Y', $task_data['task_Y']);
    add_post_meta($task_id, 'task_elementX', $task_data['task_elementX']);
    add_post_meta($task_id, 'task_elementY', $task_data['task_elementY']);
    add_post_meta($task_id, 'task_relativeX', $task_data['task_relativeX']);
    add_post_meta($task_id, 'task_relativeY', $task_data['task_relativeY']);
    add_post_meta($task_id, 'task_notify_users', $task_data['task_notify_users']);
    add_post_meta($task_id, 'task_element_height', $task_data['task_element_height']);
    add_post_meta($task_id, 'task_element_width', $task_data['task_element_width']);
    add_post_meta($task_id, 'task_comment_id', $comment_count);
    add_post_meta($task_id, 'task_type', $task_data['task_type']);
    add_post_meta($task_id, 'task_top', $task_data['task_top']);
    add_post_meta($task_id, 'task_left', $task_data['task_left']);

    if ($wpf_current_screen != '') {
        add_post_meta($task_id, 'wpf_current_screen', $wpf_current_screen);
    }

    wp_set_object_terms($task_id, $task_data['task_status'], 'task_status', true);
    wp_set_object_terms($task_id, $task_data['task_priority'], 'task_priority', true);

    $task_comment_message = wpf_test_input($task_data['task_comment_message']);

    /*$comment_time = date('Y-m-d H:i:s', current_time('timestamp', 0));
    $commentdata = array(
        'comment_post_ID' => $task_id,
        'comment_author' => $task_data['task_config_author_name'],
        'comment_author_email' => '',
        'comment_author_url' => '',
        'comment_content' => stripslashes(html_entity_decode($task_comment_message, ENT_QUOTES, 'UTF-8')),
        'comment_type' => 'wp_feedback',
        'comment_parent' => 0,
        'user_id' => $user_id,
        'comment_date' => $comment_time
    );
    $comment_id = $wpdb->insert("{$wpdb->prefix}comments", $commentdata);*/
    if ($wpf_every_new_task == 'yes') {
        wpf_send_email_notification($task_id, $comment_id=0, $task_data['task_notify_users'], 'new_task');
    }

    $response = array();
    $response['task_id']=$task_id;
    $response['task_page_url']=$task_data['task_page_url'];
    $response['task_comment_id']=$comment_count;
    $response['wpf_task_url']=wpf_api_func_get_task_url($task_id);
    $response['task_comment_message']=$task_comment_message;
    $response['wpfb_task_bubble']='';
    return json_encode($response);
}

/*
 * Functions to update CRM
 */

function wpf_crm_update_notify_users($task_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='notify_users';
    $data['task_id']=$task_info['task_id'];
    $data['value']=$task_info['task_notify_users'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_update_notify_users_action','wpf_crm_update_notify_users');

function wpf_crm_update_task_status($task_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='status';
    $data['task_id']=$task_info['task_id'];
    $data['value']=$task_info['task_status'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_update_task_status_action','wpf_crm_update_task_status');

function wpf_crm_update_task_priority($task_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='priority';
    $data['task_id']=$task_info['task_id'];
    $data['value']=$task_info['task_priority'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_update_task_priority_action','wpf_crm_update_task_priority');

function wpf_crm_update_task_tags($wpf_task_tag_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='wpf_tags';
    $data['action']='add_tags';
    $data['task_id']=$wpf_task_tag_info['wpf_task_id'];
    $data['wpf_task_tag_name']=$wpf_task_tag_info['wpf_task_tag_name'];
    $data['wpf_task_tag_slug']=$wpf_task_tag_info['wpf_task_tag_name'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_update_tag_action','wpf_crm_update_task_tags');


function wpf_crm_delete_task_tags($wpf_task_tag_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='wpf_tags';
    $data['action']='delete_tags';
    $data['task_id']=$wpf_task_tag_info['wpf_task_id'];
    $data['wpf_task_tag_name']=$wpf_task_tag_info['wpf_task_tag_name'];
    $data['wpf_task_tag_slug']=$wpf_task_tag_info['wpf_task_tag_slug'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_delete_task_tags_action','wpf_crm_delete_task_tags');


function wpf_crm_new_comment($comment_id){
    $url = WPF_CRM_API.'wp-api/comment/store';
    $new_comment = get_comment($comment_id);
    if($new_comment->comment_date_gmt=='0000-00-00 00:00:00'){
        $new_comment->comment_date_gmt = get_gmt_from_date($new_comment->comment_date);
    }
    $new_comment->comment_type = wpf_api_func_get_comment_type($new_comment);
    $new_comment->task_id = $new_comment->comment_post_ID;
    $response = json_encode($new_comment);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_new_comment_action','wpf_crm_new_comment');

function wpf_crm_new_task($task_id){
    $url = WPF_CRM_API.'wp-api/task/store-task-from-wp';

    $task_date = get_the_time('Y-m-d H:i:s', $task_id);
    $metas = get_post_meta($task_id);
    $task_priority = get_the_terms($task_id, 'task_priority');
    $task_status = get_the_terms($task_id, 'task_status');
    $wpf_site_id = get_option('wpf_site_id');
    $response['wpf_site_id']=$wpf_site_id;
    $response['wpf_task_id']=$task_id;
    $response['wpf_task_url']=wpf_api_func_get_task_url($task_id);
    if($task_id=='wpf_admin'){
        $response['is_admin_task']=1;
    }
    else{
        $response['is_admin_task']=0;
    }
    foreach ($metas as $key => $value) {
        $response[$key]=$value[0];
        $response['task_priority']=$task_priority[0]->slug;
        $response['task_status']=$task_status[0]->slug;

        $task_date1 = date_create($task_date);
        $wpf_wp_current_timestamp = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
        $task_date2 = date_create($wpf_wp_current_timestamp);


        $curr_comment_time = wpfb_time_difference($task_date1,$task_date2);

        $response['task_time']=$task_date;
    }

    $comments_args = array(
        'post_id' => $task_id,
        'type' => 'wp_feedback'
    );
    $comments_info = get_comments( $comments_args );
    foreach ($comments_info as $comment){
        if($comment->comment_date_gmt=='0000-00-00 00:00:00'){
            $comment->comment_date_gmt = get_gmt_from_date($comment->comment_date);
        }
        $comment->comment_type = wpf_api_func_get_comment_type($comment);
    }
    $response['comments'] = $comments_info;
    $response = json_encode($response);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_new_task_action','wpf_crm_new_task');

function wpf_crm_delete_post($pid){
    $url = WPF_CRM_API.'wp-api/task/delete-task';
    $response = array();
    $post = get_post($pid);
    if($post->post_type=='wpfeedback'){
        $response['wpf_site_id']=get_option('wpf_site_id');
        $response['wpf_task_id']=$pid;
        $response = json_encode($response);
        wpf_send_remote_post($url,$response);
    }
}
add_action( 'delete_post', 'wpf_crm_delete_post', 10 );

function wpf_crm_add_page_post( $new_status, $old_status, $post ) {
    $url = WPF_CRM_API.'wp-api/site/store-page';

    if ( class_exists( 'WooCommerce' ) ) {
        $wpf_default_wp_post_types = array("page" => "page", "post" => "post", "product" => "product");
    }else {
        $wpf_default_wp_post_types = array("page" => "page", "post" => "post");
    }

    $wpf_wp_cpts = get_post_types(array('public' => true, 'exclude_from_search' => true, '_builtin' => false));
    $wpf_post_types = array_merge($wpf_default_wp_post_types, $wpf_wp_cpts);

    if ( $new_status != $old_status && in_array($post->post_type,$wpf_post_types) ) {
        $response = array();
        $response['wpf_site_id']=get_option('wpf_site_id');
        $response['id']=$post->ID;
        $response['name']=htmlspecialchars($post->post_title, ENT_QUOTES, 'UTF-8');
        $response['type']=$post->post_type;
        $response = json_encode($response);
        wpf_send_remote_post($url,$response);
    }
}
add_action(  'transition_post_status',  'wpf_crm_add_page_post', 10, 3 );

function wpf_crm_update_task_title($task_info){
    $url = WPF_CRM_API.'wp-api/task/update-task-details';

    $data['method']='task_title';
    $data['task_id']=$task_info['wpf_task_id'];
    $data['value']=$task_info['wpf_new_task_title'];
    $data['from_wp']=1;
    $response = json_encode($data);
    wpf_send_remote_post($url,$response);
}
add_action('wpf_crm_update_task_title_action','wpf_crm_update_task_title');

function wpf_autologin_api_hook() {
    register_rest_route(
        'wpf_api', '/wpf_autologin/',
        array(
            'methods'  => 'GET',
            'callback' => 'wpf_autologin',
        )
    );
}
add_action( 'rest_api_init', 'wpf_autologin_api_hook' );

add_action( 'init', 'wpf_autologin_init_hook' );

function wpf_autologin_init_hook(){
    if(isset($_GET['wpf_token'])){
        $wpf_token_request = array();
        $wpf_token_request = array_merge($_GET,$_SERVER);
        wpf_autologin($wpf_token_request);
    }
}

function wpf_autologin($request){
    $url = WPF_CRM_API.'wp-api/user/verify-access';
    $response = array();

    $response['wpf_site_id']=get_option('wpf_site_id');
    $response = json_encode($response);

    $res = wpf_send_remote_post($url,$response,$request['wpf_token']);
    $res_body = json_decode($res['body']);
    if($res_body->status===true){
        $user = get_user_by('email', $request['wpf_username']);
        if ( !is_wp_error( $user ) )
        {
            wp_clear_auth_cookie();
            wp_set_current_user ( $user->ID );
            wp_set_auth_cookie  ( $user->ID );

            $wpf_open_url_arr = explode('&wpf_login', $request['REQUEST_URI']);
            $redirect_to = site_url().$wpf_open_url_arr[0];
            wp_safe_redirect( $redirect_to );
            exit();
        }else{
            $redirect_to = user_admin_url();
            wp_safe_redirect( $redirect_to );
            exit();
        }
    }else{
        $redirect_to = user_admin_url();
        wp_safe_redirect( $redirect_to );
        exit;
    }
}

/*
 * General Functions
 */
add_action('wpf_initial_sync','wpf_initial_sync',1);
function wpf_initial_sync($wpf_license_key){
    $url = WPF_CRM_API.'wp-api/site/store';
    $response = array();

    $response['license_key']=$wpf_license_key;
    $response['wpf_site_id']=get_option('wpf_site_id');
    $response['url']=WPF_SITE_URL;
    $response['name']=get_option('blogname');

    $response['image']='';
    $response['favicon']='';
    $response['from_plugin']=1;

    $body = json_encode($response);

    $res = wpf_send_remote_post($url,$body);
    $msg = json_decode($res['body']);
    if($msg->status==false){
        update_option('wpf_initial_sync',2,'no');
        $res=0;
    }
    else{
        $res=1;
    }
    return $res;
}

function wpf_get_global_settings(){
    $url = WPF_CRM_API.'wp-api/user/global-settings';
    $response = array();

    $response['wpf_site_id']=get_option('wpf_site_id');

    $body = json_encode($response);

    $res = wpf_send_remote_post($url,$body);
    $settings_arr = json_decode($res['body']);
    if($settings_arr->status == true){
        wpf_api_update_general_settings($settings_arr->data);
        return 1;
    }else{
        return 0;
    }
}

function wpf_api_update_single_general_settings($settings){
    $response = [];
    foreach ($settings as $key=>$val){
        if($val==1){
            $val = "yes";
        }
        if($key=='wpfeedback_logo'){
            $key = 'wpf_logo';
            $attach_id = wpf_upload_logo_from_dashboard($val);
            $val = $attach_id;
        }
        elseif ($key=='wpfeedback_color'){
            $key = 'wpf_color';
            $val = str_replace('#','',$val);
        }
        elseif ($key=='wpfeedback_powered_by'){
            $key = 'wpf_powered_by';
        }
        elseif ($key=='wpfeedback_more_emails'){
            $key = 'wpf_more_emails';
        }
        else{
            $key = $key;
        }
        if(update_option($key,$val,'no')){
            $response[] = 1;
        }
        else{
            $response[] = 0;
        }
    }
    return json_encode($response);
}

function wpf_api_update_general_settings($settings){
    foreach ($settings->general_setting as $general_setting){
        if($general_setting->value==1){
            $temp_val = "yes";
        }
        else{
            $temp_val = "";
        }
        if($general_setting->key=='wpfeedback_font_awesome_script'){
            $general_setting->key = 'wpf_font_awesome_script';
        }
        update_option($general_setting->key,$temp_val,'no');
    }
    foreach ($settings->white_label as $key=>$val){
        if($key == 'wpfeedback_powered_by'){
            if($val->value==1){
                $temp_val = "yes";
            }
            else{
                $temp_val = "";
            }
            update_option('wpf_powered_by',$temp_val,'no');
        }
        else{
            if($key=='wpfeedback_logo'){
                $key='wpf_logo';
                $attach_id = wpf_upload_logo_from_dashboard($val);
                $val = $attach_id;
            }
            if($key=='wpfeedback_color'){
                $key='wpf_color';
                $val = str_replace('#','',$val);
            }
            update_option($key,$val,'no');
        }
    }
    foreach ($settings->notification_setting as $key=>$val){
        if($key == 'email_notification'){
            foreach ($val as $notification){
                if($notification->value==1){
                    $temp_val = "yes";
                }
                else{
                    $temp_val = "";
                }
                update_option($notification->key,$temp_val,'no');
            }
        }
        else if($key == 'wpfeedback_more_emails'){
            update_option('wpf_more_emails',$val,'no');
        }
        else{
            update_option($key,$val,'no');
        }

    }
}

function wpf_upload_logo_from_dashboard($image_url, $parent_id=''){
    $image = $image_url;

    $get = wp_remote_get( $image );

    $type = wp_remote_retrieve_header( $get, 'content-type' );

    if (!$type)
        return false;

    $mirror = wp_upload_bits( basename( $image ), '', wp_remote_retrieve_body( $get ) );

    $attachment = array(
        'post_title'=> basename( $image ),
        'post_mime_type' => $type
    );

    $attach_id = wp_insert_attachment( $attachment, $mirror['file'], $parent_id );

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attach_data = wp_generate_attachment_metadata( $attach_id, $mirror['file'] );

    wp_update_attachment_metadata( $attach_id, $attach_data );

    return $attach_id;
}

function wpf_generate_response_signature($response){
    $wpf_license_key_enc = get_option('wpf_license_key');
    $wpf_license_key = wpf_crypt_key($wpf_license_key_enc,'d');
    $response_signature = hash_hmac('sha256', $response, $wpf_license_key);

    return $response_signature;
}

function wpf_send_remote_post($url,$response,$wpf_token=''){
    $response_signature = wpf_generate_response_signature($response);
    if($wpf_token==''){
        $header = array('Content-Type' => 'application/json; charset=utf-8','response-signature'=>$response_signature);
    }else{
        $header = array('Content-Type' => 'application/json; charset=utf-8','response-signature'=>$response_signature, 'Authorization'=>'Bearer '.$wpf_token);
    }

    $args = array(
        'headers'     => $header,
        'body'        => $response,
        'method'      => 'POST',
        'data_format' => 'body',
    );
    $response = wp_remote_post($url,$args);
    return $response;
}