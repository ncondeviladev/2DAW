<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Vehicle;
use InvalidArgumentException;
use PDO;

class VehicleDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio) {}

    public function insert(object $entitat): int
    {
        $v = $this->comprovarVehicle($entitat);
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'INSERT INTO vehicles (matricula, marca, model, nom_propietari, telefon, any_fabricacio)
             VALUES (:matricula, :marca, :model, :nom_propietari, :telefon, :any_fabricacio)'
        );
        $stmt->execute([
            'matricula'      => $v->getMatricula(),
            'marca'          => $v->getMarca(),
            'model'          => $v->getModel(),
            'nom_propietari' => $v->getNomPropietari(),
            'telefon'        => $v->getTelefon(),
            'any_fabricacio' => $v->getAnyFabricacio(),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public function findAll(): array
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM vehicles ORDER BY data_alta DESC');
        $stmt->setFetchMode(self::MODE, Vehicle::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Vehicle
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM vehicles WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Vehicle::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function update(object $entitat): void {}

    public function delete(int $id): void
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM vehicles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function comprovarVehicle(object $entitat): Vehicle
    {
        if (!$entitat instanceof Vehicle) {
            throw new InvalidArgumentException('VehicleDAO només accepta objectes Vehicle.');
        }
        return $entitat;
    }
}
