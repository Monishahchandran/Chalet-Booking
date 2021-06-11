<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class pushController extends Controller
{
  public function pushNotify()
  {

 if(defined('CURL_HTTP_VERSION_2_0')){
	
$device_token   = 'd4f076ccee8ca3f9ccd49bfcca27b4e81a836495b35bd9d4c7cf25c0081d9d33';
$pem_file       = 'PushChalet.pem';
$pem_secret     = 'sics';
$apns_topic     = 'sics.Aby Chalet';
$message= array(
		'alert' => array(
			'title' => "Test Push from backend",
			// 'body' => "Body of Test Push",
		),
		'badge' => 1,
		'sound' => 'default',
		); // Create the payload body

	$body['aps'] = $message;
	
	$payload = json_encode($body);
	
$url = "https://api.development.push.apple.com/3/device/$device_token";
echo $payload;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("apns-topic: $apns_topic"));
curl_setopt($ch, CURLOPT_SSLCERT, $pem_file);
curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pem_secret);
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//echo $response;
if($response){

	echo "Push Success";
}else{
	echo "Push Failed";
}


}else{

echo "CURL_HTTP_VERSION_2_0 Not Supported";
}



  }}
  ?>