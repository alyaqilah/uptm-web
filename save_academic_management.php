<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    foreach ($_POST['id'] as $key => $id) {
        $tugas = mysqli_real_escape_string($conn, $_POST['tugas'][$key]);
        $tempoh_urus = mysqli_real_escape_string($conn, $_POST['tempoh_urus'][$key]);
        $pegawai_selia = mysqli_real_escape_string($conn, $_POST['pegawai_selia'][$key]);
        $catatan = mysqli_real_escape_string($conn, $_POST['catatan'][$key]);

        // Update each academic management entry
        $query = "UPDATE tanggungjawab_urus_aca 
                  SET tugas='$tugas', 
                      tempoh_urus='$tempoh_urus', 
                      pegawai_selia='$pegawai_selia', 
                      catatan='$catatan' 
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    
    // Redirect back with success message
    echo "<script>
            alert('Academic management responsibilities updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
