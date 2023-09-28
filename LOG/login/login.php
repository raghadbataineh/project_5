<!-- Start sign up -->
<?php

// Start sign up
include('../database.php');
include ('../check_login.php');
if (isset($loggedInUserId)) {
	header('Location: ../index1.php');
}

session_start();

function checkUserExistence($conn, $uemail, $uphone)
{

	$result = $conn->query("SELECT  user_email, user_phone FROM users");
	while ($user = $result->fetch_assoc()) {
		if ($user["user_email"] == $uemail) {
			$_SESSION["errMsg"] = "Email Already Exists";
		} else if ($user["user_phone"] == $uphone) {
			$_SESSION["errMsg"] = "Phone already exists";
		}
	}

	if (isset($_SESSION["errMsg"])) {
		header('Location: ./login.php');
		exit();
	}
}

// Add the user to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	
	
	
	
	$username = $_POST["user_name"];
	$email = $_POST["user_email"];
	$password = $_POST["user_password"];
	$phone = $_POST["user_phone"];
	$location = $_POST["user_location"];
	$user_role ="user";

	// $fixedImagePath = "default-image.jpg";
	// $imgContent = file_get_contents($fixedImagePath);

	$default_image_path = "default-image.jpg"; // Path to the default image

$user_img = file_get_contents($default_image_path);
	
	$isLoggedIn = 0;
	
	checkUserExistence($conn, $email, $phone);
	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);// Hash the password
	
	$stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_img, user_phone, user_location, is_loggedIn, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	
	$stmt->bind_param("sssbisss", $username, $email, $hashedPassword, $user_img, $phone, $location, $isLoggedIn, $user_role);
	// $stmt->execute();







	// $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_img, user_phone, user_location, is_loggedIn) VALUES (?, ?, ?, ?, ?, ?, ?)");
	// $stmt->bind_param('ssssssi', $username, $email, $hashedPassword, $imgContent, $phone, $location, $isLoggedIn);


	if ($stmt->execute()) {
		$stmt->close();
		$conn->close();
		header("Location: ./login.php");
		exit();
	} else {
		echo "<p style='color: red;'>Error while inserting data</p>";
	}

	$stmt->close();
	$conn->close();

	// End sign up

}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/24ac720f84.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<div  id="container" class="container <?php if (isset($_SESSION["errMsg"])) {
												echo "right-panel-active";
											} else {
												echo "";
											}
											session_destroy();?>">
	<div class="form-container sign-up-container">
		<form  method="POST" id="signupForm">
			<h1>Create Account</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<span><?php
	if (isset($_SESSION["errMsg"])) {
		echo "<small style='font-size: 12px' class='signup-signin-error'> " . $_SESSION["errMsg"] . "</small>";
	}
	?></span>
			<input type="text" placeholder="Your Name" name="user_name" id="uname"/>
			<input type="email" placeholder="Email" name="user_email" id="email"/>
			<input type="number" placeholder="Phone" name="user_phone" id="phone"/>
			<input type="text" placeholder="Your Address " name="user_location" />
			<input type="password" placeholder="Password" name="password" id="password"/>
			<input type="password" placeholder="Confirm Password" name="user_password" id="confPassword"/>
			<button>Sign Up</button>
		</form>

	</div>
	<div class="form-container sign-in-container">
		<form action="login_process.php" method="POST">
			<h1>Sign in</h1>
			<!-- <div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div> -->
			<span><?php
		if (isset($_SESSION["loginError"])) {
			echo "<small style='font-size: 12px' class='signup-signin-error'> " . $_SESSION["loginError"] . "</small>";
		}
		?></span>
			<input type="email" placeholder="Email" name="loginEmail"/>
			<input type="password" placeholder="Password" name="loginPassword" />
			<a href="#">Forgot your password?</a>
			<button>Sign In</button>
		</form>
		
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="signup-login.js"></script>

</body>
</html>