--1 route de l'amourette Beauchamp Vélines 24230 
--Savonnerie En Douce Heure, 44.840200, 0.099612
update cetcal_cartographie 
	set cetcal_prd_lat='0.099612',
		cetcal_prd_lng='44.840200'
	where fk_producteur=(select pk_producteur 
		from cetcal_producteur 
		where nom_ferme='Savonnerie En Douce Heure');

--Château Fourton La Garenne
--321 passage de Fourton NERIGEAN 33750 
--Château Fourton La Garenne, 44.849878, -0.299817
update cetcal_cartographie 
	set cetcal_prd_lat='-0.299817',
		cetcal_prd_lng='44.849878'
	where fk_producteur=(select pk_producteur 
		from cetcal_producteur 
		where nom_ferme='Château Fourton La Garenne');

-- La Grange aux Abeilles
update cetcal_cartographie set cetcal_prd_lat='0.03935878322', cetcal_prd_lng='44.98587959' where fk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='La Grange aux Abeilles');

-- Les champis de l'Antre-deux-Mers
update cetcal_cartographie set cetcal_prd_lat='-0.153398', cetcal_prd_lng='44.760067' where fk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='Les champis de l\'Antre-deux-Mers');

-- LE BERGEY BIO ! Le best Marché of all : D
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='LE BERGEY BIO' and prod_inscrit='false');
update cetcal_producteur set adrferme_ltrl='Périnet 33350 PUJOLS', 
	desc_produits_ltrl='Courges,côte de bette,Carottes,Piments doux,Piments de type Espelette,pimets forts,Tomates, Radis (plusieurs variétés),Pommes de terres,Navets (plusieurs variétés),Poireaux,Choux Kale,Céleri,Salades,prunes, pommes, raisin, plantes aromatiques,Œufs fermiers', marches_ltrl='Marché de Rauzan le samedi matin de 9h à 13h', infos_ltrl='Produits Bio certifiés. Présence au marché de Rauzan tous les samedis matins de 9h à 13h (en face du Tabac). Vente à la ferme les mardis. Pour toute information, consulter la page facebook.', pageurl_fb='https://www.facebook.com/lebergeybio/'
	where nom_ferme='LE BERGEY BIO' and prod_inscrit='false';

-- ERREURS DE CARTO à prendre en charge MARS/AVRIL 2021 : 
update cetcal_producteur set prod_inscrit = 'ercrt' where denomination_producteur='Vincent BOISSERIE' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where denomination_producteur='Devaux Olivier' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where nom_ferme='Conserverie de la tour' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where nom_ferme='Château Fourton La Garenne - Les vignobles de Damanieu' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where nom_ferme='DE CARRIERE DE MONTVERT YVES' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where email='michael.bonnaud@laposte.net' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit = 'ercrt' where email='annelaure2433@gmail.com' AND prod_inscrit='false';
update cetcal_producteur set prod_inscrit='ercrt' where adrferme_ltrl ='3890 JUILLAC';
update cetcal_producteur set prod_inscrit='ercrt' where pk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='Château Dudon à 33.4 Km' and prod_inscrit='false');
update cetcal_producteur set prod_inscrit='ercrt' where pk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='Cédric Streit' and prod_inscrit='false');
update cetcal_producteur set prod_inscrit='ercrt' where pk_producteur=(select pk_producteur from cetcal_producteur where email='icare.massoubre.pain.bio@gmail.com' AND prod_inscrit='false');
update cetcal_producteur set prod_inscrit='ercrt' where pk_producteur IN (select pk_producteur from cetcal_producteur where adrferme_ltrl='' AND prod_inscrit='false');
delete from cetcal_producteur where prod_inscrit='false' and adrferme_ltrl = '24000 Bergerac' and nom_ferme='Les jardins de bergerac';
delete from cetcal_producteur WHERE nom_ferme='Célia Ukkola' AND prod_inscrit='false';
  
-- DOUBLONS ou pas de données : delete physique :
delete from cetcal_producteur where nom_ferme='Les jardins de Bergerac' AND prod_inscrit='false';
delete from cetcal_producteur where pk_producteur =(select pk_producteur from cetcal_producteur where nom_ferme='' and adrferme_ltrl='' and desc_produits_ltrl='' and  prod_inscrit='false');
delete from cetcal_producteur where telfixe='0553741342' AND prod_inscrit='false';
update cetcal_producteur set telfixe='0553741342' where telport='0687404445' and prod_inscrit='false' and email='dubiau@free.fr';

delete from cetcal_communes where libelle LIKE 'Pessac-2%' limit 1;
insert into cetcal_communes (libelle, lat, lng) values ('Minzac 24610', '44.9721353507', '0.0379831926');

/* La grange aux abeilles minzac : pré-inscription en doublon */
update cetcal_cartographie set cetcal_prd_lat='0.03935878322', cetcal_prd_lng='44.98587959' where fk_producteur=358;
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur WHERE nom_ferme='Célia Ukkola' AND prod_inscrit='false');
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur where telfixe='0553741342' AND prod_inscrit='false');
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='Les jardins de Bergerac' AND prod_inscrit='false');
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur where telfixe='0553741342' AND prod_inscrit='false');
delete from cetcal_cartographie where fk_producteur=(select pk_producteur from cetcal_producteur where nom_ferme='Château Dudon à 33.4 Km' and prod_inscrit='false');
delete from cetcal_cartographie where fk_entite=(select pk_entite from cetcal_entite where denomination='Marché de Saint-Seurin-sur-l\'Isle');
