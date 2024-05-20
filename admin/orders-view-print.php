<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

$logo_url = '../admin/images/icon-gbua-trans.png'; // Replace this with the actual path to your 

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
                        <li class="breadcrumb-item active">Orders Print</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Print Order
                    <a href="orders.php" class="btn btn-danger btn-sm float-right">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div id="myBillingArea">
                    <?php
                    if(isset($_GET['track'])) {
                        $trackingNo = validate($_GET['track']);
                        if($trackingNo == ''){
                            ?>
                             <div class="text-center py-5">
                                <h5>Please provide Tracking Number</h5>
                                <div>
                                    <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                                </div>
                            </div>
                            <?php
                        }
                        $orderQuery = "SELECT o.*, c.* FROM orders o, customers c 
                            WHERE c.id=o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
                        $orderQueryRes = mysqli_query($con, $orderQuery);
                        if(!$orderQueryRes){
                            echo "<h5>Something Went Wrong!</h5>";
                            return false;
                        }
                        if(mysqli_num_rows($orderQueryRes) > 0) {
                            $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                            ?>
                            <table style="width: 100%; margin-bottom: 20px;">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;" colspan="2">
                                            <img src="<?php echo $logo_url; ?>" alt="Logo" style="max-width: 50px; height: auto;">
                                            <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding: 0;"> GBUA Construction Services</h4>
                                            <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">Cabuyao, Philippines, 40w5 4025</p>
                                            <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">gbuaconstructionservices@gmail.com</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-size: 20px; line-height: 30px; margin:2px; padding: 0;">Customer Details</h5>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Name: <?= $orderDataRow['name'] ?> </p>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Phone No: <?= $orderDataRow['phone'] ?></p>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Customer Email ID: <?= $orderDataRow['email'] ?></p>
                                        </td>
                                        <td align="end">
                                            <h5 style="font-size: 20px; line-height: 30px; margin:2px; padding: 0;">Invoice Details</h5>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;" data-invoice-no><?= $orderDataRow['invoice_no']; ?></p>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Invoice Data: <?= date('d M Y'); ?> </p>
                                            <p style="font-size: 14px; line-height: 20px; margin:2px; padding: 0;">Address: Pulo, City of Cabuyao Laguna </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "<h5>No Data Found</h5>";
                            return false;
                        }
                        $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* 
                            FROM orders o, order_items oi, products p 
                            WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$trackingNo' ";
                        $orderItemQueryRes = mysqli_query($con, $orderItemQuery);
                        if($orderItemQueryRes) {
                            if(mysqli_num_rows($orderItemQueryRes) > 0) {
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
                                            foreach($orderItemQueryRes as $key => $row) :
                                            ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['orderItemPrice'], 0) ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td> 
                                                <td colspan="1" style="font-weight: bold;"> ₱ <?= number_format($row['total_amount'], 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">Payment Mode: <?= $row['payment_mode']; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else {
                                echo "<h5>No Data Found</h5>";
                                return false;
                            }
                        } else {
                            echo "<h5>Something Went Wrong</h5>";
                            return false;
                        }
                    } else {
                        ?>
                        <div class="text-center py-5">
                            <h5>No Tracking Number Parameter Found</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="mt-4 text-right">
                    <button class="btn btn-success px-4 mx-1 btn-print">Print</button>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/script.php'); ?>

<script>
    function printMyBillingArea() {
        var divContents = document.getElementById("myBillingArea").innerHTML;
        var invoiceNo = document.querySelector("[data-invoice-no]").textContent.trim(); // Get the invoice number
        var filename = 'Invoice_' + invoiceNo + '.pdf'; // Set the filename
        var a = window.open('', '');
        a.document.write('<html><title>GBUA SERVICES</title>');
        a.document.write('<body style="font-family: fangsong;">');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
        a.document.title = filename; // Set the title for the PDF
        a.document.filename = filename; // Set the filename for the PDF
    }
    
    $(document).on('click', '.btn-print', function() {
        printMyBillingArea();
    });
</script>


<?php include('includes/footer.php'); ?>