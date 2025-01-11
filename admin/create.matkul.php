<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('../mongodb_connection.php');
$collection = $database->matakuliah;

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
    <title>Tambah Data Mahasiswa</title>
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
                            <h5 class="card-title fw-semibold mb-4">Tambah Data Matakuliah</h5>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Kode Matkul</label>
                                        <input type="text" class="form-control" id="kode_mk" name="kode_mk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan" class="form-label">Nama Matkul</label>
                                        <input type="text" class="form-control" id="nama_mk" name="nama_mk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Jumlah SKS</label>
                                        <input type="number" class="form-control" id="sks" name="sks">
                                    </div>
                                    <a href="/admin/data_matkul.php" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
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