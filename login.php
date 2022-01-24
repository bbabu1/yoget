<?php

include("connect.php");
include("functions.php");

$error="";

if (isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (email_exists($email, $con)){
    $result = mysqli_query($con, "select password from users where email = '$email'");
    $retrievepassword = mysqli_fetch_assoc($result);
    if (password_verify($password, $retrievepassword ['password'])){
      $_SESSION['email'] = $email;
      header ("location: home.php");

    }else{
        $error="Your password is incorrect";
    }
  }else {
    $error="Your email does not exists";
  }

}

 ?>

<html>
<head>
  <title>Dynamic Website</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

</head>

<body>
  <div id="wrapper">

    <div class="logind">


  <div id="formdiv">
  <div id="error"  style=" <?php  if($error !=""){ ?>  display:block; width:100%; <?php } ?> "><?php echo $error; ?></div>
  <div class="login-head">
    <h1 id='fline'>Login</h1>
  </div>
    <form method="POST" action="login.php" enctype="multipart/form-data">

        <label>Email: </label><br/>
        <input type="text" name="email" class="inputFields" required/><br/><br/>

        <label>Password: </label><br/>
        <input type="password" name="password" class="inputFields" required/><br/><br/>
        <div id="formtext">New to us <a href="signup.php"> Create a New Account</a></div>
        <div id="formtext"><a href="forgetpassword.php" >Forget Password</a></div>
        <br/>
        <button style="float:right;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="index.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>
        <input type="submit" name="submit" class="theButtons" value="Login"/><br/>
        
      </form>
    </div>
  </div>
</div>
</body>
</html>
