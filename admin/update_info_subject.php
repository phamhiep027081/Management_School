<!-- UPDATE INFO SUBJECT -->
<?php
    include"../database/config.php";
    if(isset($_POST['update'])){
        $name = $_POST['subject_name'];
        $id = $_POST['subject_id'];
        $khoa = $_POST['khoa'];
        $tinChi = $_POST['tin_chi'];
        $trongSo = $_POST['trong_so'];
        $query = "UPDATE subject SET subject_name='$name', subject_id='$id', Ma_khoa='$khoa', So_Tin='$tinChi', Trong_So='$trongSo' WHERE subject_id='$id'";
        mysqli_query($conn, $query) or die("Cập nhật thất bại!");
        header('location:list_subject.php');
    }
?>
<!-- END UPDATE -->