<?php

add_action('wp_ajax_submit_function_add_shops', 'submit_function_add_shops');
add_action('wp_ajax_nopriv_submit_function_add_shops', 'submit_function_add_shops');

add_action('wp_ajax_nopriv_add_top_up', 'add_top_up');
add_action('wp_ajax_add_top_up', 'add_top_up');



function submit_function_add_shops()
{
    global $wpdb;
    $log = array();
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $get_data['content'] = "";
   
    $shop_id = manage_post($get_data, 'create');

    $file = $_FILES['file'];
    $attachment_id = upload_file($file, $shop_id);
    $get_data['user_login'] = $get_data['title'];
    $get_data['user_pass'] = $get_data['shop_mobile'];
    ///////////
    wp_set_post_terms($shop_id, array($get_data['district_id']), 'districts');
    wp_set_post_terms($shop_id, array($get_data['shop_category_id']), 'shop_categories');
    $params = array('shop_email', 'shop_mobile', 'shop_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','rating','video_url','map_url','gst_no');
    if (is_numeric($shop_id) &&  $shop_id > 0) { 
        $build_shop_price_percent =  build_shop_price_percentage($get_data);
        $shop_user_id = add_user_with_role($get_data);
        $characters = "ABCDEFGHIJKLMONP123456789";
        $type = $get_data['type'];
        if($type == "shop"){

        $code_prefix =  "US-SHOP";
        }
        else if($type == "service"){
            $code_prefix =  "US-SERVICE";
        }
        else if($type == "ownseller"){
            $code_prefix =  "US-SELLER";
        }

        $custom_data = array(
            'shop_id' => $shop_id,
            'shop_name' => $get_data['title'],
            'profile_pic' => $attachment_id,
            'created_by' => $get_data['current_user_id'],
            'shop_offer' => json_encode($build_shop_price_percent, JSON_FORCE_OBJECT),
            'shop_code' => $code_prefix  . $shop_id . generateRandomString($characters, 10),
            'owner_id' => $shop_user_id,
            'type'=>$get_data['type'],
            'device' => $get_data['device']
        );
        $table = $wpdb->prefix . 'shops';
        $custom_id = add_to_customtable($get_data, $table, $params, $custom_data);
        $log['add_to_table'] = get_print_log();
         $categories_id = $get_data['category_percentage']['category'];
        $categories_percentage = $get_data['category_percentage']['percentage'];
        foreach ($categories_id as $key => $value) {
            $table_data = array(
                'type_id' => $shop_id,
                'category_id' => $value,
                'category_percent' => $categories_percentage[$key]
            );
            $category_master = insert_custom_table($wpdb->prefix . 'category_master', $table_data);
        }
        $wallet_data = array(
            'shop_id' => $shop_id,
            'created_by' => $get_data['current_user_id']

        );
        $wallet_data = insert_custom_table($wpdb->prefix . 'shop_wallet', $wallet_data);
        if ($shop_id && $custom_id && !isset($shop_user_id->errors) && $wallet_data && $category_master) {

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
        $response = array('id' => $shop_id, 'status' => 1, 'title' => 'success', 'subtitle' => "New $type Added");
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $shop_user_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/shops');
    echo build_response_json($response, $addl_response);
    die();
}

add_action('wp_ajax_submit_function_update_shops', 'submit_function_update_shops');
function submit_function_update_shops()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true; //up_user and up_add_user
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $params = array('title', 'type', 'status');
    $prefix = 'post_';
    $build_userdata = build_form_data($get_data, $params, $prefix);
    $build_userdata;
    $shop_id = wp_update_post($build_userdata);
    wp_set_post_terms($shop_id, array($get_data['district_id']), 'districts');
    wp_set_post_terms($shop_id, array($get_data['shop_category_id']), 'shop_categories');
    //$user_id = $res->ID;
    $params = array('shop_category_id', 'shop_email', 'shop_mobile', 'shop_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','rating','video_url','map_url','gst_no');
    if (is_numeric($shop_id) &&  $shop_id > 0) {
        $build_custom_table_data = array(
            'shop_name' => $get_data['title'],
            'created_by' => get_current_user_id(),
        );
        foreach ($params as $param) {
            $build_custom_table_data[$param] = $get_data[$param];
        }
        $where = array('shop_id' => $shop_id);
        $custom_id = update_custom_table($wpdb->prefix . 'shops', $build_custom_table_data, $where); //custom table
        if ($shop_id && $custom_id) {

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
        $response = array('id' => $shop_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Shop Updated Successfully');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $shop_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/shops');
    echo build_response_json($response, $addl_response);
    die();
}
add_action('wp_ajax_shop_delete', 'shop_delete');
function shop_delete()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = true;
    start_transaction($multiple_tables_affected);
    $gat_data = $_POST['actionData'];
    $shop_id = $gat_data['id'];
    $res = wp_delete_post($shop_id);
    if ($res) {
        $where = array('shop_id' => $shop_id);
        $res1 = delete_custom_table($wpdb->prefix . 'shops', $where);
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
        $response = array('id' => $shop_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Shop Deleted');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $shop_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/shops');
    echo build_response_json($response, $addl_response);
    die();
}

function add_top_up()
{
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('shop'));

    if ($auth_user) {
        if($get_data['custom_status'] == "39")
        {
            add_razor_pay_topup();
            die();
        }

        $table = $wpdb->prefix . 'topup_transaction';
      
        $params = array('amount', 'shop_id', 'custom_status', 'created_by', 'device','screenshot_id');
        $get_data['created_by'] = $get_data['current_user_id'];
        $get_data['shop_id'] = get_shop_id_by_user_id($user_id);
        //File upload
        $file = $_FILES['file'];
        $get_data['screenshot_id'] = upload_file($file, $get_data['shop_id']);
        ///////
        $topup_id = add_to_customtable($get_data, $table, $params);
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
            $response = array('id' => $topup_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'Top up Requested ');
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error');
        }
        echo build_response_json($response);
        die();
    }
}

function update_shop_profile(){
 
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $owner_id = $get_data['owner_id'];
    $user_params = array();
    if($get_data['user_pass'])
    {
      array_push($user_params,'user_pass');
    }
    $user_params = array('user_pass');
    $auth_user = authorize_app_user($user_id, array('shop'));
    if ($auth_user) {
        $shop_id = get_shop_id_by_user_id($user_id);
        $table = $wpdb->prefix . 'shops';
        $params = array('shop_email','shop_mobile', 'shop_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','gst_no');
    
    if($_FILES['file'] && $_FILES['name'] != "undefined")
    {       
      
        
        array_push($params,"profile_pic");
        $attachment_id = image_handle("create");
        $get_data['profile_pic'] = $attachment_id;
    }
       
       // print_r($get_data);
    
        $where = array('shop_id'=>$shop_id);
        $update_data = update_to_customtable($get_data,$table,$params,$where);
        $log['update_log'] = get_print_log();
        if ($update_data) {
            $sucesss = true;
        } else {
            $sucesss = false;
        }
        if ($multiple_tables_affected == true) {
            commit_transaction($sucesss);
            roll_back_transaction(!$sucesss);
        }
        if ($sucesss == true) {
            $response = array('id' => $update_data, 'status' => 1, 'title' => 'success', 'subtitle' => 'Updated');
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error','log'=>$log);
        }
        echo build_response_json($response);
        die();
    }

}


add_action('wp_ajax_get_shop_edit_data', 'get_shop_edit_data');
add_action('wp_ajax_nopriv_get_shop_edit_data', 'get_shop_edit_data');
function get_shop_edit_data()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $auth_user = authorize_app_user($user_id, array('upadmin'));
    if ($auth_user) {
        $id = $get_data['id'];
        $data = get_custom_single_row($wpdb->prefix.'shops',"shop_id = $id ");
        $data->title = get_the_title($data->shop_id);
        $user_data = get_userdata($data->owner_id);
        $data->user_login = $user_data->user_login;
        $data->country_id = get_country_id($data->district_id);
        $data->state_id = state_by_district($data->district_id);
    
     
        $data->image_url = wp_get_attachment_image_src($data->profile_pic)[0];
        $log['data'] = get_print_log();
      
    } else {
        $data = $auth_user;
    }
    $response = return_response_data($data,$log);
    echo json_encode($response);
    die();

}


