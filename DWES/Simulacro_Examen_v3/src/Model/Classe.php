<?php

namespace App\Model;

class Classe
{
    public function __construct(
        private ?int $client_id = null,
        private ?int $usuari_id = null,
        private string $activitat = '',
        private int $durada_minuts = 60,
        private string $observacions = '',
        private ?string $data_classe = null,
        private ?int $id = null,
        private ?string $nom_instructor = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getClientId(): ?int { return $this->client_id; }
    public function getUsuariId(): ?int { return $this->usuari_id; }
    public function getActivitat(): string { return $this->activitat; }
    public function getDuradaMinuts(): int { return $this->durada_minuts; }
    public function getObservacions(): string { return $this->observacions; }
    public function getDataClasse(): ?string { return $this->data_classe; }
    public function getNomInstructor(): ?string { return $this->nom_instructor; }
}
