<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('../mongodb_connection.php');
if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];
    $collection = $database->dosen;
    $result = $collection->findOne(['nidn' => $nidn]);
    $data = [
        'nidn' => $result['nidn'],
        'nama' => $result['nama'],
        'jurusan' => $result['jurusan'],
        'email' => $result['email'],
        'no_hp' => $result['no_hp']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $data = [
        'nidn' => $nidn,
        'nama' => $nama,
        'jurusan' => $jurusan,
        'email' => $email,
        'no_hp' => $no_hp,
    ];

    try {
        $collection->updateOne(['nidn' => $nidn], ['$set' => $data]);
        header('Location: data_dosen.php');
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
    <title>Edit Data Dosen</title>
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
                            <h5 class="card-title fw-semibold mb-4">Edit Data Dosen</h5>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="nidn" class="form-label">NIDN</label>
                                        <input type="number" class="form-control" id="nidn" name="nidn" readonly value="<?= $data['nidn'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan" class="form-label">Jurusan</label>
                                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $data['jurusan'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="np_hp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                                    </div>
                                    <a href="/admin/data_dosen.php" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        require('components/foot.php');
        ?>
</body>

</html>