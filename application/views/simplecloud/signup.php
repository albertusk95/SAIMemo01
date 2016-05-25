<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SAIMemo - Login &middot; Register</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css">
    </head>

	<div id="alert">
		<?php if ($this->input->get('reset_success') == 1): ?>
		<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span><b>Success</b></span><span> reset password</span>
		</div>
		<?php endif ?>
		
		<?php if ($this->input->get('reset_success') == -1): ?>
		<div class="alert alert-danger alert-fixed-top alert-dismissable" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span><b>Error</b></span><span> reset password</span>
		</div>
		<?php endif ?>
	</div>
	
    <body background="<?php echo base_url(); ?>/assets/login_register/img/backgrounds/undersea02.jpg">
		
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>SAIMemo</strong> Login &middot; Register GATE</h1>
                            <div class="description">
                            	<p>
	                            	Welcome to SAIMemo GATE! Please open the gate by logging in to reminisce with your wonderful memories.</br> 
									Doesn't have an account? Just register a new one.
                            	</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to SAIMemo</h3>
	                            		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="<?php echo site_url('user_auth/login'); ?>" method="post" class="login-form">
									
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-email-login">Email</label>
				                        	<input type="text" name="form-email-login" value="<?php echo set_value('form-email-login'); ?>" placeholder="Email..." class="form-email-login form-control" id="form-email-login">
											<font color="red"><?php echo form_error('form-email-login'); ?></font> 
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="form-password" value="<?php echo set_value('form-password'); ?>" placeholder="Password..." class="form-password form-control" id="form-password">
											<font color="red"><?php echo form_error('form-password'); ?></font> 
										</div>
									
				                        <button type="submit" class="btn">Sign in!</button>
	
									</form>
									
									</br>
									
									<p align="center">
										<a href="<?php echo site_url('user_auth/forgot_pass');?>"><font color="white">Forgot password?</font></a>
									</p>
									
			                    </div>
								
		                    </div>
		              
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Join SAIMemo now!</h3>
	                            		<p>Enter your account information:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="<?php echo site_url('user_auth/signup'); ?>" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First name</label>
				                        	<input type="text" name="form-first-name" value="<?php echo set_value('form-first-name'); ?>" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
											<font color="red"><?php echo form_error('form-first-name'); ?></font> 
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Last name</label>
				                        	<input type="text" name="form-last-name" value="<?php echo set_value('form-last-name'); ?>" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
											<font color="red"><?php echo form_error('form-last-name'); ?></font> 
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="form-email" value="<?php echo set_value('form-email'); ?>" placeholder="Email..." class="form-email form-control" id="form-email">
											<font color="red"><?php echo form_error('form-email'); ?></font> 
										</div>
										
				                        <button type="submit" class="btn">Sign me up!</button>
				                    </form>
									
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

		<!-- Javascript -->
        <script src="../../assets/login_register/js/jquery-1.11.1.min.js"></script>
        <script src="../../assets/login_register/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/login_register/js/jquery.backstretch.min.js"></script>
		<!--
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
		<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
		-->
    </body>

</html>