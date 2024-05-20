<?php
if(isset($_SESSION['status']))

{
    $status = $_SESSION['status'];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-circle"></i></strong> ' . $status . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['status']); // Clear the status after displaying it
}
?>