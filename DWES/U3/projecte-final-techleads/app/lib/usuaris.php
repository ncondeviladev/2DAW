<?php

declare(strict_types=1);

/**
 * Llista de usuaris
 */


$usuaris = [
    'ana' => [
        'nom' => 'Ana Garcia',
        'hash' => password_hash('1234', PASSWORD_DEFAULT),
    ],
    'marc' => [
        'nom' => 'Marc Torres',
        'hash' => password_hash('1234', PASSWORD_DEFAULT),
    ],
];
//Retornem usuaris per a que al cridar al archiu amb require, $usuaris estiga com a variable
return $usuaris;
    