<?php
session_start();
include "db_conn.php";

if(isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $query = "DELETE FROM subject WHERE id=$id";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Subject Deleted Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Subject Not Deleted";
        header("Location: home.php");
        exit(0);

    }

}

if (isset($_POST['update_sub'])) {

    $subject_id = mysqli_real_escape_string($conn, $_POST['subject_id']);
    $sub_name = mysqli_real_escape_string($conn, $_POST['sub_name']);
    $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof']);
    $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda']);
    $diploma = mysqli_real_escape_string($conn, $_POST['diploma']);
    $sijil_persediaan = mysqli_real_escape_string($conn, $_POST['sijil_persediaan']);
    $user_name = $_SESSION['user_name'];

    $query = "UPDATE subject SET sub_name='$sub_name', sarjana_prof='$sarjana_prof', sarjana_muda='$sarjana_muda', diploma='$diploma', sijil_persediaan='$sijil_persediaan' WHERE id='$subject_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        $_SESSION['message'] = "Subject Updated Successfully";
        header("Location: home.php");
        exit(0);
        
    }else{

        $_SESSION['message'] = "Subject Not Updated";
        header("Location: home.php");
        exit(0);

    }
}

if (isset($_POST['save_sub'])) {

    $sub_name = mysqli_real_escape_string($conn, $_POST['sub_name']);
    $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof']);
    $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda']);
    $diploma = mysqli_real_escape_string($conn, $_POST['diploma']);
    $sijil_persediaan = mysqli_real_escape_string($conn, $_POST['sijil_persediaan']);
    $user_name = $_SESSION['user_name'];

    $query = "INSERT INTO subject (sub_name, sarjana_prof, sarjana_muda, diploma, sijil_persediaan, user_name) VALUE ('$sub_name','$sarjana_prof','$sarjana_muda','$diploma','$sijil_persediaan', '$user_name')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {

        $_SESSION['message'] = "Subject Added Successfully";
        header("Location: create_sub.php");
        exit(0);

    }else{

        $_SESSION['message'] = "Subject Not Added";
        header("Location: create_sub.php");
        exit(0);

    }

}