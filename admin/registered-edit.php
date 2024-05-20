<?php
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit - Registered User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit - Registered User</h3>
                            <!-- Back Button -->
                            <a href="registered.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="code.php" method="POST">
                                        <?php
                                    if(isset($_GET['user_id']))
                                    {
                                        $user_id = $_GET['user_id'];
                                        $query ="SELECT * FROM users WHERE id='$user_id' LIMIT 1 ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                        ?>
                                        <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                        <div class="form-group">
                                            <label for="username">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="<?php echo $row['name'] ?>" placeholder="Enter Fullname">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo $row['email'] ?>" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone No.</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="<?php echo $row['phone'] ?>" placeholder="Enter Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                value="<?php echo $row['password'] ?>" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Give Role</label>
                                            <select name="role_as" class="form-control" required>
                                                <option value="">-- Select Option --</option>
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                                <!-- <option value="2">Staff</option> -->
                                            </select>
                                        </div>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "<h4>No Record Found.!</h4>";
                                        }
                                    }
                                    
                                    ?>

                                        <!-- Add more fields as needed -->
                                        <div class="modal-footer">
                                            <button type="submit" name="updateUser" class="btn btn-info">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>