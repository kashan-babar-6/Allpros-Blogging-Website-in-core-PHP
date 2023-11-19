<?php

    include("db-connect.php");

    //Error variables
    $f_name_error= "";
    $u_name_error= "";
    $email_error= "";
    $dob_error= "";
    $gender_error="";
    $pass_error= "";
    $c_pass_error= "";
    $profile_error= "";

    if(isset($_POST['add'])) {
        //value variables
        $f_name= $_POST['f_name'];
        $u_name= $_POST['username'];
        $email= $_POST['email'];
        $dob= $_POST['dob'];
        if(!isset($_POST['gender'])) {
            $gender_error= "Error: Please Fill this Field";
        }
        else {
            $gender= $_POST['gender'];
        }
        $password= $_POST['password'];
        $c_password= $_POST['c_password'];
        $img_file= $_FILES['img_file']['name'];

        // Error Handling

        if($f_name == "") {
            $f_name_error= "*Error: Please Fill this Field";
        }
        if($u_name == "") {
            $u_name_error= "*Error: Please Fill this Field";
        }
        else {

            $username_match_signal= false;

            $all_user_query= "SELECT * FROM admin_users";
            $all_user_execute= mysqli_query($connect, $all_user_query);
            while($rows= mysqli_fetch_array($all_user_execute)) {
                if($u_name == $rows['username']) {
                    $username_match_signal= true;
                }
            }
            if($username_match_signal == true) {
                $u_name_error= "*Error: Username is already taken";
            }

        }
        if($email == "") {
            $email_error= "*Error: Please Fill this Field";
        }
        else {

            $email_match_signal= false;

            $all_user_query= "SELECT * FROM admin_users";
            $all_user_execute= mysqli_query($connect, $all_user_query);
            while($rows= mysqli_fetch_array($all_user_execute)) {
                if($email == $rows['email']) {
                    $email_match_signal= true;
                }
            }
            if($email_match_signal == true) {
                $email_error= "*Error: Email is already in use";
            }

        }
        if($dob == "") {
            $dob_error= "*Error: Please Fill this Field";
        }
        if($password == "") {
            $pass_error= "*Error: Please Fill this Field";
        }
        if($c_password == "") {
            $c_pass_error= "*Error: Please Fill this Field";
        }
        if($password != $c_password) {
            $c_pass_error= "*Error: Passwords do not match";
        }
        if($img_file == "") {
            $profile_error= "*Error: Please Fill this Field";
        }
        else {

            $img_file_type= explode("/", $_FILES['img_file']['type'], 2);
            $img_file_type= $img_file_type[1];
            if($img_file_type != "png" && $img_file_type != "jpg" && $img_file_type != "jpeg") {
                $profile_error="*Error: Image file is not valid";
            }

        }
        if($f_name_error == "" && $u_name_error == "" && $email_error == "" && $dob_error == "" && $gender_error == "" && $pass_error == "" && $c_pass_error == "" && $profile_error == "") {

            $insert_query= "INSERT INTO `admin_users`(`full_name`, `username`, `email`, `dob`, `gender`, `password`, `profile_img`) VALUES ('$f_name','$u_name','$email','$dob','$gender','$password','$img_file')";

            if(mysqli_query($connect, $insert_query)) {
                move_uploaded_file($_FILES['img_file']['tmp_name'], "profiles/".$img_file);
                header("Location: users.php");
            }
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Head File Include -->
    <?php include("admin-head.php") ?>
    <title>Add Admin</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="css/basic-setup.css" type="text/css">
    <link rel="stylesheet" href="css/admin_menu.css" type="text/css">
    <link rel="stylesheet" href="css/add_admin_style.css" type="text/css">

</head>
<body>

    <!-- Menu File Include -->
    <?php include("admin-menu.php") ?>

        <div class=" mt-4">
            <h1 class="text-white">+ Add Admin</h1>
        </div>
        <div class=" col-md-12 p-5">
            <form class="user-form pb-5" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                <label class=" col-form-label-lg" for="">Full Name: </label>
                <input class=" form-control" type="text" name="f_name" id="f-name" placeholder="Enter your title">
                <span id="name-error" class=" text-danger"><?php echo $f_name_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Username:</label>
                <input class=" form-control" type="text" name="username" id="username" placeholder="Enter username">
                <span id="username-error" class=" text-danger"><?php echo $u_name_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Email:</label>
                <input class=" form-control" type="email" name="email" id="email" placeholder="Enter Email">
                <span id="email-error" class=" text-danger"><?php echo $email_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Date of Birth:</label>
                <input class=" form-control" type="date" name="dob" id="dob" placeholder="Enter Date of Birth">
                <span id="dob-error" class=" text-danger"><?php echo $dob_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Gender:</label>
                <input class="ms-3" type="radio" name="gender" value="M"> <span class="radio-text">Male</span>
                <input class="ms-3" type="radio" name="gender" value="F"> <span class="radio-text">Female</span>
                <br>
                <span id="gender-error" class=" text-danger"><?php echo $gender_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Password:</label>
                <input class=" form-control" type="password" name="password" id="password" placeholder="Enter Password">
                <span id="pass-error" class=" text-danger"><?php echo $pass_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Confirm Password:</label>
                <input class=" form-control" type="password" name="c_password" id="c-password" placeholder="Enter Confirm Password">
                <span id="cpass-error" class=" text-danger"><?php echo $c_pass_error?></span>
                <br>
                <label class=" col-form-label-lg" for="">Upload Image:</label>
                <input class=" input-field form-control" type="file" name="img_file" id="img-file">
                <span id="profile-error" class=" text-danger"><?php echo $profile_error?></span>
                <br>
                <button id="add-btn-php" class="btn-add mt-2 d-none" type="submit" name="add">Add</button>
                <button class="btn-add mt-2" name="add" onclick="validate()">Add</button>
            </form>
        </div>

    <?php  include("admin-menu-end-tags.php") ?>

    <!-- Custom JS File Link -->
    <script src="js/admin-menu.js"></script>
    <script src="js/add-admin.js"></script>

    <!-- Fonts Awsome CDN Link -->
    <!-- <script src="https://kit.fontawesome.com/884a0966ea.js" crossorigin="anonymous"></script> -->
    <script src="js/font-awsome.js" crossorigin="anonymous"></script>
    
</body>
</html>