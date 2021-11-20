<?php
function create_razor_pay_contact($get_data,$action ="create")
{
  $curl_array = array(
    'name' => $get_data['account_holder_name'],
    'email'=> "test@gmail.com",
  );
  if($action == "update")
  {

      $add_url_string = '/'.$get_data['contact_id'];
  }
  
  $url = "https://api.razorpay.com/v1/contacts$add_url_string";

  $create_contact = razor_curl_request($curl_array,$url);



  return $create_contact['response']['id'];
}

function create_razor_pay_fund_account($get_data)
{

  $curl_array = array(
    'contact_id' => $get_data['contact_id'],
    'account_type'=> "bank_account",
    'bank_account' => array(
        'name' => $get_data['account_holder_name'],
        'ifsc' => $get_data['ifsc_code'],
        'account_number' => $get_data['account_no']
    ),
  );
  $url = "https://api.razorpay.com/v1/fund_accounts";
  $create_fund_accounts = razor_curl_request($curl_array,$url);

 
  
  return $create_fund_accounts['response']['id'];
}
function create_razor_pay_payouts($get_data)
{
    $curl_array = array(
        'account_number' => "4564564147379011",
        'fund_account_id'=> $get_data['fund_account_id'],
        'amount' => $get_data['amount'] * 100,
        'currency' => 'INR',
        'mode' => 'IMPS',
        'purpose' => 'payout',
        'reference_id' => 'Upstore 12345',
        'narration' => 'Upstore Payout Withdrwal',
      );
      $url = "https://api.razorpay.com/v1/payouts";
      $create_payouts = razor_curl_request($curl_array,$url);
      return $create_payouts;

}


function create_razor_pay_fund_account_creation($get_data,$action="create")
{
   $response = array();

   $contact_data = create_razor_pay_contact($get_data);
   $response['contact_id'] = $contact_data['response']['id']; 
   $get_data['contact_id'] = $contact_data['response']['id']; 
   $fund_account_data = create_razor_pay_fund_account($get_data);
   $response['fund_account_id'] = $fund_account_data['response']['id'];

  
    
   return $response;

}



function razor_curl_request($curl_object=array(),$url)
{
    $data =http_build_query($curl_object);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD,"rzp_live_A6jOLPsg25coiL:XOffo2Y4LgXXvVXNZ4KyGkft");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
  
    $result = curl_exec($ch);
    $flag = 1;
 
    if (curl_errno($ch)) {
    $error = curl_error($ch);
    $flag = 0;
  
    }
    $response = json_decode($result,true);
    curl_close ($ch);
    $response =  array(
      'flag' =>$flag,
      'response' => $response,
      'error' =>$error,
    );
    
    return $response;

}


