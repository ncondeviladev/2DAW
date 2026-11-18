<?php

namespace App\Model;

class Visita
{
    public function __construct(
        private ?int $pacient_id = null,
        private ?int $usuari_id = null,
        private ?string $motiu = null,
        private ?string $diagnostic = null,
        private ?string $data_visita = null,
        private ?int $id = null,
        private ?string $nom_veterinari = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPacientId(): ?int
    {
        return $this->pacient_id;
    }

    public function getUsuariId(): ?int
    {
        return $this->usuari_id;
    }

    public function getMotiu(): ?string
    {
        return $this->motiu;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function getDataVisita(): ?string
    {
        return $this->data_visita;
    }

    public function getNomVeterinari(): ?string
    {
        return $this->nom_veterinari;
    }
}
