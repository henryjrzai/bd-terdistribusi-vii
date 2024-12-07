<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}
require('../mongodb_connection.php');
$collection = $database->matakuliah;
$data = $collection->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_mk = $_POST['kode_mk'];
    $nama_mk = $_POST['nama_mk'];
    $sks = $_POST['sks'];

    $dataInsert = [
        'kode_mk' => $kode_mk,
        'nama_mk' => $nama_mk,
        'sks' => $sks,
    ];

    try {
        $collection->insertOne($dataInsert);
        header('Location: data_matkul.php');
    } catch (Exception $e) {
        echo "Error inserting data: " . $e->getMessage();
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
            <h3>Data Matakuliah</h3>
            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">➕ Tambah Data</button>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Kode Matkul</td>
                    <td>Nama Matkul</td>
                    <td>SKS</td>
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach ($data as $matkul) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $matkul['kode_mk'] . '</td>';
                    echo '<td>' . $matkul['nama_mk'] . '</td>';
                    echo '<td>' . $matkul['sks'] . '</td>';
                    echo '<td>
                                    <a href="edit_matkul.php?kode_mk=' . $matkul['kode_mk'] . '" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_matkul.php?kode_mk=' . $matkul['kode_mk'] . '" class="btn btn-danger btn-sm">Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Matakuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_mk">Kode Matkul</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk">
                    </div>
                    <div class="form-group">
                        <label for="nama_mk">Nama Matkul</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk">
                    </div>
                    <div class="form-group">
                        <label for="sks">Jumlah SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks">
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
