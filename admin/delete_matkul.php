<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}
require ('../mongodb_connection.php');
if (isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
    $collection = $database->matakuliah;
    $result = $collection->findOne(['kode_mk' => $kode_mk]);
    try {
        $collection->deleteOne(['kode_mk' => $kode_mk]);
        header('Location: data_matkul.php');

    } catch (Exception $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}