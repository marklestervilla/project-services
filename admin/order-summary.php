<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

if(!isset($_SESSION['productItems'])){
    echo '<script> window.location.href = "order-create.php"; </script>';
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <?php 
        alertMessage();
        ?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Summary</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->



<!-- Add saveOrder Modal -->

<div class="modal fade" id="addSaveOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Order Place Successfully!
        <div class="mb-3 p-4">
          <h5 id="orderPlaceSuccessMessage"></h5>
        </div>

        <a href="orders.php" class="btn btn-secondary">Close</a>
        <a href="order-create.php" class="btn btn-primary">Order Create</a>
        
        <!-- <button class="btn btn-success px-4 mx-1 btn-print">Print</button> -->

      </div>
    </div>
  </div>
</div>

<!-- //Add saveOrder Modal -->




<div class="container-fluid px-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">
            Order Summary
            <a href="order-create.php" class="btn btn-danger float-right">Back to Create Order</a>
          </h4>
        </div>
        <div class="card-body">

        <div id="myBillingArea">

          <?php
          if(isset($_SESSION['cphone']))
          {
              $phone = validate($_SESSION['cphone']);
              $invoiceNo = validate($_SESSION['invoice_no']);

              $customerQuery = mysqli_query($con, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
              if($customerQuery){
                if(mysqli_num_rows($customerQuery) > 0){

                  $cRowData = mysqli_fetch_assoc($customerQuery);
                  ?>
                  <table style="width: 100%; margin-bottom: 20px;">
                    <tbody>
                      <tr>
                        <td style="text-align: center;" colspan="2">
                          <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding: 0;">Company XYZ</h4>
                          <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">#555, 1st Street, 3rd cross, sample, country</p>
                          <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">company xyz pvt ltd.</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h5 style="font-size: 20px; line-height: 30px; margin:2px; padding: 0;">Customer Details</h5>
                          <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Name: <?= $cRowData['name'] ?> </p>
                          <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Phone No.: <?= $cRowData['phone'] ?></p>
                          <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Email Id: <?= $cRowData['email'] ?></p>
                        </td>
                          <td align="end">
                            <h5 style="font-size: 20px; line-height: 30px; margin:2px; padding: 0;">Invoice Details</h5>
                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Invoice No: <?= $invoiceNo; ?></p>
                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Invoice Data: <?= date('d M Y'); ?> </p>
                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Address: 1st main road, Cabuyao Laguna, Philippines </p>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                }else{
                  echo "<h5>No Customer Found</h5>";
                  return;
                }
              }
          }
          ?>

          <?php 
          if(isset($_SESSION['productItems']))
          {
              $sessionProducts = $_SESSION['productItems'];
              ?>
                <div class="table-responsive mb-3">
                <table style="width:100%;" cellpadding="5">
                  <thead>
                    <tr>
                      <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                      <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                      <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                      <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                      <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                    </tr>
                  </thead>
                <tbody>
                <?php
                      $i = 1;
                      $totalAmount = 0;

                      foreach($sessionProducts as $key => $row) :
                          // Calculate the total price for each item
                          $totalItemPrice = $row['price'] * $row['quantity'];
                          $totalAmount += $totalItemPrice;
                      ?>
                      <tr>
                          <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['price'], 0) ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['quantity'] ?></td>
                          <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                              <?= number_format($totalItemPrice, 0) ?>
                          </td>
                      </tr>
                      <?php endforeach ?>

                      <tr>
                          <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td> 
                          <td colspan="1" style="font-weight: bold;"> ₱ <?= number_format($totalAmount, 0); ?></td>
                      </tr>
                      <tr>
                          <td colspan="5">Payment Mode: <?= $_SESSION['payment_mode']; ?> </td>
                      </tr>
                </tbody>
                </table>
                </div>
              <?php
          }
          else
          {
              echo '<h5 class="text-center">No Item Added</h5>';
          }
          ?>

        </div>

          <!-- Form for saving the order -->
          <form method="post" action="orders-code.php">
            <?php if(isset($_SESSION['productItems'])) : ?>
              <div class="mt-4 text-right">
                  <button type="submit" class="btn btn-primary px-4 mx-1" name="saveOrder">Save</button>
              </div>
            <?php endif; ?>
          </form>
          <!-- End of form -->

        </div>
      </div>
    </div>
  </div>
</div>




<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>