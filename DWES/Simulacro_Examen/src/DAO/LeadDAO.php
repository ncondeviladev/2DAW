<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Lead;
use InvalidArgumentException;
use PDO;

/**
 * @implements IDbAccess<Lead>
 */
class LeadDAO implements IDbAccess
{
    // Cada fila es converteix en un objecte Lead
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio) {}

    public function findAll(): array
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->query(
            'SELECT id, nom, email, telefon, empresa, serveis,
                    pressupost, missatge, document, estat
             FROM leads
             ORDER BY data_creacio DESC, id DESC'
        );

        return $stmt->fetchAll(self::MODE, Lead::class);
    }

    public function findById(int $id): ?Lead
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'SELECT id, nom, email, telefon, empresa, serveis,
                    pressupost, missatge, document, estat
             FROM leads
             WHERE id = :id'
        );

        $stmt->setFetchMode(self::MODE, Lead::class);
        $stmt->execute(['id' => $id]);

        $lead = $stmt->fetch();

        return $lead === false ? null : $lead;
    }

    public function insert(object $entitat): int
    {
        $lead = $this->comprovarLead($entitat);
        $pdo = $this->connexio->getPDO();

        // L'id el genera MySQL: no s'envia
        $stmt = $pdo->prepare(
            'INSERT INTO leads
                (nom, email, telefon, empresa, serveis, pressupost,
                 missatge, document, estat)
             VALUES
                (:nom, :email, :telefon, :empresa, :serveis, :pressupost,
                 :missatge, :document, :estat)'
        );

        $stmt->execute([
            'nom'        => $lead->getNom(),
            'email'      => $lead->getEmail(),
            'telefon'    => $lead->getTelefon(),
            'empresa'    => $lead->getEmpresa(),
            'serveis' => json_encode(
                $lead->getServeis(),
                JSON_UNESCAPED_UNICODE
            ),
            'pressupost' => $lead->getPressupost(),
            'missatge'   => $lead->getMissatge(),
            'document'   => $lead->getDocument(),
            'estat'      => $lead->getEstat(),
        ]);

        return (int) $pdo->lastInsertId();
    }

    public function update(object $entitat): void
    {
        $lead = $this->comprovarLead($entitat);

        if ($lead->getId() === null) {
            throw new InvalidArgumentException(
                'No es pot actualitzar un lead sense id.'
            );
        }

        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'UPDATE leads
             SET nom = :nom,
                 email = :email,
                 telefon = :telefon,
                 empresa = :empresa,
                 serveis = :serveis,
                 pressupost = :pressupost,
                 missatge = :missatge,
                 document = :document,
                 estat = :estat
             WHERE id = :id'
        );

        $stmt->execute([
            'nom'        => $lead->getNom(),
            'email'      => $lead->getEmail(),
            'telefon'    => $lead->getTelefon(),
            'empresa'    => $lead->getEmpresa(),
            'serveis' => json_encode(
                $lead->getServeis(),
                JSON_UNESCAPED_UNICODE
            ),
            'pressupost' => $lead->getPressupost(),
            'missatge'   => $lead->getMissatge(),
            'document'   => $lead->getDocument(),
            'estat'      => $lead->getEstat(),
            'id'         => $lead->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();

        $stmt = $pdo->prepare(
            'DELETE FROM leads WHERE id = :id'
        );

        $stmt->execute(['id' => $id]);
    }

    /**
     * Comprova que l'entitat és un Lead (el instanceof del punt 5).
     */
    private function comprovarLead(object $entitat): Lead
    {
        if (!$entitat instanceof Lead) {
            throw new InvalidArgumentException(
                'LeadDAO només accepta objectes Lead.'
            );
        }

        return $entitat;
    }
}
