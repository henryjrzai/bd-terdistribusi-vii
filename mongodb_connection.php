<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->akademik;
$collection = $database->dosen;
//echo $collection->count();
//echo "Koneksi ke MongoDB berhasil!";