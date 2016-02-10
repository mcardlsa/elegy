<html>
<head>
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>" media="screen" type="text/css" />
</head>
</html>
<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'placeholder'	=> 'Password',
	'class'	=> "form-control",
);

$confirmPassword = array(
	'name'	=> 'confirmPassword',
	'id'	=> 'confirmPassword',
	'placeholder'	=> 'Confirm Password',
	'class'	=> "form-control",		
);

?>

<?php echo form_open('users/ResetPassword'.'/'.$userToken.'/'.$resetPasswordToken); ?>
    <label for="inputPassword5" class="col-sm-3 control-label">New Password<em style="color:red; padding-right:10px;">*</em></label>
	
    <?php echo form_password($password); ?>
	<?php echo form_error($password['name']); ?>
	<label for="inputPassword5" class="col-sm-3 control-label">Confirm Password<em style="color:red; padding-right:10px;">*</em></label>
	
    <?php echo form_password($confirmPassword); ?>
	<?php echo form_error($confirmPassword['name']); ?>
	<input type="submit" class="login login-submit" value="Submit" />
<?php echo form_close(); ?>
  

               

