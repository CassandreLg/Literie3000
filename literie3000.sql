CREATE DATABASE literie3000;

USE literie3000;

CREATE TABLE produits (
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(400),
    nom VARCHAR(100) NOT NULL,
    taille VARCHAR(50),
    prix DECIMAL(6,2),
    promo VARCHAR(100)
 );

INSERT INTO produits 
(photo, nom, taille, prix, promo)
VALUES
("https://www.ikea.com/fr/fr/images/products/brimnes-lit-banquette-2p-struct-matelas-blanc-vannareid-ferme__0734641_pe739552_s5.jpg?f=s", "Matelas Transition", "90 x 190", 759.00, "529"),
("https://www.ikea.com/fr/fr/images/products/valevag-matelas-a-ressorts-ensaches-ferme-bleu-clair__0928314_pe789778_s5.jpg?f=s", "Matelas Stan", "90 x 190", 809.50, "709"),
("https://www.ikea.com/fr/fr/images/products/brimnes-cadre-lit-avec-rangement-blanc__1101946_pe866872_s5.jpg?f=s", "MateLaFatigue", "90 x 120", 458.00, ""),
("https://www.machambredenfant.com/images/117/p/117_349074_max.jpg", "MateLot", "90 x 120", 563.00, ""),
("https://cdn.laredoute.com/products/e/4/9/e49b2ffcc1ebdf880d0890948e8d7740.jpg?width=900&dpr=1", "Matelas Teamasse", "140 x 190", 759.23, "529"),
("https://cdn.laredoute.com/products/8/b/4/8b49a2f7344ffefb571998845252c96f.jpg?width=900&dpr=1", "Matelas Coup de Boule", "160 x 200", 1019.00, "509"),
("https://cdn.laredoute.com/products/3/e/2/3e2aacb588a50f9cc0fe5b6e60fa3583.jpg?width=800&dpr=1", "Matelas Calm", "140 x 190", 720.30, ""),
("https://cdn.laredoute.com/products/0/1/6/016d7e71dd6324985e1e04442bda72da.jpg?width=900&dpr=1", "Matelas Citron", "240 x 220", 978.50, "");

CREATE TABLE marques (
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL
);

INSERT INTO marques
(nom)
VALUES
("EPEDA"),
("DREAMWAY"),
("EMMA"),
("BULTEX");

CREATE TABLE produit_marque (
    produit_id SMALLINT,
    marque_id SMALLINT,
    PRIMARY KEY (produit_id, marque_id),
    FOREIGN KEY (produit_id) REFERENCES produits(id),
    FOREIGN KEY (marque_id) REFERENCES marques(id)
);

INSERT INTO produit_marque 
(produit_id, marque_id)
VALUES
(1,1),
(2,2),
(3,4),
(4,3),
(5,4),
(6,1),
(7,2),
(8,1);
 

