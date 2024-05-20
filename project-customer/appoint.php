<?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_POST['submit'])) {
    $fname = $_POST['FIRSTNAME'];
    $mname = $_POST['MIDDLENAME'];
    $lname = $_POST['LASTNAME'];
    $phone = $_POST['PHONE'];
    $email = $_POST['EMAIL'];

    $con = new mysqli('localhost', 'root', '', 'project_system');

    // Check for existing data
    $check_query = "SELECT * FROM appointment WHERE FIRSTNAME = '$fname' AND MIDDLENAME = '$mname' AND LASTNAME = '$lname' AND PHONE = '$phone' AND EMAIL = '$email'";
    $check_result = $con->query($check_query);

    if ($check_result->num_rows > 0) {
        // Data already exists, reject the appointment
        echo "<script>alertify.error('You have already set an appointment');</script>";
    } else {
        // Data doesn't exist, proceed with the appointment insertion
        $sql = "INSERT INTO appointment(FIRSTNAME, MIDDLENAME, LASTNAME, PHONE, EMAIL, DATE) VALUES ('$fname', '$mname', '$lname', '$phone', '$email', '$date')";
        if ($con->query($sql)) {
            echo "<script>alertify.success('Appointment Successful');</script>";
            // Redirect back to appointment.php after successful appointment
            echo "<script>window.location.href = 'appointment.php';</script>";
            exit(); // Ensure no further code is executed after the redirection
        } else {
            echo "<script>alertify.error('Appointment was not Successful');</script>";
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css"/>
</head>
<body>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="appointment.php">Home</a></li>
                    <li class="breadcrumb-item active">Appointment</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <div class="container">
        <h1 class="text-center alert alert-danger" style="background:#2ecc71;border:none;color:#fff"> Appoint for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php echo isset($message) ? $message : ''; ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="FIRSTNAME" required>
                    </div>
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="MIDDLENAME" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="LASTNAME" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number * (Required):</label>
                        <input type="text" class="form-control" id="phoneNumber" name="PHONE" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="EMAIL" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="appointment.php" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>

</body>

</html>


