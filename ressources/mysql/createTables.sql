CREATE TABLE Client (
                        id_client INT PRIMARY KEY AUTO_INCREMENT,
                        nom VARCHAR(100) NOT NULL,
                        email VARCHAR(100) NOT NULL,
                        telephone VARCHAR(15),
                        adresse TEXT
);

CREATE TABLE Photographe (
                             id_photographe INT PRIMARY KEY AUTO_INCREMENT,
                             nom VARCHAR(100),
                             specialite VARCHAR(100),
                             email VARCHAR(100),
                             telephone VARCHAR(15)
);

CREATE TABLE Seance (
                        id_seance INT PRIMARY KEY AUTO_INCREMENT,
                        date_seance DATE,
                        heure TIME,
                        lieu VARCHAR(255),
                        id_client INT,
                        id_photographe INT,
                        FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
                        FOREIGN KEY (id_photographe) REFERENCES Photographe(id_photographe) ON DELETE CASCADE
);

CREATE TABLE Photo (
                       id_photo INT PRIMARY KEY AUTO_INCREMENT,
                       chemin_fichier VARCHAR(255),
                       resolution VARCHAR(50),
                       format VARCHAR(10),
                       id_seance INT,
                       FOREIGN KEY (id_seance) REFERENCES Seance(id_seance) ON DELETE CASCADE
);

CREATE TABLE Transaction (
                             id_transaction INT PRIMARY KEY AUTO_INCREMENT,
                             montant DECIMAL(10, 2),
                             date_transaction DATE,
                             type_transaction ENUM('facture', 'paiement'),
                             id_seance INT,
                             FOREIGN KEY (id_seance) REFERENCES Seance(id_seance) ON DELETE CASCADE
);

CREATE TABLE Utilisateurs (
                              id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
                              email VARCHAR(255) NOT NULL UNIQUE,
                              mot_de_passe VARCHAR(255) NOT NULL,
                              role VARCHAR(100) NOT NULL DEFAULT("client")
);

CREATE TABLE Effectue (
                          id_photographe INT,
                          id_seance INT,
                          PRIMARY KEY (id_photographe,id_seance),
                          FOREIGN KEY (id_photographe) REFERENCES Photographe(id_photographe) ON DELETE CASCADE,
                          FOREIGN KEY (id_seance) REFERENCES Seance(id_seance) ON DELETE CASCADE
);
