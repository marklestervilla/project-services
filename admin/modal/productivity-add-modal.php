<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        .form-control option[disabled] {
            color: black;
        }
    </style>
</head>
<body>
    <?php
    include('config/dbcon.php');
    ?>

    <!-- Productivity Modal Add -->
    <div class="modal fade" id="addProductivityModal" tabindex="-1" role="dialog" aria-labelledby="addProductivityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductivityModalLabel"> <i class="fas fa-plus-circle"></i> Add Productivity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your form for adding a Productivity goes here -->

                    <form action="code-proj.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <select name="task_id" class="form-control" required>
                                    <option value="" selected disabled>-- Select Task --</option>
                                    <?php
                                    // Get the project ID from the URL parameter
                                    $project_id = $_GET['proj_id'];

                                    // Query tasks associated with the specified project
                                    $task_query = "SELECT * FROM task WHERE project_id = $project_id";
                                    $task_result = mysqli_query($con, $task_query);

                                    if(mysqli_num_rows($task_result) > 0) {
                                        while($row = mysqli_fetch_assoc($task_result)) {
                                            ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['task_name'] ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="" disabled>No tasks available for this project</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Project Worker</label>
                                <select name="employee[]" required class="form-control mySelect2" multiple="multiple">
                                    <option value="" selected disabled>-- Select Worker . . .--</option>
                                    <?php
                                    $employeeQuery = "SELECT * FROM employee WHERE position IN ('Worker', 'Foreman')";
                                    $employeeResult = mysqli_query($con, $employeeQuery);
                                    while ($data = mysqli_fetch_array($employeeResult)) {
                                        ?>
                                        <option value="<?php echo $data['name'] . '|' . $data['position']; ?>">
                                            <?php echo $data['name'] . ' - ' . $data['position']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Equipment</label>
                                <select name="equipment[]" required class="form-control mySelect2" multiple="multiple">
                                    <option value="" selected disabled>-- Select Equipment --</option>
                                    <?php
                                    $equipment = "SELECT * from equipment";
                                    $result = mysqli_query($con, $equipment);

                                    while ($data=mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $data['name']; ?>"><?php echo $data['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Materials</label>
                                <select name="material[]" required class="form-control mySelect2" multiple="multiple">
                                    <option value="" selected disabled>-- Select Materials --</option>
                                    <?php
                                    $material = "SELECT * from products";
                                    $result = mysqli_query($con, $material);

                                    while ($data=mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $data['name']; ?>"><?php echo $data['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="taskDescription">Note</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter Description."></textarea>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Start Duration</label>
                                <input type="datetime-local" class="form-control" name="start_date" required />
                                <label for="">End Duration</label>
                                <input type="datetime-local" class="form-control" name="due_date" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control">
                                    <option value="0">Pending</option>
                                    <option value="1">Preparing</option>
                                    <option value="2">On-Progress</option>
                                    <option value="3">Done</option>
                                    <option value="4">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority:</label>
                                <select name="priority" class="form-control">
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="saveProductivity">Save Productivity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
