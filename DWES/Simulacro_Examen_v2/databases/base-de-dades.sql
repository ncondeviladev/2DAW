CREATE DATABASE IF NOT EXISTS vetclinic_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE vetclinic_db;

DROP TABLE IF EXISTS vacunes;
DROP TABLE IF EXISTS visites;
DROP TABLE IF EXISTS pacients;
DROP TABLE IF EXISTS usuaris;

-- Taula d'usuaris (veterinaris i administració)
CREATE TABLE usuaris (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuari VARCHAR(50) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    rol ENUM('veterinari','administrador') NOT NULL DEFAULT 'veterinari',
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuari (usuari)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Taula principal de pacients (mascotes)
CREATE TABLE pacients (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(60) NOT NULL,
    especie ENUM('gos','gat','au','rosegador','altre') NOT NULL DEFAULT 'gos',
    raca VARCHAR(80) NOT NULL,
    nom_propietari VARCHAR(100) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    data_naixement DATE NOT NULL,
    microxip VARCHAR(30) NULL UNIQUE,
    data_alta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Taula de visites clíniques (relació 1:N que JA està implementada com a exemple de referència)
CREATE TABLE visites (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pacient_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    motiu VARCHAR(150) NOT NULL,
    diagnostic TEXT NOT NULL,
    data_visita TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (pacient_id) REFERENCES pacients(id) ON DELETE CASCADE,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE vacunes (
    id INT UNSIGNED AUTO_INCREMENT,
    pacient_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    nom_vacuna VARCHAR(100) NOT NULL,
    preu DECIMAL(6, 2) NOT NULL,
    proxima_dosi DATE NULL,
    data_administracio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pacient_id) REFERENCES pacients(id) ON DELETE CASCADE,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id),
    PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuaris de prova:
-- admin -> admin123
-- laura -> vet123
-- sergi -> vet123
INSERT INTO usuaris (usuari, contrasenya, rol) VALUES
('admin', '$2y$10$eA8b3F6/yM0G7e.yW.R21e7d2qQfH/jK.v0xM7M1l.d6s2Y3gQ3g2', 'administrador'),
('laura', '$2y$10$vM6r5b7l1y0p3q8s9t0u1.3w5x7y9z0a1b2c3d4e5f6g7h8i9j0k1', 'veterinari'),
('sergi', '$2y$10$vM6r5b7l1y0p3q8s9t0u1.3w5x7y9z0a1b2c3d4e5f6g7h8i9j0k1', 'veterinari');

-- Pacients inicials
INSERT INTO pacients (nom, especie, raca, nom_propietari, telefon, data_naixement, microxip) VALUES
('Thor', 'gos', 'Golden Retriever', 'Carles Martí', '654987321', '2021-04-15', '981098123456789'),
('Lluna', 'gat', 'Siamés', 'Elena Benavent', '611223344', '2023-01-10', '981098987654321'),
('Nemo', 'au', 'Periquito australià', 'Marc Fuster', '699887766', '2024-06-01', NULL);

-- Visites inicials d'exemple
INSERT INTO visites (pacient_id, usuari_id, motiu, diagnostic) VALUES
(1, 2, 'Revisió anual i desparasitació', 'Estat general excel·lent. S\'administra pipeta antiparasitària externa.'),
(1, 3, 'Coixesa pota posterior dreta', 'Lleugera inflamació articular. Es recepta antiinflamatori durant 5 dies.'),
(2, 2, 'Problemes respiratoris lleus', 'Refredat comú de vies altes. Evolució favorable sense medicació.');

-- =========================================================================
-- TASCA D'EXAMEN (Punt 1):
-- Defineix ací davall la taula `vacunes` i afegeix 3 registres de prova.
-- =========================================================================
INSERT INTO vacunes (pacient_id, usuari_id, nom_vacuna, preu, proxima_dosi, data_administracio) VALUES
(1, 1, "rabia", 25, "2026-12-17", "2025-12-17"),
(2, 3, "pol", 30, "2025-01-15", "2024-01-15"),
(3, 2, "peste", 35, "2025-02-15", "2024-02-15");
