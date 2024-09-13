<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $user_name = $_POST['user_name'];

    foreach ($_POST['id'] as $key => $id) {
        $jenis_aktiviti = mysqli_real_escape_string($conn, $_POST['jenis_aktiviti'][$key]);
        $tarikh_aktiviti = mysqli_real_escape_string($conn, $_POST['tarikh_aktiviti'][$key]);
        $penganjur_aktiviti = mysqli_real_escape_string($conn, $_POST['penganjur_aktiviti'][$key]);
        $peranan_aktiviti = mysqli_real_escape_string($conn, $_POST['peranan_aktiviti'][$key]);

        // Update each activity entry
        $query = "UPDATE kerja_khidmat SET 
                    jenis_aktiviti = ?, 
                    tarikh_aktiviti = ?, 
                    penganjur_aktiviti = ?, 
                    peranan_aktiviti = ? 
                  WHERE id = ? AND user_name = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $jenis_aktiviti, $tarikh_aktiviti, $penganjur_aktiviti, $peranan_aktiviti, $id, $user_name);
            
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error updating record with ID $id: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($conn);
        }
    }

    echo "<script>
            alert('Activities updated successfully!');
            window.location.href='view_user.php?user_name=" . urlencode($user_name) . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
