<?php
function get_speciality_title($id = false) 
{
	$data='';
	if($id!=false)
	{	
		$data = DB::table('speciality')->select('name')->where('id',$id)->first();
		if(isset($data))		
		{			
			return $data->name;
		}
		else
		{			
			return null;		
		}
	}
}	
?>