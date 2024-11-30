<?php
namespace App\Database;

require_once __DIR__ . '../../vendor/autoload.php';

use Exception;
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
class Conn
{
    public $db;
    public function __construct()
    {
        $uri = 'mongodb://localhost:27017';
        $apiVersion = new ServerApi(ServerApi::V1);
        $client = new Client($uri, [], ['serverApi' => $apiVersion]);
        try {
            // Send a ping to confirm a successful connection
            $client->selectDatabase('akademik')->command(['ping' => 1]);
            $this->db = $client->selectDatabase('akademik');
        } catch (Exception $e) {
            printf($e->getMessage());
        }
    }
}