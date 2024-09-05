<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM awards WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Award Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Award Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_awards'])) {

    $awards_id = mysqli_real_escape_string($conn, $_POST['awards_id']);
    $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
    $award_name = mysqli_real_escape_string($conn, $_POST['award_name']);
    $penganugerah = mysqli_real_escape_string($conn, $_POST['penganugerah']);
    $peringkat = mysqli_real_escape_string($conn, $_POST['peringkat']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE awards SET tahun='$tahun', award_name='$award_name', penganugerah='$penganugerah', peringkat='$peringkat' WHERE id='$awards_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Award Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Award Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_awards'])) {

    $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
    $award_name = mysqli_real_escape_string($conn, $_POST['award_name']);
    $penganugerah = mysqli_real_escape_string($conn, $_POST['penganugerah']);
    $peringkat = mysqli_real_escape_string($conn, $_POST['peringkat']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO awards (tahun, award_name, penganugerah, peringkat, user_name)
    VALUE ('$tahun','$award_name','$penganugerah','$peringkat','$user_name')";

    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Award Added Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Award Not Added";
        header("Location: home.php");
        exit(0);

    }

}