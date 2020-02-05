<?php
$output = '';
        $args = array(
            'numberposts' => -1,
            'post_type' => 'wpf_graphics',
            'post_status' => array('publish'),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        // Get the posts
        $myposts = get_posts($args);
        //echo count($myposts);
         $output .= '<div class="wpf_gen_col" id="all_graphics_list_container"><div  class="wpf_row"><div class="wpf-col-3" id="all_graphics_list"><a href="javascript:wpf_create_graphics_buttons();" class="wpf_create_graphics_post" data-new_graphics=""><div class="wpf_graphics_new"><div class="wpf_graphics_new_title"><i class="fa fa-plus" aria-hidden="true"></i><div class="wpf_graphics_new_title_main">'. __('Create Graphics','wpfeedback').'</div><div class="wpf_graphics_new_title_desc">Upload any image to collaborate visually.<br>This is great for screen mockups, logos, flyers or any other graphic items.</div></div></div></a></div>';
        if ($myposts):
            // Loop the posts
            $i = count($myposts);
            foreach ($myposts as $mypost):
                $post_id = $mypost->ID;
                $post_title = $mypost->post_title;
                $author_id = $mypost->post_author;
                $wpf_complete_graphics = get_post_meta($post_id,'wpf_complete_graphics',true); 
                if($wpf_complete_graphics == 'yes'){
                    $wpf_completed_calss = ' wpf_completed';
                    $wpf_completed_sign = '<span class="wpf_right"><i class="fa fa-check"></i></sapn>';
                }else{
                    $wpf_completed_calss = '';
                    $wpf_completed_sign = '';
                }

                 $output .= '<div class="wpf-col-3"><a target="_blank" href="'.get_permalink($post_id).'"><div class="wpf_graphics_thumb" style="background-image:url('.get_the_post_thumbnail_url($post_id,'large').')"><div class="wpf_graphics_title'.$wpf_completed_calss.'">'.$post_title.$wpf_completed_sign.'</div></div></a></div>';

            endforeach;
            wp_reset_postdata();
           
       /* else:
            $output = '<div class="wpf_no_tasks_found"><i class="fa fa-exclamation-triangle"></i> No tasks found</div>';*/
        endif;
         $output .= '</div></div>';
        echo $output;
?>