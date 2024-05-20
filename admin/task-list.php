<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
// include('modal/task-modal-add.php');

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
                        <li class="breadcrumb-item active">Task List</li>
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
                        <h4 class="card-title"><b>Task List / Progress</b></h4>

                        <h5>
                        <a href="javascript:history.go(-1)" class="btn btn-danger float-right btn-sm"><i
                                    class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
                        </h5>
                        

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task Name</th>
                                    <th>Project Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT task.*, project.project_name AS project_name
                                          FROM task
                                          LEFT JOIN project ON task.project_id = project.id";
                                $query_run = mysqli_query($con, $query);

                                if($query_run) {
                                    while($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['task_name']; ?></td>
                                            <td><?php echo $row['project_name']; ?></td>
                                            <td><?php
                                                $status = $row['status'];
                                                $badge_class = '';
                                                switch ($status) {
                                                    case 0:
                                                        $badge_class = 'bg-primary'; // Pending
                                                        break;
                                                    case 1:
                                                        $badge_class = 'bg-secondary'; // Preparing
                                                        break;
                                                    case 2:
                                                        $badge_class = 'bg-warning'; // On-Progress
                                                        break;
                                                    case 3:
                                                        $badge_class = 'bg-success'; // Completed
                                                        break;
                                                    case 4:
                                                        $badge_class = 'bg-danger'; // Cancelled
                                                        break;
                                                    default:
                                                        $badge_class = 'bg-secondary'; // Default
                                                        break;
                                                }
                                                echo '<span class="badge ' . $badge_class . '">' . getStatusText($status) . '</span>';
                                                ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cog"></i> Actions 
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="task-edit.php?id=<?= $row['id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <form action="code-proj.php" method="POST">
                                                            <button type="submit" class="dropdown-item text-danger" name="taskDelete" value="<?= $row['id']; ?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>




                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "Query failed: " . mysqli_error($con);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>

<?php
// Function to get status text based on status code
function getStatusText($status)
{
    switch ($status) {
        case 0:
            return 'Pending';
            break;
        case 1:
            return 'Preparing';
            break;
        case 2:
            return 'On-progress';
            break;
        case 3:
            return 'Completed';
            break;
        case 4:
            return 'Cancelled';
            break;
        default:
            return 'Unknown';
            break;
    }
}
?>
