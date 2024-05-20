<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>

<!-- Modal -->
<!-- Delete Customer Modal -->

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this customer?
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
        <a href="#" id="deleteCustomerBtn" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<!-- //Delete Customer Modal -->


<!-- //Modal -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php alertMessage(); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Customer Record
                            <a href="customers-create.php" class="btn btn-primary float-right">Add Customer</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        $customers = getAll('customers');
                        if(!$customers){
                          echo '<h4>Something Went Wrong!</h4>';
                          return false;
                        }
                        if(mysqli_num_rows($customers) > 0)
                        {
                        ?>
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Payment Mode</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <?php foreach($customers as $item) : ?>
                            <tr>
                              <td><?= $item['id'] ?></td>
                              <td><?= $item['name'] ?></td>
                              <td><?= $item['email'] ?></td>
                              <td><?= $item['phone'] ?></td>
                              <td>
                              <?php
                                if ($item['status'] == 1) {
                                    echo '<span class="badge bg-primary">Online Payment</span>';
                                } else {
                                    echo '<span class="badge bg-success">Cash Payment</span>';
                                }
                                ?>
                              </td>
                              <td>
                              <a href="customers-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                              <a href="#" class="btn btn-danger btn-sm deleteCustomerBtn" data-customer-id="<?= $item['id']; ?>">Delete</a>
                              </td>
                            </tr>

                        <?php endforeach; ?>
                       
                      </tbody>
                    </table>
                    </div>

                    <?php
                    }
                    else
                    {
                      ?>
                          <h4 class="mb-0">No Record Found</h4>
                      <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>


<script>
  $(document).ready(function() {
    $('.deleteCustomerBtn').click(function(e) {
      e.preventDefault(); // Prevent default action of link
      var customerId = $(this).data('customer-id'); // Get customer ID from data attribute
      $('#deleteCustomerBtn').attr('href', 'customers-delete.php?id=' + customerId); // Set href attribute of delete button
      $('#confirmDeleteModal').modal('show'); // Show modal dialog
    });
  });
</script>


