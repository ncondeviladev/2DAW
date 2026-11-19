<?php

namespace App\Model;

class Vehicle
{
    public function __construct(
        private string $matricula = '',
        private string $marca = '',
        private string $model = '',
        private string $nom_propietari = '',
        private string $telefon = '',
        private int $any_fabricacio = 2020,
        private ?string $data_alta = null,
        private ?int $id = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getMatricula(): string { return $this->matricula; }
    public function getMarca(): string { return $this->marca; }
    public function getModel(): string { return $this->model; }
    public function getVehicleComplet(): string { return $this->marca . ' ' . $this->model . ' (' . $this->matricula . ')'; }
    public function getNomPropietari(): string { return $this->nom_propietari; }
    public function getTelefon(): string { return $this->telefon; }
    public function getAnyFabricacio(): int { return $this->any_fabricacio; }
    public function getDataAlta(): ?string { return $this->data_alta; }

    public function getAntiguitat(): string
    {
        $antiguitat = (int) date('Y') - $this->any_fabricacio;
        return $antiguitat . ' anys';
    }
}
