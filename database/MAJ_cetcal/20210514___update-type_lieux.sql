/**
 * Magasin de producteurs : visibilité minimum. = 0
 * Marché visibilité Maximum. = 20
 * Export : sous type, précisions.
 */
ALTER TABLE cetcal_type_lieu ADD COLUMN visibilite_ui tinyint(2) default NULL;

/**
 * Bolléen tinyint : si = 1 affichage de recherche table cetcal_entite via typeahead. 
 * Sinon = 0 = pas de recherche sur cetcal_entite.
 */
ALTER TABLE cetcal_type_lieu ADD COLUMN recherche_tbl_entite tinyint(1) default 0;
/* TYPES */
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 32 where type='Marché';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where type='Réseau de vente en circuit court';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where type='Magasin de producteurs';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where type='Magasin Biologique';
update cetcal_type_lieu set recherche_tbl_entite=0, visibilite_ui = 8 where type='Vente directe';
update cetcal_type_lieu set recherche_tbl_entite=0, visibilite_ui = 8 where type='Export';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where type='Cooperative / Maraîcher';
/*update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where sous_type='AMAP';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where sous_type='Drive';
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 16 where sous_type='AMAP';*/

/* SOUS TYPES */
update cetcal_type_lieu set recherche_tbl_entite=1, visibilite_ui = 32 where sous_type='Association distributrice';