<?php

namespace App\Model;

use DateTime;

class Pacient
{
    public const ESPECIE_GOS = 'gos';
    public const ESPECIE_GAT = 'gat';
    public const ESPECIE_AU = 'au';
    public const ESPECIE_ROSEGADOR = 'rosegador';
    public const ESPECIE_ALTRE = 'altre';

    public function __construct(
        private string $nom = '',
        private string $especie = self::ESPECIE_GOS,
        private string $raca = '',
        private string $nom_propietari = '',
        private string $telefon = '',
        private string $data_naixement = '',
        private ?string $microxip = null,
        private ?string $data_alta = null,
        private ?int $id = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEspecie(): string
    {
        return $this->especie;
    }

    public function getRaca(): string
    {
        return $this->raca;
    }

    public function getNomPropietari(): string
    {
        return $this->nom_propietari;
    }

    public function getTelefon(): string
    {
        return $this->telefon;
    }

    public function getDataNaixement(): string
    {
        return $this->data_naixement;
    }

    public function getMicroxip(): ?string
    {
        return $this->microxip;
    }

    public function getDataAlta(): ?string
    {
        return $this->data_alta;
    }

    public function getBadgeEspecie(): string
    {
        return match ($this->especie) {
            self::ESPECIE_GOS => 'bg-amber-100 text-amber-800 border-amber-200',
            self::ESPECIE_GAT => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::ESPECIE_AU  => 'bg-sky-100 text-sky-800 border-sky-200',
            default           => 'bg-slate-100 text-slate-800 border-slate-200',
        };
    }

    public function getEdatAprox(): string
    {
        if (empty($this->data_naixement)) {
            return 'Desconeguda';
        }
        $naix = new DateTime($this->data_naixement);
        $ara = new DateTime();
        $diff = $ara->diff($naix);

        if ($diff->y > 0) {
            return $diff->y . ' ' . ($diff->y === 1 ? 'any' : 'anys');
        }
        return $diff->m . ' ' . ($diff->m === 1 ? 'mes' : 'mesos');
    }
}
