<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}
require ('../mongodb_connection.php');
use MongoDB\BSON\ObjectId;
if (isset($_GET['_id'])){
    $id = $_GET['_id'];
    $adminIid = new ObjectId($id);
    $collection = $database->admin;
    $result = $collection->findOne(['_id' => $adminIid]);
    $data = [
        'nama' => $result['nama'],
        'email' => $result['email'],
        'no_hp' => $result['no_hp']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $data = [
        'nama' => $nama,
        'password' => $password,
        'email' => $email,
        'no_hp' => $no_hp,
    ];

    try {
        $collection->updateOne(['_id' => $adminIid], ['$set' => $data]);
        header('Location: data_admin.php');

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
            <h3>Edit Data Admin</h3>
            <form action="" method="post">
                <div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
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
                    <a href="data_admin.php" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
