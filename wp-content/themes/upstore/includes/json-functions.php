<?php

add_action('wp_ajax_nopriv_get_roles_for_app', 'get_roles_for_app');
add_action('wp_ajax_get_user_details_for_app', 'get_user_details_for_app');
add_action('wp_ajax_nopriv_get_user_details_for_app', 'get_user_details_for_app');
add_action('wp_ajax_nopriv_bind_data_for_select', 'bind_data_for_select');
add_action('wp_ajax_bind_data_for_select', 'bind_data_for_select');
add_action('wp_ajax_nopriv_generate_offer_price_by_shop_id', 'generate_offer_price_by_shop_id');
add_action('wp_ajax_nopriv_json_get_shop_details', 'json_get_shop_details');
add_action('wp_ajax_json_get_shop_details', 'json_get_shop_details');


add_action('wp_ajax_json_submit_function_add_shops', 'json_submit_function_add_shops');
add_action('wp_ajax_nopriv_json_submit_function_add_shops', 'json_submit_function_add_shops');
add_action('wp_ajax_json_add_top_up', 'json_add_top_up');
add_action('wp_ajax_nopriv_json_add_top_up', 'json_add_top_up');

add_action('wp_ajax_nopriv_json_approve_top_up_request', 'json_approve_top_up_request');
add_action('wp_ajax_json_approve_top_up_request', 'json_approve_top_up_request');

add_action('wp_ajax_nopriv_json_reject_top_up_request', 'json_reject_top_up_request');
add_action('wp_ajax_json_reject_top_up_request', 'json_reject_top_up_request');



add_action('wp_ajax_json_view_top_up_request', 'json_view_top_up_request');
add_action('wp_ajax_nopriv_json_view_top_up_request', 'json_view_top_up_request');

add_action('wp_ajax_json_get_topup_status', 'json_get_topup_status');
add_action('wp_ajax_nopriv_json_get_topup_status', 'json_get_topup_status');

add_action('wp_ajax_json_show_wallet_balance', 'json_show_wallet_balance');
add_action('wp_ajax_nopriv_json_show_wallet_balance', 'json_show_wallet_balance');


add_action('wp_ajax_json_generate_otp', 'json_generate_otp');
add_action('wp_ajax_nopriv_json_generate_otp', 'json_generate_otp');

add_action('wp_ajax_json_validate_otp', 'json_validate_otp');
add_action('wp_ajax_nopriv_json_validate_otp', 'json_validate_otp');


add_action('wp_ajax_json_update_password', 'json_update_password');
add_action('wp_ajax_nopriv_json_update_password', 'json_update_password');

add_action('wp_ajax_json_get_shop_categories_for_home', 'json_get_shop_categories_for_home');
add_action('wp_ajax_nopriv_json_get_shop_categories_for_home', 'json_get_shop_categories_for_home');


add_action('wp_ajax_json_get_shop_categories_for_home', 'json_get_shop_categories_for_home');
add_action('wp_ajax_nopriv_json_get_shop_categories_for_home', 'json_get_shop_categories_for_home');

add_action('wp_ajax_json_get_items_by_category_id', 'json_get_items_by_category_id');
add_action('wp_ajax_nopriv_json_get_items_by_category_id', 'json_get_items_by_category_id');



add_action('wp_ajax_json_get_advertisment', 'json_get_advertisment');
add_action('wp_ajax_nopriv_json_get_advertisment', 'json_get_advertisment');

add_action('wp_ajax_json_get_featured_shops', 'json_get_featured_shops');
add_action('wp_ajax_nopriv_json_get_featured_shops', 'json_get_featured_shops');

add_action('wp_ajax_json_get_featured_advertisements', 'json_get_featured_advertisements');
add_action('wp_ajax_nopriv_json_get_featured_advertisements', 'json_get_featured_advertisements');

add_action('wp_ajax_json_update_shop_profile', 'json_update_shop_profile');
add_action('wp_ajax_nopriv_json_update_shop_profile', 'json_update_shop_profile');

add_action('wp_ajax_json_return_data_for_qrscan', 'json_return_data_for_qrscan');
add_action('wp_ajax_nopriv_json_return_data_for_qrscan', 'json_return_data_for_qrscan');

add_action('wp_ajax_json_get_all_shops', 'json_get_all_shops');
add_action('wp_ajax_nopriv_json_get_all_shops', 'json_get_all_shops');

add_action('wp_ajax_json_get_single_item_details', 'json_get_single_item_details');
add_action('wp_ajax_nopriv_json_get_single_item_details', 'json_get_single_item_details');

add_action('wp_ajax_json_submit_function_add_se0rvices', 'json_submit_function_add_services');
add_action('wp_ajax_nopriv_json_submit_function_add_services', 'json_submit_function_add_services');

add_action('wp_ajax_json_get_team_purchase', 'json_get_team_purchase');
add_action('wp_ajax_nopriv_json_get_team_purchase', 'json_get_team_purchase');


add_action('wp_ajax_json_get_my_purchase', 'json_get_my_purchase');
add_action('wp_ajax_nopriv_json_get_my_purchase', 'json_get_my_purchase');

add_action('wp_ajax_json_get_wallet_data', 'json_get_wallet_data');
add_action('wp_ajax_nopriv_json_get_wallet_data', 'json_get_wallet_data');

add_action('wp_ajax_json_money_withdraw', 'json_money_withdraw');
add_action('wp_ajax_nopriv_json_money_withdraw', 'json_money_withdraw');


add_action('wp_ajax_json_get_all_services', 'json_get_all_services');
add_action('wp_ajax_nopriv_json_get_all_services', 'json_get_all_services');

add_action('wp_ajax_json_get_my_wallet_transactions', 'json_get_my_wallet_transactions');
add_action('wp_ajax_nopriv_json_get_my_wallet_transactions', 'json_get_my_wallet_transactions');

add_action('wp_ajax_json_get_service_categories_for_home', 'json_get_service_categories_for_home');
add_action('wp_ajax_nopriv_json_get_service_categories_for_home', 'json_get_service_categories_for_home');

add_action('wp_ajax_json_get_service_by_category_id', 'json_get_service_by_category_id');
add_action('wp_ajax_nopriv_json_get_service_by_category_id', 'json_get_service_by_category_id');

add_action('wp_ajax_json_get_sponsor_name_by_code', 'json_get_sponsor_name_by_code');
add_action('wp_ajax_nopriv_json_get_sponsor_name_by_code', 'json_get_sponsor_name_by_code');

