<?php

namespace App\Database;

use PDO;

class DBConnection
{
    private ?PDO $pdo = null;

    public function __construct(
        private string $host,
        private string $baseDades,
        private string $usuari,
        private string $contrasenya,
        private string $charset = 'utf8mb4'
    ) {
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->baseDades};charset={$this->charset}";

            $this->pdo = new PDO($dsn, $this->usuari, $this->contrasenya, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        }

        return $this->pdo;
    }
}