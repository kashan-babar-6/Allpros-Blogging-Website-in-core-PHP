<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllPros</title>
    <!-- Bootstrap CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Montserrat Font Link From Google Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,900&display=swap" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS Code -->
    <link rel="stylesheet" href="css/menu_style.css">
    <link rel="stylesheet" href="css/footer_style.css">
    <link rel="stylesheet" href="css/index_style.css" type="text/css">
</head>
<body>

    <!-- Menu File Included -->
    <?php include("menu.php") ?>

    <?php

        $empty_error= "";
        $post_no_found="";
        $post_data;

        if(isset($_POST['search_btn'])) {
            $search= $_POST['search'];
            if($search != "") {
                header("Location: search.php?search=".$search);
            }
            else {
                $empty_error= "*Error: Please Fill this Field";
            }
        }
    ?>

    <!-- Search Section -->
    <div class=" col-md-6 ms-auto me-auto mt-3 p-3">
        <form action="" method="post">
            <div class=" row p-2">
                <div class=" col-10 p-0">
                    <input class=" form-control p-2 search-input" type="text" name="search" id="" placeholder="Search Articles">
                    <span class=" text-danger"><?php echo $empty_error ?></span>
                </div>
                <div class=" col-2 p-0">
                    <button class=" p-2 search-btn" type="submit" name="search_btn">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Header Article Section -->
    <div class="container-fluid mt-5">
        <div class=" row">
            <div class=" col-sm-12 col-md-8 p-3 trending-div">
                <?php
                    $p_query= "SELECT * from posts ORDER BY post_id DESC LIMIT 1";
                    $p_execute= mysqli_query($connect, $p_query);
                    $p_data= mysqli_fetch_array($p_execute);
                ?>
                <div class="row">
                    <h2 class="trending-heading ms-2">New Article</h2>
                    <div class=" col-sm-4 col-md-4">
                        <a href="post.php?post_id=<?php echo $p_data['post_id'] ?>"><img class=" ms-2 article-image-round" src="imgs/<?php echo $p_data['post_img'] ?>" name="trendImage" alt="Article Image" width="100%"></a>
                    </div>
                    <div class=" col-sm-8 col-md-8">
                        <h3 class=" mt-md-4 mt-sm-2"><a class="article-heading" id="trendHeading" href="post.php?post_id=<?php echo $p_data['post_id'] ?>"><?php echo $p_data['title'] ?></h3>
                        <div>
                            <?php
                                $admin_query= "SELECT full_name, profile_img FROM admin_users WHERE user_id='".$p_data['author_Id_FK']."'";
                                $admin_execute= mysqli_query($connect, $admin_query);
                                $admin_rows= mysqli_fetch_array($admin_execute);
                            ?>
                            <a><img class=" rounded-circle" src="admin/profiles/<?php echo $admin_rows['profile_img']?>" alt="Auhtor Image" width="40px"></a>
                            <span>by <a class=" text-decoration-none text-dark"><?php echo $admin_rows['full_name']?></a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-4 p-2 viewed-article-div d-none d-sm-none d-md-block">
                <h5 class=" text-center mt-3 weight-700 viewed-heading">Most Viewed Article</h5>
                <?php
                    $most_view_query= "SELECT post_id, post_img, title FROM posts ORDER BY post_views DESC LIMIT 2";
                    $most_view_execute= mysqli_query($connect, $most_view_query);
                    while($rows= mysqli_fetch_array($most_view_execute)) {
                ?>
                <div class=" col-12 mt-3">
                    <img class=" article-image-round" src="imgs/<?php echo $rows['post_img']?>" alt="Side Article Image" width="75px">
                    <a class="side-article-heading" href="post.php?post_id=<?php echo $rows['post_id']?>"><?php echo $rows['title']?></a>
                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!-- Articles Section -->
    <div class=" container-fluid new-article-fluid-div mt-4">
        <div class=" row"> 
            <?php
                $new_post_query= "SELECT * FROM posts ORDER BY post_id DESC";
                $new_post_execute= mysqli_query($connect, $new_post_query);
                while($rows= mysqli_fetch_array($new_post_execute)) {
            ?>
            <div class="new-article-bg article-image-round p-3 col-sm-5 col-md-3">
                <div class="content-div col-12 bg-light article-image-round">
                    <a href="post.php?post_id=<?php echo $rows['post_id']?>"><img class=" article-image-round" src="imgs/<?php echo $rows['post_img'] ?>" alt="New Article Image" width="100%"></a>
                    <div class=" p-2 mt-2">
                        <?php
                            $cat_query= "SELECT * FROM categories WHERE category_id='".$rows['category']."'";
                            $cat_execute= mysqli_query($connect, $cat_query);
                            while($cat_rows= mysqli_fetch_array($cat_execute)) {
                        ?>
                        <span class=" mt-2 text-dark-themed weight-600"><a class=" text-decoration-none text-dark" href="category.php?category_id=<?php echo $rows['category'] ?>"><?php echo $cat_rows['category_name'] ?></a></span>
                        <?php } ?>
                        <h5 class=" mt-2"><a href="post.php?post_id=<?php echo $rows['post_id']?>" class="new-article-heading  weight-800"><?php echo $rows['title'] ?></a></h5>
                        <p class=" text-dark-themed weight-500"><?php echo substr($rows['description'], 0, 60) ?> ... </p>
                        <?php
                            $admin_query= "SELECT full_name, profile_img FROM admin_users WHERE user_id='".$rows['author_Id_FK']."'";
                            $admin_execute= mysqli_query($connect, $admin_query);
                            while($admin_rows= mysqli_fetch_array($admin_execute)) {
                        ?>
                        <img class=" rounded-circle" src="admin/profiles/<?php echo $admin_rows['profile_img'] ?>" alt="Author Image" width="40"> <span class="text-black"><?php echo $admin_rows['full_name'] ?></span>
                        <br>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?> 
        </div>
    </div>
    

    <!-- Footer File Included -->
    <?php include("footer.php") ?>

    <!-- Custom Javascript File -->
    <!-- <script src="js/index_js.js"></script> -->

</body>
</html>