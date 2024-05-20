<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>

<!-- Modal -->

<!-- Add Admin Modal -->
<div class="modal fade" id="AddAdminModal" tabindex="-1" role="dialog" aria-labelledby="AddAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddAdminModalLabel">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields here for adding a user -->
                <form action="code-pos.php" method="POST">
                    <div class="form-group">
                        <label for=""> Name * </label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Email * </label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Password * </label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Phone Number * </label>
                        <input type="number" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Is ban * </label>
                        <input type="checkbox" name="is_ban" style="width:30px;height:30px;" />
                    </div>

                    <!-- Add more fields as needed -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- //Add Admin Modal -->

<!-- Delete Admin Modal -->
<div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this admin?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>


<!-- // Modal -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php alertMessage(); ?>

                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Admin / Staffs
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#AddAdminModal">
                                    Add Admin / Staffs
                                </button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php
                        $admins = getAll('admins');
                        if(!$admins){
                          echo '<h4>Something Went Wrong!</h4>';
                          return false;
                        }
                        if(mysqli_num_rows($admins) > 0)
                        {
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($admins as $adminItem) : ?>
                                    <tr>
                                        <td><?= $adminItem['id'] ?></td>
                                        <td><?= $adminItem['name'] ?></td>
                                        <td><?= $adminItem['email'] ?></td>
                                        <td>
                                            <a href="admin-edit.php?id=<?= $adminItem['id']; ?>"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteAdminModal"
                                                data-id="<?= $adminItem['id'] ?>">Delete</a>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    else
                    {
                      ?>
                        <h4 class="mb-0">No Record Found</h4>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php include('includes/script.php'); ?>

    <script>
    $(document).ready(function() {
        $('#deleteAdminModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var adminId = button.data('id'); // Extract ID from data-id attribute
            var modal = $(this);
            modal.find('#confirmDeleteBtn').attr('href', 'admin-delete.php?id=' +
            adminId); // Set href of delete button
        });
    });
    </script>

    <?php include('includes/footer.php'); ?>