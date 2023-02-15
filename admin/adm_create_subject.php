<title>Create Subject</title>
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
                                    <h6 class="m-0 font-weight-bold text-primary"style="font-size: 1.2rem;">Thông tin môn học</h6>
                                </div>
                                <div class="card-body">
                                    <table class=" card-body ml-5">
                                        <form method="POST" action="" class="form-control" autocomplete="off">
                                            <tr>
                                                <td>Tên Môn Học</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="subject_name"></td>
                                            </tr>
                                            <tr>
                                                <td>Mã Môn Học</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="subject_id"></td>
                                            </tr>
                                            <tr>
                                                <td>Khoa/Viện</td>
                                                <td>
                                                <select name="khoa" class="form-control ml-3 mt-2">
                                                    <option selected>Viện Đào Tạo</option>
                                                    <?php 
                                                        include"../database/config.php";
                                                        $sql = "SELECT * FROM khoa_data order by Ma_Khoa ASC";
                                                        $result = mysqli_query($conn,$sql);
                                                        echo(mysqli_num_rows($result));
                                                        if(mysqli_num_rows($result)>0){
                                                            while($row = mysqli_fetch_assoc($result)){
                                                                echo"<option value='".$row['Ma_Khoa']."'>".strtoupper($row['Ma_Khoa'])." - ".$row['Ten_Khoa']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Số tín</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="So_Tin"></td>
                                            </tr>
                                            <tr>
                                                <td>Trọng số</td>
                                                <td><input type="text" class="form-control ml-3 mt-2" name="Trong_So"></td>
                                            </tr>
                                            <tr>
                                                <td><button type="submit" class="btn btn-primary mt-3 text-center mb-4" name="submit">Thêm</button></td>
                                            </tr>
                                        </form>
                                    </table>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include"../database/config.php";
                                                    $sql = "SELECT * FROM subject
                                                            LEFT JOIN khoa_data
                                                            ON subject.Ma_Khoa = khoa_data.Ma_Khoa
                                                            ORDER BY subject.time DESC
                                                            LIMIT 10";
                                                    $result = mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            echo"<tr>";
                                                            echo"<td>".$row['subject_name']."</td>";
                                                            echo"<td>".$row['subject_id']."</td>";
                                                            echo"<td>".$row['Ten_Khoa']."</td>";
                                                            echo"<td>".$row['So_Tin']."</td>";
                                                            echo"<td>".$row['Trong_So']."</td>";
                                                            echo"</tr>";
                                                        }
                                                    }
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
</body>

</html>
<?php
include "../database/config.php";
if(isset($_SESSION['CurrenAdmin'])){
    if(isset($_POST['submit']) &&  $_POST["subject_id"] != '' && $_POST["subject_name"] != '' &&  $_POST["So_Tin"] != '' && $_POST["khoa"] != '' && $_POST["Trong_So"] != '' ){
        $subject_id = $_POST['subject_id'];
        $Trong_So = $_POST['Trong_So'];
        $subject_name = $_POST['subject_name'];
        $So_Tin = $_POST["So_Tin"];
        $khoa = $_POST["khoa"];
        $sql = "SELECT * FROM subject WHERE subject_id='$subject_id'";
        $result = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0){
            echo '<script language="javascript">';
            echo 'alert("Subject ID already exists!")';
            echo '</script>';
        }
        else{
            $sql = "INSERT INTO subject (subject_name,subject_id,Ma_Khoa,So_Tin,Trong_So) VALUES ('$subject_name','$subject_id','$khoa','$So_Tin','$Trong_So')";
            mysqli_query($conn,$sql);
            echo '<script language="javascript">';
            echo 'alert("Successful!")';
            echo '</script>';
            
        }
        header('location:adm_create_subject.php');
    }
} else {
    header('location:../index.php');
}
?>