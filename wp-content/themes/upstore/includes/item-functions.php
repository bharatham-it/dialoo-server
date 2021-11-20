<?php
/* add_action('wp_ajax_nopriv_submit_function_add_items', 'submit_function_add_items'); */
add_action('wp_ajax_submit_function_add_items', 'submit_function_add_items');
function submit_function_add_items()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true;//up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
   
    $params = array('title','type','status');
    $prefix = 'post_';
    $build_userdata = build_form_data($get_data, $params,$prefix);
   
    $res = wp_insert_post($build_userdata);

    //File upload
    if (isset($_FILES['image_upload']))
    {
       
        $file=$_FILES['image_upload'];
     
        extract($file);
       
        $upload = wp_upload_bits($name, null, file_get_contents($tmp_name));
        print_r($upload);

         if(!$error)
        {
            $post_id = $res;
          //set post id to which you need to set featured image
                    $filename = $upload['name'];
                    $file_url = $upload['url'];
                    extract($upload);
                    
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                 );
                
         
                 $attachment_id = wp_insert_attachment( $attachment, $file_url ,$post_id );
                 print_r($attachment_id);
      
    
                if ( ! is_wp_error( $attachment_id ) ) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    apply_filters('wp_handle_upload', array('file' => $file, 'url' => $url, 'type' => $type), 'upload');
                    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
                    print_r($attachment_data);
                    wp_update_attachment_metadata( $attachment_id, $attachment_data );
              
                   $sucess = set_post_thumbnail( $post_id, $attachment_id );
                   print_r($sucess);
           }
        }
        add_action('init', 'fn_set_featured_image');
    }
    // End of file upload
    $params=array('item_price','item_hsncode'); 
    if (is_numeric($res) &&  $res > 0) {
        $build_custom_table_data = array(
            'item_id' => $res,
            'item_name' => $get_data['title'],
            'created_by' => get_current_user_id()
        );
        foreach ($params as $param) {
            $build_custom_table_data[$param] = $get_data[$param];
        } 
        $custom_id = insert_custom_table($wpdb->prefix .'items', $build_custom_table_data); //custom table
        if ($res && $custom_id) {
           
            $sucesss = true;
            
        } else {
            $sucesss = false;
          
        }
    } 
    else{
        $sucesss=false;
    }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if($sucesss == true) {
     $response = array('id' => $res, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Item Added');
    } elseif ($sucesss == false) {
     $response = array('id' => 0, 'status' => 0, 'title' => 'failed', 'subtitle' => $res->get_error_message());
    }
    $addl_response = array('redirecturl'=>home_url().'');
    echo build_response_json($response,$addl_response);
    die();

}

?>
