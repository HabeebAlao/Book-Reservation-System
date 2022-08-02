<?php
include 'header.php';

$value = $_GET['value'];

if ($_COOKIE['user'] !== "null") {
    $username_ = $_COOKIE["user"];
    $date = date("d-M-y");

    if ($_COOKIE['user'] !== "null") {
        $sql = "INSERT INTO Reservations VALUES ('$value','$username_','$date');";
        $conn->query($sql);

        $sql_alt = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$value' ;";
        $conn->query($sql_alt);

        header('Location: /WebD/GradedLab/site.php?value=SeeReserves');
    } else {
        echo "<p>you are logged out</p";
    }
}
$conn->close();
