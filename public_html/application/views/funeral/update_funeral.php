<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyDPwO4rEm_h3TgaQw_89bMzs8JCHDesWZg" type="text/javascript"></script>
<script>
$(window).load(function(){
	$('.pop_show').css('display','block');
	
	if ($('.pop_show').css("display") == "block")
	{
		$('.register_form .click_btn i').css('color', '#0F416A');
		$('.register_form .click_btn').css('background','#fff');
	}
           
});
</script>

<script>
		
$(function(){     
    
    var input = document.getElementById('searchTextField1');         
    var autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["geocode"]
    });    
    
    
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      
       
		var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
		var longitude = place.geometry.location.lng();
         document.getElementById("userLatitude1").value = latitude;
	     document.getElementById("userLongitude1").value = longitude;
       
       
    });  
    
      var input2 = document.getElementById('searchTextField2');         
      var autocomplete2 = new google.maps.places.Autocomplete(input2, {
        types: ["geocode"]
    });    
       
     google.maps.event.addListener(autocomplete2, 'place_changed', function() {
      
        var place2 = autocomplete2.getPlace();
        var latitude2 = place2.geometry.location.lat();
		var longitude2= place2.geometry.location.lng();
         document.getElementById("userLatitude2").value = latitude2;
	     document.getElementById("userLongitude2").value = longitude2;
       
    });  
	 
	 
	 var input3 = document.getElementById('searchTextField3');         
    var autocomplete3 = new google.maps.places.Autocomplete(input3, {
        types: ["geocode"]
    });    
    
    
    google.maps.event.addListener(autocomplete3, 'place_changed', function() {
      
       
		var place3 = autocomplete3.getPlace();
        var latitude3 = place3.geometry.location.lat();
		var longitude3 = place3.geometry.location.lng();
         document.getElementById("userLatitude3").value = latitude3;
	     document.getElementById("userLongitude3").value = longitude3;
       
       
    });  
    
      var input4 = document.getElementById('searchTextField4');         
      var autocomplete4 = new google.maps.places.Autocomplete(input4, {
        types: ["geocode"]
    });    
       
     google.maps.event.addListener(autocomplete4, 'place_changed', function() {
      
        var place4 = autocomplete4.getPlace();
        var latitude4 = place4.geometry.location.lat();
		var longitude4 = place4.geometry.location.lng();
         document.getElementById("userLatitude4").value = latitude4;
	     document.getElementById("userLongitude4").value = longitude4;
       
    });  
    
   
});
</script>
<script>
$(document).ready(function(e) {
      jQuery('#datetimepicker1').datetimepicker();
   });
$(document).ready(function(e) {
      jQuery('#datetimepicker2').datetimepicker();
   });
$(document).ready(function(e) {
      jQuery('#datetimepicker3').datetimepicker();
   });
 $(document).ready(function(e) {
      jQuery('#datetimepicker4').datetimepicker();
   });
$(document).ready(function(e) {
      jQuery('#datetimepicker5').datetimepicker();
   });
$(document).ready(function(e) {
      jQuery('#datetimepicker6').datetimepicker();
   });    
</script>
<script src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css');?>">
<script type="text/javascript">
$(function () {
	$("#DateOfBirth").datepicker({
		
		changeMonth: true,
        changeYear: true,
          maxDate: 0,
		dateFormat:"yy-mm-dd",
          yearRange: "-100:-0",
        onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() + 1);
			$("#DateOfDeath").datepicker("option", "minDate", dt);
		}
	});
	$("#DateOfDeath").datepicker({
		
		changeMonth: true,
        changeYear: true,
         maxDate: 0,
		dateFormat:"yy-mm-dd",
        yearRange: "-100:-0",
        onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() - 1);
			$("#DateOfBirth").datepicker("option", "maxDate", dt);
		}
	});
});
		
   
</script>

