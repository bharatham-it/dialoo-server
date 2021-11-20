<?php


function get_image_src($attachID)
{
    $getAttachment = wp_get_attachment_image_src($attachID);
    if (!$getAttachment || !$attachID) {
        return get_template_directory_uri() . '/assets/img/No_Image.png';
    } else {
        return $getAttachment[0];
    }
}
function upload_file($file, $post_id)
{
    extract($file);
    $upload = wp_upload_bits($name, null, file_get_contents($tmp_name));

    if (!$error) {
        $post_id = $post_id; //set post id to which you need to set featured image
        $filename = $upload['file'];
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit',
            /*  'post_parent' =>$parent_id */
        );
        $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
        if (!is_wp_error($attachment_id)) {
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
            wp_update_attachment_metadata($attachment_id, $attachment_data);
            set_post_thumbnail($post_id, $attachment_id);
            return $attachment_id;
        } else {
            return 0;
        }
    }
    add_action('init', 'fn_set_featured_image');
}
function image_process($file, $profile_pic = "", $post_id = "")
{
    if (isset($file)) {
        extract($file);
        $upload = wp_upload_bits($name, null, file_get_contents($tmp_name));
        if (!$error) {
            if ($file["file"]["size"][0] > 2 * 1024 * 1024) {
                echo "size is larger";
            }
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            if ($profile_pic == 0 || $profile_pic == "") {
                $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
                if (!is_wp_error($attachment_id)) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                    set_post_thumbnail($post_id, $attachment_id);
                }
            } else {
                $attachment_id = update_attached_file($profile_pic, $filename);
            }
            if (!is_wp_error($attachment_id)) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
            }
        }
        add_action('init', 'fn_set_featured_image');
        return $attachment_id;
    } else {
        return $profile_pic;
    }
}


function image_handle($action = "create",$name="upstore",$file_handler="file")
{

  
    // $get_data,$action,$name="templebook",$post_id=0
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
   $attach_id = 0;

    if($_FILES['file'] && $_FILES['name'] != "undefined")
    {
     
        $file_name = $_FILES['file']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $_FILES['file']['name'] = $name . '.' . $ext;
        
    if ($action == "create") {
   
        $attach_id = media_handle_upload($file_handler, $post_id);

    } else if ($action == "update") {  
       
            $attach_id = $get_data['image'];
            //$attach_id = wp_delete_attachment($attach_id,true);
            $attach_id = media_handle_upload($file_handler, $post_id);
    
      
    } else if ($action == "delete") {
        $attach_id = $get_data['image'];
        $attach_id = wp_delete_attachment($attach_id, true);
    }

    
    } 

    return $attach_id;
}

