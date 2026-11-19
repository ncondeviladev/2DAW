<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Reparacio;
use InvalidArgumentException;
use PDO;

class ReparacioDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio) {}

    public function insert(object $entitat): int
    {
        $rep = $this->comprovarReparacio($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO reparacions (vehicle_id, usuari_id, descripcio, hores_feina, cost_hora)
             VALUES (:vehicle_id, :usuari_id, :descripcio, :hores_feina, :cost_hora)'
        );

        $stmt->execute([
            'vehicle_id'   => $rep->getVehicleId(),
            'usuari_id'    => $rep->getUsuariId(),
            'descripcio'   => $rep->getDescripcio(),
            'hores_feina'  => $rep->getHoresFeina(),
            'cost_hora'    => $rep->getCostHora(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function findByVehicle(int $vehicleId): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT r.*, u.usuari AS nom_mecanic
             FROM reparacions r
             JOIN usuaris u ON r.usuari_id = u.id
             WHERE r.vehicle_id = :vehicle_id
             ORDER BY r.data_reparacio DESC'
        );

        $stmt->setFetchMode(self::MODE, Reparacio::class);
        $stmt->execute(['vehicle_id' => $vehicleId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Reparacio
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM reparacions WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Reparacio::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function delete(int $id): void
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM reparacions WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function comptarPerVehicle(): array
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT vehicle_id, COUNT(*) AS total
             FROM reparacions
             GROUP BY vehicle_id'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function findAll(): array { return []; }
    public function update(object $entitat): void {}

    private function comprovarReparacio(object $entitat): Reparacio
    {
        if (!$entitat instanceof Reparacio) {
            throw new InvalidArgumentException('ReparacioDAO només accepta objectes Reparacio.');
        }
        return $entitat;
    }
}
