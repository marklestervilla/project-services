<?php
include 'authentication.php';
include 'includes/header.php';
include 'includes/topbar.php';
include 'includes/sidebar.php';
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
                        <li class="breadcrumb-item active">Equip Edit</li>
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
                            <h4>Equipment Edit
                                <a href="equipment.php" class="btn btn-danger float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET['id'] ?? '';
                            $query = "SELECT * FROM equipment WHERE id='$id'";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0) {
                                foreach($query_run as $row) {
                            ?>
                                    <form action="code-proj.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control" />
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Equipment</label>
                                                <input type="file" name="image" class="form-control" />
                                                <input type="hidden" name="image_old" value="<?php echo $row['image']; ?>">
                                                <img src="<?php echo "uploads/".$row['image']; ?>" width="75" alt="Equipment Image">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter Equipment Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Value *</label>
                                                <input type="number" name="value" value="<?php echo $row['value']; ?>" class="form-control" placeholder="Value *" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-6">
                                            <div class="form-group">
                                                <label for="">Note *</label>
                                                <textarea id="summernote" name="note" class="form-control" rows="5"><?php echo $row['note']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="status">Status: </label>
                                                <p>* (Available, Unavailable, Repairing, Used)</p>
                                                <select name="status" class="form-control">
                                                    <option value="0" <?php echo ($row['status'] == '0') ? 'selected' : ''; ?>>Available</option>
                                                    <option value="1" <?php echo ($row['status'] == '1') ? 'selected' : ''; ?>>Unavailable</option>
                                                    <option value="2" <?php echo ($row['status'] == '2') ? 'selected' : ''; ?>>Repairing</option>
                                                    <option value="3" <?php echo ($row['status'] == '3') ? 'selected' : ''; ?>>Used</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" name="updateEquipment" class="btn btn-info float-right">Update Equipment</button>
                                        </div>
                                    </form>
                            <?php
                                }
                            } else {
                                echo "No Data Found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/script.php'; ?>
    <?php include 'includes/footer.php'; ?>
    <link href="path/to/summernote.css" rel="stylesheet">
    <script src="path/to/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
