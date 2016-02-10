
$(document).ready(function(e) {
    document.getElementById("uploadBtn").onchange = function (){
    document.getElementById("uploadFile").value = this.value;
	};
});


//event ciecle button//

$(document).ready(function(e) {
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
	$('.circle_btn_1').click(function(){
		$('.circle_box_1').slideToggle();
		$('.register_form .circle_btn_1 i').css('color', '#0F416A');
		$('.register_form .circle_btn_1').css('background','#fff');
	});
	
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
	$('.circle_btn_2').click(function(){
		$('.circle_box_2').slideToggle();
		$('.register_form .circle_btn_2 i').css('color', '#0F416A');
		$('.register_form .circle_btn_2').css('background','#fff');
	});
	
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
	$('.circle_btn_3').click(function(){
		$('.circle_box_3').slideToggle();
		$('.register_form .circle_btn_3 i').css('color', '#0F416A');
		$('.register_form .circle_btn_3').css('background','#fff');
	});
	
		$('.circle_box_1').hide();
		$('.circle_box_2').hide();
		$('.circle_box_3').hide();
		$('.circle_box_4').hide();
	$('.circle_btn_4').click(function(){
		$('.circle_box_4').slideToggle();
		$('.register_form .circle_btn_4 i').css('color', '#0F416A');
		$('.register_form .circle_btn_4').css('background','#fff');
	});
});


//event ciecle button//

//add button//

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
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" name="familymember[]" class="form-control" placeholder="first and last name"><a href="#" class="remove_family_member btn"><i class="fa fa-minus"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_family_member", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
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
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" name="pall_list[]" class="form-control" placeholder="first and last name"><a href="#" class="remove_pall_list btn"><i class="fa fa-minus"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_pall_list", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
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
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" name="song_list[]" class="form-control" placeholder="first and last name"><a href="#" class="remove_song_list btn"><i class="fa fa-minus"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_song_list", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
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
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" name="reading_list[]" class="form-control" placeholder="title and refrence"><a href="#" class="remove_reading_list btn"><i class="fa fa-minus"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_reading_list", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
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
			$(wrapper).append(' <div class="mar_bm_20"><input type="text" name="invite_guest[]" class="form-control" placeholder="first and last name"><a href="#" class="remove_invite_guest btn"><i class="fa fa-minus"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_invite_guest", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	});
});

//add button//

//date picker//

$(document).ready(function(e) {
   $('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	}); 
});

//date picker//

//coordinate form//

$(document).ready(function(e) {
		$('.form-2').hide();
		$('.form-3').hide();
		$('.form-4').hide();
	$('.next1').click(function(){
		$('.form-2').show();
		$('.form-1').hide();
		return false;
	});
		
	$('.next2').click(function(){
		$('.form-3').show();
		$('.form-2').hide();
	});
	
	$('.next3').click(function(){
		$('.form-4').show();
		$('.form-3').hide();
	});
	
	
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

//coordinate form//

//gallery//
$(document).ready(function(e) {
	$('.save_btn').hide();
		$('#uploadBtn').click(function(){
			$('#uploadFile').show();
			$('.save_btn').show();
		});
});
//gallery//