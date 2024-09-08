<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$password = "";							//Password of your Mobily.ws account
$sender = "";                 	    	//Sender name to be activated, its length must not exceed 11 characters and mustn't contains any special characters										//
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// Activate alphabets name as sender name
echo addAlphaSender($mobile, $password, $sender, $resultType);
//гж»«нбн б—”«∆б «бћж«б
?>