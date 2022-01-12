/**
 * Suite à connection d'un producteur, updater la table pour porter, 
 * le temps de la session, le session id généré + IP de connection.
 */
alter table cetcal_producteur add column session_id VARCHAR(512) default NULL;
alter table cetcal_producteur add column producteur_ip VARCHAR(128) default NULL;
