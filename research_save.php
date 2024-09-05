<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM kerja_selidik WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Research Work Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Research Work Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_research'])) {

    $research_id = mysqli_real_escape_string($conn, $_POST['research_id']);
    $title_selidik = mysqli_real_escape_string($conn, $_POST['title_selidik']);
    $tahun_selidik = mysqli_real_escape_string($conn, $_POST['tahun_selidik']);
    $hasil_selidik = mysqli_real_escape_string($conn, $_POST['hasil_selidik']);
    $kewangan_selidik = mysqli_real_escape_string($conn, $_POST['kewangan_selidik']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE kerja_selidik SET title_selidik='$title_selidik', tahun_selidik='$tahun_selidik', hasil_selidik='$hasil_selidik', kewangan_selidik='$kewangan_selidik' WHERE id='$research_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Research Work Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Research Work Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_research'])) {

    $title_selidik = mysqli_real_escape_string($conn, $_POST['title_selidik']);
    $tahun_selidik = mysqli_real_escape_string($conn, $_POST['tahun_selidik']);
    $hasil_selidik = mysqli_real_escape_string($conn, $_POST['hasil_selidik']);
    $kewangan_selidik = mysqli_real_escape_string($conn, $_POST['kewangan_selidik']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO kerja_selidik (title_selidik, tahun_selidik, hasil_selidik, kewangan_selidik, user_name) VALUE ('$title_selidik','$tahun_selidik','$hasil_selidik','$kewangan_selidik', '$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Research Work Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Research Work Not Added";
        header("Location: home.php");
        exit(0);

    }

}