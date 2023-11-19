<?php

    include("db-connect.php");


    $all_cat_query= "SELECT * FROM categories";
    $all_cat_execute= mysqli_query($connect, $all_cat_query);
    $serial_no= 1;

    //Error Variables
    $add_cat_empty_error= "";
    $edit_cat_empty_error= "";
    $del_cat_empty_error= "";

    if(isset($_POST['add_cat'])) {
        $category= $_POST['category'];
        if($category != "") {
            $add_cat_query= "INSERT INTO `categories`(`category_name`) VALUES ('".$category."')";
            $add_cat_query_execute= mysqli_query($connect, $add_cat_query);
            header("Location: categories.php");
        }
        else if($category == "") {
            $add_cat_empty_error= "*Error: Please Fill this Field!";
        }
    }

    if(isset($_POST['edit_cat'])) {
        $category= $_POST['present_category'];
        $edit_category= $_POST['edit_category'];
        if($category != 0 && $edit_category != "") {
            $update_cat_query= "UPDATE `categories` SET `category_name`='".$edit_category."' WHERE category_id='".$category."'";

            mysqli_query($connect, $update_cat_query);
            header("Location: categories.php");
        }
        else {
            $edit_cat_empty_error= "*Error: Fill all Fields!";
        }
    }

    if(isset($_POST['del_cat'])) {
        
        $del_category= $_POST['del_category'];
        if($del_category != 0) {
            $del_query= "DELETE FROM `categories` WHERE category_id= '".$del_category."'";
            mysqli_query($connect, $del_query);

            //Deleting All posts associated to the deleted category

            $del_posts_query= "DELETE FROM `posts` WHERE category= '".$del_category."'";
            mysqli_query($connect, $del_posts_query);
            header("Location: categories.php");
        }
        else {
            $del_cat_empty_error= "*Error: Please this Field!";
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Inluce -->
    <?php  include("admin-head.php") ?>

    <title>Categories</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/categories_style.css" type="text/css">
</head>
<body>
    
    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>

    <div class=" col-md-12 mt-4">
        <h1 class=" text-white">All Categories</h1>
        <table class=" table table-striped text-center">
            <tr>
                <th>Sr No.</th>
                <th>Category</th>
                <th>No. of Posts</th>
            </tr>
            <?php
                while($rows= mysqli_fetch_array($all_cat_execute)) {
            ?>
            <tr>
                <td><?php echo $serial_no ?></td>
                <td><?php echo $rows['category_name']?></td>
                <?php
                    $num_post_query= "SELECT * FROM posts WHERE category='".$rows['category_id']."'";
                    $num_posts= mysqli_num_rows(mysqli_query($connect, $num_post_query));
                ?>
                <td><?php echo $num_posts ?></td>
            </tr>
            <?php $serial_no++; } ?>
        </table>
    </div>
    <div class=" col-md-12 mt-4">
        <h3 class="text-white">Add Category</h3>
        <form class=" mt-4 p- add-category-form" action="" method="post">
            <label class=" col-form-label-lg" for="">Category Name: </label>
            <input class=" form-control-lg" type="text" name="category" id="category" placeholder="Enter category name">
            <button class=" btn btn-lg btn-info" type="submit" name="add_cat">Add</button>
            <br>
            <span id="empty-error" class=" text-danger weight-600"><?php echo $add_cat_empty_error ?></span>
        </form>
    </div>
    <form class="edit-category-form" action="" method="post">
        <div class=" row mt-5">
            <h3 class=" text-white">Edit Category</h3>
            <div class=" col-md-4">
                <label class=" col-form-label-lg" for="">Choose Category:</label>
                <select class=" form-select" name="present_category" id="edit-category">
                    <option value="0">None</option>
                    <?php
                        $all_cat_query= "SELECT * FROM categories";
                        $all_cat_execute= mysqli_query($connect, $all_cat_query);
                        while($row= mysqli_fetch_array($all_cat_execute)) {
                    ?>
                    <option value="<?php echo $row['category_id']?>">
                        <?php echo $row['category_name']?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class=" col-md-4">
                <label class=" col-form-label-lg" for="">Edit Name: </label>
                <input class=" form-control" type="text" name="edit_category" id="edit-category-name" placeholder="Edit Category Name">
            </div>
            <div class=" col-md-4">
                <button class=" btn btn-lg mt-3 mt-md-5" type="submit" name="edit_cat">Edit</button>
            </div>
            <br>
            <span id="empty-error" class=" text-danger weight-600"><?php echo $edit_cat_empty_error ?></span>
        </div>
    </form>

    <!-- Delete Category Section -->
    <div class=" col-md-12 mt-5 mb-3">
        <h3 class="text-white">Delete Category</h3>
        <form class=" mt-4 del-category-form" action="" method="post">
            <label class=" col-form-label-lg" for="">Category Name: </label>
            <select class=" form-select-lg" name="del_category" id="del-category">
                <option value="0">None</option>
                <?php
                    $all_cat_query= "SELECT * FROM categories";
                    $all_cat_execute= mysqli_query($connect, $all_cat_query);
                    while($row= mysqli_fetch_array($all_cat_execute)) {
                ?>
                <option value="<?php echo $row['category_id']?>">
                    <?php echo $row['category_name']?>
                </option>
                <?php } ?>
            </select>
            <button class=" btn btn-lg btn-info" type="submit" name="del_cat">Delete</button>
            <br>
            <span id="empty-error" class=" text-danger weight-600"><?php echo $del_cat_empty_error ?></span>
        </form>
    </div>

    <?php  include("admin-menu-end-tags.php") ?>

    <!-- Custom JS File -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JS CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>