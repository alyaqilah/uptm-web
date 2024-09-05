<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM badan_profesional WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Participation Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Participation Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_badanprof'])) {

    $badanprof_id = mysqli_real_escape_string($conn, $_POST['badanprof_id']);
    $badan_name = mysqli_real_escape_string($conn, $_POST['badan_name']);
    $badan_period = mysqli_real_escape_string($conn, $_POST['badan_period']);
    $badan_type = mysqli_real_escape_string($conn, $_POST['badan_type']);
    $peranan_badan = mysqli_real_escape_string($conn, $_POST['peranan_badan']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE badan_profesional SET badan_name='$badan_name', badan_period='$badan_period', badan_type='$badan_type', peranan_badan='$peranan_badan' WHERE id='$badanprof_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Participation Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Participation Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_badanprof'])) {

    $badan_name = mysqli_real_escape_string($conn, $_POST['badan_name']);
    $badan_period = mysqli_real_escape_string($conn, $_POST['badan_period']);
    $badan_type = mysqli_real_escape_string($conn, $_POST['badan_type']);
    $peranan_badan = mysqli_real_escape_string($conn, $_POST['peranan_badan']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO badan_profesional (badan_name, badan_period, badan_type, peranan_badan, user_name) VALUE ('$badan_name','$badan_period','$badan_type','$peranan_badan', '$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Participation Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Participation Not Added";
        header("Location: home.php");
        exit(0);

    }

}