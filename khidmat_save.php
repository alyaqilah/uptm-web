<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM kerja_khidmat WHERE id=$id";
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

if (isset($_POST['update_khidmat'])) {

    $khidmat_id = mysqli_real_escape_string($conn, $_POST['khidmat_id']);
    $jenis_aktiviti = mysqli_real_escape_string($conn, $_POST['jenis_aktiviti']);
    $tarikh_aktiviti = mysqli_real_escape_string($conn, $_POST['tarikh_aktiviti']);
    $penganjur_aktiviti = mysqli_real_escape_string($conn, $_POST['penganjur_aktiviti']);
    $peranan_aktiviti = mysqli_real_escape_string($conn, $_POST['peranan_aktiviti']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE kerja_khidmat SET jenis_aktiviti='$jenis_aktiviti', tarikh_aktiviti='$tarikh_aktiviti', penganjur_aktiviti='$penganjur_aktiviti', peranan_aktiviti='$peranan_aktiviti' WHERE id='$khidmat_id' ";
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

if (isset($_POST['save_khidmat'])) {

    $jenis_aktiviti = mysqli_real_escape_string($conn, $_POST['jenis_aktiviti']);
    $tarikh_aktiviti = mysqli_real_escape_string($conn, $_POST['tarikh_aktiviti']);
    $penganjur_aktiviti = mysqli_real_escape_string($conn, $_POST['penganjur_aktiviti']);
    $peranan_aktiviti = mysqli_real_escape_string($conn, $_POST['peranan_aktiviti']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO kerja_khidmat (jenis_aktiviti, tarikh_aktiviti, penganjur_aktiviti, peranan_aktiviti, user_name)
    VALUE ('$jenis_aktiviti','$tarikh_aktiviti','$penganjur_aktiviti','$peranan_aktiviti', '$user_name')";

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