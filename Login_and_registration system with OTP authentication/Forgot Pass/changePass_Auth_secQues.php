
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="OTP System/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="OTP System/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="OTP System/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="OTP System/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="OTP System/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="OTP System/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="OTP System/css/util.css">
	<link rel="stylesheet" type="text/css" href="OTP System/css/main.css">
<!--===============================================================================================-->
</head>


<!--===========================================PHP WORK=================================-->



<?php

$retriveEmail = $_POST['email'];
$inpAns = $_GET['answer'];

$srvNm = "localhost";
$usrNm = "root";
$psr = "";
$dbNm = "logInf";

$conn = new mysqli($srvNm, $usrNm, $psr, $dbNm);

//$sql = "SELECT * FROM sgnUp WHERE EMAIL='$retriveEmail'";
$sql = "SELECT * FROM sgnUp WHERE EMAIL='$retriveEmail'";
$result = $conn->query($sql);
$user = mysqli_fetch_assoc($result);

	if($user){

		$securityQues = $user['SECQUES'];	
		//$securityQues = "WHat is your name?";	



			///BLOWFISH ENCRYPTIOM SALT
			$salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
			$secAns = crypt($inpAns, $salt);	
					
			if ($user['SECPASS'] == $secAns) {
				//$err = 1;
				echo "You are authentic user";
				
			}
			else{
				echo "<script> alert('You are fake user');
								
					</script>";
			}

	}else{
		echo "<script> alert('Email not exist');
								
			  </script>";
	}

?>

	

<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="OTP System/images/img-01.png" alt="IMG">
				</div>

				<form method = "GET" field = "hidden" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="login100-form validate-form">
					<span class="login100-form-title">
						Authentication
					</span>

					<span class="login100-form-title">
						<?php echo $securityQues; ?>
					</span>
					
					<div class="wrap-input100 validate-input">

						<input class="input100" type="password" name="answer" placeholder="Security Answer" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type = "submit" class="login100-form-btn">
							submit
						</button>
					</div>

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


<!--===============================================================================================-->	
	<script src="OTP System/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="OTP System/vendor/bootstrap/js/popper.js"></script>
	<script src="OTP System/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="OTP System/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="OTP System/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="OTP System/js/main.js"></script>

	

</body>
</html>












