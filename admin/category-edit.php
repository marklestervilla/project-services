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
                    <li class="breadcrumb-item active">Edit Category</li>
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
                        <h3 class="card-title">Edit Category</h3>
                        <!-- Back Button -->
                        <a href="category.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php 
                        alertMessage();
                        ?>

                        <div class="col-md-6">
                            <form action="code-pos.php" method="POST">

                            <?php
                            $parmValue = checkParamId('id');
                            if(!is_numeric($parmValue)){
                                echo '<h5>'.$parmValue.'</h5>';
                                return false;
                            }
                            // echo $parmValue;
                            $poscategory = getById('poscategories',$parmValue);
                            if($poscategory['status'] == 200)

                            {

                            ?>

                                <input type="hidden" name="categoryId" value="<?= $poscategory['data']['id']; ?>">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" class="form-control" name="name" value="<?= $poscategory['data']['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="description">Description *</label>
                                            <textarea name="description" class="form-control" rows="3"><?= $poscategory['data']['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="status">Status * (UnChecked=Visible, Checked=Invisible)</label>
                                            <br/>
                                            <input type="checkbox" name="status" <?= $poscategory['data']['status'] == true ? 'checked':'' ; ?> style="width:30px;height:30px;">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="updatePOSCategory" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                else
                                {
                                    echo '<h5>'.$poscategory['message'].'</h5>';
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
