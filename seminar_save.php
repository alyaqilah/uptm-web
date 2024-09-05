<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM seminar_latihan WHERE id=$id";
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

if (isset($_POST['update_seminar'])) {

    $seminar_id = mysqli_real_escape_string($conn, $_POST['seminar_id']);
    $seminar_nama = mysqli_real_escape_string($conn, $_POST['seminar_nama']);
    $tahun_seminar = mysqli_real_escape_string($conn, $_POST['tahun_seminar']);
    $penganjur_seminar = mysqli_real_escape_string($conn, $_POST['penganjur_seminar']);
    $catatan_seminar = mysqli_real_escape_string($conn, $_POST['catatan_seminar']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE seminar_latihan SET seminar_nama='$seminar_nama', tahun_seminar='$tahun_seminar', penganjur_seminar='$penganjur_seminar', catatan_seminar='$catatan_seminar' WHERE id='$seminar_id' ";
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

if (isset($_POST['save_seminar'])) {

    $seminar_nama = mysqli_real_escape_string($conn, $_POST['seminar_nama']);
    $tahun_seminar = mysqli_real_escape_string($conn, $_POST['tahun_seminar']);
    $penganjur_seminar = mysqli_real_escape_string($conn, $_POST['penganjur_seminar']);
    $catatan_seminar = mysqli_real_escape_string($conn, $_POST['catatan_seminar']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO seminar_latihan (seminar_nama, tahun_seminar, penganjur_seminar, catatan_seminar, user_name)
    VALUE ('$seminar_nama','$tahun_seminar','$penganjur_seminar','$catatan_seminar', '$user_name')";

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