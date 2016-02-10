<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1><strong> <?php echo $title; ?></strong></h1>
        	<p>Have you received an invitation to a funeral? Copy and paste it into the box below to make memories.</p>
            
            <div class="clearfix"></div>            
            <?php $this->load->view('elements/flash_message');?>
             <?php echo form_open('funeral/find_funeral', array('class'=>'register_form', 'role'=> 'form')); ?>
                <div class="form-group position-relative">
                    <label>Funeral Code</label>
                	<input type="text" name = "code" class="form-control" placeholder="enter code...">
					<?php echo form_error('code'); ?> 
                    <button type="submit" class="btn go_btn">Go</button>
                </div>
			<a type="button" class="btn btn-default mar_tp_25" href="<?php echo site_url('funeral/create_funeral');?>">Create a Memory</a>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


