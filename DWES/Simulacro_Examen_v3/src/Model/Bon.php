<?php

namespace App\Model;

class Bon
{
    public function __construct(
        private ?int $id = null,
        private ?int $client_id = null,
        private ?int $usuari_id = null,
        private ?string $tipus_bon = null,
        private ?float $preu = null,
        private ?string $data_inici = null,
        private ?string $data_fi = null,
        private ?string $nom_instructor = null
    ) {
    }


    public function estaActiu(): bool
    {
        if ($this->getDataFi() === null || $this->getDataFi() >= date('Y-m-d')) {
            return true;
        } else
            return false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getClientId(): ?int
    {
        return $this->client_id;
    }
    public function getUsuariId(): ?int
    {
        return $this->usuari_id;
    }
    public function getTipusBon(): ?string
    {
        return $this->tipus_bon;
    }
    public function getPreu(): ?float
    {
        return $this->preu;
    }
    public function getDataInici(): ?string
    {
        return $this->data_inici;
    }
    public function getDataFi(): ?string
    {
        return $this->data_fi;
    }
    public function getNomInstructor(): ?string
    {
        return $this->nom_instructor;
    }






}