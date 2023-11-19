<?php

    include("db-connect.php");

    $post_id= $_GET['post_id'];
    if($post_id == "") {
        header("Location: posts.php");
    }

    $fields_empty_error="";
    $img_type_error="";
    $img_upload_error="";

    // Fetching post data
    $post_query= "SELECT * FROM posts WHERE post_id= '".$post_id."'";
    $fetch_post_data= mysqli_fetch_array(mysqli_query($connect, $post_query));

    if(isset($_POST['edit_post'])) {

        $title= $_POST['title'];
        $category= $_POST['category'];
        $img_file_name= $_FILES['img_file']['name'];
        $article= $_POST['article'];

        if($title != "" && $article != "") {
            $img_type_format= explode("/", $_FILES['img_file']['type'], 2);
            $img_type= $img_type_format[count($img_type_format)-1];

            if($img_type == "jpg " || $img_type == "jpeg" || $img_type == "png" || $img_file_name== "") {
                
                if($img_file_name != "") {
                    $post_update_query= "UPDATE `posts` SET `title`='".$title."',`post_img`='".$img_file_name."',`category`='".$category."',`description`='".$article."' WHERE post_id= '".$post_id."'";

                    if(mysqli_query($connect, $post_update_query)) {
                        unlink("../imgs/".$fetch_post_data['post_img']);
                        move_uploaded_file($_FILES['img_file']['tmp_name'], "../imgs/".$img_file_name);
    
                        header("Location: open_post.php?post_id=".$post_id);
                    }
                    else {
                        $img_upload_error= "*Error: File is not uploaded due to some error";
                    }

                }
                else if($img_file_name == "") {
                    $post_update_query= "UPDATE `posts` SET `title`='".$title."',`category`='".$category."',`description`='".$article."' WHERE post_id= '".$post_id."'";

                    mysqli_query($connect, $post_update_query);
                    header("Location: open_post.php?post_id=".$post_id);
                }


            }
            else {
                $img_type_error="*Error: Image type is not valid";
            }
        }
        else {
            $fields_empty_error= "! Error: Please Fill all Fields!";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Include -->
    <?php include("admin-head.php") ?>
    <title>Edit Post</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/edit_post_style.css" type="text/css">

</head>
<body>


    <?php include("admin-menu.php") ?>

    <div class=" mt-4">
        <h1 class=" text-white">Edit Post</h1>
    </div>
    <div class=" col-md-12 p-5">
            <form class="post-form pb-5" action="" method="post" enctype="multipart/form-data">
                <label class=" col-form-label-lg" for="">Title: </label>
                <input class=" form-control" type="text" name="title" id="title" placeholder="Enter your title" value="<?php echo $fetch_post_data['title'] ?>">
                <label class=" col-form-label-lg" for="">Category:</label>
                <select class=" form-select" name="category" id="category">
                    <?php
                        $categories_query= "SELECT * FROM categories";
                        $categories_query_execute= mysqli_query($connect, $categories_query);

                        while($rows= mysqli_fetch_array($categories_query_execute)) {
                    ?>
                    <option value="<?php echo $rows['category_id']?>" <?php if($rows['category_id'] == $fetch_post_data['category']) echo "selected"?>><?php echo $rows['category_name']?></option>
                    <?php
                        }
                    ?>
                </select>
                <div class=" col-md-6 mt-4">
                    <label class=" col-form-label-lg" for="">Post Image:</label>
                    <img src="../imgs/<?php echo $fetch_post_data['post_img'] ?>" alt="" width="300">
                </div>
                <label class=" col-form-label-lg mt-2" for="">Upload New Post Image: </label>
                <br>
                <input class=" input-field" type="file" name="img_file" id="file" value="1.jpg">
                <br>
                <span class=" text-danger weight-500">
                    <?php 
                        echo $img_type_error; 
                        echo $img_upload_error; 
                    ?>
                </span>
                <br>
                <label class=" col-form-label-lg" for="">Article: </label>
                <textarea name="article" id="article-field" placeholder="Enter your article here"><?php echo $fetch_post_data['description'] ?></textarea>
                <br>
                <span class=" text-danger weight-500"><?php echo $fields_empty_error ?></span>
                <br>
                <button class="btn-post mt-2" type="submit" name="edit_post">Post</button>
            </form>
        </div>

    <?php include("admin-menu-end-tags.php") ?>

    <!-- Cutom JS Fele -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
    
</body>
</html>