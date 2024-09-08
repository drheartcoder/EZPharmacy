<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$password = "";							//Password of your Mobily.ws account
$activetCode = "";                     	//The activation code that have be sent to mobile number
$senderId = "";                         //The result from addSender-API when you request a license for mobile number as sender name, without(#) e.g. if the result is #110, then use it here as 110.
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// Activate mobile number as sender name
echo activeSender($mobile, $password, $senderId, $activetCode, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>