<div class="row">
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<!-- form 1 -->
			<?php echo form_open_multipart('funeral/update_funeral/'.$funeral_detail['funeralId']); ?>
             
        	<div class="form-1">
                <h2>Coordinate <small>step 1 of 4</small></h2>
                <p>Make a change to your lasting memory.</p>
                
                <div class="clearfix"></div>
				
				<div class="register_form">
                     <div class="form-group position-relative">
                        <label>Upload a photo</label>
                       <input id="uploadFile" class="form-control" value="<?php echo $funeral_detail['profileImage'];?> " disabled />
                        <div class="fileUpload btn file_btn">
                            <span><i class="fa fa-plus"></i></span>
							<?php echo form_upload(array("name" => "imageUrl","class" => "upload","id"=>"uploadBtn")); ?>
                            <?php echo form_error('imageUrl'); ?>
							<?php echo isset($file_upload_error) ? $file_upload_error : '';?>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Include a Eulogy</label>                    
                        <p style="font-family:'Georgia-Italic'; color:#96979b;">This will be something every invited Guest will be abl to view</p>
                        <textarea class="form-control" rows="5" name="about"><?php echo $funeral_detail['about'];?></textarea>
						<?php echo form_error('about'); ?>
                    </div>
                    
                    <button class="btn next1" id="next1">Next</button>
				</div>		
            </div>
            <!-- form 1 -->
            
            <!-- form 2 -->
            <div class="form-2">
                <h2>Coordinate <small>step 2 of 4</small></h2>
                <p>Update your schedule here.</p>
                
                <div class="clearfix"></div>  

					<div class="register_form">
                        <div class="dropdown form-group position-relative custom-select">
                          
							<?php echo form_dropdown('serviceType',$servicetype,set_value('serviceType',$funeral_detail['serviceTypeId']),'class="form-control" id="serviceTypeId"');?>
							<?php echo form_error('serviceTypeId'); ?>
							
                        </div>
							<div class="form-group">
                            <label>Location and Times</label>                    
                            <p style="font-family:'Georgia-Italic'; color:#96979b;">Create a schedule that all invited Guests<br> will be able to view and follow</p>
                            <?php 
								$j = 1; $n=0;
								for($i=0;$i<=3; $i++){
									
									for($k=$n;$k<=3; $k++){
									if(isset($event[$k]['eventTypeId']) && $event[$k]['eventTypeId'] == $j){
							?>
									<div class="circle_container">
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control" <?php if($j==1){ ?>placeholder="include wake"<?php } elseif($j==2){ ?>placeholder="include ceremony" <?php } elseif($j==3){ ?>placeholder="include burial" <?php } elseif($j==4) {?> placeholder="include reception" <?php } ?>disabled />
                                   
									<a type="submit" class="btn circle_btn click_btn circle_btn_<?php echo $j;?>"><i class="fa fa-circle"></i></a>
                                </div>
                            
                                <div class="circle_box pop_show circle_box_<?php echo $j;?>">
                                     <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" class="form-control" value="<?php if(isset($event[$k]['locationName'])) echo $event[$k]['locationName'];?>"> 
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" class="form-control" id="datetimepicker<?php echo $j;?>" value="<?php if(isset($event[$k]['time'])) echo date("y-m-d h :i a",strtotime($event[$k]['time']));?>">
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                    <input type="text" name="event<?php echo $j;?>[]" id ="searchTextField<?php echo $j;?>" class="form-control" value="<?php if(isset($event[$k]['address'])) echo $event[$k]['address'];?>">
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" class="form-control" value="<?php if(isset($event[$k]['notes'])) echo $event[$k]['notes'];?>">
                                    <?php echo form_error('event'); ?>
									</div>
                                    <div class="form-group">
                                    <input type="hidden" name="event<?php echo $j;?>[]" class="form-control" value="<?php if(isset($event[$k]['latitude'])) echo $event[$k]['latitude'];?>" id="userLatitude<?php echo $j;?>"/>
                                     </div>
									
									<div class="form-group">
                                    <input type="hidden" name="event<?php echo $j;?>[]" class="form-control" value="<?php if(isset($event[$k]['longitude'])) echo $event[$k]['longitude'];?>" id="userLongitude<?php echo $j;?>"/>
                                     </div>
									</div>
                           		 </div>
									
									<?php $j++; $n++; break; }
										else{ ?>
									<div class="circle_container">
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control" <?php if($j==1){ ?>placeholder="include wake"<?php } elseif($j==2){ ?>placeholder="include ceremony" <?php } elseif($j==3){ ?>placeholder="include burial" <?php } elseif($j==4) {?> placeholder="include reception" <?php } ?> disabled />
                                   
									<a type="submit" class="btn circle_btn circle_btn_<?php echo $j;?>"><i class="fa fa-circle"></i></a>
                                </div>
                            
                                <div class="circle_box circle_box_<?php echo $j;?>">
                                     <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" class="form-control" placeholder="enter location name"> 
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" id="datetimepicker<?php echo $j;?>" class="form-control" placeholder="enter time">
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                    <input type="text" name="event<?php echo $j;?>[]" id ="searchTextField<?php echo $j;?>" class="form-control" placeholder="enter address">
                                    <?php echo form_error('event'); ?>
									</div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="event<?php echo $j;?>[]" class="form-control" placeholder="enter notes">
                                    <?php echo form_error('event'); ?>
									</div>
                                    <div class="form-group">
                                    <input type="hidden" name="event<?php echo $j;?>[]" class="form-control" value="" id="userLatitude<?php echo $j;?>"/>
                                     </div>
									
									<div class="form-group">
                                    <input type="hidden" name="event<?php echo $j;?>[]" class="form-control" value="" id="userLongitude<?php echo $j;?>"/>
                                     </div>
									</div>
                            </div>
									<?php $j++; break; }  
									 }  	
									
								}
							?>
	 
							
                        </div>
                        
                        <div class="col-sm-6 pad0">
                            <button type="button" class="btn btn-save back1">Back</button>
                        </div>
                    
                        <div class="col-sm-6 pad0">
                            <button type="button" id="next2" class="btn btn-delete next2">Next</button>
                        </div> 
                    </div>
           	 </div>
            <!-- form 2 -->
            
            <!-- form 3 -->
            <div class="form-3">
                <h2>Coordinate <small>step 3 of 4</small></h2>
                <p>Change your program here.</p>
                	
                    <div class="register_form">
                        <div class="form-group">
                            <label>Deceased’s Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $funeral_detail['name']; ?>">
                        <?php echo form_error('name'); ?>
						</div>
                        
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input class=" form-control" id="DateOfBirth" data-date-format="mm/dd/yyyy" name="dateOfBirth" value="<?php echo $funeral_detail['dateOfBirth'];?>" >
                        <?php echo form_error('dateOfBirth'); ?>
						</div>
                        
                        <div class="form-group">
                            <label>Date of Death</label>
                             <input class=" form-control" id="DateOfDeath" data-date-format="mm/dd/yyyy" name="dateOfDeath" value="<?php echo $funeral_detail['dateOfDeath'];?>" >
                        <?php echo form_error('dateOfDeath'); ?>
						</div>
                        
                        <div class="form-group">
                            <label>Surviving Family Members</label>
                            <div class="family_members_wrap">
								<?php foreach($funeral_detail['other_details']['familyMember'] as $val) {?>
                             <div class="mar_bm_20"><input type="text" id="familymember" name="familyMember[]" class="form-control" value="<?php echo $val;?>"></div>
                                 <?php echo form_error('familyMember'); ?>
							<?php }?>
							</div>
							<button class="btn btn-add add_family_member" type="button"><i class="fa fa-plus"></i></button>
                        </div>
    
                       <div class="form-group mar_tp_65">
                            <label>Pallbearers</label>
                             <div class="pall_list_wrap">
								 <?php foreach($funeral_detail['other_details']['pallbearer'] as $val) {?>
                             <div class="mar_bm_20"><input type="text" id="pallBearers" name="pallBearers[]" class="form-control"  value="<?php echo $val;?>"></div>
                                  <?php echo form_error('pallBearers'); ?>
								 
                            
							<?php } ?>
								 </div>
						   <button class="btn btn-add add_pall_list" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                        
                        <div class="form-group mar_tp_65">
                            <label>Officient</label>
                            <input type="text" class="form-control" id="officient" name="officient[]" <?php if(isset($funeral_detail['other_details']['officient'][0])){ ?> value="<?php echo $funeral_detail['other_details']['officient'][0] ;?>" <?php } else { ?>placeholder="first and last name" <?php } ?> >
                              <?php echo form_error('officient'); ?>
						</div>
                        
                        <div class="form-group mar_tp_65">
                            <label>Person delivering the Eulogy</label>
                            <input type="text" class="form-control" id ="eulogy"  name="eulogy[]"  <?php if(isset($funeral_detail['other_details']['eulogy'][0])){ ?> value="<?php echo $funeral_detail['other_details']['eulogy'][0] ;?>"<?php } else { ?>placeholder="first and last name" <?php } ?>>
                        <?php echo form_error('eulogy'); ?>
						</div>
                        
                        <div class="form-group">
                            <label>Songs</label>
                            <div class="song_list_wrap">
								<?php foreach($funeral_detail['other_details']['song'] as $val) {?>
                             <div class="mar_bm_20"><input type="text" id="song" name="song[]" class="form-control"  value="<?php echo $val;?>"></div>
                                <?php echo form_error('song'); ?>
								<?php } ?>
								</div>
							<button class="btn btn-add add_song_list" type="button"><i class="fa fa-plus"></i></button>
                        </div>
						
						<div class="form-group">
                            <label>Readings</label>
                            <div class="reading_list_wrap">
								<?php foreach($funeral_detail['other_details']['reading'] as $val) {?>
                             <div class="mar_bm_20"><input type="text" id="reading" name="reading[]" class="form-control" value="<?php echo $val;?>"></div>
                                <?php echo form_error('reading'); ?> 
							<?php } ?>
								</div>
							<button class="btn btn-add add_reading_list" type="button"><i class="fa fa-plus"></i></button>
                        </div>
    
                        <div class="col-sm-6 pad0">
                            <button type="button" class="btn btn-save back2">Back</button>
                        </div>
                    
                        <div class="col-sm-6 pad0">
                            <button type="button" id="next3" class="btn btn-delete next3">Next</button>
                        </div> 
                    </div>
           </div>
        	<!-- form 3 -->
            
             <!-- form 4 -->
            <div class="form-4">
                <h2>Coordinate <small>step 4 of 4</small></h2>
                <p>Forget someone? Simply add them here and an email invitation will be sent.</p>
                	<div class="register_form">
                        <div class="form-group">
                            <label>Enter Invite Guests</label>
                            <div class="invite_guest_wrap">
								
                             <div class="mar_bm_20"><input type="text" id="guest" name="guest[]" class="form-control" value=""></div>
                                <?php echo form_error('guest'); ?>  
								
                            </div>
							<button class="btn btn-add add_invite_guest"  type="button"><i class="fa fa-plus"></i></button>
                        </div>
                        
                        <div class="col-sm-6 pad0">
                            <button type="button"  class="btn btn-save back3">Back</button>
                        </div>
                    
                        <div class="col-sm-6 pad0">
                            <button type="submit" onclick=email_check(this); class="btn btn-delete next4">Finish</button>
                        </div>
                   </div> 
        	</div>
        	<!-- form 4 -->
			<?php echo form_close();?>
		</div>	 
    </div>
