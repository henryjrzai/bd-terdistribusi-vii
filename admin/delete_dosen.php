<?php
require ('../mongodb_connection.php');
if (isset($_GET['nidn'])){
    $nidn = $_GET['nidn'];
    $collection = $database->dosen;
    $result = $collection->findOne(['nidn' => $nidn]);
    try {
        $collection->deleteOne(['nidn' => $nidn]);
        header('Location: data_dosen.php');

    } catch (Exception $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}