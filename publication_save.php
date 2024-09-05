<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM kerja_penerbitan WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Publication Work Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Publication Work Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_publication'])) {

    $publication_id = mysqli_real_escape_string($conn, $_POST['publication_id']);
    $tajuk_terbit = mysqli_real_escape_string($conn, $_POST['tajuk_terbit']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $jenis_terbit = mysqli_real_escape_string($conn, $_POST['jenis_terbit']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE kerja_penerbitan SET tajuk_terbit='$tajuk_terbit', tahun_terbit='$tahun_terbit', jenis_terbit='$jenis_terbit', penerbit='$penerbit' WHERE id='$publication_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Publication Work Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Publication Work Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_publication'])) {

    $tajuk_terbit = mysqli_real_escape_string($conn, $_POST['tajuk_terbit']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $jenis_terbit = mysqli_real_escape_string($conn, $_POST['jenis_terbit']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO kerja_penerbitan (tajuk_terbit, tahun_terbit, jenis_terbit, penerbit, user_name) VALUE ('$tajuk_terbit','$tahun_terbit','$jenis_terbit','$penerbit', '$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Publication Work Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Publication Work Not Added";
        header("Location: home.php");
        exit(0);

    }

}