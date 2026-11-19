<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Recanvi;
use InvalidArgumentException;
use PDO;

class RecanviDAO implements IDbAccess
{

    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }
    public function insert(object $entitat): int
    {
        $v = $this->comprovarRecanvi($entitat);
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'INSERT INTO recanvis (vehicle_id, usuari_id, nom_peca, preu_unitari, quantitat)
             VALUES (:vehicle_id, :usuari_id, :nom_peca, :preu_unitari, :quantitat)'
        );
        $stmt->execute([
            'vehicle_id' => $v->getVehicleId(),
            'usuari_id' => $v->getUsuariId(),
            'nom_peca' => $v->getNomPeca(),
            'preu_unitari' => $v->getPreuUnitari(),
            'quantitat' => $v->getQuantitat(),

        ]);
        return (int) $pdo->lastInsertId();
    }

    public function findByVehicle(int $vehicleId): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT r.*, u.usuari AS nom_mecanic
            FROM recanvis r
            JOIN usuaris u ON r.usuari_id = u.id
            WHERE r.vehicle_id = :vehicleId
            ORDER BY r.data_alta DESC'
        );

        $stmt->setFetchMode(self::MODE, ReparaciRecanvi::class);
        $stmt->execute(['vehicle_id' => $vehicleId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Recanvi
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM recanvis WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Recanvi::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }
    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM recanvis WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
    public function comptarPerVehicle(): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT vehicle_id, COUNT(*) AS total
             FROM recanvis
             GROUP BY vehicle_id'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    public function findAll(): array
    {
        return [];
    }
    public function update(object $entitat): void
    {
    }


    private function comprovarRecanvi(object $entitat): Recanvi
    {
        if (!$entitat instanceof Recanvi) {
            throw new InvalidArgumentException('RecanviDAO només accepta objectes Recanvi.');
        }
        return $entitat;
    }
}