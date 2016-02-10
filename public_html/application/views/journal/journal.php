<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1><?php echo $title; ?></h1>
        	<p>Your personal Journal.</p>
            
            <div class="clearfix"></div>            
            
            <?php echo form_open('funeral/add_journal', array('class'=>'register_form', 'role'=> 'form')); ?>
            	<div class="mar_bm_20">
                	 <input type="text" name="title" class="form-control" placeholder="Title" >
					<?php echo form_error('title'); ?> 
                </div>
                
                <div>
                	<textarea class="form-control textare_big" name ="description" rows="10" placeholder="Write down anything that comes to mind..."></textarea>
                	<?php echo form_error('description'); ?> 
			    </div>
                
                <button type="submit" class="btn">Save</button>
                 <?php if(!empty($journal_listing)){ 
			     foreach($journal_listing as $val) { ?>
			      
			    <a type="button" class="btn btn_2 position-relative" href="<?php echo site_url('funeral/update_journal').'/'.$val['id'];?>"><?php echo $val['title'];?><small><i class="fa fa-angle-right"></i></small></a>
                <?php } }?>
            <?php echo form_close(); ?> 
        </div>
    </div>



