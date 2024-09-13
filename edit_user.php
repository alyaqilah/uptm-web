<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
}else{
    header("Location: manage_users.php");
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
</div>

<div class="content">
    <?php include('message.php'); ?>

    <div class="row">
    <hr>
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

                    if(isset($_GET['user_name'])){

                        $profile_pic = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM profile_pic WHERE user_name='$profile_pic'";
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0){

                        $profile = mysqli_fetch_array($query_run);
                        echo "
                            <img src='img/".$profile['image']."' width='200' / >";
                        }
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
                    
                    if(isset($_GET['user_name'])){

                        $contact_id = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM contact WHERE user_name='$contact_id'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                
                        $contact = mysqli_fetch_array($query_run);
                        echo '
                        <tr>
                            <td class="text-center p-1">'.$contact["name"].'</td>
                            <td class="text-center p-1">'.$contact["position"].'</td>
                            <td class="text-center p-1">'.$contact["work_status"].'</td>
                            <td class="text-center p-1">'.$contact["nationality"].'</td>
                            <td class="text-center p-1">'.$contact["teach_permit"].'</td>
                        </tr>';
                        }
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
            <form method="post" action="save_subjects.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){

                        $sub_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM subject WHERE user_name='$sub_name'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                
                            while($subject = mysqli_fetch_array($query_run)){
                        $i++;
                        echo '
                        <tr>
                            <td class="text-center p-1">'.$i.'</td>
                            <td class="text-justify">
                                <input type="text" name="sub_name[]" class="form-control" value="'.htmlspecialchars($subject["sub_name"]).'">
                                <input type="hidden" name="subject_id[]" value="'.$subject["id"].'">
                            </td>
                            <td class="text-center p-1">
                                <input type="text" name="sarjana_prof[]" class="form-control text-center" value="'.htmlspecialchars($subject["sarjana_prof"]).'">
                            </td>
                            <td class="text-center p-1">
                                <input type="text" name="sarjana_muda[]" class="form-control text-center" value="'.htmlspecialchars($subject["sarjana_muda"]).'">
                            </td>
                            <td class="text-center p-1">
                                <input type="text" name="diploma[]" class="form-control text-center" value="'.htmlspecialchars($subject["diploma"]).'">
                            </td>
                            <td class="text-center p-1">
                                <input type="text" name="sijil_persediaan[]" class="form-control text-center" value="'.htmlspecialchars($subject["sijil_persediaan"]).'">
                            </td>
                        </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='6'>No subjects found for this user.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>User not specified.</td></tr>";
                }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_qualifications.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){
                        $aca_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM aca_qualification WHERE user_name='$aca_name'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                            while($aca = mysqli_fetch_array($query_run)){
                                $i++;
                                echo '
                                <tr>
                                    <td class="text-center p-1">'.$i.'</td>
                                    <td class="text-justify">
                                        <input type="text" name="kelulusan[]" class="form-control" value="'.htmlspecialchars($aca["kelulusan"]).'">
                                        <input type="hidden" name="qualification_id[]" value="'.$aca["id"].'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="bidang[]" class="form-control text-center" value="'.htmlspecialchars($aca["bidang"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="ipt_name[]" class="form-control text-center" value="'.htmlspecialchars($aca["ipt_name"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="year[]" class="form-control text-center" value="'.htmlspecialchars($aca["year"]).'">
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='6'>No qualification found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_work_exp.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if (isset($_GET['user_name'])) {
                        $exp_work = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM work_exp WHERE user_name='$exp_work'";
                        $query_run = mysqli_query($conn, $query);
                
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($exp = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo '
                                <tr>
                                    <td class="text-center p-1">'.$i.'</td>
                                    <td class="text-justify">
                                        <input type="text" name="exp_name[]" class="form-control" value="'.htmlspecialchars($exp["exp_name"]).'">
                                        <input type="hidden" name="exp_id[]" value="'.$exp["id"].'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="exp_position[]" class="form-control text-center" value="'.htmlspecialchars($exp["exp_position"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="exp_date[]" class="form-control text-center" value="'.htmlspecialchars($exp["exp_date"]).'">
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='4'>No experience found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_research.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])) {
                        $kerja_selidik = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM kerja_selidik WHERE user_name='$kerja_selidik'";
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0) {
                            while($selidik = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo '
                                <tr>
                                    <td class="text-center p-1">'.$i.'</td>
                                    <td class="text-justify">
                                        <input type="text" name="title_selidik[]" class="form-control" value="'.htmlspecialchars($selidik["title_selidik"]).'">
                                        <input type="hidden" name="selidik_id[]" value="'.$selidik["id"].'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="tahun_selidik[]" class="form-control text-center" value="'.htmlspecialchars($selidik["tahun_selidik"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="hasil_selidik[]" class="form-control text-center" value="'.htmlspecialchars($selidik["hasil_selidik"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="kewangan_selidik[]" class="form-control text-center" value="'.htmlspecialchars($selidik["kewangan_selidik"]).'">
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='6'>No research found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form action="save_rundingan.php" method="post">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if (isset($_GET['user_name'])) {
                        $kerja_perundingan = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM kerja_perundingan WHERE user_name='$kerja_perundingan'";
                        $query_run = mysqli_query($conn, $query);
                
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($runding = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-justify'>
                                        <input type='text' name='title_runding[]' class='form-control' value='".htmlspecialchars($runding['title_runding'])."'>
                                        <input type='hidden' name='runding_id[]' value='".$runding['id']."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='tahun_runding[]' class='form-control text-center' value='".htmlspecialchars($runding['tahun_runding'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='hasil_runding[]' class='form-control text-center' value='".htmlspecialchars($runding['hasil_runding'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='kewangan_runding[]' class='form-control text-center' value='".htmlspecialchars($runding['kewangan_runding'])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No consultancy found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form action="save_publications.php" method="post">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){

                        $kerja_penerbitan = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM kerja_penerbitan WHERE user_name='$kerja_penerbitan'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                            while($penerbitan = mysqli_fetch_array($query_run)){
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-justify'>
                                        <input type='text' name='tajuk_terbit[]' class='form-control' value='".htmlspecialchars($penerbitan["tajuk_terbit"])."'>
                                        <input type='hidden' name='penerbitan_id[]' value='".$penerbitan["id"]."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='tahun_terbit[]' class='form-control text-center' value='".htmlspecialchars($penerbitan["tahun_terbit"])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='jenis_terbit[]' class='form-control text-center' value='".htmlspecialchars($penerbitan["jenis_terbit"])."'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='penerbit[]' class='form-control' value='".htmlspecialchars($penerbitan["penerbit"])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No publication found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form action="save_professional.php" method="post">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){

                        $badan_profesional = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM badan_profesional WHERE user_name='$badan_profesional'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                
                            while($prof = mysqli_fetch_array($query_run)){
                            $i++;
                            echo "
                            <tr>
                                <td class='text-center p-1'>$i</td>
                                <td class='text-justify'>
                                    <input type='text' name='badan_name[]' class='form-control' value='".htmlspecialchars($prof["badan_name"])."'>
                                    <input type='hidden' name='badan_id[]' value='".$prof["id"]."'>
                                </td>
                                <td class='text-center p-1'>
                                    <input type='text' name='badan_period[]' class='form-control text-center' value='".htmlspecialchars($prof["badan_period"])."'>
                                </td>
                                <td class='text-center p-1'>
                                    <input type='text' name='badan_type[]' class='form-control text-center' value='".htmlspecialchars($prof["badan_type"])."'>
                                </td>
                                <td class='text-center p-1'>
                                    <input type='text' name='peranan_badan[]' class='form-control text-center' value='".htmlspecialchars($prof["peranan_badan"])."'>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No professional body involvement found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_involvement.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){
                        $user_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM libat_sarjana WHERE user_name='$user_name'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                            while($sarjana = mysqli_fetch_array($query_run)){
                                $i++;
                                echo '
                                <tr>
                                    <td class="text-center p-1">'.$i.'</td>
                                    <td class="text-justify">
                                        <input type="text" name="kursus_nama[]" class="form-control" value="'.htmlspecialchars($sarjana["kursus_nama"]).'">
                                        <input type="hidden" name="libat_sarjana_id[]" value="'.$sarjana["id"].'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="sarjana_muda[]" class="form-control text-center" value="'.htmlspecialchars($sarjana["sarjana_muda"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="sarjana_prof[]" class="form-control text-center" value="'.htmlspecialchars($sarjana["sarjana_prof"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="tahun_pengajian[]" class="form-control text-center" value="'.htmlspecialchars($sarjana["tahun_pengajian"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="tempoh_pengajaran[]" class="form-control text-center" value="'.htmlspecialchars($sarjana["tempoh_pengajaran"]).'">
                                    </td>
                                    <td class="text-center p-1">
                                        <input type="text" name="peranan_sarjana[]" class="form-control text-center" value="'.htmlspecialchars($sarjana["peranan_sarjana"]).'">
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='7'>No records found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            <!-- Table Form end -->
        </div>
        <hr>
        <div class="col-12">
            <h4>Maklumat tentang tanggungjawab dalam bidang pengurusan akademik (disusun dari terbaru)</h4>
        </div>
        <br>
        <div class="col-12">
            <!-- Table Form start -->
            <form action="save_academic_management.php" method="post">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if (isset($_GET['user_name'])) {
                        $user_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM tanggungjawab_urus_aca WHERE user_name='$user_name'";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($acad = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-justify'>
                                        <input type='text' name='tugas[]' class='form-control' value='" . htmlspecialchars($acad['tugas']) . "'>
                                        <input type='hidden' name='id[]' value='" . $acad['id'] . "'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='tempoh_urus[]' class='form-control text-center' value='" . htmlspecialchars($acad['tempoh_urus']) . "'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='pegawai_selia[]' class='form-control text-center' value='" . htmlspecialchars($acad['pegawai_selia']) . "'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='catatan[]' class='form-control' value='" . htmlspecialchars($acad['catatan']) . "'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No academic management records found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_seminars.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){
                        $seminar_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM seminar_latihan WHERE user_name='$seminar_name'";
                        $query_run = mysqli_query($conn, $query);
                
                        if(mysqli_num_rows($query_run) > 0){
                            while($latihan = mysqli_fetch_array($query_run)){
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-justify'>
                                        <input type='text' name='seminar_nama[]' class='form-control' value='".htmlspecialchars($latihan["seminar_nama"])."'>
                                        <input type='hidden' name='seminar_id[]' value='".$latihan["id"]."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='tahun_seminar[]' class='form-control text-center' value='".htmlspecialchars($latihan["tahun_seminar"])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='penganjur_seminar[]' class='form-control text-center' value='".htmlspecialchars($latihan["penganjur_seminar"])."'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='catatan_seminar[]' class='form-control' value='".htmlspecialchars($latihan["catatan_seminar"])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No seminar or training records found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_kerja_khidmat.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if (isset($_GET['user_name'])) {
                        $khidmat = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM kerja_khidmat WHERE user_name='$khidmat'";
                        $query_run = mysqli_query($conn, $query);
                
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($aktiviti = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-justify'>
                                        <input type='text' name='jenis_aktiviti[]' class='form-control' value='".htmlspecialchars($aktiviti['jenis_aktiviti'])."'>
                                        <input type='hidden' name='id[]' value='".$aktiviti['id']."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='tarikh_aktiviti[]' class='form-control text-center' value='".htmlspecialchars($aktiviti['tarikh_aktiviti'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='penganjur_aktiviti[]' class='form-control text-center' value='".htmlspecialchars($aktiviti['penganjur_aktiviti'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='peranan_aktiviti[]' class='form-control text-center' value='".htmlspecialchars($aktiviti['peranan_aktiviti'])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No activities found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form action="save_iproperty.php" method="post">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if (isset($_GET['user_name'])) {
                        $iproperty = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM iproperty WHERE user_name='$iproperty'";
                        $query_run = mysqli_query($conn, $query);
                
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($ip = mysqli_fetch_array($query_run)) {
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='ip_id[]' class='form-control text-center' value='".htmlspecialchars($ip['ip_id'])."'>
                                        <input type='hidden' name='id[]' value='".$ip['id']."'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='title_ip[]' class='form-control' value='".htmlspecialchars($ip['title_ip'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='type_ip[]' class='form-control text-center' value='".htmlspecialchars($ip['type_ip'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='num_app[]' class='form-control text-center' value='".htmlspecialchars($ip['num_app'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='role_ip[]' class='form-control text-center' value='".htmlspecialchars($ip['role_ip'])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No intellectual property found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            <form method="post" action="save_awards.php">
                <input type="hidden" name="user_name" value="<?php echo isset($_GET['user_name']) ? htmlspecialchars($_GET['user_name']) : ''; ?>">
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
                    if(isset($_GET['user_name'])){

                        $awards_name = mysqli_real_escape_string($conn, $_GET['user_name']);
                        $query = "SELECT * FROM awards WHERE user_name='$awards_name'";
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0){

                            while($award = mysqli_fetch_array($query_run)){
                                $i++;
                                echo "
                                <tr>
                                    <td class='text-center p-1'>$i</td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='year[]' class='form-control text-center' value='".htmlspecialchars($award['tahun'])."'>
                                        <input type='hidden' name='award_id[]' value='".$award['id']."'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='award_name[]' class='form-control' value='".htmlspecialchars($award['award_name'])."'>
                                    </td>
                                    <td class='text-justify'>
                                        <input type='text' name='penganugerah[]' class='form-control' value='".htmlspecialchars($award['penganugerah'])."'>
                                    </td>
                                    <td class='text-center p-1'>
                                        <input type='text' name='peringkat[]' class='form-control text-center' value='".htmlspecialchars($award['peringkat'])."'>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No awards found for this user.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>User not specified.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            <!-- Table Form end -->
        </div>
    </div>
</div>

</body>
</html>

