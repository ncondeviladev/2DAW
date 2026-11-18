<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Vacuna;
use InvalidArgumentException;
use PDO;



class VacunaDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;
    public function __construct(private DBConnection $connexio)
    {
    }


    public function insert(object $entitat): int
    {
        $vacuna = $this->comprovarVacuna($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO vacunes (pacient_id, usuari_id, nom_vacuna, preu, proxima_dosi)
             VALUES (:pacient_id, :usuari_id, :nom_vacuna, :preu, :proxima_dosi)'
        );

        $stmt->execute([
            'pacient_id' => $vacuna->getPacientId(),
            'usuari_id' => $vacuna->getUsuariId(),
            'nom_vacuna' => $vacuna->getNomVacuna(),
            'preu' => $vacuna->getPreu(),
            'proxima_dosi' => $vacuna->getProximaDosi(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function findByPacient(int $pacient_id): array
    {
        $pdo = $this->connexio->getPdo();

        $stmt = $pdo->prepare(
            'SELECT v.id, v.pacient_id, v.usuari_id, v.nom_vacuna, v.preu, v.proxima_dosi, v.data_administracio, 
                u.usuari AS nom_veterinari
                FROM vacunes v
                JOIN usuaris u ON v.usuari_id = :pacient_id
                ORDER BY v.data_administracio DESC'
        );

        $stmt->execute(['pacient_id' => $pacient_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Vacuna::class);
    }

    public function findById(int $id): ?Vacuna
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare('SELECT * FROM vacunes WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Vacuna::class);
        $stmt->execute(['id' => $id]);

        $vacuna = $stmt->fetch();
        return $vacuna === false ? null : $vacuna;
    }
    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM vacunes WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function comptarVacunesPerPacient(): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT pacient_id, COUNT(*) AS total
            FROM vacunes
            GROUP BY pacient_id'
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



    private function comprovarVacuna(object $entitat): Vacuna
    {
        if (!$entitat instanceof Vacuna) {
            throw new InvalidArgumentException('VacunaDAO només accepta objectes Vacuna .');
        }
        return $entitat;
    }
}