<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('mongodb_connection.php');
$jdmatkul = $database->jadwalkuliah;
$mahasiswa = $database->mahasiswa;
$matkul = $database->matakuliah;
$dsn = $database->dosen;
$data = $jdmatkul->find();

$dataMatkul = $matkul->find();
$dataDosen = $dsn->find();
$dataMahasiswa = $mahasiswa->find();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jadwal</title>
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                            <h5 class="card-title fw-semibold mb-4">Data Jadwal</h5>
                            <a href="create.jadwal.php" class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">➕ Tambah Data</a>
                            <table id="myTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Kode Matkul</td>
                                        <td>NIM</td>
                                        <td>NIDN</td>
                                        <td>Hari</td>
                                        <td>Jam</td>
                                        <td>Ruangan</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $jadwal) {
                                        echo '<tr>';
                                        echo '<td>' . $no++ . '</td>';
                                        echo '<td>' . $jadwal['kode_mk'] . '</td>';
                                        echo '<td>' . $jadwal['nim'] . '</td>';
                                        echo '<td>' . $jadwal['nidn'] . '</td>';
                                        echo '<td>' . $jadwal['hari'] . '</td>';
                                        echo '<td>' . $jadwal['jam'] . '</td>';
                                        echo '<td>' . $jadwal['ruangan'] . '</td>';
                                        echo '<td>
                                    <a href="edit_jadwal.php?id=' . $jadwal['_id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_jadwal.php?id=' . $jadwal['_id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                                </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
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