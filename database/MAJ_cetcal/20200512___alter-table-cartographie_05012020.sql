/* Afin de pouvoir cartographier les producteurs mais aussi toute autre entite : */
alter table cetcal_cartographie add column fk_entite int(11) default -1;
ALTER TABLE cetcal_cartographie MODIFY fk_entite INT(11) DEFAULT -1;
ALTER TABLE cetcal_cartographie MODIFY fk_producteur INT(11) DEFAULT -1;