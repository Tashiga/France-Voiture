/* ------------------------------- 
auteur: Sashtiga, Natacha, Abanoub
groupe: France Voiture
date création:  19/11/21
derniere modification : 03/12/21
sujet: Tables de la base de donnée 
version: MySQL
----------------------------- */

-- On efface tout
DROP DATABASE FranceVoiture;

-- creation d'un schema
CREATE DATABASE FranceVoiture;

------------------------ creations des tables ----------------------------------

CREATE TABLE if not exists FranceVoiture.vendeur (
    idVendeur int PRIMARY KEY not null auto_increment,
    nom varchar(64),
    prenom varchar(64),
    mdp varchar(128) not null,
    email varchar(128) not null unique,
    constraint ck_vendeur_email check (email like '%_@_%._%'),
    raison_social varchar(64) not null,
    civilite enum('M', 'Mme') not null
);

CREATE TABLE if not exists FranceVoiture.voiture (
    idVoiture int PRIMARY KEY not null auto_increment,
    marque enum('Renault', 'Peugeot', 'Citroen') not null,
    modele varchar(64) not null
);

CREATE TABLE if not exists FranceVoiture.photo (
    idPhoto int PRIMARY KEY not null auto_increment,
    cheminPhoto varchar(128) not null,
    description text
);

CREATE TABLE if not exists FranceVoiture.article_commande (
   idArticleCommande int PRIMARY KEY not null auto_increment,
   quantite int not null
);

CREATE TABLE if not exists FranceVoiture.article (
    idArticle int PRIMARY KEY not null auto_increment,
    nom varchar(64) not null unique,
    prix float not null,
    description varchar(128),
    nbStock int not null,
    dateCreation date not null,
    categorie enum('pneus','moteur','freinage','systeme electrique', 'amortisseur','echappement', 'suspension', 'piece allumage', 'climatisation', 'carrosserie', 'alternateur', 'filtre', 'direction') not null
);

CREATE TABLE if not exists FranceVoiture.commande (
    idCommande int PRIMARY KEY not null auto_increment,
    montant float not null,
    etat enum('expedie', 'livraison en cours', 'traitement en cours', 'en attente de livraison') not null default 'traitement en cours',
    numeroRue int not null,
    nomRue varchar(128) not null,
    cp int(5) not null,
    ville varchar(64) not null,
    dateLivraisonPrevu date not null,
    dateLivraison date
);

CREATE TABLE if not exists FranceVoiture.client (
    idClient int PRIMARY KEY not null auto_increment,
    nom varchar(64),
    prenom varchar(64),
    mdp varchar(128) not null,
    email varchar(128) not null unique,
    constraint ck_client_email check (email like '%_@_%._%'),
    civilite enum('M', 'Mme') not null
);


------------------------ creations des associations -----------------------------


CREATE TABLE if not exists FranceVoiture.traiter (
    idArticle int not null,
    idVendeur int not null, 
    CONSTRAINT pk_traiter PRIMARY KEY (idArticle, idVendeur),
    CONSTRAINT fk_traiter_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle),
    CONSTRAINT fk_traiter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);

CREATE TABLE if not exists FranceVoiture.peut_convenir_avec (
    idVoiture int not null,
    idArticle int not null,
    CONSTRAINT pk_peut_convenir_avec PRIMARY KEY (idVoiture, idArticle),
    CONSTRAINT fk_peut_convenir_avec_idVoiture FOREIGN KEY (idVoiture) REFERENCES FranceVoiture.voiture(idVoiture),
    CONSTRAINT fk_peut_convenir_avec_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);

CREATE TABLE if not exists FranceVoiture.affiche(
    idPhoto int not null,
    idArticle int not null,
    CONSTRAINT pk_affiche PRIMARY KEY (idPhoto, idArticle),
    CONSTRAINT fk_affiche_idPhoto FOREIGN KEY (idPhoto) REFERENCES FranceVoiture.photo(idPhoto),
    CONSTRAINT fk_affiche_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);

CREATE TABLE if not exists FranceVoiture.concerne (
    idArticleCommande int not null,
    idArticle int not null,
    CONSTRAINT pk_concerne PRIMARY KEY (idArticleCommande, idArticle),
    CONSTRAINT fk_concerne_idArticleCommande FOREIGN KEY (idArticleCommande) REFERENCES FranceVoiture.article_commande(idArticleCommande),
    CONSTRAINT fk_concerne_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);

CREATE TABLE if not exists FranceVoiture.ajouter (
    idArticle int not null,
    idvendeur int not null,
    CONSTRAINT pk_ajouter PRIMARY KEY (idArticle, idVendeur),
    CONSTRAINT fk_ajouter_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle),
    CONSTRAINT fk_ajouter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);

CREATE TABLE if not exists FranceVoiture.peut_noter (
    idVendeur int not null,
    idClient int not null,
    note int not null,
    CONSTRAINT pk_peut_noter PRIMARY KEY (idVendeur, idClient),
    CONSTRAINT fk_peut_noter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur),
    CONSTRAINT fk_peut_noter_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient)
);

CREATE TABLE if not exists FranceVoiture.envoyer_un_message (
    idClient int not null,
    idVendeur int not null,
    message text not null,
    dateEnvoye date not null,
    tpsEnvoye time not null,
    CONSTRAINT pk_envoyer_un_message PRIMARY KEY (idClient, idVendeur),
    CONSTRAINT fk_envoyer_un_message_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
    CONSTRAINT fk_envoyer_un_message_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);

CREATE TABLE if not exists FranceVoiture.contient(
    idArticleCommande int not null ,
    idCommande int not null ,
    CONSTRAINT pk_contient PRIMARY KEY (idArticleCommande, idCommande),
    CONSTRAINT fk_contient_idArticleCommande FOREIGN KEY (idArticleCommande) REFERENCES FranceVoiture.article_commande(idArticleCommande),
    CONSTRAINT fk_contient_idCommande FOREIGN KEY (idCommande) REFERENCES FranceVoiture.commande(idCommande)
);

CREATE TABLE if not exists FranceVoiture.avoir_panier (
    idArticle int not null,
    idClient int not null,
    nbArticle int not null,
    montant float not null,
    CONSTRAINT pk_avoir_panier PRIMARY KEY (idArticle, idClient),
    CONSTRAINT fk_avoir_panier_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
    CONSTRAINT fk_avoir_panier_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);

CREATE TABLE if not exists FranceVoiture.valider (
    idClient int not null,
    idCommande int not null,
    dateCommande date not null,
    CONSTRAINT pk_valider PRIMARY KEY (idClient, idCommande),
    CONSTRAINT fk_valider_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
    CONSTRAINT fk_valider_idCommande FOREIGN KEY (idCommande) REFERENCES FranceVoiture.commande(idCommande)
);


/*----------------------- Insertion d'un client et d'un vendeur ------------------*/

-- Premier client de la base : M. Pommier Petit-Pomme
INSERT INTO FranceVoiture.client(nom, prenom, mdp, email, civilite) VALUES('Pommier', 'Petit-Pomme', 'pommepommier', 'pommier.ppomme@postgresql.fr', 'M');

-- Premier vendeur de la base : Mme. Banenier Petite-Banane
INSERT INTO FranceVoiture.vendeur (nom, prenom, mdp, email, raison_social, civilite) VALUES('Bananier', 'Petite-Banane', 'banane011221', 'bananier.pbanane@postgresql.fr', 'Banane.com', 'Mme');
	
	
/*----------------------- Insertion des voitures ------------------*/

/*----------------------- Insertion des photos ------------------*/

