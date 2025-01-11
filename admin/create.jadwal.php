<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('../mongodb_connection.php');
$jdmatkul = $database->jadwalkuliah;
$mahasiswa = $database->mahasiswa;
$matkul = $database->matakuliah;
$dsn = $database->dosen;
$data = $jdmatkul->find();

$dataMatkul = $matkul->find();
$dataDosen = $dsn->find();
$dataMahasiswa = $mahasiswa->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_mk = $_POST['kode_mk'];
    $nim = $_POST['nim'];
    $nidn = $_POST['nidn'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $ruangan = $_POST['ruangan'];

    if ($kode_mk && $nim && $nidn && $hari && $jam && $ruangan) {
        $dataInsert = [
            'kode_mk' => $kode_mk,
            'nim' => $nim,
            'nidn' => $nidn,
            'hari' => $hari,
            'jam' => $jam,
            'ruangan' => $ruangan,
        ];

        try {
            $jdmatkul->insertOne($dataInsert);
            header('Location: data_jadwal.php');
        } catch (Exception $e) {
            echo "Error inserting data: " . $e->getMessage();
            echo '<div class="alert alert-warning" role="alert">Error inserting data</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Seluruh input wajib diisi</div>';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Jadwal</title>
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php
        require('components/side.php');
        ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            require('components/nav.php');
            ?>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Tambah Data Jadwal</h5>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Kode Matkul</label>
                                        <select class="custom-select form-control" id="kode_mk" name="kode_mk">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataMatkul as $matkul) {
                                                echo '<option value="' . $matkul['kode_mk'] . '">' . $matkul['kode_mk'] . ' - ' . $matkul['nama_mk'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan" class="form-label">Mahasiswa</label>
                                        <select class="custom-select form-control" id="nim" name="nim">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataMahasiswa as $mahasiswa) {
                                                echo '<option value="' . $mahasiswa['nim'] . '">' . $mahasiswa['nim'] . ' - ' . $mahasiswa['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Dosen</label>
                                        <select class="custom-select form-control" id="nidn" name="nidn">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataDosen as $dosen) {
                                                echo '<option value="' . $dosen['nidn'] . '">' . $dosen['nidn'] . ' - ' . $dosen['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Hari</label>
                                        <select name="hari" class="custom-select form-control" id="hari">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Jam</label>
                                        <select name="jam" class="custom-select form-control" id="jam">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <option value="08:00 - 10:00">08:00 - 10:00</option>
                                            <option value="10:00 - 12:00">10:00 - 12:00</option>
                                            <option value="13:00 - 15:00">13:00 - 15:00</option>
                                            <option value="15:00 - 17:00">15:00 - 17:00</option>
                                            <option value="17:00 - 19:00">17:00 - 19:00</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Ruangan</label>
                                        <select name="ruangan" class="custom-select form-control" id="ruangan">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <option value="A101">A101</option>
                                            <option value="A102">A102</option>
                                            <option value="A103">A103</option>
                                            <option value="A104">A104</option>
                                            <option value="A105">A105</option>
                                        </select>
                                    </div>
                                    <a href="/admin/data_jadwal.php" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require('components/foot.php');
        ?>
</body>

</html>