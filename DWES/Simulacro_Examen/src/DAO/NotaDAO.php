<?php
namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Nota;
use InvalidArgumentException;
use PDO;

/**
 * @implements IDbAccess<Nota>
 */

class NotaDAO implements IDbAccess
{

    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;
    public function __construct(private DBConnection $connexio)
    {
    }


    public function comprovarNota(object $entitat): Nota
    {
        if (!$entitat instanceof Nota) {
            throw new InvalidArgumentException("NotaDAO només acepta objectes Nota");
        }
        return $entitat;
    }
    public function insert(object $entitat): int
    {
        $nota = $this->comprovarNota($entitat);
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'INSERT INTO notes (lead_id, usuari_id, text) VALUES (:lead_id, :usuari_id, :text)'
        );

        $stmt->execute([
            'lead_id' => $nota->getLeadId(),
            'usuari_id' => $nota->getUsuariId(),
            'text' => $nota->getText(),
        ]);

        return (int) $pdo->lastInsertId();

    }
    public function findByLead(int $leadId): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT n.id, n.lead_id, n.usuari_id, n.text, n.data_creacio, u.usuari AS nom_usuari FROM notes n
            JOIN usuaris u ON n.usuari_id = u.id
            WHERE n.lead_id = :lead_id
            ORDER BY n.data_creacio DESC'
        );

        $stmt->setFetchMode(self::MODE, Nota::class);
        $stmt->execute(['lead_id' => $leadId]);

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?Nota
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare(
            'SELECT id, lead_id, usuari_id, text, data_creacio FROM notes WHERE id = :id'
        );
        $stmt->setFetchMode(self::MODE, Nota::class);
        $stmt->execute(['id' => $id]);

        $nota = $stmt->fetch();

        return $nota === false ? null : $nota;
    }
    //Unica consulta amb group tornant clau valor en un array asociatiu
    public function comptarPerLead(): array
    { //Consulta amb query perque no rep variables de fora
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->query(
            'SELECT lead_id, COUNT(*) AS total
            FROM notes
            GROUP BY lead_id'
        );

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM notes WHERE id = :id');
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

