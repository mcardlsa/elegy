<?php
$email = array(
	'name'	=> 'emailId',
	'id'	=> 'emailId',
	'value' => set_value('emailId'),
	'placeholder'	=> "email@emailaddress.com",
	'class'	=> 'form-control',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'placeholder'	=> 'Password',
	'class'	=> "form-control",
);
if(!empty($errors))
{
echo $errors['login'];
}
?>
	
	
<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1><?php echo $title ;?></h1>
        	<p>Already have an account? please sign in below.</p>
            
            <div class="clearfix"></div>
            <?php echo form_open('user/login', array('class'=>'register_form', 'role'=> 'form')); ?>
           
              <div class="form-group">
                <label for="email">Email:</label>
				<?php echo form_input($email); ?>
				<?php echo form_error($email['name']); ?>
				<?php echo isset($errors[$email['name']]) ? '<span class="alert-danger">'.$errors[$email['name']] .'</span>':''; ?>	
	          </div>
              <div class="form-group">
                <label for="password">Password:</label>
				<?php echo form_password($password); ?>
				<?php echo form_error($password['name']); ?>
				<?php echo isset($errors[$password['name']]) ? '<span class="alert-danger">'.$errors[$password['name']] .'</span>':''; ?>
			<?php  $this->load->view('elements/flash_message');?> 
				  
			<a class="cencle_btn" href="<?php echo site_url('user/forgot_password');?>" style="text-align:left; margin-top:10px; margin-bottom:25px; float:left;">Forget Password ?</a>	  
			</div>
			
              <button type="submit" class="btn btn-default">SIGN IN</button>
              
              <p style="font-family:'Georgia-Italic'; color:#96979b; text-align:center; text-transform:uppercase; margin:25px 0;">Or</p>
              <a href="<?php echo site_url('user/fblogin'); ?>" class="btn fb_btn"><i class="fa fa-facebook"></i><span>Sign in with Facebook</span></a>
              <!--<a class="btn fb_btn"><i class="fa fa-facebook"></i> <span>Sign in with Facebook</span></a> -->
            <?php echo form_close();?>
            
        </div>
    </div>
</div>

