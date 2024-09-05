<?php
include "db_conn.php";

if ($_POST["pic_update"]) {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileName = $_FILES['image']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        $tempName = $_FILES['image']['tmp_name'];
        $targetPath = "img/" . $fileName;

        if (in_array($ext, $allowedTypes)) {
            if (move_uploaded_file($tempName, $targetPath)) {
                $query = "UPDATE profile_pic SET image='$fileName' WHERE id=$id";

                if (mysqli_query($conn, $query)) {
                    echo "<script>
                                alert('Record updated successfully');
                                window.history.back();
                            </script>";
                } else {
                    echo "Something is wrong";
                }
            } else {
                echo "File is not uploaded";
            }
        } else {
            echo "Your files are not allowed";
        }
    }
}
