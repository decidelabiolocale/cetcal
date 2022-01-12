select 
  count(distinct(fk_producteur_sondage)), reponse, clef_question 
    from cetcal_sondage 
      where clef_question='s001'
        group by reponse
          order by clef_question;

select 
  count(distinct(a.fk_producteur_sondage)) as 'nombre de réponses producteurs', 
  a.reponse as 'reponse sélectionnée',  
  b.question as 'question CAL', 
  a.clef_question as 'référence question CAL' 
    from cetcal_sondage a, cetcal_referentiel_question b 
      where a.clef_question=b.clef_question 
        and a.reponse != 'manque d&amp' -- les déchets :S (4 entrées)
        and a.reponse != 'D&amp' -- les déchets :S (2 entrées)
          group by a.reponse
            order by a.clef_question
              INTO OUTFILE '/var/lib/mysql/sondage_phase1.csv'
              FIELDS TERMINATED BY ','
              ENCLOSED BY '"'
              LINES TERMINATED BY '\n';

select 
  count(distinct(a.fk_producteur_information_producteur)) as 'nombre d\'informations producteurs', 
  a.information as 'information sélectionnée',  
  b.question as 'question CAL', 
  a.clef_information as 'référence question CAL' 
    from cetcal_information_producteur a, cetcal_referentiel_question b 
      where a.clef_information=b.clef_question 
        group by a.information
          order by a.clef_information            
            INTO OUTFILE '/var/lib/mysql/besoins_phase1.csv'
            FIELDS TERMINATED BY ','
            ENCLOSED BY '"'
            LINES TERMINATED BY '\n';