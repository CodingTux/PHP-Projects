<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Material design sign up form</title>
  
  
  
      <link rel="stylesheet" href="style.css">

  
</head>

<body>

  <div id="login-box">
  <div class="left">
    <h1>Sign up</h1>

    <form method="POST" id="myForm" enctype="application/x-www-form-urlencoded" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
    
      <input type="text" id="mail" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>

      <input type="text" name="secQues" placeholder="Write Security Question" required/>
      
      <input type="password" name="secAns" placeholder="Answer to above question" required/>

      <input type="password" name="password" placeholder="Password" required = "required" id="pass"/>

      <input type="password" name="password2" placeholder="Retype password" required = "required" id="cfmPass"/>
      
      <input type="submit" name="signup_submit" value="Sign me up" />

    </form>

  </div>
  
  <div class="right">
    <span class="loginwith">Sign in with<br />social network</span>
    
    <button class="social-signin facebook">Log in with facebook</button>
    <button class="social-signin twitter">Log in with Twitter</button>
    <button class="social-signin google">Log in with Google+</button>
  </div>
  <div class="or">OR</div>
</div>

<script>

    var password = document.getElementById("pass")
      , confirm_password = document.getElementById("cfmPass");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

</script>


<?php

    $email = $password = $secQues = $secAns = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

       // $username = test_input($_POST["username"]);

        $email = test_input($_POST["email"]);

        $password =$_POST["password"];

        $secQues = test_input($_POST["secQues"]);

        $secAns = $_POST["secAns"];
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
     // echo $data."<br>";
      return $data;
    }

?>

<!-- SQL PART -->

<?php

    $servername = "localhost";
    $user = "root";
    $pass = "";

    $conn = new mysqli($servername, $user, $pass);

    if($conn->connect_error){
      die("connection failed ".$conn->connect_error);
    }    

  //-----------------------------------------------  

    $making_db = "CREATE DATABASE logInf";

    if($conn->query($making_db) === TRUE)

    $conn->close();

  //-----------------------------------------------    

                      //MAKING TABLE

  //-----------------------------------------------

    //$dbName = "logInf";

    $conn = new mysqli($servername, $user, $pass, "logInf");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  

    $making_table = "CREATE TABLE sgnUp(
      EMAIL VARCHAR(30) NOT NULL,
      SECQUES VARCHAR(50) NOT NULL,
      SECPASS VARCHAR(100) NOT NULL, 
      PASS VARCHAR(100) NOT NULL,
      PRIMARY KEY(EMAIL)
    )";

    if($conn->query($making_table)==TRUE){
      echo "Done";
    }

 //-----------------------------------------------


    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO sgnUp (EMAIL, SECQUES, SECPASS, PASS) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usrEml, $usrQues, $usrAns ,$usrPass);

    // set parameters and execute

  //  $sql = "SELECT EMAIL FROM sgnUp";
    $sql = "SELECT * FROM sgnUp WHERE EMAIL='$email' LIMIT 1";
    $result = $conn->query($sql);
    $user = mysqli_fetch_assoc($result);
    $status = "";
  
    if ($user) { // if user exists
      
      if ($user['EMAIL'] == $email) {
        
        echo "This Email already exists";
        
      }
    }else{

      

      $usrEml = $email;
      $usrQues = $secQues;
      //$usrPass = sha1($password);

      ///BLOWFISH ENCRYPTIOM SALT
      $salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
      $usrPass = crypt($password, $salt);
      $usrAns = crypt($secAns, $salt);
     // echo "<script type='text/javascript'>alert('$usrPass');</script>";
      

     // $usrPass = crypt($password);

     // echo $usrPass;
      $stmt->execute();

      echo "<script type='text/javascript'>
      
              alert('You signed up successfully...');
              window.location='../login/Login_v1/index.php';
        
            </script>";

//        header('location: ../login/Login_v1/index.php');

      $stmt->close();
      $conn->close();

    }


    // echo "<script>
    // function myFunction() {
    //     document.getElementById('myForm').reset();
    // }
    // </script>
    // ";

?>
 
</body>

</html>
