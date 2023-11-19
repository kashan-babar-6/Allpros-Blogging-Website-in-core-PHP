<?php

    include("db-connect.php");

    //Fetching post data
    $post_id= $_GET['post_id'];
    if($post_id == "") {
        header("Location: posts.php");
    }
    $post_query= "SELECT * From posts WHERE post_id= $post_id";
    $post_data= mysqli_query($connect, $post_query);
    $post_fetch_data= mysqli_fetch_array($post_data);

    // Fetching catrgory name thorugh ID
    $category_query= "SELECT category_name FROM categories WHERE category_id=".$post_fetch_data['category'];
    $category_fetch_data= mysqli_fetch_array(mysqli_query($connect, $category_query));

    if(isset($_POST['delete_post'])) {
        $post_del_query= "DELETE FROM posts WHERE post_id= $post_id";
        if(mysqli_query($connect, $post_del_query)) {
            unlink("../imgs/".$post_fetch_data['post_img']);
            header("Location: posts.php");
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Inlcude -->
    <?php include("admin-head.php") ?>
    <title>Document</title>

    <!-- Cutom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/open_post.css" type="text/css">

</head>
<body>
    
    <?php include("admin-menu.php") ?>

    <div class=" mt-4">
        <h1 class=" text-white d-inline float-start">Open Post</h1>
        <button class="del-btn float-end text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
        <a class="edit-btn float-end text-decoration-none" href="edit-post.php?post_id=<?php echo $post_id ?>">Edit Post</a>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete this post?
                    <br><br>
                    <span class="text-danger">Note: You can't recover it in the future.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <form action="" method="post">
                        <button type="submit" class="modal-del-btn" name="delete_post" value="del">Delete</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" clearfix"></div>
    <div class=" col-md-12 mt-5 p-5">
        <h1 class=" weight-800 post-heading"><?php echo $post_fetch_data['title'] ?></h1>
        <span class="post-category"><?php echo $category_fetch_data['category_name'] ?></span>
        <span class=" text-white post-date"> | <?php echo $post_fetch_data['post_date'] ?> </span>
        <span class=" post-date text-white"> | <i class="fa-regular fa-eye"></i> <?php echo $post_fetch_data['post_views'] ?></span>
        <br>
        <img class=" mt-2" src="../imgs/<?php echo $post_fetch_data['post_img'] ?>" alt="Article Image" width="60%">
        <p class=" post-paragraph mt-3">
            <?php echo $post_fetch_data['description'] ?>
        </p>
    </div>

    <?php include("admin-menu-end-tags.php") ?>

    <!-- Cutom JS Fele -->
    <script src="js/admin-menu.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JS CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>