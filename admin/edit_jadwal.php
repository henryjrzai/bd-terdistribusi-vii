<?php
require ('../mongodb_connection.php');

$mahasiswa = $database->mahasiswa;
$matkul = $database->matakuliah;
$dsn = $database->dosen;

$dataMatkul = $matkul->find();
$dataDosen = $dsn->find();
$dataMahasiswa = $mahasiswa->find();

if (isset($_GET['id'])){
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

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
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
            <h3>Edit Data Dosen</h3>
            <form action="" method="post">
                <div>
                    <div class="form-group">
                        <label for="kode_mk">Kode Matkul</label>
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
                    <div class="form-group">
                        <label for="nim">Mahasiswa</label>
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
                    <div class="form-group">
                        <label for="nidn">Dosen</label>
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
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari"  class="custom-select form-control" id="hari">
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
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <select name="jam"  class="custom-select form-control" id="jam">
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
                    <div class="form-group">
                        <label for="ruangan">Ruangan</label>
                        <select name="ruangan"  class="custom-select form-control"  id="ruangan">
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
                </div>
                <div>
                    <a href="data_jadwal.php" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>