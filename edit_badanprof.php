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
  <title>Edit Participation</title>
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

    <h2>Edit Participation</h2>
    <hr>
    <br>
    <?php
    if(isset($_GET['id'])){

        $badanprof_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM badan_profesional WHERE id='$badanprof_id'";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0){

            $badanprof = mysqli_fetch_array($query_run);
            ?>
            
            <form action="badanprof_save.php" method="post">
                <input type="hidden" name="badanprof_id" value="<?=$badanprof['id'];?>">
        
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Nama Badan</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="badan_name" value="<?=$badanprof['badan_name'];?>">
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Tempoh Keahlian</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="badan_period" value="<?=$badanprof['badan_period'];?>">
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Jenis Keahlian</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="badan_type" value="<?=$badanprof['badan_type'];?>">
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Peranan</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="peranan_badan" value="<?=$badanprof['peranan_badan'];?>">
                    </div>
                </div>
                <br><br>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" name="update_badanprof" class="btn btn-primary">Update</button>
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