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

if (is_user_logged_in()) {
    $loggedinuser = get_current_user_data();
    $user_roles = $loggedinuser['roles'];
    $types = array();
    if (in_array('shop', $user_roles)) {
        $types = array_merge($types, array('shop'));
    }
    if (in_array('administrator', $user_roles)) {
        $types = array_merge($types, array('customer', 'shop'));
    }

    $template = array();
    foreach (array_unique($types) as $type) {
        if (is_array($type)) {
            foreach ($type as $typ) {
                $template[] = TEMPLATEDIR . '/page-templates/' . $typ . '-template.php';
            }
        } else {
            $template[] = TEMPLATEDIR . '/page-templates/' . $type . '-template.php';
        }
    }
    locate_template($template);
}

function get_role_names($exclude = array())
{
    global $wp_roles;
    if (!isset($wp_roles))
        $wp_roles = new WP_Roles();
    $user_roles = $wp_roles->get_names();
    $roles = array_diff($user_roles, $exclude);
    return $roles;
}
function get_current_user_role($user_id)
{
    $user_data = get_userdata($user_id);
    return $user_data->roles[0];
}
function get_current_user_data()
{
    $current_user = wp_get_current_user();
    $user_data = array(
        'name' => $current_user->display_name,
        'roles' => $current_user->roles,
        'email' => $current_user->user_email
    );
    return $user_data;
}

function get_display_name($user_id)
{
    if (!$user = get_userdata($user_id))
        return false;
    return $user->data->display_name;
}

function get_users_by_role($role, $orderby = 'display_name', $order = 'ASC')
{
    $args = array('role' => $role, 'orderby' => $orderby, 'order' => $order);
    $users = get_users($args);
    return $users;
}
add_filter('login_errors', 'login_error_message');

function login_error_message($error)
{
    //check if that's the error you are looking for
    $pos = strpos($error, 'incorrect');
    if (is_int($pos)) {
        //its the right error so you can overwrite it
        $error = "Wrong Password";
    }
    return $error;
}

add_action('wp_ajax_nopriv_submit_function_login_user', 'submit_function_login_user');
add_action('wp_ajax_submit_function_login_user', 'submit_function_login_user');

function submit_function_login_user()
{
    $get_user_data = get_form_request('formdata');
    $params = array('user_login', 'user_password', 'remember');
    $prefix = '';
    $build_userdata = build_form_data($get_user_data, $params, $prefix);
    $res = wp_signon($build_userdata, true);
    if (!is_wp_error($res)) {
        $user_id = $res->ID;
        wp_clear_auth_cookie();
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
        $response = array('id' => $user_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Logged in sucessfully !', 'url' => '', 'result' => array('user_id' => $user_id, 'role' => $res->roles[0]));
    } else {
        $msg =  login_error_message($res->get_error_message());
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $msg);
    }
    $addl_response = array('redirecturl' => get_home_url() . '/dashboard');
    echo  build_response_json($response, $addl_response);
    die();
}

add_action('wp_ajax_nopriv_submit_function_register_user', 'submit_function_register_user');
function submit_function_register_user()
{
    $get_user_data = get_form_request('formdata');
    $params = array('user_login', 'user_pass', 'user_email', 'role');
    $prefix = '';
    $build_userdata = build_form_data($get_user_data, $params, $prefix);
    $res = wp_insert_user($build_userdata);
    $user_id = $res->ID;
    if (!is_wp_error($res)) {
        $response = array('id' => $user_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Registered in sucessfully !', 'url' => '');
    } else {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $res->get_error_message());
    }
    $addl_response = array('redirecturl' => '');
    echo  build_response_json($response, $addl_response);
    die();
}
function add_user_with_role()
{
    $get_data = get_form_request('formdata');
    $params = array('user_login', 'user_pass', 'user_email', 'role');
    $build_data = build_form_data($get_data, $params, '');
    $user_id = wp_insert_user($build_data);
    return $user_id;
}

