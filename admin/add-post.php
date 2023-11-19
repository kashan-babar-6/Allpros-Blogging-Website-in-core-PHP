<?php

    include("db-connect.php");

    $fields_empty_error="";
    $img_type_error="";
    $img_upload_error="";


    if(isset($_POST['post'])) {
        $title= $_POST['title'];
        $category= $_POST['category'];
        $img_file_name= $_FILES['img_file']['name'];
        $article= $_POST['article'];

        //Fetching author ID from username
        $author_query= "SELECT `user_id` FROM `admin_users` WHERE username ='".$username."'";
        $fetch_data_author_query= mysqli_fetch_array(mysqli_query($connect, $author_query));

        if($title != "" && $category != 0 && $img_file_name != "" && $article != "") {
            $img_type_format= explode("/", $_FILES['img_file']['type'], 2);
            $img_type= $img_type_format[count($img_type_format)-1];

            if($img_type == "jpg " || $img_type == "jpeg" || $img_type == "png") {

                $post_insert_query= "INSERT INTO `posts`(`title`, `post_img`, `category`, `post_date`, `post_views`, `description`, `author_Id_FK`) VALUES ('".$title."','".$img_file_name."','".$category."','".date("Y-m-d")."','0','".$article."','".$fetch_data_author_query['user_id']."')";

                if(mysqli_query($connect, $post_insert_query)) {
                    move_uploaded_file($_FILES['img_file']['tmp_name'], "../imgs/".$img_file_name);

                    $inserted_post_id= mysqli_insert_id($connect);

                    header("Location: open_post.php?post_id=".$inserted_post_id);
                }
                else {
                    $img_upload_error= "*Error: File is not uploaded due to some error";
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
    <title>Add Post</title>

    <!-- Cutom SSS Files --> 
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/add_post_style.css" type="text/css">
</head>
<body>
    
    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>

        <div class=" mt-4">
            <h1 class="text-white">+ Add Post</h1>
        </div>
        <div class=" col-md-12 p-5">
            <form class="post-form pb-5" action="" method="post" enctype="multipart/form-data">
                <label class=" col-form-label-lg" for="">Title: </label>
                <input class=" form-control" type="text" name="title" id="title" placeholder="Enter your title">
                <label class=" col-form-label-lg" for="">Category</label>
                <select class=" form-select" name="category" id="category">
                    <option value="0"> None</option>
                    <?php

                        $all_category_query= "SELECT * FROM categories";
                        $all_category_execute= mysqli_query($connect, $all_category_query);

                        while($rows= mysqli_fetch_array($all_category_execute)) {
                    
                    ?>
                    <option value="<?php echo $rows['category_id'] ?>"><?php echo $rows['category_name'] ?></option>
                    <?php
                        }
                    ?>
                </select>
                <label class=" col-form-label-lg" for="">Upload Post Image: </label>
                <br>
                <input class=" input-field" type="file" name="img_file" id="file">
                <br>
                <span class=" text-danger weight-500">
                    <?php 
                        echo $img_type_error; 
                        echo $img_upload_error; 
                    ?>
                </span>
                <br>
                <label class=" col-form-label-lg" for="">Article: </label>
                <textarea name="article" id="article-field" placeholder="Enter your article here"></textarea>
                <br>
                <span class=" text-danger weight-500"><?php echo $fields_empty_error ?></span>
                <br>
                <button class="btn-post mt-2" type="submit" name="post">Post</button>
            </form>
        </div>



    <?php  include("admin-menu-end-tags.php") ?>

    <!-- Cutom JS File -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
</body>
</html>