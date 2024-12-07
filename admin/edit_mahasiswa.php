<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}
require ('../mongodb_connection.php');
if (isset($_GET['nim'])){
    $nim = $_GET['nim'];
    $collection = $database->mahasiswa;
    $result = $collection->findOne(['nim' => $nim]);
    $data = [
        'nim' => $result['nim'],
        'nama' => $result['nama'],
        'jurusan' => $result['jurusan'],
        'alamat' => $result['alamat'],
        'email' => $result['email'],
        'no_hp' => $result['no_hp']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $data = [
        'nim' => $nim,
        'nama' => $nama,
        'jurusan' => $jurusan,
        'alamat' => $alamat,
        'email' => $email,
        'no_hp' => $no_hp,
    ];

    try {
        $collection->updateOne(['nim' => $nim], ['$set' => $data]);
        header('Location: data_mahasiswa.php');

    } catch (Exception $e) {
        echo "Error updating data: " . $e->getMessage();
        echo '<div class="alert alert-warning" role="alert">gagal mengupdate</div>';
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
        <?php require ('components/sidebar.php')?>

        <!-- Main Content -->
        <div class="col-md-5 content m-auto">
            <h3>Edit Data Mahasiswa</h3>
            <form action="" method="post">
                <div>
                    <div class="form-group">
                        <label for="nim">NPM</label>
                        <input type="number" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $data['jurusan'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="np_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                    </div>
                </div>
                <div>
                    <a href="data_mahasiswa.php" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>