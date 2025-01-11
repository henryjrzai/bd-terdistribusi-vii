<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit();
}
require ('../mongodb_connection.php');
use MongoDB\BSON\ObjectId;
if (isset($_GET['_id'])){
    $id = $_GET['_id'];
    $adminId = new ObjectId($id);
    $collection = $database->admin;
    $result = $collection->findOne(['_id' => $adminId]);
    try {
        $collection->deleteOne(['_id' => $adminId]);
        header('Location: data_admin.php');

    } catch (Exception $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}