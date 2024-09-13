<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['award_id'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $years = $_POST['year'];
    $award_names = $_POST['award_name'];
    $penganugerahs = $_POST['penganugerah'];
    $peringkats = $_POST['peringkat'];
    $ids = $_POST['award_id'];

    // Loop through each award and update the database
    foreach ($ids as $key => $id) {
        $year = mysqli_real_escape_string($conn, $years[$key]);
        $award_name = mysqli_real_escape_string($conn, $award_names[$key]);
        $penganugerah = mysqli_real_escape_string($conn, $penganugerahs[$key]);
        $peringkat = mysqli_real_escape_string($conn, $peringkats[$key]);

        // Prepare the update query
        $query = "UPDATE awards SET 
                    tahun = ?, 
                    award_name = ?, 
                    penganugerah = ?, 
                    peringkat = ? 
                  WHERE id = ? AND user_name = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $year, $award_name, $penganugerah, $peringkat, $id, $user_name);
            
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error updating record with ID $id: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($conn);
        }
    }

    echo "<script>
            alert('Awards updated successfully!');
            window.location.href='view_user.php?user_name=" . urlencode($user_name) . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
