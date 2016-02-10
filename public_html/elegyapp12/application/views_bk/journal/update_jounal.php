
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title; ?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
           
            <div class="clearfix"></div>            
            <?php echo form_open('funeral/update_journal/'.$journal_detail[0]['id'], array('class'=>'register_form', 'role'=> 'form')); ?>
            	<div class="mar_bm_20">
                	 <input type="text" class="form-control" name="title" value ="<?php echo $journal_detail[0]['title']; ?>" placeholder="Title" >
                </div>
                
                <div>
                	<textarea class="form-control textare_big" name="description" rows="10" ><?php echo $journal_detail[0]['description']; ?></textarea>
                </div>

				<div class="col-sm-6 pad0">
                	<button type="submit" class="btn btn-save position-relative">save</button>
                </div>
                
                <div class="col-sm-6 pad0">
                	<a type="button" class="btn btn-delete position-relative" href ="<?php echo site_url('funeral/delete_journal').'/'.$journal_detail[0]['id'];?>">Delete</a>
                </div>    
            <?php echo form_close(); ?>
        </div>
    </div>


