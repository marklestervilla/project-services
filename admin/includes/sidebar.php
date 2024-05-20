<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets/dist/img/icon-gbua.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">GBUA Services</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/pfpicon.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php 
              if(isset($_SESSION['auth']))
              {
                echo $_SESSION['auth_user']['user_name']; 
              }
              else
              {
                echo "Not Logged In.";
              }
              
              ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Progress</p>
                </a>
              </li> -->
                        <li class="nav-item">
                            <a href="appointment-view.php" class="nav-link">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>Appointment</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="categories.php" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                <a href="categories.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Category</p>
                </a>
              </li> -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-toolbox"></i>
                                <p>
                                    Company Assets
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="equipment.php" class="nav-link">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Equipments</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="products.php" class="nav-link">
                                        <i class="fas fa-box-open nav-icon"></i>
                                        <p>Materials</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Project Order
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="order-create.php" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Create Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="orders.php" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <span class="badge badge-warning right"><?= getCount('orders'); ?></span>
                                        <p>Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="categoryDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-folder nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                                        <a class="dropdown-item" href="category-create.php" style="color: black;">Create
                                            Category</a>
                                        <a class="dropdown-item" href="category.php" style="color: black;">View
                                            Category</a>
                                    </div>
                                </li>

                            </ul>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Project File
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="planDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-paperclip nav-icon"></i>
                                    <span class="badge badge-info right"><?= getCount('project'); ?></span>
                                    <p>Project Plans</p>
                                </a>
                                    <div class="dropdown-menu" aria-labelledby="planDropdown">
                                        <a class="dropdown-item" href="project-create.php" style="color: black;">Create
                                            Project</a>
                                        <a class="dropdown-item" href="project-index.php" style="color: black;">Project
                                            List</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="tasksDropdown" role="button"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-check-circle nav-icon"></i>
                                        <p>Tasks Service</p>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="tasksDropdown">
                                        <a class="dropdown-item" href="task-list.php" style="color: black;">
                                        Task List</a>
                                    </div>
                                </li>


                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="productivityDropdown" role="button"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-folder-open nav-icon"></i>
                                        <p>Productivity</p>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="productivityDropdown">
                                        <a class="dropdown-item" href="productivity-list.php" style="color: black;">
                                        Productivity List</a>
                                    </div>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-header">GENERATING REPORTS: </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Record Reports
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-file nav-icon"></i>
                                        <p>Project Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-file nav-icon"></i>
                                        <p>Task Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-file nav-icon"></i>
                                        <p>Productivity Reports</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-header">INFO: </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Records
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="registered.php" class="nav-link">
                                        <i class="far fa-circle text-warning"></i>
                                        <p>Registered User</p>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-circle text-danger"></i>
                                        Employee Records
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="employee-create.php" style="color: black;">Create
                                            Employee</a>
                                        <a class="dropdown-item" href="employee.php" style="color: black;">View List</a>
                                    </div>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-circle text-primary"></i>
                                        Customer Records
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="customers-create.php" style="color: black;">Create
                                            Customer</a>
                                        <a class="dropdown-item" href="customers.php" style="color: black;">View
                                            Customer</a>
                                    </div>
                                </li>
                        </li>

                        <li class="nav-header">SETTINGS:</li>
                        <li class="nav-item">
                            <a href="settings.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Software Settings</p>
                            </a>
                        </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>