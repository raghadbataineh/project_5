<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM users";
include '../check_login.php';
if (!isset($loggedInUserId)||$loggedInUserRole!="admin") {	
    header("Location: ../login/login.php");
}
if ($loggedInUserRole!="admin") {	
    header("Location: ../login/index1.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <br><br>
<!-- Heading -->
<div class="sidebar-heading">
                Tables
            </div>

            

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link" href="Tables_users.php">
                <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item - Category -->
            <li class="nav-item">
                <a class="nav-link" href="Tables_Category.php">
                <i class="fas fa-fw fa-sitemap"></i>
                    <span>Category</span></a>
            </li>

            <!-- Nav Item - product -->
            <li class="nav-item">
                <a class="nav-link" href="Tables_product.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Product</span></a>
            </li>

            <!-- Nav Item - Inquiries -->
            <li class="nav-item">
                <a class="nav-link" href="Tables_contact_us.php">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Inquiries</span></a>
            </li>  
            
            <!-- Nav Item - review -->
            <li class="nav-item">
                <a class="nav-link" href="Tables_Review.php">
                <i class="fas fa-fw fa-comment"></i>
                <span>Review</span></a>
            </li> 

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <!-- Topbar Search -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 text-gray-600 small"><?=$loggedInUserName?></span>
                                <img class="img-profile rounded-circle"
                                    src="data:image/jpeg;base64,<?=base64_encode($loggedInUserImg)?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <!-- <div class="dropdown-item"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["confirm"])) {
    $Category_id = $_POST["Category_id"];
    $img = $_FILES["img"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($img));
    $name = $_POST["name"];
    $description = $_POST["description"];

    // Update query
    $updateSql = "UPDATE Category SET 
                  Category_img = '$imgContent',
                  Category_name = '$name',
                  Category_description = '$description'
                  WHERE Category_id = $Category_id";

    if ($conn->query($updateSql) === TRUE) {
        echo "Category updated successfully!";
    } else {
        echo "Error updating category: " . $conn->error;
    }
}

$categoryQuery = "SELECT Category_id FROM Category";
$categoryResult = $conn->query($categoryQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Category_id = $_POST["Category_id"];
    $sql = "SELECT * FROM Category WHERE Category_id = $Category_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>


 <div class="container mt-1 mb-5">
        <h1>Edit Category</h1>
        <form method="post" enctype="multipart/form-data">
            <?php echo '<div class="mb-3">' .'<img high="300px" width="300px" class="img-thumbnail" src="data:image/jpeg;base64,' . base64_encode($row["Category_img"]) . '" alt="Image">'.'</div>';?><br>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" class="form-control-file" name="img" accept="image/*" required>
            </div>

            <input type="hidden" name="Category_id" value="<?php echo $row['Category_id']; ?>" required>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['Category_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" value="<?php echo $row['Category_description']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="confirm">Update Category</button>
            <a class="btn btn-secondary " target="_blank" href="Tables_Category.php">Back to Category Table</a>
        </form>
    </div>


<?php
$conn->close();
?>


                </div>
                <!-- /.container-fluid -->

            </div>



            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- <a class="btn btn-primary" >Logout</a> -->
                    <form method="post" >
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>