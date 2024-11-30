<?php
require ('../mongodb_connection.php');
if (isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
    $collection = $database->matakuliah;
    $result = $collection->findOne(['kode_mk' => $kode_mk]);

    $data = [
        'kode_mk' => $result['kode_mk'],
        'nama_mk' => $result['nama_mk'],
        'sks' => $result['sks']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $kode_mk = $_POST['kode_mk'];
    $nama_mk = $_POST['nama_mk'];
    $sks = $_POST['sks'];

    $data = [
        'kode_mk' => $kode_mk,
        'nama_mk' => $nama_mk,
        'sks' => $sks,
    ];

    try {
        $collection->updateOne(['kode_mk' => $kode_mk], ['$set' => $data]);
        header('Location: data_matkul.php');

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
            <h3>Edit Data Matakuliah</h3>
            <form action="" method="post">
                <div>
                    <div class="form-group">
                        <label for="kode_mk">Kode Matkul</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?= $data['kode_mk'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_mk">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="<?= $data['nama_mk'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="sks">Jumlah SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" value="<?= $data['sks'] ?>">
                    </div>
                </div>
                <div>
                    <a href="data_matkul.php" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
