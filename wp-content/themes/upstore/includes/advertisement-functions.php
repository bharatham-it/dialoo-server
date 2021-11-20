<?php
add_action('wp_ajax_submit_function_add_advertisement', 'submit_function_add_advertisement');
function submit_function_add_advertisement()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;//up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $params = array('status', 'type', 'title','content');
    $build_data = build_data_array_build($get_data,$params, 'post_');
    $ad_id=wp_insert_post($build_data);
     // for image upload
     $file=$_FILES['file'];
     $attachment_id=upload_file($file,$ad_id);
     ///////////
        if ($ad_id) {
           
            $sucesss = true;
            
        } else {
            $sucesss = false;
          
        }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if($sucesss == true) {
     $response = array('id' => $ad_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Advertisement Added');
    } elseif ($sucesss == false) {
     $response = array('id' => 0, 'status' => 0, 'title' => 'failed', 'subtitle' => $ad_id->get_error_message());
    }
    $addl_response = array('redirecturl'=>home_url().'/advertisements');
    echo build_response_json($response,$addl_response);
    die();

}
?>