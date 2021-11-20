<?php
add_action('wp_ajax_nopriv_generate_sponser_tree', 'generate_sponser_tree');
add_action('wp_ajax_generate_sponser_tree', 'generate_sponser_tree');

function generate_sponser_tree()
{
    global $wpdb;
    $log = array();
    $get_data = get_form_request('formdata');
    $user_key = $get_data['user_key'];
    $id = $get_data['parent_id'];
    $table_user_relation = $wpdb->prefix . 'user_relation_child';

    $sponser_datas = get_custom_table($table_user_relation, "parent_id=$id  and Level_id = 1 and child_id in (select child_id from $table_user_relation where Level_id < 11 and parent_id = $user_key)");
    $log['sponsor_data_log'] = get_print_log();
    $parent_sponsor = get_custom_table($table_user_relation, "child_id=$id ORDER BY Level_id DESC LIMIT 12 OFFSET 2", 'Level_id,parent_id,(SELECT display_name from us_user_data where id = parent_id) as name ');
    $log['parent_log'] = get_print_log();
    if ($sponser_datas) {
        foreach ($sponser_datas as $sponser_data) {
            $get_user_custom_data = get_custom_table($wpdb->prefix . 'user_data', 'id=' . $sponser_data->child_id);
            $get_user_return_data = get_custom_table($wpdb->prefix . 'user_returns', 'user_id=' . $sponser_data->child_id);
            $child_count = get_custom_table($wpdb->prefix . 'user_relation_child', "parent_id=$sponser_data->child_id",'count(child_id) as count');
            $level_data = get_custom_single_row($wpdb->prefix . 'user_relation_child',"parent_id = $user_key and child_id = $sponser_data->child_id ","level_id");
            $get_user_add_data['ID'] = $get_user_custom_data[0]->ID;
            $get_user_add_data['display_name'] = $get_user_custom_data[0]->display_name;
            $get_user_add_data['sponser_code'] = $get_user_custom_data[0]->sponser_code;
            $get_user_add_data['pv'] = get_pv( $get_user_custom_data[0]->ID);
            $get_user_add_data['tpv'] = get_tpv($get_user_custom_data[0]->ID);
            $get_user_add_data['child_count'] = $child_count[0]->count;
            $child_sponsor[] = $get_user_add_data;
        }
        $get_user_add_data1['parent_sponsor'] =  $parent_sponsor;
        $get_user_add_data1['child_sponsor'] =  $child_sponsor;
        $get_user_add_data1['parent_name'] = get_display_name($id);
        $get_user_add_data1['level_id'] = $level_data->level_id;
    } else {
        $get_user_add_data1['parent_sponsor'] = "";
        $get_user_add_data1['child_sponsor'] = "";
        $get_user_add_data1['parent_name'] = "";
    }
    $response =  return_response_data($get_user_add_data1,$log);

    echo json_encode($response);
    die();
}
