/**
 * gestion des niveaux d'agriculture AB ou y tendant.
 * gestion des organismes de certification AB dans le cas ou AB certifié.
 */
alter table cetcal_producteur add column niv_certif_ab varchar(1) default NULL;
alter table cetcal_producteur drop column orgcertifbio;
alter table cetcal_producteur add column orgcertifbio varchar(128) default NULL;