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
        	<h3><strong><?php echo $title;?></strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>
            
            <div class="all_txt_mid">
            	<ul class="gallery_button">
                	<li>
                        <a class="active">gallery <div><?php echo $funeral_detail['name']; ?></div></a>
                    </li>
                  
                    <!--li>
                    	<a id="share1">Shared Gallery</a>
                    </li-->
                </ul>
                
                <div class="gallery_con" style="margin-top:65px;">
					
                    <div class="gal_pic_1 position-relative" id="share"> 
					   	
                    	<?php if(isset($share_gallery ))  {
							foreach($share_gallery as $val){ ?>
						<?php if($this->user_auth->is_logged_in()) {?>
						<?php if($userId == $hostId){ ?>
						<a class="btn-default delete_btn" href="<?php echo site_url('funeral/delete_gallery').'/'.$val['id'];?>"><i class="fa fa-trash-o"></i></a>
						<?php } }?> 
						
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
                    
                    <div class="gallery_img mar_bm_20"><img src="<?php echo base_url($val['uri']);?>" width="auto"></div>
							
						<?php } } ?>
					</div>
                    	
                    <div class="clearfix"></div>
                   
					<?php echo form_open_multipart('funeral/gallery', array('class'=>'gallery_form', 'role'=> 'form')); ?>
                    <div class="form-group position-relative mar_tp_15">
						<?php if ($this->user_auth->is_logged_in()) { ?>
                        <?php if($userId == $hostId){ ?>
                       <input id="uploadFile" class="form-control" placeholder="choose from file..." disabled />
                        <div class="fileUpload btn file_btn">
                            <span>Upload Photo</span>
							<?php echo form_upload(array("name" => "imageUrl","class" => "upload","id"=>"uploadBtn")); ?>
                            <?php echo form_error('imageUrl'); ?>
							<?php echo isset($file_upload_error) ? $file_upload_error : '';?>
                        </div>
						<?php } }?>
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


