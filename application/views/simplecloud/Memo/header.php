<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css">
	<title><?= isset($title)?$title:'SAIMemo' ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?= anchor('memo', '<span class="glyphicon glyphicon-cloud"></span> <b>SAI</b>Memo', array('class'=>'navbar-brand')) ?>
	</div>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?= site_url('user_auth/profile') ?>"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('user_email') ?></a></li>
			<?php if($this->session->userdata('user_role') == 'admin'): ?>
			<li><a href="<?= site_url('admin/users') ?>"><span class="glyphicon glyphicon-cog"></span> Admin Panel</a></li>
			<?php endif ?>
			<li><a href="<?= site_url('user_auth/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
	</div>
</nav>
<div id="alert">
	<?php if(isset($error)&&$error!==''): ?>
	<div class="alert alert-danger alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Error</b></span><span> <?= $error?></span>
	</div>
	<?php endif ?>
	<?php if(isset($_GET['error'])): ?>
	<div class="alert alert-danger alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Error</b></span><span> <?= $this->input->get('error') ?></span>
	</div>
	<?php endif ?>
	
	<?php if($this->input->get('access_state') == 1): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> Login</span>
	</div>
	<?php endif ?>
	
	<?php if($this->input->get('upload_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> File <?= $this->input->get('upload_name') ?> uploaded</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('create_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('create_name') ?> created</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('delete_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('delete_name') ?> deleted</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('modify_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('old_name') ?>'s username changed to <?= $this->input->get('new_name') ?></span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('password_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?>'s password changed</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('promote_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?> promoted as Admin</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('demote_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?> demoted from Admin</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('settings_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> Cloud settings changed</span>
	</div>
	<?php endif ?>

</div>