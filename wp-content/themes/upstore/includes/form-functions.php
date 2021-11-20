<?php
function get_form_request($data)
{
   $formdata = array();
   parse_str($_REQUEST[$data], $formdata);
   if(isset($formdata['user_key']))
   {
      $formdata['device'] = 'app';
      $formdata['current_user_id'] = $formdata['user_key'];
   }
   else
   {
      $formdata['device'] ='web';
      $formdata['current_user_id'] = get_current_user_id();
   }
   return $formdata;
}

function build_form_data($formdata,$params, $prefix = '')
{
/*    $formparams = array('ID'=>$formdata['id']); */
 $formparams = array();
   foreach ($params as $param) {
      $formparams[$prefix . $param] = $formdata[$param];
   }
   return $formparams;
}



function build_response( $response_data, $addl_response = array() )
 {
    $params = array( 'id', 'status', 'title', 'subtitle', 'url' );
    $statuses = array( 1 => 'success', 2 => 'warning', 3 => 'danger', 4 => 'info' );
    $responseparams = array();
    $response_data['class'] = $statuses[$response_data['status']];
    // foreach ( $params as $param ) {
    //     $responseparams[$param] = $response_data[$param];
    // }
    return array_merge( $response_data, $addl_response );
}

function build_response_json( $response_data, $addl_response = array() ) {
    return response_json( build_response( $response_data, $addl_response ) );
}

function response_json( $response )
{
    return json_encode( $response );
}

?>