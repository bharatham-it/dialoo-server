<?php



add_action('wp_ajax_nopriv_get_pie_count_users', 'get_pie_count_users');
add_action('wp_ajax_get_pie_count_users', 'get_pie_count_users');

add_action('wp_ajax_nopriv_get_pie_count_categories', 'get_pie_count_categories');
add_action('wp_ajax_get_pie_count_categories', 'get_pie_count_categories');


add_action('wp_ajax_nopriv_get_pie_count_purchase', 'get_pie_count_purchase');
add_action('wp_ajax_get_pie_count_purchase', 'get_pie_count_purchase');

add_action('wp_ajax_nopriv_get_hundread_pv_achivers', 'get_hundread_pv_achivers');
add_action('wp_ajax_get_hundread_pv_achivers', 'get_hundread_pv_achivers');


add_action('wp_ajax_nopriv_get_top_earners', 'get_top_earners');
add_action('wp_ajax_get_top_earners', 'get_top_earners');

add_action('wp_ajax_nopriv_json_clear_admin_wallet', 'json_clear_admin_wallet');
add_action('wp_ajax_json_clear_admin_wallet', 'json_clear_admin_wallet');





add_action('wp_ajax_nopriv_update_admin_settings', 'update_admin_settings');
add_action('wp_ajax_update_admin_settings', 'update_admin_settings');


add_action('wp_ajax_nopriv_json_get_admin_count_reports', 'json_get_admin_count_reports');
add_action('wp_ajax_json_get_admin_count_reports', 'json_get_admin_count_reports');

add_action('wp_ajax_nopriv_get_withdrwal_report', 'get_withdrwal_report');
add_action('wp_ajax_get_withdrwal_report', 'get_withdrwal_report');


add_action('wp_ajax_nopriv_json_get_admin_purchase_reports', 'json_get_admin_purchase_reports');
add_action('wp_ajax_json_get_admin_purchase_reports', 'json_get_admin_purchase_reports');


add_action('wp_ajax_nopriv_add_razor_pay_topup', 'add_razor_pay_topup');
add_action('wp_ajax_add_razor_pay_topup', 'add_razor_pay_topup');




