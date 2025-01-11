<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require('mongodb_connection.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $collection = $database->jadwalkuliah;
    try {
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        header('Location: data_jadwal.php');

    } catch (Exception $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}