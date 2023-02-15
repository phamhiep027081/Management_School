<!-- UPDATE INFO STUDENT -->
<?php
    include"../database/config.php";
    if(isset($_POST['update'])){
        $id = $_POST['student_id'];
        $name = $_POST['full_name'];
        $date = $_POST['birth_day'];
        $khoa = $_POST['khoa'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $query = "UPDATE student SET fullname='$name', birth_day='$date', Ma_Khoa='$khoa', address='$address', email='$email' WHERE student_id='$id'";
        mysqli_query($conn, $query) or die("Cập nhật thất bại!");
        header('location:list_student.php');
    }
?>
<!-- END UPDATE -->