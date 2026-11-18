<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Classe;
use InvalidArgumentException;
use PDO;

class ClasseDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio) {}

    public function insert(object $entitat): int
    {
        $classe = $this->comprovarClasse($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO classes (client_id, usuari_id, activitat, durada_minuts, observacions)
             VALUES (:client_id, :usuari_id, :activitat, :durada_minuts, :observacions)'
        );

        $stmt->execute([
            'client_id'    => $classe->getClientId(),
            'usuari_id'    => $classe->getUsuariId(),
            'activitat'    => $classe->getActivitat(),
            'durada_minuts'=> $classe->getDuradaMinuts(),
            'observacions' => $classe->getObservacions(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function findByClient(int $clientId): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT c.*, u.usuari AS nom_instructor
             FROM classes c
             JOIN usuaris u ON c.usuari_id = u.id
             WHERE c.client_id = :client_id
             ORDER BY c.data_classe DESC'
        );

        $stmt->setFetchMode(self::MODE, Classe::class);
        $stmt->execute(['client_id' => $clientId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Classe
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM classes WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Classe::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function delete(int $id): void
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM classes WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function comptarPerClient(): array
    {
        $pdo  = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT client_id, COUNT(*) AS total
             FROM classes
             GROUP BY client_id'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function findAll(): array { return []; }
    public function update(object $entitat): void {}

    private function comprovarClasse(object $entitat): Classe
    {
        if (!$entitat instanceof Classe) {
            throw new InvalidArgumentException('ClasseDAO només accepta objectes Classe.');
        }
        return $entitat;
    }
}
