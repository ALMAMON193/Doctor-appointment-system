<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'HMS');

$unsuccessfulmsg = '';

if (isset($_POST['submit'])) {
	$users_email 			= $_POST['users_email'];
	$users_password 		= $_POST['users_password'];
	$passwordmd5 	= md5($users_password);

	if (empty($users_email)) {
		$emailmsg = 'Enter an email.';
	} else {
		$emailmsg = '';
	}

	if (empty($users_password)) {
		$passmsg = 'Enter your password.';
	} else {
		$passmsg = '';
	}

	if (!empty($users_email) && !empty($users_password)) {
		$sql = "SELECT * FROM admins WHERE users_email='$users_email' AND users_password = '$passwordmd5'";
		$query = $conn->query($sql);

		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			$users_first_name = $row['users_first_name'];
			$users_last_name = $row['users_last_name'];

			$_SESSION['users_last_name'] = $users_last_name;
			$_SESSION['users_first_name'] = $users_first_name;
			header('location:http://localhost/HMS/admin/index');
		} else {
			$unsuccessfulmsg = 'Wrong email or Password!';
		}
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:46 GMT -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Doccure - Login</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="assets/img/logo-white.png" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<p class="account-subtitle">Access to our dashboard</p>

							<!-- Form -->
							<form action="http://localhost/HMS/admin/login" method="POST">
								<div class="mt-2 pb-2">
									<label for="email">Email:</label>
									<input type="email" name="users_email" class="form-control" placeholder="Enter your email" value="<?php if (isset($_POST['submit'])) {
																																			echo $users_email;
																																		} ?>">
									<span class="text-danger"><?php if (isset($_POST['submit'])) {
																	echo $emailmsg;
																} ?></span>
								</div>
								<div class="mt-1 pb-2">
									<label for="password">Password:</label>
									<input type="password" name="users_password" class="form-control" placeholder="Enter your password">
									<span class="text-danger"><?php if (isset($_POST['submit'])) {
																	echo $passmsg;
																} ?></span>
								</div>
								<div class="form-group">
									<button name="submit" class="btn btn-primary btn-block" type="">Login</button>
								</div>
							</form>
							<!-- /Form -->

							<div class="text-center forgotpass"><a href="forgot-password">Forgot Password?</a></div>
							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<!-- Social Login -->
							<div class="social-login">
								<span>Login with</span>
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a>
							</div>
							<!-- /Social Login -->

							<div class="text-center dont-have">Don’t have an account? <a href="register">Register</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:46 GMT -->

</html>