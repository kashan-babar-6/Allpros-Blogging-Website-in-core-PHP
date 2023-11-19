<?php

    include("db-connect.php");

    $all_user_query= "SELECT * FROM admin_users";
    $all_user_execute= mysqli_query($connect, $all_user_query);
    $serial_No= 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Include -->
    <?php include("admin-head.php") ?>
    <title>Admins Users</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/admin_users_style.css" type="text/css">

</head>
<body>
    
    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>

    <div class=" mt-3">
        <h1 class=" text-white mt-4 d-inline">Admin Users</h1>
        <a class="add-admin-btn text-decoration-none float-end" href="add-admin.php">+ Add New Admin</a>
    </div>
    <div class=" table-responsive mt-5">
        <table class=" col-12 admin_table table table-striped">
            <tr>
                <th>Sr No</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Pic</th>
                <th>No. of Posts</th>
            </tr>
            <?php while($rows= mysqli_fetch_array($all_user_execute)) {
            ?>
            <tr>
                <td><?php echo $serial_No?></td>
                <td><?php echo $rows['username']?></td>
                <td><?php echo $rows['full_name']?></td>
                <td><?php echo $rows['email']?></td>
                <td><img src="profiles/<?php echo $rows['profile_img']?>" alt="Profile" width="75"></td>
                <?php
                    $num_posts_query= "SELECT * FROM posts WHERE author_Id_FK= '".$rows['user_id']."'";
                    $num_posts= mysqli_num_rows(mysqli_query($connect, $num_posts_query));
                ?>
                <td><?php echo $num_posts?></td> 
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Custom JS File Link -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
</body>
</html>