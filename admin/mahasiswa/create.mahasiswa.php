<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../../login.php');
    exit();
}
require('../../mongodb_connection.php');

if (isset($_POST['npm'], $_POST['nama'], $_POST['jurusan'], $_POST['alamat'], $_POST['email'], $_POST['no_hp'])) {
    $npm = filter_var($_POST['npm'], FILTER_SANITIZE_STRING);
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $jurusan = filter_var($_POST['jurusan'], FILTER_SANITIZE_STRING);
    $alamat = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $no_hp = filter_var($_POST['no_hp'], FILTER_SANITIZE_STRING);

    $data = [
        'npm' => $npm,
        'nama' => $nama,
        'jurusan' => $jurusan,
        'alamat' => $alamat,
        'email' => $email,
        'no_hp' => $no_hp,
    ];

    try {
        $collection = $database->mahasiswa;
        $collection->insertOne($data);
        echo "Data inserted successfully.";
    } catch (Exception $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
} else {
    echo "All fields are required.";
}
?>