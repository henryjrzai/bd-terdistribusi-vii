<?php
require '../vendor/autoload.php';
// $client = new MongoDB\Client("mongodb://localhost:27017");

use MongoDB\Driver\ServerApi;
$uri = 'mongodb+srv://henryjrzai:henryjrzai@bdakademik.rzdbp.mongodb.net/?retryWrites=true&w=majority&appName=bdakademik';
// Set the version of the Stable API on the client
$apiVersion = new ServerApi(ServerApi::V1);
// Create a new client and connect to the server
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

$database = $client->akademik;
$collection = $database->dosen;