<?php
session_start();
include('RLES_include/config.php');

if(isset($_POST['submit'])) 
{
    $property_id=$_POST['property_id'];
    $address=$_POST['address'];
    $amenities=$_POST['amenities'];
    $price=($_POST['price']);
    $sql="INSERT INTO property_tbl(property_id,address,amenities,price) VALUES(:property_id,:address,:amenities,:price)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':property_id',$property_id,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':amenities',$amenities,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    $query->execute();
    echo "Successful";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Property Form</title>
    <link rel="stylesheet" href="./style.css">
    <style>
    </style>
</head>
<body>
    <h1>PROPERTY SIGNING</h1>
    <div class="header">
    </div>
<form class="signup-form" name="signup" method="post">
    <h3>ADD</h3>
    <input type="number" value="" placeholder="Property ID" style="width: 500px; height: 100px;" name="property_id" autocomplete="off" required=""></input><br>
    <textarea type="text" value="" placeholder="Address" style="width: 500px; height: 100px;" maxlength="255" name="address" autocomplete="off" required=""></textarea><br>
   <textarea name="amenities" placeholder="Amenities" style="width: 500px; height: 100px;" required></textarea><br>
    <span id="user-availability-status" style="font-size:15px;"></span>
    <input type="number" value="" step=".01" placeholder="Price" style="width: 500px; height: 100px;" name="price" autocomplete="off" required=""></input><br>
    <input id="signup-button" type="submit" name="submit" value="ADD"><br><br>
</form>


<br>
    <div class="container1">
        <!-- <img id="image" src="../assets/images/loupe.png" alt="first-image"> -->
    </div>
</body>
</html>