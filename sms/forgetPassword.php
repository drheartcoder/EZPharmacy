<?php
include("includeSettings.php");			//This file contains all the main settings of SMS API
$mobile = ""; 							//Mobile number (or username) of your Mobily.ws account
$sendtype = 1;							//1 or 2 
										//1: the password will be sent to your mobile number
										//2: the password will be sent to your email Determine where to send the password (in this case you should have been specified it in your Personal Info page at you account)
$resultType = 0;						//This parameter specify the type of the API result
										//0: Returns API result as a number
										//1: Returns API result as text	

// Forget password, to retrieve your password in case you lost it
echo forgetPassword($mobile, $sendtype, $resultType);

?>