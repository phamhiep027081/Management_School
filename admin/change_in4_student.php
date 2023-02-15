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

    <title>Add Student</title>

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
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4 shadow mt-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"style="font-size: 1.2rem;">Thông tin sinh viên</h6>
                                </div>
                                <div class="card-body">
                                    <table class="card-body ml-5">
                                        <?php
                                            include"../database/config.php";
                                            if(isset($_GET['student_id'])){ 
                                                $student_id = $_GET['student_id'];
                                            
                                                $sql = "SELECT student_id, fullname, birth_day, address, email, khoa_data.Ten_Khoa, khoa_data.Dia_Chi FROM student 
                                                LEFT JOIN khoa_data 
                                                ON student.Ma_Khoa = khoa_data.Ma_Khoa 
                                                WHERE student_id = '$student_id'";
                                                $result = mysqli_query($conn,$sql);
                                                $info = mysqli_fetch_assoc($result);
                                        ?>
                                        <form method="POST" action="update_info_student.php" class="form-control" autocomplete="off">
                                            <tr class="">
                                                <td class="mt-2">Họ tên:</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="full_name" value="<?php echo $info['fullname']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="mt-2">MSSV:</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="student_id" value="<?php echo $student_id; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="mt-2">Ngày sinh:</td>
                                                <td><input type="date" class="form-control ml-3 mt-2" name="birth_day" id="" value="<?php echo $info['birth_day']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="mt-2">Khoa/Viện:</td>
                                                <td>
                                                <select name="khoa" class="form-control ml-3 mt-2">
                                                    <option selected><?php echo $info['Ten_Khoa']; ?></option>
                                                    <?php 
                                                        include"../database/config.php";
                                                        $sql = "SELECT * FROM khoa_data order by Ma_Khoa ASC";
                                                        $result = mysqli_query($conn,$sql);
                                                        echo(mysqli_num_rows($result));
                                                        if(mysqli_num_rows($result)>0){
                                                            while($row = mysqli_fetch_assoc($result)){
                                                                if($row['Ma_Khoa'] != 'pdt')
                                                                echo"<option class='form-control' value='".$row['Ma_Khoa']."'>".strtoupper($row['Ma_Khoa'])." - ".$row['Ten_Khoa']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mt-2">Địa chỉ:</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="address" value="<?php echo $info['address']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="mt-2">Email:</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="email" value="<?php echo $info['email']; ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><button type="submit" class="btn btn-primary mt-3 text-center mb-4" name="update">Cập nhật</button></td>
                                            </tr>
                                        </form>
                                        <?php 

                                            } //Đóng câu lệnh if.

                                            //Đóng kết nối database
                                            mysqli_close($conn);
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                           
                <!-- end content -->
            </div>
            <!-- End of Main Content -->
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
