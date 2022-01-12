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