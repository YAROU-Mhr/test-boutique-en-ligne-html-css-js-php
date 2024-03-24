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

-- Table Produit
CREATE TABLE produit (
    ref INT AUTO_INCREMENT PRIMARY KEY,
    design VARCHAR(255),
    pu DECIMAL(10,2),
    imageprod VARCHAR(255),
    code VARCHAR(50),
    FOREIGN KEY (code) REFERENCES Categorie(code)
);

-- Table Commande
CREATE TABLE commande (
    numcmd INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    etat VARCHAR(50),
    qte INT,
    numcli INT,
    ref INT,
    FOREIGN KEY (numcli) REFERENCES Client(numcli),
    FOREIGN KEY (ref) REFERENCES Produit(ref)
);

-- Table Utilisateur
CREATE TABLE utilisateur (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    mdp VARCHAR(255),
    profil VARCHAR(50)
);
