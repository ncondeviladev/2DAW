<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Tiquet;
use InvalidArgumentException;
use PDO;

class TiquetDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function findAll(): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->query(
            'SELECT id, codi, titol, descripcio, client_nom, client_email, prioritat, estat, data_creacio
             FROM tiquets
             ORDER BY data_creacio DESC'
        );

        return $stmt->fetchAll(self::MODE, Tiquet::class);
    }

    public function findById(int $id): ?Tiquet
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT id, codi, titol, descripcio, client_nom, client_email, prioritat, estat, data_creacio
             FROM tiquets
             WHERE id = :id'
        );

        $stmt->setFetchMode(self::MODE, Tiquet::class);
        $stmt->execute(['id' => $id]);

        $tiquet = $stmt->fetch();

        return $tiquet === false ? null : $tiquet;
    }

    public function insert(object $entitat): int
    {
        $tiquet = $this->comprovarTiquet($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO tiquets (codi, titol, descripcio, client_nom, client_email, prioritat, estat)
             VALUES (:codi, :titol, :descripcio, :client_nom, :client_email, :prioritat, :estat)'
        );

        $stmt->execute([
            'codi'         => $tiquet->getCodi(),
            'titol'        => $tiquet->getTitol(),
            'descripcio'   => $tiquet->getDescripcio(),
            'client_nom'   => $tiquet->getClientNom(),
            'client_email' => $tiquet->getClientEmail(),
            'prioritat'    => $tiquet->getPrioritat(),
            'estat'        => $tiquet->getEstat(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function update(object $entitat): void
    {
        $tiquet = $this->comprovarTiquet($entitat);

        if ($tiquet->getId() === null) {
            throw new InvalidArgumentException('No es pot actualitzar un tiquet sense id.');
        }

        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'UPDATE tiquets
             SET titol = :titol,
                 descripcio = :descripcio,
                 prioritat = :prioritat,
                 estat = :estat
             WHERE id = :id'
        );

        $stmt->execute([
            'titol'      => $tiquet->getTitol(),
            'descripcio' => $tiquet->getDescripcio(),
            'prioritat'  => $tiquet->getPrioritat(),
            'estat'      => $tiquet->getEstat(),
            'id'         => $tiquet->getId(),
        ]);
    }

    public function canviarEstat(int $id, string $nouEstat): void
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare('UPDATE tiquets SET estat = :estat WHERE id = :id');
        $stmt->execute([
            'estat' => $nouEstat,
            'id'    => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare('DELETE FROM tiquets WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function comprovarTiquet(object $entitat): Tiquet
    {
        if (!$entitat instanceof Tiquet) {
            throw new InvalidArgumentException('TiquetDAO només accepta objectes Tiquet.');
        }

        return $entitat;
    }
}