add_action('wp_ajax_update_shop_profile_for_admin', 'update_shop_profile_for_admin');
add_action('wp_ajax_nopriv_update_shop_profile_for_admin', 'update_shop_profile_for_admin');
function update_shop_profile_for_admin(){
    global $wpdb;
    $sucesss = true;
    $multiple_tables_affected = false;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $user_id = $get_data['user_key'];
    $owner_id = $get_data['owner_id'];
   // $params = array('user_email','user_pas');
   $prefix="";
   $user_params = array();
   $user_data = get_userdata($owner_id);
   $build_shop_price_percent =  build_shop_price_percentage($get_data);
   $get_data['shop_offer'] = $build_shop_price_percent;



   //print_r($get_data);


   if($user_data->user_login != $get_data['user_login'])
    {
      array_push($user_params,'user_login');
    }
   if($get_data['user_pass'])
   {
      array_push($user_params,'user_pass');
   
   
   }

   $build_user_update_data = build_form_data($get_data,$user_params,$prefix);
   
   
   $build_user_update_data['ID'] = $owner_id;
   $user_id = wp_update_user($build_user_update_data);

 
        $shop_id = get_shop_id_by_user_id($user_id);
        $get_data['ID'] = $shop_id;

        $post_update_array = array(
            'ID'=> $shop_id,
            'post_title' => $get_data['title']
        );
        $get_data['shop_name'] = $get_data['title'];
        $post_id = wp_update_post($post_update_array);
        $table = $wpdb->prefix . 'shops';
        $params = array('shop_email','shop_mobile', 'shop_alt_mobile', 'address', 'town_name', 'pincode', 'district_id', 'street_name', 'landmark','gst_no','rating','video_url','map_url','shop_offer','shop_name');
        if($_FILES['file'] && $_FILES['name'] != "undefined")
        {       
      
        
        array_push($params,"profile_pic");
        $attachment_id = image_handle("create");
        $get_data['profile_pic'] = $attachment_id;
        }
       
        $where = array('shop_id'=>$shop_id);
        $where_2 = array('type_id'=>$shop_id);
        $build_shop_price_percent =  build_shop_price_percentage($get_data);
        $custom_data = array(
            'shop_offer' => json_encode($build_shop_price_percent, JSON_FORCE_OBJECT),
        );
        $update_data = update_to_customtable($get_data,$table,$params,$where,$custom_data);
    

        $log['custom-data-insert'] = get_print_log();

        $delete_id = delete_custom_table($wpdb->prefix . 'category_master', $where_2 );
        $log['delete-data'] = get_print_log();
        if($delete_id)
        {
            $categories_id = $get_data['category_percentage']['category'];
            $categories_percentage = $get_data['category_percentage']['percentage'];
            foreach ($categories_id as $key => $value) {
                $table_data = array(
                    'type_id' => $shop_id,
                    'category_id' => $value,
                    'category_percent' => $categories_percentage[$key]
                );
                $category_master = insert_custom_table($wpdb->prefix . 'category_master', $table_data);
                $log['log-insert_custom_table-categorymaster'] = get_print_log();
            }

        }
        
      
        $log['update_log'] = get_print_log();
        if ($update_data) {
            $sucesss = true;
        } else {
            $sucesss = false;
        }
        if ($multiple_tables_affected == true) {
            commit_transaction($sucesss);
            roll_back_transaction(!$sucesss);
        }
        if ($sucesss == true) {
            $response = array('id' => $update_data, 'status' => 1, 'title' => 'success', 'subtitle' => 'Updated','log'=>$log);
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => 'some error','log'=>$log);
        }
        echo build_response_json($response);
        die();
   

}

