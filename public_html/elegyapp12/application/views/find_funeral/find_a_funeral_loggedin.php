<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title ;?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>            
            
            <?php echo form_open('funeral/find_funeral', array('class'=>'register_form', 'role'=> 'form')); ?>
                <div class="form-group position-relative">
                    <label>Funeral Code</label>
                	<input type="text" name= "code" class="form-control" placeholder="enter code...">
                    <?php echo form_error('code'); ?> 
					<button type="submit" class="btn go_btn">Go</button>
					<?php $this->load->view('elements/flash_message');?>
                </div>
                
                <div class="clearfix"></div>
                 <p style="font-family:'Georgia-Italic'; color:#96979b; text-align:center; text-transform:uppercase; margin:35px 0 25px 0;">Your Memories</p>
                <?php foreach ($funeral_listing as $val) {?>
                <a type="button" class="btn btn_1 position-relative mar_bm_20" href="<?php echo site_url('funeral/memorial').'/'.$val['funeralId'];?>"><?php echo $val['name']; ?> <small><?php echo $val['dateOfDeath']; ?></small></a>
                <?php } ?>
                
					<a type="button" class="btn btn-default mar_tp_25" href="<?php echo site_url('funeral/create_funeral');?>">Create a Memory</a>
				
            <?php echo form_close();?>
        </div>
    </div>
</div>