add_action('wp_ajax_json_get_seller_categories_for_home', 'json_get_seller_categories_for_home');
add_action('wp_ajax_nopriv_json_get_seller_categories_for_home', 'json_get_seller_categories_for_home');


add_action('wp_ajax_json_get_bank_account_details', 'json_get_bank_account_details');
add_action('wp_ajax_nopriv_json_get_bank_account_details', 'json_get_bank_account_details');


add_action('wp_ajax_json_search_data', 'json_search_data');
add_action('wp_ajax_nopriv_json_search_data', 'json_search_data');


add_action('wp_ajax_submit_function_add_requirements', 'submit_function_add_requirements');
add_action('wp_ajax_nopriv_submit_function_add_requirements', 'submit_function_add_requirements');

add_action('wp_ajax_json_get_messages', 'json_get_messages');
add_action('wp_ajax_nopriv_json_get_messages', 'json_get_messages');



add_action('wp_ajax_json_get_user_detail_for_managment', 'json_get_user_detail_for_managment');
add_action('wp_ajax_nopriv_json_get_user_detail_for_managment', 'json_get_user_detail_for_managment');

add_action('wp_ajax_json_get_admin_settings', 'json_get_admin_settings');
add_action('wp_ajax_nopriv_json_get_admin_settings', 'json_get_admin_settings');

add_action('wp_ajax_load_categories_for_home', 'load_categories_for_home');
add_action('wp_ajax_nopriv_load_categories_for_home', 'load_categories_for_home');


add_action('wp_ajax_json_generate_wallet_withdraw_csv', 'json_generate_wallet_withdraw_csv');
add_action('wp_ajax_nopriv_json_generate_wallet_withdraw_csv', 'json_generate_wallet_withdraw_csv');


function get_roles_for_app()
{
    $roles = get_role_names();
    echo json_encode($roles);
    die();
}

function get_user_details_for_app()
{
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop', 'customer', 'upadmin'));
    if ($auth_user) {
        $user_data = new stdClass;
        $user_datas = get_userdata($user_id);
        $user_custom_data = get_custom_single_row('us_user_data', 'id=' . $user_id);
        $user_wallet_data = get_custom_single_row('us_user_returns', 'user_id=' . $user_id);
        $custom_logo_id = get_theme_mod('custom_logo');
        $profile_pic = wp_get_attachment_image_src($user_custom_data->profile_pic);
        $image = wp_get_attachment_image_src($custom_logo_id, 'thumbnail');
        $user_data->display_name = $user_datas->display_name;
        $user_data->user_email = $user_datas->user_email;
        $user_data->role = $user_datas->roles[0];
        $user_data->image_logo = str_replace('localhost', '192.168.1.3', $image[0]);
        $user_data->sponser_code =  $user_custom_data->sponser_code;
        $user_data->address = $user_custom_data->address;
        $user_data->town_name = $user_custom_data->town_name;
        $user_data->street_name = $user_custom_data->street_name;
        $user_data->state_id = state_by_district($user_custom_data->district_id);
        $user_data->country_id = get_country_id($user_custom_data->district_id);
        $user_data->pincode = $user_custom_data->pincode;
        $user_data->mobile = $user_custom_data->mobile;
        $user_data->alt_mobile = $user_custom_data->alt_mobile;
        $user_data->town_name = $user_custom_data->town_name;
        $user_data->district_id = $user_custom_data->district_id;
        $user_data->street_name = $user_custom_data->street_name;
        $user_data->post_office = $user_custom_data->postoffice;
        $user_data->landmark = $user_custom_data->landmark;
        $user_data->profile_pic = $user_custom_data->profile_pic;
        $user_data->ppv = $user_wallet_data->ppv;
        $user_data->pv = get_pv($user_id);
        $user_data->tpv = get_tpv($user_id);
        $user_data->image_profile = $profile_pic[0];
    } else {
        $user_data = $auth_user;
    }
    $response = return_response_data($user_data);
    echo json_encode($response);
    die();
}

function json_get_sponsor_name_by_code()
{

    global $wpdb;
    $get_data = get_form_request('formdata');
    $sponsor_code = $get_data['sponsor_code'];
    $user_id = get_user_id_by_sponser_code($sponsor_code);
    $log['data_check'] = get_print_log();
    $display_name = get_display_name($user_id);
    $log['name_check'] = get_print_log();
    
    if ($display_name) {
        $response =
            array('status' => 200, 'title' => 'success', 'subtitle' => 'Retrieve success', 'result' => array('sponsor_name' => $display_name),'log'=>$log);
    } else {
        $response =
        array('status' => 200, 'title' => 'failed', 'subtitle' => 'Retrieve failed', 'result' => array('sponsor_name' => $display_name),'log'=>$log);

    }

    echo json_encode($response);
    die();
}
function json_get_wallet_data()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $role = get_current_user_role($user_id);
    $request_tye = "customer";

    $auth_user = authorize_app_user($user_id, array('shop', 'upadmin', 'customer'));
    if ($auth_user) {
        if ($role == "upadmin") {

            $user_id = get_company_id();
            $request_tye = "upadmin";
        }
        $wallet_data = new stdClass;
        $ppv = get_ppv($user_id);
        $log['ppv'] = get_print_log();
        $tpv = get_tpv($user_id, $request_tye);
        $log['tpv'] = get_print_log();
        $pv = get_pv($user_id);
        $log['pv'] = get_print_log();

        $total_earned = $ppv + $tpv;
        // print_r($total_earned);
        $permitted_amount = $pv * 100;
        // print_r($permitted_amount);
        // print_r($permitted_amount);

        // print_r($pv);

        $amount = "";
        if ($total_earned >= $permitted_amount && $pv < 100) {
            // echo 123;
            $amount = $permitted_amount;
            //   print_r($amount);
        } else {

            $amount = $total_earned;
        }
        $wallet_data->ppv = $ppv;
        $wallet_data->tpv = $tpv;
        $wallet_data->pv = $pv;
        $wallet_data->total_earned =  $total_earned;
        $wallet_data->withdrwable_amount  =  $amount;
        $wallet_data->this_month_earning = get_this_month_earning($user_id);
        $log['this_month_earning'] = get_print_log();
    } else {
        $wallet_data = $auth_user;
    }
    $response = return_response_data($wallet_data, $log);
    echo json_encode($response);
    die();
}


