<?php
include 'header.php';


$value = $_GET['value'];
$username = $_COOKIE["user"];
$date = date("d-M-y");


$sql = "DELETE FROM Reservations WHERE ISBN = '$value';";
$result = $conn->query($sql);

$sql_alt = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$value' ;";
$result = $conn->query($sql_alt);

header('Location: /WebD/GradedLab/site.php?value=SeeReserves');


$conn->close();
?>