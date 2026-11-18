<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Bon;
use InvalidArgumentException;
use PDO;

class BonDAO implements IDbAccess
{

    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function insert(object $entitat): int
    {
        $bon = $this->comprovarBon($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO bons (client_id, usuari_id, tipus_bon, preu, data_inici, data_fi)
             VALUES (:client_id, :usuari_id, :tipus_bon, :preu, :data_inici, :data_fi)'
        );

        $stmt->execute([
            'client_id' => $bon->getClientId(),
            'usuari_id' => $bon->getUsuariId(),
            'tipus_bon' => $bon->getTipusBon(),
            'preu' => $bon->getPreu(),
            'data_inici' => $bon->getDataInici(),
            'data_fi' => $bon->getDataFi(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function findByClient(int $clientId): array
    {

        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT b.*, u.usuari AS nom_instructor
            FROM bons b
            JOIN usuaris u ON b.usuari_id = u.id
            WHERE b.client_id = :client_id
            ORDER BY b.data_alta DESC'
        );

        $stmt->setFetchMode(self::MODE, Bon::class);
        $stmt->execute(['client_id' => $clientId]);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Bon
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT * FROM bons WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Bon::class);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM bons WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function comptarPerClient(): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT client_id, COUNT(*) AS total
             FROM bons
             GROUP BY client_id'
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



    private function comprovarBon(object $entitat): Bon
    {
        if (!$entitat instanceof Bon) {
            throw new InvalidArgumentException('BonDAO només accepta objectes Bon.');
        }
        return $entitat;
    }

}