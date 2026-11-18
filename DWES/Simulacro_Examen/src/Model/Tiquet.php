<?php

namespace App\Model;

class Tiquet
{
    public const PRIORITAT_BAIXA = 'baixa';
    public const PRIORITAT_MITJANA = 'mitjana';
    public const PRIORITAT_ALTA = 'alta';
    public const PRIORITAT_CRITICA = 'critica';

    public const ESTAT_OBERT = 'obert';
    public const ESTAT_EN_PROCES = 'en_proces';
    public const ESTAT_RESOLT = 'resolt';

    public function __construct(
        private string $codi = '',
        private string $titol = '',
        private string $descripcio = '',
        private string $client_nom = '',
        private string $client_email = '',
        private string $prioritat = self::PRIORITAT_MITJANA,
        private string $estat = self::ESTAT_OBERT,
        private ?string $data_creacio = null,
        private ?int $id = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodi(): string
    {
        return $this->codi;
    }

    public function getTitol(): string
    {
        return $this->titol;
    }

    public function getDescripcio(): string
    {
        return $this->descripcio;
    }

    public function getClientNom(): string
    {
        return $this->client_nom;
    }

    public function getClientEmail(): string
    {
        return $this->client_email;
    }

    public function getPrioritat(): string
    {
        return $this->prioritat;
    }

    public function getEstat(): string
    {
        return $this->estat;
    }

    public function getDataCreacio(): ?string
    {
        return $this->data_creacio;
    }

    public function getBadgePrioritat(): string
    {
        return match ($this->prioritat) {
            self::PRIORITAT_BAIXA => 'badge-success',
            self::PRIORITAT_MITJANA => 'badge-info',
            self::PRIORITAT_ALTA => 'badge-warning',
            self::PRIORITAT_CRITICA => 'badge-danger',
            default => 'badge-secondary',
        };
    }

    public function getBadgeEstat(): string
    {
        return match ($this->estat) {
            self::ESTAT_OBERT => 'badge-primary',
            self::ESTAT_EN_PROCES => 'badge-warning',
            self::ESTAT_RESOLT => 'badge-success',
            default => 'badge-secondary',
        };
    }
}
