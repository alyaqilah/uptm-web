<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM users WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: manage_users.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "User Not Deleted";
        header("Location: manage_users.php");
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

if (isset($_POST['save_users'])) {

    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $query = "INSERT INTO users (user_name, password, user_email, role) VALUE ('$username','$password','$user_email','$role')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "User Added Successfully";
        header("Location: manage_users.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "User Not Added";
        header("Location: manage_users.php");
        exit(0);

    }

}