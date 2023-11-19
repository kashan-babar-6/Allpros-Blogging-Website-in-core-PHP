<div id="overlay-div" onclick="hideSidebar()"></div>
    <div class=" container-fluid">
        <div class=" row">
            <div id="sidebar" class="sidebar col-md-3 pt-3">
                <div class="col-12 mb-5"><i class=" close-icon d-none fa-solid fa-xmark float-end" onclick="hideSidebar()"></i></div>
                <a class="dashboard-logo text-decoration-none" href="#">Allpros</a>
                <span class=" panel-heading">Admin Panel</span>
                <hr>
                <!-- <a class="sidebar-tab" href="dashboard.php"><div class="side-link-div"><h5>Dashboard</h5></div></a> -->
                <a class="sidebar-tab" href="posts.php"><div class="side-link-div"><h5>Posts</h5></div></a>
                <a class="sidebar-tab" href="categories.php"><div class="side-link-div"><h5>Categories</h5></div></a>
                <a class="sidebar-tab" href="users.php"><div class="side-link-div"><h5>Users</h5></div></a>
                <br>
                <br>
                <hr>
                <a class="sidebar-tab" href="reset-password.php"><div class="side-link-div"><h5>Reset Password</h5></div></a>
                <a class="sidebar-tab" href="logout.php"><div class="side-link-div"><h5>Logout</h5></div></a>
            </div>
            <div id="main-div" class=" col-md-9">
                <div class="col-12 mt-4">
                    <i class="sidebar-icon d-none fa-solid fa-bars" onclick="showSidebar()"></i>
                </div>
