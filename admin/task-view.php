<?php
include('authentication.php');
include('includes/header.php');
include('config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    
</head>
<body>
    <div class="container">
        <?php
        $con = mysqli_connect("localhost", "root", "", "project_system");
        $id = $_GET['id'];
        $task_query = "SELECT * FROM task WHERE id='$id'";
        $task_query_run = mysqli_query($con, $task_query);

        if(mysqli_num_rows($task_query_run) > 0)
        {
            foreach($task_query_run as $row)
            {
        ?>
        
        <div class="task-details">
            <p><strong>Task Name:</strong> <?php echo $row['task_name']; ?></p>

            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>

            <p><strong>Status:</strong> 
                <?php
                $status = $row['status'];
                $badge_class = '';
                switch ($status) {
                    case 0:
                        $badge_class = 'badge-primary'; // Pending
                        break;
                    case 1:
                        $badge_class = 'badge-secondary'; // Preparing
                        break;
                    case 2:
                        $badge_class = 'badge-warning'; // On-Progress
                        break;
                    case 3:
                        $badge_class = 'badge-success'; // Completed
                        break;
                    case 4:
                        $badge_class = 'badge-danger'; // Cancelled
                        break;    
                    default:
                        $badge_class = 'badge-info'; // Default
                        break;
                }
                echo '<span class="badge ' . $badge_class . '">' . getStatusText($status) . '</span>';
                ?>
            </p>

            <p><strong>Priority:</strong> 
                <?php
                $priority = $row['priority'];
                $badge_class = '';
                switch ($priority) {
                    case 0:
                        $badge_class = 'badge-secondary'; // Low
                        break;
                    case 1:
                        $badge_class = 'badge-primary'; // Medium
                        break;
                    case 2:
                        $badge_class = 'badge-danger'; // High
                        break;
                }
                echo '<span class="badge ' . $badge_class . '">' . getPriorityText($priority) . '</span>';
                ?>
            </p>

            <p><strong>Start Date:</strong> <?php echo date("F j, Y", strtotime($row['start_date'])); ?></p>

            <p><strong>End Date:</strong> <?php echo date("F j, Y", strtotime($row['due_date'])); ?></p>

            <hr>

            <p><strong>Date Created:</strong> <?php echo date('j M Y | g:i A', strtotime($row['created_at'])); ?></p>
        </div>

        <?php
            }
        }
        else
        {
            echo "No Data Found";
        }
        ?>
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
    ?>

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
                return 'On-Progress';
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
</body>
</html>
