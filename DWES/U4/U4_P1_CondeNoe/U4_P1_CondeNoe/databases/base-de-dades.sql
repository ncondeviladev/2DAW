CREATE TABLE leads (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefon VARCHAR(20) NULL,
    empresa VARCHAR(100) NULL,
    serveis JSON NOT NULL,
    pressupost DECIMAL(10,2) NOT NULL,
    missatge TEXT NULL,
    document VARCHAR(255) NULL,
    estat ENUM('nou','contactat','tancat') NOT NULL DEFAULT 'nou',
    data_creacio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE usuaris (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuari VARCHAR(50) NOT NULL,
    contrasenya VARCHAR(255) NOT NULL,
    rol ENUM('comercial','administrador') NOT NULL DEFAULT 'comercial',
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuari (usuari)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuaris (usuari, contrasenya, rol) VALUES
('ana',  '$2y$10$jtyC89SwKBSRwUpjO.3Ot.Rql4v6QY05kZR7SFrkVLUyWHLNVnZK6', 'comercial'),
('marc', '$2y$10$74Dle4/UJiucMgWk8l4bMuOEhYAzKPGxIrGcDAkOmqivk5ocTez6C', 'administrador');

INSERT INTO leads (nom, email, telefon, empresa, serveis, pressupost, missatge, estat) VALUES
('Aina Soler',    'aina@textils.exemple',  '600123456', 'Tèxtils S.L.',   '["Web","SEO"]',    4500.00,  'Volem renovar la web corporativa.', 'nou'),
('Marc Climent',  'marc@econova.exemple',  NULL,        'Econova',        '["App mòbil"]',    800.00,   NULL,                                'contactat'),
('Laura Sanchis', 'laura@innovacio.exemple', '611987654', 'Innovació Tech', '["Cloud","Web"]', 12000.00, 'Necessitem migrar a la núvol.',     'tancat');