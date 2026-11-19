<?php

namespace App\Model;

class Recanvi
{
    public function __construct(
        private ?int $id = null,
        private ?int $vehicle_id = null,
        private ?int $usuari_id = null,
        private ?string $nom_peca = null,
        private ?float $preu_unitari = null,
        private ?int $quantitat = null,
        private ?string $data_alta = null,
        private ?string $nom_mecanic = null
    ) {
    }

    public function getImportTotal(): float
    {
        return round($this->getPreuUnitari() * $this->quantitat, 2);
    }
    public function enGarantia(): bool
    {
        if (empty($this->data_alta)) {
            return true;
        }
        return $this->data_alta >= date('Y-m-d', strtotime('-2 years'));
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicleId(): ?int
    {
        return $this->vehicle_id;
    }

    public function getUsuariId(): ?int
    {
        return $this->usuari_id;
    }

    public function getNomPeca(): ?string
    {
        return $this->nom_peca;
    }

    public function getPreuUnitari(): ?int
    {
        return $this->preu_unitari;
    }

    public function getQuantitat(): ?int
    {
        return $this->quantitat;
    }

    public function getDataAlta(): ?string
    {
        return $this->data_alta;
    }

















}