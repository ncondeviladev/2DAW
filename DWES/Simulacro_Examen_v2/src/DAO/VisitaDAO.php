<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Visita;
use InvalidArgumentException;
use PDO;

/**
 * VisitaDAO - Exemple complet de referència per a relacions 1:N.
 * Utilitza este fitxer com a guia per a construir el teu nou DAO a l'examen.
 */
class VisitaDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function insert(object $entitat): int
    {
        $visita = $this->comprovarVisita($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO visites (pacient_id, usuari_id, motiu, diagnostic)
             VALUES (:pacient_id, :usuari_id, :motiu, :diagnostic)'
        );

        $stmt->execute([
            'pacient_id' => $visita->getPacientId(),
            'usuari_id'  => $visita->getUsuariId(),
            'motiu'       => $visita->getMotiu(),
            'diagnostic'  => $visita->getDiagnostic(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    /**
     * Exemple de consulta amb JOIN cap a usuaris:
     */
    public function findByPacient(int $pacientId): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT v.id, v.pacient_id, v.usuari_id, v.motiu, v.diagnostic, v.data_visita,
                    u.usuari AS nom_veterinari
             FROM visites v
             JOIN usuaris u ON v.usuari_id = u.id
             WHERE v.pacient_id = :pacient_id
             ORDER BY v.data_visita DESC'
        );

        $stmt->execute(['pacient_id' => $pacientId]);

        return $stmt->fetchAll(self::MODE, Visita::class);
    }

    public function findById(int $id): ?Visita
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare('SELECT * FROM visites WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Visita::class);
        $stmt->execute(['id' => $id]);

        $visita = $stmt->fetch();
        return $visita === false ? null : $visita;
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM visites WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    /**
     * Exemple de consulta agrupada per a evitar el problema N+1:
     * Retorna un array associatiu: [pacient_id => total_visites]
     */
    public function comptarPerPacient(): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->query(
            'SELECT pacient_id, COUNT(*) AS total
             FROM visites
             GROUP BY pacient_id'
        );

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function findAll(): array
    {
        return [];
    }

    public function update(object $entitat): void
    {
    }

    private function comprovarVisita(object $entitat): Visita
    {
        if (!$entitat instanceof Visita) {
            throw new InvalidArgumentException('VisitaDAO només accepta objectes Visita.');
        }
        return $entitat;
    }
}
