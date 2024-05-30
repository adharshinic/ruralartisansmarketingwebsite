<?php
$smsstatus = "Disabled"; //Enabled
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';
function send_sms($smsto,$smsmsg)
{
	$countrycode = "+263";
	$smsto = $countrycode . $smsto;
	// Your Account SID and Auth Token from console.twilio.com
	$sid = "AC59c608f861dd791c1aa4604c0c362899";
	$token = "6ef52aa78e7a5c18b4a38d13b4284476";
	$client = new Twilio\Rest\Client($sid, $token);
	$client->setLogLevel('debug');

	// Use the Client to make requests to the Twilio REST API
	$client->messages->create(
	    // The number you'd like to send the message to
	    $smsto,
	    [
	        // A Twilio phone number you purchased at https://console.twilio.com
	        'from' => '+16074007821',
	        // The body of the text message you'd like to send
	        'body' => $smsmsg
	    ]
	);
}
//send_sms("776792078",'Hello I am Aravind sending message from my php code..');
?>