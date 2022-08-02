<?php
session_start();
setcookie("user", "nul");
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="Assets/style/style.css">
    <title>Login</title>

</head>

<body>
    <main>

        <h1>Reserve A Book.ie</h1>
        <div>
            <?php

            if ( isset($_GET['error']) ){

                echo"<p style='color:red;'> username or password does not exist </p>";
            }
        
            if (isset($_GET['succ']) ) {
            
                echo "<p style='color:green;'> Account created, You can Login </p>";
            }

            if (isset($_GET['log']) ) {
            
                echo "<p style='color:orange;'> Logged Out </p>";
                unset($_COOKIE['user']); 
                session_unset(); 
                session_destroy(); 
                setcookie("user", "null");
            }
        

            ?>
            <form method="post" action="site.php?value=CheckLoginDetails" class="center">

                <!--user inputs username here-->

                <input type="text" name="UserName" placeholder="User Name">
                <br>
                <input type="Password" name="Password" placeholder="Password">
                

                <br>


                <!--inputed info is sent to be checked-->
                <p>
                    <input type="submit" /><br>
                </p>

                <p>
                    <!--user can logout of an account-->
                    Haven't got an account? 
                    <a href="RegisterPage.php"> Register Here </a>
                </p>
        
                </p>
        </div>
        
    </main>

</body>
<?php
include 'footer.php';
?>

</html>

