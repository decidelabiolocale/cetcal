CREATE TABLE cetcal_administration (
	adm_id INT NOT NULL AUTO_INCREMENT,
	adm_email VARCHAR(64) NOT NULL,
	adm_usr_name VARCHAR(32) NOT NULL,
	adm_usr_mdp VARCHAR(512) NOT NULL,
	PRIMARY KEY (adm_id)
);

ALTER TABLE cetcal_administration ADD COLUMN session_id VARCHAR(512);