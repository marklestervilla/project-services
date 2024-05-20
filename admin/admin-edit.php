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
                        <h3 class="card-title">Edit - Admin</h3>
                        <!-- Back Button -->
                        <a href="admin.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                            <?php 
                            alertMessage();
                           
                            ?>
                        
                            <div class="col-md-6">
                                <form action="code-pos.php" method="POST">

                                <?php
                                if(isset($_GET['id']))
                                {
                                    if($_GET['id'] != ''){

                                        $adminId = $_GET['id'];

                                    }else{
                                        echo '<h5>No ID Found</h5>';
                                        return false;
                                    }
                                } 
                                else
                                {
                                    echo '<h5>No ID Given in params</h5>';
                                    return false;
                                }

                                    $adminData = getById('admins', $adminId);
                                    if($adminData)
                                    {
                                        if($adminData['status'] == 200)
                                        {
                                            ?>
                                            
                                  <input type="hidden" name="adminId" value="<?= $adminData['data']['id'] ?>">          

                                 <div class="row">
                                    <div class="col-md-6">
                                 <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" class="form-control" name="name" required value="<?= $adminData['data']['name'] ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" class="form-control" name="email" required value="<?= $adminData['data']['email'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password *</label>
                                                <input type="password" class="form-control" name="password" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone No *</label>
                                                <input type="number" class="form-control" name="phone" required value="<?= $adminData['data']['phone'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" style="width:30px;height:30px;"  name="is_ban" <?= $adminData['data']['is_ban'] ? 'checked' : '' ?> id="is_ban">
                                                    <br>
                                                    <label class="form-check-label" for="is_ban"> -- Is Banned</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" name="updateAdmin" class="btn btn-info">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            echo '<h5>'.$adminData['message'].'</h5>';
                                        }
                                    }
                                    else
                                    {
                                        echo 'Something Went Wrong!';
                                        return false;
                                    }
                                ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
