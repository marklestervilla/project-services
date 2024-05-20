<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li> -->
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->

       <!-- Right navbar links -->
<li class="nav-item dropdown">
    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        class="nav-link dropdown-toggle btn btn-outline-secondary">
        <?php 
            if(isset($_SESSION['auth']))
            {
                echo $_SESSION['auth_user']['user_name']; 
            }
            else
            {
                echo "Not Logged In.";
            }
        ?>
    </a>
    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <!-- <li>
            <a href="#" class="dropdown-item"><i class="fas fa-cog mr-2"></i>Profile</a>
        </li> -->
        <form action="code.php" method="POST">
            <li>
                <button type="submit" name="logout_btn" class="dropdown-item btn btn-outline-secondary"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
            </li>
        </form>
    </ul>
</li>


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>

</nav>
<!-- /.navbar -->