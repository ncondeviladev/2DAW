<?php

namespace App\DAO;

use App\Database\DBConnection;
use App\Model\Usuari;
use InvalidArgumentException;
use PDO;

class UsuariDAO implements IDbAccess
{
    private const MODE = PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE;

    public function __construct(private DBConnection $connexio)
    {
    }

    public function findAll(): array
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->query('SELECT id, usuari, contrasenya, rol FROM usuaris ORDER BY usuari');
        return $stmt->fetchAll(self::MODE, Usuari::class);
    }

    public function findById(int $id): ?Usuari
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT id, usuari, contrasenya, rol FROM usuaris WHERE id = :id');
        $stmt->setFetchMode(self::MODE, Usuari::class);
        $stmt->execute(['id' => $id]);
        $usuari = $stmt->fetch();
        return $usuari === false ? null : $usuari;
    }

    public function findByUsuari(string $nomUsuari): ?Usuari
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('SELECT id, usuari, contrasenya, rol FROM usuaris WHERE usuari = :usuari');
        $stmt->setFetchMode(self::MODE, Usuari::class);
        $stmt->execute(['usuari' => $nomUsuari]);
        $usuari = $stmt->fetch();
        return $usuari === false ? null : $usuari;
    }

    public function insert(object $entitat): int
    {
        $usuari = $this->comprovarUsuari($entitat);
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('INSERT INTO usuaris (usuari, contrasenya, rol) VALUES (:usuari, :contrasenya, :rol)');
        $stmt->execute([
            'usuari'      => $usuari->getUsuari(),
            'contrasenya' => $usuari->getContrasenyaHash(),
            'rol'         => $usuari->getRol(),
        ]);
        return (int) $pdo->lastInsertId();
    }

    public function update(object $entitat): void
    {
        $usuari = $this->comprovarUsuari($entitat);
        if ($usuari->getId() === null) {
            throw new InvalidArgumentException('No es pot actualitzar sense id.');
        }
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('UPDATE usuaris SET usuari = :usuari, rol = :rol WHERE id = :id');
        $stmt->execute([
            'usuari' => $usuari->getUsuari(),
            'rol'    => $usuari->getRol(),
            'id'     => $usuari->getId(),
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = $this->connexio->getPDO();
        $stmt = $pdo->prepare('DELETE FROM usuaris WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function comprovarUsuari(object $entitat): Usuari
    {
        if (!$entitat instanceof Usuari) {
            throw new InvalidArgumentException('UsuariDAO només accepta objectes Usuari.');
        }
        return $entitat;
    }
}
