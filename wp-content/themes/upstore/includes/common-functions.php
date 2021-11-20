<?php
function generateRandomString($characters,$length = 10) {
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[rand(0, $charactersLength - 1)];
   }
   return $randomString;
}

function authorize_app_user($user_id,$authroles){
    $user_data = get_userdata($user_id);
    $user_role = $user_data->roles;
    if (current_user_can('administrator') || array_intersect($user_role, $authroles) ) {
        return true;
    } 
    else
    {
        return false;
    }
 }
 function get_shop_id_by_user_id($user_id){
     global $wpdb;
     $shop = get_custom_single_row($wpdb->prefix.'shops','owner_id='.$user_id,'shop_id');
     return $shop->shop_id;
 }
 function change_date_format($date,$format)
{
    $date=date_create($date);
   return date_format($date,$format);
}

function build_date_query($get_data, $date_field = "created_on", $startdate = 'date_from', $enddate = 'date_to')
{
    $date_from = $get_data[$startdate];
    $date_to = $get_data[$enddate];
    $date_query = "";
    if (!empty($date_to) && !empty($date_from) && $date_to != 'undefined' && $date_from != 'undefined') {
        $date_query = " and $date_field BETWEEN '$date_from 00:00:00' and '$date_to 23:59:59'";
    }
   
    return $date_query;
}


function generate_csv($list, $filename)
{
    $fp = fopen($filename, 'w');
    //Write the header
    fputcsv($fp, array_keys($list[0]));
    //Write fields
    foreach ($list as $fields) {
        fputcsv($fp, $fields);
    }
    fclose($fp);
    $url_data['url'] = get_site_url() . '/' . $filename;
}



 

?>
