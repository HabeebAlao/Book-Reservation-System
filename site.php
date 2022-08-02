<?php

include 'header.php';



$value = $_GET['value'];


if ($value == "CheckLoginDetails") {

    $username_ = $conn->real_escape_string($_POST['UserName']);
    $password = $conn->real_escape_string($_POST['Password']);

    $sql = "SELECT Username, Password FROM Users WHERE (Username = '$username_' and Password = '$password');";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {

        setcookie("user", $username_);
        header('Location: /WebD/GradedLab/SearchBookPage.php?');
    } else {
        echo "no match found";
        header('Location: /WebD/GradedLab/index.php?error=NotFound');
    }
} elseif ($value == "RegisterAccount") {


    $username = $conn->real_escape_string($_POST['UserName']);
    $password = $conn->real_escape_string($_POST['Password']);
    $firstname = $conn->real_escape_string($_POST['FirstName']);
    $surename = $conn->real_escape_string($_POST['Surname']);
    $addressLine1 = $conn->real_escape_string($_POST['AddressLine1']);
    $addressLine2 = $conn->real_escape_string($_POST['AddressLine2']);
    $City = $conn->real_escape_string($_POST['City']);
    $Telephone = $conn->real_escape_string($_POST['Telephone']);
    $Mobile = $conn->real_escape_string($_POST['Mobile']);



    if (isset($_POST['UserName']) && (isset($_POST['Password']) && (strlen($_POST['Password']) == 6)) && isset($_POST['FirstName']) && isset($_POST['Surname']) && isset($_POST['AddressLine1']) && isset($_POST['AddressLine2']) && isset($_POST['City']) && (isset($_POST['Telephone']) && strlen($_POST['Telephone']) == 10) && (isset($_POST['Mobile']) && strlen($_POST['Mobile']) == 10)) {
        echo "success";


        $sql = "INSERT INTO Users VALUES ('$username','$password','$firstname','$surename','$addressLine1','$addressLine2','$City','$Telephone','$Mobile');";
        $result = $conn->query($sql);

        header('Location: /WebD/GradedLab/index.php?succ=set');
    } else {
        if (strlen($_POST['Password']) == 6) {
            header('Location: /WebD/GradedLab/RegisterPage.php?error_len=set');
        }
        header('Location: /WebD/GradedLab/RegisterPage.php?error_missingfields=set');
    }
} elseif ($value == "SearchBook") {



    if ($_COOKIE['user'] !== "null") {

        if (isset($_GET['prevA']) and isset($_GET['prevC'])) {
            $_POST['bookName'] = $_GET['prevA'];
            $_POST['BookCategory'] = $_GET['prevC'];
        }


        // if at least one of the two inputs is not empty
        if ((isset($_POST['bookName'])) or ("Category" !== ($_POST['BookCategory']))) {

            // assign variables
            $bookTitleAuthor  = $conn->real_escape_string($_POST['bookName']);
            $bookCategory  = $conn->real_escape_string($_POST['BookCategory']);


            if ("Category" == ($_POST['BookCategory'])) {
                $bookCategory = "null";
            }

            echo "<br><p>Results for: ";
            echo "<br>Author/Title: ";
            echo $bookTitleAuthor;
            echo "<br>Category: ";
            echo $bookCategory;
            echo "</p><br>";

            $My_Array = array("*", "Health", "Business", "Biography", "Technology", "Travel", "Self-Help", "Cookery", "Fiction");

            // to print catefory instead of cat number
            for ($v = 0; $v < count($My_Array); $v++) {
                if ($bookCategory == $My_Array[$v]) {
                    break;
                }
            }

            // NUMBER OF RESULTS PERPAGE
            $results_per_page = 5;


            if ($bookCategory == "null") {
                $sql = "SELECT * FROM books WHERE ((BookTitle like '%$bookTitleAuthor%') or (Author like '%$bookTitleAuthor%'))  ;";
            } else {
                $sql = "SELECT * FROM books WHERE (( (BookTitle like '%$bookTitleAuthor%') or (Author like '%$bookTitleAuthor%') ) and (CategoryID = '$v'))  ;";
            }

            $result = mysqli_query($conn, $sql);

            // finds out the number of results 
            $number_of_results = mysqli_num_rows($result);


            // finds out the total pages available
            $number_of_pages = ceil($number_of_results / $results_per_page);


            // determine what page user is currently on
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            //determine the sql limit starting number
            $this_page_first_result = ($page - 1) * $results_per_page;


            // Retrieve selected results from database
            //starting_limit_number = (page_number)*results_per_page

            if ($bookCategory == "null") {
                $sql = "SELECT * FROM books WHERE ((BookTitle like '%$bookTitleAuthor%') or (Author like '%$bookTitleAuthor%')) LIMIT " . $this_page_first_result . "," . $results_per_page . " ;";
            } else {
                $sql = "SELECT * FROM books WHERE (( (BookTitle like '%$bookTitleAuthor%') or (Author like '%$bookTitleAuthor%') ) and (CategoryID = '$v')) LIMIT " . $this_page_first_result . "," . $results_per_page . ";";
            }

            $result = mysqli_query($conn, $sql);


            if (($result->num_rows > 0)) {
                echo "<table = 1>"; // start a table tag in the HTML
                echo "<tr><th>Book Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Category</th><th>Reserved</th></tr>";

                while ($row = $result->fetch_assoc()) {   //Creates a loop to loop through results
                    // if book is available to reserve
                    if ($row['Reserved'] ==  'Y') {
                        echo "<tr><td>" . $row['BookTitle'] . "</td><td>" . $row['Author'] . "</td><td>" . $row['Edition'] . "</td><td>" . $row['Year'] . "</td><td>" . $row['CategoryID'] . "</td><td>" . "<a href=\"" . "reserve.php?value=" . $row["ISBN"] . "\" >Reserve </a></td></tr>";
                    } else {
                        echo "<tr><td>" . $row['BookTitle'] . "</td><td>" . $row['Author'] . "</td><td>" . $row['Edition'] . "</td><td>" . $row['Year'] . "</td><td>" . $row['CategoryID'] . "</td><td>" . "Reserved" . "</td></tr>";
                    }
                }

                echo "</table>";

                // display links
                echo '<p>';

                for ($page = 1; $page < $number_of_pages + 1; $page++) {
                    echo ' <a href="site.php?prevA=' . $_POST['bookName'] . '&prevC=' . $_POST['BookCategory'] . '&value=SearchBook&page=' . $page . '">[_Page ' . $page . '_]' . '</a>';
                }
                echo '<p>';
                echo "<p><a href =\"SearchBookPage.php?\"> Search Again </a></p>";
                echo "<p><a href =\"site.php?value=SeeReserves\"> See Reserves </a><p>";
            } else {
                header('Location: /WebD/GradedLab/SearchBookPage.php?error="notFound"');
            }
        } else {
            header('Location: /WebD/GradedLab/SearchBookPage.php?error="notFound"');
        }
    } else {
        header('Location: /WebD/GradedLab/index.php?log=out"');
    }
} elseif ($value == "SeeReserves") {
    include 'header.php';

    $user = $_COOKIE["user"];

    // NUMBER OF RESULTS PERPAGE
    $results_per_page = 5;

    if ($_COOKIE['user'] !== "null") {

        echo "<P>" . "$user" . " Reserves </p>";


        $sql = "SELECT * FROM Reservations WHERE (Username = '$user');";


        $result = mysqli_query($conn, $sql);

        // finds out the number of results 
        $number_of_results = mysqli_num_rows($result);


        // finds out the total pages available
        $number_of_pages = ceil($number_of_results / $results_per_page);


        // determine what page user is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        //determine the sql limit starting number
        $this_page_first_result = ($page - 1) * $results_per_page;

        $sql = "SELECT ISBN, ReservedDate, Username FROM Reservations WHERE (Username = '$user')  LIMIT " . $this_page_first_result . "," . $results_per_page . " ; ";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            echo "<table = 1>"; // start a table tag in the HTML

            echo "<tr><th>ISBN</th><th>Date</th><th>Unreserve</th></tr>"; // columns 

            while ($row = $result->fetch_assoc()) {   // Creates a loop to loop through results
                echo "<tr><td>" . $row['ISBN'] . "</td><td>" . $row['ReservedDate'] . "</td><td>" . "<a href=\"" . "unreserve.php?value=" . $row["ISBN"] . "\" >Uneserve </a></td></tr>";
            }
            echo "</table>";
            echo '<p>';
            for ($page = 1; $page < $number_of_pages + 1; $page++) {
                echo ' <a href="site.php?&value=SeeReserves&page=' . $page . '">[_Page ' . $page . '_]' . '</a>';
            }
        } else {
            echo "<p>You haven't got any reserved books</p>";
        }



        echo "<p><a href =\"SearchBookPage.php?\"> Search Books </a></p>";
    } else {
        header('Location: /WebD/GradedLab/index.php?log=out"');
    }
}

include 'footer.php';
$conn->close();
