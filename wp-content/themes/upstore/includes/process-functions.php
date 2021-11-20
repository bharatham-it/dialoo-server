<?php
function build_shop_price_percentage($get_data){
    $build_shop_price_percent = [];
    $shop_category = $get_data['category_percentage']['category'];
    $shop_percentage = $get_data['category_percentage']['percentage'];
    foreach ($shop_category  as $key => $value) {
        $build_shop_price_percent[$value] = $shop_percentage[$key];
    }
    return $build_shop_price_percent;
}
function generate_offer_price_by_shop_id($shop_id)
{
    global $wbdb;
    $get_category_percentage = get_custom_single_row('us_shops', 'shop_id=' . $shop_id,'shop_offer');
    $shop_offer = $get_category_percentage->shop_offer;
    return json_decode(json_decode(json_encode($shop_offer), true), true);;
}
function build_shop_price($data)
{
    $shop_category = $data['category_price']['category'];
    $shop_price = $data['category_price']['price'];
    $build_shop_price = array();
    $pay_amount = 0;
    foreach ($shop_category  as $key => $value) {
        $build_shop_price[$value] = $shop_price[$key];
        $pay_amount += $build_shop_price[$value];
    }
    $build_shop_price['pay_amount'] =   $pay_amount;

    return $build_shop_price;
}
function build_final_amount($shop_price, $offer_percentage)
{
    $total_discount_price = 0;
    $build_final_amount = array();
    foreach ($shop_price  as $key => $value) {
        $build_final_amount[$key] = $shop_price[$key] * ($offer_percentage[$key] / 100);

        $total_discount_price += $build_final_amount[$key];
    }
    $build_final_amount['final_discount_price'] = $total_discount_price;
    return  $build_final_amount;
}
function get_profit_distribution_details($final_discount_price)
{
    $cash_back_percentage = 40;
    $share_level = 15;
    $company_owned_share = 5;
    $user_cash_back =  $final_discount_price * $cash_back_percentage / 100;
    $total_distribution_amount = $final_discount_price * (100 - $cash_back_percentage) / 100;
    $distribution_amount_for_person =  $total_distribution_amount / $share_level;
    $company_amount =  $distribution_amount_for_person * $company_owned_share;
    $user_distribution_amount = $total_distribution_amount - $company_amount;
    $ppv=  $user_cash_back;
    $pv = $user_cash_back/10;
  $profit_details =
        array(
            'user_cash_back' => $user_cash_back,
            'total_distribution_amount' => $total_distribution_amount,
            'distribution_amount_for_person' => $distribution_amount_for_person,
            'company_amount' => $company_amount,
            'user_distribution_amount' => $user_distribution_amount,
            'share_level'=>$share_level,
            'company_owned_share' => $company_owned_share,
            'ppv'=>$ppv,
            'pv' => $pv
            
        );
    
        return $profit_details;
}

function get_ppv_of_user($id){
$user_data = get_custom_single_row('us_user_data','id='.$id);
return $user_data->ppv;

}

function get_single_level_tree($id){
    global $wpdb;
    $sponser_datas = get_custom_table($wpdb->prefix.'user_relation','parent_id='.$id);
     foreach($sponser_datas as $sponser_data)
    {
        $get_user_add_data[] = get_custom_table($wpdb->prefix.'user_data','id='.$sponser_data->user_id);
    } 
    return $get_user_add_data;
}
add_action('wp_ajax_nopriv_get_recursive_ppv', 'get_recursive_ppv');
function get_recursive_ppv(){

    $users = get_all_custom_table('us_user_data','id');
    
    foreach($users as $key => $value){
        $total_ppv = 0;
        $level = 0;
        $total_tpv = get_total_ppv($value->id,$total_ppv, $level );
        $tpv = array(
            'tpv'=> $total_tpv
        );
        $where = array(
            'id'=>$value->id
        );
         $update_ppv = update_custom_table('us_user_data',$tpv,$where);
      
        echo 'total = '.$total_tpv;
    }
    
    die();
    
}
function get_total_ppv($id,$total_ppv, $level ){
    $level++;
    if( $level > 10 ){
        return $total_ppv;
    }
    echo '<br> level '.$level;
    $single_level =  get_single_level_tree($id);
    echo '<br> new ppv = '.$total_ppv;
    if(empty($single_level)){
        return $total_ppv;
    }
    else{
        foreach($single_level as $key => $value){
            $value =  $value[0];
            if($value->ID)
            {
                $total_ppv = $total_ppv + $value->ppv;
                $total_ppv = get_total_ppv($value->ID,$total_ppv, $level );
            }
        
        }
        return $total_ppv;
    }
}
function get_remove_ids(){
     $remove_ids = array(1,78,676);
    return implode( "," , $remove_ids );
}


