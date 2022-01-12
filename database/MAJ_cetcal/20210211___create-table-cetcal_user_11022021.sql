CREATE TABLE cetcal_user (
	user_id INT NOT NULL AUTO_INCREMENT,
	user_email VARCHAR(64) NOT NULL,
	user_usr_name VARCHAR(32) NOT NULL,
	user_usr_mdp VARCHAR(512) NOT NULL,
	user_telport VARCHAR(14) NOT NULL,
	user_commune VARCHAR(64) default NULL,
	user_ip VARCHAR(128) NOT NULL,
	user_active INT default 0, 
	user_permission INT default 0,
	identifiant_cet VARCHAR(1024) NOT NULL,
	session_id VARCHAR(512) default NULL,
	user_fk_commune INT default 0,
	notifier_info TINYINT default 0,
	notifier_achat TINYINT default 0,
	notifier_hebdo TINYINT default 0,
	PRIMARY KEY (user_id)
);