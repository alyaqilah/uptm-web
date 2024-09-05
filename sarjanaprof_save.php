<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM libat_sarjana WHERE id=$id";
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

if (isset($_POST['update_sarjanaprof'])) {

    $sarjanaprof_id = mysqli_real_escape_string($conn, $_POST['sarjanaprof_id']);
    $kursus_nama = mysqli_real_escape_string($conn, $_POST['kursus_nama']);
    $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda']);
    $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof']);
    $tahun_pengajian = mysqli_real_escape_string($conn, $_POST['tahun_pengajian']);
    $tempoh_pengajaran = mysqli_real_escape_string($conn, $_POST['tempoh_pengajaran']);
    $peranan_sarjana = mysqli_real_escape_string($conn, $_POST['peranan_sarjana']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE libat_sarjana SET kursus_nama='$kursus_nama', sarjana_muda='$sarjana_muda', sarjana_prof='$sarjana_prof', tahun_pengajian='$tahun_pengajian', 
    tempoh_pengajaran='$tempoh_pengajaran', peranan_sarjana='$peranan_sarjana' WHERE id='$sarjanaprof_id' ";
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

if (isset($_POST['save_sarjanaprof'])) {

    $sarjanaprof_id = mysqli_real_escape_string($conn, $_POST['sarjanaprof_id']);
    $kursus_nama = mysqli_real_escape_string($conn, $_POST['kursus_nama']);
    $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda']);
    $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof']);
    $tahun_pengajian = mysqli_real_escape_string($conn, $_POST['tahun_pengajian']);
    $tempoh_pengajaran = mysqli_real_escape_string($conn, $_POST['tempoh_pengajaran']);
    $peranan_sarjana = mysqli_real_escape_string($conn, $_POST['peranan_sarjana']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO libat_sarjana (kursus_nama, sarjana_muda, sarjana_prof, tahun_pengajian, tempoh_pengajaran, peranan_sarjana, user_name)
    VALUE ('$kursus_nama','$sarjana_muda','$sarjana_prof','$tahun_pengajian','$tempoh_pengajaran','$peranan_sarjana','$user_name')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {

        $_SESSION['message'] = "Participation Added Successfully";
        header("Location: create_sub.php");
        exit(0);

    }else{

        $_SESSION['message'] = "Participation Not Added";
        header("Location: create_sub.php");
        exit(0);

    }

}