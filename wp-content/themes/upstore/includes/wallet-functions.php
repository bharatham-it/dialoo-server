<?php
add_action('wp_ajax_nopriv_json_get_admin_wallet', 'json_get_admin_wallet');
add_action('wp_ajax_json_get_admin_wallet', 'json_get_admin_wallet');
function json_get_admin_wallet()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
 /*    if ($auth_user) { */
        $table = $wpdb->prefix.'shops';
        $company_id = get_company_id();
        $company_data = get_custom_single_row($table,"user_id = $company_id");
        $company_data->tpv = get_ppv($company_id);
        $company_data->ppv = get_ppv($company_id);


  /*   } 
    else {
        $search_data = $auth_user;
    } */
    $response = return_response_data($company_data,$log);
    echo json_encode($response);
    die();

}