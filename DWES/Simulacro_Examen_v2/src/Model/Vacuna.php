<?php

namespace App\Model;

use DateTime;

class Vacuna
{
    public function __construct(
        private ?string $pacient_id = '',
        private ?string $usuari_id = '',
        private ?string $nom_vacuna = '',
        private ?string $preu = '',
        private ?string $proxima_dosi = '',
        private ?string $data_administracio = '',
        private ?int $id = null,
        private ?string $nom_veterinari = null
    ) {
    }


    public function requereixRecordatori(): bool
    {
        if (empty($this->proxima_dosi)) {
            return false;
        }
        return $this->proxima_dosi <= date('Y-m-d', strtotime('+15 days'));
        /*
        $dataProxDosi = new DateTime($this->proxima_dosi);
        $ara = new DateTime();
        $dataDiff = $ara->diff($dataProxDosi);

        if ($this->getProximaDosi() !== null && $dataDiff <= 15) {
            return true;
        } else
            return false;
 */
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPacientId(): ?string
    {
        return $this->pacient_id;
    }
    public function getUsuariId(): ?string
    {
        return $this->usuari_id;
    }
    public function getNomVacuna(): ?string
    {
        return $this->nom_vacuna;
    }

    public function getPreu(): ?string
    {
        return $this->preu;
    }
    public function getProximaDosi(): ?string
    {
        return $this->proxima_dosi;
    }
    public function getDataAdministracio(): ?string
    {
        return $this->data_administracio;
    }
    public function getNomVeterinari(): ?string
    {
        return $this->nom_veterinari;
    }

}