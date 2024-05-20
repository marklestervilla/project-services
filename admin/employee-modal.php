<?php
// Define a function to get the status name based on its numeric value
function getStatusName($status) {
    switch ($status) {
        case 0:
            return 'Available';
        case 1:
            return 'Unavailable';
        case 2:
            return 'On Leave';
        case 3:
            return 'On Duty';
        default:
            return 'Unknown';
    }
}

include('authentication.php');
include('includes/header.php');

// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Retrieve employee information from the database
    $con = mysqli_connect($host, $username, $password, $database);
    $fetch_employee_query = "SELECT * FROM employee WHERE id = $employee_id";
    $fetch_employee_query_run = mysqli_query($con, $fetch_employee_query);

    if(mysqli_num_rows($fetch_employee_query_run) > 0) {
        $employee = mysqli_fetch_assoc($fetch_employee_query_run);
?>
        <div class="modal-body">
            <!-- Employee details -->
            <div class="container">
                <div class="row justify-content-center"> <!-- Center the image -->
                    <div class="col-md-4 text-center">
                        <img src="<?php echo "uploads_emp/".$employee['image']; ?>" class="rounded-circle" width="150" height="150" alt="Employee Image">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Name:</dt>
                                    <h4 class="col-sm-8"><?php echo $employee['name']; ?></h4>
                                    <dt class="col-sm-4">Age:</dt>
                                    <dd class="col-sm-8"><?php echo $employee['age']; ?></dd>
                                    
                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8"><?php echo $employee['email']; ?></dd>
                                    
                                    <dt class="col-sm-4">Contact:</dt>
                                    <dd class="col-sm-8"><?php echo $employee['contact']; ?></dd>
                                    
                                    <dt class="col-sm-4">Address:</dt>
                                    <dd class="col-sm-8"><?php echo $employee['address']; ?></dd>
                                    
                                    <dt class="col-sm-4">Position:</dt>
                                    <dd class="col-sm-8"><?php echo $employee['position']; ?></dd>
                                    
                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8"><?php echo getStatusName($employee['status']); ?></dd>
                                    <!-- Add other fields -->
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "Employee not found!";
    }
} else {
    echo "Employee ID not provided!";
}

include('includes/script.php');
?>
