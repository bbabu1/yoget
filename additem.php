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
  if(isset($_POST['submit']) && $_POST['new']==1)
  {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(!empty($_FILES["file"]["name"]))
    {
      $allowTypes = array('jpg','png','jpeg','gif','pdf');
      if(in_array($fileType, $allowTypes))
      {
        $name = $_POST['itemName'];
        $category =$_REQUEST['category'];
        $price = $_REQUEST['price'];
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
        {
          $insert = $con->query("insert into menu (`name`,`category`,`price`,`img`) values ('$name','$category','$price','$fileName')");
          if($insert)
          {
            $statusMsg = "The item added successfully.";
          }
          else
          {
            $statusMsg = "File upload failed, please try again.";
          } 
          echo "New item added successfully";
        }
    }
    else
    {
      $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.'; 
    }
  }
  else
  {
      $statusMsg = 'Please select a file to upload.';
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
        <div id="error"  style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
        <div class="login-head">
          <h1 id='fline'>Add New Item</h1>
        </div>
        <form method="POST" action="additem.php" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1" />
            <label>Item Name: </label><br/>
            <input type="text" name="itemName" class="inputFields" required/><br/><br/>
            <label>Category: </label><br/>
            <select id="category" name="category" style="width:100%;height:40px;border-radius:10px;">                      
                <option value="Hot">Hot</option>
                <option value="Cold">Cold</option>
            </select><br/><br/>
            <label>Price: </label><br/>
            <input type="text" name="price" class="inputFields" required/><br/><br/><br/>
            <label>Images: </label><br/>
            <input type="file" name="file"><br/><br/>
            <input type="submit" name="submit" class="theButtons" value="Add Item"/><br/><br/>
            <div class="login">
               <button><a href="home.php" style="text:decoration:none;color:Burlywood">Back to home</a></button> 
            </div><br/><br/>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
