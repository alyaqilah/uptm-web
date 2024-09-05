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
  <title>New Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: indigo;
        padding-top: 20px;
    }
    .sidebar a {
        padding: 15px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
    }
    .sidebar a:hover {
        background-color: #575757;
    }
    .content {
        margin-left: 220px;
        padding: 20px;
    }
    footer {
        background-color: indigo;
        color: white;
        padding: 10px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        left: 0;
    }
    .table-container {
        margin-top: 20px;
    }
    .table th {
        background-color: indigo;
        color: white;
    }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="manage_users.php">Manage Users</a>
    <a href="admin.php">Back To Home Page</a>
</div>

<div class="content">

    <?php include('message.php'); ?>

    <h2>Add New Users</h2>
    <hr>
    <br>
    <form action="users_save.php" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="user_name" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="password" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="user_email" value="">
            </div>
        </div>
        <br>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="role" value="">
            </div>
        </div>

        <br><br>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" name="save_users" class="btn btn-primary">Submit</button>
            </div>
            <div>
                <a href="manage_users.php" class="btn btn-danger float-end">Cancel</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>