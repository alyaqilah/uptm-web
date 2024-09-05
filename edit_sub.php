<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['user_name'])) {
}else{
    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Subject</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .navbar-custom {
        background-color: indigo;
    }

  </style>
</head>
<body>

<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php">fcom</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php"><span class="glyphicon glyphicon-log-out"></span> Back To Home Page</a></li>
        </ul>
    </div>
</nav>

<div class="container my-5">

    <?php include('message.php'); ?>

    <h2>Edit Subject</h2>
    <hr>
    <br>
    <?php
    if(isset($_GET['id'])){

        $subject_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM subject WHERE id='$subject_id'";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){

            $subject = mysqli_fetch_array($query_run);
            ?>
            
            <form action="sub_save.php" method="post">
                <input type="hidden" name="subject_id" value="<?=$subject['id'];?>">
        
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Subject Name</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="sub_name" value="<?=$subject['sub_name'];?>">
                </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Sarjana / Profesional</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="sarjana_prof" value="<?=$subject['sarjana_prof'];?>">
                </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Sarjana Muda</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="sarjana_muda" value="<?=$subject['sarjana_muda'];?>">
                </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Diploma</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="diploma" value="<?=$subject['diploma'];?>">
                </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Sijil / Persediaan</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="sijil_persediaan" value="<?=$subject['sijil_persediaan'];?>">
                </div>
                </div>
                <br><br>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" name="update_sub" class="btn btn-primary">Update</button>
                    </div>
                    <div>
                        <a href="home.php" class="btn btn-danger float-end">Cancel</a>
                    </div>
                </div>
            </form>
            <?php

        }else{
            echo "<h4>Subject Not Found</h4>";
        }
    }

    ?>
</div>

</body>
</html>