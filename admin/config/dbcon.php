<?php


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_system';

// Connection
$con = mysqli_connect("$host", "$username", "$password", "$database");

//Check Connection
if(!$con)
{
    header("Location: error/db.php");
    die();
}
else
{
    // echo "Database Connected.! <br> ";
}


//fetch date
$sql = "SELECT DATE_FORMAT(NOW(), '%d-%m-%Y') AS formatted_date";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentDate = $row["formatted_date"];
} else {
    $currentDate = "Cant Retrive current Date.";
}

//fetch timestamp
$sql = "SELECT TIME_FORMAT(NOW(), '%h:%i %p') AS formatted_time";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $formattedTime = $row["formatted_time"];
} else {
    $formattedTime = "Cant Retrive Current Time";
}

?>