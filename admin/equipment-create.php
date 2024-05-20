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
                        <li class="breadcrumb-item active">Equip Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    alertMessage();
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4> <i class="fas fa-plus-circle"></i> Add Equipment
                                <a href="equipment.php" class="btn btn-danger float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code-proj.php" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Equipment</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Equipment Name" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Value</label>
                                        <input type="number" name="value" class="form-control" placeholder="Value *" />
                                    </div>
                                </div>
                                <div class="col-md-12 mb-6">
                                    <div class="form-group">
                                        <label for="">Note *</label>
                                        <textarea id="summernote" name="description" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="0">Available</option>
                                            <option value="1">Unavailable</option>
                                            <option value="2">Repairing</option>
                                            <option value="3">Used</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="saveEquipment" class="btn btn-primary float-right">Add Equipment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>
    <link href="path/to/summernote.css" rel="stylesheet">
    <script src="path/to/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
