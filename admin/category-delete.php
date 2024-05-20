<?php 
require 'config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $categoryId = validate($paramResultId);

    $poscategory = getById('poscategories', $categoryId);

    if($poscategory['status'] == 200)
    {
        $response = delete('poscategories', $categoryId);
        if($response)
        {
            redirect('category.php', 'Category Deleted Successfully');
        }
        else
        {
            redirect('category.php', 'Something went wrong.');
        }
    }
    else
    {
        redirect('category.php', $poscategory['message']);
    }
}
else{
    redirect('category.php', 'Something went wrong.');
}
?>
