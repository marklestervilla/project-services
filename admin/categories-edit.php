<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php 
                alertMessage();
                ?>

                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit Category
                                <!-- Button trigger modal -->
                                <a href="categories.php" class="btn btn-danger btn-sm float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST">

                                <?php
                                // Debugging the $_GET['id'] parameter
                                // echo "ID: ".$_GET['id']."<br>";

                                if(isset($_GET['id']))
                                {
                                    $category_id = $_GET['id'];
                                    $query = "SELECT * FROM categories WHERE id='$category_id'";
                                    $query_run = mysqli_query($con, $query);

                                    foreach($query_run as $item) :
                                ?>

                                <input type="hidden" name="category_id" value="<?php echo $item['id']; ?>">
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="<?php echo $item['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" required
                                        rows="3"><?php echo $item['description']; ?></textarea>
                                </div>
                                <!-- Add more fields as needed -->
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="addCategoryUpdate" class="btn btn-primary">Update</button>
                        </div>

                        <?php
                    endforeach;
                    }
                    else
                    {
                        echo "no id found";
                    }
                    ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>
</section>


<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>