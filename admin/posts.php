<?php

    include("db-connect.php");

    $posts_query= "SELECT * FROM posts";
    $posts_data= mysqli_query($connect, $posts_query);
    $posts_num_rows= mysqli_num_rows($posts_data);

    $serial_no= 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Include -->
    <?php include("admin-head.php") ?>
    <title>Posts</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/posts_style.css" type="text/css">

</head>
<body>

    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>


        <div class=" mt-3">
            <h1 class=" text-white mt-4 d-inline">Posts</h1>
            <a class="add-post-btn text-decoration-none float-end" href="add-post.php">+ Add New Posts</a>
        </div>
        <div class=" table-responsive mt-5">
            <table class=" col-12 post-table table table-striped">
                <tr>
                    <th>Sr No</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
                <?php
                    while($rows= mysqli_fetch_array($posts_data)) {

                        $author_query= "SELECT full_name FROM admin_users WHERE user_id=".$rows['author_Id_FK'];
                        $author_data= mysqli_query($connect, $author_query);
                        $author_fetched_data= mysqli_fetch_array($author_data);
                ?>
                <tr>
                    <td><?php echo $serial_no ?></td>
                    <td><?php echo $rows['title'] ?></td>
                    <td><?php echo $rows['post_date'] ?></td>
                    <td><?php echo $rows['post_views'] ?></td>
                    <td><?php echo $author_fetched_data['full_name'] ?></td>
                    <td>
                        <a href="open_post.php?post_id=<?php echo $rows['post_id'] ?>" class="btn btn-info">Open</a>
                    </td> 
                </tr>
                <?php $serial_no++; } ?>
            </table>
        </div>

    <?php  include("admin-menu-end-tags.php") ?>
    
    
    <!-- Custom JS File -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
</body>
</html>