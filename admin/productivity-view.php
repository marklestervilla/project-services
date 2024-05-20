<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

// Fetch the logo URL from the database or any other source
$logo_url = '../admin/images/icon-gbua-trans.png'; // Replace this with the actual path to your 

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php alertMessage(); ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Billing Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4> <!-- Logo -->
                            <img src="<?php echo $logo_url; ?>" alt="Logo" style="max-width: 50px; height: auto;">  Productivity Data
                            <!-- Print Button -->
                            <a href="javascript:history.go(-1)" class="btn btn-danger float-right btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Go Back</a>
                            <button class="btn btn-success mx-2 float-right btn-sm" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                        </h4>
                    </div>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "project_system");
                    $id = $_GET['id'];
                    $productivity_query = "SELECT p.*, t.task_name FROM productivity p INNER JOIN task t ON p.task_id = t.id WHERE p.id='$id'";
                    $productivity_query_run = mysqli_query($con, $productivity_query);
                    if (mysqli_num_rows($productivity_query_run) > 0) {
                        foreach ($productivity_query_run as $row) {
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Task Name and Description -->
                                <p><strong>Task Name:</strong> <?php echo $row['task_name']; ?></p>
                                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <!-- Priority and Status -->
                                <p><strong>Priority:</strong>
                                    <?php
                                    $priority = $row['priority'];
                                    echo getPriorityText($priority);
                                    ?>
                                </p>
                                <p><strong>Status:</strong>
                                    <?php
                                    $status = $row['status'];
                                    echo getStatusText($status);
                                    ?>
                                </p>
                                <!-- Dates -->
                                <p><strong>Start Date:</strong>
                                    <?php echo date("F j, Y, g:i a", strtotime($row['start_duration'])); ?></p>
                                <p><strong>End Date:</strong>
                                    <?php echo date("F j, Y, g:i a", strtotime($row['end_duration'])); ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Worker, Equipment, Material -->
                                <p><strong>Workers:</strong>
                                <hr>
                                 <?php echo $row['employee']; ?></p>
                                <p><strong>Equipment:</strong>
                                <hr>
                                 <?php echo $row['equipment']; ?></p>
                                <p><strong>Materials (Used):</strong>
                                <hr>
                                 <?php echo $row['material']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <!-- Date Created -->
                                <p><strong>Date Created: </strong><?php echo date('j M Y | g:i A', strtotime($row['date_created'])); ?></p>
                            </div>
                        </div>
                    </div>
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

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>


<?php
// Function to get priority text based on priority code
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
    }
}

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
