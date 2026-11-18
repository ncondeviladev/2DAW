<?php

namespace App\DAO;

interface IDbAccess
{
    public function insert(object $entitat): int;
    public function findAll(): array;
    public function findById(int $id): ?object;
    public function update(object $entitat): void;
    public function delete(int $id): void;
}