function wp_get_menu_array($current_menu)
{

    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    if (!empty($array_menu)) {
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['ID']      =   $m->ID;
                $menu[$m->ID]['title']       =   $m->title;
                $menu[$m->ID]['url']         =   $m->url;
                $menu[$m->ID]['children']    =   array();
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['ID']       =   $m->ID;
                $submenu[$m->ID]['title']    =   $m->title;
                $submenu[$m->ID]['url']  =   $m->url;
                $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }
        return $menu;
    }
}
function get_user_id_by_sponser_code($sponser_code)
{
    global $wpdb;
    $user = get_custom_single_row($wpdb->prefix . 'user_data', "sponser_code= '$sponser_code'");
    return $user->ID;
}
function get_shop_id_by_shope_code($shop_Code)
{
    global $wpdb;
    $user = get_custom_single_row($wpdb->prefix . 'shops', 'shop_code="' . $shop_Code . '"', 'shop_id');
    return $user->shop_id;
}

function remove_administrator($users)
{
    foreach ($users as $key => $user) {
        $cap = reset($user->roles);
        if ($cap === 'administrator') {
            unset($users[$key]);
        }
    }
    return $users;
}

add_action('wp_ajax_nopriv_submit_function_customer_registration', 'submit_function_customer_registration');
add_action('wp_ajax_submit_function_customer_registration', 'submit_function_customer_registration');
function submit_function_customer_registration()
{

    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_user_data = get_form_request('formdata');
    $params = array('user_login', 'user_pass', 'user_email', 'role');
    $prefix = '';
    $build_userdata = build_form_data($get_user_data, $params, $prefix);
    $user_id = wp_insert_user($build_userdata);
    $user_meta = update_user_meta($user_id, 'mobile', $get_user_data['mobile']);
    $parent_id =   get_user_id_by_sponser_code($get_user_data['sponser_code']);
    if (is_numeric($user_id) &&  $user_id > 0) {
        // for image upload

        //end of image upload-featured image
        $params = array('mobile', 'alt_mobile', 'display_name', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'postoffice', 'landmark','role');
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $build_custom_table_data = array(
            'ID' => $user_id,
            'sponser_code' => 'UPST' . $user_id . generateRandomString($characters)
        );
      

        foreach ($params as $param) {
            $build_custom_table_data[$param] = $get_user_data[$param];
        }
         $custom_id = insert_custom_table($wpdb->prefix . 'user_data', $build_custom_table_data); //custom table
    
        $user_relation = add_user_relation($user_id, $parent_id, 1);
 
        $user_parent_relation = add_parent_user_level_relation($user_id, $parent_id);

        $bank_details = insert_custom_table($wpdb->prefix.'user_bank_detail',array('user_id' => $user_id));
  
        $user_return_data = array(
            'user_id' => $user_id
        );
        $insert_user_return = insert_custom_table('us_user_returns', $user_return_data);
    
        if ($custom_id && $user_relation && $insert_user_return && $bank_details) {

            $sucesss = true;
        } else {
            $sucesss = false;
            $error_msg = "error";
        }
    } else {
        $sucesss = false;
        $error_msg = $user_id->get_error_message();
    }


    if ($multiple_tables_affected == true) {

        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }

    if ($sucesss == true) {
/*         welcome_email($get_data['user_email'], $get_data['display_name']); */
        $response = array('id' => $user_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Added New User');
    } else if ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $error_msg);
    }
    $addl_response = array('redirecturl' => home_url() . '/farms');
    echo build_response_json($response, $addl_response);
    die();
}

