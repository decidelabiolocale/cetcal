use cetcal;
CREATE TABLE cetcal_biodata (
  id INT NOT NULL AUTO_INCREMENT,
  fk_producteur INT DEFAULT NULL,
  url_org_certif VARCHAR(1024) DEFAULT NULL,
  id_certification VARCHAR(512) DEFAULT NULL,
  matricule VARCHAR(256) DEFAULT NULL,
  PRIMARY KEY (id)
);