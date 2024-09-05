<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $admin_name = $_SESSION['user_name'];
}else{
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    .welcome {
        margin-bottom: 20px;
    }
    .card {
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f8f8f8;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>

<div class="sidebar">
    <a href="manage_users.php">Manage Users</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="content">
    <div class="welcome">
        <h2>Welcome, <?php echo $admin_name; ?>!</h2>
        <p>This is your admin dashboard where you can manage the website content and settings.</p>
    </div>

    <div class="card">
        <h3>Statistics</h3>
        <p>Number of users: 150</p>
        <p>Number of posts: 300</p>
    </div>

    <div class="card">
        <h3>Recent Activity</h3>
        <p>User JohnDoe created a new post.</p>
        <p>User JaneDoe registered.</p>
    </div>

    <div class="card">
        <h3>Quick Links</h3>
        <ul>
            <li><a href="#">View All Users</a></li>
            <li><a href="#">Create New Post</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>
</div>

</body>
</html>