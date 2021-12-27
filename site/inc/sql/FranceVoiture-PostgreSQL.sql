/* -------------------------------
auteur: Sashtiga, Natacha, Abanoub
groupe: France Voiture
date création:  19/11/21
derniere modification : 01/12/21
sujet: base de donnée de France Voiture
version: PostgreSQL
----------------------------- */
 
-- On efface tout
DROP SCHEMA IF EXISTS FranceVoiture cascade ;
 
-- creation d'un schema
CREATE SCHEMA IF NOT EXISTS FranceVoiture;
 
-- creation d'une domaine email
CREATE DOMAIN email as varchar(50) check (value ~* E'^[a-z][a-z0-9_-]+\.?[a-z0-9_-]+@[a-z0-9_-]+\.[a-z]{2,4}$');
 
-- creation d'un type adresse
CREATE TYPE adresse as (numero smallint, type_de_voie varchar(16), nom_de_voie varchar(32), code_postal int, ville varchar(32)) ;
 
-- creation d'un type civilite
CREATE TYPE civilite_type as enum('M', 'Mme');

-- creation d'un type marque
CREATE TYPE marque_type as enum('Renault', 'Peugeot', 'Citroen');

-- creation d'un type etat
CREATE TYPE etat_type as enum('expedie', 'livraison en cours', 'traitement en cours', 'en attente de livraison');

-- creation d'un type categorie
CREATE TYPE categorie_type as enum('pneus','moteur','freinage','systeme electrique', 'amortisseur','echappement', 'suspension', 'piece allumage', 'climatisation', 'carrosserie', 'alternateur', 'filtre', 'direction');

------------------------ creations des tables ----------------------------------
 
CREATE TABLE if not exists FranceVoiture.vendeur (
	idVendeur serial PRIMARY KEY not null,
	nom varchar(64),
	prenom varchar(64),
	mdp varchar(128) not null,
	email email not null unique,
	raison_social varchar(64) not null,
	civilite civilite_type not null
);
 
CREATE TABLE if not exists FranceVoiture.voiture (
	idVoiture serial PRIMARY KEY not null,
	marque marque_type not null,
	modele varchar(64) not null
);
 
CREATE TABLE if not exists FranceVoiture.photo (
	idPhoto serial PRIMARY KEY not null,
	cheminPhoto varchar(128) not null,
	description varchar(256)
);
 
CREATE TABLE if not exists FranceVoiture.article_commande (
        idArticleCommande serial PRIMARY KEY not null,
        quantite int not null
);
 
CREATE TABLE if not exists FranceVoiture.article (
	idArticle serial PRIMARY KEY not null,
	nom varchar(64) not null,
	prix float not null,
	description varchar(128),
	nbStock int not null,
	dateCreation date not null,
	categorie categorie_type not null
);
 
CREATE TABLE if not exists FranceVoiture.commande (
	idCommande serial PRIMARY KEY not null,
	montant float not null,
	etat etat_type not null default 'traitement en cours',
	adresseLivraison adresse not null,
	dateLivraisonPrevu date not null,
	dateLivraison date
);
 
 
CREATE TABLE if not exists FranceVoiture.client (
	idClient serial PRIMARY KEY not null,
	nom varchar(64),
	prenom varchar(64),
	mdp varchar(128) not null,
	email email not null unique,
	civilite civilite_type not null
);
 
 
------------------------ creations des associations -----------------------------
 
CREATE TABLE if not exists FranceVoiture.traiter (
	idArticle serial not null,
	idVendeur serial not null,
	CONSTRAINT pk_traiter PRIMARY KEY (idArticle, idVendeur),
	CONSTRAINT fk_traiter_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle),
	CONSTRAINT fk_traiter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);
 
CREATE TABLE if not exists FranceVoiture.peut_convenir_avec (
	idVoiture serial not null,
	idArticle serial not null,
	CONSTRAINT pk_peut_convenir_avec PRIMARY KEY (idVoiture, idArticle),
	CONSTRAINT fk_peut_convenir_avec_idVoiture FOREIGN KEY (idVoiture) REFERENCES FranceVoiture.voiture(idVoiture),
	CONSTRAINT fk_peut_convenir_avec_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);
 
