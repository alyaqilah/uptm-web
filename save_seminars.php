<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seminar_id'])) {
    foreach ($_POST['seminar_id'] as $key => $id) {
        $seminar_nama = mysqli_real_escape_string($conn, $_POST['seminar_nama'][$key]);
        $tahun_seminar = mysqli_real_escape_string($conn, $_POST['tahun_seminar'][$key]);
        $penganjur_seminar = mysqli_real_escape_string($conn, $_POST['penganjur_seminar'][$key]);
        $catatan_seminar = mysqli_real_escape_string($conn, $_POST['catatan_seminar'][$key]);

        // Update each seminar entry
        $query = "UPDATE seminar_latihan SET 
                    seminar_nama='$seminar_nama', 
                    tahun_seminar='$tahun_seminar', 
                    penganjur_seminar='$penganjur_seminar', 
                    catatan_seminar='$catatan_seminar'
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Seminar and training details updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
