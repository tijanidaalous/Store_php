CREATE DATABASE cc3;

USE cc3;

CREATE TABLE Membre (
    id_membre INT(3) AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(20) UNIQUE NOT NULL,
    mdp VARCHAR(32) NOT NULL,
    nom VARCHAR(20),
    prenom VARCHAR(20),
    email VARCHAR(50),
    civilite ENUM('m', 'f'),
    ville VARCHAR(20),
    code_postal INT(5) UNSIGNED ZEROFILL,
    adresse VARCHAR(50),
    statut INT(1) DEFAULT 0
);

CREATE TABLE Produit (
    id_produit INT(3) AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(20) UNIQUE NOT NULL,
    categorie VARCHAR(20),
    titre VARCHAR(100),
    description TEXT,
    couleur VARCHAR(20),
    taille VARCHAR(5),
    public ENUM('m', 'f', 'mixte'),
    photo VARCHAR(250),
    prix INT,
    stock INT
);

CREATE TABLE Commande (
    id_commande INT(3) AUTO_INCREMENT PRIMARY KEY,
    id_membre INT(3),
    montant INT,
    date_enregistrement DATETIME,
    etat ENUM('en cours de traitement', 'envoyé', 'livré') DEFAULT 'en cours de traitement',
    FOREIGN KEY (id_membre) REFERENCES Membre(id_membre)
);

CREATE TABLE Details_Commande (
    id_details_commande INT(3) AUTO_INCREMENT PRIMARY KEY,
    id_commande INT(3),
    id_produit INT(3),
    quantite INT,
    prix INT,
    FOREIGN KEY (id_commande) REFERENCES Commande(id_commande),
    FOREIGN KEY (id_produit) REFERENCES Produit(id_produit)
);


insert into Membre(pseudo ,mdp, nom , prenom , email , civilite , ville , code_postal , adresse, statut)
    values("admin", "password", "Hamid","VARCHAR(20)", "thegoat@gmail.com", "m", "Casablanca", 20000, "Casablanca-Morocco", 1);