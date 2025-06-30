<?php

namespace Database;
use Database\DatabaseInterface;
use Database\MySQL;
use Database\PostgreSql;


class DatabaseFactory
{
    /**
     * @param string $driver
     * @return DatabaseInterface
     * @throws InvalidArgumentException
     */
    public static function create(string $driver): DatabaseInterface
    {
        return match (strtolower($driver)) {
            'mysql'  => new MySQL(),
            'pgsql'  => new PostgreSql(),
            default  => throw new \InvalidArgumentException("Неизвестный драйвер: $driver"),
        };
    }
}
