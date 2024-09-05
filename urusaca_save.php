<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM tanggungjawab_urus_aca WHERE id=$id";
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

if (isset($_POST['update_urusaca'])) {

    $urusaca_id = mysqli_real_escape_string($conn, $_POST['urusaca_id']);
    $tugas = mysqli_real_escape_string($conn, $_POST['tugas']);
    $tempoh_urus = mysqli_real_escape_string($conn, $_POST['tempoh_urus']);
    $pegawai_selia = mysqli_real_escape_string($conn, $_POST['pegawai_selia']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE tanggungjawab_urus_aca SET tugas='$tugas', tempoh_urus='$tempoh_urus', pegawai_selia='$pegawai_selia', catatan='$catatan' WHERE id='$urusaca_id' ";
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

if (isset($_POST['save_urusaca'])) {

    $tugas = mysqli_real_escape_string($conn, $_POST['tugas']);
    $tempoh_urus = mysqli_real_escape_string($conn, $_POST['tempoh_urus']);
    $pegawai_selia = mysqli_real_escape_string($conn, $_POST['pegawai_selia']);
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO tanggungjawab_urus_aca (tugas, tempoh_urus, pegawai_selia, catatan, user_name)
    VALUE ('$tugas','$tempoh_urus','$pegawai_selia','$catatan', '$user_name')";

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