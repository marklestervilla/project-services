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

            <?php 
        alertMessage();
        ?>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Productivity Edit</li>
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
                            <h4>Productivity Edit
                                <a href="javascript:history.go(-1)" class="btn btn-danger float-right btn-sm"><i
                                        class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
                            </h4>
                        </div>

                        <div class="card-body">

                            <?php
                        if(isset($_GET['id']))
                        {
                          $productivity_id = mysqli_real_escape_string($con, $_GET['id']);
                          $query = "SELECT * FROM productivity WHERE id = '$productivity_id' ";
                          $query_run = mysqli_query($con, $query);

                          if(mysqli_num_rows($query_run) > 0)
                          {
                            $productivity = mysqli_fetch_array($query_run);
                            ?>

                            <form action="code-proj.php" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="productivity_id" value="<?= $productivity_id; ?>">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="taskName">Task Name</label>
                                        <select name="task_id" class="form-control" required>
                                            <option value="" disabled>-- Select Task --</option>
                                            <?php
                                  $task_query = "SELECT * FROM task";
                                  $task_result = mysqli_query($con, $task_query);

                                  if(mysqli_num_rows($task_result) > 0) {
                                      while($row = mysqli_fetch_assoc($task_result)) {
                                          $taskId = $row['id'];
                                          $taskName = $row['task_name'];
                                          $selected = ($taskId == $productivity['task_id']) ? 'selected' : '';
                                          echo "<option value='$taskId' $selected>$taskName</option>";
                                      }
                                  } else {
                                      echo "<option value='' disabled>No tasks available</option>";
                                  }
                                  ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Workers</label>
                                        <select name="workers[]" class="mySelect2 form-control mb-3" multiple="multiple"
                                            size="5">
                                            <option value="" selected disabled>-- Select Worker --</option>
                                            <?php
                                                $workers_query = "SELECT * FROM employee";
                                                $workers_result = mysqli_query($con, $workers_query);

                                                if(mysqli_num_rows($workers_result) > 0) {
                                                    while($worker_row = mysqli_fetch_assoc($workers_result)) {
                                                        $workerId = $worker_row['id'];
                                                        $workerName = $worker_row['name'];
                                                        $selected = (in_array($workerId, explode(',', $productivity['employee']))) ? 'selected' : '';
                                                        echo "<option value='$workerId' $selected>$workerName</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No Workers Found.</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="taskDescription">Description</label>
                                        <textarea class="form-control" id="productivityDescription" name="description"
                                            rows="3"
                                            placeholder="Enter description"><?= $productivity['description'] ?></textarea>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Equipment</label>
                                        <select name="equipment[]" required class="form-control mySelect2"
                                            multiple="multiple">
                                            <option value="" selected disabled>-- Select Equipment --</option>
                                            <?php
                                                $equipment_query = "SELECT * FROM equipment";
                                                $equipment_result = mysqli_query($con, $equipment_query);

                                                if(mysqli_num_rows($equipment_result) > 0) {
                                                    while($equipment_row = mysqli_fetch_assoc($equipment_result)) {
                                                        $equipmentId = $equipment_row['id'];
                                                        $equipmentName = $equipment_row['name'];
                                                        $selected = (in_array($equipmentId, explode(',', $productivity['equipment']))) ? 'selected' : '';
                                                        echo "<option value='$equipmentId' $selected>$equipmentName</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No Equipment Found.</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Materials</label>
                                        <select name="material[]" required class="form-control mySelect2"
                                            multiple="multiple">
                                            <option value="" selected disabled>-- Select Materials --</option>
                                            <?php
                                                $material_query = "SELECT * FROM products";
                                                $material_result = mysqli_query($con, $material_query);

                                                if(mysqli_num_rows($material_result) > 0) {
                                                    while($material_row = mysqli_fetch_assoc($material_result)) {
                                                        $materialId = $material_row['id'];
                                                        $materialName = $material_row['name'];
                                                        $selected = (in_array($materialId, explode(',', $productivity['material']))) ? 'selected' : '';
                                                        echo "<option value='$materialId' $selected>$materialName</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No Materials Found.</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>


                                <hr>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Duration</label>
                                        <input type="datetime-local" class="form-control" name="start_date" required
                                            value="<?= date('Y-m-d\TH:i', strtotime($productivity['start_duration'])) ?>" />

                                        <label for="">End Duration</label>
                                        <input type="datetime-local" class="form-control" name="due_date" required
                                            value="<?= date('Y-m-d\TH:i', strtotime($productivity['end_duration'])) ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="0" <?= ($productivity['status'] == 0) ? 'selected' : '' ?>>
                                                Pending</option>
                                            <option value="1" <?= ($productivity['status'] == 1) ? 'selected' : '' ?>>
                                                Preparing</option>
                                            <option value="2" <?= ($productivity['status'] == 2) ? 'selected' : '' ?>>
                                                On-Progress</option>
                                            <option value="3" <?= ($productivity['status'] == 3) ? 'selected' : '' ?>>
                                                Done</option>
                                            <option value="4" <?= ($productivity['status'] == 4) ? 'selected' : '' ?>>
                                                Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="priority">Priority:</label>
                                        <select name="priority" class="form-control">
                                            <option value="0" <?= ($productivity['priority'] == 0) ? 'selected' : '' ?>>
                                                Low</option>
                                            <option value="1" <?= ($productivity['priority'] == 1) ? 'selected' : '' ?>>
                                                Medium</option>
                                            <option value="2" <?= ($productivity['priority'] == 2) ? 'selected' : '' ?>>
                                                High</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Add more input fields for other Productivity details if needed -->

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="updateProductivity">Save
                                        Productivity</button>
                                </div>
                            </form>

                            <?php
                          }
                          else
                          {
                            echo "<h4>No Such Id Found</h4>";
                          }
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>