/**
 * Dans le cas d'update man des coordonnées, permettre de locker ces coordonnées.
 * ... et de ne pas laisser la mise à jour passer en cas de modification du questionnaire et 
 * données adresses.
 */
alter table cetcal_cartographie add column update_man varchar(5) DEFAULT 'false';
