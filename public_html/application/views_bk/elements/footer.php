<?php if($this->router->fetch_class() =="funeral"  && $this->router->fetch_method() =="create_feed" || $this->router->fetch_method() =="program"  || $this->router->fetch_method() =="schedule"|| $this->router->fetch_method() =="add_journal" || $this->router->fetch_method() =="update_journal" || $this->router->fetch_method() =="memorial" ||$this->router->fetch_method() =="gallery") :?>
   </div> 
       <?php endif; ?>
<footer>
	<div class="width">
    	<div class="footer_big">
        	<div class="col-sm-4">
            <h3>Elegy</h3>
            <p>If you register an account, you can<br> start planning for free!</p>
            
            <div class="col-sm-12 pad0 mar_tp_25">
                <h3>Contact Us</h3>
                <ul class="foot_link1">
                    <li><a>sam@elegyapp.com</a></li>
                    <li><a>facebook</a></li>
                    <li><a>twitter</a></li>
                </ul>
            </div>
        </div>
    
    		<div class="col-sm-4">
        	<div class="foot_txt">
            	<h3>Explore</h3>
                <ul class="foot_link">
                    <li><a>Get Started</a></li>
                    <li><a href="<?php echo site_url('app/features');?>" >Features</a></li>
                    <li><a>Demo</a></li>
                    <li><a>Resources  &amp; Guides</a></li>
                    <li><a>Planning a Funreal</a></li>
                </ul>
            </div> 
        </div>
    
            <div class="col-sm-4">
                <h3>Help</h3>
                <ul class="foot_link">
                    <li><a <?php echo site_url('app/help');?>>Support and FAQ</a></li>
                </ul>
                
                <div class="col-sm-12 pad0 mar_tp_25">
                    <h3>Connect</h3>
                    <p class="mar_tp_15">Sign up for our Newsletter</p>
                    
                    <form class="form-inline footer_form">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="enter email">
                      </div>
                      <button type="submit" class="btn">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="small_footer">
    		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-default footer_box">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Elegy
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                            <p>If you register an account, you can<br> start planning for free!</p>
                      </div>
                    </div>
                 </div>
          
                 <div class="panel panel-default footer_box">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           Explore
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                           <ul class="foot_link">
                                <li><a>Get Started</a></li>
                                <li><a href="<?php echo site_url('app/features');?>">Features</a></li>
                                <li><a>Demo</a></li>
                                <li><a>Resources  &amp; Guides</a></li>
                                <li><a>Planning a Funreal</a></li>
                            </ul>  
                      </div>
                    </div>
                </div>
          
                 <div class="panel panel-default footer_box">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Help
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                        <ul class="foot_link">
                            <li><a <?php echo site_url('app/help');?>>Support and FAQ</a></li>
                        </ul>
                      </div>
                    </div>
                </div>
                
                 <div class="panel panel-default footer_box">
                    <div class="panel-heading" role="tab" id="headingFour">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Contact Us
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                      <div class="panel-body">
                        <ul class="foot_link1">
                            <li><a>sam@elegyapp.com</a></li>
                            <li><a>facebook</a></li>
                            <li><a>twitter</a></li>
                        </ul>
                      </div>
                    </div>
                </div>
                
                 <div class="panel panel-default footer_box">
                    <div class="panel-heading" role="tab" id="headingFive">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Connect
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                      <div class="panel-body">
                         <p class="mar_tp_15">Sign up for our Newsletter</p>
                    
                        <form class="form-inline footer_form">
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="enter email">
                          </div>
                          <button type="submit" class="btn">Subscribe</button>
                        </form>
                      </div>
                    </div>
                </div>
			</div>
    	</div>
    </div>
    
    <div class="footer_strip">
       <div class="width">
       		<div class="col-sm-6">
            	<p>© Elegy, Inc 2015</p>
            </div>
            
            <div class="col-sm-6">
            	<ul class="foot_stirp_link">
                	<li><a>Privacy</a></li>
                    <li><a>Trems</a></li>
                </ul>
            </div>
       </div> 	
    </div>
</footer>

<script src="<?php echo base_url('assets/js/jquery.datetimepicker.full.min.js');?>"></script>
</body>
</html>
