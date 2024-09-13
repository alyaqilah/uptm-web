<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['penerbitan_id'])) {
    foreach ($_POST['penerbitan_id'] as $key => $id) {
        $tajuk_terbit = mysqli_real_escape_string($conn, $_POST['tajuk_terbit'][$key]);
        $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit'][$key]);
        $jenis_terbit = mysqli_real_escape_string($conn, $_POST['jenis_terbit'][$key]);
        $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit'][$key]);

        // Update each publication entry
        $query = "UPDATE kerja_penerbitan SET 
                    tajuk_terbit='$tajuk_terbit', 
                    tahun_terbit='$tahun_terbit', 
                    jenis_terbit='$jenis_terbit', 
                    penerbit='$penerbit' 
                  WHERE id=$id";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    echo "<script>
            alert('Publications updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