function get_this_month_earning($user_id)
{
    global $wpdb;

    $table =  $wpdb->prefix . "purchase";
    $table_returns = $wpdb->prefix . "user_relation_child";
    $sum_dpv = get_custom_table($table, " user_id in (SELECT child_id from $table_returns where parent_id = $user_id and level_id < 11) and  created_on > DATE_SUB(NOW(), INTERVAL 1 MONTH)", 'sum(dpv) as dpv_sum ');



    $sum_ppv = get_custom_table($table, " user_id = $user_id and  created_on > DATE_SUB(NOW(), INTERVAL 1 MONTH)", 'sum(ppv) as ppv_sum');


    $this_month_earing = $sum_dpv[0]->dpv_sum + $sum_ppv[0]->ppv_sum;
    return $this_month_earing;
}
function bind_data_for_select()
{
    global $wpdb;
    $get_data = get_form_request('formdata');

    $type = $get_data['type'];

    if ($type == "item_categories") {
        $select_data  = get_child_of('shop_categories', 0, array('fields' => 'id=>name'));
    } else if ($type == "districts") {

        $select_data  = get_child_of('districts', 11, array('fields' => 'id=>name'));
    } else if ($type == "country") {
        $select_data  = get_parent_of('districts', 0, array('fields' => 'id=>name'));
    } else if ($type == "state_by_country") {
        $country_id = $get_data['country_id'];
        $select_data  = get_parent_of('districts', $country_id, array('fields' => 'id=>name'));
    } else if ($type == "state") {
        $select_data  = get_parent_of('districts', 0, array('fields' => 'id=>name'));
    } else if ($type == "district_by_state") {
        $state_id = $get_data['state_id'];
        $select_data  = get_child_of('districts', $state_id, array('fields' => 'id=>name'));
    } else if ($type == "service_categories") {
        $select_data  = get_child_of('service_categories', 0, array('fields' => 'id=>name'));
    } else if ($type == "seller_categories") {
        $select_data  = get_child_of('seller_categories', 0, array('fields' => 'id=>name'));
    } else if ($type == "categories_by_type") {
        $user_id = $get_data['user_key'];
        $role = get_current_user_role($user_id);
        $code = $get_data['code'];
        if ($role == "shop") {
            $shop_id = get_shop_id_by_user_id($user_id);
            $data = get_custom_single_row($wpdb->prefix . 'shops', "owner_id =$user_id", 'shop_code');
            $code = $data->shop_code;
        }
        $item_type = get_type_by_code($code);
      
        $taxonomy_type = "";
        if ($item_type == "shop") {
            $taxonomy_type = "shop_categories";
        } else if ($item_type == "service") {
            $taxonomy_type = "service_categories";
        } else if ($item_type == "own_seller") {
            $taxonomy_type = "seller_categories";
        }
        $select_data  = get_categories_by_id($code, $taxonomy_type, $get_data);
    }
    echo json_encode($select_data);
    die();
}

function get_type_by_code($code)
{
    global $wpdb;
    $code = get_custom_single_row($wpdb->prefix . 'shops', "shop_code='$code'", 'type');
    return $code->type;
}
function json_get_shop_details()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop', 'upadmin'));
    if ($auth_user) {
        $shop_data = new stdClass;
        $table = $wpdb->prefix . 'shops';
        $custom_shop_data = get_custom_single_row($table, 'owner_id=' . $user_id);
        $shop_data->shop_code = $custom_shop_data->shop_code;
        $shop_data->shop_name = $custom_shop_data->shop_name;
        $shop_data->shop_email = $custom_shop_data->shop_email;
        $shop_data->shop_mobile = $custom_shop_data->shop_mobile;
        $shop_data->shop_alt_mobile = $custom_shop_data->shop_alt_mobile;
        $shop_data->pincode = $custom_shop_data->pincode;
        $shop_data->street_name = $custom_shop_data->street_name;
        $shop_data->address = $custom_shop_data->address;
        $shop_data->town_name = $custom_shop_data->town_name;
        $shop_data->district_id = $custom_shop_data->district_id;
        $shop_data->country_id = get_country_id($custom_shop_data->district_id);
        $shop_data->state_id = state_by_district($custom_shop_data->district_id);


        $shop_data->landmark = $custom_shop_data->landmark;
        $shop_data->address = $custom_shop_data->address;
        $shop_data->profile_pic = $custom_shop_data->profile_pic;
        $shop_data->shop_balance = get_shop_wallet_balance($user_id);

        $shop_data->shop_image = wp_get_attachment_image_src($custom_shop_data->profile_pic)[0];
    } else {
        $shop_data = $auth_user;
    }
    $response = return_response_data($shop_data);
    echo json_encode($response);
    die();
}
function json_get_all_shops()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];

    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $type = $get_data['type'];
        $offset = $get_data['offset'];
        $table = $wpdb->prefix . 'shops';
        $custom_shop_data = get_custom_table($table, 'shop_id !="" and type = "' . $type . '" ORDER BY created_on DESC LIMIT 10 OFFSET ' . $offset . '', 'shop_id,shop_code,shop_name,shop_name,profile_pic,district_id,shop_mobile,map_url,video_url');
        $log['some_data'] = get_print_log();
        foreach ($custom_shop_data as $key => $value) {
            $shop_data = new stdClass;
            $shop_data->shop_id = $value->shop_id;
            $shop_data->shop_name = $value->shop_name;
            $shop_data->district_name = get_taxonomy_name($value->district_id, 'districts');
            $shop_data->shop_mobile = $value->shop_mobile;
            if ($value->video_url) {
                $shop_data->video_url = $value->video_url;
            }
            if ($value->map_url) {
                $shop_data->map_url = $value->map_url;
            }

            $shop_data->profile_pic = $value->profile_pic;
            $shop_data->shop_image = wp_get_attachment_image_src($value->profile_pic)[0];
            $shop_data_array[$key] = $shop_data;
        }
    } else {
        $shop_data_array = $auth_user;
    }
    $response = return_response_data($shop_data_array,$log);
    echo json_encode($response);
    die();
}
function json_get_all_services()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {

        $offset = $get_data['offset'];
        $table = $wpdb->prefix . 'services';
        $custom_shop_data = get_custom_table($table, 'service_id !="" and type = "service" ORDER BY created_on DESC LIMIT 10 OFFSET ' . $offset . '', 'service_id,service_code,service_name,profile_pic');
        foreach ($custom_shop_data as $key => $value) {
            $shop_data = new stdClass;
            $shop_data->shop_id = $value->shop_id;
            $shop_data->shop_name = $value->shop_name;
            $shop_data->shop_image = wp_get_attachment_image_src($value->profile_pic)[0];
            $shop_data_array[$key] = $shop_data;
        }
    } else {
        $shop_data_array = $auth_user;
    }
    $response = return_response_data($shop_data_array);
    echo json_encode($response);
    die();
}