function approve_top_up_request()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $table = $wpdb->prefix . 'topup_transaction';
        $id = $get_data['id'];
        $amount = get_amount_by_transaction_id($id);
        $data = array(
            'custom_status' => 39,
            'approved_by' => $user_id
        );
        $where = array(
            'id' => $id
        );
        $shop_id = get_shop_id_by_transaction_id($id);
        $topup_id = update_custom_table($table, $data, $where);

        $top_up_array['debit'] = $shop_id;
        $top_up_array['credit'] = -1;
        $top_up_array['type'] = "top_up";
        $top_up_array['action'] = "+";
        $top_up_array['amount'] = $amount;
        $ledger_entry = add_ledger($top_up_array);

        walletUpdate($amount, $shop_id, '+');
        if ($topup_id && $ledger_entry) {
            $sucesss = true;
        } else {
            $sucesss = false;
        }
        if ($multiple_tables_affected == true) {
            commit_transaction($sucesss);
            roll_back_transaction(!$sucesss);
        }
        if ($sucesss == true) {
            $response = array('id' => $topup_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Top up Requested ');
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
        }
        echo build_response_json($response);
        die();
    }
}
function add_razor_pay_topup()
{

    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop'));
    if ($auth_user) {

        $table = $wpdb->prefix . 'topup_transaction';
        
        


        $params = array('amount', 'shop_id', 'custom_status', 'created_by', 'device','screenshot_id');
        $get_data['created_by'] = $get_data['current_user_id'];
         $get_data['shop_id'] = get_shop_id_by_user_id($user_id);
        //File upload
        $file = $_FILES['file'];
        $get_data['screenshot_id'] = upload_file($file, $get_data['shop_id']);
        ///////
        $topup_id = add_to_customtable($get_data, $table, $params);
        $log['insert_custom_table']= get_print_log();

        

        $id = $get_data['id'];
        $amount = $get_data['amount'];

        $shop_id = $get_data['shop_id'];
     


        $top_up_array['debit'] = $shop_id;
        $top_up_array['credit'] = -1;
        $top_up_array['type'] = "top_up";
        $top_up_array['action'] = "+";
        $top_up_array['amount'] = $amount;
        $ledger_entry = add_ledger($top_up_array);
        $log['ledger']= get_print_log();

        walletUpdate($amount, $shop_id, '+');
        if ($topup_id && $ledger_entry) {
           
            $sucesss = true;
        } else {
                   
            $sucesss = false;
        }
        if ($multiple_tables_affected == true) {
           
            commit_transaction($sucesss);
            roll_back_transaction(!$sucesss);
        }
        if ($sucesss == true) {
          
            $response = array('id' => $topup_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Top up Requested ');
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error',"log"=>$log);
        }
        echo build_response_json($response);
        die();
    }

}
function reject_top_up_request()
{
    
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if($auth_user){
        $table = $wpdb->prefix . 'topup_transaction';
        $id = $get_data['id'];
        $data = array(
            'custom_status' => 40,
            'approved_by' => $user_id
        );
        $where = array(
            'id' => $id
        );
        $shop_id = get_shop_id_by_transaction_id($id);
        $topup_id = update_custom_table($table, $data, $where);
    }
    if ($topup_id) {
        $sucesss = true;
    } else {
        $sucesss = false;
    }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if ($sucesss == true) {
        $response = array('id' => $topup_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Top up rejected ');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
    }
    echo build_response_json($response);
    die();
 
}


function get_amount_by_transaction_id($id)
{
    global $wpdb;
    $table = $wpdb->prefix . 'topup_transaction';
    $result_data = get_custom_single_row($table, 'id=' . $id);
    return $result_data->amount;
}
function get_shop_id_by_transaction_id($id)
{
    global $wpdb;
    $table = $wpdb->prefix . 'topup_transaction';
    $result_data = get_custom_single_row($table, 'id=' . $id);
    return $result_data->shop_id;
}
function json_count_category_users()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_shops = $wpdb->prefix."shops";
       $table_users = $wpdb->prefix."user_data";
       $category_users = get_group_by($table_shops,"1=1","count(owner_id) as count,type",'type');
      

    } else {
        $category_users = $auth_user;
    }
    $response = return_response_data($category_users);
    echo json_encode($response);
    die();

}
function json_clear_admin_wallet()
{
    global $wpdb;
    $get_data = get_form_request('formdata');

    $table = $wpdb->prefix.'user_returns';
    $company_id = get_company_id();
    $data = array(
        'company_dpv' => 0
    );
    $where = array(
        'user_id' => $company_id
    );
    $update_data = update_custom_table($table,$data,$where);   
    $log['update_data'] = get_print_log();
    if($update_data)
    {
        $sucesss = true;
    }
    else
    {
        $sucesss = false;
    }
    if ($sucesss == true) {
        $response = array('id' => $update_data, 'status' => 1, 'title' => 'success', 'subtitle' => 'Reset Completed');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
    }
    
    echo build_response_json($response,$log);
    die();

    
}






function get_pie_count_users()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_shops = $wpdb->prefix."shops";
       $table_users = $wpdb->prefix."user_data";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    
    $new_user_count = get_custom_table($table_users,"created_on >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH)
    AND created_on <  (LAST_DAY(NOW()) + INTERVAL 1 DAY) AND role = 'customer'","COUNT(ID) as COUNT");
    $log['new_user_count'] = get_print_log();
    $total_user_count = get_custom_table($table_users,"role= 'customer'","COUNT(ID) as COUNT");
    $log['total_user_count'] = get_print_log();
    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as count,type",'type');
    $log['category_users'] = get_print_log();
    $user_count_array = array();
    $user_count_array['users']['new_user_count']  = $new_user_count[0]->COUNT;
    /* $user_count_arra['users']['total_user_count']  = 15; */
    $user_count_array['users']['balance_user']  = $total_user_count[0]->COUNT ;
 
    } else {
        $user_count_array = $auth_user;
    }
    $response = return_response_data($user_count_array,$log);
    echo json_encode($response);
    die();

}

