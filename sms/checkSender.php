<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$password = "";							//Password of your Mobily.ws account
$senderId = "";							//The result from addSender-API when you request a license for mobile number as sender name, without(#) e.g. if the result is #110, then use it here as 110.
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// check the activation status of a mobile number as sender name
echo checkSender($mobile, $password, $senderId, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>