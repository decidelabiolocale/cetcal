/**
 * permet de distinguer les producteurs inscrit via formauliare questionnauire 
 * des producteur pré-inscrits par traitement batch.
 *
 * Les producteurs ayant un indentifiant cet sont <> '0' sont inscrits.
 */
alter table cetcal_producteur add column prod_inscrit varchar(5) default 'false';
update cetcal_producteur set prod_inscrit = 'true' where identifiant_cet != '0';