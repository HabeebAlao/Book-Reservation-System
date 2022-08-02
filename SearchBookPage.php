<?php

include 'header.php';

echo "<p>Welcome " . $_COOKIE["user"] . ",</p>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="Assets/style/style.css">
    <title>Search For Book</title>

</head>

<body>
    <main>

        <h1>Reserve A Book.ie</h1>
        <div>
            <form method="post" action="site.php?value=SearchBook" class="center">

                <?php

                if (isset($_GET['error'])) {

                    echo "<p style='color:red;'> No results matching your search </p>";
                }
                ?>
                <!--user inputs booktitle here-->

                <input type="search" name="bookName" placeholder="Title / Author">
                <br>

                <?php
                        $sql="SELECT * FROM categories" ; $result=$conn->query($sql) or die($conn->error);

                        echo "<select name='BookCategory'>";

                        ?>

                        <option CatValue="000">Category</option>

                        <?php
                        while($row = $result->fetch_assoc()){
                            echo "<option CatValue='".$row[' CategoryID']."'>" .$row['CategoryDescription'] . "</option>";

                        }

                        echo "</select>";
                    ?>

                <!--user can select from dropdown menu here-->


                        <!--inputed info is sent to be checked-->
                        <p>
                            
                            <input type="submit" /><br>
                        </p>

                        <p>
                            <!--user can logout of an account-->
                            <a href="index.php?log=out"> Logout </a>
                        </p>

                        </p>
        </div>
        <?php
        echo "<p><a href =\"site.php?value=SeeReserves\"> See Your Reserves </a><p>";
        include 'footer.php';
        ?>

    </main>


</body>

</html>