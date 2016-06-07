<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SAIMemo - Project SAI</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom Google Web Font -->
    <link href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
	
    <!-- Custom CSS-->
    <link href="<?php echo base_url(); ?>/assets/css/general.css" rel="stylesheet">
	
	 <!-- Owl-Carousel -->
    <link href="<?php echo base_url(); ?>/assets/css/custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/owl.theme.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/animate.css" rel="stylesheet">
	
	<!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/magnific-popup.css"> 
	
	<script src="<?php echo base_url(); ?>/assets/js/modernizr-2.8.3.min.js"></script>  <!-- Modernizr /-->
		
</head>

<body id="home">

	<!-- Body background (start point) diatur oleh general.css bagian .intro-header -->
	
	<!-- FullScreen -->
    <div class="intro-header">
		
		<div id="twopic">
			<img class="bottom" src="<?php echo base_url(); ?>/assets/img/intro/startpoint.jpg" />
			<img class="top" src="<?php echo base_url(); ?>/assets/img/intro/startpoint3.jpg" />
		</div>
	
		<div class="col-xs-12 text-center abcen1">
			<h1 class="h1_home wow fadeIn" data-wow-delay="0.4s">SAIMemo</h1>
			<h3 class="h3_home wow fadeIn" data-wow-delay="0.6s">Simple and Easy</h3>
			<ul class="list-inline intro-social-buttons">
				<li>
					<a href="<?php echo site_url('user_auth/signup'); ?>" class="btn  btn-lg mybutton_cyano wow fadeIn" data-wow-delay="0.8s"><span class="network-name">Explore</span></a>
				</li>
			</ul>
		</div>    
        <!-- /.container -->
		<div class="col-xs-12 text-center abcen wow fadeIn">
			<div class="button_down "> 
				<a class="imgcircle wow bounceInUp" data-wow-duration="1.5s"  href="#whatis"> <img class="img_scroll" src="<?php echo base_url(); ?>/assets/img/icon/circle.png" alt=""> </a>
			</div>
		</div>
		
    </div>
	
	<!-- NavBar-->
	<nav class="navbar-default" role="navigation">
		<div class="container">
			
			<div class="navbar-header">
				<a class="navbar-brand" href="#home">SAIMemo</a>
			</div>

			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">	
					<li class="menuItem"><a href="#whatis">What is it?</a></li>
					<li class="menuItem"><a href="#useit">How to use?</a></li>
					<li class="menuItem"><a href="#contact">Contact</a></li>
				</ul>
			</div>
		   
		</div>
	</nav> 
	
	<!-- Section: What is it? -->
	<div id="whatis" class="content-section-b" style="border-top: 0">
		<div class="container">

			<div class="col-md-6 col-md-offset-3 text-center wrap_title">
				<h2>What is it?</h2>
				<p class="lead" style="margin-top:0">A tiny room for saving your memories</p>
				
			</div>
			
			<div class="row">
			
				<div class="col-sm-4 wow fadeInDown text-center">
				  <img class="rotate" src="<?php echo base_url(); ?>/assets/img/icon/file.svg" alt="Store your folders and files">
				  <h3>Folders & Files</h3>
				  <p class="lead">Store your folders and files which can be accessed in any time</p>
				</div>
				
				<div class="col-sm-4 wow fadeInDown text-center">
				  <img  class="rotate" src="<?php echo base_url(); ?>/assets/img/icon/gallery.svg" alt="Store your images">
				   <h3>Images</h3>
				   <p class="lead">Take wondeful images and keep them in a safe place</p>
				</div>
				<div class="col-sm-4 wow fadeInDown text-center">
				  <img  class="rotate" src="<?php echo base_url(); ?>/assets/img/icon/video.svg" alt="Store your videos">
				   <h3>Videos</h3>
					<p class="lead">Keep your action as a memorable gift</p>
				</div>
				
			</div><!-- row -->
				
		</div><!-- container -->
	</div>
	
	<!-- Section: How to use? -->
    <div id ="useit" class="content-section-a">

        <div class="container">
			
            <div class="row">
			
				<a href="<?php echo base_url(); ?>/assets/img/howto_signin.png">
				<div class="col-sm-6 pull-right wow fadeInRightBig">
                    <img class="img-responsive " src="<?php echo base_url(); ?>/assets/img/howto_signin.png" alt="Zoomed login page">
                </div>
				</a>
				
                <div class="col-sm-6 wow fadeInLeftBig"  data-animation-delay="200">   
                    <h3 class="section-heading">Access your memo</h3>
                    <div class="sub-title lead3">Click the image to see on fullscreen</div>
					<p class="lead">
						Get into your memo  by logging in with your email and password. 
					</p>
				</div>   
            </div>
        </div>
        <!-- /.container -->
    </div>

    <div class="content-section-b"> 
		<div class="container">
            <div class="row">
                <div class="col-sm-6 wow fadeInLeftBig">
					 <div id="owl-demo-1" class="owl-carousel">
						<a href="<?php echo base_url(); ?>/assets/img/howto_newfolder.png">
							<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_newfolder.png" alt="Zoomed how to create new folder">
						</a>
						<a href="<?php echo base_url(); ?>/assets/img/howto_confirmnf.png">
							<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_confirmnf.png" alt="Zoomed confirming folder creation">
						</a>
						<a href="<?php echo base_url(); ?>/assets/img/howto_myfolder.png">
							<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_myfolder.png" alt="Zoomed created folder in action">
						</a>
					</div>       
                </div>
				
                <div class="col-sm-6 wow fadeInRightBig"  data-animation-delay="200">   
                    <h3 class="section-heading">Create a new folder</h3>
					<div class="sub-title lead3">Click the image to see on fullscreen</div>
                    <p class="lead">
						You can create a folder by clicking button <b>+</b> at the 
						upper right corner.
						Give a name for the created folder and press <b>Enter</b> or click 
						button <b>v</b> for confirming,
						OR you can cancel the creation process by simply clicking the <b>x</b>
						button.
					</p>
				</div>  			
			</div>
        </div>
    </div>
	
    <div class="content-section-a"> 
		<div class="container">
            <div class="row">
				<div class="col-sm-6 pull-left wow fadeInLeftBig"  data-animation-delay="200">   
                    <h3 class="section-heading">Upload new files</h3>
					<div class="sub-title lead3">Click the image to see on fullscreen</div>
                    <p class="lead">
						Store your files by simply clicking the green button 
						next to new folder creation button.
					</p>
				</div>  		
			
				<a href="<?php echo base_url(); ?>/assets/img/howto_uploadbtn.png">
				<div class="col-sm-6 pull-right wow fadeInRightBig"  data-animation-delay="200">   
					<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_uploadbtn.png" alt="Zoomed how to upload new files">
				</div>
				</a>
			</div>
        </div>
    </div>
	
	<div class="content-section-b"> 
		<div class="container">
            <div class="row">
				<a href="<?php echo base_url(); ?>/assets/img/howto_download.png">
					<div class="col-sm-6 pull-left wow fadeInLeftBig"  data-animation-delay="200">   
						<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_download.png" alt="Zoomed how to download a file">
					</div>
				</a>
				
				<div class="col-sm-6 pull-right wow fadeInRightBig"  data-animation-delay="200">   
                    <h3 class="section-heading">Download stored files</h3>
					<div class="sub-title lead3">Click the image to see on fullscreen</div>
                    <p class="lead">
						You can also download your stored files on memo by clicking 
						download listener which is located next to the file's name.
					</p>
				</div>  		
			</div>
        </div>
    </div>
	
	<div class="content-section-a"> 
		<div class="container">
            <div class="row">
				<div class="col-sm-6 pull-left wow fadeInLeftBig"  data-animation-delay="200">   
                    <h3 class="section-heading">Delete stored files</h3>
					<div class="sub-title lead3">Click the image to see on fullscreen</div>
                    <p class="lead">
						You can delete your stored files on memo by clicking 
						delete listener which is located next to the Download's listener.
					</p>
				</div>  	
				
				<a href="<?php echo base_url(); ?>/assets/img/howto_delete.png">
					<div class="col-sm-6 pull-right wow fadeInRightBig"  data-animation-delay="200">   
						<img class="img-responsive img-rounded" src="<?php echo base_url(); ?>/assets/img/howto_delete.png" alt="Zoomed how to delete a file">
					</div>	
				</a>
			</div>
        </div>
    </div>
	
	<div class="content-section-c ">
		<div class="container">
			<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center white">
				<h2>Join us now!</h2>
				<p class="lead" style="margin-top:0">Get your own experience with SAIMemo</p>
			 </div>
			<div class="col-md-6 col-md-offset-3 text-center">
				
				<form role="form" action="<?php echo site_url('Sc/signup_schome'); ?>" method="post" class="registration-form">
					<p>
					<button type="submit" class="btn btn-lg mybutton_cyano wow fadeIn">Sign me up!</button>
					</p>
				</form>
				
			</div>	
			</div>
		</div>
	</div>	
	
	<!-- Feel free to contact me -->
	<div id="contact" class="content-section-a">
		<div class="container">
			<div class="row">
			
			<div class="col-md-6 col-md-offset-3 text-center wrap_title">
				<h2>Contact</h2>
			</div>
		
			<hr class="featurette-divider hidden-lg">
				<div class="col-md-6 col-md-offset-3 text-center wrap_title">
					<address>
						<h3>Albertus Kelvin</h3>
						<p class="lead">
							Institut Teknologi Bandung</br>
							Bandung, Indonesia
						</p>
					</address>
					
					<p>
						<li class="social"> 
						<a href="https://www.facebook.com/albertus.kelvin"><i class="fa fa-facebook-square fa-size"> </i></a>
						<a href="https://github.com/albertusk95"><i class="fa fa-github fa-size"> </i> </a>
						</li>
					</p>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<h4 align="center">Copyright &copy; 2016</h4>
	</footer>
	
    <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/owl.carousel.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/script.js"></script>
	<!-- StikyMenu -->
	<script src="<?php echo base_url(); ?>/assets/js/stickUp.min.js"></script>
	<script type="text/javascript">
	  jQuery(function($) {
		$(document).ready( function() {
		  $('.navbar-default').stickUp();
		  
		});
	  });
	
	</script>
	<!-- Smoothscroll -->
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.corner.js"></script> 
	<script src="<?php echo base_url(); ?>/assets/js/wow.min.js"></script>
	<script>
	 new WOW().init();
	</script>
	<script src="<?php echo base_url(); ?>/assets/js/classie.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/uiMorphingButton_inflow.js"></script>
	<!-- Magnific Popup core JS file -->
	<script src="<?php echo base_url(); ?>/assets/js/jquery.magnific-popup.js"></script> 
</body>

</html>