function json_get_admin_settings()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $table = $wpdb->prefix . "settings";
        $data = get_custom_table($table, "1=1");
    } else {
        $data = $auth_user;
    }
    $response = return_response_data($data);
    echo json_encode($response);
    die();
}
function json_get_single_item_details()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];

    $id = $get_data['id'];
    $type = $get_data['type'];
    $data = new stdClass;
    $table = $wpdb->prefix . 'shops';
    $custom_shop_data = get_custom_single_row($table, "shop_id=$id");
    $data->item_code = $custom_shop_data->shop_code;
    $data->item_name = $custom_shop_data->shop_name;
    $data->item_email = $custom_shop_data->shop_email;
    $data->item_mobile = $custom_shop_data->shop_mobile;
    $data->item_alt_mobile = $custom_shop_data->shop_alt_mobile;
    if ($custom_shop_data->map_url) {
        $data->map_url = $custom_shop_data->map_url;
    }
    if ($custom_shop_data->video_url) {
        $data->video_url = $custom_shop_data->video_url;
    }
    $data->pincode = $custom_shop_data->pincode;
    $data->address = $custom_shop_data->address;
    $data->street_name = $custom_shop_data->street_name;
    $data->town_name = $custom_shop_data->town_name;
    $data->district_id = $custom_shop_data->district_id;
    $data->landmark = $custom_shop_data->landmark;
    $data->address = $custom_shop_data->address;
    $data->profile_pic = $custom_shop_data->profile_pic;
    $data->rating = $custom_shop_data->rating;
    $data->item_image = wp_get_attachment_image_src($custom_shop_data->profile_pic, 'large')[0];



    $response = return_response_data($data);
    echo json_encode($response);
    die();
}


function json_return_data_for_qrscan()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop', 'customer'));
    $role = get_current_user_role($user_id);
    $qr_datas = new stdClass;
    if ($auth_user) {
        if ($role == "customer") {
            $shop_code = $get_data['code'];
            $shop_id = get_shop_id_by_shope_code($shop_code);
            $custom_data = get_custom_single_row($wpdb->prefix . 'shops', 'shop_id=' . $shop_id);
            $log['data'] = get_print_log();
            $qr_datas->name = $custom_data->shop_name;
            $qr_datas->email = $custom_data->shop_email;
            $qr_datas->id = $custom_data->shop_id;
        } else if ($role == "shop") {
            $sponser_code = $get_data['code'];
            $user_id = get_user_id_by_sponser_code($sponser_code);
            $user_data = get_userdata($user_id);
            $qr_datas->name = $user_data->display_name;
            $qr_datas->email = $user_data->user_email;
            $qr_datas->id = $user_data->ID;
        }
    } else {
        $qr_datas = $auth_user;
    }
    $response = return_response_data($qr_datas, $log);
    echo json_encode($response);
    die;
}


function  json_submit_function_add_shops()
{
    $get_data = get_form_request('formdata');
    if ($get_data['id']) {
        update_shop_profile_for_admin();
    } else {
        submit_function_add_shops();
    }
}
function json_update_shop_profile()
{
    update_shop_profile();
}

function json_submit_function_add_purchases()
{
    submit_function_add_purchases();
}
function json_get_team_purchase()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer', 'administrator'));
    $team_purchase_array = array();
    $transaction_data = [];
    if ($auth_user) {
        $date_from = $get_data['date_from'];
        $date_to = $get_data['date_to'];
        $offset = $get_data['offset'];
        $table_user_relation = $wpdb->prefix . 'user_relation_child';
        $purchase_data = get_custom_table($wpdb->prefix . 'purchase', "user_id in (SELECT child_id from $table_user_relation WHERE parent_id = $user_id and level_id < 11) and created_on BETWEEN '$date_from' and '$date_to' ", 'user_id,shop_id,created_on,pv,pay_amount,ppv');
        $log['purchase_data'] = get_print_log();
        foreach ($purchase_data as $key => $value) {
            $value->date = change_date_format($value->created_on, 'd-M-Y');
            $value->bill = $value->pay_amount;
            $value->pv = $value->pv;
            $value->Name = get_display_name($value->user_id);
            $value->Shop = get_the_title($value->shop_id);
            $value->date = change_date_format($value->created_on, 'd-M-Y');
        }
        $team_purchase_array['purchas_data'] = $purchase_data;
        $team_purchase_array['tpv'] = get_tpv($user_id);
    } else {
        $team_purchase_array = $auth_user;
    }
    $response = return_response_data($team_purchase_array, $log);
    echo json_encode($response);
    die();
}
function json_get_my_purchase()
{
    global $wpdb;
    $extra_query = "";
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer', 'shop'));
    $transaction_data = [];
    if ($auth_user) {
        $offset = $get_data['offset'];
        $table_purchase  = $wpdb->prefix . 'purchase';
        $role = get_current_user_role($user_id);
        //print_r($role);
        if ($role == "customer") {
            $date_from = $get_data['date_from'];
            $date_to = $get_data['date_to'];
            if ($date_from && $date_to) {
                $extra_query = "and created_on BETWEEN '$date_from' and  '$date_to'  ";
            }
            $where = "user_id = $user_id $extra_query ORDER BY created_on DESC";
        } else if ($role == "shop") {
            $date_from = $get_data['date_from'];
            $date_to = $get_data['date_to'];
            if ($date_from && $date_to) {
                $extra_query = build_date_query($get_data);
            }
            $shop_id = get_shop_id_by_user_id($user_id);
            $where = "shop_id = $shop_id $extra_query ORDER BY created_on DESC  ";
            $shop_type = get_shop_type($shop_id);
            if ($shop_type == "shop") {
                $taxonomy_type = "shop_categories";
            } elseif ($shop_type == "service") {
                $taxonomy_type = "service_categories";
            } else if ($shop_type == "ownseller") {
                $taxonomy_type = "seller_categories";
            }
        }

        //$shop_categories = get_child_of('service_categories', 0);
        $purchase_history = get_custom_table($table_purchase, $where, 'order_no,pay_amount,discount_amount,ppv,user_id,shop_id,created_on,pv,category_amount');

        foreach ($purchase_history as $key => $value) {
            $percentage_array = json_decode($value->category_amount);
            $category_data = array();
            foreach ($percentage_array as $key2 => $value2) {

                if ($key2 != "pay_amount") {

                    $value->{get_taxonomy_name($key2, $taxonomy_type)} =
                        '<br>Amount: ' .  $value2 . '<br> Percentage: ' . get_category_percentage($shop_id, $key2) . '<br> Discount :' . $value2 * get_category_percentage($shop_id, $key2) / 100;


                    // print_log();
                }
            }
            $value->bill = $value->pay_amount;
            $value->name = get_display_name($value->user_id);
            $value->shop = get_the_title($value->shop_id);
            $value->pv = $value->pv;
            $value->date = change_date_format($value->created_on, 'd-M-Y');
        }
    } else {
        $purchase_history = $auth_user;
    }
    $response = return_response_data($purchase_history);
    echo json_encode($response);
    die();
}

