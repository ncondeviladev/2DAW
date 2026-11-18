<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Intervencio;
use InvalidArgumentException;
use PDO;

/**
 * @implements IDbAccess<Intervencio>
 */
class IntervencioDAO implements IDbAccess
{

    // Cada fila es converteix en un objecte Usuari
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;
    public function __construct(private DBConnection $connexio)
    {
    }

    public function insert(object $entitat): int
    {
        $intervencio = $this->comprovarIntervencio($entitat);
        $pdo = $this->connexio->getPDO();

        // L'id el genera MySQL: no s'envia
        $stmt = $pdo->prepare(
            'INSERT INTO intervencions (tiquet_id, usuari_id, minuts, comentari)
             VALUES (:tiquet_id, :usuari_id, :minuts, :comentari)'
        );

        $stmt->execute([
            'tiquet_id' => $intervencio->getTiquetId(),
            'usuari_id' => $intervencio->getUsuariId(),
            'minuts' => $intervencio->getMinuts(),
            'comentari' => $intervencio->getComentari(),
        ]);

        return (int) $pdo->lastInsertId();
    }


    public function findByTiquet(int $tiquetId): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT i.id, i.tiquet_id, i.usuari_id, i.minuts, i.comentari, i.data_intervencio, u.usuari AS nom_usuari
             FROM intervencions i
             JOIN usuaris u 
             ON i.usuari_id = u.id
             WHERE i.tiquet_id = :tiquet_id
             ORDER BY i.data_intervencio DESC'
        );

        $stmt->execute(['tiquet_id' => $tiquetId]);

        return $stmt->fetchAll(self::MODE, Intervencio::class);


    }
    public function findById(int $id): ?Intervencio
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT id, tiquet_id, usuari_id, minuts, comentari, data_intervencio
             FROM intervencions
             WHERE id = :id'
        );

        $stmt->setFetchMode(self::MODE, Intervencio::class);
        $stmt->execute(['id' => $id]);

        $intervencio = $stmt->fetch();

        return $intervencio === false ? null : $intervencio;
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare('DELETE FROM intervencions WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function calcularTotalMinutsPerTiquet(): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT tiquet_id, SUM(minuts) AS total_minuts
            FROM intervencions
            GROUP BY tiquet_id'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }


    private function comprovarIntervencio(object $entitat): Intervencio
    {
        if (!$entitat instanceof Intervencio) {
            throw new InvalidArgumentException(
                'IntervencioDAO només accepta objectes Intervencio.'
            );
        }

        return $entitat;
    }
    public function findAll(): array
{
    return [];
}

public function update(object $entitat): void
{
}
}