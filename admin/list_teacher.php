<?php
    session_start();
    if(!isset($_SESSION['CurrenUser'])){
        header('location:../accounts/login.php');
    }else {
        if(!isset($_SESSION['CurrenAdmin'])){
            header('location:../index.php');
        }
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

    <title>Cổng Thông Tin Đào Tạo</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <?php
            require("front_end/sidebar.php");
        ?>
        <!-- end sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                    require("front_end/topbar.php");
                ?>
                <!-- End of Topbar -->
                <!-- content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4 shadow mt-2">
                                <div class="card-body">
                                    <h6 class="m-0 font-weight-bold text-primary mb-3"style="font-size: 1.2rem;">Danh sách giảng viên</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Họ tên</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Khoa</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Email</th>
                                                    <th>Điện thoại</th>
                                                    <th>Xử lý</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include"../database/config.php";
                                                    $sql = "SELECT * FROM user
                                                            LEFT JOIN khoa_data
                                                            ON user.Ma_Khoa = khoa_data.Ma_Khoa
                                                            WHERE user.level = '0'
                                                            ORDER BY user.time DESC";
                                                    $result = mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            echo"<tr>";
                                                            echo"<td>".$row['fullname']."</td>";
                                                            echo"<td>".$row['birthday']."</td>";
                                                            echo"<td>".$row['Ten_Khoa']."</td>";
                                                            echo"<td>".$row['address']."</td>";
                                                            echo"<td>".$row['email']."</td>";
                                                            echo"<td>".$row['phone']."</td>";
                                                            echo"<td><a href = '#'>Xoá</a>
                                                             | <a href = 'change_in4_teacher.php?id=".$row['email']."'>Sửa</a></td>";
                                                            echo"</tr>";
                                                        }
                                                    }
                                                    mysqli_close($conn);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            <!-- End of Main Content -->
            </div>
            <!-- Footer -->
                <?php
                    require("front_end/footer.php");
                ?>
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
    <?php
        require("front_end/logout_model.php");
    ?>
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>