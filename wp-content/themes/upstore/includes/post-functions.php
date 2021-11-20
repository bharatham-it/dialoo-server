<?php
function build_posts_args($type, $num, $status)
{
    if($num = "all"){
        $num = -1;
    }
    $get_args = array(
        'post_type' => $type,
        'posts_per_page' => $num,
        'post_status' => $status,

    );
    return $get_args;
}

function build_post_data_array_build($get_data, $addl = array()) {
    $params = array('status', 'type', 'title');
    $data_array = build_form_data($get_data, $params, 'post_');
    $data_array = array_merge($data_array, $addl);
    return $data_array;
}

function build_data_array_build($get_data, $params, $prefix = '', $addl = array()) {
    $data_array = build_form_data($get_data, $params, $prefix);
    $data_array = array_merge($data_array, $addl);
    return $data_array;
}

function manage_post($get_data, $type){
    $params = array('status', 'type', 'title','content');
    $build_data = build_data_array_build($get_data,$params, 'post_');
    if($type == "create"){
        return  wp_insert_post($build_data);
    }else if($type == "update"){
        wp_update_post($build_data);
    }
}

function set_post_categories($id, $get_data, $categories){
    foreach($categories as $key => $value):
        wp_set_post_terms($id, array( $get_data[$key] ),  $value );
    endforeach;     
}

function add_to_customtable($get_data,$table,$params,$custom_data = array()){
    global $wpdb;
    $build_data = build_data_array_build($get_data,$params, '',$custom_data);
    return insert_custom_table($table, $build_data);
}

function update_to_customtable($get_data,$table,$params,$where,$custom_data = array()){
    global $wpdb;
    if(empty($where)) return 0;
    $build_data = build_data_array_build($get_data,$params, '',$custom_data);
    return update_custom_table($table, $build_data, $where);
}

function formatDate($date, $format="d-M-Y"){
    return (date_format(date_create($date),$format));
}

function create_dailyreport_post($get_data){
    $build_data['post_status'] = 'publish';
    $build_data['post_type'] = 'dailyreport';
    $build_data['post_title'] = $get_data['batch_id'] .'-'.formatDate($get_data['start_date']);
    return  wp_insert_post($build_data);
}
function return_response_data($data, $log = array()){
    if($data === false){
        $response = array('status' => 3, 'title' => 'Failed', 'subtitle' => 'Authroization Error', 'result' => $data, 'log' => $log);
    }
    else{
        if (isset($data)&& !isset($data->errors)) {
            $response = array('status' => 1, 'title' => 'success', 'subtitle' => 'Retrieve success', 'result' => $data, 'log' => $log);
         } else {
             $response = array('status' => 2, 'title' => 'Failed', 'subtitle' => 'Retrieve Failed', 'result' => '', 'log' => $log);
         } 
    }
   
    return build_response($response);
}


