
<?php

include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Fetch the uploaded project from the database with category names

$sql = "SELECT project.*, categories.name AS category_name 
        FROM project 
        JOIN categories ON project.category_id = categories.id";
$result = $con->query($sql);
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
                        <li class="breadcrumb-item active">Edit Project</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php alertMessage(); ?>
                
            <div class="card">
                <div class="card-header">
                    <h4>Edit Project</h4>
                    <a href="project-index.php" class="btn btn-danger float-right">Back</a>
                </div>
                <div class="card-body">

                <?php

                    $con = mysqli_connect("localhost", "root", "","project_system");
                    $id = $_GET['proj_id'];
                    $project_query = "SELECT * FROM project WHERE id='$id'";
                    $project_query_run = mysqli_query($con, $project_query);

                    if(mysqli_num_rows($project_query_run) > 0)
                    {
                        foreach($project_query_run as $row)
                        {
                            // echo $row['id'];
                            ?>
                            <form action="code-proj.php" method="POST" enctype="multipart/form-data">

                            <div class="col-md-2 mb-3">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Select Category:</label>
                                <select name="category_id" class="form-select mySelect2" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <?php
                                    $categories = getAll('categories');
                                    if($categories){
                                        if(mysqli_num_rows($categories) > 0){
                                            foreach($categories as $cateItem){
                                                echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                            }
                                        } else {
                                            echo '<option value="">No Category Found!</option>';
                                        }
                                    } else {
                                        echo '<option value="">Something went Wrong!</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="project_name" class="form-label">Project Name</label>
                                        <input type="text"  class="form-control" name="project_name" value="<?php echo $row['project_name']; ?>" id="project_name">
                                    </div>
                                </div> 

                                <div class="col-md-12 mb-6">
                                    <div class="form-group">
                                        <label for="">Description </label>
                                        <textarea name="description" class="form-control" rows="5"><?php echo $row['description']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-6">
                                    <div class="form-group">
                                        <label for="">Address *</label>
                                        <textarea id="summernote" name="address" class="form-control" rows="5"><?php echo $row['address']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Project Manager</label>
                                    <?php
                                    $available_managers_query = "SELECT * FROM employee WHERE position='Project Manager' AND name NOT IN (SELECT DISTINCT position FROM project)";
                                    $available_managers_run = mysqli_query($con, $available_managers_query);

                                    if(mysqli_num_rows($available_managers_run) > 0) {
                                        ?>
                                        <select name="project_manager" class="form-control" required>
                                            <option value="" disabled>--Select Manager--</option>
                                            <?php
                                            foreach($available_managers_run as $manager) {
                                                $selected = ($manager['name'] == $row['position']) ? "selected" : "";
                                                ?>
                                                <option value="<?= $manager['name'] ?>" <?= $selected ?>><?= $manager['name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    } else {
                                        ?>
                                        <select name="project_manager" class="form-control" disabled>
                                            <option value="" disabled>No Available Project Manager</option>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Project Plan Image *</label>
                                        <input type="file" class="form-control" name="image" required />
                                        <div class="col-md-6 mb-3">
                                        <img src="<?php echo "uploads_file/".$row['image']; ?>" width="100" height="100" alt="Project Plan Image">
                                </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Date Start</label>
                                        <input type="date" name="date_start" value="<?php echo $row['date_start']; ?>" class="form-control" />
                                    </div>
                                </div>  

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Due Date</label>
                                        <input type="date" name="due_date" value="<?php echo $row['due_date']; ?>" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" class="form-control" value="<?php echo $row['status']; ?>">
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
                                    <button type="submit" class="btn btn-primary float-right" name="updateProject">Update Project</button>
                                    </div>
                                </div>

                                </form>
                            <?php
                        }
                    }
                    else
                    {
                        echo "No Data Found";
                    }

                ?>

                
                </div>
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
