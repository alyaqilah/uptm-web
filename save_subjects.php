<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_id'])) {
    foreach ($_POST['subject_id'] as $key => $id) {
        $sub_name = mysqli_real_escape_string($conn, $_POST['sub_name'][$key]);
        $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof'][$key]);
        $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda'][$key]);
        $diploma = mysqli_real_escape_string($conn, $_POST['diploma'][$key]);
        $sijil_persediaan = mysqli_real_escape_string($conn, $_POST['sijil_persediaan'][$key]);

        // Update each subject entry
        $query = "UPDATE subject SET 
                    sub_name='$sub_name', 
                    sarjana_prof='$sarjana_prof', 
                    sarjana_muda='$sarjana_muda', 
                    diploma='$diploma', 
                    sijil_persediaan='$sijil_persediaan'
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Subjects updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
