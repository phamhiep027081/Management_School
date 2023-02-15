<?php
    session_start();
    include"../database/config.php";
    if(isset($_GET['subject_id'])){
        $subject_id = $_GET['subject_id'];
        $sql = "SELECT * FROM classes
            LEFT JOIN subject
            ON classes.subject_id = subject.subject_id
            LEFT JOIN khoa_data
            ON subject.Ma_Khoa = khoa_data.Ma_Khoa
            WHERE classes.subject_id = '$subject_id'
            ORDER BY classes.couse_id DESC";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                echo"<td>".$row['class_id']."</td>";
                echo"<td>".$row['subject_id']."</td>";
                echo"<td>".$row['subject_name']."</td>";
                echo"<td>".$row['Ten_Khoa']."</td>";
                echo"<td>".$row['teacher_id']."</td>";
                echo"<td>".$row['couse_id']."</td>";
                echo"<td>".$row['class_size']."</td>";
                echo"</tr>";
            }
        }
    } elseif(isset($_GET['subject_id']) && isset($_GET['choose'])) {
        $subject_id = $_GET['subject_id'];
        $course_id = $_GET['choose'];
        $sql = "SELECT * FROM classes
        LEFT JOIN subject
        ON classes.subject_id = subject.subject_id
        LEFT JOIN khoa_data
        ON subject.Ma_Khoa = khoa_data.Ma_Khoa
        WHERE classes.subject_id = '$subject_id' AND couse_id = '$course_id'
        ORDER BY classes.couse_id DESC";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                echo"<td>".$row['class_id']."</td>";
                echo"<td>".$row['subject_id']."</td>";
                echo"<td>".$row['subject_name']."</td>";
                echo"<td>".$row['Ten_Khoa']."</td>";
                echo"<td>".$row['teacher_id']."</td>";
                echo"<td>".$row['couse_id']."</td>";
                echo"<td>".$row['class_size']."</td>";
                echo"</tr>";
            }
        }
    }
    else{
    $sql = "SELECT * FROM classes
        LEFT JOIN subject
        ON classes.subject_id = subject.subject_id
        LEFT JOIN khoa_data
        ON subject.Ma_Khoa = khoa_data.Ma_Khoa
        ORDER BY classes.couse_id DESC
        LIMIT 20";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo"<tr>";
            echo"<td>".$row['class_id']."</td>";
            echo"<td>".$row['subject_id']."</td>";
            echo"<td>".$row['subject_name']."</td>";
            echo"<td>".$row['Ten_Khoa']."</td>";
            echo"<td>".$row['teacher_id']."</td>";
            echo"<td>".$row['couse_id']."</td>";
            echo"<td>".$row['class_size']."</td>";
            echo"</tr>";
        }
    }
    }
?>