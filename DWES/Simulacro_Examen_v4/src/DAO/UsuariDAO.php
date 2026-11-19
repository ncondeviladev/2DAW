<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Usuari;
use PDO;

class UsuariDAO implements IDbAccess
{
    public function __construct(private DBConnection $connexio) {}

    public function findByUsuari(string $usuari): ?Usuari
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM usuaris WHERE usuari = :usuari');
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Usuari::class);
        $stmt->execute(['usuari' => $usuari]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function insert(object $entitat): int { return 0; }
    public function findAll(): array { return []; }
    public function findById(int $id): ?object { return null; }
    public function update(object $entitat): void {}
    public function delete(int $id): void {}
}
