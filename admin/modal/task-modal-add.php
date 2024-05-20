<?php
include('config/dbcon.php');
?>

<!-- Task Modal Add -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel"> <i class="fas fa-plus-circle"></i> Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding a task goes here -->
                
                <form action="code-proj.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="taskName">Task Name</label>
                        <input type="text" class="form-control" name="task_name" placeholder="Enter task name">
                    </div>

                    <div class="form-group">
    <label for="projectName">Project Name</label>
    <select name="project_id" class="form-control" required>
        <option value="" selected disabled>-- Select Project --</option>
        <?php
        $project_query = "SELECT * FROM project";
        $project_result = mysqli_query($con, $project_query);

        $current_proj_id = isset($_GET['proj_id']) ? $_GET['proj_id'] : null;

        if(mysqli_num_rows($project_result) > 0) {
            while($row = mysqli_fetch_assoc($project_result)) {
                $selected = ($current_proj_id == $row['id']) ? "selected" : "";
                ?>
                <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['project_name'] ?></option>
                <?php
            }
        } else {
            ?>
            <option value="" disabled>No projects available</option>
            <?php
        }
        ?>
    </select>
</div>


                    <div class="form-group">
                        <label for="taskDescription">Description</label>
                        <textarea class="form-control" id="taskDescription" name="description" rows="3"
                            placeholder="Enter task description"></textarea>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="taskName">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" required />

                        <label for="taskName">Due Date</label>
                        <input type="datetime-local" class="form-control" name="due_date" required />
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select name="priority" class="form-control">
                            <option value="0">Low</option>
                            <option value="1">Medium</option>
                            <option value="2">High</option>
                        </select>
                    </div>

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

                    <!-- Add more input fields for other task details if needed -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="saveTask">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- // Task List Card -->
</div>