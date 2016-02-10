<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'placeholder'	=> 'New Password',
	'class'	=> "form-control",
);

$confirmPassword = array(
	'name'	=> 'confirmPassword',
	'id'	=> 'confirmPassword',
	'placeholder'	=> 'Confirm Password',
	'class'	=> "form-control",		
);

?>


<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title ;?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>
			<?php echo form_open('user/ResetPassword'.'/'.$userTokenKey.'/'.$resetTokenKey,array('class'=>'register_form', 'role'=> 'form')); ?>
			<div class="form-group">
					<label>New password</label>
					 <?php echo form_password($password); ?>
					 <?php echo form_error($password['name']); ?>
				</div>
				
				<div class="form-group">
					<label>Confirm password</label>
					<?php echo form_password($confirmPassword); ?>
					<?php echo form_error($confirmPassword['name']); ?>
					
				</div>
			<button type="submit" class="btn btn-default" >Submit</button>
				
			<?php echo form_close(); ?>
			
		</div>
	</div>
</div>	










               

