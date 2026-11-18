<?php

namespace App\Model;

class Usuari
{
    public const ROL_VETERINARI = 'veterinari';
    public const ROL_ADMINISTRADOR = 'administrador';

    public function __construct(
        private string $usuari = '',
        private string $contrasenya = '',
        private string $rol = self::ROL_VETERINARI,
        private ?int $id = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuari(): string
    {
        return $this->usuari;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function getContrasenyaHash(): string
    {
        return $this->contrasenya;
    }

    public function esAdmin(): bool
    {
        return $this->rol === self::ROL_ADMINISTRADOR;
    }

    public function verificarContrasenya(string $contrasenya): bool
    {
        return password_verify($contrasenya, $this->contrasenya);
    }
}
