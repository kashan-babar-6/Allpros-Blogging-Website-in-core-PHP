<?php

    session_start();

    // $connect= mysqli_connect("localhost", "root", "", "allpros_db");
    // if(!$connect) {
    //     print_r("Database not Connected");
    // }

    if(isset($_SESSION['username'])) {
        session_destroy();
    }
    else if(isset($_COOKIE['username'])) {
        setcookie("username", "", time() - 3600 );
    }

    header("Location: login.php");

?>