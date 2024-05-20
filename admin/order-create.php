<?php
// session_start(); // Start the session if not already started

// Initialize $_SESSION['productItemIds'] if not set
if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}
if (!isset($_SESSION['productItemIds'])) {
    $_SESSION['productItemIds'] = [];
}

// Include other necessary files
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>



<!-- Add Customer Modal -->

<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label>Enter Customer Name</label>
            <input type="text" class="form-control" id="c_name" />
        </div>
        <div class="mb-3">
            <label>Enter Customer Phone No.</label>
            <input type="text" class="form-control" id="c_phone" />
        </div>
        <div class="mb-3">
            <label>Enter Customer Email (Optional*)</label>
            <input type="text" class="form-control" id="c_email" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary saveCustomer">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- //Add Customer Modal -->


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
                    <li class="breadcrumb-item active"> Order</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> <i class="fas fa-plus-circle"></i> Create Order
                        <a href="orders.php" class="btn btn-danger btn-sm float-right">Back</a>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php alertMessage(); ?>

                        <div class="col-md-6">
                        <form action="orders-code.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="name">Select Product:</label>
                                            <select name="product_id" class="form-select mySelect2">
                                                    <option value="">--Select Product--</option>
                                                    <?php
                                                    $products = getAll('products');
                                                    if($products && mysqli_num_rows($products) > 0) {
                                                        foreach($products as $prodItem) {
                                                            ?>
                                                            <option value="<?= $prodItem['id']; ?>"><?= $prodItem['name']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                    ?>
                                                    <option value="">No Product Found!</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="name">Quantity</label>
                                            <input type="number" name="quantity" value="1" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="name">&nbsp;</label> <!-- Empty label for alignment -->
                                            <button type="submit" name="addItem" class="btn btn-info form-control">Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

               <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0">Materials</h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_SESSION['productItems']))
                    {
                        $sessionProducts = $_SESSION['productItems'];
                        if(empty($sessionProducts)){
                            unset($_SESSION['productItemIds']);
                            unset($_SESSION['productItems']);
                        }

                        ?>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($sessionProducts as $key => $item) : 
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td class="pricePerUnit"><?= $item['price']; ?></td> <!-- Display price per unit -->
                                        <td>
                                            <div class="input-group qty Box"> <!-- Correct class name to match JavaScript -->
                                                <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId" />
                                                <button class="input-group-text decrement">-</button>
                                                <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput" />
                                                <button class="input-group-text increment">+</button>
                                            </div>
                                        </td>
                                        <td class="totalPrice"><?= number_format($item['price'] * $item['quantity'], 2); ?></td> <!-- Display total price -->   
                                        <td>
                                            <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                                        
                        <div class="mt-2">
                            <hr>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Select Payment Mode</label>
                                    <select id="payment_mode" class="form-select">
                                        <option value="">--Select Payment--</option>
                                        <option value="Cash Payment">Cash Payment</option>
                                        <option value="Online Payment">Online Payment</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                <label>Enter Customer Phone Number</label>
                                <input type="number" id="cphone" class="form-control" value="" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <br/>
                                    <button type="button" class="btn btn-warning w-100 proceedToPlace">Proceed to place order</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo '<h5>No Items Added</h5>';
                    }
                    
                    ?>
                </div>
               </div>

            </div>
        </div>
    </div>
</section>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>