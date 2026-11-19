CREATE DATABASE IF NOT EXISTS autotaller_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE autotaller_db;

DROP TABLE IF EXISTS recanvis;
DROP TABLE IF EXISTS reparacions;
DROP TABLE IF EXISTS vehicles;
DROP TABLE IF EXISTS usuaris;

CREATE TABLE usuaris (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuari VARCHAR(50) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    rol ENUM('mecanic','administrador') NOT NULL DEFAULT 'mecanic',
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuari (usuari)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE vehicles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    matricula VARCHAR(15) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    nom_propietari VARCHAR(100) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    any_fabricacio INT UNSIGNED NOT NULL,
    data_alta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_matricula (matricula)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Taula de reparacions (relació 1:N d'exemple ja implementada com a referència)
CREATE TABLE reparacions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    vehicle_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    descripcio VARCHAR(150) NOT NULL,
    hores_feina DECIMAL(4,2) NOT NULL DEFAULT 1.00,
    cost_hora DECIMAL(6,2) NOT NULL DEFAULT 45.00,
    data_reparacio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE recanvis (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    vehicle_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    nom_peca VARCHAR(100) NOT NULL,
    preu_unitari DECIMAL(6,2) NOT NULL,
    quantitat INT UNSIGNED NOT NULL DEFAULT 1,
    data_alta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- TASCA D'EXAMEN (Punt 1):
-- Defineix ací davall la taula `recanvis` i afegeix 3 registres de prova.
-- =========================================================================

INSERT INTO usuaris (usuari, contrasenya, rol) VALUES
('admin', '$2y$10$Nwe8u5q.ZejglD3hi44yc.AovFx04x5iLazgPmKF45zArpi42eWjG', 'administrador'),
('pep', '$2y$10$2.Hmbun4E7ewAnB7HZz0jO0U.QEyiRezOTQYbiYTQQtLXegtHBHta', 'mecanic'),
('voro', '$2y$10$2.Hmbun4E7ewAnB7HZz0jO0U.QEyiRezOTQYbiYTQQtLXegtHBHta', 'mecanic');

INSERT INTO vehicles (matricula, marca, model, nom_propietari, telefon, any_fabricacio) VALUES
('1234-KMT', 'Seat', 'Ibiza 1.4 TDI', 'Antoni Vidal', '611223344', 2018),
('5678-LXB', 'Toyota', 'Yaris Hybrid', 'Mireia Roig', '622334455', 2021),
('9012-GHT', 'Volkswagen', 'Golf VII', 'Joan Bernat', '633445566', 2015);

INSERT INTO reparacions (vehicle_id, usuari_id, descripcio, hores_feina, cost_hora) VALUES
(1, 2, 'Canvi d\'oli sintètic i filtre', 1.5, 45.00),
(1, 3, 'Canvi de pastilles de fre davanteres', 2.0, 48.00),
(2, 2, 'Diagnosi d\'injecció i neteja injectors', 1.0, 50.00);


INSERT INTO recanvis (vehicle_id, usuari_id, nom_peca, preu_unitari, quantitat) VALUES 
(1, 2, 'Oli sintetic', 25.00, 1),
(2, 3, 'Pastilles de freno', 60.00, 2),
(3, 2, 'Filtre de gasoil', 30.00, 1);