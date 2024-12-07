<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
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
    <title>Dashboard Admin - Aplikasi Jadwal Perkuliahan Fakultas Ilmu Komputer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body>
<!-- Navigation Bar dengan Logo -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="../logo.jpg" alt="Logo">
        Aplikasi Jadwal Perkuliahan - Admin
    </a>
    <div class="ml-auto">
        <a href="../logout.php" class="btn btn-light">Logout</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <?php require('components/sidebar.php') ?>

        <!-- Main Content -->
        <div class="col-md-10 mt-3">
            <h3>Data Jadwal Kuliah</h3>
            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">➕ Tambah Data</button>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Kode Matkul</td>
                    <td>NIM</td>
                    <td>NIDN</td>
                    <td>Hari</td>
                    <td>Jam</td>
                    <td>Ruangan</td>
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach ($data as $jadwal) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $jadwal['kode_mk'] . '</td>';
                    echo '<td>' . $jadwal['nim'] . '</td>';
                    echo '<td>' . $jadwal['nidn'] . '</td>';
                    echo '<td>' . $jadwal['hari'] . '</td>';
                    echo '<td>' . $jadwal['jam'] . '</td>';
                    echo '<td>' . $jadwal['ruangan'] . '</td>';
                    echo '<td>
                                    <a href="edit_jadwal.php?id=' . $jadwal['_id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_jadwal.php?id=' . $jadwal['_id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                                </td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal Matakuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="data_jadwal.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_mk">Kode Matkul</label>
                        <select class="custom-select form-control" id="kode_mk" name="kode_mk">
                            <option selected hidden>~ Pilih ~ </option>
                            <?php
                            foreach ($dataMatkul as $matkul) {
                                echo '<option value="' . $matkul['kode_mk'] . '">' . $matkul['kode_mk'] . ' - ' . $matkul['nama_mk'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nim">Mahasiswa</label>
                        <select class="custom-select form-control" id="nim" name="nim">
                            <option selected hidden>~ Pilih ~ </option>
                            <?php
                            foreach ($dataMahasiswa as $mahasiswa) {
                                echo '<option value="' . $mahasiswa['nim'] . '">' . $mahasiswa['nim'] . ' - ' . $mahasiswa['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nidn">Dosen</label>
                        <select class="custom-select form-control" id="nidn" name="nidn">
                            <option selected hidden>~ Pilih ~ </option>
                            <?php
                            foreach ($dataDosen as $dosen) {
                                echo '<option value="' . $dosen['nidn'] . '">' . $dosen['nidn'] . ' - ' . $dosen['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari"  class="custom-select form-control" id="hari">
                            <option selected hidden>~ Pilih ~ </option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <select name="jam"  class="custom-select form-control" id="jam">
                            <option selected hidden>~ Pilih ~ </option>
                            <option value="08:00 - 10:00">08:00 - 10:00</option>
                            <option value="10:00 - 12:00">10:00 - 12:00</option>
                            <option value="13:00 - 15:00">13:00 - 15:00</option>
                            <option value="15:00 - 17:00">15:00 - 17:00</option>
                            <option value="17:00 - 19:00">17:00 - 19:00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ruangan">Ruangan</label>
                        <select name="ruangan"  class="custom-select form-control"  id="ruangan">
                            <option selected hidden>~ Pilih ~ </option>
                            <option value="A101">A101</option>
                            <option value="A102">A102</option>
                            <option value="A103">A103</option>
                            <option value="A104">A104</option>
                            <option value="A105">A105</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    &copy; 2024 Aplikasi Jadwal Perkuliahan - Fakultas Ilmu Komputer UNIKA Santo Thomas Medan
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>