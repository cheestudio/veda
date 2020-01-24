<?php
global $current_user;
if($current_user->display_name==''){
    $wpf_user_name = $current_user->user_nicename;
}
else{
    $wpf_user_name = $current_user->display_name;
}
$wpf_get_user_type = esc_attr(get_the_author_meta('wpf_user_type', $current_user_id));
?>
<div class="wpf_wizard_container">
    <div class="wpf_wizard_modal">
        <div class="wpf_loader wpf_loader_wizard wpf_hide"></div>

        <div id="wpf_wizard_role" class="wpf_wizard_page <?php if($wpf_get_user_type!=''){ echo "wpf_hide"; }?>">
            <div class="wpf_wizard_title"><?php _e("Hi ","wpfeedback"); echo $wpf_user_name; _e(", Let's give feedback","wpfeedback");?></div>
            <p><?php _e("To optimize your experience, which one describes you best?","wpfeedback"); ?></p>
            <div class="wpf_wizard_user">
                <input type="radio" name="wpf_user_type" value="king" class="wpf_user_type wpf_hide"
                       id="king" <?php if ($wpf_get_user_type == 'king') {
                    echo 'checked';
                } ?>>
                <label for="king" id="wpf_wizard_king" class="wpf_wizard_choice">
                    <img alt="" src="<?php echo WPF_PLUGIN_URL; ?>images/wpfeedback-client.png"/>
                    <div class="wpf_wizard_choice_title"><?php echo get_option('wpf_customisations_client')?get_option('wpf_customisations_client'):'Client (Website Owner)'; ?></div>
                </label>
                <input type="radio" name="wpf_user_type" value="advisor" class="wpf_user_type wpf_hide"
                       id="advisor" <?php if ($wpf_get_user_type == 'advisor') {
                    echo 'checked';
                } ?>>
                <label for="advisor" id="wpf_wizard_advisor" class="wpf_wizard_choice">
                    <img alt="" src="<?php echo WPF_PLUGIN_URL; ?>images/wpfeedback-webmaster.png"/>
                    <div class="wpf_wizard_choice_title"><?php echo get_option('wpf_customisations_webmaster')?get_option('wpf_customisations_webmaster'):'Webmaster'; ?></div>
                </label>

                <input type="radio" name="wpf_user_type" value="council" class="wp_feedback_task wpf_hide"
                       id="council" <?php if ($wpf_get_user_type == 'council') {
                    echo 'checked';
                } ?>>
                <label for="council" id="wpf_wizard_council" class="wpf_wizard_choice">
                    <img alt="" src="<?php echo WPF_PLUGIN_URL; ?>images/wpfeedback-others.png"/>
                    <div class="wpf_wizard_choice_title"><?php echo get_option('wpf_customisations_others')?get_option('wpf_customisations_others'):'Others'; ?></div>
                </label>
            </div>
            <p style="color:red;" class="wpf_hide wpf_wizard_error"><?php _e("Please select anyone","wpfeedback"); ?></p>
        </div>
        <div id="wpf_wizard_notifications" class="wpf_wizard_page <?php if($wpf_get_user_type==''){ echo "wpf_hide"; }?>">
            <div class="wpf_wizard_title"><?php _e("Notifications","wpfeedback"); ?></div>
            <p><?php _e("Choose the emails you'd like to receive (Recommended to keep as is)",'wpfeedback'); ?></p>
             <div class="wpf_wizard_notifications_check"><?php
            $notifications_html = wpf_get_allowed_notification_list($current_user->ID,'yes');
            echo $notifications_html;
				 ?></div>
            <btn href="javascript:void(0);" class="wpf_wizard_button" id="wpf_wizard_notifications_button"><?php _e("One Last Step","wpfeedback"); ?>
            </btn>
        </div>
        <div id="wpf_wizard_final" class="wpf_wizard_page wpf_hide">
            <div class="wpf_wizard_title"><?php _e("How to give feedback","wpfeedback"); ?></div>
            <p><?php _e("Watch this short tutorial to get started","wpfeedback"); ?></p>
            <?php
                if(get_option('wpf_tutorial_video')=='') {
                    ?>
                    <script src="https://fast.wistia.com/embed/medias/cided37ieu.jsonp" async></script>
                    <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
                    <div class="wistia_responsive_padding" style="padding:48.75% 0 0 0;position:relative;">
                        <div class="wistia_responsive_wrapper"
                             style="height:100%;left:0;position:absolute;top:0;width:100%;">
                            <div class="wistia_embed wistia_async_cided37ieu videoFoam=true"
                                 style="height:100%;position:relative;width:100%">
                                <div class="wistia_swatch"
                                     style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;">
                                    <img src="https://fast.wistia.com/embed/medias/cided37ieu/swatch"
                                         style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt=""
                                         onload="this.parentNode.style.opacity=1;"/></div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo html_entity_decode(get_option('wpf_tutorial_video'));
                }
            ?>
            <btn href="javascript:void(0);" class="wpf_wizard_button" id="wpf_wizard_done_button"><?php _e("Let's Start","wpfeedback"); ?></btn>
        </div>
    </div>
</div>