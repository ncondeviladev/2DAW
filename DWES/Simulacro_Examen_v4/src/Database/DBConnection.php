<?php

namespace App\Database;

use PDO;
use PDOException;

class DBConnection
{
    private PDO $pdo;

    public function __construct(
        private string $host,
        private string $baseDades,
        private string $usuari,
        private string $contrasenya,
        private string $charset = 'utf8mb4'
    ) {
        $dsn = "mysql:host={$this->host};dbname={$this->baseDades};charset={$this->charset}";
        try {
            $this->pdo = new PDO($dsn, $this->usuari, $this->contrasenya, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Error de connexió a la base de dades: ' . $e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
