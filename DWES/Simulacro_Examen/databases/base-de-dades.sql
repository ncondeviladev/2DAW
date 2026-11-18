CREATE DATABASE IF NOT EXISTS helpdesk_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE helpdesk_db;

DROP TABLE IF EXISTS intervencions;
DROP TABLE IF EXISTS tiquets;
DROP TABLE IF EXISTS usuaris;

-- Taula d'usuaris del sistema
CREATE TABLE usuaris (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuari VARCHAR(50) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    rol ENUM('tecnic','administrador') NOT NULL DEFAULT 'tecnic',
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuari (usuari)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Taula principal de tiquets d'incidència
CREATE TABLE tiquets (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    codi VARCHAR(20) NOT NULL UNIQUE,
    titol VARCHAR(150) NOT NULL,
    descripcio TEXT NOT NULL,
    client_nom VARCHAR(100) NOT NULL,
    client_email VARCHAR(150) NOT NULL,
    prioritat ENUM('baixa','mitjana','alta','critica') NOT NULL DEFAULT 'mitjana',
    estat ENUM('obert','en_proces','resolt') NOT NULL DEFAULT 'obert',
    data_creacio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dades inicials d'usuaris
INSERT INTO usuaris (usuari, contrasenya, rol) VALUES
('admin', '$2y$10$eA8b3F6/yM0G7e.yW.R21e7d2qQfH/jK.v0xM7M1l.d6s2Y3gQ3g2', 'administrador'),
('pau', '$2y$10$vM6r5b7l1y0p3q8s9t0u1.3w5x7y9z0a1b2c3d4e5f6g7h8i9j0k1', 'tecnic'),
('marta', '$2y$10$vM6r5b7l1y0p3q8s9t0u1.3w5x7y9z0a1b2c3d4e5f6g7h8i9j0k1', 'tecnic');

-- Dades inicials de tiquets
INSERT INTO tiquets (codi, titol, descripcio, client_nom, client_email, prioritat, estat) VALUES
('TIQ-2026-001', 'Error 500 al carret de la compra', 'Els usuaris no poden finalitzar la comanda quan paguen amb targeta.', 'Botiga Online SL', 'soporte@botigaonline.com', 'critica', 'en_proces'),
('TIQ-2026-002', 'Configuració correu corporatiu en Outlook', 'La nova empleada de recepció necessita el compte configurat al seu portàtil.', 'Assessoria Marítima', 'info@assessoriamaritima.es', 'baixa', 'obert'),
('TIQ-2026-003', 'Rendiment lent a la base de dades interna', 'Les consultes de facturació tarden més de 30 segons en respondre des d\'ahir.', 'Logística Gandia', 'it@logisticagandia.com', 'alta', 'obert');

CREATE TABLE intervencions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tiquet_id INT UNSIGNED NOT NULL,
    usuari_id INT UNSIGNED NOT NULL,
    minuts INT UNSIGNED NOT NULL,
    comentari TEXT NOT NULL,
    data_intervencio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id),
    FOREIGN KEY (tiquet_id) REFERENCES tiquets(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO intervencions (tiquet_id, usuari_id, minuts, comentari) VALUES 
(1, 1, 45, 'Investigació inicial logs d\'Apache i base de dades'),
(1, 2, 75, 'Correcció bug en passarel·la de pagament Redsys'),
(2, 2, 20, 'Configuració compte IMAP i verificació enviament');
