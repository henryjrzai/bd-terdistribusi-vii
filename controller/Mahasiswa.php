<?php

namespace App\Controller;
require_once __DIR__ . '../../database/Conn.php';
class Mahasiswa
{
    public function index()
    {
        $conn = new \App\Database\Conn();
        $collection = $conn->db->mahasiswa;
        $result = $collection->find();
        return $result;
    }

    public function store($data)
    {
        $conn = new \App\Database\Conn();
        $collection = $conn->db->mahasiswa;
        $result = $collection->insertOne($data);
        if ($result->getInsertedCount() == 1) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Data gagal disimpan!";
        }
    }
}