<?php

    $connect= mysqli_connect("localhost", "root", "", "allpros_db");
    if(!$connect) {
        print_r("Database not Connected");
    }

?>

<!-- Footer Section -->
<div class=" col-12 footer-bg p-4 mt-4">
    <div class=" row">
        <div class=" col-md-4">
            <a class="footer-logo" href="index.php  ">Allpros</a>
            <p class="footer-desc">This is a bloging website developed in core PHP.</p>
        </div>
        <div class=" col-md-4 d-sm-none d-none d-md-block">
            <h5 class=" weight-600 text-white text-center">Top Categories</h5>
            <ul class="footer-list text-center list-unstyled mt-3">
                <?php
                    $all_cat_query= "SELECT * FROM categories";
                    $all_cat_execute= mysqli_query($connect, $all_cat_query);
                    while($rows= mysqli_fetch_array($all_cat_execute)) {
                ?>
                <li class=" mt-2"><a class=" text-white text-decoration-none" href="category.php?category_id=<?php echo $rows['category_id']?>"><?php echo $rows['category_name']?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class=" col-md-4">
            
        </div>
    </div>
</div>


    <!-- Bootstrap JS Bundle Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

