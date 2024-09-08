<?php

namespace App\Models;
use DB;
use Mail;
/*date_default_timezone_set('Asia/Kolkata');*/
class MasterModel
{
	public function createOrderId($tableName,$columnName)
	{
		$orderId = time().mt_rand(1000,99999);
		$isFound = $this->getRecords($tableName,array('order_id'),'',array($columnName => $orderId));
		if(!count($isFound)){
			return $orderId;
		}
		else{
			$this->createOrderId($tableName,$columnName);
		}
	}
	public static function payment_calculation($jsonData, $depositAmt = null)
	{
		/*echo $depositAmt;*/
		$paymentData = json_decode($jsonData,TRUE);

        $transactionId 	= $paymentData['paymentInfo']['transaction_id'];
        $strPayablePrice  = 'USD $'.number_format($paymentData['paymentInfo']['payablePrice'],2,'.','');


        $payablePrice 	= $paymentData['paymentInfo']['payablePrice'];
        $lastPaid 		= $paymentData['paymentInfo']['payablePrice'] - $depositAmt;
        $netpayablePrice  = $paymentData['paymentInfo']['netpayablePrice'];
        $clientFee 		= $paymentData['paymentInfo']['clientFee'];
        $dateString 	= date('d-m-Y',strtotime($paymentData['paymentInfo']['paymentDateTime']));

        /**/

        if(isset($paymentData['paymentInfo_2']))
        {
            $transactionId 	 .=  '<br> '.$paymentData['paymentInfo_2']['transaction_id'];
            $strPayablePrice .=  '<br>USD $'.number_format($paymentData['paymentInfo_2']['payablePrice'],2,'.','');

            $payablePrice 	 +=  $paymentData['paymentInfo_2']['payablePrice'];
            $lastPaid 		  =  $paymentData['paymentInfo_2']['payablePrice'];
            $netpayablePrice +=  $paymentData['paymentInfo_2']['netpayablePrice'];
            $paymentData['paymentInfo_2']['clientFee'];
            $dateString 	 .= '<br>'.date('d-m-Y',strtotime($paymentData['paymentInfo_2']['paymentDateTime']));
        }

        /*echo $lastPaid;*/

        /*$transactionId = $paymentData['paymentInfo']['transaction_id'];
        $totalPaid    = $paymentData['paymentInfo']['payablePrice'];
        $paidAmount   = 'USD $'.number_format($paymentData['paymentInfo']['payablePrice'],2,'.','');
        $paymentData['paymentInfo']['netpayablePrice'];
        $paymentData['paymentInfo']['clientFee'];
        $paidDate = date('d-m-Y',strtotime($paymentData['paymentInfo']['paymentDateTime']));

        if(isset($paymentData['paymentInfo_2']))
        {
            $transactionId .= '<br>'.$paymentData['paymentInfo_2']['transaction_id'];
            $totalPaid +=  $paymentData['paymentInfo_2']['payablePrice'];
            $paidAmount .=  '<br>USD $'.number_format($paymentData['paymentInfo_2']['payablePrice'],2,'.','');
            $paymentData['paymentInfo_2']['netpayablePrice'];
            $paymentData['paymentInfo_2']['clientFee'];
            $paidDate .=  '<br>'.date('d-m-Y',strtotime($paymentData['paymentInfo_2']['paymentDateTime']));
        }*/

        $resp['stringTransaction']  = $transactionId;
        $resp['strPayablePrice'] 	= $strPayablePrice;

        $resp['payablePrice'] 		= $payablePrice;
        $resp['netpayablePrice'] 	= $netpayablePrice;
        $resp['lastPaid'] 	= $lastPaid;
        $resp['clientFee'] 	= $clientFee;

        $resp['dateString'] = $dateString;
        return $resp;

	}
	public static function review_count($receiverId,$_type = null)
    {
        $query = DB::table('tbl_review_master');
        $query->select(DB::raw('count(id) as totalReviews'),DB::raw('SUM(rating) as totalRatings'),DB::raw('SUM(rating)/count(id) AS avgerageRatings'));
        $query->where('given_to','=',$receiverId);
        if(!empty($_type))
        {
        	$query->where('type','=',$_type);	
        }
        
        $starRatings = $query->get();

        $query = DB::table('tbl_applied_jobs');
        $query->select(DB::raw('count(id) as totalAwarded'));
        $query->where('applier_id','=',$receiverId);
        $query->where('status','=','awarded');
        $resAwarded = $query->get();

        $query = DB::table('tbl_applied_jobs');
        $query->select(DB::raw('count(id) as totalCompleted'));
        $query->where('applier_id','=',$receiverId);
        $query->where('status','=','completed');
        $resCompleted = $query->get();

        $allCount = $resAwarded[0]->totalAwarded + $resCompleted[0]->totalCompleted;
        $completePercent = 0;
        if(!empty($resCompleted[0]->totalCompleted)){
        	$completePercent = ($resCompleted[0]->totalCompleted / $allCount) * 100;	
        }

        $resData = array('starRatings' => $starRatings, 'completePercent' => $completePercent);

        return $resData;
    }
	public static function removeAccents($str) {
  		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
  		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
	  	return str_replace($a, $b, $str);
	}
	public static function dateDifference($date1,$date2)
	{		
		
		/*$date1= date('Y-m-d H:i:s');
		$date2="2017-02-21 14:30:00";*/

		$date1=strtotime($date1);
		$date2=strtotime($date2); 
		$diff = abs($date1 - $date2);
		
		$day = $diff/(60*60*24); /* in day*/
		$dayFix = floor($day);
		$dayPen = $day - $dayFix;

		$str = '';
		if($dayPen > 0)
		{
			$hour = $dayPen*(24); /* in hour (1 day = 24 hour)*/
			$hourFix = floor($hour);
			$hourPen = $hour - $hourFix;
			if($hourPen > 0)
			{
				$min = $hourPen*(60); /* in hour (1 hour = 60 min)*/
				$minFix = floor($min);
				$minPen = $min - $minFix;
				if($minPen > 0)
				{
					$sec = $minPen*(60); /* in sec (1 min = 60 sec)*/
					$secFix = floor($sec);
				}
			}
		}
		/*if(!empty($minFix))
		{
			$suffix = ' min ago';
			if($minFix > 1){
				$suffix = ' mins ago';
			}
			if($minFix > 0)
			{
				$str = $minFix.$suffix;
			}
		}

		if(!empty($hourFix))
		{
			$suffix = ' hour ago';
			if($hourFix > 1){
				$suffix = ' hours ago';
			}
			if($hourFix > 0)
			$str = $hourFix.$suffix;	
		}*/

		if(!empty($dayFix))
		{
			$suffix = ' day ago';
			if($dayFix > 1){
				$suffix = ' days ago';
			}
			if($dayFix > 0)
			$str = $dayFix;	
		}
		
		/*if($secFix > 0)
			$str .= $secFix." sec ";*/
		return $str;
	}
	/*echo '<br>Difference is : '.dateDifference("2011-09-18 10:00:00", date('Y-m-d H:i:s'));*/
	public static function getRemainingDays($eventDate,$endDate = null)
	{	
		$endDate = !empty($endDate)?$endDate:date('Y-m-d');

		$seconds_left = (strtotime($eventDate) - strtotime($endDate));
		$days_left = floor($seconds_left / 3600 / 24);
		return $days_left;
	}
	public static function _calculateDays($inpDate){
		/* $inpDate = "2016-05-30"; */
		/* seperate the birth date day, month and year */
		list($inpYear, $inpMonth, $inpDay) = explode("-", $inpDate);
		/* get number of days in a month using following php function */
		$numOfDays = cal_days_in_month(CAL_GREGORIAN, $inpMonth, $inpYear);
		/* check if the day inputted is greater then number of days in month and set appropriately */
		if($inpDay > $numOfDays) {
		$inpDay = $numOfDays;
		}
		/* set month to 12 if greater then 12 */
		if($inpMonth > 12) {
		$inpMonth = 12;
		}
		/* get the difference in year */
		$diffYear = date("Y") - $inpYear;
		/* get the difference in month */
		$diffMonth = date("m") - $inpMonth;
		/* get the day difference */
		$diffDay = date("d") - $inpDay;
		/*check if month is less than 0 */
		if($diffMonth < 0) {
		$diffYear -= 1;
		$diffMonth += 12; 
		}
		/*check if the day is less than 0 */
		if($diffDay < 0) {
		$diffMonth -= 1;
		$diffDay += $numOfDays;
		}

		if ( $diffYear < 1 ) $yearString = " years ago";
		else $yearString = " year ago";
		if ($diffMonth< 1 ) $monthString = " months ago";
		else $monthString = " month ago";
		if ( $diffDay <1 ) $dayString = " days ago";
		else $dayString = " day ago";

		if ( ($diffYear < 0) && ($diffMonth < 0) && ($diffDay > 0) )
		$ageString = $diffYear.$yearString.", ".$diffMonth.$monthString;/* + ", and " + $diffDay + dayString + " old."*/
		else if ( ($diffYear == 0) && ($diffMonth == 0) && ($diffDay > 0) )
		$ageString = /* "Only " + */$diffDay.$dayString;/* + " old."*/
		else if ( ($diffYear < 0) && ($diffMonth == 0) && ($diffDay == 0) )
		$ageString = $diffYear.$yearString; /*+ " old. Happy Birthday!!";*/
		else if ( ($diffYear < 0) && ($diffMonth < 0) && ($diffDay == 0) )
		$ageString = $diffYear.$yearString." and ".$diffMonth.$monthString;/* + " old."*/
		else if ( ($diffYear == 0) && ($diffMonth < 0) && ($diffDay < 0) )
		$ageString = $diffMonth.$monthString;/* + " and " + $diffDay + dayString + " old."*/
		else if ( ($diffYear < 0) && ($diffMonth == 0) && ($diffDay < 0) )
		$ageString = $diffYear.$yearString;/* + " and " + $diffDay + dayString + " old."*/
		else if ( ($diffYear == 0) && ($diffMonth < 0) && ($diffDay == 0) )
		$ageString = $diffMonth.$monthString;/* + " old."*/
		else $ageString = 'Today';

		return $ageString;

		/* echo " ".$diffYear.$yearString;
		echo " ".$diffMonth.$monthString;
		echo " ".$diffDay.$dayString; */
	}
	public static function create_slug($string, $tableName,$slugArray,$actionType)
	{

	    $replace = '-';
	    $string = strtolower($string);
	    /*replace / and . with white space*/
	    $string = preg_replace("/[\/\.]/", " ", $string);
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    /*remove multiple dashes or whitespaces*/
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    /*convert whitespaces and underscore to $replace*/
	    $string = preg_replace("/[\s_]/", $replace, $string);
	    /*limit the slug size*/
	    $string = substr($string, 0, 100);
	    /*slug is generated*/
	    

	    /*$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));*/
	    if($actionType == 'add'){
	    	$numHits = DB::table($tableName)->where($slugArray)->count();
	    }
	    else{
	    	$numHits = DB::table($tableName)->where($slugArray)->count();
	    }
	    
	    /*$numHits = $row['NumHits'];*/

		$finalSlug = ($numHits > 0) ? ($string.'-'.$numHits.'.html') : $string.'.html';
		return $finalSlug ;
		/*$finalSlug = ($ext) ? $string.'-'.$numHits.$ext : $string.'-'.$numHits;*/

	    /*$string = "what is your name ?";
		$slug = create_slug($string); */
	}
    public static function getRecords($tblName,$selectCols = null,$joinsArray = null,$whrCondition = null,$orderBy = null, $orderStyle = null, $groupBy = null,$whrNotNullCondition = null,$setLimit = null,$numRec = null)
	{
		$query = DB::table($tblName);
		if(!empty($selectCols) && count($selectCols)){
			$query->select($selectCols);
		}
		
		if(!empty($joinsArray) && count($joinsArray))
		{	
			foreach($joinsArray as $key => $value)
		    {
		        if($value[4] == 'inner'){
		            $query->join($value[0], $value[1], $value[2], $value[3]);
		        }
		        else{
		            $query->leftJoin($value[0], $value[1], $value[2], $value[3]);
		        }   
		    } 
		}
		if(!empty($whrCondition) && count($whrCondition)){
			$query->where($whrCondition);
		}
		if(!empty($whrNotNullConditio) && count($whrNotNullConditio)){
			$query->whereNotNull($whrNotNullConditio);
		}
		if(!empty($orderBy) && !empty($orderStyle)){
			$query->orderBy($orderBy, $orderStyle);
		}
		
		if(!empty($groupBy)){
			$query->groupBy($groupBy);	
		}

		if(!empty($setLimit)){
			$numRec = !empty($numRec)?$numRec:1;
			$query->offset(0)->limit($numRec);
		}

		$result = $query->get();
        return $result;
	}

