<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php") ?>
    
    <title>Post</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/menu_style.css" type="text/css">
    <link rel="stylesheet" href="css/footer_style.css" type="text/css">
    <link rel="stylesheet" href="css/post_style.css" type="text/css">

</head>
<body>

    <!-- Menu File Included -->
    <?php include("menu.php") ?>

    <?php
        $post_id= $_GET['post_id'];
        $post_query= "SELECT * FROM posts WHERE post_id='$post_id'";
        $post_execute= mysqli_query($connect, $post_query);
        $post_data= mysqli_fetch_array($post_execute);

        $count_views= $post_data['post_views'];
        $view_query= "UPDATE `posts` SET `post_views`='".($count_views+1)."' WHERE post_id='".$post_data['post_id']."'";
        $view_execute= mysqli_query($connect, $view_query);
    ?>

    <!-- Post Section -->
    <div class=" container-fluid mt-5">
        <div class=" row">
            <div class=" col-md-12 p-4">
                <h1 class=" post-heading"><?php echo $post_data['title'] ?></h1>
                <?php
                    $cat_query= "SELECT * FROM categories WHERE category_id='".$post_data['category']."'";
                    $cat_execute= mysqli_query($connect, $cat_query);
                    $cat_data= mysqli_fetch_array($cat_execute);
                ?>
                <span><a class=" text-decoration-none post-category" href="category.php?category_id=<?php echo $cat_data['category_id'] ?>"><?php echo $cat_data['category_name'] ?> </a></span><span class=" text-white post-date"> | <?php echo $post_data['post_date'] ?></span>
                <br>
                <img class=" mt-4" src="imgs/<?php echo $post_data['post_img'] ?>" alt="Main Article Image" width="70%">
                <p class=" post-paragraph mt-3">
                    <?php echo $post_data['description'] ?>
                </p>
                <hr style="color: orange;">
            </div>
            
        </div>
    </div>

    <!-- Footer File Included -->
    <?php include("footer.php") ?>
    
</body>
</html>