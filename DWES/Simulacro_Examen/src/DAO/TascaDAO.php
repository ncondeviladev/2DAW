<?php
namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Tasca;
use InvalidArgumentException;
use PDO;

/**
 * @implements IDbAccess<Tasca>
 */



class TascaDAO implements IDbAccess
{

    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function insert(object $entitat): int
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO tasques (lead_id, usuari_id, descripcio, data_limit) VALUES (:lead_id, :usuari_id, :descripcio, :data_limit)'
        );

        $stmt->execute([
            'lead_id' => $entitat->getLeadId(),
            'usuari_id' => $entitat->getUsuariId(),
            'descripcio' => $entitat->getDescripcio(),
            'data_limit' => $entitat->getDataLimit(),
        ]);

        return (int) $pdo->lastInsertId();

    }

    public function findByLead(int $leadId): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT t.id, t.lead_id, t.usuari_id, t.descripcio, t.data_creacio, t.data_limit, t.completada, 
            u.usuari AS nom_usuari FROM tasques t
            JOIN usuaris u ON t.usuari_id = u.id
            WHERE t.lead_id = :lead_id
            ORDER BY t.completada ASC, t.data_limit ASC'
        );

        $stmt->setFetchMode(self::MODE, Tasca::class);
        $stmt->execute(['lead_id' => $leadId]);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Tasca
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT id, lead_id, usuari_id, descripcio, data_creacio, data_limit, completada FROM tasques WHERE id = :id'
        );
        $stmt->setFetchMode(self::MODE, Tasca::class);
        $stmt->execute(['id' => $id]);

        $tasca = $stmt->fetch();

        return $tasca === false ? null : $tasca;
    }

    public function marcarCompletada(int $id): bool
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('UPDATE tasques SET completada = 1 WHERE id = :id');
        return $stmt->execute(['id' => $id]);

    }

    public function comptarPendentsPerLEad(): array
    {

        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->query(
            'SELECT lead_id, COUNT(*) AS total
            FROM tasques
            WHERE completada = 0
            GROUP BY lead_id'
        );
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM tasques WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    //Metodes buits per cumplir contracte de la interficie
    public function findAll(): array
    {
        return [];
    }

    public function update(object $entitat): void
    {
        
    }



}