<?php

namespace App\Model;

class Lead
{
    public const ESTAT_NOU = 'nou';
    public const ESTAT_CONTACTAT = 'contactat';
    public const ESTAT_TANCAT = 'tancat';

    public const SERVEIS = ['Web', 'App mòbil', 'SEO', 'Cloud'];

    public function __construct(
        private string $nom = '',
        private string $email = '',
        private ?string $telefon = null,
        private ?string $empresa = null,
        private array|string $serveis = [],
        private float $pressupost = 0.0,
        private ?string $missatge = null,
        private ?string $document = null,
        private ?int $id = null,
        private string $estat = self::ESTAT_NOU
    ) {}


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function getServeis(): array
    {
        return is_string($this->serveis)
            ? (json_decode($this->serveis, true) ?? [])
            : $this->serveis;
    }

    public function toArray(): array
    {
        $dades = get_object_vars($this);
        $dades['serveis'] = json_encode($this->getServeis(), JSON_UNESCAPED_UNICODE);

        return $dades;
    }

    public function getPressupost(): float
    {
        return $this->pressupost;
    }

    public function getMissatge(): ?string
    {
        return $this->missatge;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function getEstat(): string
    {
        return $this->estat;
    }

    public function avancarEstat(): void
    {
        $this->estat = match ($this->estat) {
            self::ESTAT_NOU => self::ESTAT_CONTACTAT,
            self::ESTAT_CONTACTAT => self::ESTAT_TANCAT,
            default => self::ESTAT_TANCAT
        };
    }
}
