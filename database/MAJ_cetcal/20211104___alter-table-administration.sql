/** les habilitations admin : */
alter table cetcal_administration add column hab_producteurs  VARCHAR(5) default 'false';
alter table cetcal_administration add column hab_certif_bioab VARCHAR(5) default 'false';
alter table cetcal_administration add column hab_entites      VARCHAR(5) default 'false';
alter table cetcal_administration add column hab_geoloc       VARCHAR(5) default 'false';
alter table cetcal_administration add column hab_admins       VARCHAR(5) default 'false';
alter table cetcal_administration add column hab_histo        VARCHAR(5) default 'false';
alter table cetcal_administration add column adm_actif        tinyint(1) default 1;