<?php

namespace App\Model;

class Nota 
{
    public function __construct(
        private int $lead_id = 0,
        private int $usuari_id = 0,
        private string $text = '',
        private ?int $id = null,
        private ?string $data_creacio = null,
        private ?string $nom_usuari = null
    ) {}



    public function getId(): ?int
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

    public function getText(): string
    {
        return $this->text;
    }

    public function getDataCreacio(): ?string
    {
        return $this->data_creacio;
    }

    public function getNomUsuari(): ?string
    {
        return $this->nom_usuari;
    }

    public function setNomUsuari(?string $nom): void
    {
        $this->nom_usuari = $nom;
    }




}