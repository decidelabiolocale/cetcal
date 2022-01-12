use cetcal;
CREATE TABLE cetcal_producteur_lieu_dist (
  pk_producteur_lieu_dist INT NOT NULL AUTO_INCREMENT,
  fk_entite INT DEFAULT NULL,
  fk_producteur INT DEFAULT NULL,
  code_type VARCHAR(4) NOT NULL,
  type VARCHAR(128) NOT NULL,
  code_sous_type VARCHAR(4) DEFAULT NULL,
  sous_type VARCHAR(128) DEFAULT NULL,
  denomination VARCHAR(128) DEFAULT NULL,
  crea_marche VARCHAR(5) DEFAULT 'false',
  precisions VARCHAR(256) DEFAULT NULL,
  date_lieu VARCHAR(32) DEFAULT NULL,
  heure_deb VARCHAR(32) DEFAULT NULL,
  heure_fin VARCHAR(32) DEFAULT NULL,
  jour VARCHAR(16) DEFAULT NULL,
  PRIMARY KEY (pk_producteur_lieu_dist)
);