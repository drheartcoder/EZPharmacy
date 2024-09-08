<?php

use App\Models\ReviewModel;

function get_avg_rating($user_id = false)
{
	$obj_review = ReviewModel::where('to_user_id',$user_id)->select('review','rating')->get();

	$avg_rating = '0';

    if($obj_review)
    {
    	$arr_review = $obj_review->toArray();

    	if(isset($arr_review) && sizeof($arr_review)>0)
    	{
    		$total_rating = 0;

	    	foreach ($arr_review as $key => $rating) 
	    	{
	    	   	$total_rating = $total_rating + $rating['rating'];
	    	}	
    		
    		$avg_rating = $total_rating/count($arr_review);
    	}
    }
    
    return $avg_rating;

}

?>