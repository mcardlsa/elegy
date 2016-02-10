<div class="row">
<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title;?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>            
			 <?php echo form_open('user/change_password', array('class'=>'register_form', 'role'=> 'form')); ?>
                <div class="form-group">
					<label>First Name</label>
                	<input type="text" name="fname" class="form-control mar_bm_20" <?php if(isset($info[0]->firstName)) {?> value="<?php echo $info[0]->firstName;?>"<?php }else { ?> placeholder="Enter First Name" <?php } ?>>
                    <?php echo form_error('fname'); ?>
					 <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" <?php if(isset($info[0]->lastName)) {?> value="<?php echo $info[0]->lastName;?>"<?php }else { ?> placeholder="Enter Last Name" <?php } ?>>
                    <?php echo form_error('lname'); ?>  
					<?php $this->load->view('elements/flash_message');?>
                    <label class="mar_tp_65">Email</label>
                	<input type="email" name ="emailId" class="form-control" value="<?php echo $info[0]->emailId;?>" disabled />
                    <?php echo form_error('emailId'); ?>    
			</div>
                
                <div class="form-group">
                    <label>Change Password</label>
                	<input type="password" name="password1" class="form-control mar_bm_20" placeholder="old password">
                    <?php echo form_error('password1'); ?>
                    <input type="password" name="password" class="form-control" placeholder="new password">
                    <?php echo form_error('password'); ?>     
			</div>
                
                <button type="submit" class="btn">Update</button>
                
           <?php echo form_close(); ?>
        </div>
    </div>
</div>

