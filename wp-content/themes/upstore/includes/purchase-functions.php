<?php
function get_shops_for_select($args)
{
    $shops = get_posts($args);
    $shop_list = array();
    foreach ($shops as $shop) :
        $shop_list[$shop->ID] = $shop->post_title;
    endforeach;
    return $shop_list;
}
add_action('wp_ajax_submit_function_add_purchases', 'submit_function_add_purchases');
add_action('wp_ajax_nopriv_submit_function_add_purchases', 'submit_function_add_purchases');
function submit_function_add_purchases()
{
    global $wpdb;
    $log = array();
    $sucesss = true;
    $multiple_tables_affected = true;
    start_transaction($multiple_tables_affected);
    $get_data = get_form_request('formdata');
    $characters = '0123456789';
    $get_data['title'] = 'ORDR' . strtotime('now') . generateRandomString($characters);
    $params = array('title', 'type', 'status');
    $prefix = 'post_';
    $build_purchasedata = build_form_data($get_data, $params, $prefix);
    $user_id =  $get_data['user_key'];
    $role = get_current_user_role($user_id);
    $get_data['created_on'] = $user_id;
    if ($role == "customer") {
        $shop_code = $get_data['code'];
        $shop_id = get_shop_id_by_shope_code($shop_code);
        //print_r($shop_id);
        $purchase_user_id = $user_id;
        $get_data['shop_id'] = $shop_id;
        $shop_price = build_shop_price($get_data);
    } else if ($role == "shop") {
        $sponser_code = $get_data['code'];
        $shop_code = $get_data['shop_code'];
        $purchase_user_id = get_user_id_by_sponser_code($sponser_code);
        $shop_id = get_shop_id_by_shope_code($shop_code);
        $get_data['shop_id'] = $shop_id;
        $shop_price = build_shop_price($get_data);
       // print_r($shop_price);
    }
    $shop_price_pay_amount = $shop_price['pay_amount'];
    $balance = get_shop_wallet_amount($shop_id);
    $log['shop_balance_chek'] = get_print_log();
    $log['print_datas'] = "balance = $balance,shop_price=$shop_price_pay_amount";
  
    if ($balance <= 0 || $balance <= $shop_price['pay_amount']) {

        $response = array('id' => 0, 'status' => 0, 'title' => 'failed', 'subtitle' => "No balance");
    } else {

        $role = get_current_user_role($user_id);
        $purchase_id = wp_insert_post($build_purchasedata);
        if (is_numeric($purchase_id) &&  $purchase_id > 0) {
            $offer_percentage =  generate_offer_price_by_shop_id($shop_id);
            $log['offer-percentage-generation'] = get_print_log();
            $shop_price = build_shop_price($get_data);
            $log['shop_price'] = get_print_log();
            $final_amount = build_final_amount($shop_price, $offer_percentage);
            $log['final_amount'] = get_print_log();
            $final_discount_price = $final_amount['final_discount_price'];
            $distribution_data = get_profit_distribution_details($final_discount_price);
            $log['distribution_data'] = get_print_log();
            //custom table
            $query_text = 'UPDATE us_user_returns SET ppv=ppv+' . $distribution_data['ppv'] . ',pv=pv+' . $distribution_data['pv'] . ' WHERE user_id= ' . $purchase_user_id . '';

            $user_return_result = $wpdb->query($query_text);
            $log['update_user_data'] = get_print_log();
            $top_level = update_distribution_amount($purchase_user_id, $distribution_data['distribution_amount_for_person']);
            $log['dpv_update'] = get_print_log();
            $update_company_return = get_company_additional_share($distribution_data['share_level'], $distribution_data['company_level'], $top_level, $distribution_data['distribution_amount_for_person']);
            $log['update_company_return'] = get_print_log();
            $company_share  = get_company_share($distribution_data['share_level'], $distribution_data['company_level'], $top_level, $distribution_data['distribution_amount_for_person']);;
            $log['company-share-retrival'] = $company_share;

            $build_custom_table_data = array(
                'id' => $purchase_id,
                'order_no' => $get_data['title'],
                'created_by' => get_current_user_id(),
                'category_percent' =>  json_encode($offer_percentage),
                'category_amount' => json_encode($shop_price),
                'discount_amount' =>   $final_discount_price,
                'pay_amount' => $shop_price['pay_amount'],
                'cash_back' => $distribution_data['user_cash_back'],
                'distribution_amount' =>  $distribution_data['total_distribution_amount'],
                'ppv' => $distribution_data['ppv'],
                'pv' => $distribution_data['pv'],
                'company_share' => $distribution_data['company_amount'],
                'company_dpv' => $company_share,
                'shop_id' => $shop_id,
                'user_id' => $purchase_user_id,
                'created_by' => $user_id,
                'dpv' => $distribution_data['distribution_amount_for_person']

            );


            walletUpdate($final_discount_price, $shop_id, '-');

          

            $top_up_array['debit'] = -1;
            $top_up_array['credit'] = $shop_id;
            $top_up_array['type'] = "wallet_reduce";
            $top_up_array['action'] = "-";
            $top_up_array['amount'] = $final_discount_price;
            $ledger_entry = add_ledger($top_up_array);
            $custom_id = insert_custom_table($wpdb->prefix . 'purchase', $build_custom_table_data);

            if ($purchase_id && $custom_id && $ledger_entry) {
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
            $response = array('id' => $purchase_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Purchase Added', 'log' => $log);
        } elseif ($sucesss == false) {
            $response = array('id' => 0, 'status' => 0, 'title' => 'failed', 'subtitle' => $purchase_id->get_error_message());
        }
    }


    $addl_response = array('redirecturl' => home_url() . '/login/');
    echo build_response_json($response, $addl_response);
    die();
}
