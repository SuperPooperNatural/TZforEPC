<?php

namespace Database;

use PDO;
use Database\DatabaseFactory;

/**
 * Финальный класс для создания и заполнения таблицы test, а также выборки данных.
 */
final class Init
{
    /**
     * @var PDO 
     */
    private PDO $pdo;

    /**
     * Конструктор.
     * Инициализирует соединение, создаёт таблицу и заполняет её данными.
     *
     * @param string $driver Название драйвера (mysql, pgsql, sqlite и т.д.)
     * @throws \PDOException
     */
    public function __construct(string $driver = 'mysql')
    {
        $this->pdo = DatabaseFactory::create($driver)->connect();
        $this->create();
        $this->fill();
    }

    /**
     * Создаёт таблицу test, если она ещё не существует.
     *
     * @return void
     */
    private function create(): void
    {
        try {
            $sql = "
            CREATE TABLE IF NOT EXISTS test (
                id SERIAL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                score INT NOT NULL,
                result VARCHAR(50) NOT NULL
            );
        ";

            $this->pdo->exec($sql);
        } catch (\Throwable $t) {
            echo "Ошибка при создании таблицы: " . $t->getMessage();
        }
    }


    /**
     * Заполняет таблицу test случайными данными.
     *
     * @return void
     */
    private function fill(): void
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO test (name, email, score, result)
                VALUES (:name, :email, :score, :result)
            ");

            $results = ['normal', 'fail', 'success', 'error'];
            for ($i = 0; $i < 10; $i++) {
                $stmt->execute([
                    ':name'   => 'User' . rand(1, 100),
                    ':email'  => 'user' . rand(1, 100) . '@example.com',
                    ':score'  => rand(0, 100),
                    ':result' => $results[array_rand($results)],
                ]);
            }
        } catch (\Throwable $t) {
            echo "Ошибка при заполнении таблицы: " . $t->getMessage();
        }
    }

    /**
     * Получает строки, где result 'normal' или 'success'.
     *
     * @return array|null
     */
    public function get(): ?array
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM test
                WHERE result IN ('normal', 'success')
            ");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $t) {
           echo "Ошибка при выборке данных: " . $t->getMessage();
           return null;
        }
    }
}
