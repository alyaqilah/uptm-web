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
  <title>New Intellectual Property</title>
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

    <h2>Add New Intellectual Property</h2>
    <hr>
    <br>
    <form action="iproperty_save.php" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID IP</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ip_id" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Title Product</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title_ip" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Type of IP</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="type_ip" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">No. Application</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="num_app" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="role_ip" value="">
            </div>
        </div>

        <br><br>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" name="save_iproperty" class="btn btn-primary">Submit</button>
            </div>
            <div>
                <a href="home.php" class="btn btn-danger float-end">Cancel</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>