<?php

$mysqli = new mysqli("localhost", "root", "", "loginsystem");

if($mysqli->connect_error) {
  exit('Could not connect');
}



$sql = "SELECT c_add FROM client WHERE cid =?";

$stmt = $mysqli->prepare($sql);
$data = stripslashes(mysqli_real_escape_string($mysqli,$_GET['q']));

//echo $data;

$stmt->bind_param("s",$data);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cadd);
$stmt->fetch();
$stmt->close();

echo $cadd;

?>