<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<link href="../../assets/css/imgcss/signup.css" rel="stylesheet" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
    <div class="container">

		<?php 
			$attributes = array('class' => 'form-signin');
			echo form_open('user_auth/login', $attributes);
		?>
	  
        <h2 class="form-signin-heading">Please login</h2>
		
		<div id="alert">
			<?php if($is_register_success == 1): ?>
				<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
					<!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					-->
					<span><b>Successful </b></span><span>registration</span>
				</div>
			<?php endif ?>
		</div>
		
		<label for="inputEmail_login" class="sr-only">Email address</label>
        <input type="email" id="inputEmail_login" name="inputEmail_login" class="form-control" value="<?php echo set_value('inputEmail_login'); ?>" placeholder="Email address">
        <?php echo form_error('inputEmail_login'); ?>
		
		<label for="inputPassword_login" class="sr-only">Password</label>
        <input type="password" id="inputPassword_login" name="inputPassword_login" class="form-control" value="<?php echo set_value('inputPassword_login'); ?>" placeholder="Password">
        <?php echo form_error('inputPassword_login'); ?>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	
  </body>
</html>
