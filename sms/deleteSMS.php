<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$password = "";							//Password of your Mobily.ws account
$deleteKey = "";                     	//The value that have been set in 'delete key' parameter with Send-SMS API, when you send a scheduled SMS
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// Delete scheduled SMS before its time
echo deleteSMS($mobile, $password, $deleteKey, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>