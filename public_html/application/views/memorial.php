
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1><?php echo $title; ?></h1>
            
            <div class="clearfix"></div>
            
            <div class="all_txt_mid register_form">
            	<div class="cl_img"><img src="<?php echo base_url($funeral_detail['profileImage']);?>" width="auto"></div>
                
                <h1><strong><?php echo $funeral_detail['name']; ?></strong></h1>
                <p class="col_txt">Presented by <?php echo $funeral_detail['hostFirstName'] .' '. $funeral_detail['hostLastName'];?></p>
                
                <div class="mar_tp_50 main_txt">
                	 <p> <?php echo $funeral_detail['about']; ?>.</p>
                </div>
                
				<form class="mar_tp_15">
					<a type="button" class="btn btn-default" href="<?php echo site_url('funeral/create_feed');?>">Continue</a>
				</form>
				
				
            </div>
            
        </div>
    </div>

