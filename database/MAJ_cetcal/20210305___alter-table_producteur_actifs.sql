/**
 * Permets de désactiver des producteurs.
 * gestion des doublons, ou données à revoir avant ré-activation.
 * 
 * Par default, = 1 car actifs. Si besoin de désactiver, passer à 0.
 */
alter table cetcal_producteur add column prod_active tinyint(10) default 1;