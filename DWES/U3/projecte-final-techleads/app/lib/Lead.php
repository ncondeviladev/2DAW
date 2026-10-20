<?php

declare(strict_types=1); //Fuerza comportamiento estricto sin conversion de valores
/**
 * Clase Lead
 * Representa contacte comercial generat per el formulari.
 * Emmagatzema les dades de contacte, peticions i gestiona el flux d'estats del lead 
 */

class Lead
{
    public const ESTAT_NOU = 'nou';
    public const ESTAT_CONTACTAT = 'contactat';
    public const ESTAT_TANCAT = 'tancat';

    private string $estat;

    public function __construct(
        private int $id,
        private string $nom,
        private string $email,
        private array $serveis,
        private float $pressupost,
        private string $missatge,
        private ?string $empresa = null,
        private ?string $telefon = null,
        private ?string $document = null,
        string $estatInicial = self::ESTAT_NOU

    ) {
        $this->estat = $estatInicial;
    }


    //--- GETTERS ---
    public function getEstat(): string
    {
        return $this->estat;
    }
    public function getId(): int
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
    public function getTelefon(): ?string
    {
        return $this->telefon;
    }
    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }
    public function getServeis(): array
    {
        return $this->serveis;
    }
    public function getPressupost(): float
    {
        return $this->pressupost;
    }
    public function getMissatge(): string
    {
        return $this->missatge;
    }
    public function getDocument(): ?string
    {
        return $this->document;
    }

    //--- FUNCIONS ---


    /**
     * Cambia el estat al seguent menys si ja esta tancat
     * @return void
     */
    public function avancarEstat(): void
    {
        if ($this->estat === self::ESTAT_NOU) {
            $this->estat = self::ESTAT_CONTACTAT;
        } elseif ($this->estat === self::ESTAT_CONTACTAT) {
            $this->estat = self::ESTAT_TANCAT;
        }
    }
}