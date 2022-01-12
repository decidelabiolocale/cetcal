update cetcal_entite set type='mbio' where type='magasin bio';
update cetcal_entite set type='amap' where type='amap';
update cetcal_entite set type='autre' where type='autre';
update cetcal_entite set type='assocdist' where type='association distributeur';
update cetcal_entite set type='marche' where type='marche';
update cetcal_entite set type='autre' where type='';


update cetcal_entite set type='mbio' where type LIKE '%magasin%';
  update cetcal_entite set type='mbio' where type LIKE '%Magasin%';

update cetcal_entite set type='amap' where type LIKE '%amap%';
  update cetcal_entite set type='amap' where type LIKE '%AMAP%';

update cetcal_entite set type='marche' where type LIKE '%marche%';
  update cetcal_entite set type='marche' where type LIKE '%Marché%';
    update cetcal_entite set type='marche' where type LIKE '%marché%';

update cetcal_entite set type='assocdist' where type LIKE '%association%';
  update cetcal_entite set type='assocdist' where type LIKE '%Association%';

update cetcal_entite set type='autre' where type NOT IN ("assocdist", "mbio", "amap", "autre", "marche");