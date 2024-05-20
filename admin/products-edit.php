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
                    <li class="breadcrumb-item active">Edit Product</li>
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
                        <h3 class="card-title">Edit Product</h3>
                        <!-- Back Button -->
                        <a href="products.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php 
                        alertMessage();
                        ?>
                        <div class="col-md-6">
                            <form action="code-pos.php" method="POST">

                            <?php
                            // Get the product ID from the URL
                            $paramValue = isset($_GET['user_id']) ? $_GET['user_id'] : '';
                            if(!is_numeric($paramValue)){
                                echo '<h5>ID is not an Integer</h5>';
                                return false;
                            }

                            $product = getById('products',$paramValue);
                            if($product)
                            {
                                if($product['status'] == 200)
                                {
                                        ?>
                                 
                                 <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>" />
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="">Select Category:</label>
                                        <select name="category_id" class="form-select">
                                                <?php
                                                $poscategories = getAll('poscategories');
                                                if($poscategories){
                                                    if(mysqli_num_rows($poscategories) > 0){
                                                        foreach($poscategories as $cateItem){
                                                            ?>
                                                            <option 
                                                                value="<?= $cateItem['id']; ?>"
                                                                <?= $product['data']['category_id'] == $cateItem['id'] ? 'selected':''; ?>
                                                                >
                                                                <?= $cateItem['name']; ?>
                                                            </option>
                                                            <?php
                                                            
                                                        }
                                                    }else{
                                                        echo '<option value="">No Categories Found</option>';                                                    }
                                                }else{
                                                    echo '<option value="">Something Went Wrong</option>';
                                                }
                                                ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Product Name *</label>
                                        <input type="text" class="form-control" name="name" value="<?= $product['data']['name']; ?>" required />
                                    </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="description">Description * (Note)</label>
                                        <textarea name="description" class="form-control" rows="3"><?= $product['data']['description']; ?></textarea>
                                    </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Original Price *</label>
                                        <input type="text" class="form-control" name="price" value="<?= $product['data']['price']; ?>" required />
                                    </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Quantity *</label>
                                        <input type="text" class="form-control" name="quantity" value="<?= $product['data']['quantity']; ?>" required />
                                    </div>
                                    </div>
                                    <!-- <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">Image *</label>
                                        <input type="file" name="image" class="form-control" />
                                        <img src="../<?= $product['data']['image']; ?>" style="width:150px;height:150px;"  alt="Product Image"  />
                                    </div>
                                    </div> -->
                                    <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                            <label>Status (UnChecked=Available, Checked=Unavailable)</label>
                                            <br/>
                                            <input type="checkbox" name="status" <?= $product['data']['status'] == true ? 'checked':''; ?> style="width:30px;height:30px;" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="updateProduct" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                else
                                {
                                    echo '<h5>'.$product['message'].'</h5>';
                                    
                                }
                            }
                            else
                            {
                                echo '<h5>Something Went Wrong</h5>';
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
