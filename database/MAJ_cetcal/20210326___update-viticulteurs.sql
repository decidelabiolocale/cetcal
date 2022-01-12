alter table cetcal_producteur add column categorie VARCHAR(32) DEFAULT NULL;
update cetcal_producteur set categorie='viticulteur' 
  WHERE pk_producteur 
    IN (select fk_producteur_type_production 
      from cetcal_type_production 
       where val_type_production='viticulteur');