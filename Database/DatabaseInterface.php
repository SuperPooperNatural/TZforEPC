<?php

namespace Database;

use PDO;

/**
 * Интерфейс подключения к базе данных.
 */
interface DatabaseInterface
{
    /**
     * @return PDO
     */
    public function connect(): PDO;
}
