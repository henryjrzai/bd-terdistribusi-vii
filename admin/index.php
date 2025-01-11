<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        
        <?php
        require ('components/side.php');
        ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            require ('components/nav.php');
            ?>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold"> Mahasiswa </h5>
                                            <h4 class="fw-semibold mb-3">Total: <?php echo $total_mahasiswa; ?></h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div
                                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-empathize fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold"> Dosen </h5>
                                            <h4 class="fw-semibold mb-3">Total: <?php echo $total_dosen; ?></h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div
                                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-users fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold"> Mata Kuliah </h5>
                                            <h4 class="fw-semibold mb-3">Total: <?php echo $total_makul; ?></h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div
                                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-book fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold"> Jadwal Kuliah </h5>
                                            <h4 class="fw-semibold mb-3">Total: <?php echo $total_jadwal; ?></h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div
                                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-notebook fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require ('components/foot.php');
        ?>
</body>

</html>