<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Client;
use InvalidArgumentException;
use PDO;

class ClientDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio) {}

    public function insert(object $entitat): int
    {
        $client = $this->comprovarClient($entitat);
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'INSERT INTO clients (nom, cognoms, email, telefon, data_naixement, nivell)
             VALUES (:nom, :cognoms, :email, :telefon, :data_naixement, :nivell)'
        );
        $stmt->execute([
            'nom'            => $client->getNom(),
            'cognoms'        => $client->getCognoms(),
            'email'          => $client->getEmail(),
            'telefon'        => $client->getTelefon(),
            'data_naixement' => $client->getDataNaixement(),
            'nivell'         => $client->getNivell(),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public function findAll(): array
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM clients ORDER BY cognoms, nom');
        $stmt->setFetchMode(self::MODE, Client::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Client
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM clients WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Client::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function update(object $entitat): void {}

    public function delete(int $id): void
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function comprovarClient(object $entitat): Client
    {
        if (!$entitat instanceof Client) {
            throw new InvalidArgumentException('ClientDAO només accepta objectes Client.');
        }
        return $entitat;
    }
}