function update_distribution_amount($child_id,$dpv){

    global $wpdb;
    $query = "SELECT parent_id,level_id FROM us_user_relation_child where child_id = $child_id and level_id < 11 and parent_id NOT IN ( " .get_remove_ids(). " )";
    $parent_ids = $wpdb->get_results($query);
    $top_level = 0;
  foreach($parent_ids as $key => $value){
     /*    $query_text = 'UPDATE us_user_returns SET dpv=dpv+'.$dpv.' WHERE user_id= '.$value->parent_id.''; */
        $dpv_insert = update_custom_query($wpdb->prefix.'user_returns','dpv=dpv+'.$dpv.'','user_id= '.$value->parent_id.'');
     /*    $wpdb->query($query_text); */
        if($top_level < $value->level_id){
            $top_level = $value->level_id;
        }
    }

    return $top_level;
    
}

function get_company_additional_share($total_level,$company_level,$top_level,$distribution_amount_for_person){
$company_share = get_company_share($total_level,$company_level,$top_level,$distribution_amount_for_person);
$update_share = update_comapny_return($company_share);
return $update_share;

}
function get_company_share($total_level,$company_level,$top_level,$distribution_amount_for_person){
    $company_extra_level = $total_level - $company_level - $top_level;
    $company_share = $company_extra_level * $distribution_amount_for_person;
    return $company_share;
    }
function update_comapny_return($company_return){
    global $wpdb;
    $company_id = get_company_id();
    $query_text = 'UPDATE us_user_returns SET company_dpv=company_dpv+'.$company_return.' WHERE user_id= '.$company_id.'';
    $dpv_insert = $wpdb->query($query_text);
    return $dpv_insert;
 
}
function update_comapny_share($company_share){
    global $wpdb;
    $company_id = get_company_id();
    $query_text = 'UPDATE us_user_returns SET company_share=company_share+'.$company_share.' WHERE user_id= '.$company_id.'';
    $dpv_insert = $wpdb->query($query_text);
    return $dpv_insert;
 
}

function get_tpv($parent_id,$request_type="customer"){
    global $wpdb;
    $log = array();
    $role = get_current_user_role($parent_id);
    $field_string = "dpv";
    if($request_type == "upadmin")
    {
        $field_string = "company_dpv";
    }
    $tpv_data = get_custom_single_row($wpdb->prefix."user_returns","user_id = $parent_id","$field_string as dpv");
    $log['tpv-data'] = get_print_log();
   
    $tpv = $tpv_data->dpv;
 

    $new_tpv = get_custom_single_row($wpdb->prefix.'user_returns',"user_id=$parent_id","$tpv-used_tpv as tpv");
   
    $log['new-tpv'] = get_print_log();
  
    if($new_tpv->tpv < 0) 
    {
      return 0;
    }
 
    return $new_tpv->tpv;
    
}

function get_pv($user_id){
    global $wpdb;
    $tpv_setting = get_admin_settings('festive_pv');
    if($tpv_setting == 1)
    {
        $res = 100;
        return $res;
    }
    $data = get_custom_single_row($wpdb->prefix.'user_returns',"user_id=$user_id");
    $res = $data->pv;
    return $res;
}
function get_admin_settings($type)
{
    global $wpdb;
    $settings_data = get_custom_single_row($wpdb->prefix.'settings',"settings_type = '$type'",'value');
    return $settings_data->value;


}
function get_ppv($user_id){
    global $wpdb;
    $data = get_custom_single_row($wpdb->prefix.'user_returns',"user_id=$user_id",'ppv');
    $res = $data->ppv;
    return $res;
}
function get_wallet_amount($user_id){
    global $wpdb;
    $data = get_custom_single_row($wpdb->prefix.'user_returns',"user_id=$user_id");
    $res = $data->pv * 100;
    return $res;
}
function get_shop_wallet_balance($user_id){
        global $wpdb;
        $shop_id = get_shop_id_by_user_id($user_id);
        $table = $wpdb->prefix . 'shop_wallet';
        $wallet_balance  = get_custom_single_row($table, 'shop_id=' . $shop_id, 'balance', 'updated_on');
        return $wallet_balance->balance;
}

function get_this_month_earining($user_id){
    global $wpdb;
        $shop_id = get_shop_id_by_user_id($user_id);
        $table = $wpdb->prefix . 'shop_wallet';
        $dpv = get_custom_table($table," user_id in (SELECT child_id from us_user_relation_child WHERE parent_id = $user_id) and created_on BETWEEN '2021-05-25 00:00:00' and '2021-06-01 23:59:59'",' sum(dpv)as dpv and sum(ppv) as ppv');
        /* $ppv_this_month  =  */
      /*   return $wallet_balance->balance; */
}

function get_company_id(){
    return $company_id= 676;
 }


 ?>