function get_pie_count_categories()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_shops = $wpdb->prefix."shops";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as count,type",'type');
   
    } else {
        $category_users = $auth_user;
    }
    $response = return_response_data($category_users,$log);
    echo json_encode($response);
    die();

}
function get_pie_count_purchase()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_shops = $wpdb->prefix."purchase";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $purchase = get_custom_table($table_shops,"1=1","sum(pay_amount) as pay_sum");
    $log['purchase'] = get_print_log();
    $purchase_array = array();
    $purchase_array['total_purchase'] = $purchase[0]->pay_sum;

    $new_purchase = get_custom_table($table_shops,"1=1 and created_on >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AND created_on <  (LAST_DAY(NOW()) + INTERVAL 1 DAY)","sum(pay_amount) as pay_amount");
    $log['new-purchase'] = get_print_log();
    $purchase_array['new_purchase'] = $new_purchase[0]->pay_amount;
    $purchase_array['old_purchase'] =  $purchase[0]->pay_sum - $new_purchase[0]->pay_amount;

   
    } else {
        $purchase_array = $auth_user;
    }
    $response = return_response_data($purchase_array,$log);
    echo json_encode($response);
    die();

}



function vendor_count()
{
    global $wpdb;
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_shops = $wpdb->prefix."shops";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    
    $new_user_count = get_custom_table($table_shops,"created_on BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE()","COUNT(ID) as COUNT");
    $total_user_count = get_custom_table($table_shops,"1=1","COUNT(ID) as COUNT");

    $user_count_array = array();
    $user_count_array['new_user_count']  = $new_user_count[0]->count;
    $user_count_array['total_user_count']  = $total_user_count[0]->count;
    $user_count_array['balance_user']  = $total_user_count[0]->count - $new_user_count[0]->count ;



    } else {
        $user_count_array = $auth_user;
    }
    $response = return_response_data($user_count_array);
    echo json_encode($response);
    die();
}




function get_hundread_pv_achivers()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_users = $wpdb->prefix."user_returns";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $achivers = get_custom_table($table_users,"pv >= 100 LIMIT 100 ",'user_id,pv');
    $log['achivers'] = get_print_log();
    foreach($achivers as $key => $value)
    {
       
        $value->display_name = get_display_name($value->user_id);
        $value->total_customers =  get_total_customers($value->user_id);
        $value->levels =  get_level_count($value->user_id);
    }

    } else {
        $achivers = $auth_user;
    }
    $response = return_response_data($achivers,$log);
    echo json_encode($response);
    die();

}


function get_total_customers($parent_id)
{
    global $wpdb;
    $level_count = get_count_custom_table($wpdb->prefix."user_relation_child","parent_id = $parent_id","child_id");
    return $level_count;

}

function get_level_count($parent_id)
{
    global $wpdb;
    $level_count = get_custom_table($wpdb->prefix."user_relation_child","parent_id = $parent_id","max(level_id) as level_count");
    if($level_count[0]->level_count > 10)
    {
        return 10;
    }
    return $level_count[0]->level_count;

}

function get_top_earners()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_wallet = $wpdb->prefix."wallet_withdrawal ";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $top_earners = get_group_by($table_wallet,"1=1","SUM(amount) as amount,user_id","user_id ORDER BY amount ASC");
    $log['top-earners'] = get_print_log();
    foreach($top_earners as $key => $value)
    {
        $value->display_name = get_display_name($value->user_id);
        $value->total_customers =  get_total_customers($value->user_id);
        $value->levels =  get_level_count($value->user_id);
    }

    } else {
        $top_earners = $auth_user;
    }
    $response = return_response_data($top_earners,$log);
    echo json_encode($response);
    die();
}


