/**
 * Le mapping clef_produit de type varchar(4) n'est pas encore fait,
 * il est temps de le faire et cela facilite grandement la 
 * reconstruction des formulaires produits dans le questionnaire producteur.
 */
alter table cetcal_produit add column clef_produit varchar(4) default NULL;

update cetcal_produit set clef_produit='pl01' where categorie='legume';
update cetcal_produit set clef_produit='pv01' where categorie='viande';
update cetcal_produit set clef_produit='pf01' where categorie='fruit';
update cetcal_produit set clef_produit='pt01' where categorie='transforme';
update cetcal_produit set clef_produit='ps01' where categorie='semence';
update cetcal_produit set clef_produit='pp01' where categorie='plante';
update cetcal_produit set clef_produit='pcr1' where categorie='cereal';
update cetcal_produit set clef_produit='ppc1' where categorie='poisson';
update cetcal_produit set clef_produit='phy1' where categorie='hygiene';
update cetcal_produit set clef_produit='pnt1' where categorie='entretien';
update cetcal_produit set clef_produit='pr01' where categorie='ruche';
update cetcal_produit set clef_produit='pla1' where categorie='laitier';
update cetcal_produit set clef_produit='pna1' where categorie='nourriture animaux';
update cetcal_produit set clef_produit='pc01' where categorie='champignon';
update cetcal_produit set clef_produit='pb01' where categorie='boisson';

/*
MariaDB [cetcal]> select distinct(categorie) from cetcal_produit;
+--------------------+
| categorie          |
+--------------------+
| legume             |
| viande             |
| fruit              |
| transforme         |
| semence            |
| plante             |
| autre              |
| cereal             |
| poisson            |
| hygiene            |
| entretien          |
| ruche              |
| laitier            |
| champignon         |
| nourriture animaux |
+--------------------+
*/
