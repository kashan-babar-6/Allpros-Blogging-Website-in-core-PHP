<?php

    $connect= mysqli_connect("localhost", "root", "", "allpros_db");
    if(!$connect) {
        print_r("Database not Connected");
    }

?>

<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg p-3">
        <div class="container-fluid">
            <a class="navbar-brand menu-logo" href="index.php">Allpros</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-word">Menu</span>
            </button>
        
            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                        $all_cat_query= "SELECT * FROM categories";
                        $all_cat_execute= mysqli_query($connect, $all_cat_query);
                        while($rows= mysqli_fetch_array($all_cat_execute)) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="category.php?category_id=<?php echo $rows['category_id']?>"><?php echo $rows['category_name'] ?></a>
                    </li>
                    <?php } ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link mx-2" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Company
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Blog</a></li>
                            <li><a class="dropdown-item" href="#">About Us</a></li>
                            <li><a class="dropdown-item" href="#">Contact us</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>