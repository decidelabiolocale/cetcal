alter table cetcal_user ADD COLUMN user_type VARCHAR(128) default NULL;
ALTER TABLE cetcal_user DROP user_fk_commune;