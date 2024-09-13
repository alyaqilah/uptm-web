<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Iterate over each record to update
    foreach ($_POST['id'] as $key => $id) {
        $ip_id = mysqli_real_escape_string($conn, $_POST['ip_id'][$key]);
        $title_ip = mysqli_real_escape_string($conn, $_POST['title_ip'][$key]);
        $type_ip = mysqli_real_escape_string($conn, $_POST['type_ip'][$key]);
        $num_app = mysqli_real_escape_string($conn, $_POST['num_app'][$key]);
        $role_ip = mysqli_real_escape_string($conn, $_POST['role_ip'][$key]);

        // Prepare the update query
        $query = "UPDATE iproperty SET 
                    ip_id='$ip_id', 
                    title_ip='$title_ip', 
                    type_ip='$type_ip', 
                    num_app='$num_app', 
                    role_ip='$role_ip'
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record with ID $id: " . mysqli_error($conn);
        }
    }

    // Redirect back to the user's view page
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    echo "<script>
            alert('Intellectual Property updated successfully!');
            window.location.href='view_user.php?user_name=$user_name';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
