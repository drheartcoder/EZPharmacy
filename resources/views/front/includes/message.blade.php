<?php 
$msg_minlength = translation('this_field_is_too_short');
if(isset($minlength)) 
{
	$msg_minlength = translation('minimum')." ".$minlength." ".translation('characters_should_be_entered');
}
$msg_maxlength = translation('this_field_is_too_long');
if(isset($maxlength)) 
{
	$msg_maxlength = translation('maximum')." ".$maxlength." ".translation('characters_can_be_entered');
}

$msg_pattern = translation('invalid_format');
if(isset($pattern)) 
{
	$msg_pattern = $pattern;
}

?>
<p ng-message="required" class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('this_field_is_required')));?></p>
<p ng-message="minlength"  class="error"><?php if($msg_minlength != ''){ echo $msg_minlength; } else { echo 'N/A'; } ?></p>
<p ng-message="maxlength"  class="error"><?php if($msg_maxlength != ''){ echo $msg_maxlength; } else { echo 'N/A'; } ?></p>
<p ng-message="email"  class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('this_field_needs_to_be_a_valid_email')));?></p>
<p ng-message="password"  class="error"><?php echo (preg_replace('#<[^>]+>#',' ',translation('password_is_not_valid')));?></p>
<p ng-message="pattern" class="error"><?php if($msg_pattern != ''){ echo $msg_pattern; } else { echo 'N/A'; } ?></p>