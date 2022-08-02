


<style>
    html,
    body {
        height: 100%;
        background-color: rgb(36, 39, 46);
        padding: 30px;

    }

    html {
        display: table;
        margin: auto;
    }

    body {
        display: table-cell;
        vertical-align: middle;
    }

    h1 {
        color: rgb(161, 169, 183);
    }

    p {
        color: rgb(161, 169, 183);
        text-align: center;
    }

    a {
        color: rgb(216, 132, 30);
    }

    a:visited {
        color: rgb(176, 117, 39);
    }

    a:hover,
    a:active,
    a:focus {
        color: rgb(215, 125, 23);
    }

    table,
    th,
    td {
        border: 1px solid white;
        border-color: rgb(161, 169, 183);
        color: rgb(161, 169, 183);
        padding: 10px;
        text-align: center;
    }

    input[type="text"],
    input[type="submit"],
    input[type="tel"],
    input[type="password"],
    input[type="search"],
    input[type="password"],
    input[type="number"],
    select {
        position: relative;
        display: block;
        margin: 0 auto;
        border-radius: 5px;
    }

    .pagination {
        display: inline-block;
        padding-left: 43%;
        width: 70%;
        margin: auto;
        
    }

    .pagination>li {
        display: inline
    }


</style>

<?php

if ($_COOKIE['user'] == "nul") {
    header('Location: /WebD/GradedLab/index.php?log=out"');
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "Project3";

$conn = new mysqli($servername, $username, $password, $database);
?>