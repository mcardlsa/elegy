

	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong><?php echo $title;?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>
            
            <div class="all_txt_mid">
            	<ul class="gallery_button">
                	<li>
                    	<a id="gal1">My gallery</a>
                    </li>
                    
                    <li>
                    	<a class="active" id="share1">Shared Gallery</a>
                    </li>
                </ul>
                
                <div class="gallery_con" >
					<?php if($this->user_auth->is_logged_in()) :?>
					<div class="gal_pic_1" id="gal">
						<?php foreach($gallery as $val){ ?>
							<div class="gallery_img"><img src="<?php echo base_url($val['uri']);?>" width="auto"></div>

							<div class="col-sm-6 pad0">
								<p class="gal_date"><?php echo $val['createdTime']; ?></p>
							</div>

							<div class="col-sm-6 pad0">
								<p class="gal_name"><?php echo $val['firstName'] .' '. $val['lastName']; ?></p>
							</div>
						<?php } ?>  	
				   </div>
					<?php endif; ?>
					
					
                	<div class="gal_pic_1" id="share"> 
					   	
                    	<?php if(isset($share_gallery )) {
							foreach($share_gallery as $val){ ?>
							<div class="gallery_img"><img src="<?php echo base_url($val['uri']);?>" width="auto"></div>

							<div class="col-sm-6 pad0">
								<p class="gal_date"><?php echo $val['createdTime']; ?></p>
</div>

							<div class="col-sm-6 pad0">
                            <p class="gal_name"><?php echo $val['firstName'] .' '. $val['lastName']; ?></p>
                        </div>
                    	<?php } } ?>
					</div>
                    
                    <div class="clearfix"></div>
                   
					<?php echo form_open_multipart('funeral/gallery', array('class'=>'gallery_form', 'role'=> 'form')); ?>
                    <div class="form-group position-relative">
                       <input id="uploadFile" class="form-control" placeholder="choose from file..." disabled />
                        <div class="fileUpload btn file_btn">
                            <span>Upload Photo</span>
							<?php echo form_upload(array("name" => "imageUrl","class" => "upload","id"=>"uploadBtn")); ?>
                            <?php echo form_error('imageUrl'); ?>
							<?php echo isset($file_upload_error) ? $file_upload_error : '';?>
                        </div>
                   	 </div>
						<button type="submit" class="btn btn-default save_btn">Save</button>
                   		<?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function(e) {
    $('#gal').hide();
		$('#share1').click(function(){
			$('#share').show();
			$('#gal').hide();
			$("#gal1").removeClass("active");
			$("#share1").addClass("active");
		});
	
	$('#gal1').click(function(){
		$('#share').hide();
		$('#gal').show();
		$("#share1").removeClass("active");
		$("#gal1").addClass("active");
	});
});
</script>

<script>
$(window).load(function(e) {
    $('#uploadFile').hide();
	$('.save_btn').hide();
		$('#uploadBtn').click(function(){
			$('#uploadFile').show();
			$('.save_btn').show();
		});
});
</script>


<script>
$(document).ready(function(e) {
    	document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
	
});
</script>
