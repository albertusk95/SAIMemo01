<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SAIMemo &middot; Completing the registration</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/login_register/css/style.css">
		
		<style>
			body {
				background-color: #34495e;
			}
		</style>
		
    </head>

    <body>
		<!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>SAIMemo</strong> Registration Completion GATE</h1>
                            <div class="description">
                            	<p>
									Hello <span><b><?php echo $firstName . ' ' . $lastName; ?></b></span>. Your username is <span><b><?php echo $email;?></b></span></br>
									Please choose a new password to open the GATE.
                            	</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                       	
						<div class="col-sm-3"></div>
						
                        <div class="col-sm-6">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Complete the registration</h3>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-registered"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="<?php echo site_url('user_auth/signup_complete/token/'.$token); ?>" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="password">Password</label>
				                        	<input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Enter a password..." class="password form-control" id="password">
											<font color="red"><?php echo form_error('password'); ?></font> 
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="passconf">Confirm password</label>
				                        	<input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" placeholder="Confirm password..." class="passconf form-control" id="passconf">
											<font color="red"><?php echo form_error('passconf'); ?></font> 
										</div>
				                        <?php echo form_hidden('user_id', $user_id);?>
				                        <button type="submit" class="btn">Complete sign up</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
						
						<div class="col-sm-3"></div>
						
                    </div>
                    
                </div>
            </div>
            
        </div>
		
		<!-- Javascript -->
        <script src="../../assets/login_register/js/jquery-1.11.1.min.js"></script>
        <script src="../../assets/login_register/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/login_register/js/jquery.backstretch.min.js"></script>
	
	</body>

</html>