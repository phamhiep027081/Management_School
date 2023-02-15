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
                                    <h6 class="m-0 font-weight-bold text-primary mb-3"style="font-size: 1.2rem;">Danh sách môn học</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Tên môn học</th>
                                                <th>Mã môn học</th>
                                                <th>Khoa/Viện</th>
                                                <th>Số tín chỉ</th>
                                                <th>Trọng số</th>
                                                <th>Xử lý</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <!-- truy xuất -->
                                                <?php
                                                    include"../database/config.php";
                                                    $sql = "SELECT * FROM subject
                                                            LEFT JOIN khoa_data
                                                            ON subject.Ma_Khoa = khoa_data.Ma_Khoa
                                                            ORDER BY subject.time DESC";
                                                    $result = mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            echo"<tr>";
                                                            echo"<td>".$row['subject_name']."</td>";
                                                            echo"<td>".$row['subject_id']."</td>";
                                                            echo"<td>".$row['Ten_Khoa']."</td>";
                                                            echo"<td>".$row['So_Tin']."</td>";
                                                            echo"<td>".$row['Trong_So']."</td>";
                                                            echo"<td><a href = 'change_in4_subject.php?subject_name=".$row['subject_name']."'>Sửa</a></td>";
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
    <!-- <script>
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
    </script> -->
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