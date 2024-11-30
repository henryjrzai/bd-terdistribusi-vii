<?php
require ('../mongodb_connection.php');
$jdmatkul = $database->jadwalkuliah->find();
$mahasiswa = $database->mahasiswa->find();
$matkul = $database->matakuliah->find();
$dsn = $database->dosen->find();


// Menghitung total data mahasiswa
$total_mahasiswa = iterator_count($mahasiswa);

// Menghitung total data dosen
$total_dosen = iterator_count($dsn);

// Menghitung total data mata kuliah
$total_makul = iterator_count($matkul);

// Menghitung total data jadwal kuliah
$total_jadwal = iterator_count($jdmatkul);

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
            <div class="col-md-9 mt-3">
                <h3>Selamat Datang, Admin</h3>
                <p>Dashboard ini menyediakan akses cepat untuk mengelola dan memantau data mahasiswa, dosen, mata kuliah, dan jadwal kuliah di Fakultas Ilmu Komputer UNIKA Santo Thomas Medan.</p>

                <div class="row">
                    <!-- Card Data Mahasiswa -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="icon">👨‍🎓</div>
                                <h5 class="card-title">Data Mahasiswa</h5>
                                <p class="card-text">Total: <?php echo $total_mahasiswa; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Data Dosen -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="icon">👨‍🏫</div>
                                <h5 class="card-title">Data Dosen</h5>
                                <p class="card-text">Total: <?php echo $total_dosen; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Data Mata Kuliah -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="icon">📘</div>
                                <h5 class="card-title">Data Mata Kuliah</h5>
                                <p class="card-text">Total: <?php echo $total_makul; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Data Jadwal Kuliah -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="icon">📅</div>
                                <h5 class="card-title">Data Jadwal Kuliah</h5>
                                <p class="card-text">Total: <?php echo $total_jadwal; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
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