</div>
<script>

</script>
<script>

function IsEmail(email) {
var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if(!regex.test(email)) {
  return false;
}else{
  return true;
}
}
function email_check(data)
	{    
		var x = $('#guest').val();
        if(x.length >1){
            if(!IsEmail(x)) {
			alert('Invalid email address');
			 $('.next4').prop("disabled", true); 
	       return false;
	        } 
       }
    }
</script>
<script>
$(document).ready(function() {	
	$('#guest').keyup(function()
	{
		 $('.next4').prop("disabled", false);
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
<script>
$(document).ready(function() {
    document.getElementById("next1").onclick= function (e) {
     var x = document.getElementById("uploadFile").value;
		
    if(x=="")
	{
	  alert('please enter the image');
		$('.form-2').hide();
		$('.form-3').hide();
		$('.form-4').hide();
		$('.form-1').show();
		return false;
	}else {
		$('.form-2').show();
		$('.form-1').hide();
		return false;
	}
};
	
	
	
});
</script>
<script>
$(document).ready(function() {
    document.getElementById("next2").onclick=function(e) {
     var x = document.getElementById("serviceTypeId").value;
		
    if(!x)
	{
	  alert('please select the serviceType');
		$('.form-1').hide();
		$('.form-3').hide();
		$('.form-4').hide();
		$('.form-2').show();
		return false;
		
	}else {
		$('.form-3').show();
		$('.form-2').hide();
		return false;
	}
};
	
});
</script>

<script>
$(document).ready(function() {
    document.getElementById("next3").onclick=function(e) {
     var a = document.getElementById("name").value;
     var b = document.getElementById("DateOfBirth").value;
     var c = document.getElementById("DateOfDeath").value;
     var d = document.getElementById("familymember").value;
     var e = document.getElementById("pallBearers").value;
    	
    if(a=="") {
       alert('please enter name');
        $('.form-1').hide();
		$('.form-2').hide();
		$('.form-4').hide();
		$('.form-3').show();
		return false;
    } else {
        if(b=="") {
            alert('please enter DateOfBirth');
            $('.form-1').hide();
		    $('.form-2').hide();
		    $('.form-4').hide();
		    $('.form-3').show();
		return false;
        }else { 
            if(c=="") {
            alert('please enter DateOfDeath');
                $('.form-1').hide();
                $('.form-2').hide();
                $('.form-4').hide();
                $('.form-3').show();
		return false;
        } else { 
            if(d=="") {
            alert('please enter familymember');
                $('.form-1').hide();
                $('.form-2').hide();
                $('.form-4').hide();
                $('.form-3').show();
		return false;
        }else { 
            if(e=="") {
            alert('please enter pallBearers');
                $('.form-1').hide();
                $('.form-2').hide();
                $('.form-4').hide();
                $('.form-3').show();
		return false;
        }else {
            $('.form-4').show();
		    $('.form-3').hide();
		    return false;
        }
        }
        }
    }
		
}
}
});
</script>
<script>
$(document).ready(function(e) {
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
    $('.circle_btn_1').click(function(){
        if ($('.circle_box_1').css("display") == "none")
            {
            $('.register_form .circle_btn_1 i').css('color', '#0F416A');
            $('.register_form .circle_btn_1').css('background','#fff');
            }
            else if ($('.circle_box_1').css("display") == "block")
            {
            $('.register_form .circle_btn_1 i').css('color', '#fff');
            $('.register_form .circle_btn_1').css('background','#9a9a9a');
           }
		$('.circle_box_1').slideToggle();
	});


		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
    $('.circle_btn_2').click(function(){
        if ($('.circle_box_2').css("display") == "none")
            {
            $('.register_form .circle_btn_2 i').css('color', '#0F416A');
            $('.register_form .circle_btn_2').css('background','#fff');
            }
            else if ($('.circle_box_2').css("display") == "block")
            {
            $('.register_form .circle_btn_2 i').css('color', '#fff');
            $('.register_form .circle_btn_2').css('background','#9a9a9a');
           }
		$('.circle_box_2').slideToggle();
	});
	
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
    $('.circle_btn_3').click(function(){
        if ($('.circle_box_3').css("display") == "none")
            {
            $('.register_form .circle_btn_3 i').css('color', '#0F416A');
            $('.register_form .circle_btn_3').css('background','#fff');
            }
            else if ($('.circle_box_3').css("display") == "block")
            {
            $('.register_form .circle_btn_3 i').css('color', '#fff');
            $('.register_form .circle_btn_3').css('background','#9a9a9a');
           }
		$('.circle_box_3').slideToggle();
	});
	
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
    $('.circle_btn_4').click(function(){
        if ($('.circle_box_4').css("display") == "none")
            {
            $('.register_form .circle_btn_4 i').css('color', '#0F416A');
            $('.register_form .circle_btn_4').css('background','#fff');
            }
            else if ($('.circle_box_4').css("display") == "block")
            {
            $('.register_form .circle_btn_4 i').css('color', '#fff');
            $('.register_form .circle_btn_4').css('background','#9a9a9a');
           }
		$('.circle_box_4').slideToggle();
	});
});


//For add pallbears list...//
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".pall_list_wrap"); //Fields wrapper
	var add_button      = $(".add_pall_list"); //Add button ID

	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" id="pallBearers" name="pallBearers[]" class="form-control" placeholder="first and last name"></div>'); //add input box
		}
	});
});	
	