function get_shop_type($shop_id)
{
    global $wpdb;
    $data = get_custom_single_row($wpdb->prefix . 'shops', "shop_id = $shop_id", "type");
    return $data->type;
}

function get_category_percentage($type_id, $category_id)
{
    global $wpdb;
    $data = get_custom_single_row($wpdb->prefix . 'category_master', "type_id = $type_id and category_id = $category_id", "category_percent");
    return $data->category_percent;
}


function json_add_top_up()
{
    add_top_up();
}
function json_approve_top_up_request()
{
    approve_top_up_request();
}

function json_reject_top_up_request()
{
    reject_top_up_request();
}
function json_view_top_up_request()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'shop'));
    $transaction_data = [];
    if ($auth_user) {
        $role = get_current_user_role($user_id);
        $offset = $get_data['offset'];
        $custom_status = $get_data['custom_status'];
        if ($role == "shop") {
            $shop_id = get_shop_id_by_user_id($user_id);
            $topup_datas = get_custom_table($wpdb->prefix . 'topup_transaction', 'shop_id = ' . $shop_id . ' and custom_status = ' . $custom_status . ' ORDER BY created_on DESC LIMIT 10 OFFSET ' . $offset . '', 'id,shop_id,amount,screenshot_id,created_by,custom_status');
        } else if ($role == "upadmin") {
            $topup_datas = get_custom_table($wpdb->prefix . 'topup_transaction', 'custom_status = ' . $custom_status . ' ORDER BY created_on DESC LIMIT 10 OFFSET ' . $offset . '', 'id,shop_id,amount,screenshot_id,created_by,custom_status,created_on');
        }
        foreach ($topup_datas as $key => $value) {
            $top_up_data = new stdClass;
            $top_up_data->id = $value->id;
            $top_up_data->shop_name = get_the_title($value->shop_id);
            $top_up_data->amount = $value->amount;
            $top_up_data->display_name = get_display_name($value->created_by);
            $top_up_data->date = change_date_format($value->created_on, 'd-M-Y');
            $top_up_data->screen_shot_url = wp_get_attachment_image_src($value->screenshot_id, 'large')[0];
            $top_up_data->status = get_taxonomy_name($value->custom_status, 'topup_status');
            $transaction_data[$key] = $top_up_data;
        }
    } else {
        $transaction_data = $auth_user;
    }
    $response = return_response_data($transaction_data);
    echo json_encode($response);
    die();
}
function json_get_topup_status()
{
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'shop'));
    if ($auth_user) {
        $topup_status  = get_child_of('topup_status', 0, array('fields' => 'id=>name'));
    } else {
        $topup_status = $auth_user;
    }
    $response = return_response_data($topup_status);
    echo json_encode($response);
    die();
}
function json_get_shop_categories()
{
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('customer'));
    if ($auth_user) {
        $topup_status  = get_child_of('topup_status', 0, array('fields' => 'id=>name'));
    } else {
        $topup_status = $auth_user;
    }
    $response = return_response_data($topup_status);
    echo json_encode($response);
    die();
}
function json_show_wallet_balance()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop', 'upadmin'));
    if ($auth_user) {
        $balance = new stdClass;
        $shop_id = get_shop_id_by_user_id($user_id);
        $table = $wpdb->prefix . 'shop_wallet';
        $wallet_balance  = get_custom_single_row($table, 'shop_id=' . $shop_id, 'balance', 'updated_on');
        $balance->wallet_balance = $wallet_balance->balance;
        $balance->last_updated = change_date_format($wallet_balance->updated_on, 'd-M-y H:i:s');
    } else {
        $balance = $auth_user;
    }
    $response = return_response_data($balance);
    echo json_encode($response);
    die();
}


function json_generate_otp()
{
    generate_otp();
}
function json_validate_otp()
{
    validate_otp();
}
function json_update_password()
{
    add_filter('send_password_change_email', '__return_false');
    update_password();
}
function json_get_shop_categories_for_home()
{
    $shop_categories = get_child_of('shop_categories', 23);
    foreach ($shop_categories as $key => $value) {
        $category_image = get_field('category_image', 'shop_categories_' . $value->term_id . '');
        $category_data = new stdClass;
        $category_data->category_name = $value->name;
        $category_data->category_id = $value->term_id;
        $category_data->category_image = $category_image['sizes']['thumbnail'];
        $category_array[$key] = $category_data;
    }
    $response = return_response_data($category_array);
    echo json_encode($response);
    die();
}
function json_get_service_categories_for_home()
{
    $shop_categories = get_child_of('service_categories', 0);
    foreach ($shop_categories as $key => $value) {
        $category_image = get_field('category_image', 'service_categories_' . $value->term_id . '');
        $category_data = new stdClass;
        $category_data->category_name = $value->name;
        $category_data->category_id = $value->term_id;
        $category_data->category_image = $category_image['sizes']['thumbnail'];
        $category_array[$key] = $category_data;
    }
    $response = return_response_data($category_array);
    echo json_encode($response);
    die();
}

//changes

function json_get_seller_categories_for_home()
{
    $shop_categories = get_child_of('seller_categories', 0);
    foreach ($shop_categories as $key => $value) {
        $category_image = get_field('category_image', 'seller_categories_' . $value->term_id . '');
        $category_data = new stdClass;
        $category_data->category_name = $value->name;
        $category_data->category_id = $value->term_id;
        $category_data->category_image = $category_image['sizes']['thumbnail'];
        $category_array[$key] = $category_data;
    }
    $response = return_response_data($category_array);
    echo json_encode($response);
    die();
}

