insert into cetcal_communes (libelle) 
  select concat(adrferme_commune, " ", adrferme_cp) as libelle 
    from cetcal_producteur 
      where prod_inscrit='true';

-- puis, suite à passage : 
delete from cetcal_communes where libelle = '0 0';
delete from cetcal_communes where lat='NULL';
delete from cetcal_communes where lat='';
delete from cetcal_communes where lng='NULL';
delete from cetcal_communes where lng='';


alter table cetcal_communes add column commune varchar(128) default NULL;
alter table cetcal_communes add column code_postal varchar(5) default NULL;
alter table cetcal_communes add column code_dept varchar(2) default NULL;

update cetcal_communes set code_dept=substring(code_postal, 1, 2);