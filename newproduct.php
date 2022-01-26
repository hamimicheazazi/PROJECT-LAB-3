<?php
if (isset($_POST["submit"])) { 
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
   
    $sqlregister = "INSERT INTO `tbl_product` (`name`, `price`,`description`) 
    VALUES('$name','$price','$description')";
try {
    $conn->exec($sqlregister);
    if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file ($_FILES["fileToUpload"]["tmp_name"])) {
        uploadImage($name);
        echo "<script>alert('Insert new product successful')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
    }    
    } catch (PDOException $e) {
           echo "<script>alert('Insert new product failed')</script>";
           echo "<script>window.location.replace('newproduct.php')</script>";
    }
    
}   
function uploadImage($name)
{
$target_dir = "res/images/";
$target_file = $target_dir . $name . ".png"; 
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font- awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
<title>NEW PRODUCT</title>
</head>


<body>
     <div class="w3-header w3-container w3-black w3-padding-32 w3-center">
     <h1 style="font-size:calc(8px + 4vw);">YUZIE'S RESTAURANT</h1>
       <p style="font-size:calc(8px + 1vw);;">We only serve you the best food!</p>
     </div>

     <div class="w3-bar w3-brown">
      <a href="mainpage.php" class="w3-bar-item w3-button w3-right">Logout</a>
      <a href="mainpage.php" class="w3-bar-item w3-button w3- left">Home</a>
     </div>

     <div class="w3-container w3-padding-64 form-container">
     <div class="w3-card">
     <div class="w3-container w3-brown">
           <p>New Product<p>
</div>

    <form class="w3-container w3-padding" name="registerForm" action="newproduct.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmDialog()">
    <p>
       <div class="w3-container w3-border w3-center w3-padding">
       <img class="w3-image w3-round w3-margin" src="res/images/images1.png" style="width:60%; max-width:600px"><br>
       <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
</div>
</p>
   

    <p>
      <label>Name</label>
            <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" required>
    </p>

    <p>
     <label>Price</label>
            <input class="w3-input w3-border w3-round" name="price" id="idprice" type="text" required>
    </p>

    <p>
    <label>Description</label>
            <input class="w3-input w3-border w3-round" name="description" id="iddescription" type="text" required>
    </p>

    </p>
    <div class="row">
           <input class="w3-input w3-border w3-block w3-brown w3-round" type="submit" name="submit" value="Submit">
    </div>

</form>

     </div>
</div>
<footer class="w3-footer w3-brown w3-center">
    <div class="w3-xlarge w3-section">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>©️ 2021 Copyright all right reserved | Designed by <a class="text-white">YUZIE'S RESTAURANT</a></p>
</footer>

</body>

</html>
