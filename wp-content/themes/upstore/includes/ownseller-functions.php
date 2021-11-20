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
add_action('wp_ajax_submit_function_add_ownsellers', 'submit_function_add_ownsellers');
function submit_function_add_ownsellers()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    print_r($get_data);
    $ownseller_id = manage_post($get_data, 'create');
    // for image upload
    $file = $_FILES['file'];
    $attachment_id = upload_file($file, $ownseller_id);
    ///////////
    wp_set_post_terms($ownseller_id, array($get_data['district_id']), 'districts');
/*     wp_set_post_terms($ownseller_id, array($get_data['ownseller_category_id']), 'ownseller_categories'); */
    $params = array('ownseller_email', 'ownseller_mobile', 'ownseller_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','rating');
    if (is_numeric($ownseller_id) &&  $ownseller_id > 0) {
        $build_ownseller_price_percent =  build_shop_price_percentage($get_data);
        $ownseller_user_id = add_user_with_role();
        $characters = "ABCDEFGHIJKLMONP123456789";
        $custom_data = array(
            'ownseller_id' => $ownseller_id,
            'ownseller_name' => $get_data['title'],
            'profile_pic' => $attachment_id,
            'created_by' => $get_data['current_user_id'],
            'ownseller_offer' => json_encode($build_ownseller_price_percent, JSON_FORCE_OBJECT),
            'ownseller_code' => 'US-OWNSELLER' . $ownseller_id . generateRandomString($characters, 10),
            'owner_id' => $ownseller_user_id,
            'device' => $get_data['device']
        );
        print_r($custom_data);
        $table = $wpdb->prefix . 'ownsellers';
        $custom_id = add_to_customtable($get_data, $table, $params, $custom_data);
        print_log();
        $categories_id = $get_data['category_percentage']['category'];
        $categories_percentage = $get_data['category_percentage']['percentage'];
        foreach ($categories_id as $key => $value) {
            $table_data = array(
                'type_id' => $ownseller_id,
                'category_id' => $value,
                'category_percent' => $categories_percentage[$key]
            );
            $category_master = insert_custom_table($wpdb->prefix . 'category_master', $table_data);
            //print_log();
        }

        $wallet_data = array(
            'shop_id' => $ownseller_id

        );
        $wallet_data = insert_custom_table($wpdb->prefix . 'shop_wallet', $wallet_data);
        if ($ownseller_id && $custom_id && !isset($ownseller_user_id->errors) && $wallet_data && $category_master) {

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
        $response = array('id' => $ownseller_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Item Added');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $ownseller_user_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/ownsellers');
    echo build_response_json($response, $addl_response);
    die();
}
