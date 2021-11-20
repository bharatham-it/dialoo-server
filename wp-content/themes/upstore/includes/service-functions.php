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
function submit_function_add_services()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $service_id = manage_post($get_data, 'create');
    // for image upload
    $file = $_FILES['file'];
    $attachment_id = upload_file($file, $service_id);
    ///////////
    wp_set_post_terms($service_id, array($get_data['district_id']), 'districts');
/*     wp_set_post_terms($service_id, array($get_data['service_category_id']), 'service_categories'); */
    $params = array('service_email', 'service_mobile', 'service_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','rating');
    if (is_numeric($service_id) &&  $service_id > 0) {
        $build_service_price_percent =  build_shop_price_percentage($get_data);
        $service_user_id = add_user_with_role();
        $characters = "ABCDEFGHIJKLMONP123456789";
        $custom_data = array(
            'service_id' => $service_id,
            'service_name' => $get_data['title'],
            'profile_pic' => $attachment_id,
            'created_by' => $get_data['current_user_id'],
            'service_offer' => json_encode($build_service_price_percent, JSON_FORCE_OBJECT),
            'service_code' => 'US-SERVICE' . $service_id . generateRandomString($characters, 10),
            'owner_id' => $service_user_id,
            'device' => $get_data['device']
        );
        $table = $wpdb->prefix . 'services';
        $custom_id = add_to_customtable($get_data, $table, $params, $custom_data);
        $categories_id = $get_data['category_percentage']['category'];
        $categories_percentage = $get_data['category_percentage']['percentage'];
        foreach ($categories_id as $key => $value) {
            $table_data = array(
                'type_id' => $service_id,
                'category_id' => $value,
                'category_percent' => $categories_percentage[$key]
            );
            $category_master = insert_custom_table($wpdb->prefix . 'category_master', $table_data);
        }
        $wallet_data = array(
            'shop_id' => $service_id

        );
        $wallet_data = insert_custom_table($wpdb->prefix . 'shop_wallet', $wallet_data);
        if ($service_id && $custom_id && !isset($service_user_id->errors) && $wallet_data && $category_master) {

            $sucesss = true;
        } else {
            $sucesss = false;
        }
    } else {
        $sucesss = false;
    }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if ($sucesss == true) {
        $response = array('id' => $service_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Service Added');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $service_user_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/shops');
    echo build_response_json($response, $addl_response);
    die();
}
add_action('wp_ajax_service_delete', 'service_delete');
function service_delete()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true;
    start_transaction($multiple_tables_affected);
    $gat_data = $_POST['actionData'];
    $service_id = $gat_data['id'];
    $res = wp_delete_post($service_id);
    if ($res) {
        $where = array('service_id' => $service_id);
        $res1 = delete_custom_table($wpdb->prefix . 'services', $where);
        if (!$res && !$res1) {
            $sucesss = false;
        } else {
            $sucesss = true;
        }
    } else {
        $sucesss = false;
    }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if ($sucesss == true) {
        $response = array('id' => $service_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Shop Deleted');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $service_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/service-list/');
    echo build_response_json($response, $addl_response);
    die();
}
?>
