/**
    Modification du typage sur la table entité
 */

UPDATE `cetcal_entite` SET type = 'amap' WHERE activite LIKE '%AMAP%';

UPDATE `cetcal_entite` SET type = 'marche' WHERE type LIKE '%marche local%';

UPDATE `cetcal_entite` SET type = 'magasin bio' WHERE activite LIKE '%Epicerie%';

UPDATE `cetcal_entite` SET activite = NULL WHERE activite = "";

UPDATE `cetcal_entite` SET type = 'autre' WHERE `activite` IS NULL


