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
 if (isset($_POST['Edit'])){
    $menuId=$_POST['id'];
    $name = $_POST['itemName'];
    $category = $_REQUEST['category'];
    $price = $_REQUEST['price'];
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(!empty($_FILES["file"]["name"])){
      $allowTypes = array('jpg','png','jpeg','gif','pdf');
      if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $update="update menu set name='".$name."',
            category='".$category."', price='".$price."', img='".$fileName."' where menuId='".$menuId."'";
            $query_emails = mysqli_query ($con, $update);}
        }
        else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
  }
  else{
      $update="update menu set name='".$name."',
      category='".$category."', price='".$price."' where menuId='".$menuId."'";
      $query_emails = mysqli_query ($con, $update);
      }
  }
  if (isset($_POST['Delete'])){
      $menuId=$_POST['id'];
      $delete = "DELETE FROM menu WHERE menuId='".$menuId."'";
      $query = mysqli_query($con, $delete);
    }
?>
<html>
 <head>
    <title>User Profile</title>
    <link rel="stylesheet" href ="css/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
 </head>
<body>
<button style="float:left;border-radius: 20px;padding: 14px 20px;background-color: rgb(77, 34, 34);"><a href="home.php" style="text-decoration:none;color:Burlywood">Back to home</a></button>
<div class="hot">
  <br/>
 <h1 id="vishead">Our Menu</h1>
 <br/><br/><br/><br/>
 <?php
    $result = mysqli_query($con,"SELECT * FROM menu");
 ?>
  <div class="login-head" style="color:Black;"></div>
  <?php
  echo "<table style='margin:auto;'>
         <tr>
         <th>Name</th>
         <th>Category</th>
         <th>Price</th>
         <th>Image</th>
         </tr>";
         while($row = mysqli_fetch_array($result))
         {
         echo '<form method="POST" action="edititem.php" enctype="multipart/form-data">';
         echo "<input name='id' type='hidden' value=" . $row['menuId'] ." />";
         echo "<tr>";
         echo "<td><input type='text' name='itemName' value=" . $row['name'] . "></td>";
         echo "<td><input type='text' name='category' value=" . $row['category'] . "></td>";
         echo "<td><input type='text' name='price' value=" . $row['price'] . "></td>";
         echo "<td><img src='uploads/".$row['img']."' name='img' id='img' width='100' height='100'>";
         echo '<br/>
               <input type="file" name="file">
               <br/></td>';
         echo "<td><input type='submit' id='Edit' name='Edit' value='Edit' style='width:auto;'></td>";
         echo '</form>';
         echo '<form method="POST" action="edititem.php" enctype="multipart/form-data">';
         echo "<input name='id' type='hidden' value=" . $row['menuId'] ." />";
         echo "<td><input type='submit' id='Delete' name='Delete' value='Delete' style='width:auto;' ></td>";
         echo "</tr>";
         echo '</form>';
         }
         echo "</table>";
        ?>
        <div class="login">
               <button style="float:left;"><a href="home.php" style="text:decoration:none;color:Burlywood">Back to home</a></button>
        </div>
  </div>
</body>
</html>