function load_categories_for_home()
{
    $start_time = microtime(true);
    if (false === ($category_array = get_transient('category_array'))) {



        $category_array = array();
        $seller_categories = get_child_of('seller_categories', 0);
        foreach ($seller_categories as $key => $value) {
            $category_image = get_field('category_image', 'seller_categories_' . $value->term_id . '');
            $seller_category_data = new stdClass;
            $seller_category_data->category_name = $value->name;
            $seller_category_data->category_id = $value->term_id;
            $seller_category_data->category_image = $category_image['sizes']['thumbnail'];
            $seller_category_array[$key] = $seller_category_data;
        }
        $service_categories = get_child_of('service_categories', 0);
        foreach ($service_categories as $key => $value) {
            $category_image = get_field('category_image', 'service_categories_' . $value->term_id . '');
            $service_category_data = new stdClass;
            $service_category_data->category_name = $value->name;
            $service_category_data->category_id = $value->term_id;
            $service_category_data->category_image = $category_image['sizes']['thumbnail'];
            $service_category_array[$key] = $service_category_data;
        }
        $shop_categories = get_child_of('shop_categories', 0);
        foreach ($shop_categories as $key => $value) {
            $category_image = get_field('category_image', 'shop_categories_' . $value->term_id . '');
            $shop_category_data = new stdClass;
            $shop_category_data->category_name = $value->name;
            $shop_category_data->category_id = $value->term_id;
            $shop_category_data->category_image = $category_image['sizes']['thumbnail'];
            $shop_category_array[$key] = $shop_category_data;
        }
        $category_array['seller_category'] = $seller_category_array;
        $category_array['service_category'] = $service_category_array;
        $category_array['shop_category'] = $shop_category_array;
    }
    set_transient('category_array', $category_array, HOUR_IN_SECONDS);
    $end_time = microtime(true);

    $response = return_response_data($category_array);
    echo json_encode($response);
    die();
}



function json_get_items_by_category_id()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $type = $get_data['type'];

    $category_id = $get_data['category_id'];
    $district_id = $get_data['district_id'];
    $shop_datas = get_custom_table($wpdb->prefix . 'shops', 'shop_id in (SELECT type_id FROM us_category_master where category_id = ' . $category_id . ') and district_id=' . $district_id . ' and type = "' . $type . '" ', 'shop_id,shop_name,shop_mobile,district_id,profile_pic,town_name');
    foreach ($shop_datas as $key => $value) {
        $shop = new stdClass;
        $shop->shop_id = $value->shop_id;
        $shop->shop_name = $value->shop_name;
        $shop->shop_mobile = $value->shop_mobile;
        $shop->town_name = $value->town_name;
        $shop->district_name = get_taxonomy_name($value->district_id, 'districts');
        $shop->image = wp_get_attachment_image_src($value->profile_pic)[0];
        $type_array[$key] = $shop;
    }
    $response = return_response_data($type_array);
    echo json_encode($response);
    die();
}
function json_get_service_by_category_id()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $category_id = $get_data['category_id'];
    $district_id = $get_data['district_id'];
    $shop_datas = get_custom_table($wpdb->prefix . 'services', 'service_id in (SELECT type_id FROM us_category_master where category_id = ' . $category_id . ') and district_id=' . $district_id . ' ', 'service_id,service_name,service_mobile,district_id,profile_pic');
    foreach ($shop_datas as $key => $value) {
        $shop = new stdClass;
        $shop->shop_id = $value->service_id;
        $shop->shop_name = $value->service_name;
        $shop->shop_mobile = $value->shop_mobile;
        $shop->district_name = get_taxonomy_name($value->district_id, 'districts');
        $shop->image = wp_get_attachment_image_src($value->profile_pic)[0];
        $shop_array[$key] = $shop;
    }
    $response = return_response_data($shop_array);
    echo json_encode($response);
    die();
}


function json_get_advertisment()
{

    $start_time = microtime(true);
    if (false === ($add_array = get_transient('add_array'))) {


        $args = array(
            'post_type' => 'advertisment',
            'category_name' => 'mainbanner',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'numberposts'      => -1,
        );
        $advertisments = get_posts($args);
        foreach ($advertisments as $key => $value) {
            $add = new stdClass;
            $add->post_title = $value->post_title;
            $add->post_content = $value->post_content;
            $add->image = get_the_post_thumbnail_url($value->ID);
            $add_array[$key] = $add;
        }
    }
    set_transient('add_array', $add_array, HOUR_IN_SECONDS);
    $end_time = microtime(true);
    $response = return_response_data($add_array);
    echo json_encode($response);
    die();
}
function json_get_featured_shops()
{
    global $wpdb;
    $args = array(
        'post_type' => 'shop',
        'category' => 'featured',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'numberposts'      => 4
    );
    $featured = get_posts($args);
    foreach ($featured as $key => $value) {
        $shop_additional_data = get_custom_single_row($wpdb->prefix . 'shops', 'shop_id=' . $value->ID, 'shop_mobile,town_name');
        $add = new stdClass;
        $add->shop_name = $value->post_title;
        $add->mobile = $shop_additional_data->shop_mobile;
        $add->image = wp_get_attachment_url(get_post_thumbnail_id($shop_additional_data->profile_pic));
        $add->town_name = $shop_additional_data->town_name;
        $featured_array[$key] = $add;
    }
    $response = return_response_data($featured_array);
    echo json_encode($response);
    die();
}
function json_get_featured_advertisements()
{

    $start_time = microtime(true);
    if (false === ($featured_add_array = get_transient('featured_add_array'))) {

        $args = array(
            'post_type' => 'advertisment',
            'category_name' => 'featured',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'numberposts'      => 4
        );
        $featured = get_posts($args);
        foreach ($featured as $key => $value) {
            $add = new stdClass;
            $add->post_title = $value->post_title;
            $add->post_content = $value->post_content;
            $add->image = wp_get_attachment_url(get_post_thumbnail_id($value->ID));
            $featured_add_array[$key] = $add;
        }
    }
    set_transient('featured_add_array', $featured_add_array, HOUR_IN_SECONDS);
    $end_time = microtime(true);

    $response = return_response_data($featured_add_array);
    echo json_encode($response);
    die();
}

