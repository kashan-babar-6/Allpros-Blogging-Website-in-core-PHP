<?php

    include("db-connect.php");

    $admin_data_query= "SELECT * FROM admin_users WHERE username='$username'";
    $admin_data_execute= mysqli_query($connect, $admin_data_query);
    $fetch_admin_data= mysqli_fetch_array($admin_data_execute);

    $empty_field_error= "";

    if(isset($_POST['reset'])) {
        $o_pass= $_POST['o_password'];
        $n_pass= $_POST['n_password'];

        if($o_pass == "" || $n_pass == "") {
            $empty_field_error= "*Error: Please Fill all Fields";
        }
        if($o_pass == $fetch_admin_data['password'] && $n_pass != "") {
                $pass_update_query= "UPDATE `admin_users` SET `password`='$n_pass' WHERE username= '$username'";
                mysqli_query($connect, $pass_update_query);
                header("Location: users.php");
        }
        else if($o_pass != $fetch_admin_data['password'] && $n_pass != "") {
                $empty_field_error= "*Error: Old Password is incorrect";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head File Inluce -->
    <?php  include("admin-head.php") ?>

    <title>Reset Password</title>
    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/reset-password-style.css" type="text/css">

</head>
<body>

    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>

    <div class=" col-md-12 mt-4">
        <h1 class=" text-white">Reset Password</h1>
    </div>
    <div class=" col-md-12 p-5">
        <form class="reset-pass-form pb-5" action="" method="post">
            <label class=" col-form-label-lg" for="">Old Password: </label>
            <input class=" form-control" type="text" name="o_password" id="o-password" placeholder="Enter Old Password">
            <span class=" text-danger weight-600"></span>
            <br>
            <label class=" col-form-label-lg" for="">New Password: </label>
            <input class=" form-control" type="text" name="n_password" id="n-password" placeholder="Enter New Password">
            <span class=" text-danger weight-600"><?php echo $empty_field_error ?></span>
            <br>
            <button class="reset-btn mt-2" type="submit" name="reset">Reset</button>

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