<?php 
require 'config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $adminId = validate($paramResultId);
    $admin = getById('admins', $adminId);
    if($admin['status'] == 200)
    {
        $adminDelete = delete('admins', $adminId);
        if($adminDelete)
        {
            redirect('admin.php', 'Admin Deleted Successfully');
        }
        else
        {
            redirect('admin.php', 'Something went wrong.');
        }
    }
    else
    {
        redirect('admin.php', $admin['message']);
    }
}
else{
    redirect('admin.php', 'Something went wrong.');
}
?>
