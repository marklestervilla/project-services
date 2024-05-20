<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');


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
                        <li class="breadcrumb-item active">Create Project</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php 
    alertMessage();
    ?>

                <div class="card">
                    <div class="card-header">
                        <h4> <i class="fas fa-plus-circle"></i> Create Project
                        <a href="project-index.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-proj.php" method="POST" enctype="multipart/form-data">

                            <div class="col-md-12 mb-3">
                                <label>Select Category:</label>
                                <select name="category_id" class="form-select mySelect2">
                                    <option value="" selected disabled>Select Category</option>
                                    <?php
                                        $categories = getAll('categories');
                                        if($categories){
                                        if(mysqli_num_rows($categories) > 0){
                                            foreach($categories as $cateItem){
                                            echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                            }
                                        }else{
                                            echo '<option value="">No Category Found!</option>';
                                        }
                                        }else{
                                        echo '<option value="">Something went Wrong!</option>';
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="project_name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" name="project_name" id="project_name">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Customer:</label>
                                <select name="customers_id" class="form-select mySelect2">
                                    <option value="" selected disabled>Select Client</option>
                                    <?php
                                        $customers = getAll('customers');
                                        if($customers){
                                        if(mysqli_num_rows($customers) > 0){
                                            foreach($customers as $customers){
                                            echo '<option value="'.$customers['id'].'">'.$customers['name'].'</option>';
                                            }
                                        }else{
                                            echo '<option value="">No Customers Found!</option>';
                                        }
                                        }else{
                                        echo '<option value="">Something went Wrong!</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label for="">Description </label>
                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label for="">Address *</label>
                                    <textarea id="summernote" name="address" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Project Manager</label>
                                <?php
            $available_managers_query = "SELECT * FROM employee WHERE position='Project Manager' AND name NOT IN (SELECT DISTINCT position FROM project)";
            $available_managers_run = mysqli_query($con, $available_managers_query);

            if(mysqli_num_rows($available_managers_run) > 0) {
                ?>
                                <select name="position" required class="form-control">
                                    <option value="" selected disabled>--Select Manager--</option>
                                    <?php
                    foreach($available_managers_run as $manager) {
                        ?>
                                    <option value="<?= $manager['name'] ?>"><?= $manager['name'] ?></option>
                                    <?php
                    }
                    ?>
                                </select>
                                <?php
            } else {
                ?>
                                <option value="" disabled>No Available Project Manager</option>
                                <?php
            }
            ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Project Plan Image *</label>
                                    <input type="file" class="form-control" name="image" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Date Start</label>
                                    <input type="date" name="date_start" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" class="form-control">
                                            <option value="0">Pending</option>
                                            <option value="1">Preparing</option>
                                            <option value="2">On-Progress</option>
                                            <option value="3">Completed</option>
                                            <option value="4">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right" name="saveProject">Save
                                        Project</button>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>


        <?php include('includes/script.php'); ?>
        <link href="path/to/summernote.css" rel="stylesheet">
        <script src="path/to/summernote.js"></script>
        <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        </script>

        <?php include('includes/footer.php'); ?>