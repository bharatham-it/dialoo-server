<?php
/**
 * Used to set up and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @package WordPress
 */
/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
add_action('wp_ajax_submit_function_add_services', 'submit_function_add_services');
function submit_function_add_services()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true;//up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $params = array('title','type','status');
    
    $prefix = 'post_';
    $build_userdata = build_form_data($get_data, $params,$prefix);
    $service_id = wp_insert_post($build_userdata);
    //$user_id = $service_id->ID;
    $params=array('service_category_id','service_email','service_mobile','service_alt_mobile','address','town_name','pincode','district_id','street_name','landmark'); 
   
    if (is_numeric($service_id) &&  $service_id > 0) {
        $build_custom_table_data = array(
            'service_id' => $service_id,
            'service_name' => $get_data['title'],
            'created_by' => get_current_user_id()
        );
        foreach ($params as $param) {
            $build_custom_table_data[$param] = $get_data[$param];
        }
      
 
        $custom_id = insert_custom_table($wpdb->prefix .'services', $build_custom_table_data); //custom table
        if ($service_id && $custom_id) {
           
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
    if ($sucesss == true) {
        $response = array('id' => $service_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Service Added');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 0, 'title' => 'failed', 'subtitle' => $service_id->get_error_message());
    }
    $addl_response = array('redirecturl'=>home_url().'/login/');
    echo build_response_json($response,$addl_response);
    die();

}
