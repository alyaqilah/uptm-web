<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM kerja_perundingan WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Consultancy Work Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Consultancy Work Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_consultancy'])) {

    $consultancy_id = mysqli_real_escape_string($conn, $_POST['consultancy_id']);
    $title_runding = mysqli_real_escape_string($conn, $_POST['title_runding']);
    $tahun_runding = mysqli_real_escape_string($conn, $_POST['tahun_runding']);
    $hasil_runding = mysqli_real_escape_string($conn, $_POST['hasil_runding']);
    $kewangan_runding = mysqli_real_escape_string($conn, $_POST['kewangan_runding']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE kerja_perundingan SET title_runding='$title_runding', tahun_runding='$tahun_runding', hasil_runding='$hasil_runding', kewangan_runding='$kewangan_runding' WHERE id='$consultancy_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Consultancy Work Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Consultancy Work Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_consultancy'])) {

    $title_runding = mysqli_real_escape_string($conn, $_POST['title_runding']);
    $tahun_runding = mysqli_real_escape_string($conn, $_POST['tahun_runding']);
    $hasil_runding = mysqli_real_escape_string($conn, $_POST['hasil_runding']);
    $kewangan_runding = mysqli_real_escape_string($conn, $_POST['kewangan_runding']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO kerja_perundingan (title_runding, tahun_runding, hasil_runding, kewangan_runding, user_name) VALUE ('$title_runding','$tahun_runding','$hasil_runding','$kewangan_runding', '$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Consultancy Work Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Consultancy Work Not Added";
        header("Location: home.php");
        exit(0);

    }

}