<?php

namespace App\DAO;

/**
 * Contracte d'accés a dades per a qualsevol entitat del model.
 *
 * @template T of object
 */
interface IDbAccess
{
    /**
     * Retorna totes les entitats.
     *
     * @return T[]
     */
    public function findAll(): array;

    /**
     * Retorna l'entitat amb l'id indicat, o null si no existeix.
     *
     * @return T|null
     */
    public function findById(int $id): ?object;

    /**
     * Guarda una entitat nova i retorna l'id que li ha assignat la base de dades.
     *
     * @param T $entitat
     */
    public function insert(object $entitat): int;

    /**
     * Actualitza una entitat existent (identificada pel seu id).
     *
     * @param T $entitat
     */
    public function update(object $entitat): void;

    /**
     * Elimina l'entitat amb l'id indicat.
     */
    public function delete(int $id): void;
}