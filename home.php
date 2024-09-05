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
    .navbar-custom {
        background-color: indigo;
    }

  </style>
</head>
<body>

<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home.php">fcom</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Back To Home Page</a></li>
        </ul>
    </div>
</nav>

<div class="container py-3">
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
                    $profile_pic = $_SESSION['user_name'];
                    $sql = "SELECT * FROM profile_pic WHERE user_name='$profile_pic'";
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
                    $user_name = $_SESSION['user_name'];
                    $sql = "SELECT * FROM contact WHERE user_name='$user_name'";
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
            <a class="btn btn-primary" href="/uptm-web/create_sub.php" role="button">New Subject</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_sub.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/sub_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_aca.php" role="button">New Academic</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_aca.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/aca_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_exp.php" role="button">New Work Experience</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_exp.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/exp_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_research.php" role="button">New Research Work</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_research.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/research_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_consultancy.php" role="button">New Consultancy Work</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_consultancy.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/consultancy_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_publication.php" role="button">New Publication Work</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_publication.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/publication_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_badanprof.php" role="button">New Participation</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_badanprof.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/badanprof_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_sarjanaprof.php" role="button">New Participation</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_sarjanaprof.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/sarjanaprof_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_urusaca.php" role="button">New Participation</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_urusaca.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/urusaca_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_seminar.php" role="button">New Participation</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_seminar.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/seminar_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_khidmat.php" role="button">New Participation</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_khidmat.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/khidmat_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_ip.php" role="button">New IP</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_iproperty.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/iproperty_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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
            <a class="btn btn-primary" href="/uptm-web/create_awards.php" role="button">New Awards</a>
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
                            <th class="text-center p-1">Edit</th>
                            <th class="text-center p-1">Delete</th>
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
                            <td class='text-center p-1'>
                                <a class='btn btn-primary btn-sm rounded-0 py-0' href='/uptm-web/edit_awards.php?id=$row[id]'>Edit</a>
                            </td>
                            <td class='text-center p-1'>
                                <a class='btn btn-danger btn-sm rounded-0 py-0' href='/uptm-web/awards_save.php?deleteid=$row[id]' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
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

