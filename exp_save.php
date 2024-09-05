<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM work_exp WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Work Experience Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Work Experience Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_exp'])) {

    $exp_id = mysqli_real_escape_string($conn, $_POST['exp_id']);
    $exp_name = mysqli_real_escape_string($conn, $_POST['exp_name']);
    $exp_position = mysqli_real_escape_string($conn, $_POST['exp_position']);
    $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE work_exp SET exp_name='$exp_name', exp_position='$exp_position', exp_date='$exp_date' WHERE id='$exp_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Work Experience Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Work Experience Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_exp'])) {

    $exp_name = mysqli_real_escape_string($conn, $_POST['exp_name']);
    $exp_position = mysqli_real_escape_string($conn, $_POST['exp_position']);
    $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO work_exp (exp_name, exp_position, exp_date, user_name) VALUE ('$exp_name','$exp_position','$exp_date','$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Work Experience Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Work Experience Not Added";
        header("Location: home.php");
        exit(0);

    }

}