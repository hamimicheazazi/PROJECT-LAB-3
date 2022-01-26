<?php
include_once("dbconnect.php");
$sqlproduct = "SELECT * FROM tbl_product ORDER BY product_date DESC";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$results_per_page = 5;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LAB 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
    <title>YUZIE'S RESTAURANT</title>
</head>
<body>
    <body>
        <!-- Header -->
        <div class="w3-bar w3-black">
            <a href="#home" class="w3-bar-item w3-button">HOME</a>
            <a href="newproduct.php" class="w3-bar-item w3-button w3-hide-small w3-right">NEW PRODUCT</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
            

             <div id="idnavbar" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium">
                <a href="newproduct.php" class="w3-bar-item w3-button w3-right">NEW PRODUCT</a>
            </div>

        <script>
            function myFunction() {
            var x = document.getElementById("idnavbar"); if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            } else {
            x.className = x.className.replace(" w3-show", "");
            }
            }
        </script>
        <div class="w3-header w3-container w3-black w3-padding-32 w3-center">
            <img src="res/images/image6.jpeg" alt="Nature" style="width:100%;">
            <h1 style="font-size:calc(8px + 4vw);">YUZIE'S RESTAURANT</h1>
            <p style="font-size:calc(8px + 1vw);;">We only serve you the best food!</p>
            </div>
            <div class="w3-sand w3-large">

            <br>
            <br>

<div class="w3-grid-template">
<?php
foreach($rows as $product){
    $name = $product['name'];
    $price = $product['price'];
    $description = $product['description'];

    echo "<div class='w3-center w3-padding'>";
    echo "<div class='w3-card-4 w3-khaki'>";
    echo "<header class='w3-container w3-khaki'>";
    echo "<h5><b>$name</h5></b>";
    echo "</header>";
    echo "<img class='w3-image' src=res/images/$name.png" . " onerror=this.onerror=null;this.src='res/images/meals-icon.png'" . " style='width:80%;height:260px'>";
    echo "<div class='w3-container w3-left-align'><hr>";
    echo "<i class= style='font-size 40px;'><p><b> Name :</i> &nbsp&nbsp$name<br>
    <i class='fas fa-map-marker-alt' style='font-size 40px;'> Price :</i> &nbsp&nbsp$price<br>
    <i class='fas fa-map-marker-alt' style='font-size 40px;'> Description :</i> &nbsp&nbsp$description<br></p><hr></b>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>
            </div>

<br>
<br>
<br>


<?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    
<br>
<br>


</div>

    <footer class="w3-footer w3-black w3-center">
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