add_action('wp_ajax_submit_function_update_profile', 'submit_function_update_profile');
add_action('wp_ajax_nopriv_submit_function_update_profile', 'submit_function_update_profile');
function submit_function_update_profile()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_user_data = get_form_request('formdata');
    $role = get_current_user_role($get_user_data['user_key']);
    $build_userdata = array();
    
    if($role == "upadmin")
    {
       
        
        $user_id = $get_user_data['id']; 

    }
    else
    {
        $user_id= $get_user_data['user_key'];
    }
    $user_data = get_userdata($user_id);
    $params = array('display_name');
    if($user_data->user_email != $get_user_data['user_email'])
    {
      array_push($params,'user_email');
    }

    if($get_user_data['user_pass'])
    {
        
        array_push($params,"user_pass");
    }
    $prefix = '';
    $build_userdata = build_form_data($get_user_data, $params, $prefix);
    $build_userdata['ID'] = $user_id;  
    if($role == "upadmin")
    {
        $build_userdata['ID'] = $get_user_data['id']; 
        $bank_params = array('account_no','pan_number','account_holder_name','upi_id','ifsc_code');
        
        foreach ($bank_params as $param) {
            $build_bank_datas[$param] = $get_user_data[$param];
        }
        $where = array(
            'user_id' =>  $get_user_data['id']
        );
        $update_bank_detail = update_custom_table($wpdb->prefix.'user_bank_detail',$build_bank_datas,$where);
       $log['bank_update'] = get_print_log();
    }
   
    $user_id = wp_update_user($build_userdata);
    //$user_id = $res->ID;

    
    $params = array('mobile', 'alt_mobile', 'display_name', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'postoffice', 'landmark', 'profile_pic');
    
    if (is_numeric($user_id) &&  $user_id > 0) {
        if($_FILES['file'] && $_FILES['name'] != "undefined")
        {       
          
            
            array_push($params,"profile_pic");
            $attachment_id = image_handle("create");
            $get_data['profile_pic'] = $attachment_id;
        }
       

        $get_user_data['profile_pic'] = $attachment_id;
        foreach ($params as $param) {
            $build_custom_table_data[$param] = $get_user_data[$param];
        }
        $where = array('ID' => $user_id);
        $custom_id = update_custom_table($wpdb->prefix . 'user_data', $build_custom_table_data, $where); //custom table

        $log['update_user_table'] = get_print_log();

        if ($user_id && $custom_id) {

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

        $response = array('id' => $user_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Updated Successfully','log'=>$log);
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $user_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/farms');
    echo build_response_json($response, $addl_response);
    die();
}
function get_user_id_by_email($email)
{
    $user = get_user_by('email', $email);
    return $user->ID;
}


add_action('wp_ajax_nopriv_generate_otp', 'generate_otp');
add_action('wp_ajax_generate_otp', 'generate_otp');

function generate_otp()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_email = $get_data['user_email'];
    if (email_exists($user_email)) {
        $user_id = get_user_id_by_email($user_email);
        $user_displayname = get_display_name($user_id);
        $auth_user = authorize_app_user($user_id, array('shop', 'upadmin', 'customer'));
        if ($auth_user) {
            $table = $wpdb->prefix . 'user_data';
            $characters = "1234567890";
            $otp = generateRandomString($characters);

            $data = array(
                'otp' => $otp
            );
            $where = array(
                'ID' => $user_id
            );
            $otp_update = update_custom_table($table, $data, $where);
            if ($otp_update) {
               /*  email_forgot_otp($user_displayname, $user_email, $otp); */
                $response =  $response = array('id' => 0, 'status' => 1, 'title' => $otp, 'subtitle' => 'has sent to your email..',);
            }
        } else {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'invalid authentication');
        }
    } else {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'Enter a valid email address');
    }
    $result = build_response($response);
    echo json_encode($result);


    die();
}
add_action('wp_ajax_validate_otp', 'validate_otp');
add_action('wp_ajax_nopriv_validate_otp', 'validate_otp');

function validate_otp()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_email = $get_data['user_email'];
    $otp = $get_data['otp'];
    $user_id = get_user_id_by_email($user_email);
    $otp_check = get_custom_single_row($wpdb->prefix . 'user_data', 'ID=' . $user_id . ' and otp=' . $otp);
    if ($otp_check) {
        $response = array('id' => 0, 'status' => 1, 'title' => 'sucessfully verified', 'subtitle' => 'Verfied');
    } else {
        $response = array('id' => 0, 'status' => 2, 'title' => 'OTP VERIFICATION', 'subtitle' => 'Failed');
    }
  $result = build_response($response);
  echo json_encode($result);
    die();
}


