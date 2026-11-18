CREATE DATABASE IF NOT EXISTS fitlife_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE fitlife_db;

DROP TABLE IF EXISTS bons;

DROP TABLE IF EXISTS classes;

DROP TABLE IF EXISTS clients;

DROP TABLE IF EXISTS usuaris;

CREATE TABLE usuaris (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuari VARCHAR(50) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    rol ENUM('instructor', 'administrador') NOT NULL DEFAULT 'instructor',
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuari (usuari)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE clients (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(60) NOT NULL,
    cognoms VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    data_naixement DATE NOT NULL,
    nivell ENUM(
        'principiant',
        'intermedi',
        'avançat'
    ) NOT NULL DEFAULT 'principiant',
    data_alta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_email (email)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Taula de classes (relació 1:N ja implementada com a exemple de referència)
CREATE TABLE classes (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    client_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    activitat VARCHAR(100) NOT NULL,
    durada_minuts INT UNSIGNED NOT NULL DEFAULT 60,
    observacions TEXT NOT NULL,
    data_classe TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE,
    FOREIGN KEY (usuari_id) REFERENCES usuaris (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE bons (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    client_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    tipus_bon VARCHAR(80) NOT NULL,
    preu DECIMAL(6, 2) NOT NULL,
    data_inici DATE NOT NULL,
    data_fi DATE NULL,
    data_alta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE,
    FOREIGN KEY (usuari_id) REFERENCES usuaris (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- =========================================================================
-- TASCA D'EXAMEN (Punt 1):
-- Defineix ací davall la taula `bons` i afegeix 3 registres de prova.
-- =========================================================================

INSERT INTO
    usuaris (usuari, contrasenya, rol)
VALUES (
        'admin',
        '$2y$10$lb3XDsS6LqDxaQfRrQ8cXuZvpZT0AT/JPx1NPjnEoVh9Oo7WYFNwm',
        'administrador'
    ),
    (
        'marina',
        '$2y$10$1h.9vM9JfDXbt5IBCTd6OO6XWUah7BNYZX70o/hI6FLqHLG5jPzRW',
        'instructor'
    ),
    (
        'jordi',
        '$2y$10$1h.9vM9JfDXbt5IBCTd6OO6XWUah7BNYZX70o/hI6FLqHLG5jPzRW',
        'instructor'
    );

INSERT INTO
    clients (
        nom,
        cognoms,
        email,
        telefon,
        data_naixement,
        nivell
    )
VALUES (
        'Carla',
        'Puig Ros',
        'carla.puig@email.com',
        '654111222',
        '1990-03-22',
        'intermedi'
    ),
    (
        'Marc',
        'Ferrer Vila',
        'marc.ferrer@email.com',
        '612334455',
        '1985-07-10',
        'avançat'
    ),
    (
        'Laia',
        'Gomez Serra',
        'laia.gomez@email.com',
        '699556677',
        '1998-11-05',
        'principiant'
    );

INSERT INTO
    classes (
        client_id,
        usuari_id,
        activitat,
        durada_minuts,
        observacions
    )
VALUES (
        1,
        2,
        'Ioga Relaxant',
        60,
        'Excel·lent postura. Millora notable en la respiració.'
    ),
    (
        1,
        3,
        'CrossFit Avançat',
        45,
        'Alta intensitat. Supera bé els circuits.'
    ),
    (
        2,
        2,
        'Pilates Core',
        50,
        'Treball profund de la zona lumbar. Progressió molt bona.'
    );

INSERT INTO
    bons (
        client_id,
        usuari_id,
        tipus_bon,
        preu,
        data_inici,
        data_fi
    )
VALUES (
        1,
        2,
        'Pla 3 Mesos',
        120,
        '2024-01-01',
        '2024-03-31'
    ),
    (
        1,
        2,
        'Pla 3 Mesos',
        120,
        '2024-01-01',
        '2024-03-31'
    ),
    (
        1,
        2,
        'Pla 3 Mesos',
        120,
        '2024-01-01',
        '2024-03-31'
    );