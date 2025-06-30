<?php

namespace Database;

use PDO;
use Database\DatabaseInterface;

class MySQL implements DatabaseInterface
{
    /**
     * @return PDO 
     *
     * @throws \PDOException 
     */
    public function connect(): PDO
    {
        $dsn = 'mysql:host=localhost;dbname=testdb;charset=utf8mb4';
        $username = 'Supernatural';
        $password = 'Zlhjxedrcc34';

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
