<?php

    session_start();

    $connect= mysqli_connect("localhost", "root", "", "allpros_db");
    if(!$connect) {
        print_r("Database not Connected");
    }

    if(isset($_SESSION['username'])) {
        header("Location: posts.php");
    }
    if(isset($_COOKIE['username'])) {
        header("Location: posts.php");
    }
    
    $fill_username_error="";
    $fill_password_error="";
    $login_fail_error="";
    
    $username="";
    $password="";

    $login= false;

    if(isset($_POST['login_btn'])) {
        $username= $_POST['username'];
        $password= $_POST['password'];

        if($username != "" && $password != "") {
            $query= "SELECT username, password FROM admin_users";
            $data= mysqli_query($connect, $query);
            while($row = mysqli_fetch_array($data)) {
                if($username == $row['username'] && $password == $row['password']) {
                    $login = true;
                    break;
                }
            }

            if($login) {

                $login_type= $_POST['login_type'];
                if($login_type == "cookie") {
                    setcookie("username", $username, time() + (86400 * 30));
                    header("Location: posts.php");
                }
                else {
                    $_SESSION['username']= $username;
                    header("Location: posts.php");
                }

            }
            else {
                $login_fail_error= "*Error: Username or Password is incorrect";
            }
        }
        else {
            if($username == "") {
                $fill_username_error= "*Error: Please enter username!";
            }
            if($password == "") {
                $fill_password_error= "*Error: Please enter password!";
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Head File Include -->
    <?php include("admin-head.php") ?>

    <title>Login</title>
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/login_style.css" type="text/css">
</head>
<body>
    
    <div class=" container">
        <div class=" row ps-5 pe-5">
            <div class=" mt-5 mb-4 p-2">
                <center><span class=" text-center form-logo">Allpros</span>
                <span class=" text-center panel-heading weight-600">Admin Panel</span></center>
            </div>
            <div class=" form-div col-md-4 ms-auto me-auto">
                <h1 class="text-center mt-5 weight-800">Login</h1>
                <form id="login-form" action="" method="post">
                    <label class=" form-label mt-5 weight-700 label" for="username">Username</label>
                    <br>
                    <input class=" form-control input-field" type="text" name="username" id="username-field" placeholder="Enter Username">
                    <span class="error-span"><?php echo $fill_username_error ?></span>
                    <br>
                    <label class=" form-label weight-700 label" for="password">Password</label>
                    <br>
                    <input class=" form-control input-field" type="password" name="password" id="pass-field" placeholder="Enter Password">
                    <span class="error-span"><?php echo $fill_password_error; echo $login_fail_error ?></span>
                    <br>
                    <input class=" form-check-inline" type="checkbox" name="login_type" id="remember" value="cookie"> <span class=" form-check-label weight-600">Remember Me?</span>
                    <br>
                    <center><button class="btn submit-btn mt-2" type="submit" name="login_btn" value="login">Login</button></center>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>