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
                    <li class="breadcrumb-item active">Edit Customer</li>
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
                        <h3 class="card-title">Edit Customer</h3>
                        <!-- Back Button -->
                        <a href="customers.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php 
                        alertMessage();
                        ?>

                        <div class="col-md-6">
                            <form action="code-pos.php" method="POST">

                            <?php
                                $paramValue = checkParamId('id');
                                if(!is_numeric($paramValue)){
                                    echo '<h5>'.$paramValue.'</h5>';
                                    return false;
                                }
                                
                                $customer = getById('customers', $paramValue);
                                if($customer['status'] == 200)
                                {
                                    ?>

                                    <input type="hidden" name="customerId" value="<?= $customer['data']['id']; ?>" />

                                    <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" value="<?= $customer['data']['name']; ?>" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="<?= $customer['data']['email']; ?>" name="email" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" value="<?= $customer['data']['phone']; ?>" name="phone" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="status">Status * (UnChecked=CashPayment, Checked=OnlinePayment)</label>
                                            <br/>
                                            <input type="checkbox" name="status" <?= $customer['data']['status'] == true ? 'checked':''; ?> style="width:30px;height:30px;">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="updateCustomer" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                                }
                                else
                                {
                                    echo '<h5>'.$customer['message'].'</h5>';
                                    return false;
                                }
                            ?>

                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
