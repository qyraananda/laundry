<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Laundry</title>
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href='<?php echo base_url("assets/images/big.png"); ?>' rel='shortcut icon' type='image/x-icon'/>
  
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link href="<?php echo base_url();?>assets/login/util.css" rel="stylesheet" type="text/css"> 
	<link href="<?php echo base_url();?>assets/login/main.css" rel="stylesheet" type="text/css"> 	
</head>
<body>

<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/login/bg-02.jpg');">
			<div class="wrap-login100">
				<div id="infoMessage"><?php echo $message;?></div>
                    <?php
                        echo form_open('login/check');                       
                    ?>  
					<span class="login100-form-title p-b-34 p-t-27">
						Laundry
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" name="pass" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="identity" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div> -->
					<div class="text-center">
						<a class="txt1" href="#">
							&copy; 2018 by 					
						</a>
						<a class="txt1" href="arywinar@yahoo.com">ary winar</a>
						<ul id="coordinates" style="visibility: hidden;">
							<li id="latitude"></li>
							<li id="longitude"></li>
						</ul>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
