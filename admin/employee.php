<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>


<!-- Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Employee details will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



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
                        <li class="breadcrumb-item active">Employee View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
                alertMessage();
                ?>

    <div class="card">
        <div class="card-header">
            <h4>Employee Record
                <a href="employee-create.php" class="btn btn-primary float-right">Add New Employee</a>
            </h4>
        </div>

        <div class="card-body">
            <table id="example1" class="table">
                <thead>
                    <tr>
                        <!-- <th scope="col">ID</th> -->
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <!-- <th scope="col">Email</th>
                                <th scope="col">Age</th>
                                <th scope="col">Address</th> -->
                        <th scope="col">Position</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                // Connection
                                $con = mysqli_connect("$host", "$username", "$password", "$database");

                                $position = "SELECT * FROM employee";
                                $position_run = mysqli_query($con, $position);
    
                                if(mysqli_num_rows($position_run) > 0)
                                {
                                    foreach($position_run as $row)
                                    {
                                        ?>
                    <tr>
                        <!-- <td><?php echo $row['id']; ?></td> -->
                        <td>
                            <img src="<?php echo "uploads_emp/".$row['image']; ?>" width="50" height="50"
                                alt="Employee Image">
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php
                                            if($row['position'] == 'Worker')
                                            {
                                                    echo 'Worker';
                                            }elseif($row['position'] == 'Foreman'){
                                                    echo 'Foreman';
                                            }elseif($row['position'] == 'Project Manager'){
                                                    echo 'Project Manager';
                                            }elseif($row['position'] == 'Electrician Engr'){
                                                    echo 'Electrician Engr';
                                            }elseif($row['position'] == 'Electrical Tech'){
                                                    echo 'Electrical Tech';
                                            }elseif($row['position'] == 'Mechanical Engr'){
                                                    echo 'Mechanical Engr';
                                            }elseif($row['position'] == 'HR Manager'){
                                                    echo 'HR Manager';
                                            }elseif($row['position'] == 'Accountant'){
                                                    echo 'Accountant';
                                            }elseif($row['position'] == 'Acct. Staff'){
                                                    echo 'Acct. Staff';
                                            }elseif($row['position'] == 'Architect'){
                                                    echo 'Architect';
                                            }
                                            ?>
                        </td>
                        <td>
                            <?php
                                            $status = $row['status'];
                                            $badge_class = '';
                                            switch ($status) {
                                              case 0:
                                                $badge_class = 'bg-success'; // Available
                                                break;
                                              case 1:
                                                $badge_class = 'bg-danger'; // Unavailable
                                                break;
                                              case 2:
                                                $badge_class = 'bg-warning'; // On Leave
                                                break;
                                              case 3:
                                                $badge_class = 'bg-primary'; // On Duty
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
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                    <a class="dropdown-item view-employee" href="#" data-id="<?php echo $row['id']; ?>"
                                        data-toggle="modal" data-target="#employeeModal">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="employee-edit.php?id=<?php echo $row['id']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="code-proj.php" method="POST" class="delete-form">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                                        <button type="submit" name="deleteEmployee" class="dropdown-item delete-btn">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <?php
                                  }
                                }
                                else
                                {
                                  ?>
                    <tr colspan="7">
                        <h5>No Record Found</h5>
                    </tr>
                    <?php
                                }
                              ?>


                </tbody>
            </table>
        </div>
    </div>



    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>


    <?php
function getStatusText($status) {
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
?>


    <script>
    $(document).ready(function() {
        $('.view-employee').click(function(e) {
            e.preventDefault();
            var employeeId = $(this).data('id');
            $.ajax({
                url: 'employee-modal.php',
                type: 'GET',
                data: {
                    id: employeeId
                },
                success: function(response) {
                    $('#employeeModal .modal-body').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    </script>