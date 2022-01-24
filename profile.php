<?php

	include("connect.php");
	include("functions.php");

	if(logged_in())
	{
	?>

	<?php

	}
	else
	{
		header("location:login.php");
		exit();
	}

?>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style3.css">
  
        
    </head>
    <!-- <body onclick="getCurrentDate()"> -->
      <body>

        <header>
            
            <!--To set a simple logo for the website which can be seen in menubar. It is created using svg file-->
             <div class="logo">  
              <img src="svg/logo2.png" alt="Hug A Mug">
              <!-- <span id="logotext"><h4>Hug a Mug</h4></span> -->
             </div>
             <!--Available menu options. Just for Milestone B. Not finalized-->
             <nav id='nav'>
                <ul>
                    <li><a href="home.php">Home</a></li>
                </ul>
             </nav>
             <div class="login"> 
			 <button style="width:auto;"><a href="changep.php" style="text:decoration:none;color:Burlywood">Change Password</a></button>
               <button style="width:auto;"><a href="logout.php" style="text:decoration:none;color:Burlywood">Log Out</a></button>
             </div>
        </header>

        <!-- Grid start-->
        <div id="grid">
          <div id="coverimg"></div>
          <div id="topl"></div>
          <!-- <div id="topr"></div> -->
          <div id="capt1" style="background-color: blurywood; color: black;">
		  
          
         <?php
			$email= $_SESSION['email'];
			$result = mysqli_query($con, "select * from users where email = '$email'");
	    	$retrieve = mysqli_fetch_assoc($result);
			$firstname = $retrieve['firstName'];

			$lastname = $retrieve['lastName'];

			$address = $retrieve['address'];

			$image = "images/".$retrieve['image'];
			// echo $image;
			echo "<h2>User Details</h2><br>";
			echo "<table style='margin:auto;'>
			<tr>
			<th>First Name</th>
			<td></td>
			<td>  $firstname  </td>
			</tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
			<th>Last Name</th>
			<td></td>
			<td>  $lastname  </td>
			</tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
			<th>email</th>
			<td></td>
			<td>  $email  </td>
			</tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
			<th>Address</th>
			<td></td>
			<td> $address</td>
			</tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
			<th>Image</th>"?>
			<td> <img src= "<?php echo $image?>" width="100" height="100"></td>
			</tr>
			</table>
        </div>
        
        
        
        <!--Contact details of the members-->
        <div id="contact">
          <br>
          <h2>CONTACT</h2>
          ajosep13@confederationcollege.ca
          <br>bbabu1@confederationcollege.ca
          <br>ssaji1@confederationcollege.ca
          <br>akhangura@confederationcollege.ca
          <br>sthankac@confederationcollege.ca
        </div>
        </div>
        <!-- Grid end -->
    </body>
</html>