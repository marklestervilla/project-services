<?php
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Modal -->

<!-- Register Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your form fields here for adding a user -->
        <form action="code.php" method="POST">
                <div class="form-group">
                  <label for="username">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Fullname">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <span class="email_error text-warning ml-2"></span>
                  <input type="email" class="form-control email_id" name="email" placeholder="Enter Email">
                </div>

                <div class="form-group">
                  <label for="phone">Phone No.</label>
                  <input type="phone" class="form-control" name="phone" placeholder="Enter Phone">
                </div>

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">Confirm Password</label>
                      <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                    </div>
                </div>
                </div>
                
                <!-- Add more fields as needed -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="addUser" class="btn btn-primary">Save</button>
            </div>
      </form>

    </div>
  </div>
</div>
<!-- //Register Modal -->

<!-- Delete User Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_user_id">
      <p>
        Are you sure, you want to delete this data?
      </p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="DeleteUserbtn" class="btn btn-danger">Yes, Delete!</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-- //Delete User Modal -->

<!-- // Modal -->

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
              <li class="breadcrumb-item active">Registered Users</li>
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
                <h3 class="card-title">Registered User List</h3>
                <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#AddUserModal">
                Create User
              </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM users";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                      foreach($query_run as $row)
                      {
                        // echo $row['name'];
                        ?>

                            <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              <td>
                              <?php 
                                if($row['role_as'] == '0')
                                {
                                  echo "User";
                                }
                                elseif($row['role_as'] == '1')
                                {
                                  echo "Admin";
                                }
                                elseif($row['role_as'] == '2')
                                {
                                  echo "Staff";
                                }
                                else
                                {
                                  echo "Invalid User";
                                }
                              ?>
                              </td>
                              <td>
                              <button onclick="editUser(<?php echo $row['id']; ?>)" class="edit-btn btn-success flex-fill">
                                  <i class="fas fa-edit"></i> Edit
                              </button>
                              <button type="button" value="<?php echo $row['id'];?>" class="delete-btn btn-danger flex-fill deletebtn">
                              <i class="fas fa-trash-alt"></i> Delete</button>
                              </td>

                            </tr>

                        <?php
                      }
                    }
                    else
                    {
                      ?>
                        <tr>
                          <td>No Record Found!</td>
                        </tr>
                      <?php
                    }

                    ?>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>

                </div>
            </div>
        </div>
</div>

<?php include('includes/script.php'); ?>

<script>

  $(document).ready(function() {

    $('.email_id').keyup(function (e) {
      var email = $('.email_id').val();
      // console.log(email);

      $.ajax({
        type: "POST",
        url: "code.php",
        data: {
          'check_Emailbtn':1,
          'email':email,
        },
        success: function (response) {
          // console.log(response);
          if (response.trim() === 'taken') {
            $('.email_error').removeClass('text-success').addClass('text-warning').text("Email ID is already taken.");
          } else if (response.trim() === 'available') {
            $('.email_error').removeClass('text-warning').addClass('text-success').text("It's Available");
          }
        }
      });

    });

  });
</script>

<script>
    $(document).ready(function () {
      $('.deletebtn').click(function (e) {
        e.preventDefault();

        var user_id = $(this).val();
        // console.log(user_id);
        $('.delete_user_id').val(user_id);
        $('#DeleteModal').modal('show');

      });
    });
</script>

<script>
    function editUser(userId) {
        window.location.href = 'registered-edit.php?user_id=' + userId;
    }
</script>

<?php include('includes/footer.php'); ?>