-- Table Client
CREATE TABLE client (
    numcli INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    adresse VARCHAR(255),
    telephone VARCHAR(20)
);

-- Table Categorie
CREATE TABLE categorie (
    code VARCHAR(50) PRIMARY KEY,
    libelle VARCHAR(255),
    UNIQUE (code)
);
-- Insertion de catégorie par défaut
INSERT INTO `categorie` (`code`, `libelle`) VALUES ('CAT1', 'Categorie 1');
INSERT INTO `categorie` (`code`, `libelle`) VALUES ('CAT2', 'Categorie 2');
INSERT INTO `categorie` (`code`, `libelle`) VALUES ('CAT3', 'Categorie 3');



-- Table Produit
CREATE TABLE produit (
    ref VARCHAR(50) PRIMARY KEY,
    design VARCHAR(255),
    pu DECIMAL(10,2),
    imageprod VARCHAR(255),
    UNIQUE (ref),
    code VARCHAR(50),
    FOREIGN KEY (code) REFERENCES categorie(code)
);

-- Insertion des produit par défaut
INSERT INTO `produit` (`ref`, `design`, `pu`, `imageprod`, `code`) VALUES ('BI', 'BIC', '100', NULL, NULL);
INSERT INTO `produit` (`ref`, `design`, `pu`, `imageprod`, `code`) VALUES ('CA100', 'Cahier de 100 pages', '150', NULL, NULL);

-- Table Commande
CREATE TABLE commande (
    numcmd INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    etat VARCHAR(50),
    qte INT,
    numcli INT,
    ref VARCHAR(50),
    FOREIGN KEY (numcli) REFERENCES client(numcli),
    FOREIGN KEY (ref) REFERENCES produit(ref)
);

-- Table Utilisateur
CREATE TABLE utilisateur (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    mdp VARCHAR(255),
    profil VARCHAR(50)
);


-- Insertion de l'utilisateur administrateur
INSERT INTO utilisateur (email, mdp, profil) VALUES ('admin@gmail.com', '12345678', 'Admin');

-- Insertion de l'utilisateur client
INSERT INTO utilisateur (email, mdp, profil) VALUES ('user@gmail.com', '12345678', 'Client');
