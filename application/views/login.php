<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Pro | Log in</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('/asset/css/style.css'); ?>">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">
	<script src="<?php echo base_url('/asset/js/jquery.slim.min.js'); ?>" crossorigin="anonymous"></script>
	<script src="<?php echo base_url('/asset/js/jquery-3.7.0.js'); ?>" crossorigin="anonymous"></script>
	<script src="<?php echo base_url('/asset/js/jquery.validate.min.js'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="<?php echo base_url('/asset/js/additional-methods.min.js'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="<?php echo base_url('/asset/toastr/css/toastr.min.css'); ?>">
	<script src="<?php echo base_url('/asset/toastr/js/toastr.min.js'); ?>"></script>

</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<b>Event</b>Pro
		</div>
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<form id="login_form" method="post">

					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Email" required="required">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password" required="required">
					</div>

					<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
				</form>

			</div>
		</div>
	</div>
	<!-- /.login-box -->


	<script>
		const base_url = '<?php echo base_url() ?>';
		window.showLoader = function() {
			$('#loader-container').show();
		};

		// Define the hideLoader function
		window.hideLoader = function() {
			$('#loader-container').hide();
		};
		$(document).ready(function() {
			// Hide the loader initially
			$('#loader-container').show();

			// Example: Simulate a delay and hide the loader after 3 seconds
			setTimeout(hideLoader, 1000);

			// You can call showLoader and hideLoader functions as needed in your application
		});

		$(document).ready(function() {

			//login form validation  
			$('#login_form').validate({
				rules: {
					email: {
						required: true,
					},
					password: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					email: "Please enter a valid email",
					password: "Please enter your password"
				},
				submitHandler: function(form) {
					// showLoader();
					var formData = new FormData(form);
					$.ajax({
						url: base_url + "login",
						type: "POST",
						data: formData,
						dataType: "json",
						success: function(data) {
							if (data.status == 1) {
								toastr.success(data.message);
								setTimeout(function() {
									window.location.href = base_url + 'dashboard';
								}, 1000);
							} else {
								toastr.error(data.message);
							}
							// hideLoader();
						},
						cache: false,
						contentType: false,
						processData: false
					});
				}
			});

		});
	</script>
</body>

</html>