//For add reading list...//
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".reading_list_wrap"); //Fields wrapper
	var add_button      = $(".add_reading_list"); //Add button ID

	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" id="reading" name="reading[]" class="form-control" placeholder="title and refrence"></div>'); //add input box
		}
	});
});	
	
//For add family members...//
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".family_members_wrap"); //Fields wrapper
	var add_button      = $(".add_family_member"); //Add button ID

	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" id="familymember" name="familyMember[]" class="form-control" placeholder="first and last name"></div>'); //add input box
		}
	});
});


//For add songs list...//
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".song_list_wrap"); //Fields wrapper
	var add_button      = $(".add_song_list"); //Add button ID

	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" id="song" name="song[]" class="form-control" placeholder="first and last name"></div>'); //add input box
		}
	});
});


//For add Invite Guest...//
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".invite_guest_wrap"); //Fields wrapper
	var add_button      = $(".add_invite_guest"); //Add button ID

	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" id="guest" name="guest[]" class="form-control" placeholder="first and last name"></div>'); //add input box
		}
	});
});

//$('.datepicker').datepicker({
 //   format: 'mm/dd/yyyy',
//	 startDate: '-2d'
//});
</script>
	
<script>
$(document).ready(function(e) {
		$('.form-2').hide();
		$('.form-3').hide();
		$('.form-4').hide();
	//$('.next1').click(function(){
		//$('.form-2').show();
		//$('.form-1').hide();
		//return false;
	//});

	//$('.next2').click(function(){
	//	$('.form-3').show();
	//	$('.form-2').hide();
//	});

	//$('.next3').click(function(){
	//	$('.form-4').show();
	//	$('.form-3').hide();
//	});


	$('.back1').click(function(){
		$('.form-1').show();
		$('.form-2').hide();
	});

	$('.back2').click(function(){
		$('.form-2').show();
		$('.form-3').hide();
	});

	$('.back3').click(function(){
		$('.form-3').show();
		$('.form-4').hide();
	});
});

</script>

