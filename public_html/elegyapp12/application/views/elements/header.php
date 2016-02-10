<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<title><?php echo $title; ?></title>

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous" type='text/css'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.4.5/jquery.datetimepicker.css">  
    
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<!-- CSS -->

<!-- JS -->


    
    
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<!-- JS -->
</head>
<body>
<header>
    <div class="width">
        <nav class="navbar navbar-default top_link_nav">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top_link_nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo site_url('user');?>"><img src="<?php echo base_url('assets/images/logo.png');?>" width="100%"></a>
            </div>
        
            <div class="collapse navbar-collapse" id="top_link_nav">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('funeral/find_funeral');?>">Find a funeral</a></li>
                <?php if ($this->user_auth->is_logged_in()) : ?>
                <li>|</li>
                <li><a href="<?php echo site_url('user/change_password');?>">Account</a></li>
                <li>|</li>
                <li><a href="<?php echo site_url('user/logout');?>">Sign Out</a></li>
                  
                <?php else :?> 
                <li>|</li>
                <li><a href="<?php echo site_url('user/register');?>">Register</a></li>
                <li>|</li>
                <li><a href="<?php echo site_url('user/login');?>">Sign In</a></li>
                <?php endif; ?>
                <li>    
                	<div>
                    	<ul>
                            <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="about_us") echo "class='active'";?>><a href="<?php echo site_url('app/about_us');?>" >About</a></li>
                            <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="features") echo "class='active'";?>><a href="<?php echo site_url('app/features');?>" >Features</a></li>
                            <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="help") echo "class='active'";?>><a href="<?php echo site_url('app/help');?>" >Help</a></li>
                            <li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="cretae_funeral") echo "class='active'";?>><a href="<?php echo site_url('funeral/cretae_funeral');?>" >Get Started</a></li>
                            <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="contact_us") echo "class='active'";?>><a href="<?php echo site_url('app/contact_us');?>" >Contact</a></li>  

                         </ul>
                    </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    </div>
    
    <div class="nav_header">
    	<div class="width">
        	<nav class="navbar navbar-default custom_navigation">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
            
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="about_us") echo "class='active'";?>><a href="<?php echo site_url('app/about_us');?>" >About</a></li>
		            <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="features") echo "class='active'";?>><a href="<?php echo site_url('app/features');?>" >Features</a></li>
                    <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="help") echo "class='active'";?>><a href="<?php echo site_url('app/help');?>" >Help</a></li>
                    <li <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="create_funeral") echo "class='active'";?>><a href="<?php echo site_url('funeral/create_funeral');?>" >Get Started</a></li>
                    <li <?php if($this->router->fetch_class() =="app" && $this->router->fetch_method() =="contact_us") echo "class='active'";?>><a href="<?php echo site_url('app/contact_us');?>" >Contact</a></li>  
       
               
                  </ul>
                </div>
              </div>
            </nav>
        </div>
    </div>
</header>
 <?php if($this->router->fetch_class() =="funeral" && $this->router->fetch_method() =="create_feed" || $this->router->fetch_method() =="program" || $this->router->fetch_method() =="schedule" || $this->router->fetch_method() =="add_journal" || $this->router->fetch_method() =="update_journal" || $this->router->fetch_method() =="memorial" ||$this->router->fetch_method() =="gallery") :?>
   <div class="row"> 
       <?php endif; ?>