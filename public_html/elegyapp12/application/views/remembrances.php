<div class="PopupMain EditFieldPop"> 	
    <div class="PopupMainInner">
        <div class="pop_txt box1">
            <p>Are you sure you want to delete?</p>
           <div class="col-sm-6">
            <button type="button" class="btn-lg no" name="" value="">No</button>
           </div>
           
           <div class="col-sm-6">
            <button type="button" class="btn-lg yes" name="" value="">Yes</button>
           </div>
        </div>
     <div class="clear"></div>
    </div>
</div>

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
                    <textarea class="form-control" rows="8" id="text" name="text"></textarea>
				<?php echo form_error('text'); ?>
                    <button type="submit" id="next1" class="btn btn-ddelete_btnefault">Share Thought</button>
                <?php form_close(); ?>

                <div class="gallery_con">
					
					<?php if(isset($get_feed )) {
							foreach($get_feed as $val){ ?>
                	<div class="gal_pic_1 position-relative">
						<?php if($userId==$val['createdBy']) { ?>
						<a class="btn-default delete_btn" href="<?php echo site_url('funeral/delete_feed').'/'.$val['feedId'];?>"><i class="fa fa-trash-o"></i></a>
					   <?php } elseif($userId==$hostId){ ?>
						<a class="btn-default delete_btn" href="<?php echo site_url('funeral/delete_feed').'/'.$val['feedId'];?>"><i class="fa fa-trash-o"></i></a>
						<?php } ?>
						<?php 	if(!empty($val['mediaType'])) {
								if($val['mediaType']=='video') { ?>
                    	<div class="gallery_img"><img src="<?php echo base_url($val['thumb_URL']);?>" width="auto"></div>
                        <?php } else { ?>
						<div class="gallery_img"><img src="<?php echo base_url($val['media_URL']);?>" width="auto"></div>
						<?php } }?>
						 <p class="thought"><?php echo $val['text']; ?></p>
						
						<div class="clearfix"></div>
                        <div class="col-sm-6 pad0">
							
                            <p class="gal_date"><?php $gmttime=strtotime($val['createdTime']);					
					$user_timezone = $_COOKIE['utimezone'];
					$user=($user_timezone*60*60);
					$orderLocalTime=$gmttime+$user;
					echo date("Y-m-d h :i a",$orderLocalTime);  ?></p>
                        </div>
                        
                        <div class="col-sm-6 pad0">
                            <p class="gal_name"><?php echo $val['firstName'] .' '. $val['lastName']; ?></p>
                        </div>

						 <div class="clearfix"></div>
                        <div class="border_blue"></div>
						<div class="clearfix"></div>
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
<script>
  $(document).ready(function(){
    $('.delete_btn').click(function(){
      $('.EditFieldPop').show();
      return false;
    });

    $('.yes').click(function(){
      window.location=$('.delete_btn').attr('href');
    });

    $('.no').click(function(){
      $('.EditFieldPop').hide();
    });
  });
</script>

<script>
$(document).ready(function() {
    document.getElementById("next1").onclick= function (e) {
     var x = document.getElementById("uploadFile").value;
	 var y = document.getElementById("text").value;
     
      if(x.length > 0 || y.length > 1)
       { } else {
         alert('please enter image or text');
         return false;
       }    
    }
});
</script>