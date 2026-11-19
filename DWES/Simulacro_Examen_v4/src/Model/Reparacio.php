<?php

namespace App\Model;

class Reparacio
{
    public function __construct(
        private ?int $vehicle_id = null,
        private ?int $usuari_id = null,
        private string $descripcio = '',
        private float $hores_feina = 1.0,
        private float $cost_hora = 45.0,
        private ?string $data_reparacio = null,
        private ?int $id = null,
        private ?string $nom_mecanic = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getVehicleId(): ?int { return $this->vehicle_id; }
    public function getUsuariId(): ?int { return $this->usuari_id; }
    public function getDescripcio(): string { return $this->descripcio; }
    public function getHoresFeina(): float { return (float) $this->hores_feina; }
    public function getCostHora(): float { return (float) $this->cost_hora; }
    public function getCostTotal(): float { return round($this->hores_feina * $this->cost_hora, 2); }
    public function getDataReparacio(): ?string { return $this->data_reparacio; }
    public function getNomMecanic(): ?string { return $this->nom_mecanic; }
}
