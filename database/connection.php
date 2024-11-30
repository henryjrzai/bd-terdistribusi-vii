<?php
global $db;
require_once __DIR__ . '../../vendor/autoload.php';
//use Exception;
use MongoDB\Client;
use MongoDB\Driver\ServerApi;

$uri = 'mongodb://localhost:27017';
$apiVersion = new ServerApi(ServerApi::V1);
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
$db;
try {
    // Send a ping to confirm a successful connection
    $client->selectDatabase('akademik')->command(['ping' => 1]);
    $db = $client->selectDatabase('akademik');
} catch (Exception $e) {
    printf($e->getMessage());
}