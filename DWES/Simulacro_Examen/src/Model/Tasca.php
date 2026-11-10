<?php

namespace App\Model;

class Tasca
{
    public function __construct(
        private int $lead_id = 0,
        private int $usuari_id = 0,
        private string $descripcio = '',
        private ?string $data_limit = null,
        private ?string $data_creacio = null,
        private int $completada = 0,
        private ?int $id = null,
        private ?string $nom_usuari = '',
    ) {
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getLeadId(): int
    {
        return $this->lead_id;
    }

    public function getUsuariId(): int
    {
        return $this->usuari_id;
    }

    public function getDescripcio(): string
    {
        return $this->descripcio;
    }

    public function getDataLimit(): ?string
    {
        return $this->data_limit;
    }

    public function getDataCreacio(): ?string
    {
        return $this->data_creacio;
    }

    public function getcompletadada(): int
    {
        return $this->completada;
    }
    public function getNomUsuari(): string
    {
        return $this->nom_usuari;
    }


    public function estaVencuda(): bool
    {
        if ($this->completada === 0 && $this->data_limit < date('Y-m-d')) {
            return true;
        }
        return false;
    }







}