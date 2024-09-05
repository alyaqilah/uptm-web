<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
}else{
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: indigo;
        padding-top: 20px;
    }
    .sidebar a {
        padding: 15px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
    }
    .sidebar a:hover {
        background-color: #575757;
    }
    .content {
        margin-left: 220px;
        padding: 20px;
    }
    footer {
        background-color: indigo;
        color: white;
        padding: 10px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        left: 0;
    }
    .table-container {
        margin-top: 20px;
    }
    .table th {
        background-color: indigo;
        color: white;
    }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="manage_users.php">Manage Users</a>
    <a href="admin.php">Back To Home Page</a>
</div>

<div class="content">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Lecturer's Information</h3>
        </div>
        <hr>
        <div class="col-12">
            <!-- Table Form start -->
            <form>
                <input type="hidden" name="id" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="30%">
                    </colgroup>
                    <tbody>
                    <?php 
                    $profile_pic = $_SESSION['id'];
                    $sql = "SELECT * FROM profile_pic WHERE id='$profile_pic'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo "
                            <img src='img/".$row['image']."' width='200' / >
                            <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_pic.php?id=$row[id]'>Edit</a>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <!-- Table Form start -->
            <form>
                <input type="hidden" name="id" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="30%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Nama</th>
                            <th class="text-center p-1">Pangkat / Jawatan</th>
                            <th class="text-center p-1">Status Pekerjaan</th>
                            <th class="text-center p-1">Warganegara</th>
                            <th class="text-center p-1">Permit Mengajar (No. Permit & Tempoh Tamat)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $user = $_SESSION['id'];
                    $sql = "SELECT * FROM contact WHERE id='$user'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                            <td class="text-center p-1">'.$row["name"].'</td>
                            <td class="text-center p-1">'.$row["position"].'</td>
                            <td class="text-center p-1">'.$row["work_status"].'</td>
                            <td class="text-center p-1">'.$row["nationality"].'</td>
                            <td class="text-center p-1">'.$row["teach_permit"].'</td>
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Mata Pelajaran yang diajar (disusun mengikut peringkat)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form>
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="45%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Subjects</th>
                            <th class="text-center p-1">Sarjana / Profesional</th>
                            <th class="text-center p-1">Sarjana Muda</th>
                            <th class="text-center p-1">Diploma</th>
                            <th class="text-center p-1">Sijil / Persediaan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $sub_name = $_SESSION['user_name'];
                    $sql = "SELECT * FROM subject WHERE user_name='$sub_name'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-justify'>$i</td>
                            <td class='text-justify'>$row[sub_name]</td>
                            <td class='text-center p-1'>$row[sarjana_prof]</td>
                            <td class='text-center p-1'>$row[sarjana_muda]</td>
                            <td class='text-center p-1'>$row[diploma]</td>
                            <td class='text-center p-1'>$row[sijil_persediaan]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Kelayakan Akademik (disusun dari terbaru)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="15%">
                        <col width="25%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Kelulusan</th>
                            <th class="text-center p-1">Bidang</th>
                            <th class="text-center p-1">Nama IPT / Negara</th>
                            <th class="text-center p-1">Tahun Penganugerahan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $aca_name = $_SESSION['user_name'];
                    $sql = "SELECT * FROM aca_qualification WHERE user_name='$aca_name'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[kelulusan]</td>
                            <td class='text-center p-1'>$row[bidang]</td>
                            <td class='text-justify'>$row[ipt_name]</td>
                            <td class='text-center p-1'>$row[year]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Pengalaman Bekerja (mengikut kronologi)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="45%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Nama dan Alamat Majikan</th>
                            <th class="text-center p-1">Jawatan Yang Disandang</th>
                            <th class="text-center p-1">Tarikh Mula & Tamat</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $exp_work = $_SESSION['user_name'];
                    $sql = "SELECT * FROM work_exp WHERE user_name='$exp_work'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[exp_name]</td>
                            <td class='text-center p-1'>$row[exp_position]</td>
                            <td class='text-center p-1'>$row[exp_date]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang kerja penyelidikan yang lepas (termasuk tahun semasa)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Tajuk</th>
                            <th class="text-center p-1">Tahun</th>
                            <th class="text-center p-1">Hasil</th>
                            <th class="text-center p-1">Sumber Kewangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $kerja_selidik = $_SESSION['user_name'];
                    $sql = "SELECT * FROM kerja_selidik WHERE user_name='$kerja_selidik'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[title_selidik]</td>
                            <td class='text-center p-1'>$row[tahun_selidik]</td>
                            <td class='text-center p-1'>$row[hasil_selidik]</td>
                            <td class='text-center p-1'>$row[kewangan_selidik]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang kerja perundingan yang lepas (termasuk tahun semasa)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Tajuk</th>
                            <th class="text-center p-1">Tahun</th>
                            <th class="text-center p-1">Hasil</th>
                            <th class="text-center p-1">Sumber Kewangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $kerja_perundingan = $_SESSION['user_name'];
                    $sql = "SELECT * FROM kerja_perundingan WHERE user_name='$kerja_perundingan'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[title_runding]</td>
                            <td class='text-center p-1'>$row[tahun_runding]</td>
                            <td class='text-center p-1'>$row[hasil_runding]</td>
                            <td class='text-center p-1'>$row[kewangan_runding]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang kerja penerbitan yang lepas (termasuk tahun semasa)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Tajuk</th>
                            <th class="text-center p-1">Tahun</th>
                            <th class="text-center p-1">Jenis Penerbitan</th>
                            <th class="text-center p-1">Penerbit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $kerja_penerbitan = $_SESSION['user_name'];
                    $sql = "SELECT * FROM kerja_penerbitan WHERE user_name='$kerja_penerbitan'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[tajuk_terbit]</td>
                            <td class='text-center p-1'>$row[tahun_terbit]</td>
                            <td class='text-center p-1'>$row[jenis_terbit]</td>
                            <td class='text-justify'>$row[penerbit]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang penglibatan dalam badan professional (termasuk tahun semasa)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Nama Badan</th>
                            <th class="text-center p-1">Tempoh Keahlian</th>
                            <th class="text-center p-1">Jenis Keahlian</th>
                            <th class="text-center p-1">Peranan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $badan_profesional = $_SESSION['user_name'];
                    $sql = "SELECT * FROM badan_profesional WHERE user_name='$badan_profesional'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[badan_name]</td>
                            <td class='text-center p-1'>$row[badan_period]</td>
                            <td class='text-center p-1'>$row[badan_type]</td>
                            <td class='text-center p-1'>$row[peranan_badan]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat lanjut tentang penglibatan dalam pengajaran kursus sarjana muda/ sarjana/ profesional (termasuk tahun semasa)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Nama Kursus & Nama Subjek</th>
                            <th class="text-center p-1">Sarjana Muda</th>
                            <th class="text-center p-1">Sarjana / Prof.</th>
                            <th class="text-center p-1">Tahun Pengajian</th>
                            <th class="text-center p-1">Tempoh Pengajaran</th>
                            <th class="text-center p-1">Peranan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $libat_sarjana = $_SESSION['user_name'];
                    $sql = "SELECT * FROM libat_sarjana WHERE user_name='$libat_sarjana'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[kursus_nama]</td>
                            <td class='text-center p-1'>$row[sarjana_muda]</td>
                            <td class='text-center p-1'>$row[sarjana_prof]</td>
                            <td class='text-center p-1'>$row[tahun_pengajian]</td>
                            <td class='text-center p-1'>$row[tempoh_pengajaran]</td>
                            <td class='text-center p-1'>$row[peranan_sarjana]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang tanggungjawab dalam bidang pengurusan akademik (disusun dari terbaru)</h4>
        </div>
        <br>
        </div>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="15%">
                        <col width="15%">
                        <col width="30%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Tugas Yang Dilaksanakan / Tanggungjawab</th>
                            <th class="text-center p-1">Tempoh</th>
                            <th class="text-center p-1">Pegawai Yang Menyelia</th>
                            <th class="text-center p-1">Catatan (Berkaitan Tugas)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $urus_aca = $_SESSION['user_name'];
                    $sql = "SELECT * FROM tanggungjawab_urus_aca WHERE user_name='$urus_aca'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[tugas]</td>
                            <td class='text-justify'>$row[tempoh_urus]</td>
                            <td class='text-justify'>$row[pegawai_selia]</td>
                            <td class='text-justify'>$row[catatan]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang seminar dan latihan yang pernah dihadiri (disusun dari terbaru)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="45%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Kursus / Seminar / Bengkel</th>
                            <th class="text-center p-1">Tahun</th>
                            <th class="text-center p-1">Penganjur</th>
                            <th class="text-center p-1">Catatan (Berkaitan Kursus Dihadiri)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $seminar = $_SESSION['user_name'];
                    $sql = "SELECT * FROM seminar_latihan WHERE user_name='$seminar'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[seminar_nama]</td>
                            <td class='text-center p-1'>$row[tahun_seminar]</td>
                            <td class='text-center p-1'>$row[penganjur_seminar]</td>
                            <td class='text-justify'>$row[catatan_seminar]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang penglibatan dalam kerja-kerja khidmat masyarakat / kebajikan (disusun dari terbaru)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="45%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Jenis Aktiviti</th>
                            <th class="text-center p-1">Tarikh</th>
                            <th class="text-center p-1">Penganjur</th>
                            <th class="text-center p-1">Peranan / Jawatan Disandang</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $khidmat = $_SESSION['user_name'];
                    $sql = "SELECT * FROM kerja_khidmat WHERE user_name='$khidmat'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-justify'>$row[jenis_aktiviti]</td>
                            <td class='text-center p-1'>$row[tarikh_aktiviti]</td>
                            <td class='text-center p-1'>$row[penganjur_aktiviti]</td>
                            <td class='text-center p-1'>$row[peranan_aktiviti]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Intellectual Property</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="35%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">ID IP</th>
                            <th class="text-center p-1">Title Product</th>
                            <th class="text-center p-1">Type of IP</th>
                            <th class="text-center p-1">No. Application</th>
                            <th class="text-center p-1">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $iproperty = $_SESSION['user_name'];
                    $sql = "SELECT * FROM iproperty WHERE user_name='$iproperty'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-center p-1'>$row[ip_id]</td>
                            <td class='text-justify'>$row[title_ip]</td>
                            <td class='text-center p-1'>$row[type_ip]</td>
                            <td class='text-center p-1'>$row[num_app]</td>
                            <td class='text-center p-1'>$row[role_ip]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Awards</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="" method="post">
                <input type="hidden" name="" value="">
                <table class='table table-hovered table-stripped table-bordered' id="form-tbl">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="45%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center p-1">Bil.</th>
                            <th class="text-center p-1">Tahun</th>
                            <th class="text-center p-1">Nama Anugerah / Pencapaian</th>
                            <th class="text-center p-1">Penganugerah</th>
                            <th class="text-center p-1">Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 0;
                    $awards = $_SESSION['user_name'];
                    $sql = "SELECT * FROM awards WHERE user_name='$awards'";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query:  " . $conn->error);
                    }

                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                        <tr>
                            <td class='text-center p-1'>$i</td>
                            <td class='text-center p-1'>$row[tahun]</td>
                            <td class='text-justify'>$row[award_name]</td>
                            <td class='text-justify'>$row[penganugerah]</td>
                            <td class='text-center p-1'>$row[peringkat]</td>
                        </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <!-- Table Form end -->
        </div>
    </div>
</div>

</body>
</html>

