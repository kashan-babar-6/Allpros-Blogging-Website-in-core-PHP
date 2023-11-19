<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Head Files Include -->
    <?php include("head.php") ?>

    <title>Search</title>

    <!-- Custom CS Files -->
    <link rel="stylesheet" href="css/menu_style.css" type="text/css">
    <link rel="stylesheet" href="css/footer_style.css" type="text/css">
    <link rel="stylesheet" href="css/search_style.css" type="text/css">
</head>
<body>

    <!-- Navbar File Include -->
    <?php include("menu.php") ?>

    <?php

        $search= $_GET['search'];
        $post_no_found= "";
        $post_data;
        if($search != "") {
            $post_query= "SELECT * FROM posts WHERE title='$search'";
            $post_execute= mysqli_query($connect, $post_query);
            if($post_data= mysqli_fetch_array($post_execute)) {}
            else {
                $post_no_found="No Post Found";
            }
        }
        else {
            $post_no_found="No Post Found";
        }

    ?>

    <div class="container-fluid">
        <div class="row">
            <h1 class="category-heading mt-3">Search: <?php echo $search?></h1>
            <?php
            if($post_no_found == ""){
                $cat_post_query= "SELECT * FROM categories WHERE category_id='".$post_data['category']."'";
                $cat_post_execute= mysqli_query($connect, $cat_post_query);
                while($rows= mysqli_fetch_array($cat_post_execute)) {
            ?>
            <div class="new-article-bg article-image-round p-3 col-sm-6 col-md-3">
                <div class="content-div col-12 bg-light article-image-round">
                    <a href="post.php?post_id=<?php echo $post_data['post_id']?>"><img class=" article-image-round" src="imgs/<?php echo $post_data['post_img']?>" alt="New Article Image" width="100%"></a>
                    <div class=" p-2 mt-2">
                        <?php

                        ?>
                        <span class=" mt-2 text-dark-themed weight-600"><a class=" text-decoration-none text-dark" href="category.php?category_id=<?php echo $rows['category_id']?>"><?php echo $rows['category_name']?></a></span>
                        <h5 class=" mt-2"><a href="post.php?post_id=<?php echo $post_data['post_id']?>" class="new-article-heading  weight-800"><?php echo $post_data['title']?></a></h5>
                        <p class=" text-dark-themed weight-500"><?php echo substr($post_data['description'], 0, 60)?> ... </p>
                        <?php
                            $admin_query= "SELECT full_name, profile_img FROM admin_users WHERE user_id='".$post_data['author_Id_FK']."'";
                            $admin_execute= mysqli_query($connect, $admin_query);
                            while($admin_rows= mysqli_fetch_array($admin_execute)) {
                        ?>
                        <img class=" rounded-circle" src="admin/profiles/<?php echo $admin_rows['profile_img']?>" alt="Author Image" width="40">  <?php echo $admin_rows['full_name']?>
                        <?php } ?>
                        <br>
                    </div>
                </div>
            </div>
            <?php }}?>
        </div>
    </div>

    <!-- Footer File Include -->
    <?php include("footer.php") ?>
    
</body>
</html>