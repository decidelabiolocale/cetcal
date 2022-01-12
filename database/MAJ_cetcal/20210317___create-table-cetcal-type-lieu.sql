CREATE TABLE `cetcal`.`cetcal_type_lieu` (
 `id` INT NOT NULL,
 `type` VARCHAR(128) NULL,
 `sous_type` VARCHAR(128) NULL,
 PRIMARY KEY (`id`));

ALTER TABLE `cetcal`.`cetcal_type_lieu`
CHANGE COLUMN `id` `id` INT NOT NULL AUTO_INCREMENT ;

INSERT INTO cetcal.cetcal_type_lieu (type, sous_type) VALUES ('Magasin Biologique', 'Épicerie')
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Magasin Biologique', 'Caviste');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Magasin Biologique', 'Vrac');

/*Magasin de producteur*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Magasin de producteurs', NULL);

/*Marché*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Marché', NULL);

/*circuit court*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'AMAP');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'Drive');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'Ruche qui dit Oui !');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'Distributeur indépendant');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'Groupement d’achat');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Réseau de vente en circuit court', 'Distributeur de casiers automatiques');

/*coopérative producteurs et maraichers*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Cooperative / Maraîcher', NULL);

/*Vente directe*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Vente directe', 'à la ferme');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Vente directe', 'en livraison');

/*Export*/

INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Export', 'Hors région (National)');
INSERT INTO cetcal.cetcal_type_lieu  (type, sous_type) VALUES ('Export', 'à l\'international');
