<div class="row">
	
	<div class="width">
    	<div class="inner_mid mar_tp_230">
        	<h3><strong>Contact Elegy</strong></h3>
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.Dolor sit amet, consectetur adipiscing elit. Cras lectus est, laoreet a convallis ut, semper et magna. Vivamus ligula lacus, dapibus vitae nibh quis, placerat pulvinar felis.</p>
            <?php $this->load->view('elements/flash_message');?>
            <div class="col-sm-12 pad0 mar_tp_65">
            	<div class="col-sm-6 pad-left0">
					 <?php echo form_open('app/contact_us', array('class'=>'contact_form', 'role'=> 'form')); ?>
                		<div class="form-group">
                        <label>Name</label>
							<?php echo form_input(array('name'=> 'name', 'class' => 'form-control','value'=> set_value('name')));?>
                      <!--<input type="text" name ="name" class="form-control" > -->
						<?php echo form_error('name'); ?>	
                      </div>
                      
                      <div class="form-group">
                        <label>Email</label>
						  <?php echo form_input(array('name'=> 'email','type' =>'email','class' => 'form-control','value'=> set_value('email')));?>
                       <!-- <input type="email" name="email" class="form-control"> -->
						 <?php echo form_error('email'); ?> 
                      </div>
                      
                       <div class="form-group">
                        <label>Topic</label>
						   <?php echo form_input(array( 'name'=> 'topic', 'class' => 'form-control','value'=> set_value('topic')));?>
                       <!-- <input type="text" name="topic" class="form-control"> -->
                       <?php echo form_error('topic'); ?>   
					</div>
                       
                        <div class="form-group">
                         <label>Message</label>
							<?php echo form_textarea(array('name'=> 'message', 'class' => 'form-control','cols' => 20,'rows' => 7,'value'=>set_value('message'))); ?>
                       <!--  <textarea class="form-control" rows="7" name="message"></textarea> -->
                      <?php echo form_error('message'); ?> 
					  </div>
                      <button type="submit" class="btn btn-default">Send</button>
                   <?php echo form_close(); ?>
                </div>
                
                <div class="col-sm-6 pad-right0 links">
                	<ul class="right_link">
                    	<li>Directly</li>
                        <li><a href="http://www.sam@elegyapp.com">sam@elegyapp.com</a></li>
                        <li><a href="https://www.facebook.com/elegyapp">https://www.facebook.com/elegyapp</a></li>
                        <li><a href="https://twitter.com/elegyapp">https://twitter.com/elegyapp</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