CREATE TABLE if not exists FranceVoiture.affiche(
	idPhoto serial not null,
	idArticle serial not null,
	CONSTRAINT pk_affiche PRIMARY KEY (idPhoto, idArticle),
	CONSTRAINT fk_affiche_idPhoto FOREIGN KEY (idPhoto) REFERENCES FranceVoiture.photo(idPhoto),
	CONSTRAINT fk_affiche_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);
 
CREATE TABLE if not exists FranceVoiture.concerne (
	idArticleCommande serial not null,
	idArticle serial not null,
	CONSTRAINT pk_concerne PRIMARY KEY (idArticleCommande, idArticle),
	CONSTRAINT fk_concerne_idArticleCommande FOREIGN KEY (idArticleCommande) REFERENCES FranceVoiture.article_commande(idArticleCommande),
	CONSTRAINT fk_concerne_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);
 
CREATE TABLE if not exists FranceVoiture.ajouter (
	idArticle serial not null,
	idVendeur serial not null,
	CONSTRAINT pk_ajouter PRIMARY KEY (idArticle, idVendeur),
	CONSTRAINT fk_ajouter_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle),
	CONSTRAINT fk_ajouter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);
 
CREATE TABLE if not exists FranceVoiture.peut_noter (
	idVendeur serial not null,
	idClient serial not null,
	note int not null,
	CONSTRAINT pk_peut_noter PRIMARY KEY (idVendeur, idClient),
	CONSTRAINT fk_peut_noter_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur),
	CONSTRAINT fk_peut_noter_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient)
);
 
CREATE TABLE if not exists FranceVoiture.envoyer_un_message (
	idClient serial not null,
	idVendeur serial not null,
	message text not null,
	dateEnvoye date not null,
	tpsEnvoye time not null,
	CONSTRAINT pk_envoyer_un_message PRIMARY KEY (idClient, idVendeur),
	CONSTRAINT fk_envoyer_un_message_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
	CONSTRAINT fk_envoyer_un_message_idVendeur FOREIGN KEY (idVendeur) REFERENCES FranceVoiture.vendeur(idVendeur)
);
 
CREATE TABLE if not exists FranceVoiture.contient(
	idArticleCommande serial not null,
	idCommande serial not null,
	CONSTRAINT pk_contient PRIMARY KEY (idArticleCommande, idCommande),
	CONSTRAINT fk_contient_idArticleCommande FOREIGN KEY (idArticleCommande) REFERENCES FranceVoiture.article_commande(idArticleCommande),
	CONSTRAINT fk_contient_idCommande FOREIGN KEY (idCommande) REFERENCES FranceVoiture.commande(idCommande)
);
 
CREATE TABLE if not exists FranceVoiture.avoir_panier (
	idArticle serial not null,
	idClient serial not null,
	nbArticle int not null,
	montant float not null,
	CONSTRAINT pk_avoir_panier PRIMARY KEY (idArticle, idClient),
	CONSTRAINT fk_avoir_panier_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
	CONSTRAINT fk_avoir_panier_idArticle FOREIGN KEY (idArticle) REFERENCES FranceVoiture.article(idArticle)
);
 
CREATE TABLE if not exists FranceVoiture.valider (
	idClient serial not null,
	idCommande serial not null,
	dateCommande date not null,
	CONSTRAINT pk_valider PRIMARY KEY (idClient, idCommande),
	CONSTRAINT fk_valider_idClient FOREIGN KEY (idClient) REFERENCES FranceVoiture.client(idClient),
	CONSTRAINT fk_valider_idCommande FOREIGN KEY (idCommande) REFERENCES FranceVoiture.commande(idCommande)
);

------------------------ Insertion d'un client et d'un vendeur ------------------

-- Premier client de la base : M. Pommier Petit-Pomme
INSERT INTO FranceVoiture.client(nom, prenom, mdp, email, civilite) VALUES('Pommier', 'Petit-Pomme', 'pommepommier', 'pommier.ppomme@postgresql.fr', 'M');

-- Premier vendeur de la base : Mme. Banenier Petite-Banane
INSERT INTO FranceVoiture.vendeur (nom, prenom, mdp, email, raison_social, civilite) VALUES('Bananier', 'Petite-Banane', 'banane011221', 'bananier.pbanane@postgresql.fr', 'Banane.com', 'Mme');
	
	
/*----------------------- Insertion des voitures ------------------*/

/*----------------------- Insertion des photos ------------------*/

