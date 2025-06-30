<?php

namespace Database;

use PDO;
use Database\DatabaseInterface;

class PostgreSql implements DatabaseInterface
{
    /**
     * @return PDO
     */
    public function connect(): PDO
    {
        $dsn = 'pgsql:host=localhost;port=5432;dbname=testdb';
        $username = 'Supernatural';
        $password = 'Zlhjxedrcc34';

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
