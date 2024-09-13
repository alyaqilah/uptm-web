<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qualification_id'])) {
    foreach ($_POST['qualification_id'] as $key => $id) {
        $kelulusan = mysqli_real_escape_string($conn, $_POST['kelulusan'][$key]);
        $bidang = mysqli_real_escape_string($conn, $_POST['bidang'][$key]);
        $ipt_name = mysqli_real_escape_string($conn, $_POST['ipt_name'][$key]);
        $year = mysqli_real_escape_string($conn, $_POST['year'][$key]);

        // Update each qualification entry
        $query = "UPDATE aca_qualification SET 
                    kelulusan='$kelulusan', 
                    bidang='$bidang', 
                    ipt_name='$ipt_name', 
                    year='$year'
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Qualifications updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
