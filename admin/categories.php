<?php
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Modal -->

<!-- Add Category Modal -->
<div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog" aria-labelledby="AddCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddCategoryModalLabel"> <i class="fas fa-plus-circle"></i> Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields here for adding a user -->
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" required rows="3"></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label for="info">Info</label>
                        <input type="checkbox" name="info"> Info
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status"> Status
                    </div> -->

                    <!-- Add more fields as needed -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addCategory" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- //Add Category Modal -->

<!-- // Modal -->

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
                                Category
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#AddCategoryModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Add Category
                                </button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <!-- <th>Info</th>
                          <th>Status</th> -->
                                        <th>Created At</th>
                                        <th>Manage</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        $query = "SELECT * FROM categories";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            foreach($query_run as $categoryitem)
                            {
                                // echo $cateitem['id'];
                                ?>
                                    <tr>
                                        <td><?php echo $categoryitem['id']; ?></td>
                                        <td><?php echo $categoryitem['name']; ?></td>
                                        <!-- <td>
                                          <input type="checkbox" <?php echo $categoryitem['info'] == '1' ? 'checked':'' ?> readonly />
                                        </td>
                                        <td>
                                          <input type="checkbox" <?php echo $categoryitem['status'] == '1' ? 'checked':'' ?> readonly />
                                        </td> -->
                                        <td><?php echo date('M d, Y h:i A', strtotime($categoryitem['created_at'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="categories-edit.php?id=<?php echo $categoryitem['id']; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="category_delete_id"
                                                            value="<?php echo $categoryitem['id']; ?>">
                                                        <button type="submit" name="deleteCategory"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirm('Are you sure you want to delete this category?');">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                            }
                        }
                        else
                        {
                            ?>
                                    <tr>
                                        <td colspan="6">No Record Found.</td>
                                    </tr>
                                    <?php
                        }
                        ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>