function update_admin_settings()
{ 
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    $get_data = get_form_request('formdata');
  
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if($auth_user){
        $table = $wpdb->prefix . 'settings';
        
        $value = $get_data['value'];
        $settings_type = $get_data['settings_type'];
        foreach($settings_type as $key=>$value)
        {
            $exist_check = get_count_custom_table($table,"settings_type = '$key' ");
      
            if($exist_check !== "0")
            {
    
                $data = array(
                    'settings_type' => $key,
                    'value' => $value
                );
    
                $where = array(
                    'settings_type' => $key
                );
    
                $settings_id = update_custom_table($table,$data,$where);
            }
            else
            {
                $data = array(
                    'settings_type' => $key,
                    'value' => $value
                );
                $settings_id = insert_custom_table($table,$data);
    
            }

        }

       


        
    }
    if ($settings_id) {
        $sucesss = true;
    } else {
        $sucesss = false;
    }
    if ($multiple_tables_affected == true) {
        commit_transaction($sucesss);
        roll_back_transaction(!$sucesss);
    }
    if ($sucesss == true) {
        $response = array('id' => $settings_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Updated');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
    }
    echo build_response_json($response);
    die();


}

   // 
function json_get_admin_count_reports()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_users = $wpdb->prefix."user_data ";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $top_earners = get_custom_table($table_users,"role = 'customer'","COUNT(ID) as total_users");
    $log['top-earners'] = get_print_log();

    } else {
        $top_earners = $auth_user;
    }
    $response = return_response_data($top_earners,$log);
    echo json_encode($response);
    die();

}

//SELECT SUM(pay_amount) as amount FROM us_purchase WHERE shop_id in(SELECT shop_id FROM us_shops WHERE type ='shop')
function json_get_admin_purchase_reports()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table_purchase = $wpdb->prefix."purchase ";
       $table_shops = $wpdb->prefix."shops ";
       $type = $get_data['type'];
       $date_query = build_date_query($get_data);
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */
    $purchase_data = get_custom_table($table_purchase,"shop_id in(SELECT shop_id FROM $table_shops WHERE type = '$type') $date_query","SUM(pay_amount) as amount");
    $log['top-earners'] = get_print_log();

    } else {
        $purchase_data = $auth_user;
    }
    $response = return_response_data($purchase_data,$log);
    echo json_encode($response);
    die();

}


function get_withdrwal_report()
{
    //
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $log['getdata'] = $get_data;
    $date_query = build_date_query($get_data,"created_on","from_date","to_date");
    $log['date-query'] = $date_query;
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
       $table = $wpdb->prefix."wallet_withdrawal";
    /*    $category_users = get_group_by($table_shops,"1=1","count(owner_id) as user_count,type",'type'); */

    $total_earnings = get_custom_table($table,"1=1","SUM(amount) as total_amount");
    $total_earnings_date = get_custom_table($table,"1=1 $date_query","SUM(amount) as total_amount");

    $withdraw_data = get_custom_table($table,"1=1 $date_query");
    $log['total_withdraw_data_dated'] = get_print_log();
    foreach($withdraw_data as $key => $value)
    {
        $value->name = get_display_name($value->user_id);
    }

    $data_array = array(
        'total_withdrawal' => $total_earnings[0]->total_amount,
        'total_withdrwal_dated' => $total_earnings_date[0]->total_amount,
        'total_withdrawal_data' => $withdraw_data

    );
    
    $log['top-earners'] = get_print_log();

    } else {
        $data_array = $auth_user;
    }
    $response = return_response_data($data_array,$log);
    echo json_encode($response);
    die();
}


