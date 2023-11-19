<?php

    include("db-connect.php");

    if(!isset($_COOKIE['username'])) {
        if(!isset($_SESSION['username'])) {
            header("Location: login.php");
        } 
    }


    $posts_query= "SELECT * FROM posts";
    $posts_data= mysqli_query($connect, $posts_query);
    $posts_num_rows= mysqli_num_rows($posts_data);

    $admins_query= "SELECT * FROM admin_users";
    $admins_data= mysqli_query($connect, $admins_query);
    $admins_num_rows= mysqli_num_rows($admins_data);

    $categories_query= "SELECT * FROM categories";
    $categories_data= mysqli_query($connect, $categories_query);
    $categories_num_rows= mysqli_num_rows($categories_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Include -->
    <?php include("admin-head.php") ?>
    <title>Dasboard</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/dashboard_style.css" type="text/css">
</head>
<body>

    <?php include("admin-menu.php") ?>
            <h1 class=" text-white mt-4">Dashboard</h1>
            <div class=" row">
                <div class=" col-md-4 p-5">
                    <div class="dashboard-highlight-div">
                        <i class="fa-regular fa-newspaper text-center"></i>
                        <br>
                        <h4 class=" text-center">Total Posts: <?php echo $posts_num_rows ?></h4>
                    </div>
                </div>
                <div class=" col-md-4 p-5">
                    <div class="dashboard-highlight-div">
                        <i class="fa-regular fa-user text-center"></i>
                        <br>
                        <h4 class=" text-center">Total Admins: <?php echo $admins_num_rows ?></h4>
                    </div>
                </div>
                <div class=" col-md-4 p-5">
                    <div class="dashboard-highlight-div">
                        <i class="fa-regular fa-newspaper text-center"></i>
                        <br>
                        <h4 class=" text-center">Categories: <?php echo $categories_num_rows ?></h4>
                    </div>
                </div>
            </div>
        <?php include("admin-menu-end-tags.php") ?>


    <!-- Custom JS File Link -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
    
</body>
</html>