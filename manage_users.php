<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $admin_name = $_SESSION['user_name'];
}else{
    header("Location: index.php");
    exit();
}

// Fetch users from the database
$sql = "SELECT id, user_name, user_email FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
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
    <h2>Manage Users</h2>
    <a class="btn btn-primary" href="/uptm-web/create_users.php" role="button">Add New Users</a>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['user_email'] . "</td>";
                        echo "<td>
                                <a href='view_user.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>View</a>
                                <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> 
                                <a href='/uptm-web/users_save.php?deleteid=$row[id]' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
