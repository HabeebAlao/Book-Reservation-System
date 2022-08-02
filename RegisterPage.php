<?php
//echo $_COOKIE["user"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="Assets/style/style.css">
    <title>Register</title>

</head>

<body>
    <main>

        <h1>Reserve A Book.ie</h1>
        <div>
            <form method="post" action="site.php?value=RegisterAccount" class="center">

                <!--user inputs username here-->
                <?php
                if (isset($_GET['error_len'])) {

                    echo "<p style='color:red;'> password not of lenght 6 </p>";
                }
                elseif(isset($_GET['error_missingfields'])){
                    echo "<p style='color:red;'> missing fields </p>";

                }
                ?>

                <input type="text" name="UserName" placeholder="Username*">
                <br>
                <input type="Password" name="Password" placeholder="Password*">
                <br>
                <input type="text" name="FirstName" placeholder="First Name*">
                <br>
                <input type="text" name="Surname" placeholder="Surname*">
                <br>
                <input type="text" name="AddressLine1" placeholder="AddressLine1*">
                <br>
                <input type="text" name="AddressLine2" placeholder="AddressLine2*">
                <br>
                <input type="text" name="City" placeholder="City*">
                <br>
                <input type="number" name="Telephone" placeholder="Telephone*">
                <br>
                <input type="number" name="Mobile" placeholder="`Mobile*`">
                <br>


                <br>


                <!--inputed info is sent to be checked-->
                <p>
                    <input type="submit" /><br>
                </p>

                <p>
                    <!--user can logout of an account-->
                    Got an account?
                    <a href="index.php"> Login Here </a>
                </p>
                </p>
        </div>
        <foo<ter>
            <!--Site by : Habeeb Alao &copy 2021-->
            </footer>
    </main>

    <style>
        html,
        body {
            height: 100%;
            background-color: rgb(36, 39, 46);
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
    </style>
</body>

</html>