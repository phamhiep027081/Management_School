<!-- UPDATE INFO TEACHER -->
<?php
    include"../database/config.php";
    if(isset($_POST['update'])){
        $email = $_POST['email'];
        $name = $_POST['full_name'];
        $date = $_POST['birth_day'];
        $khoa = $_POST['khoa'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $query = "UPDATE user SET fullname='$name', birthday='$date', Ma_khoa='$khoa', address='$address', phone='$phone' WHERE email='$email'";
        mysqli_query($conn, $query) or die("Cập nhật thất bại!");
        header('location:list_teacher.php');
    }
?>
<!-- END UPDATE -->