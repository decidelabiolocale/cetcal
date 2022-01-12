CREATE TABLE cetcal_recette (
  pk_recette INT NOT NULL AUTO_INCREMENT,
  titre VARCHAR(256) DEFAULT NULL,
  nombre_personnes VARCHAR(4) DEFAULT NULL, 
  temps_cuisson VARCHAR(32) DEFAULT NULL,
  temps_preparation VARCHAR(32) DEFAULT NULL,
  ingredients VARCHAR(2048) DEFAULT NULL,
  recette VARCHAR(2048) DEFAULT NULL,
  ingredients_et_recette VARCHAR(4096) DEFAULT NULL, 
  notes VARCHAR(2048) DEFAULT NULL, 
  auteurs VARCHAR(256) DEFAULT NULL,
  file_path VARCHAR(1024) DEFAULT NULL,
  mots_cles_produits VARCHAR(1024) DEFAULT NULL,
  PRIMARY KEY (pk_recette)
);