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
    <title>Hug a Mug</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <header>
      <!--To set a simple logo for the website which can be seen in menubar. It is created using svg file-->
      <span class="logo">
        <img src="svg/logo2.png" alt="Hug A Mug"><br>
        <span style="color:burlywood;font-family:Brush Script MT;">Hug a Mug</span>
			</span>
      <span class="login">
        <button style="width:auto;"><a href="profile.php" style="text:decoration:none;color:Burlywood">Profile</a></button>
        <button style="width:auto;"><a href="logout.php" style="text:decoration:none;color:Burlywood">Log Out</a></button>
      </span>
    </header>
    <!-- Grid start-->
    <div id="grid">
      <div id="coverimg"></div>
      <div id="topl"></div>
      <div id="topr"></div>
      <div id="capt1" style="background-color: blurywood; color: black;">
        <h3 id="firstl">Feel The Coffee</h3>
        <br><br>
      </div>
      <!--To create menu-->
      <div class="vision">
        <br><br><br>
        <h1 id="vishead">Our Menu</h1>
        <br>
      </div>
      <br>
      <div class="hot">
        <br><h1 id="vishead">Our Menu</h1><br>
        <?php
				 	include("search.php");
          $result = mysqli_query($con,"SELECT * FROM menu where category='Hot'");
        ?>
      <div class="login-head" style="color:Black;">
        <h1 id='fline'>Hot Drinks</h1>
      </div>
      <?php
        echo "<table style='margin:auto;padding: 8px;'>
              <tr>
				      <th></th>
              <th>Name</th>
              <th></th>
              <th>Price</th>
              </tr>";
        while($row = mysqli_fetch_array($result))
        {
          echo "<tr>";
				  echo "<td style='padding:8px;'><img src='uploads/".$row['img']."' width='80' height='80' style='border-radius: 50%;'></td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>.........................................</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        $result = mysqli_query($con,"SELECT * FROM menu where category='Cold'");
        ?>
        <div class="login-head" style="color:Black;">
          <h1 id='fline'>Cold Drinks</h1>
        </div>
        <?php
          echo "<table style='margin:auto;'>
                <tr>
				        <th></th>
                <th>Name</th>
                <th></th>
                <th>Price</th>
                </tr>";
          while($row = mysqli_fetch_array($result))
          {
          echo "<tr>";
				  echo "<td style='padding:8px;'><img src='uploads/".$row['img']."' width='80' height='80' style='border-radius: 50%;'></td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>.........................................</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "</tr>";
          }
          echo "</table>";
          if($_SESSION['email']=="admin@gmail.com")
          {
        ?>
        <div class="login">
          <button style="width:auto;"><a href="additem.php" style="text:decoration:none;color:Burlywood">Add</a></button>
          <button style="width:auto;"><a href="edititem.php" style="text:decoration:none;color:Burlywood">Edit</a></button>
         </div>
        <?php
         }
        ?>
      </div>
			<div class="cold">
			<br>
      <p id="sline1">
        Get a free cup of coffee with <br>any two cup of coffe of your choice <br> Use coupon <br>
        <span style="color:red;">HAMEVERYTWO</span>
      </p>
			<br/>					
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