add_action('wp_ajax_update_password', 'update_password');
add_action('wp_ajax_nopriv_update_password', 'update_password');
function update_password()
{
    $get_data = get_form_request('formdata');
    $user_email = $get_data['user_email'];
    $user_id = get_user_id_by_email($user_email);
    $password = $get_data['user_pass'];
    $user_data = wp_update_user(array('ID' => $user_id, 'user_pass' => $password));
    if (!is_wp_error($user_data)) {

        $response = array('id' => $user_data->id, 'status' => 1, 'title' => 'Updated', 'subtitle' => 'password');
    } else {

        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
    }
    echo json_encode($response);
    die();
}

add_action('wp_ajax_submit_function_update_bank_details', 'submit_function_update_bank_details');
add_action('wp_ajax_nopriv_submit_function_update_bank_details', 'submit_function_update_bank_details');
function submit_function_update_bank_details(){
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
   
    
    $table = $wpdb->prefix.'user_bank_detail';
    $exist_contact = get_custom_single_row($table,"user_id = $user_id",'razor_pay_contact_id'); 
        $razor_pay_contact = create_razor_pay_contact($get_data);
        $get_data['razor_pay_contact_id'] = $razor_pay_contact;
        $get_data['contact_id'] = $razor_pay_contact;
        $razor_pay_fund_account = create_razor_pay_fund_account($get_data);
        $get_data['razor_pay_fund_account_id'] = $razor_pay_fund_account;
      



    
/*     $get_data['razor_pay_contact_response'] = json_encode($razor_pay_contact);
    $get_data['razor_pay_fund_account_response'] =json_encode() $razor_pay_fund_account; */
    
    
     $get_data['update_status'] = 1;
    $params = array('account_no','ifsc_code','account_holder_name','pan_number','upi_id','razor_pay_contact_id','razor_pay_fund_account_id','update_status');
    $build_data = build_data_array_build($get_data,$params);

 

    $where = array(
        'user_id' => $user_id
    );
    $bank_update = update_custom_table($table,$build_data,$where);
    $log['bank'] = get_print_log();

    if ($bank_update) {

        $response = array('id' => 1, 'status' => 1, 'title' => 'Bank Details', 'subtitle' => 'Updated');
    } else {

        $response = array('id' => 2, 'status' => 2, 'title' => 'failed', 'subtitle' => 'Updating','log' => $log);
    }
    $result = build_response($response);
    echo json_encode($result);
    die();
}

function get_customer_razorpay_contact($user_id)
{
    global $wpdb;
    $bank_data = get_custom_single_row($wpdb->prefix.'user_bank_detail',"user_id = $user_id","razor_pay_fund_account_id");
    return $bank_data->razor_pay_fund_account_id;
}


function get_customer_summary($customer_id)
{
global $wpdb;
$customer_summary=array();
$cpv=get_tpv($customer_id);
$ppv=get_ppv($customer_id);
$total_amount=$cpv+$ppv;
$table=$wpdb->prefix.'purchase';
$where='user_id='.$customer_id;
$fields='sum(discount_amount) as discount,sum(pay_amount) as paid_amount';
$groupby='user_id';
$purchase_details=get_group_by($table,$where,$fields,$groupby);
return $customer_summary;

}
// User password change from logged in w

add_action('wp_ajax_nopriv_submit_function_change_password', 'submit_function_change_password');
add_action('wp_ajax_submit_function_change_password', 'submit_function_change_password');

function submit_function_change_password()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $old_pwd = $get_data['old_password'];
    $user_data = get_user_by("ID",$user_id);
   $check_pwd = wp_check_password( $old_pwd, $user_data->data->user_pass, $user_data->ID );

    if ( $user_data && wp_check_password( $old_pwd, $user_data->data->user_pass, $user_data->ID ) ) {
       
        $user_data_array = array("ID" => $user_id,"user_pass"=>$get_data['user_pass']);
     $user_pwd_update = wp_update_user($user_data_array);
    if ($user_pwd_update) {

        $response = array('id' => 1, 'status' => 1, 'title' => 'Password Changed', 'subtitle' => 'Successfully');
    } else {

        $response = array('id' => 2, 'status' => 2, 'title' => 'Password Change', 'subtitle' => 'Failed');
    }
    } else {
        $response = array('id' => 2, 'status' => 2, 'title' => 'Incorrect', 'subtitle' => 'old password');
    }

  
    $result = build_response($response);
    echo json_encode($result);
    die();
}





