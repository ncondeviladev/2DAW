<?php

namespace App\Model;

class Client
{
    public function __construct(
        private string $nom = '',
        private string $cognoms = '',
        private string $email = '',
        private string $telefon = '',
        private string $data_naixement = '',
        private string $nivell = 'principiant',
        private ?string $data_alta = null,
        private ?int $id = null
    ) {
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getCognoms(): string { return $this->cognoms; }
    public function getNomComplet(): string { return $this->nom . ' ' . $this->cognoms; }
    public function getEmail(): string { return $this->email; }
    public function getTelefon(): string { return $this->telefon; }
    public function getDataNaixement(): string { return $this->data_naixement; }
    public function getNivell(): string { return $this->nivell; }
    public function getDataAlta(): ?string { return $this->data_alta; }

    public function getBadgeNivell(): string
    {
        return match($this->nivell) {
            'principiant' => 'bg-green-50 text-green-700 border-green-200',
            'intermedi'   => 'bg-blue-50 text-blue-700 border-blue-200',
            'avançat'     => 'bg-purple-50 text-purple-700 border-purple-200',
            default       => 'bg-slate-50 text-slate-700 border-slate-200',
        };
    }

    public function getEdatAprox(): string
    {
        $naixement = new \DateTime($this->data_naixement);
        $avui = new \DateTime();
        return $avui->diff($naixement)->y . ' anys';
    }
}
