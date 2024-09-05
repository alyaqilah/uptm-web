<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM iproperty WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Intellectual Property Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Intellectual Property Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_iproperty'])) {

    $iproperty_id = mysqli_real_escape_string($conn, $_POST['iproperty_id']);
    $ip_id = mysqli_real_escape_string($conn, $_POST['ip_id']);
    $title_ip = mysqli_real_escape_string($conn, $_POST['title_ip']);
    $type_ip = mysqli_real_escape_string($conn, $_POST['type_ip']);
    $num_app = mysqli_real_escape_string($conn, $_POST['num_app']);
    $role_ip = mysqli_real_escape_string($conn, $_POST['role_ip']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE iproperty SET ip_id='$ip_id', title_ip='$title_ip', type_ip='$type_ip', num_app='$num_app', role_ip='$role_ip' WHERE id='$iproperty_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Intellectual Property Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Intellectual Property Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_iproperty'])) {

    $ip_id = mysqli_real_escape_string($conn, $_POST['ip_id']);
    $title_ip = mysqli_real_escape_string($conn, $_POST['title_ip']);
    $type_ip = mysqli_real_escape_string($conn, $_POST['type_ip']);
    $num_app = mysqli_real_escape_string($conn, $_POST['num_app']);
    $role_ip = mysqli_real_escape_string($conn, $_POST['role_ip']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO iproperty (ip_id, title_ip, type_ip, num_app, role_ip, user_name)
    VALUE ('$ip_id','$title_ip','$type_ip','$num_app','$role_ip','$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Intellectual Property Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Intellectual Property Not Added";
        header("Location: home.php");
        exit(0);

    }

}