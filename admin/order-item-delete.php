<?php
session_start(); // Start the session if not already started

// Include necessary files
include('config/function.php');

// Check if index parameter is provided in the URL
if(isset($_GET['index'])) {
    $index = $_GET['index'];

    // Check if the index exists in the session array
    if(isset($_SESSION['productItems'][$index])) {
        // Remove the item from the session array based on the index
        unset($_SESSION['productItems'][$index]);
        unset($_SESSION['productItemIds'][$index]);
        
        // Reindex the array
        $_SESSION['productItems'] = array_values($_SESSION['productItems']);
        $_SESSION['productItemIds'] = array_values($_SESSION['productItemIds']);

        // Redirect back to order-create.php with a success message
        redirect('order-create.php', 'Item removed successfully.');
    } else {
        // If the index does not exist in the session array, redirect back with an error message
        redirect('order-create.php', 'Invalid index.');
    }
} else {
    // If index parameter is not provided, redirect back with an error message
    redirect('order-create.php', 'Index not provided.');
}
?>
