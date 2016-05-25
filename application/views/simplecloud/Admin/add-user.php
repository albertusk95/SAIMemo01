<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid content">
	<div class="">
		<div class="file-icon">
			<span class="glyphicon glyphicon-user"></span>
		</div>
	</div>
	<div class="">
		<div class="panel panel-default">
		  <div class="panel-body">
				<?php echo form_open(site_url('admin/user/add')); ?>
				<div class="form-group">
					<label for="firstname">Firstname</label>
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name..." required />
				</div>
				<div class="form-group">
					<label for="lastname">Lastname</label>
					<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name..." required />
				</div>
				<div class="form-group">
					<label for="username">Email</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Email..." required />
				</div>
				<div id="password-group" class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password..." required />
					<small><i>Password length min. 6 characters</i></small>
				</div>
				<div id="re-password-group" class="form-group">
					<label for="re-password">Retype Password</label>
					<input type="password" class="form-control" id="re-password" rel="tooltip-manual-left" title="Password Mismatch" name="re-password" placeholder="Password" required />
				</div>
				<button type="submit" id="add-user-btn" class="btn btn-success btn-bg">Add User</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function (){
	$("form").submit(function (e){
		if($('#password').val()!=$('#re-password').val() || $('#password').val().length < 6){
			e.preventDefault();
			$('#re-password').tooltip({ placement: 'left', trigger: 'manual'}).tooltip('show');
		}
	});
	$('#re-password').keyup(function () {
		if($('#password').val()==$('#re-password').val()){
			$('#re-password-group').removeClass('has-error').addClass('has-success');
		} else {
			$('#re-password-group').removeClass('has-success').addClass('has-error');
		}
	});
	$('#password').keyup(function () {
		if($('#password').val().length >= 6){
			$('#password-group').removeClass('has-error').addClass('has-success');
		} else {
			$('#password-group').removeClass('has-success').addClass('has-error');
		}
	});
});
</script>