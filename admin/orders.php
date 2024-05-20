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
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">

            <div class="card-header">
                <h4 class="mb-0">Orders</h4>
            </div>
            <div class="card-body">

                <?php
        $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id ORDER BY o.id DESC";
        $orders = mysqli_query($con, $query);
        if($orders){

          if(mysqli_num_rows($orders) > 0)
          {
             ?>
                <table id="example1"
                    class="table table-striped table-bordered align-items-center justify-content-center">
                    <thead>
                        <tr>
                            <th>Tracking No.</th>
                            <th>C Name</th>
                            <th>C Phone</th>
                            <th>Order Date</th>
                            <!-- <th>Order Status</th> -->
                            <th>Payment Mode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $orderItem) : ?>
                        <tr>
                            <td class="fw-bold"><?= $orderItem['tracking_no']; ?></td>
                            <td><?= $orderItem['name']; ?></td>
                            <td><?= $orderItem['phone']; ?></td>
                            <td><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                            <!-- <td><?= $orderItem['order_status']; ?></td> -->
                            <td><?= $orderItem['payment_mode']; ?></td>
                            <td>
                                <a href="orders-view.php?track=<?= $orderItem['tracking_no']; ?>"
                                    class="btn btn-primary mb-0 px-2 btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="orders-view-print.php?track=<?= $orderItem['tracking_no']; ?>"
                                    class="btn btn-success mb-0 px-2 btn-sm">
                                    <i class="fas fa-print"></i> Print
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
          }
          else
          {
              echo "<h5>No Record Found</h5>";
          }
        }
        else
        {
          echo "<h5>Something Went Wrong</h5>";
        }

      ?>

            </div>
        </div>
    </div>


    <?php include('includes/script.php'); ?>
    <?php include('includes/footer.php'); ?>