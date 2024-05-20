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
              <li class="breadcrumb-item active">Equipment View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                <?php 
                alertMessage();
                ?>

                    <div class="card">
                        <div class="card-header">
                            <h4>Equipment
                                <a href="equipment-create.php" class="btn btn-primary float-right btn-sm"><i class="fas fa-plus-circle"></i> Add Equipment</a>
                            </h4>
                        </div>
                        
                        <div class="card-body">
                          <table id="example1" class="table">
                            <thead>
                              <tr>
                                <!-- <th scope="col">ID</th> -->
                                <th scope="col">Equipment</th>
                                <th scope="col">Name</th>
                                <th scope="col">Value * (₱)</th>
                                <th scope="col">Note</th>
                                <th scope="col">Status</th>
                                <th scope="col">Manage</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                // Connection
                                $con = mysqli_connect("$host", "$username", "$password", "$database");

                                $fetch_image_query = "SELECT * FROM equipment";
                                $fetch_image_query_run = mysqli_query($con, $fetch_image_query);

                                if(mysqli_num_rows($fetch_image_query_run) > 0)
                                {
                                  foreach($fetch_image_query_run as $row)
                                  {
                                      // echo $row['id'];
                                      ?>
                                        <tr>
                                          <!-- <td><?php echo $row['id']; ?></td> -->
                                          <td>
                                            <img src="<?php echo "uploads/".$row['image']; ?>" width="75" height="75" alt="Equipment Image">
                                          </td>
                                          <td><?php echo $row['name']; ?></td>
                                          <td><?php echo $row['value']; ?></td>
                                          <td><?php echo $row['note']; ?></td>
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
                                                $badge_class = 'bg-warning'; // Repairing
                                                break;
                                              case 3:
                                                $badge_class = 'bg-primary'; // Used
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
                                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                                    <a class="dropdown-item" href="equipment-edit.php?id=<?php echo $row['id']; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="code-proj.php" method="POST" class="delete-form">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                                                        <button type="submit" name="deleteEquipment" onclick="return confirm('Are you sure you want to delete this equipment?');" class="dropdown-item delete-btn text-danger">
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
                                    <tr colspan="7"><h5>No Record Found</h5></tr>
                                  <?php
                                }
                              ?>

                              
                            </tbody>
                            
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
            return 'Repairing';
        case 3:
            return 'Used';
        default:
            return 'Unknown';
    }
}
?>
