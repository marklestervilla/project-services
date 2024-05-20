<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('config/dbcon.php');
include('config/function.php');

if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}
if (!isset($_SESSION['productItemIds'])) {
    $_SESSION['productItemIds'] = [];
}

if (isset($_POST['addItem'])) {
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($con, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct) {
        if(mysqli_num_rows($checkProduct) > 0){
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['quantity'] < $quantity){
                redirect('order-create.php', 'Only ' .$row['quantity']. ' quantity available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $quantity
            ];

            if(!in_array($productId, $_SESSION['productItemIds'])){
                array_push($_SESSION['productItemIds'],$row['id']);
                array_push($_SESSION['productItems'],$productData);
            } else {
                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){
                        $newQuantity = $prodSessionItem['quantity'] + $quantity;
                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'quantity' => $newQuantity
                        ];
                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }

            redirect('order-create.php', 'Item Added: '.$row['name']);
        } else {
            redirect('order-create.php', 'No such product found!');
        }
    } else {
        redirect('order-create.php', 'Something went wrong!');
    }
}


if(isset($_POST['productIncDec']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    foreach($_SESSION['productItems'] as $key => $item){
        if($item['product_id'] == $productId){
            
            $flag = true;        
            $_SESSION['productItems'][$key]['quantity'] = $quantity;
        }
    }

    if($flag){
            
        jsonResponse(200, 'success', 'Quantity Updated');

    }else{

        jsonResponse(500, 'error', 'Something Went Wrong. Please Re-fresh');
        
    }

}

if(isset($_POST['proceedToPlaceBtn']))
{
    $phone = isset($_POST['cphone']) ? validate($_POST['cphone']) : '';
    $payment_mode = isset($_POST['payment_mode']) ? validate($_POST['payment_mode']) : '';

    // Checking For Customer
    if(!empty($phone)) {
        $checkCustomer = mysqli_query($con, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
        if($checkCustomer){
            if(mysqli_num_rows($checkCustomer) > 0)
            {
                $_SESSION['invoice_no'] = "INV-".rand(111111,999999);
                $_SESSION['cphone'] = $phone;
                $_SESSION['payment_mode'] = $payment_mode;
                jsonResponse(200, 'success', 'Customer Found');
            }
            else
            {
                $_SESSION['cphone'] = $phone;
                jsonResponse(404, 'warning', 'Customer Not Found');
            }
        }
        else
        {
            jsonResponse(500, 'error', 'Something Went Wrong');
        }
    } else {
        jsonResponse(400, 'error', 'Phone number is empty');
    }
}

if(isset($_POST['saveCustomerBtn']))
{
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);

    if($name != '' && $phone != ''){

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ];
        $result = insert('customers', $data);
        if($result){

            jsonResponse(200, 'success', 'Customer Created Successfully');
        }else{
            jsonResponse(500, 'error', 'Something Went Wrong');
        }

    }else{
        jsonResponse(422, 'warning', 'Please fill required fields');
    }

}

if(isset($_POST['saveOrder']))
{
    $phone = isset($_SESSION['cphone']) ? validate($_SESSION['cphone']) : '';
    $invoice_no = isset($_SESSION['invoice_no']) ? validate($_SESSION['invoice_no']) : '';
    $payment_mode = isset($_SESSION['payment_mode']) ? validate($_SESSION['payment_mode']) : '';
    $order_placed_by_id = isset($_SESSION['auth_user']['user_name']) ? $_SESSION['auth_user']['user_name'] : ''; 

    if (!empty($phone) && !empty($invoice_no) && !empty($payment_mode) && !empty($order_placed_by_id)) {
        $checkCustomer = mysqli_query($con, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
        if(!$checkCustomer){
            jsonResponse(500, 'error', 'Something Went Wrong');
        }

        if(mysqli_num_rows($checkCustomer) > 0)
        {
            $customerData = mysqli_fetch_assoc($checkCustomer);

            if(!isset($_SESSION['productItems'])){
                jsonResponse(404, 'warning', 'No Items to place order!');
            }

            $sessionProducts = $_SESSION['productItems'];

            $totalAmount = 0;
            foreach($sessionProducts as $amtItem){
                $totalAmount += $amtItem['price'] * $amtItem['quantity'];
            }

            $data = [
                'customer_id' => $customerData['id'],
                'tracking_no' => rand(11111,99999),
                'invoice_no' => $invoice_no,
                'total_amount' => $totalAmount,
                'order_date' => date('Y-m-d'), // Changed from 'order_data' to 'order_date'
                'order_status' => 'booked',
                'payment_mode' => $payment_mode,
                'order_placed_by_id' => $order_placed_by_id
            ];
            $result = insert('orders', $data);
            $lastOrderId = mysqli_insert_id($con);

            foreach($sessionProducts as $prodItem){
                
                $productId = $prodItem['product_id'];
                $price = $prodItem['price'];
                $quantity = $prodItem['quantity'];

                // Inserting Order items
                $dataOrderItem = [
                    'order_id' => $lastOrderId,
                    'product_id' => $productId,
                    'price' => $price,
                    'quantity' => $quantity,
                ];
                $orderItemQuery = insert('order_items', $dataOrderItem);

                // Checking for the books quantity and decreasing quantity and making total Quantity
                $checkProductQuantityQuery = mysqli_query($con, "SELECT * FROM products WHERE id='$productId' ");
                $productQtyData = mysqli_fetch_assoc($checkProductQuantityQuery);
                $totalProductQuantity = $productQtyData['quantity'] - $quantity;

                $dataUpdate = [
                    'quantity' => $totalProductQuantity
                ];
                $updateProductQty = update('products', $productId, $dataUpdate);
            }

            // After successfully saving the order
                    unset($_SESSION['productItemIds']);
                    unset($_SESSION['productItems']);
                    unset($_SESSION['cphone']);
                    unset($_SESSION['payment_mode']);
                    unset($_SESSION['invoice_no']);

                    $response = [
                        'status' => 200,
                        'status_type' => 'success',
                        'message' => 'Order Placed Successfully',
                        'redirect_url' => 'order-summary.php'
                    ];
                    echo json_encode($response);
                    exit(); // Terminate script execution after sending JSON response
                }
        else
        {
            jsonResponse(404, 'warning', 'No Customer Found');
        }
    } else {
        jsonResponse(400, 'error', 'Session variables are empty (Already Saved)');
    }
}
?>
