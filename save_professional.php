<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['badan_id'])) {
    $user_name = $_POST['user_name'];
    foreach ($_POST['badan_id'] as $key => $id) {
        $badan_name = mysqli_real_escape_string($conn, $_POST['badan_name'][$key]);
        $badan_period = mysqli_real_escape_string($conn, $_POST['badan_period'][$key]);
        $badan_type = mysqli_real_escape_string($conn, $_POST['badan_type'][$key]);
        $peranan_badan = mysqli_real_escape_string($conn, $_POST['peranan_badan'][$key]);

        // Update each professional body involvement entry
        $query = "UPDATE badan_profesional SET 
                    badan_name='$badan_name', 
                    badan_period='$badan_period', 
                    badan_type='$badan_type', 
                    peranan_badan='$peranan_badan'
                  WHERE id=$id AND user_name='$user_name'";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Professional body involvement updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
