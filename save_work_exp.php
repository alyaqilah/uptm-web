<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exp_id'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    
    foreach ($_POST['exp_id'] as $key => $id) {
        $exp_name = mysqli_real_escape_string($conn, $_POST['exp_name'][$key]);
        $exp_position = mysqli_real_escape_string($conn, $_POST['exp_position'][$key]);
        $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date'][$key]);

        // Update each work experience entry
        $query = "UPDATE work_exp SET 
                    exp_name='$exp_name', 
                    exp_position='$exp_position', 
                    exp_date='$exp_date'
                  WHERE id=$id AND user_name='$user_name'";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    echo "<script>
            alert('Work experiences updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
