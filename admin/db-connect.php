<?php

    session_start();
    
    $username="";

    if(!isset($_COOKIE['username'])) {
        if(!isset($_SESSION['username'])) {
            header("Location: login.php");
        } 
        else {
            $username= $_SESSION['username'];
        }
    }
    else {
        $username= $_COOKIE['username'];
    }

    $connect= mysqli_connect("localhost", "root", "", "allpros_db");
    if(!$connect) {
        print_r("Database not Connected");
    }

?>