function json_submit_function_add_services()
{
    submit_function_add_shops();
}
function json_submit_function_add_sellers()
{
}
function json_money_withdraw()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer'));
    if ($auth_user) {
        $sucesss = true;
        $multiple_tables_affected = true; //up_user and up_add_user
        start_transaction($multiple_tables_affected);
        $table = $wpdb->prefix . 'wallet_withdrawal';
        $get_data['user_id'] = $get_data['current_user_id'];

        // $razor_pay_contact = get_customer_razorpay_contact($user_id);
        $razor_pay_contact = 1;

        if (!empty($razor_pay_contact)) {

            //$get_data['fund_account_id'] = $razor_pay_contact;
            // print_r($razor_pay_contact);
            //$get_data['amount'] = 2;
            // $razor_pay_wallet_withdraw = create_razor_pay_payouts($get_data);

            // print_r($razor_pay_wallet_withdraw);
            // $get_data['payment_response'] = $razor_pay_wallet_withdraw;

            $ppv = get_ppv($user_id);
            $log['ppv'] = get_print_log();
            $tpv = get_tpv($user_id);
            $log['tpv'] = get_print_log();
            $pv = get_pv($user_id);
            $log['pv'] = get_print_log();

            $total_earned = $ppv + $tpv;
            // print_r($total_earned);
            $permitted_amount = $pv * 100;
            // print_r($permitted_amount);
            // print_r($permitted_amount);

            // print_r($pv);

            $amount = "";


            if ($total_earned >= $permitted_amount && $pv < 100) {
                // echo 123;
                $tmp_amount =  $amount = $permitted_amount;

                //   print_r($amount);
            } else {

                $tmp_amount =  $amount = $total_earned;
            }
            $serivce_charge = $amount * 5 / 100;
            $tds_amount = $amount * 5 / 100;
            $amount = $amount - $serivce_charge - $tds_amount;
            $get_data['amount'] = $amount;

            if ($tmp_amount < 50) {
                $result = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => "You can withdraw Minimum of 50");
            } else {
                $get_data['service_amount'] = $serivce_charge;
                $get_data['tds_amount'] = $tds_amount;
                $get_data['status'] = 1;
                $params = array('amount', 'user_id', 'status', 'tds_amount', 'service_amount');
                $build_data = build_data_array_build($get_data, $params);
                $withdraw = insert_custom_table($table, $build_data);
                $log['withdraw'] = get_print_log();
                if ($withdraw) {
                    $tpv = get_tpv($user_id);
                    $pv = get_pv($user_id);
                    $used_tpv = $tpv + $pv;

                    $user_return_table = $wpdb->prefix . 'user_returns';
                    $update_return_data = "used_tpv = $used_tpv+used_tpv, ppv = 0";
                    $where = "user_id = $user_id";
                    $update_returns = update_custom_query($user_return_table, $update_return_data, $where);
                    $log['update_returns'] = get_print_log();
                    $top_up_array['debit'] = -1;
                    $top_up_array['credit'] = $user_id;
                    $top_up_array['type'] = "wallet_withdraw";
                    $top_up_array['action'] = "-";
                    $top_up_array['amount'] = $get_data['amount'];
                    $ledger_entry = add_ledger($top_up_array);
                    $log['ledger_entry'] = get_print_log();


                    if ($withdraw && $ledger_entry) {
                        $sucesss = true;
                    } else {
                        $sucesss = false;
                    }
                } else {
                    $sucesss == false;
                }
            }
            if ($multiple_tables_affected == true) {
                commit_transaction($sucesss);
                roll_back_transaction(!$sucesss);
            }
            if ($sucesss == true) {
                $result = array('id' => "", 'status' => 1, 'title' => 'success', 'subtitle' => 'The Amount Has been withdrawn successfully', 'log' => $log);
            } else if ($sucesss == false) {
                $result = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => "Withdrawing Failed", 'log' => $log);
            }
        } else {
            $result = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => "Update the bank details");
        }
    } else {
        $result = $auth_user;
    }


    echo  build_response_json($result);
    die();
}
function json_get_my_wallet_transactions()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer'));
    if ($auth_user) {
        $offset = $get_data['offset'];
        $table = $wpdb->prefix . 'wallet_withdrawal';
        $wallet_transaction = get_custom_table($table, "user_id=$user_id ORDER BY created_on DESC LIMIT 7 OFFSET $offset", 'user_id,amount,created_on');
        foreach ($wallet_transaction as $key => $value) {
            $value->withdraw_date = change_date_format($value->created_on, 'd-M-Y');
        }
    } else {
        $wallet_transaction = $auth_user;
    }
    $response = return_response_data($wallet_transaction);
    echo json_encode($response);
    die();
}



function json_get_shop_summary()
{

    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer'));
    if ($auth_user) {
    } else {
        $wallet_transaction = $auth_user;
    }
    $response = return_response_data($wallet_transaction);
    echo json_encode($response);
    die();
}

