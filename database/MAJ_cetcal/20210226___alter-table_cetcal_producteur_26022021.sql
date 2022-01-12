/**
 * Par défault passer tous les producteurs à fournisseurs cet = false. Ensuite, mettre à jour
 * au cas par cas.
 */
alter table cetcal_producteur add column fournisseur_cet varchar(5) default 'false';

/**************************************************************************************************/
/* scripts test, intégration */
/* select pk_producteur, nom_ferme from cetcal_producteur where pk_producteur IN (74, 205, 168, 70, 53, 71, 233, 58, 241, 133, 63, 18, 28, 73, 72, 65, 79);
+---------------+------------------------------------------+
| pk_producteur | nom_ferme                                |
+---------------+------------------------------------------+
|            18 | Fournil &quot;LEVAIN SUR 20&quot;        |
|            28 | Savonnerie En Douce Heure                |
|            53 | ukkola celia                             |
|            58 | Biscuits B                               |
|            63 | Chateau du Petit Roc                     |
|            65 |  Ferme bio Duellas                       |
|            70 | La ferme aux fleurs                      |
|            71 | La Ferme des Sources                     |
|            72 | La ferme du Paillot                      |
|            73 | La Grange aux Abeilles                   |
|            74 | Le Chateau des Rochers                   |
|            79 | Montant David                            |
|           133 | Scea vignobles RICHARD Chateau petit roc |
|           168 | Soumagnac Claude                         |
|           205 | JACQUEMENT CHRISTIAN                     |
|           233 | DUCLOS Didier et Virginie                |
|           241 | La grange aux champignons                |
+---------------+------------------------------------------+
*/
/**************************************************************************************************/

-- SCRIPT intégration OK pour passafe prod.
update cetcal.cetcal_producteur set fournisseur_cet='true' where nom_ferme IN (
  "Fournil &quot;LEVAIN SUR 20&quot;",
  "Savonnerie En Douce Heure",
  "ukkola celia",
  "Biscuits B",
  "Chateau du Petit Roc",
  " Ferme bio Duellas",
  "La ferme aux fleurs",
  "La Ferme des Sources",
  "La ferme du Paillot",
  "La Grange aux Abeilles",
  "Le Chateau des Rochers",
  "Montant David",
  "Scea vignobles RICHARD Chateau petit roc",
  "Soumagnac Claude",
  "JACQUEMENT CHRISTIAN",
  "DUCLOS Didier et Virginie",
  "La grange aux champignons");