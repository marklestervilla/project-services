



$(document).ready(function () {
    // Increment quantity
    $(document).on('click','.increment', function (){
        var $quantityInput = $(this).closest('.Box').find('.qty'); // Corrected class name
        var $productId = $(this).closest('.Box').find('.prodId').val(); // Corrected class name
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue)){
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec($productId, qtyVal); // Corrected function call
            updateTotalPrice($productId, qtyVal); // Update total price
        }
    });

    // Decrement quantity
    $(document).on('click','.decrement', function (){
        var $quantityInput = $(this).closest('.Box').find('.qty'); // Corrected class name
        var $productId = $(this).closest('.Box').find('.prodId').val(); // Corrected class name
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec($productId, qtyVal); // Corrected function call
            updateTotalPrice($productId, qtyVal); // Update total price
        }
    });

    // Function to handle quantity increment/decrement
    function quantityIncDec(prodId, qty){
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty
            },
            success: function (response) {
                var res = JSON.parse(response);
                if(res.status == 200){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.'
                });
            }
        });
    }

    // Function to update total price
    function updateTotalPrice(productId, quantity) {
        var $productRow = $('.prodId[value="' + productId + '"]').closest('tr');
        var pricePerUnit = parseFloat($productRow.find('.pricePerUnit').text());
        var total = pricePerUnit * quantity;
        $productRow.find('.totalPrice').text(total.toFixed(2)); // Update total price in the row
    }
    
        // Proceed to place order button click
        $(document).on('click', '.proceedToPlace', function () {
            var payment_mode = $('#payment_mode').val();
            var cphone = $('#cphone').val(); // Added to capture customer phone number

            if (payment_mode === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Select Payment Mode',
                    text: 'Please select a payment mode'
                });
                return false;
            }

            if (cphone === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Enter Phone Number',
                    text: 'Please Enter Valid Phone Number'
                });
                return false;
            }

            // Show a confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to proceed to place the order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with placing the order
                    // You can redirect to the order processing page or perform any other action here
                    // For example, you can submit the form to 'orders-code.php'
                    var data = {
                        'proceedToPlaceBtn': true,
                        'payment_mode': payment_mode,
                        'cphone': cphone,
                    };

                    $.ajax({
                        type: "POST",
                        url: "orders-code.php",
                        data: data,
                        success: function (response) {
                            // Handle the response if needed
                            var res = JSON.parse(response);
                            if(res.status == 200){
                                window.location.href = "order-summary.php";
                            } else if(res.status == 404) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Customer Not Found',
                                    text: 'Customer not found. Do you want to add a new customer?',
                                    showCancelButton: true,
                                    confirmButtonText: 'Add Customer',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to add customer page or trigger a modal to add a customer
                                        // console.log('Redirect or open modal to add customer');
                                        $('#c_phone').val(cphone);
                                        $('#addCustomerModal').modal('show');
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred. Please try again.'
                            });
                        }
                    });
                }
            });
        });

        // Add customer to customer table
        $(document).on('click', '.saveCustomer', function() {

            var c_name = $('#c_name').val();
            var c_phone = $('#c_phone').val();
            var c_email = $('#c_email').val();

            if(c_name != '' && c_phone != '')
            {
                if($.isNumeric(c_phone)){

                    var data = {
                        'saveCustomerBtn': true,
                        'name': c_name,
                        'phone': c_phone,
                        'email': c_email,
                    };

                    $.ajax({
                        type: "POST",
                        url: "orders-code.php",
                        data: data,
                        success: function (response) {
                            var res = JSON.parse(response);

                            if(res.status == 200){
                                Swal.fire(res.message, res.message, res.status_type);
                                $('#addCustomerModal').modal('hide');
                            }else if(res.status == 422){
                                Swal.fire(res.message, res.message, res.status_type);
                            }else{
                                Swal.fire(res.message, res.message, res.status_type);
                            }
                        }
                    });

                }else{
                    Swal.fire("Enter Valid Phone Number","","warning");
                }
            }
            else
            {
                Swal.fire("Please Fill required fields","","warning");
            }
        });



        $(document).on('click', 'button[name="saveOrder"]', function (event){
            event.preventDefault(); // Prevent default form submission
                    
            $.ajax({
                type: "POST",
                url: "orders-code.php",
                data: {
                    'saveOrder': true
                },
                success: function (response) {
                    var res = JSON.parse(response);
                
                    if(res.status == 200){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then(function() {
                            // Display the modal after success message
                            $('#addSaveOrderModal').modal('show');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message
                        });
                    }
                }
            });
        });

       

});



