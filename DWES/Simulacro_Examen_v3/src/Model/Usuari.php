<?php

namespace App\Model;

class Usuari
{
    public function __construct(
        private string $usuari = '',
        private string $contrasenya = '',
        private string $rol = 'instructor',
        private ?int $id = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getUsuari(): string { return $this->usuari; }
    public function getContrasenya(): string { return $this->contrasenya; }
    public function getRol(): string { return $this->rol; }
}
