<?php
require '../vendor/autoload.php';
$user = rawurlencode('basisdataterdistribusi');

$uri = "mongodb+srv://$user:$user@bdakademik.rzdbp.mongodb.net/?retryWrites=true&w=majority&appName=bdakademik";
$client = new MongoDB\Client($uri); 

$database = $client->akademik;
$collection = $database->dosen;