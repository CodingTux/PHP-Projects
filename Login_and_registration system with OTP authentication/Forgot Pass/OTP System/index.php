<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form method = "POST" field = "hidden" action="../process.php" class="login100-form validate-form">
					<span class="login100-form-title">
						Authentication
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">

						<input class="input100" type="text" name="email" placeholder="Email" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type = "send" class="login100-form-btn">
							send
						</button>
					</div>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="otpNo" placeholder="OTP" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type = "submit" class="login100-form-btn">
							Authenticate
						</button>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="/php/registration_form/SignUp/index.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> 
				</form>
			</div>
		</div>
	</div>

	<script>
		function sry(){

			alert("This feature will available soon");
		}
	</script>

<!--===========================================PHP WORK=================================-->

<?php

	$inpEmail = $_POST["email"];
	///BLOWFISH ENCRYPTIOM SALT
	$salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
	$inpPass = crypt($_POST["pass"], $salt);

	$srvNm = "localhost";
	$usrNm = "root";
	$psr = "";
	$dbNm = "logInf";

	$conn = new mysqli($srvNm, $usrNm, $psr, $dbNm);

	$sql = "SELECT EMAIL, PASS FROM sgnUp";
	

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$retrive_email = $row["EMAIL"];
			$retrive_pass = $row["PASS"];

			if($retrive_email === $inpEmail && $retrive_pass === $inpPass){
				echo "Welcome Back Buddy!!!";
				break;
			}
		}
		
	}

?>


	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>