/* function update_category_master($get_data,$shop_id)
{
    global $wpdb;
    $delete_where = array(
        'type_id' => $shop_id
    );
    $delete_data = delete_custom_table($wpdb->prefix . 'category_master',$delete_where);
    if($delete_data)
    {
        $categories_id = $get_data['category_percentage']['category'];
        $categories_percentage = $get_data['category_percentage']['percentage'];
        foreach ($categories_id as $key => $value) {
            $table_data = array(
                'type_id' => $shop_id,
                'category_id' => $value,
                'category_percent' => $categories_percentage[$key]
            );
            $category_master = insert_custom_table($wpdb->prefix . 'category_master', $table_data);
        }

    }
    return $category_master;
  
} */
function get_the_shop_summary($user_id,$type,$from,$to)
{
    global $wpdb;
    $detailed_array=array();
    $detailed_array['Name']="";
    $detailed_array['Type']="";
    $detailed_array['Wallet Balance']="";
    $detailed_array['Discount Provided']="";

    $shop_id=get_shop_id_by_user_id($user_id);
    $extraWhere='';
    
    $table=$wpdb->prefix.'shops';
    $where='shop_id='.$shop_id;
    $fields='shop_name,type';
    $shop_det=get_custom_single_row($table,$where,$fields);
    if(isset($from) && isset($to))
    {
        $extraWhere=" and created_on BETWEEN '$from 00:00:00' and '$to 23:59:59'";
    }
    $table=$wpdb->prefix.'shop_wallet';
    $where='shop_id='.$shop_id.$extraWhere;
    $fields='balance';
    $wallet_bal=get_custom_single_row($table,$where,$fields);
    $table=$wpdb->prefix.'topup_transaction';
    $columns='sum(amount) as amount,custom_status';
    $groupby='custom_status';
    $topup_cumil=get_group_by($table,$where,$columns,$groupby);
   
    $table=$wpdb->prefix.'purchase';
    $columns='sum(discount_amount) as discount_amount';
    $groupby='shop_id';
    $purchase_cumil=get_group_by($table,$where,$columns,$groupby);

    $detailed_array['Name']=$shop_det->shop_name;
    $detailed_array['Type']=$shop_det->type;
    $detailed_array['Wallet Balance']=$wallet_bal->balance;
    foreach($topup_cumil as $topup)
    {
        $name=get_taxonomy_name($topup->custom_status,'topup_status'); 
        $detailed_array['Top Up '.$name]=$topup->amount;
    }
    if($purchase_cumil)
    {
    $detailed_array['Discount Provided']=$purchase_cumil[0]->discount_amount; 
    }
    
    return $detailed_array;
}


function get_shop_wallet_amount($shop_id)
{
    global $wpdb;
    $single_data = get_custom_single_row($wpdb->prefix.'shop_wallet',"shop_id = $shop_id");
    return $single_data->balance;
}


