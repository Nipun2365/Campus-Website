<?php

if(isset($_SESSION['aid'])){
    $userID=$_SESSION['aid'];
} 

$users = $dbh->prepare('SELECT * FROM users');
$users->execute();
$ucount = $users->rowCount();

$property = $dbh->prepare('SELECT * FROM properties');
$property->execute();
$ccount = $property->rowCount();

$booking = $dbh->prepare('SELECT * FROM booking');
$booking->execute();
$rcount = $booking->rowCount();

$propertyOwner = $dbh->prepare('SELECT * FROM properties WHERE ownerID=28');
$propertyOwner->execute();
$pcountOwner = $propertyOwner->rowCount();

?>