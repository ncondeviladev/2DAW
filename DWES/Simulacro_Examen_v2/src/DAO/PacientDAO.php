<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Pacient;
use InvalidArgumentException;
use PDO;

class PacientDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function findAll(): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->query(
            'SELECT id, nom, especie, raca, nom_propietari, telefon, data_naixement, microxip, data_alta
             FROM pacients
             ORDER BY nom ASC'
        );
        return $stmt->fetchAll(self::MODE, Pacient::class);
    }

    public function findById(int $id): ?Pacient
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT id, nom, especie, raca, nom_propietari, telefon, data_naixement, microxip, data_alta
             FROM pacients
             WHERE id = :id'
        );
        $stmt->setFetchMode(self::MODE, Pacient::class);
        $stmt->execute(['id' => $id]);
        $pacient = $stmt->fetch();
        return $pacient === false ? null : $pacient;
    }

    public function insert(object $entitat): int
    {
        $pacient = $this->comprovarPacient($entitat);
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'INSERT INTO pacients (nom, especie, raca, nom_propietari, telefon, data_naixement, microxip)
             VALUES (:nom, :especie, :raca, :nom_propietari, :telefon, :data_naixement, :microxip)'
        );
        $stmt->execute([
            'nom'            => $pacient->getNom(),
            'especie'        => $pacient->getEspecie(),
            'raca'           => $pacient->getRaca(),
            'nom_propietari' => $pacient->getNomPropietari(),
            'telefon'        => $pacient->getTelefon(),
            'data_naixement' => $pacient->getDataNaixement(),
            'microxip'       => $pacient->getMicroxip(),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public function update(object $entitat): void
    {
        $pacient = $this->comprovarPacient($entitat);
        if ($pacient->getId() === null) {
            throw new InvalidArgumentException('No es pot actualitzar un pacient sense id.');
        }
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'UPDATE pacients
             SET nom = :nom, especie = :especie, raca = :raca, nom_propietari = :nom_propietari, telefon = :telefon
             WHERE id = :id'
        );
        $stmt->execute([
            'nom'            => $pacient->getNom(),
            'especie'        => $pacient->getEspecie(),
            'raca'           => $pacient->getRaca(),
            'nom_propietari' => $pacient->getNomPropietari(),
            'telefon'        => $pacient->getTelefon(),
            'id'             => $pacient->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM pacients WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function comprovarPacient(object $entitat): Pacient
    {
        if (!$entitat instanceof Pacient) {
            throw new InvalidArgumentException('PacientDAO només accepta objectes Pacient.');
        }
        return $entitat;
    }
}
