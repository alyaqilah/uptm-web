<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selidik_id'])) {
    foreach ($_POST['selidik_id'] as $key => $id) {
        $title_selidik = mysqli_real_escape_string($conn, $_POST['title_selidik'][$key]);
        $tahun_selidik = mysqli_real_escape_string($conn, $_POST['tahun_selidik'][$key]);
        $hasil_selidik = mysqli_real_escape_string($conn, $_POST['hasil_selidik'][$key]);
        $kewangan_selidik = mysqli_real_escape_string($conn, $_POST['kewangan_selidik'][$key]);

        // Update each research entry
        $query = "UPDATE kerja_selidik SET 
                    title_selidik='$title_selidik', 
                    tahun_selidik='$tahun_selidik', 
                    hasil_selidik='$hasil_selidik', 
                    kewangan_selidik='$kewangan_selidik'
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Research data updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
