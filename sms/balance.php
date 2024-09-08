<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$password = "";							//Password of your Mobily.ws account
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// Check current balance
echo balanceSMS($mobile, $password, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>