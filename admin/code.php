<?php 
// session_start();
include('authentication.php');
include('config/dbcon.php');
include('config/function.php');


if (isset($_POST['appoint_btn'])) {
    $appoint_btn = $_POST['appoint_btn'];
    $id = $_POST['id'];

    $conn = new mysqli('localhost', 'root', '', 'project_system');

    if ($appoint_btn == 'approve') {
        $update_query = "UPDATE appointment SET STATUS='Approved' WHERE id='$id'";
        $query_run = mysqli_query($conn, $update_query);
    } elseif ($appoint_btn == 'cancel') {
        $update_query = "UPDATE appointment SET STATUS='Canceled' WHERE id='$id'";
        $query_run = mysqli_query($conn, $update_query);
    } elseif ($appoint_btn == 'delete') {
        $delete_query = "DELETE FROM appointment WHERE id='$id'";
        $query_run = mysqli_query($conn, $delete_query);
    }

    if ($query_run) {
        session_start();
        if ($appoint_btn == 'delete') {
            $_SESSION['status'] = "Appointment Deleted Successfully";
        } else {
            $_SESSION['status'] = "Status Updated Successfully";
        }
        header('location: appointment-view.php');
        exit(0);
    } else {
        session_start();
        $_SESSION['status'] = "Failed to update/delete status";
        header('location: appointment-view.php');
        exit(0);
    }
}


if(isset($_POST['addCategory']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $info = isset($_POST['info']) ? '1' : '0';
    $status = isset($_POST['status']) ? '1' : '0';

    $category_query = "INSERT INTO categories (name,description,info,status) VALUES ('$name','$description','$info','$status')";
    $category_query_run = mysqli_query($con, $category_query);

    if($category_query_run)
    {
        session_start();
        $_SESSION['status'] = "Category Inserted Successfully";
        header("Location: categories.php");
    }
    else
    {
        session_start();
        $_SESSION['status'] = "Category Insertion Failed!";
        header("Location: categories.php");
    }
}


if(isset($_POST['addCategoryUpdate']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $info = $_POST['info'] == true ? '1':'0';
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE categories SET name='$name', description='$description', info='$info', status='$status' WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        session_start();
        $_SESSION['status'] = "Category Updated Successfully";
        header("Location: categories.php");
    }
    else
    {
        session_start();
        $_SESSION['status'] = "Category Updating Failed!";
        header("Location: categories.php");
    }
}


if(isset($_POST['deleteCategory']))
{
    $category_id = $_POST['category_delete_id'];
    $query = "DELETE FROM categories WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        session_start();
        $_SESSION['status'] = "Category Deleted Successfully";
        header("Location: categories.php");
    }
    else
    {
        session_start();
        $_SESSION['status'] = "Category Deleting Failed!";
        header("Location: categories.php");
    }
}


if(isset($_POST['logout_btn']))
{
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out Successfully";
    header('Location: login.php');
    exit(0);
}

if(isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email' ";
    $checkemail_run = mysqli_query($con, $checkemail);

    if(mysqli_num_rows($checkemail_run) > 0) 
    {
       echo "taken";
    }
    else
    {
        echo "available";
    }
}

if(isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password == $confirmpassword)
    {
        $checkemail = "SELECT email FROM users WHERE email='$email' ";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0)
        {
            // Taken Already Exists.
            $_SESSION['status'] = "Email ID is already taken.!";
            header("Location: registered.php");
            exit;
        }
        else
        {
            // Available = Record not found
            $user_query = "INSERT INTO users (name,email,phone,password) VALUES ('$name', '$email', '$phone', '$password')";
            $user_query_run = mysqli_query($con, $user_query);
    
        if($user_query_run) {   
            $_SESSION['status'] = " User Added Successfully";
            header("Location: registered.php");
        } else {
            $_SESSION['status'] = " User Registration Failed";
            header("Location: registered.php");
        }
    }
        
    }
    else
    {
        $_SESSION['status'] = " Password and Confirm Password does not match!";
        header("Location: registered.php");
    }
   
}

if(isset($_POST['updateUser'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];

    $query = "UPDATE users SET name='$name' , email='$email' , phone='$phone' , password='$password' , role_as='$role_as' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run) {   
        $_SESSION['status'] = " User Updated Successfully";
        header("Location: registered.php");
    } else {
        $_SESSION['status'] = " User Updating Failed";
        header("Location: registered.php");
    }
}

if(isset($_POST['DeleteUserbtn']))
{
    $userid = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE id='$userid' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {   
        $_SESSION['status'] = " User Deleted Successfully";
        header("Location: registered.php");
    } 
    else
    {
        $_SESSION['status'] = " User Deleting Failed";
        header("Location: registered.php");
    }
}



?>