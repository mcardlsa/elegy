
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h1><?php echo $title; ?></h1>
        	<p>The schedule for the day.</p>
           
            <div class="clearfix"></div>
           
            <div class="all_txt_mid">
                <div class="position-relative">
                	<div class="wapper">
                    	<p>Remembering</p>
                    	<h1><?php echo $funeral_detail['name']; ?></h1>
                    </div>
                	<div class="gallery_img"><img src="<?php echo base_url($funeral_detail['profileImage']);?>" width="auto"></div>
                </div>
     
                <div class="panel-group custom_panel mar_tp_25" id="accordion" role="tablist" aria-multiselectable="true">
					
					<?php if(isset($schedule)) {
                     foreach($schedule as $val) {?>
                	<div class="cols-m-12 pad0 panel_strip">
                    	<div class="col-sm-2 pad-left0">
                            <div class="circl_time">
							
                                <p><?php echo date('h:i',strtotime($val['time'])); $x=date('H',strtotime($val['time'])); if ($x>12){ ?><small>PM </small><?php } else{?><small>AM </small><?php }  ?></p>
                            </div>
                    	</div>
                        
                    	<div class="panel panel-default">
                             <div class="col-sm-10 pad-right0">
                                <div class="panel-heading" role="tab"  <?php if ($val['eventType']=='wake') {  ?> id="headingOne" <?php } elseif($val['eventType']=='ceremony') {  ?>id="headingTwo" <?php } elseif($val['eventType']=='burial') {  ?>id="headingThree" <?php }  elseif($val['eventType']=='reception') {  ?>id="headingFour" <?php } ?>>
                                  <h4 class="panel-title">
                                    <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion"<?php if ($val['eventType']=='wake') {  ?> href="#panelOne" <?php } elseif($val['eventType']=='ceremony') {  ?>href="#panelTwo" <?php } elseif($val['eventType']=='burial') {  ?>href="#panelThree" <?php }  elseif($val['eventType']=='reception') {  ?>href="#panelFour" <?php } ?>  aria-expanded="true" aria-controls="collapseOne">
                                   	 <p><?php echo $val['eventType']; ?> <small_head> <?php echo date("Y-m-d h :i a",strtotime($val['time'])); ?></small_head></p>
                                    </a>
                                  </h4>
                                </div>
                                <div  class="panel-collapse collapse" role="tabpanel" <?php if ($val['eventType']=='wake') {  ?> aria-labelledby="headingOne" id="panelOne" <?php } elseif($val['eventType']=='ceremony') {  ?> aria-labelledby="headingTwo"  id="panelTwo" <?php } elseif($val['eventType']=='burial') {  ?> aria-labelledby="headingThree" id="panelThree" <?php }  elseif($val['eventType']=='reception') {  ?> aria-labelledby="headingFour" id="panelFour" <?php } ?> >
                                  	<div class="panel-body">
                                  	<div class="mar_bm_20">
                                    	<p class="heading">Time</p>
                                   		<p  class="text"><?php echo date('h : i ',strtotime($val['time'])); $x=date('H',strtotime($val['time'])); if ($x>12){ echo 'PM';} else{ echo 'AM';}  ?></p>
                                    </div>
                                    
                                    <div class="mar_bm_20">
                                    	<p class="heading">Location</p>
                                   		<p class="text"><?php echo $val['locationName']; ?></p>
                                    </div>
                                    
                                    <div class="mar_bm_20">
                                    	<p class="heading">Get Directions (open in maps)</p>
                                   		<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="100%" height="300" src="https://maps.google.com/maps?hl=en&q=<?php echo $val['address'];?>&ie=UTF8&t=roadmap&z=15&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://buyproxies.io/">buyproxies.io</a></small></div></iframe>
                                    </div>
                                  	
                                  </div>
                                </div>
                             </div>
                    	</div>
                    </div>
                    
					  <div class="clearfix"></div>
                    <?php  }?>
                   
                </div>
				<?php } else { ?>
				
				<p> No Schedule </p>
				<?php }?>
				
            </div>
        </div>
    </div>
