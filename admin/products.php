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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Add Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your form fields here for adding a user -->
        <form action="code-pos.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label>Select Category:</label>
              <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                <?php
                $poscategories = getAll('poscategories');
                if($poscategories){
                  if(mysqli_num_rows($poscategories) > 0){
                    foreach($poscategories as $cateItem){
                      echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                    }
                  }else{
                    echo '<option value="">No Category Found!</option>';
                  }
                }else{
                  echo '<option value="">Something went Wrong!</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Material Name *</label>
            <input type="text" class="form-control" name="name" required />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="name"> Original Price *</label>
            <input type="number" class="form-control" name="price" required />
          </div>
          <div class="form-group">
            <label for="name">Quantity *</label>
            <input type="number" class="form-control" name="quantity" required />
          </div>
          <div class="form-group">
            <label for="name">Image *</label>
            <input type="file" class="form-control" name="image" />
          </div>
          <div class="form-group">
            <label>Status (UnChecked=Available, Checked=Unavailable)</label>
            <br/>
            <input type="checkbox" name="status" style="width:30px;height:30px;" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- //Add Product Modal -->

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this material?
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- //Delete Product Modal -->

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
              <li class="breadcrumb-item active">Material</li>
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
          <h3>Materials
          <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addProductModal">
          <i class="fas fa-plus-circle"></i>
            Add Material
          </button>
          </h3>
        </div>
        <div class="card-body">
          <?php
          $products = getAll('products');
          if(!$products){
            echo '<h4>Something Went Wrong!</h4>';
            return false;
          }
          if(mysqli_num_rows($products) > 0)
          {
          ?>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <!-- <th>Category Name</th> -->
                <th>Materials</th>
                <th>Name</th>
                <th>Note</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
    <?php foreach($products as $item): ?>
        <tr>
           <!-- <td>Category Name</td> -->
            <td>
                <?php if(!empty($item['image'])): ?>
                    <img src="../<?php echo $item['image']; ?>" style="width:50px;height:50px;" alt="Product Image" />
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['description']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>
                <?php if($item['status'] == 1): ?>
                    <span class="badge bg-danger">Unavailable</span>
                <?php else: ?>
                    <span class="badge bg-primary">Available</span>
                <?php endif; ?>
            </td>
            <td>
              <div class="action-buttons">
                  <button onclick="editUser(<?php echo $item['id']; ?>)" class="edit-btn btn-success">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button type="button" class="delete-btn btn-danger" data-product-id="<?php echo $item['id']; ?>">
                      <i class="fas fa-trash-alt"></i> Delete
                  </button>
              </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

            <tfoot>
              <tr>
                <!-- <th>Category</th> -->
                <th>Materials</th>
                <th>Name</th>
                <th>Note</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
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
</div>

<?php include('includes/script.php'); ?>

<script>
  // Add an event listener to the delete buttons
  document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function() {
      // Get the product ID from the data attribute
      var productId = this.getAttribute('data-product-id');
      // Set the data-product-id attribute of the confirm delete button
      document.getElementById('confirmDelete').setAttribute('data-product-id', productId);
      // Show the delete confirmation modal
      $('#deleteProductModal').modal('show');
    });
  });

  // Add an event listener to the confirm delete button in the modal
  document.getElementById('confirmDelete').addEventListener('click', function() {
    // Get the product ID from the data attribute
    var productId = this.getAttribute('data-product-id');
    // Redirect to products-delete.php with the product ID
    window.location.href = 'products-delete.php?id=' + productId;
  });
</script>

<script>
  function editUser(userId) {
    window.location.href = 'products-edit.php?user_id=' + userId;
  }
</script>

<?php include('includes/footer.php'); ?>