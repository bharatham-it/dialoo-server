<?php

function start_transaction($start)
{   
    global $wpdb;
    if ($start == true) {
        $wpdb->query('START TRANSACTION');
    }
}
function commit_transaction($commit)
{
    global $wpdb;
    if ($commit == true) {
        $wpdb->query('COMMIT');
    }
}
function roll_back_transaction($rollback)
{
    global $wpdb;
    if ($rollback == true) {
        $wpdb->query('ROLLBACK');
    }
}
function insert_custom_table($table, $data)
{
    global $wpdb;
    $res = $wpdb->insert($table, $data);
    return $res;
}
function get_custom_table($table,$where, $fields = "*")
{
    global $wpdb;
    
    $result = $wpdb->get_results("select ".$fields." from $table where $where");
    return $result;
}
function get_custom_single_row($table,$where, $fields = "*")
{
    global $wpdb;
    $result = $wpdb->get_row("select ".$fields." from $table where $where");
    return $result;
}
function get_all_custom_table($table,$fields = "*")
{
    global $wpdb;
    $result = $wpdb->get_results("select ".$fields." from $table");
    return $result;
}

function  update_custom_table($table, $data, $where)
{
    global $wpdb;
    $result =  $wpdb->update($table, $data, $where);
    ($result === false) ? $result=0 : $result = 1;
    return $result;
}

function update_custom_query($table,$values,$where)
{
    global $wpdb;
    $result = $wpdb->query("update $table set ".$values." where $where");
    return $result;
}

function delete_custom_table($table, $where)
{
    global $wpdb;
    $result = $wpdb->delete($table,$where);
    return $result;
}
function get_custom_col($table,$where,$fields)
{
     global $wpdb;
    $result = $wpdb->get_col("select ".$fields." from $table where $where");
    return $result;
}


function get_custom_col_distinct_where($table,$fields,$where)
{
    global $wpdb;
    $result = $wpdb->get_col("select DISTINCT ".$fields." from ".$table." where ".$where);
    return $result;
}
function call_stored_procedure($procedure_name,$values){
    global $wpdb;
    $result = $wpdb->query("CALL $procedure_name($values)");
    return $result;
}
function get_group_by($table,$where,$fields,$values){
    global $wpdb;
    $result = $wpdb->get_results("select ".$fields." from $table where $where GROUP BY $values");
    return $result;
}

function get_count_custom_table($table,$where,$field = "id")
{
    global $wpdb;
    $result = $wpdb->get_results("select count(".$field.") as count from $table where $where");
    return $result[0]->count;
}

function print_log(){
    global $wpdb;
    // // Print last SQL query string
    echo $wpdb->last_query;

    // // Print last SQL query result
    echo $wpdb->last_result;

    // // Print last SQL query Error
    echo $wpdb->last_error;
    
}
function get_print_log(){
    global $wpdb;
    $print_array = array();
    // // Print last SQL query string
    $print_array['last_query'] = $wpdb->last_query;

    // // Print last SQL query result
    $print_array['last_result']  = $wpdb->last_result;

    // Print last SQL query Error
    $print_array['last_error']  =  $wpdb->last_error;

    return $print_array;
    
}


?>
