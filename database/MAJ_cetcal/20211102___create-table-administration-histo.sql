use cetcal;
CREATE TABLE cetcal_administration_histo (
  pk_hist INT NOT NULL AUTO_INCREMENT,
  adm_fk INT NOT NULL,
  adm_email VARCHAR(256) NOT NULL,
  action_code VARCHAR(8) NOT NULL,
  action_libelle_fonctionnel VARCHAR(256) NOT NULL,
  date_heure_action VARCHAR(32) NOT NULL,
  datetime_stamp VARCHAR(32) NOT NULL,
  pk_element INT NOT NULL,
  type_element VARCHAR(32) NOT NULL,
  denomination_element VARCHAR(256) NOT NULL,
  commentaire VARCHAR(512) NOT NULL,
  PRIMARY KEY (pk_hist)
);