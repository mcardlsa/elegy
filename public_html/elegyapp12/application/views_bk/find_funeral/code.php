<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong> <?php echo $title; ?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>            
            <?php $this->load->view('elements/flash_message');?>
             <?php echo form_open('funeral/find_funeral', array('class'=>'register_form', 'role'=> 'form')); ?>
                <div class="form-group position-relative">
                    <label>Funeral Code</label>
                	<input type="text" name = "code" class="form-control" placeholder="enter code...">
					<?php echo form_error('code'); ?> 
                    <button type="submit" class="btn go_btn">Go</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


