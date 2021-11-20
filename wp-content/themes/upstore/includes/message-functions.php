<?php
add_action('wp_ajax_submit_function_add_grievance', 'submit_function_add_grievance');

function submit_function_add_grievance()
{
    global $wpdb;
    $sucesss = true;
    $get_data = get_form_request('formdata');
    $grievance_id = manage_post($get_data, 'create','content');
    if($grievance_id)
    {
        $sucesss=true;
    }
    else{
        $sucesss=false;
    }
    if ($sucesss == true) {
        $response = array('id' => $grievance_id, 'status' => 1, 'title' => 'success', 'subtitle' => 'New Grievance Added');
    } elseif ($sucesss == false) {
        $response = array('id' => 0, 'status' => 2, 'title' => 'failed', 'subtitle' => $grievance_id->get_error_message());
    }
    $addl_response = array('redirecturl' => home_url() . '/grievences');
    echo build_response_json($response, $addl_response);
    die();
}

?>