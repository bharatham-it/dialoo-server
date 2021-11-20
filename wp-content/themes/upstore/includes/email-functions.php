<?php


add_filter('wp_mail_content_type', 'set_content_type');
function set_content_type($content_type)
{
	return 'text/html';
}
add_filter('wp_mail_from', 'custom_wp_mail_from');
function custom_wp_mail_from($original_email_address)
{
	return 'upstore@bharathamitsolutions.com';
}

add_filter('wp_mail_from_name', 'custom_wp_mail_from_name');
function custom_wp_mail_from_name($original_email_from)
{
	return 'Upstore ';
}

add_filter('wp_mail_charset', 'change_mail_charset');
function change_mail_charset($charset)
{
	return 'UTF-32';
}

function mail_headers($add_header = array())
{
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'CC: Admin1 <manishpisharody@mailinator.com;',
		'CC: Admin2 <manishpisharody@mailinator.com>;',
		'CC: ' . $add_header['cc'] . ' ;'
	);
	return $headers;
}

function send_upstore_emails($data, $tokens = null)
{
	global $wpdb;
	$content = $data->post_content;
	foreach ($tokens as $key => $value) {
		$content = str_replace($key, $value, $content);
	}
	return $content;
}
/* function profile_email_update($email,$name){
	$headers=mail_headers();
	$email_subject="Email has been updated";
	$tokens=array("%name%"=>$name,"%email%"=>$email);
	$content = send_upstore_emails('registration-email',$tokens);
	ob_start();
	include(get_template_directory_uri()."/page-templates/email-header.php");
	echo $content;
	include(get_template_directory_uri()."/page-templates/email-footer.php");
	$message = ob_get_contents();
    ob_end_clean();
	wp_mail($email, $email_subject,$message,$headers);
 }  */

function registration_email($name, $email)
{
	$headers = mail_headers();
	$email_subject = "Sucessfully Registerd";
	$tokens = array("%name%" => $name, "%email%" => $email,);
	$content = send_upstore_emails('registration-template', $tokens);
	ob_start();
	include(get_template_directory() . "/page-templates/email-header.php");
	echo $content;
	include(get_template_directory() . "/page-templates/email-footer.php");
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);
}

function email_forgot_otp($name, $email, $otp)
{
	$data = get_page_by_title('forgot-otp', 'OBJECT', 'email_template');
	$add_header = get_fields($data->ID);
	$headers = mail_headers($add_header);
	$email_subject = "OTP Verification";
	$tokens = array("%name%" => $name, "%email%" => $email, "%otp%" => $otp);
	$content = send_upstore_emails($data, $tokens);
	ob_start();
	include(get_template_directory() . "/page-templates/email-header.php");
	echo $content;
	include(get_template_directory() . "/page-templates/email-footer.php");
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);
}

function email_password_rest($email, $name)
{
	$headers = mail_headers();
	$email_subject = "Sucessfully Registerd";
	$tokens = array("%name%" => $name, "%email%" => $email);
	$content = send_upstore_emails('password-reset', $tokens);
	ob_start();
	/* include(get_template_directory()."/page-templates/email-header.php");  */
	echo $content;
	/* 	include(get_template_directory()."/page-templates/email-footer.php");  */
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);
}


function welcome_email($email, $name)
{
	$data = get_page_by_title('welcome-mail', 'OBJECT', 'email_template');
	$add_header = get_fields($data->ID);

	$headers = mail_headers($add_header);
	$email_subject = "Sucessfully Registerd";
	$tokens = array("%name%" => $name, "%email%" => $email);

	$content = send_upstore_emails($data, $tokens);
	ob_start();
	include(get_template_directory() . "/page-templates/email-header.php");
	echo $content;
	include(get_template_directory() . "/page-templates/email-footer.php");
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);
}


function welcome_email_shop($email, $name)
{
	$data = get_page_by_title('welcome-mail-shop', 'OBJECT', 'email_template');
	$add_header = get_fields($data->ID);

	$headers = mail_headers($add_header);
	$email_subject = "Sucessfully Registerd";
	$tokens = array("%name%" => $name, "%email%" => $email);

	$content = send_upstore_emails($data, $tokens);
	ob_start();
	include(get_template_directory() . "/page-templates/email-header.php");
	echo $content;
	include(get_template_directory() . "/page-templates/email-footer.php");
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);
}


function requirment_mail($name,$mobile,$content)
{
	$email = "upstoresofficial@gmail.com";
	$data = get_page_by_title('enquiry', 'OBJECT', 'email_template');
	$add_header = get_fields($data->ID);

	$headers = mail_headers($add_header);
	$email_subject = "Message from".$name;
	$tokens = array("%name%" => $name,"%mobile%" => $mobile, "%content%" =>$content );
	$content = send_upstore_emails($data, $tokens);
	ob_start();
	include(get_template_directory() . "/page-templates/email-header.php");
	echo $content;
	include(get_template_directory() . "/page-templates/email-footer.php");
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($email, $email_subject, $message, $headers);

}