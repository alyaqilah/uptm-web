<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM aca_qualification WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Academic Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Academic Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_aca'])) {

    $aca_id = mysqli_real_escape_string($conn, $_POST['aca_id']);
    $kelulusan = mysqli_real_escape_string($conn, $_POST['kelulusan']);
    $bidang = mysqli_real_escape_string($conn, $_POST['bidang']);
    $ipt_name = mysqli_real_escape_string($conn, $_POST['ipt_name']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE aca_qualification SET kelulusan='$kelulusan', bidang='$bidang', ipt_name='$ipt_name', year='$year' WHERE id='$aca_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Academic Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Academic Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_aca'])) {

    $kelulusan = mysqli_real_escape_string($conn, $_POST['kelulusan']);
    $bidang = mysqli_real_escape_string($conn, $_POST['bidang']);
    $ipt_name = mysqli_real_escape_string($conn, $_POST['ipt_name']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO aca_qualification (kelulusan, bidang, ipt_name, year, user_name) VALUE ('$kelulusan','$bidang','$ipt_name','$year', '$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Academic Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Academic Not Added";
        header("Location: home.php");
        exit(0);

    }

}