	public static function insertRecord($tableName,$dataValues)
	{
		if(!empty($tableName) && !empty($dataValues) && count($dataValues))
		{
			$result = DB::table($tableName)->insertGetId($dataValues);
			return $result;
		}
	}

	public static function updateRecord($tableName,$whrCondition,$dataValues)
	{
		if(!empty($tableName) && !empty($whrCondition) && count($whrCondition) && !empty($dataValues) && count($dataValues))
		{
			try
			{
				return DB::table($tableName)->where($whrCondition)->update($dataValues);
			}
			catch(\Exception $e)
			{
				return $e;
			}
		}
		return 'error';
	}

	public static function deleteRecord($tableName,$whrCondition)
	{
		if(!empty($tableName) && !empty($whrCondition) && count($whrCondition))
		{
			$result = DB::table($tableName)->where($whrCondition)->delete();
			return $result;
		}
	}

	/*PASSWORD CONVERT*/
	public static function passowrd_converter($password)
	{
		if(!empty($password))
		{
			return $hash_password = md5($password);
		}	
	}

	public static function sendHtmlEmail($sendersDetail,$receiversDetail)
	{
		$data = array('content' => $receiversDetail['messageBody'],'subject'=>$sendersDetail['subject']);
        $email = Mail::send($receiversDetail['viewName'], $data, function ($message)use($sendersDetail,$receiversDetail)
        {
            $message->to($receiversDetail['toEmail'])->subject($sendersDetail['subject']);
            /*$message->cc($sendersDetail['fromEmail'], $sendersDetail['fromName']);*/
            if(isset($receiversDetail['attachmentFile']) && !empty($receiversDetail['attachmentFile']))
            {
            	$message->attach($receiversDetail['attachmentFile']);
            }
           /* $message->cc($sendersDetail['fromEmail'], $sendersDetail['fromName']);*/
            $message->from($sendersDetail['fromEmail'], $sendersDetail['fromName']);
        });
        return $email;

	}

	public static function checkUser()
	{
		//echo "<pre>"; print_r(session('blog')); exit();
		if(!session()->has('blog'))
		{
			return redirect(url('/superadmin'));
		}
	}

	public static function timeago($time)
	{
		$time = strtotime($time);
		$time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }
	}

	
		
}
?>