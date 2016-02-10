<div class="row">
	<div class="inner_nav_back">
    	<div class="width">
    		<nav class="navbar navbar-default inner_navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Funeral of <strong>Gina Jones</strong></a>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                  <ul class="nav navbar-nav">
                    <li>Funeral of <strong>Gina Jones</strong></li>
                    <li class="active"><a href="#">Remember</a></li>
                    <li><a href="#">Schedule</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Program</a></li>
                    <li><a href="#">Journal</a></li>
                    <li><a href="#">Confiure</a></li>
                  </ul>
                </div>
              </div>
            </nav>
    	</div>
    </div>

	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong>Password Reset</strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            
            <div class="clearfix"></div>            
            
            <?php echo form_open('user/forgot_password', array('class'=>'register_form', 'role'=> 'form')); ?>
                <div class="form-group">
					<?php $this->load->view('elements/flash_message');?>
                    <label>Email</label>
                	<input type="email" name="emailId" class="form-control" placeholder="email@emailaddress.com">
                    <?php echo form_error('emailId'); ?>
				</div>
                
                <button type="submit" class="btn forget_btn">Request Password Reset</button>
                
                <a class="cencle_btn" onclick = "goBack();">Cencle</a>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
function goBack() {
    window.history.back()
}
</script>