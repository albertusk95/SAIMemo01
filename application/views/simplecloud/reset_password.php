<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SAIMemo &middot; Reset password</title>

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
                            <h1 align="center"><strong>SAIMemo</strong> Reset password GATE</h1>
                            <div class="description">
                            	<p>
									Please enter your new password.
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
	                        			<h3>Reset password</h3>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-refresh"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="<?php echo site_url('user_auth/reset_password/token/'.$token); ?>" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="reset-password">Password</label>
				                        	<input type="password" name="reset-password" value="<?php echo set_value('reset-password'); ?>" placeholder="Enter a password..." class="reset-password form-control" id="reset-password">
											<font color="red"><?php echo form_error('reset-password'); ?></font> 
										</div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="reset-passconf">Confirm password</label>
				                        	<input type="password" name="reset-passconf" value="<?php echo set_value('reset-passconf'); ?>" placeholder="Confirm password..." class="reset-passconf form-control" id="reset-passconf">
											<font color="red"><?php echo form_error('reset-passconf'); ?></font> 
										</div>
				                        <?php echo form_hidden('user_id', $user_id);?>
				                        <button type="submit" class="btn">Reset password</button>
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
        <script src="<?php echo base_url(); ?>/assets/login_register/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/login_register/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/login_register/js/jquery.backstretch.min.js"></script>
	
	</body>
</html>