<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}
require('../mongodb_connection.php');
$collection = $database->mahasiswa;
$data = $collection->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $dataInsert = [
        'nim' => $nim,
        'nama' => $nama,
        'jurusan' => $jurusan,
        'alamat' => $alamat,
        'email' => $email,
        'no_hp' => $no_hp,
    ];

    try {
        $collection->insertOne($dataInsert);
        header('Location: data_mahasiswa.php');
    } catch (Exception $e) {
        echo "Error inserting data: " . $e->getMessage();
        echo '<div class="alert alert-warning" role="alert">Seluruh input wajib diisi</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php require ('components/sidebar.php')?>

        <!-- Main Content -->
        <div class="col-md-10 mt-2">
            <h3>Data Mahasiswa</h3>
            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">➕ Tambah Data</button>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Jurusan</td>
                        <td>Alamat</td>
                        <td>Email</td>
                        <td>No Hp</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($data as $mahasiswa) {
                            echo '<tr>';
                            echo '<td>' . $no++ . '</td>';
                            echo '<td>' . $mahasiswa['nim'] . '</td>';
                            echo '<td>' . $mahasiswa['nama'] . '</td>';
                            echo '<td>' . $mahasiswa['jurusan'] . '</td>';
                            echo '<td>' . $mahasiswa['alamat'] . '</td>';
                            echo '<td>' . $mahasiswa['email'] . '</td>';
                            echo '<td>' . $mahasiswa['no_hp'] . '</td>';
                            echo '<td>
                                    <a href="edit_mahasiswa.php?nim=' . $mahasiswa['nim'] . '" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_mahasiswa.php?nim=' . $mahasiswa['nim'] . '" class="btn btn-danger btn-sm">Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nim">NPM</label>
                        <input type="number" class="form-control" id="nim" name="nim">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" cols="10" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="np_hp">No HP</label>
                        <input type="text" class="form-control" id="np_hp" name="no_hp">
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label for="tanggal_lahir">Tanggal lahir</label>-->
<!--                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">-->
<!--                    </div>-->

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