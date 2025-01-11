<?php
require '../vendor/autoload.php';
// $client = new MongoDB\Client("mongodb://localhost:27017");
// $user = rawurlencode('henryjrzai');
// use MongoDB\Driver\ServerApi;
$user = rawurlencode('basisdataterdistribusi');

$uri = "mongodb+srv://$user:$user@bdakademik.rzdbp.mongodb.net/?retryWrites=true&w=majority&appName=bdakademik";
// Set the version of the Stable API on the client
// $apiVersion = new ServerApi(ServerApi::V1);
// Create a new client and connect to the server
// $client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
$client = new MongoDB\Client($uri); 

$database = $client->akademik;
// $database =  $client->selectDatabase('akademik')->command(['ping' => 1]);
$collection = $database->dosen;