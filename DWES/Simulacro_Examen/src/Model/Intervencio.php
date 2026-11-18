<?php

namespace App\Model;

class Intervencio
{

    public function __construct(
        private ?int $tiquet_id = null,
        private ?int $usuari_id = null,
        private ?int $minuts = null,
        private ?string $comentari = null,
        private ?int $id = null,
        private ?string $data_intervencio = null,
        private ?string $nom_usuari = null
    ) {
    }

    public function esSignificativa(): bool
    {
        if ($this->getMinuts() >= 60) {
            return true;
        } else
            return false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTiquetId(): ?int
    {
        return $this->tiquet_id;
    }
    public function getUsuariId(): ?int
    {
        return $this->usuari_id;
    }
    public function getMinuts(): ?int
    {
        return $this->minuts;
    }
    public function getComentari(): ?string
    {
        return $this->comentari;
    }
    public function getDataIntervencio(): ?string
    {
        return $this->data_intervencio;
    }
    public function getNomUsuari(): ?string
    {
        return $this->nom_usuari;
    }



}