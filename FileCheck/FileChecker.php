<?php
namespace FileCheck;
/**
 * Класс для поиска и вывода файлов из папки /datafiles,
 * имена которых состоят из латинских букв и цифр и имеют расширение .ixt,
 * отсортированных по имени.
 */
class FileChecker
{
    /**
     * Путь к директории с файлами
     *
     * @var string
     */
    private string $directory;

    /**
     * Конструктор.
     *
     * @param string|null $directory Путь к директории, по умолчанию 'datafiles' рядом с файлом
     */
    public function __construct(?string $directory = null)
    {
        $this->directory = $directory ?? __DIR__ . '/../datafiles';
    }

    /**
     * Получить список файлов, соответствующих критериям:
     * - Имя состоит только из цифр и латинских букв
     * - Расширение .ixt
     *
     * @return string[] Массив имён файлов
     */
    public function getIxtFiles(): array
    {
        try {
            if (!is_dir($this->directory) || !is_readable($this->directory)) {
                throw new \RuntimeException("Директория {$this->directory} не существует или недоступна для чтения.");
            }

            $files = scandir($this->directory);
            $matchedFiles = [];

            $pattern = '/^[a-zA-Z0-9]+\.ixt$/';

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                if (preg_match($pattern, $file)) {
                    $matchedFiles[] = $file;
                }
            }

            sort($matchedFiles);

            return $matchedFiles;

        } catch (\Throwable $t) {
            echo "Ошибка: " . $t->getMessage() . PHP_EOL;
            return [];
        }
    }

    /**
     * @return void
     */
    public function printFiles(): void
    {
        $files = $this->getIxtFiles();

        foreach ($files as $file) {
            //echo $file . PHP_EOL;
            echo $file .'<br>';
        }
    }
}
