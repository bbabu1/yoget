<?php

include("connect.php");

$error="";

if (isset($_POST['submit'])){
  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];
  $address = $_POST['address'];
  $image = $_FILES ['image']['name']; #will get name of the file which the user uploads
  $tmp_image = $_FILES ['image']['tmp_name'];
  $imageSize = $_FILES ['image']['size'];

  $date = date ("F, d, Y");

#Get the email address form Database
$query_emails = mysqli_query ($con, "SELECT * FROM users WHERE email = '$email'");
$numEmail = mysqli_num_rows ($query_emails);


//$toemail = $email;
//$subject = "Registration successful - Welcome to our amzaing website!";
//$body = "Hello $firstName, Thank you for registering to our website. We will send you product soon!";
//$headers = "From: nkhezr@gmail.com";


#https://www.w3schools.com/php/func_string_strlen.asp
if (strlen($firstName) < 3){
  $error = "First name is too short. You must enter more that three characters";
}
else if (strlen($lastName) < 3){
  $error = "Last name is too short. You must enter more that three characters";
}
	#https://www.w3schools.com/php/filter_validate_email.asp
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error = "Please enter valid email address";
}
else if ($numEmail > 0){
  $error = "User is already exists";
}
else if (strlen($password) < 5){
  $error = "Passwrod must be greater than five characters";
}
else if ($password !== $passwordConfirm){
  $error = "Password dose not match!";
}
else if ($imageSize > 1048576) {
  $error = "Image size must be less than 1 MB";
}
else {
#https://www.w3schools.com/php/func_mysqli_query.asp
#https://www.w3schools.com/sql/sql_insert.asp
  // $password = md5($password);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $imageExt = explode(".", $image);
  if ($imageExt[1] == "jpg")
  {
    $image = rand (0, 1000000).rand(0,1000000).time().".".$imageExt[1];
    $insertQuery = "INSERT INTO users (firstName, lastName, email, password, address, image, date) VALUES ('$firstName', '$lastName', '$email', '$password', '$address', '$image', '$date')";

    if (mysqli_query($con,$insertQuery))
    {
      if(move_uploaded_file($tmp_image, "images/$image"))
      //&& mail($toemail, $subject, $body, $headers)
      {
        $error = "You are successfully registered";
        
      //  $error = "Registration confrimation is sent to $toemail";
      }
      else {
          $error = "Image is not uploaded";
          }
      }
    }else {
          $error = "it is not a JPG file!";
    }
  }
}

#######################so far what we did ##############
#all the required field must be checked -Done
#check passwrod ---done
#check the email ---done
#check image size ---done
#uniqune name is your lab 4
#checking the file extension is your lab4
#hashing for our password
#date ---done

####################### next objectives ##################
#creating a login page
#email validation -- email protocols
#OTP one time password
#Profile for users inside login page
#change password
#forget password
#session


 ?>

<html>
<head>
  <title>Dynamic Website</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
</head>

<body>
  <div id="wrapper">
    <!-- <div id="menu">
      <a href="signup.php">Sign up</a>
      <a href="login.php">Login</a>
      <a href="contact.php">Contact</a>
    </div> -->
     
    <div id="formdiv">
    <div id="error" style=" <?php  if($error !=""){ ?>  display:block; width:100%; <?php } ?> "><?php echo $error; ?></div>

    <div class="login-head">
                          <h1 id='fline'>Signup</h1>
    </div>
    <form method="POST" action="signup.php" enctype="multipart/form-data">
        <label>First Name: </label><br/>
        <input type="text" name="fname" class="inputFields" required/> <br/><br/>

        <label>Last Name: </label><br/>
        <input type="text" name="lname" class="inputFields" required/><br/><br/>

        <label>Email: </label><br/>
        <input type="text" name="email" class="inputFields" required /><br/><br/>

        <label>Password: </label><br/>
        <input type="password" name="password" class="inputFields" required/><br/><br/>

        <label>Re-enter Password: </label><br/>
        <input type="password" name="passwordConfirm" class="inputFields" required/><br/><br/>

        <label>Address (Optional): </label><br/>
        <input type="text" name="address"/><br/><br/>

        <label>Image: </label><br/>
        <input type="file" name="image" id="imageupload"/><br/><br/>
        <button style="float:right;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="index.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>

        <input type="submit" name="submit" class="theButtons"/><br/>
      </form>
    </div>
  </div>

</body>
</html>
