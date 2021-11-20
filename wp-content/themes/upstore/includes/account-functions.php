<?php
function add_ledger($top_up_array)
{
    global $wpdb;
    return insert_custom_table($wpdb->prefix . 'ledger', $top_up_array);
}


function walletUpdate($amount, $shop_id, $operator)
{
    global $wpdb;
    
    $query = 'update us_shop_wallet set balance = balance ' . $operator . ' ' . $amount . ' where shop_id=' . $shop_id;

    $wallet_id = $wpdb->query($query);
    return $wallet_id;
}

