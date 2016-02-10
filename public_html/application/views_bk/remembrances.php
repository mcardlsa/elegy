<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong>Remembrances</strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            <div class="clearfix"></div>
            <div class="all_txt_mid register_form">
				<?php $this->load->view('elements/flash_message');?>
            	<?php echo form_open_multipart('funeral/create_feed', array('class'=>'mar_bm_20', 'role'=> 'form')); ?>
                <div class="form-group position-relative">
                        <label>Upload a photo</label>
                       <input id="uploadFile" class="form-control" name="" placeholder="choose from file..." disabled="">
                        <div class="fileUpload btn file_btn">
                            <span><i class="fa fa-plus"></i></span>
							<?php echo form_upload(array("name" => "imageUrl","class" => "upload","id"=>"uploadBtn")); ?>
                            <?php echo form_error('imageUrl'); ?>
							<?php echo isset($file_upload_error) ? $file_upload_error : '';?>
                        </div>
                    </div>
                    <textarea class="form-control" rows="8" name="text"></textarea>
                    <button type="submit" class="btn btn-default">Share Thought</button>
                <?php form_close(); ?>

                <div class="gallery_con">
					<?php if(isset($get_feed )) {
							foreach($get_feed as $val){ ?>
                	<div class="gal_pic_1 position-relative">
						<a class="btn-default delete_btn" href="<?php echo site_url('funeral/delete_feed').'/'.$val['feedId'];?>"><i class="fa fa-trash-o"></i></a>
					
						<?php 	if(isset($val['mediaType'])) {
								if($val['mediaType']=='video') { ?>
                    	<div class="gallery_img"><img src="<?php echo base_url($val['thumb_URL']);?>" width="auto"></div>
                        <?php } else { ?>
								<div class="gallery_img"><img src="<?php echo base_url($val['media_URL']);?>" width="auto"></div>
						<?php } }?>
                        <div class="col-sm-6 pad0">
                            <p class="gal_date"><?php echo $val['createdTime']; ?></p>
                        </div>
                        
                        <div class="col-sm-6 pad0">
                            <p class="gal_name"><?php echo $val['firstName'] .' '. $val['lastName']; ?></p>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="border_blue"></div>
                        <div class="clearfix"></div>
                        
                        <p class="thought"><?php echo $val['text']; ?></p>
                        
                    </div>
                     <?php } } ?>
                    
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function(e) {
    	document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
	
});
</script>
