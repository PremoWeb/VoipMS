#!/usr/bin/php -q
<?php 

$SMSsender="";

// --- leave stuff below here alone

require_once("class.voipms.php");

 ob_implicit_flush(false); 
 error_reporting(0); 
 set_time_limit(300);    

$errorflag = false;
$smsnumber = $argv[1];
$smsmessage = $argv[2];
$otherstuff = $argv[3];

if (strlen($SMSsender)<1) :
 echo "ERROR: SMSsender must be inserted into voipms-sms.php.\n";
 echo "\n";
 echo "ERROR: voip.ms email address and voip.ms AGI password\n";
 echo " must also be inserted into class.voipms.php script.\n";
 echo "\n";
 echo "Make certain that you first have enabled the API with your\n";
 echo " server's current IP address using the voip.ms portal.\n";
 $errorflag = true;
 exit;
endif;
if ( strlen($SMSsender)<>10 ) :
 echo "ERROR: SMS sender must be 10 digits.\n";
 $errorflag = true;
endif;
if ( strlen($smsnumber)<>10 ) :
 echo "ERROR: SMS number must be 10 digits.\n";
 $errorflag = true;
endif;
if ( strlen($smsmessage)<2 ) :
 echo "ERROR: SMS message must be at least 2 characters long.\n";
 $errorflag = true;
endif;
if ( strlen($otherstuff)>0 ) :
 echo "ERROR: SMS message must be surrounded by quotes.\n";
 $errorflag = true;
endif;

if ($errorflag):
 echo "\n";
 echo 'SYNTAX: ./voipms-sms.php smsnumber "sms message"';
 echo "\n\n";
 exit ;
endif;


$voipms = new VoIPms();

/* Send SMS */
$response = $voipms->sendSMS($SMSsender,$smsnumber,$smsmessage);

/* Get Errors - SMS_failed */
if($response[status]!='success'){
    echo $response[status];
    exit;
}
echo "SMS message has been sent to $smsnumber.\n\n";
?>
