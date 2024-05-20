
<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['auth']))
{
  $_SESSION['status'] = "You are already logged In";
  header('Location: index.php');
  exit(0);
}
?>

<div class="container">
  <div class="row justify-content-end">
    <div class="login-box">

      <div class="login-logo">
        <img src="./images/icon-gbua.jpg" width="50px" height="50px" alt="">
        <a href="../project-customer/customer-index.php"><b>GBUA</b>SERVICES</a>
      </div>

      <link rel="stylesheet" href="./assets/login-style.css">

      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">

          <p class="login-box-msg">Sign in to start your session</p>

          <form action="logincode.php" method="POST">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" id="email" title="Please enter your email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" id="password" title="Please enter your password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="fas fa-eye" id="togglePassword"></i>
                </span>
              </div>
            </div>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <!-- <input type="checkbox" id="remember"> -->
                  <label for="#">
                    <?php
                    if(isset($_SESSION['auth_status'])) {
                      $status = $_SESSION['auth_status'];
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong><i class="fas fa-exclamation-circle"></i></strong> ' . $status . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                      unset($_SESSION['auth_status']); // Clear the status after displaying it
                    }
                    ?>

                    <!-- <?php
                    alertMessage();
                    ?> -->

                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" name="login_btn" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="../project-customer/customer-index.php" class="btn btn-block btn-primary">
                <i class="fas fa-user mr-2"></i> Continue as Customer
            </a>
            <!-- <a href="#" class="btn btn-block btn-danger">
                <i class="fas fa-phone-alt mr-2"></i> Enquire Now!
            </a> -->
          </div>
          <!-- /.social-auth-links -->
<!-- 
          <p class="mb-1">
            <a href="#">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="#" class="text-center">Register a new membership</a>
          </p> -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</div>
<!-- /.login-box -->


<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>