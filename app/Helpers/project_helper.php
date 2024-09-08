<?php 

function get_freelancer_completion_rate($user_id)
{
	// dd($user_id);
	$ProjectModel = app('App\Models\ProjectModel');

	/* Get Total Projects */
	$total_count = $ProjectModel->where('freelancer_user_id',$user_id)
							  	->where('is_disputed','0')
							  	->count();

	/* Get Completed Project excluding disputed */

	$completed_count = $ProjectModel->where('freelancer_user_id',$user_id)
						  ->where('is_disputed','0')
						  ->where('status','3')
						  ->count();

	$completion_rate = 0;
	
	if($total_count > 0)
	{
		$completion_rate = ($completed_count / $total_count) * 100;						  	
	}					  
	
    return round($completion_rate,2);
}