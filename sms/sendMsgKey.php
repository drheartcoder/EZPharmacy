<?php
include("includeSettings.php");							//Contain all main settings for the sending operations
$mobile = "";											//Mobile number (or username) of your Mobily.ws account
$password = "";											//Password of your Mobily.ws account

$sender = "NEW SMS";									//The sender name that will be shown when the message is delivered , it will be encrypted automatically to (urlencode)

$numbers = "";											//the mobile number or set of mobiles numbers that the SMS message will be sent to them, each number must be in international format, without zeros or symbol (+), and separated from others by the symbol (,).
														//there is no limit numbers that you want send messages for , when using the fsockpoen and CURL portal¡
														//But if you send the messages using the portal fOpen then you can send to 120 number in each send operation
														//Note: numbers count must be equal to messages count in the msgKey

$msg = "Dear Mr. (1)¡ your account is valid until (2)";	//Message Template

$msgKey = "(1),*,Muhammad,@,(2),*,12/10/2008***(1),*,Ahmad,@,(2),*,10/10/2008";	/*Countervailing values, the following are the symbols details
																				•	(1), (2)…: the symbols where the values will be replaced with it.
																				•	* : separate between the symbol and the value that will replace it.
																				•	@ : separate between each definition of the symbol and its value.
																				•	*** : separate between each SMS definitions.
																				*/

$MsgID = rand(1,99999);					//Random number that will be attached with the posting, just in case you want to send same message in less than one hour from the first one
										//Mobily prevents recurrence send the same message within one hour of being sent, except in the case of sending a different value with each send operation										
$timeSend = 0;							//Select the time you want to send the message. 0: now
										//Standard date format is hh:mm:ss

$dateSend = 0;							//Select the date you want to send the message. 0: now
										//Standard date format is mm/dd/yyyy
										
$deleteKey = 152485;					//use this value to delete message using delete potal
										//you can specify one number for group of messages to delete
										
$resultType = 0;						//Determine the send time, 0 means send now
										//0: Returns API result as a number
										//1: Returns API result as text											

// Send templates messages
echo sendSMSWK($mobile, $password, $numbers, $sender, $msg, $msgKey, $MsgID, $timeSend, $dateSend, $deleteKey, $resultType);
//ãæÈÇíáí áÑÓÇÆá ÇáÌæÇá
?>