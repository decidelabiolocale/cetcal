/* ********************************************************************************
 * afin de péréniser c'est données, il faut étendre les champs de la table 
 * cetcal_producteur avec ajouts des champs suivant : 
 * - <email_mltpl VARCHAR(256)> (pour les cas avec < 1 email dans le csv de Céline). Dans 
 * les cas de emails multiples, le premier alimentera cetcal_producteur.email et email_bu.
 * Le champs email_mltpl contiendra les N emails du csv. Dans le cas ou la ligne du CSV
 * ne contient qu'un seul email, alors email_mltpl n'est pas alimenté et les chmaps email
 * et email_bu portent l'email unique (comme pour une inscription).
 * - <tels_mltpl VARCHAR(128)> idem que pour emails.
 * - <desc_produits_ltrl VARCHAR(2048)> (pour porter les données produits sans les écrire dans 
 * les tables cetcal_produit car cette cernière nécessite des entrées atomiques).
 * Le champ desc_produits portera une description litérale des produits et 
 * catégories de produits mélangés. Tel quel, les données produits du CSV de 
 * Céline ne permettent pas une automatisation csv vers tables cetcal.
 * - <adrferme_ltrl VARCHAR(512)> (pour porter l'adresse complète et non pas des données
 * adresse découpées comme c'est le cas pour l'inscription producteur via cetcal).
 * - <denomination_producteur VARCHAR(60)> (pour porter les données nom et prénom qui sont
 * fortement couplés dans le csv : il est donc impossible dans ce csv de distinguer
 * le nom du prénom).
 * - <lieux_distribution_ltrl VARCHAR(512)> (les lieux. Idem données trop fortement couplées).
 * - <marches_ltrl> (même problème insolvable).
 * - <label_ltrl VARCHAR(60)> : contient les données de la colonne label du csv (sous forme de
 * chaine de caractère - les labels étant séparés par une virgule).
 * - <infos_ltrl VARCHAR(1024)> : contient les données infos + autre_cal + assos + partenaires.
 * - <denomination_producteur VARCHAR(60)> nom et prénom ou prénom et nom.
 * 
 * Données NOT NULL de la table cetcal_producteur : tous les champs avec contrainte
 * NOT NULL seront affectés avec '0'.
 * 
 * pk_producteur : l'insert portera une pk physique et ne se basera pas sur l'auto-increment
 * du champ. La valeur des PK commencera à ++1 000 000 (un milliiard et un) afin de garantir 
 * une plage de clés primaires dédiées.         
 ***********************************************************************************/
alter table cetcal_producteur add column email_mltpl VARCHAR(256) default NULL;
alter table cetcal_producteur add column urls_mltpl VARCHAR(1024) default NULL;
alter table cetcal_producteur add column desc_produits_ltrl VARCHAR(2048) default NULL;
alter table cetcal_producteur add column adrferme_ltrl VARCHAR(512) default NULL;
alter table cetcal_producteur add column desc_produits_ltrl VARCHAR(2048) default NULL;
alter table cetcal_producteur add column lieux_distribution_ltrl VARCHAR(512) default NULL;
alter table cetcal_producteur add column marches_ltrl VARCHAR(1024) default NULL;
alter table cetcal_producteur add column label_ltrl VARCHAR(60) default NULL;
alter table cetcal_producteur add column infos_ltrl VARCHAR(1024) default NULL;
alter table cetcal_producteur add column tels_mltpl VARCHAR(128) default NULL;
alter table cetcal_producteur add column denomination_producteur VARCHAR(60) default NULL;

/* ********************************************************************************
 * certains urls FB sont trop long et dépase char 60. Depuis l'inscription producteur,
 * le problème ne se pose pas car les champs html de saisies possèdent des attributs
 * max length. Ainsi la saisie > 60 chars est impossible.
 * ********************************************************************************/
alter table cetcal_producteur MODIFY column pageurl_fb VARCHAR(128);