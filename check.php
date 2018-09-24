<?php
    session_start();


    $userName = $_POST["uname"];
    $passWord = $_POST["psw"];


    //connect to DB
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    //Selecting usernames and match with password
    $query = "SELECT Username,Password FROM users WHERE Username='$userName'";
    $result=mysqli_query($conn,$query);

    // Associative array
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $dbUname = $row["Username"];
    $dbPword = $row["Password"];

    // Free result set
    mysqli_free_result($result);

    if ($dbPword == $passWord) {
            $_SESSION["userName"]=$userName;
            header('Location: home/home.php');
            exit();
    } else {
            header('Location: index.html');
            exit();
    }

?>