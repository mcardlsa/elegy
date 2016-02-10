<?php
$login = array(
	'name'	=> 'emailId',
	'id'	=> 'login',
	'value' => set_value('emailId'),
	'placeholder'	=> 'Email',
	'class'	=> 'form-control',
	'autofocus' => true,
);
?>

<body class="bg1">
<div id="page-content-wrapper"> 
		<div class="page-content inset main_page">
          <div class="row">
              <div class="col-md-12">
                <div class="main_header">
				<h4 class="pull-left"><?php echo $title;?></h4>
				</div>	
				
				 <div class="clearfix"></div> 
                <div class="main_content_section">
				<?php $this->load->view('elements/flash_message');?>	
              <?php echo form_open('users/forgot_password', array('class'=>'form-horizontal', 'role'=> 'form')); ?>
              <div class="heading-logo-box">
               <div class="clearfix"></div>          
              <h2>Pet Stars ForgetPassword</h2>
              </div>
	            <ul class="form-list"> 
				<li>	
				<span>
	              <label for="inputEmail3" class="col-sm-12 control-label">Email</label></span>
	               <div >
	              	 <?php echo form_input($login); ?>
	        		<?php echo form_error($login['name']); ?>			
					<?php echo isset($errors[$login['name']]) ? '<span class="alert-danger">'.$errors[$login['name']] .'</span>':''; ?>
			
	              	
                </div>
                </li>
					<li>
                    <span>&nbsp;</span>
                	<?php echo form_input(array('type'=>'submit', 'value'=>'Submit', 'class'=>'button1')); ?> &nbsp;&nbsp;
					<?php echo form_input(array ("name" => "Cancel", "type" => "button", "value" => "Cancel", "class" => "button1","onclick"=>"goBack();"));  
				?>
               </li>
               <?php echo form_close(); ?>
             </ul>
			 </div>
            </div>
          </div>
        </div>
      </div>
			
					
<script>
function goBack() {
    window.history.back()
}
</script>
   