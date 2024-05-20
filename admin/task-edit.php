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
              <li class="breadcrumb-item active">Task Edit</li>
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
                            <h4>Task Edit
                            <a href="javascript:history.go(-1)" class="btn btn-danger float-right btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
                            </h4>
                        </div>

                        <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                          $task_id = mysqli_real_escape_string($con, $_GET['id']);
                          $query = "SELECT * FROM task WHERE id='$task_id' ";
                          $query_run = mysqli_query($con, $query);

                          if(mysqli_num_rows($query_run) > 0)
                          {
                            $task = mysqli_fetch_array($query_run);
                            ?>

                        <form action="code-proj.php" method="post" enctype="multipart/form-data">
                          
                            <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                            
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input type="text" class="form-control" name="task_name" value="<?= $task['task_name'];?>" placeholder="Enter Task Name">
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectName">Project Name</label>
                                <select name="project_id" class="form-control" required>
                                    <option value="<?= $task['project_id'];?>" selected disabled>-- Select Project --</option>
                                    <?php
                                    $project_query = "SELECT * FROM project";
                                    $project_result = mysqli_query($con, $project_query);

                                    if(mysqli_num_rows($project_result) > 0) {
                                        while($row = mysqli_fetch_assoc($project_result)) {
                                            ?>
                                            <option value="<?= $row['id'] ?>" <?php if($row['id'] == $task['project_id']) echo 'selected'; ?>>
                                                <?= $row['project_name'] ?>
                                            </option>
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
                          </div>
                                      
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="taskDescription">Description</label>
                                <textarea class="form-control" id="taskDescription" name="description" rows="3"
                                    placeholder="Enter Task Description"><?= $task['description'];?></textarea>
                            </div>
                          </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                  <label for="taskName">Start Date</label>
                                  <input type="datetime-local" class="form-control" name="start_date" required value="<?php echo date('Y-m-d\TH:i', strtotime($task['start_date'])); ?>" />

                                  <label for="taskName">Due Date</label>
                                  <input type="datetime-local" class="form-control" name="due_date" required value="<?php echo date('Y-m-d\TH:i', strtotime($task['due_date'])); ?>" />
                              </div>
                            </div>
                                    
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="priority">Priority:</label>
                                <select name="priority" class="form-control">
                                    <option value="0" <?php if($task['priority'] == 0) echo 'selected'; ?>>Low</option>
                                    <option value="1" <?php if($task['priority'] == 1) echo 'selected'; ?>>Medium</option>
                                    <option value="2" <?php if($task['priority'] == 2) echo 'selected'; ?>>High</option>
                                </select>
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control">
                                    <option value="0" <?php if($task['status'] == 0) echo 'selected'; ?>>Pending</option>
                                    <option value="1" <?php if($task['status'] == 1) echo 'selected'; ?>>Preparing</option>
                                    <option value="2" <?php if($task['status'] == 2) echo 'selected'; ?>>On-Progress</option>
                                    <option value="3" <?php if($task['status'] == 3) echo 'selected'; ?>>Completed</option>
                                    <option value="4" <?php if($task['status'] == 4) echo 'selected'; ?>>Cancelled</option>
                                </select>
                            </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="updateTask">Update Task</button>
                            </div>
                        </form>

                        <?php
                          }
                          else
                          {
                            echo "<h4>No Such ID Found</h4>";
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