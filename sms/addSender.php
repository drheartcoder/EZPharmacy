<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account.
$password = "";							//Password of your Mobily.ws account.
$sender = "";							//Mobile number you need to activate as a sender name. it must be in the international format as: 966505555555
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text 

// Request a license for mobile number as a sender name
echo addSender($mobile, $password ,$sender, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>