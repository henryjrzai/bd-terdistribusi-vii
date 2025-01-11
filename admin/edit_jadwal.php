<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('mongodb_connection.php');

$mahasiswa = $database->mahasiswa;
$matkul = $database->matakuliah;
$dsn = $database->dosen;

$dataMatkul = $matkul->find();
$dataDosen = $dsn->find();
$dataMahasiswa = $mahasiswa->find();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $collection = $database->jadwalkuliah;
    $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    $data = [
        'kode_mk' => $result['kode_mk'],
        'nim' => $result['nim'],
        'nidn' => $result['nidn'],
        'hari' => $result['hari'],
        'jam' => $result['jam'],
        'ruangan' => $result['ruangan'],
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $kode_mk = $_POST['kode_mk'];
    $nim = $_POST['nim'];
    $nidn = $_POST['nidn'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $ruangan = $_POST['ruangan'];

    if ($kode_mk && $nim && $nidn && $hari && $jam && $ruangan) {
        $dataUpdate = [
            'kode_mk' => $kode_mk,
            'nim' => $nim,
            'nidn' => $nidn,
            'hari' => $hari,
            'jam' => $jam,
            'ruangan' => $ruangan,
        ];

        try {
            $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => $dataUpdate]
            );
            header('Location: data_jadwal.php');
        } catch (Exception $e) {
            echo "Error updating data: " . $e->getMessage();
            echo '<div class="alert alert-warning" role="alert">Error updating data</div>';
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
    <title>Edit Data Jadwal</title>
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
                            <h5 class="card-title fw-semibold mb-4">Edit Data Jadwal</h5>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="text" hidden value="<?= $result['_id'] ?>" name="id">
                                    <div class="mb-3">
                                        <label for="kode_mk" class="form-label">Kode Matkul</label>
                                        <select class="custom-select form-control" id="kode_mk" name="kode_mk">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataMatkul as $matkul) {
                                                $selected = ($matkul['kode_mk'] == $data['kode_mk']) ? 'selected' : '';
                                                echo '<option value="' . $matkul['kode_mk'] . '" ' . $selected . '>' . $matkul['kode_mk'] . ' - ' . $matkul['nama_mk'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nim" class="form-label">Mahasiswa</label>
                                        <select class="custom-select form-control" id="nim" name="nim">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataMahasiswa as $mahasiswa) {
                                                $selected = ($mahasiswa['nim'] == $data['nim']) ? 'selected' : '';
                                                echo '<option value="' . $mahasiswa['nim'] . '" ' . $selected . '>' . $mahasiswa['nim'] . ' - ' . $mahasiswa['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nidn" class="form-label">Dosen</label>
                                        <select class="custom-select form-control" id="nidn" name="nidn">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            foreach ($dataDosen as $dosen) {
                                                $selected = ($dosen['nidn'] == $data['nidn']) ? 'selected' : '';
                                                echo '<option value="' . $dosen['nidn'] . '" ' . $selected . '>' . $dosen['nidn'] . ' - ' . $dosen['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hari" class="form-label">Hari</label>
                                        <select name="hari" class="custom-select form-control" id="hari">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                                            foreach ($days as $day) {
                                                $selected = ($day == $data['hari']) ? 'selected' : '';
                                                echo '<option value="' . $day . '" ' . $selected . '>' . $day . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jam" class="form-label">Jam</label>
                                        <select name="jam" class="custom-select form-control" id="jam">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            $times = ["08:00 - 10:00", "10:00 - 12:00", "13:00 - 15:00", "15:00 - 17:00", "17:00 - 19:00"];
                                            foreach ($times as $time) {
                                                $selected = ($time == $data['jam']) ? 'selected' : '';
                                                echo '<option value="' . $time . '" ' . $selected . '>' . $time . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ruangan" class="form-label">Ruangan</label>
                                        <select name="ruangan" class="custom-select form-control" id="ruangan">
                                            <option selected hidden>~ Pilih ~ </option>
                                            <?php
                                            $rooms = ["A101", "A102", "A103", "A104", "A105"];
                                            foreach ($rooms as $room) {
                                                $selected = ($room == $data['ruangan']) ? 'selected' : '';
                                                echo '<option value="' . $room . '" ' . $selected . '>' . $room . '</option>';
                                            }
                                            ?>
                                        </select>
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