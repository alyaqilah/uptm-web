<?php
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['libat_sarjana_id'])) {
    foreach ($_POST['libat_sarjana_id'] as $key => $id) {
        $kursus_nama = mysqli_real_escape_string($conn, $_POST['kursus_nama'][$key]);
        $sarjana_muda = mysqli_real_escape_string($conn, $_POST['sarjana_muda'][$key]);
        $sarjana_prof = mysqli_real_escape_string($conn, $_POST['sarjana_prof'][$key]);
        $tahun_pengajian = mysqli_real_escape_string($conn, $_POST['tahun_pengajian'][$key]);
        $tempoh_pengajaran = mysqli_real_escape_string($conn, $_POST['tempoh_pengajaran'][$key]);
        $peranan_sarjana = mysqli_real_escape_string($conn, $_POST['peranan_sarjana'][$key]);

        // Update each entry
        $query = "UPDATE libat_sarjana SET 
                    kursus_nama='$kursus_nama', 
                    sarjana_muda='$sarjana_muda', 
                    sarjana_prof='$sarjana_prof', 
                    tahun_pengajian='$tahun_pengajian', 
                    tempoh_pengajaran='$tempoh_pengajaran', 
                    peranan_sarjana='$peranan_sarjana'
                  WHERE id=$id AND user_name='" . mysqli_real_escape_string($conn, $_POST['user_name']) . "'";

        if (!mysqli_query($conn, $query)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    echo "<script>
            alert('Records updated successfully!');
            window.location.href='view_user.php?user_name=" . $_POST['user_name'] . "';
          </script>";
} else {
    echo "Error: Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
