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
                        <li class="breadcrumb-item active">Employee Edit</li>
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
                            <h4>Employee Edit
                                <a href="employee.php" class="btn btn-danger float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET['id'] ?? '';
                            $query = "SELECT * FROM employee WHERE id='$id'";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0) {
                                foreach($query_run as $row) {
                            ?>
                                    <form action="code-proj.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control" />
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Profile</label>
                                                <input type="file" name="image" class="form-control" />
                                                <input type="hidden" name="image_old" value="<?php echo $row['image']; ?>">
                                                <img src="<?php echo "uploads_emp/".$row['image']; ?>" width="75" alt="Employee Image">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter Employee Name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Age</label>
                                                <input type="number" name="age" value="<?php echo $row['age']; ?>" class="form-control" placeholder="Age" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Email *</label>
                                                <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Email" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Contact No. *</label>
                                                <input type="number" name="contact" value="<?php echo $row['contact']; ?>" class="form-control" placeholder="Contact No." />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-6">
                                            <div class="form-group">
                                                <label for="">Address *</label>
                                                <textarea id="summernote" name="address" class="form-control" rows="5"><?php echo $row['address']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                        <label for="">Role *</label>
                                            <select name="position" class="form-control" required >
                                                <option value="">--Select Role--</option>
                                                <option value="Worker" <?php if ($row['position'] == 'Worker') echo 'selected'; ?>>Worker</option>
                                                <option value="Foreman" <?php if ($row['position'] == 'Foreman') echo 'selected'; ?>>Foreman</option>
                                                <option value="Project Manager" <?php if ($row['position'] == 'Project Manager') echo 'selected'; ?>>Project Manager</option>
                                                <option value="Electrician Engr" <?php if ($row['position'] == 'Electrician Engr') echo 'selected'; ?>>Electrician Engineer</option>
                                                <option value="Electrical Tech" <?php if ($row['position'] == 'Electrical Tech') echo 'selected'; ?>>Electrical Technician</option>
                                                <option value="Mechanical Engr" <?php if ($row['position'] == 'Mechanical Engr') echo 'selected'; ?>>Mechanical Engr</option>
                                                <option value="HR Manager" <?php if ($row['position'] == 'HR Manager') echo 'selected'; ?>>HR Manager</option>
                                                <option value="Accountant" <?php if ($row['position'] == 'Accountant') echo 'selected'; ?>>Accountant</option>
                                                <option value="Acct. Staff" <?php if ($row['position'] == 'Acct. Staff') echo 'selected'; ?>>Acct. Staff</option>
                                                <option value="Architect" <?php if ($row['position'] == 'Architect') echo 'selected'; ?>>Architect</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="status">Status:</label>
                                                <select name="status" class="form-control">
                                                    <option value="0" <?php echo ($row['status'] == '0') ? 'selected' : ''; ?>>Available</option>
                                                    <option value="1" <?php echo ($row['status'] == '1') ? 'selected' : ''; ?>>Unavailable</option>
                                                    <option value="2" <?php echo ($row['status'] == '2') ? 'selected' : ''; ?>>On Leave</option>
                                                    <option value="3" <?php echo ($row['status'] == '3') ? 'selected' : ''; ?>>On Duty</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" name="updateEmployee" class="btn btn-info float-right">Update Employee</button>
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