function get_categories_by_id($code = "", $taxonomy_type, $get_data)
{

    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $role = get_current_user_role($user_id);

    if ($role == "customer") {
        $type_id = get_shop_id_by_shope_code($code);
    } elseif ($role == "shop") {
        $type_id = get_shop_id_by_user_id($user_id);
    }
    $category_data = get_custom_table($wpdb->prefix . 'category_master', "type_id=$type_id", 'distinct category_id');
    $categor_array = array();
    foreach ($category_data as $key => $value) {
        /*  $value->category_name = get_taxonomy_name($value->category_id,$taxonomy_type); */
        $categor_array[$value->category_id] = get_taxonomy_name($value->category_id, $taxonomy_type);
    }
    return $categor_array;
}
function json_get_bank_account_details()
{

    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer'));
    if ($auth_user) {
        $table = $wpdb->prefix . 'user_bank_detail';
        $bank_data = get_custom_single_row($table, "user_id = $user_id");
        $log['bank-data'] = get_print_log();
    } else {
        $bank_data = $auth_user;
    }
    $response = return_response_data($bank_data, $log);
    echo json_encode($response);
    die();
}
function json_search_data()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin', 'customer', 'shop'));
    /*    if ($auth_user) { */
    $table = $wpdb->prefix . 'shops';
    $search_text = $get_data['keyword'];
    $search_data = get_custom_table($table, "shop_name like '%$search_text%' LIMIT 20", 'shop_name,district_id,shop_id,profile_pic,shop_mobile,town_name');
    $log['search_data'] = get_print_log();
    foreach ($search_data as $key => $value) {
        $value->image = wp_get_attachment_image_src($value->profile_pic)[0];
        $value->shop_name = $value->shop_name;
        $value->mobile = $value->shop_mobile;
    }
    /*   } 
    else {
        $search_data = $auth_user;
    } */
    $response = return_response_data($search_data, $log);
    echo json_encode($response);
    die();
}
function submit_function_add_requirements()
{
    global $wpdb;
    $sucesss = true;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $required_type = $get_data['required_type'];
    if ($required_type == "shop") {
        $user_data = get_custom_single_row($wpdb->prefix . 'shops', "shop_id = $user_id", 'shop_mobile,shop_name,shop_email');

        $mobile = $user_data->shop_mobile;
        $email = $user_data->shop_email;
        $get_data['content'] = "Message From Shop<br>" . $get_data['content'] . "<br> Sent From:<a href='tel:$mobile'>$mobile</a> <br> Email : <a href='mailto:$email'>$email</a>  ";
        $name = "SHOP -" .  $user_data->shop_name;
        $get_data['title'] = $name;
    } else if ($required_type == "customer") {
        $user_data = get_custom_single_row($wpdb->prefix . 'user_data', "ID = $user_id", 'ID,mobile,display_name');

        $wp_user_data = get_userdata($user_id);
        $user_email = $wp_user_data->user_email;
        $mobile = $user_data->mobile;
        $name = $user_data->display_name;
        $get_data['title'] = $name;
        $get_data['content'] = $get_data['content'] . "<br> Sent From:<a href='tel:$mobile'>$mobile</a> <br> Email : <a href='mailto:$user_email'>$user_email</a>  ";
    }
    //chnages


    $grievance_id = manage_post($get_data, 'create');
    if ($grievance_id) {
        $sucesss = true;
    } else {
        $sucesss = false;
    }
    if ($sucesss == true) {

        requirment_mail($name, $mobile, $get_data['content']);
        $response = array('id' => $grievance_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Your requirment has placed');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => "failed");
    }
    $addl_response = array('redirecturl' => home_url() . '/grievences');
    echo build_response_json($response, $addl_response);
    die();
}
function json_get_messages()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $args = array(
            'post_type' => 'message',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'numberposts'      => -1,
            'fields' => 'post_title,post_content'
        );
        $posts = get_posts($args);
        $msg_array = array();
        foreach ($posts as $key => $value) {
            $msg = new stdClass;
            $msg->name = $value->post_title;
            $msg->message = $value->post_content;
            $msg->date = change_date_format($value->post_date, 'd-M-Y');
            $msg_array[$key] = $msg;
        }
    } else {
        $msg_array = $auth_user;
    }
    $response = return_response_data($msg_array);
    echo json_encode($response);
    die();
}
function json_get_user_detail_for_managment()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    $search_text = $get_data['user_login'];
    if ($auth_user) {
        $search_string = esc_attr(trim($search_text));
        $user_data = get_user_by('login', $search_text);
        $user_id = $user_data->ID;
        $user_custom_data = get_custom_single_row($wpdb->prefix . 'user_data', "ID = $user_id");
        $log['user_custom_data'] = get_print_log();
        $user_custom_data->user_email = $user_data->user_email;
        $custom_logo_id = get_theme_mod('custom_logo');
        $profile_pic = wp_get_attachment_image_src($user_custom_data->profile_pic);
        //$image = wp_get_attachment_image_src($custom_logo_id, 'thumbnail');
        //$user_custom_data->image_logo = str_replace('localhost', '192.168.1.3', $image[0]);
        $user_custom_data->image_profile = $profile_pic[0];
        $user_custom_data->country_id = get_country_id($user_custom_data->district_id);
        $user_custom_data->state_id = state_by_district($user_custom_data->district_id);

        $user_bank_detais = get_custom_single_row($wpdb->prefix . 'user_bank_detail', "user_id = $user_id");
        $log['bank_details'] = get_print_log();
        if ($user_bank_detais) {
            $user_custom_data->bank_data = $user_bank_detais;
        }
    } else {
        $user_custom_data = $auth_user;
    }
    $response = return_response_data($user_custom_data, $log);
    echo json_encode($response);
    die();
}



function json_generate_wallet_withdraw_csv()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $result = $wpdb->get_results(" SELECT * FROM `us_wallet_withdrawal` W  INNER JOIN us_user_bank_detail B on W.user_id = B.user_id WHERE status = 1");
        $wallet_data_array = array();
        foreach ($result as $key => $value) {
            $user_data = get_custom_single_row($wpdb->prefix . "user_data", "ID = $value->user_id", "mobile");
            $user_bank_data = get_custom_single_row($wpdb->prefix . "user_bank_detail", "user_id = $value->user_id");
            $log['user-bank-data'] = get_print_log();
            $new_array = array(
                "RazorpayX Account Number" => "4564564147379011",
                "Payout Amount (in Rupees)" => $value->amount,
                "Payout Currency" => "INR",
                "Payout Mode" => "IMPS",
                "Payout Purpose" => "payout",
                "Fund Account Id" => $user_bank_data->razor_pay_fund_account_id,
                "Fund Account Type" => "bank_account",
                "Fund Account Name" => $user_bank_data->account_holder_name,
                "Fund Account Ifsc" => $value->ifsc_code,
                "Fund Account Number" => $value->account_no,
                "Fund Account Vpa" => $value->upi_id,
                "Fund Account Phone Number" => $user_data->mobile,
                "Contact Name" => "",
                "Payout Narration" => "Upstores Wallet Withdrwal",
                "Payout Reference Id" => "",
                "Fund Account Email" => "",
                "Contact Type" => "",
                "Contact Email" => "upstoresjk@gmail.com",
                "Contact Mobile" => "",
                "Contact Reference Id" => "",
                "notes[place]" => "",
                "notes[code]" => ""
            );
            $wallet_data_array[] = $new_array;
        }

        $list = $wallet_data_array;
        $filename  = "../wp-content/uploads/csv/" . strtotime(date('d-m-y')) . "_withdraw.csv";
        $fp = fopen($filename, 'w');
        //Write the header

        fputcsv($fp, array_keys($list[0]));
        //Write fields
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        $url_data['url'] = get_site_url() . '/' . $filename;
        $url_data['log'] = $log;
        $update_data = array(
            'status' => 2
        );
        $where = array(
            'status' => 1
        );
        $update_data = update_custom_table("us_wallet_withdrawal", $update_data, $where);
    } else {
        $url_data = $auth_user;
    }
    $response = return_response_data($url_data);
    echo json_encode($response);
    die();
}
