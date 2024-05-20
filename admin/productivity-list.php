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
                        <li class="breadcrumb-item active">Productivity</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <?php 
            alertMessage();
            ?>
                    <div class="card-header">
                        <h4><b>Productivity / Info</b></h4>

                        <h5>
                            <a href="javascript:history.go(-1)" class="btn btn-danger float-right btn-sm"><i
                                    class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
                            <!-- <a href="productivity-add.php" class="btn btn-primary float-right btn-sm"><i
                                    class="fas fa-plus-circle"></i> Create Productivity</a> -->

                        </h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task Name</th>
                                    <th>Worker</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = "SELECT productivity.*, task.task_name AS task_name, productivity.employee AS employee_name
                                FROM productivity
                                LEFT JOIN task ON productivity.task_id = task.id";
                                $query_run = mysqli_query($con, $query);

                                if($query_run) {
                                    while($productivity = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                <tr>
                                    <td><?= $productivity['id']; ?></td>
                                    <td><?= $productivity['task_name']; ?></td>
                                    <td><?= $productivity['employee_name']; ?></td>
                                    <td>
                                        <?php
                                                $priority = $productivity['priority'];
                                                $badge_class = '';
                                                switch ($priority) {
                                                    case 0:
                                                        $badge_class = 'bg-secondary'; // Low
                                                        break;
                                                    case 1:
                                                        $badge_class = 'bg-primary'; // Medium
                                                        break;
                                                    case 2:
                                                        $badge_class = 'bg-danger'; // High
                                                        break;
                                                    default:
                                                        $badge_class = 'bg-secondary'; // Default
                                                        break;
                                                }
                                                echo '<span class="badge ' . $badge_class . '">' . getPriorityText($priority) . '</span>';
                                                ?>
                                    </td>
                                    <td>
                                        <?php
                                                $status = $productivity['status'];
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
                                                        $badge_class = 'bg-success'; // Done
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
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                id="actionDropdown" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-cog"></i> Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                                <a class="dropdown-item"
                                                    href="productivity-view.php?id=<?= $productivity['id']; ?>"><i
                                                        class="fas fa-eye"></i> View</a>
                                                <a class="dropdown-item"
                                                    href="productivity-edit.php?id=<?= $productivity['id']; ?>"><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i>
                                                    Delete</a>
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


    <?php
// Function to get Priority text based on priority code
function getPriorityText($priority)
{
    switch ($priority) {
        case 0:
            return 'Low';
            break;
        case 1:
            return 'Medium';
            break;
        case 2:
            return 'High';
            break;
        default:
            return 'Unknown';
            break;
    }
}
?>

<?php
// Function to get Status text based on status code
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
            return 'On-Progress';
            break;
        case 3:
            return 'Done';
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


    <?php include('includes/footer.php'); ?>