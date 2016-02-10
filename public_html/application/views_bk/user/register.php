


<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title; ?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>
            
             <?php echo form_open('user/register', array('class'=>'register_form', 'role'=> 'form')); ?>
              <div class="form-group">
                <label>Email</label>
                <input type="text"  name= "emailId" class="form-control" placeholder="email@emailaddress.com">
            	<?php echo form_error('emailId'); ?>  
			</div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name= "password" class="form-control" placeholder="create a password">
              </div>
              <button type="submit" class="btn btn-default">Sign Up</button>
              
              <p style="font-family:'Georgia-Italic'; color:#96979b; text-align:center; text-transform:uppercase; margin:25px 0;">Or</p>
              
              <a href="<?php echo site_url('user/fblogin'); ?>" class="btn fb_btn"><i class="fa fa-facebook"></i><span>Sign in with Facebook</span></a>
            <?php echo form_close();?>
            
        </div>
    </div>
</div>



