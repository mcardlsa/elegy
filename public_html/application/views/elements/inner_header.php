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
                 <div class="navbar-brand">Funeral of &nbsp;<a href="<?php echo site_url('funeral/memorial/'.$funeral_detail['funeralId']);?>"><strong><?php echo $funeral_detail['name']; ?> </strong></a></div>
                </div>
            <?php if($this->user_auth->is_logged_in()) :
             $view_data=$this->session->userdata('userInfo');
             $hostId=$view_data->hostId; 
             $userId=$view_data->userId;
		    endif;			 
              ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                  <ul class="nav navbar-nav">
					  <li>Funeral of <strong><a style="color:#555555;" href="<?php echo site_url('funeral/memorial/'.$funeral_detail['funeralId']);?>"><?php echo $funeral_detail['name']; ?></a></strong></li>
					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="create_feed") echo "class='active'";?>><a href="<?php echo site_url('funeral/create_feed/'.$funeral_detail['funeralId']);?>" >Remember</a></li>
					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="schedule") echo "class='active'";?>><a href="<?php echo site_url('funeral/schedule');?>" >Schedule</a></li>
 					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="gallery") echo "class='active'";?>><a href="<?php echo site_url('funeral/gallery');?>" >Gallery</a></li>
 					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="program") echo "class='active'";?>><a href="<?php echo site_url('funeral/program');?>" >Program</a></li>
 					<?php if ($this->user_auth->is_logged_in()) : ?>
					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="add_journal" ||$this->router->fetch_method() =="update_journal") echo "class='active'";?>><a href="<?php echo site_url('funeral/add_journal');?>" >Journal</a></li>
					<?php if ($this->user_auth->is_logged_in() && $userId==$hostId): ?>
					<li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="update_funeral") echo "class='active'";?>><a href="<?php echo site_url('funeral/update_funeral/'.$funeral_detail['funeralId']);?>" >Configure</a></li>
                    <?php endif;  endif;?>
					  
					
                  </ul>
                </div>
              </div>
            </nav>
    	</div>
    </div>