<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['runding_id'])) {
    foreach ($_POST['runding_id'] as $key => $id) {
        $title_runding = mysqli_real_escape_string($conn, $_POST['title_runding'][$key]);
        $tahun_runding = mysqli_real_escape_string($conn, $_POST['tahun_runding'][$key]);
        $hasil_runding = mysqli_real_escape_string($conn, $_POST['hasil_runding'][$key]);
        $kewangan_runding = mysqli_real_escape_string($conn, $_POST['kewangan_runding'][$key]);

        // Update each rundingan entry
        $query = "UPDATE kerja_perundingan SET 
                    title_runding = '$title_runding', 
                    tahun_runding = '$tahun_runding', 
                    hasil_runding = '$hasil_runding', 
                    kewangan_runding = '$kewangan_runding'
                  WHERE id = $id";
        
        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Consultancy details updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
