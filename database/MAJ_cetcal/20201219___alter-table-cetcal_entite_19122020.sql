/* 
 * permet de typer les entités dans cette table. Deux types à ce jour :
 * 'marche' | 'asso-distrib'
 */
alter table cetcal_entite add column type VARCHAR(128) default NULL;
alter table cetcal_entite add column etat tinyint(1) default 1;

/*
 * Mettre à niveau la table :
 */
update cetcal_entite set type='marche' where activite = 'marche du castillonnais';
update cetcal_entite set type='association distributeur' where activite <> 'marche du castillonnais';