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

    <title>Danh sách lớp</title>

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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <form class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 
                            mw-100 navbar-search ">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Mã lớp học..."
                            aria-label="Search" aria-describedby="basic-addon2" id="subject_id">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="class_id_search">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div id="livesearch"></div>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                echo'<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$_SESSION['CurrenUser'].'</span>';
                            ?>
                            <img class="img-profile rounded-circle"
                                src="../img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../accounts/change_password.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đổi mật khẩu
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Danh sách lớp học</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="dropdown text-left">
                                <button class="btn btn-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Học kỳ
                                </button>
                                <div class="dropdown-menu animated--fade-in"
                                    aria-labelledby="dropdownMenuButton">
                                    <?php 
                                        include"../database/config.php";
                                        $sql = "SELECT * FROM couse order by couse_id DESC LIMIT 3";
                                        $result = mysqli_query($conn,$sql);
                                        $number = 1;
                                        if(mysqli_num_rows($result)>0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo"<button class='dropdown-item text-center' name='hocKy' id='option".$number."' value='".$row['couse_id']."'>"."Học kỳ ".$row['couse_id']."</button>";
                                                $number = $number+1;
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Viện</th>
                                        <th>Giảng viên</th>
                                        <th>Học kỳ</th>
                                        <th>Sỹ số</th>
                                    </tr>
                                    </thead>
                                    <tbody id="class_table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
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
    <script>
    $(document).ready(function(){
        $("#class_id_search").click(function(){
            var subject_id = $("#subject_id").val();
            console.log(subject_id);
            $.get("table_class_handle.php",{subject_id:subject_id},function(data){
                $("#class_table").html(data);
            });
        });
        $("#option1").click(function(){
            var choose = $("#option1").val();
            $.get("table_class_handle.php",{choose:choose},function(data){
                $("#class_table").html(data);
            });
        });
        $("#option2").click(function(){
            var choose = $("#option2").val();
            $.get("table_class_handle.php",{choose:choose},function(data){
                $("#class_table").html(data);
            });
        });
        $("#option3").click(function(){
            var choose = $("#option3").val();
            $.get("table_class_handle.php",{choose:choose},function(data){
                $("#class_table").html(data);
            });
        });
        $.get("table_class_handle.php",{},function(data){
            $("#class_table").html(data);
        });
    });
    </script>
</body>

</html>
<!-- <?php
include "../database/config.php";
echo ($_GET['class_id']);
if(isset($_SESSION['CurrenAdmin'])){
    if(isset($_POST['submit']) &&  $_POST["student_id"] != '' && $_GET["class_id"] != '' && $_GET["couse_id"] != ''){
        $student_id = $_POST['student_id'];
        $class_id = $_GET['class_id'];
        $couse_id = $_GET['couse_id'];
        $sql = "SELECT * FROM mark_data WHERE student_id='$student_id' AND class_id='$class_id' AND couse_id='$couse_id'";
        $result = mysqli_query($conn,$sql);
        $sql = "SELECT * FROM student WHERE student_id='$student_id'";
        $std_check = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0 or mysqli_num_rows($std_check) == 0){
            echo '<script language="javascript">';
            echo 'alert("Subject ID already exists!")';
            echo '</script>';
        }
        else{
            $sql = "SELECT subject_id FROM classes WHERE class_id='$class_id' AND couse_id='$couse_id'";
            $result = mysqli_query($conn,$sql);
            $subject_id = mysqli_fetch_assoc($result);
            $subject_id = $subject_id['subject_id'];
            $sql = "INSERT INTO mark_data (student_id,subject_id,class_id,couse_id) VALUES ('$student_id','$subject_id','$class_id','$couse_id')";
            mysqli_query($conn,$sql);
            echo '<script language="javascript">';
            echo 'alert("Successful!")';
            echo '</script>';
            
        }
        // header('location:add_to_class.php');
    }
} else {
    header('location:../index.php');
}
?> -->