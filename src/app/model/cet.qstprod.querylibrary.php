<?php
/**
 * Sql query's.
 */
class CETCALQueryLibrary
{

  const SELECT_PROPERTIES = "SELECT * from cetcal.cetcal_cipher;";

  const INSERT_QSTPROD_PRODUCTEUR = "INSERT INTO cetcal.cetcal_producteur (nom, prenom, email, email_bu, mdpsha, telfixe, telport, nom_ferme, siret, adrferme_numvoie, adrferme_rue, adrferme_lieudit, adrferme_commune, adrferme_cp, adrferme_compladr, pageurl_fb, pageurl_ig, pageurl_twitter, url_web, url_boutique, orgcertifbio, surfacehectterres, surfacesousserre, tetes_betail, hl_par_an, groupe_cagette, identifiant_cet, opinions, prod_inscrit, niv_certif_ab) VALUES (:pNom, :pPrenom, :pEmail, :pEmailBu, :pMdpsha, :pTelfixe, :pTelPort, :pNomFerme, :pSiret, :pAdrNumvoie, :pAdrRue, :pAdrLieudit, :pAdrCommune, :pAdrcp, :pAdrCmpladr, :pPageFb, :pPageIg, :pPageTwitter, :pUrlWeb, :pUrlBoutique, :pOrgCertifBio, :pSurfaceHectTerres, :pSurfaceAresSerre, :pNbrTetes, :pHLParAn, :pGroupeCagette, :pIndentifiantCet, :pOpinions, :pProdInscrit, :pNiveauCertifAB);";
  const UPDATE_QSTPROD_PRODUCTEUR = "UPDATE cetcal.cetcal_producteur SET nom=:pNom, prenom=:pPrenom, email=:pEmail, email_bu=:pEmailBu, telfixe=:pTelfixe, telport=:pTelPort, nom_ferme=:pNomFerme, siret=:pSiret, adrferme_numvoie=:pAdrNumvoie, adrferme_rue=:pAdrRue, adrferme_lieudit=:pAdrLieudit, adrferme_commune=:pAdrCommune, adrferme_cp=:pAdrcp, adrferme_compladr=:pAdrCmpladr, pageurl_fb=:pPageFb, pageurl_ig=:pPageIg, pageurl_twitter=:pPageTwitter, url_web=:pUrlWeb, url_boutique=:pUrlBoutique, orgcertifbio=:pOrgCertifBio, surfacehectterres=:pSurfaceHectTerres, surfacesousserre=:pSurfaceAresSerre, tetes_betail=:pNbrTetes, hl_par_an=:pHLParAn, groupe_cagette=:pGroupeCagette, opinions=:pOpinions, prod_active=1, identifiant_cet=:pIndentifiantCet, niv_certif_ab=:pNiveauCertifAB WHERE pk_producteur=:pPk_producteur;";
  const UPDATE_PRODUCTEUR_ETAT_INSCRIT = "UPDATE cetcal.cetcal_producteur SET prod_inscrit=:pPrdInscrit, prod_active=:pPrdActive, identifiant_cet=:pIdCetcal WHERE pk_producteur=:pPk;";
  const DESACTIVER_PRODUCTEUR_BY_PK = "UPDATE cetcal.cetcal_producteur SET prod_active=0 WHERE pk_producteur=:pPk;";
  const ACTIVER_PRODUCTEUR_BY_PK = "UPDATE cetcal.cetcal_producteur SET prod_active=1 WHERE pk_producteur=:pPk;";
  const UPDATE_CRITIQUE_PRODUCTEUR_MDPSHA = "UPDATE cetcal.cetcal_producteur SET mdpsha=:pNMdpsha WHERE pk_producteur=:pPk_producteur AND session_id=:pSessionId AND mdpsha=:pMdpsha;";
  const SELECT_ALL_ID_CET_PRODUCTEUR = "SELECT identifiant_cet FROM cetcal.cetcal_producteur;";
  const SELECT_ALL_EMAIL_PRODUCTEUR = "SELECT email FROM cetcal.cetcal_producteur WHERE prod_active=1;";
  const SELECT_ALL_EMAIL_AND_PK_PRODUCTEUR = "SELECT email, pk_producteur FROM cetcal.cetcal_producteur WHERE prod_active=1;";
  const SELECT_ALL_CET_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_producteur WHERE prod_active=1 AND prod_inscrit='true';";
  const SELECT_ALL_CET_PRODUCTEUR_N0N_INSCRIT = "SELECT * FROM cetcal.cetcal_producteur WHERE prod_active=1 AND prod_inscrit='false' OR prod_inscrit='amdif';";
  const SELECT_ALL_CET_PRODUCTEUR_INSCRITS_LIMIT_N = "SELECT * FROM cetcal.cetcal_producteur WHERE prod_active=1 AND prod_inscrit='true' ORDER BY pk_producteur DESC LIMIT :pLimit;";
  const SELECT_ALL_CET_PRODUCTEUR_INSCRIT_N0N_INSCRIT_ASC = "SELECT * FROM cetcal.cetcal_producteur WHERE prod_active=1 ORDER BY nom_ferme ASC;";
  const SELECT_ALL_CET_TYPE_PRODUCTION = "SELECT * FROM cetcal.cetcal_type_production WHERE fk_producteur_type_production=:pPk AND val_type_production != 'autre';";
  const SELECT_ALL_CET_TYPE_PRODUCTION_AND_AUTRE = "SELECT * FROM cetcal.cetcal_type_production WHERE fk_producteur_type_production=:pPk;";
  const SELECT_CETCAL_PRODUCTEUR_INSCRIT_BY_EMAIL_OR_IDWWWCET = "SELECT * FROM cetcal.cetcal_producteur WHERE (email=:pEmail OR identifiant_cet=:pIdwwwcet) AND prod_inscrit='true';";
  const SELECT_CETCAL_PRODUCTEUR_BY_EMAIL_OR_IDWWWCET = "SELECT * FROM cetcal.cetcal_producteur WHERE (email=:pEmail OR identifiant_cet=:pIdwwwcet);";
  const SELECT_PK_CETCAL_PRODUCTEUR_BY_EMAIL_AND_PWD_HASH = "SELECT * FROM cetcal.cetcal_producteur WHERE (email=:pEmail OR identifiant_cet=:pIdwwwcet) AND mdpsha=:pMdpHash;";
  const UPDATE_PRODUCTEUR_SESSION = "UPDATE cetcal.cetcal_producteur SET session_id=:pSessionId, producteur_ip=:pProducteurIp WHERE pk_producteur=:pPk;";
  const UPDATE_PRODUCTEUR_MOT_DE_PASSE = "UPDATE cetcal.cetcal_producteur SET mdpsha=:pMdpsha WHERE email=:pEmail;";
  const SELECT_SPECIFICITES_PRODUCTION_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_specificite_produits WHERE fk_producteur_specificites_produits=:pPk_producteur;";
  const SELECT_OPINIONS_ANNUAIRE_PRODUCTEUR_BY_PK = "SELECT * from cetcal.cetcal_producteur WHERE pk_producteur=:pPk;";

  const INSERT_CETCAL_RECETTE = "INSERT INTO cetcal.cetcal_recette (titre, nombre_personnes, temps_cuisson, temps_preparation, ingredients, recette, ingredients_et_recette, notes, auteurs, file_path, mots_cles_produits) VALUES (:pTitre, :pNbrPersonnes, :pTpsCuisson, :pTpsPreparation, :pIngredients, :pRecette, :pIngredientsEtRecette, :pNotes, :pAuteurs, :pFilePath, :pMotsClesProduits);";
  const SELECT_ALL_CETCAL_RECETTES = "SELECT * FROM cetcal.cetcal_recette ORDER BY titre ASC;";

  const INSERT_CETCAL_MEDIA_PRODUCTEUR = "INSERT INTO cetcal.cetcal_media (libelle, type, ext, urlr, cible, fk_producteur) VALUES (:pLibelle, :pType, :pExt, :pUrlr, :pCible, :pFk);";
  const INSERT_CETCAL_MEDIA_ENTITE = "INSERT INTO cetcal.cetcal_media (libelle, type, ext, urlr, cible, fk_entite) VALUES (:pLibelle, :pType, :pExt, :pUrlr, :pCible, :pFk);";
  const SELECT_CETCAL_MEDIA_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_media WHERE fk_producteur=:pFk;";
  const SELECT_CETCAL_MEDIA_ENTITE = "SELECT * FROM cetcal.cetcal_media WHERE fk_entite=:pFk;";
  const SELECT_CETCAL_MEDIA_PRODUCTEUR_LOGO_FERME = "SELECT urlr FROM cetcal.cetcal_media WHERE cible='logo-ferme' AND fk_producteur=:pFk LIMIT 1;";
  const SELECT_CETCAL_MEDIA_ENTITE_LOGO = "SELECT urlr FROM cetcal.cetcal_media WHERE cible='logo-entite' AND fk_entite=:pFk LIMIT 1;";
  const DELETE_PHYSIQUE_MEDIA_PRODUCTEUR = "DELETE FROM cetcal.cetcal_media WHERE id=:pPk AND fk_producteur=:pFk_producteur;";
  const DELETE_PHYSIQUE_MEDIA_ENTITE = "DELETE FROM cetcal.cetcal_media WHERE id=:pPk AND fk_entite=:pFk_entite;";

  const INSERT_CETCAL_TYPEPRODUCTION = "INSERT INTO cetcal.cetcal_type_production (clef_type_production, val_type_production, fk_producteur_type_production) VALUES (:pClef, :pVal, :pPkProducteur);";

  const INSERT_CETCAL_SPECIFICITE_PRODUITS = "INSERT INTO cetcal.cetcal_specificite_produits (clef_specificite, val_specificite, fk_producteur_specificites_produits) VALUES (:pClef, :pVal, :pPkProducteur);";

  const INSERT_CETCAL_MODE_CONSO = "INSERT INTO cetcal.cetcal_mode_conso (clef_mode_conso, val_mode_conso, fk_producteur_mode_conso) VALUES (:pClef, :pVal, :pPkProducteur);";
  const SELECT_CETCAL_MODE_CONSO_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_mode_conso WHERE fk_producteur_mode_conso=:pPk_producteur;";

  const INSERT_CETCAL_LIEU = "INSERT INTO cetcal.cetcal_lieu (nom, adresse_literale, jour_producteur, jour_collecte_conso) VALUES (:pNom, :pAdrLit, :pJoursProducteur, :pJourCollecteConso);";
  const INSERT_PRODUCTEUR_JOIN_LIEU = "INSERT INTO cetcal.producteur_join_lieu (fk_producteur_join, fk_lieu) VALUES (:pFkProducteur, :pFkLieu);";

  const INSERT_CETCAL_PRODUIT = "INSERT INTO cetcal.cetcal_produit (nom, categorie, clef_produit) VALUES (:pNom, :pCategorie, :pClef);";
  const INSERT_PRODUCTEUR_JOIN_PRODUITS = "INSERT INTO cetcal.producteur_join_produits (fk_producteur_join, fk_produits_join) VALUES (:pFkProducteur, :pFkProduit);";
  const SELECT_AUTRE_PRODUIT_INCONNU_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_produit WHERE categorie='autre' AND pk_produit IN (SELECT fk_produits_join FROM cetcal.producteur_join_produits WHERE fk_producteur_join=:pFk_producteur) LIMIT 1;";
  const SELECT_DISTINCT_NOMS_PRODUITS = "SELECT DISTINCT nom FROM cetcal.cetcal_produit;";

  const INSERT_SONDAGE = "INSERT INTO cetcal.cetcal_sondage (fk_producteur_sondage, clef_question, reponse) VALUES (:pPkProducteur, :pClefQuestion, :pReponse);";
  const INSERT_SONDAGE_NBRS = "INSERT INTO cetcal.cetcal_sondage (fk_producteur_sondage, clef_question, val_question, reponse) VALUES (:pPkProducteur, :pClefQuestion, :pValQuestion, :pReponse);";
  const SELECT_CETCAL_PRODUCTEUR_SONDAGE_BY_PK = "SELECT * FROM cetcal.cetcal_sondage WHERE fk_producteur_sondage=:pPk_producteur;";

  const INSERT_CETCAL_INFORMATION = "INSERT INTO cetcal.cetcal_information_producteur (fk_producteur_information_producteur, clef_information, information) VALUES (:pPkProducteur, :pClefInformation, :pInformation);";
  const SELECT_CETCAL_BESOINS_INFORMATIONS_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_information_producteur WHERE fk_producteur_information_producteur=:pPk_producteur;";

  const SELECT_COUNT_CRT_WHERE_PKFK = "SELECT count(fk_producteur) FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";
  const SELECT_COUNT_CRT_WHERE_PKFK_ENTITE= "SELECT count(fk_entite) FROM cetcal.cetcal_cartographie WHERE fk_entite=:pFkEntite;";
  const INSERT_CETCAL_CARTOGRAPHIE = "INSERT INTO cetcal.cetcal_cartographie (cetcal_prd_lat, cetcal_prd_lng, fk_producteur) VALUES (:pLat, :pLng, :pFkProducteur);";
  const INSERT_CETCAL_ENTITE_CARTOGRAPHIE = "INSERT INTO cetcal.cetcal_cartographie (cetcal_prd_lat, cetcal_prd_lng, fk_entite) VALUES (:pLat, :pLng, :pFkEntite);";
  const SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK = "SELECT * FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";
  const SELECT_CETCAL_CARTOGRAPHIE_WHERE_PKFK_ENTITE = "SELECT * FROM cetcal.cetcal_cartographie WHERE fk_entite=:pFkEntite;";
  const DELETE_CETCAL_ENTITE_CARTOGRAPHIE = "DELETE FROM cetcal.cetcal_cartographie WHERE fk_entite=:pFkEntite;";
  const DELETE_CETCAL_PRODUCTEUR_CARTOGRAPHIE = "DELETE FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur AND update_man != 'true';";
  const DELETE_CETCAL_PRODUCTEUR_CARTOGRAPHIE_FORCE = "DELETE FROM cetcal.cetcal_cartographie WHERE fk_producteur=:pFkProducteur;";
  const UPDATE_LAT_LNG_CETCAL_CARTOGRAPHIE_WHERE_PKFK = "UPDATE cetcal.cetcal_cartographie SET cetcal_prd_lat=:pLat, cetcal_prd_lng=:pLng, update_man=:pUpdateManuelle WHERE fk_producteur=:pFkProducteur;";
  const UPDATE_LAT_LNG_ENTITE_CETCAL_CARTOGRAPHIE_WHERE_PKFK = "UPDATE cetcal.cetcal_cartographie SET cetcal_prd_lat=:pLat, cetcal_prd_lng=:pLng, update_man=:pUpdateManuelle WHERE fk_entite=:pFkEntite;";
  const SELECT_DISTINCT_TYPE_ENTITE = "SELECT DISTINCT type FROM cetcal.cetcal_entite;";

  const INSERT_INTO_CETCAL_ENTITES = "INSERT INTO cetcal.cetcal_entite (denomination, territoire, activite, adresse, tels, personne, email, urlwww, infoscmd, jourhoraire, specificites, type) VALUES (:pDenomination, :pTerritoire, :pActivite, :pAdrliterale, :pTels, :pContactPersonne, :pEmail, :pUrlwww, :pInfoCommande, :pJourHoraire, :pSpecificite, :pType);";
  const INSERT_INTO_CETCAL_ENTITES_MARCHE = "INSERT INTO cetcal.cetcal_entite (denomination, activite, adresse, infoscmd, jourhoraire, specificites, type) VALUES (:pDenomination, :pActivite, :pAdrliterale, :pInfoCommande, :pJourHoraire, :pSpecificite, :pType);";
  const SELECT_ALL_CETCAL_ENTITE = "SELECT * FROM cetcal.cetcal_entite WHERE etat=1;";
  const SELECT_ALL_CETCAL_ENTITE_NOT_MARCHE = "SELECT * FROM cetcal.cetcal_entite WHERE activite != 'marche du castillonnais' AND etat=1;";
  const SELECT_ALL_CETCAL_ENTITE_IS_MARCHE = "SELECT * FROM cetcal.cetcal_entite WHERE activite='marche du castillonnais' AND etat=1;";
  const SELECT_PK_CETCAL_ENTITE_BY_DENOMINATION = "SELECT * FROM cetcal.cetcal_entite WHERE denomination=:pDenomination;";
  const SELECT_ALL_CETCAL_ENTITE_BY_TYPE = "SELECT * FROM cetcal.cetcal_entite WHERE type=:pType AND etat=1;";
  const SELECT_CETCAL_ENTITE_BY_PK = "SELECT * FROM cetcal.cetcal_entite WHERE pk_entite=:pPk_entite;";
  const UPDATE_ENTITE_BY_PK = "UPDATE cetcal.cetcal_entite SET denomination=:pDenomination, territoire=:pTerritoire, activite=:pActivite, adresse=:pAdrliterale, tels=:pTels, personne=:pContactPersonne, email=:pEmail, urlwww=:pUrlwww, infoscmd=:pInfoCommande, jourhoraire=:pJourHoraire, specificites=:pSpecificite, type=:pType WHERE pk_entite=:pPk;";
  const DELETE_LOGIQUE_ENTITE_BY_PK = "UPDATE cetcal.cetcal_entite SET etat=0 WHERE pk_entite=:pPk;";
  const SELECT_ALL_TYPES_LIEU = "SELECT DISTINCT (type) FROM cetcal.cetcal_entite;";
  const SELECT_ALL_DENOMINATION_MARCHE = "SELECT pk_entite, adresse, denomination FROM cetcal.cetcal_entite WHERE type = 'marche';";
  const SELECT_ALL_DENOMINATION_AMAP = "SELECT pk_entite, adresse, denomination FROM cetcal.cetcal_entite WHERE type = 'amap';";
  const SELECT_ALL_ENTITE_BY_TYPES = "SELECT pk_entite, adresse, denomination FROM cetcal.cetcal_entite WHERE type IN ([types]);";

  const SELECT_ALL_FROM_AMINISTRATION = "SELECT * FROM cetcal.cetcal_administration WHERE adm_actif=1;";
  const SELECT_CETCAL_ADMIN_BY_SESSION_ID = "SELECT * FROM cetcal.cetcal_administration WHERE session_id=:pSessionId AND adm_actif=1;";
  const UPDATE_AMINISTRATION_SESSION = "UPDATE cetcal.cetcal_administration SET session_id=:pSessionId WHERE adm_email=:pAdmLoginEmail OR adm_usr_name=:pAdmLogin;";
  const SELECT_ALL_FROM_AMINISTRATION_SESSION = "SELECT * FROM cetcal.cetcal_administration WHERE session_id=:pSessionId AND adm_actif=1;";
  const SELECT_ALL_FROM_AMINISTRATION_EMAIL_OR_LOGIN = "SELECT * FROM cetcal.cetcal_administration WHERE adm_usr_mdp=:pAdmUsrMdp AND adm_actif=1 AND adm_email=:pAdmEmail OR adm_usr_name=:pAdmUsrName;";
  const SELECT_ALL_FROM_HISTO_AMINISTRATION_ACTION = "SELECT * FROM cetcal.cetcal_administration_histo ORDER BY date_heure_action DESC;";
  const INSERT_INTO_HISTO_AMINISTRATION_ACTION = "INSERT INTO cetcal.cetcal_administration_histo (adm_fk, adm_email, action_code, action_libelle_fonctionnel, date_heure_action, datetime_stamp, pk_element, type_element, denomination_element, commentaire) VALUES (:pAdmFk, :pAdmEmail, :pActionCode, :pActionLibFonc, :pDateHeureAction, :pDtStamp, :pPkElement, :pTypeElement, :pDenominationElement, :pCommentaire);";
  const UPDATE_HABILITATIONS_ADMIN_BY_PK = "UPDATE cetcal.cetcal_administration SET hab_producteurs=:pHab_producteurs, hab_certif_bioab=:pHab_certif_bioab, hab_entites=:pHab_entites, hab_geoloc=:pHab_geoloc, hab_admins=:pHab_admins, hab_histo=:pHab_histo WHERE adm_id=:pPkAdm;";
  const DESACTIVATE_ADMIN_BY_PK = "UPDATE cetcal.cetcal_administration SET adm_actif=0 WHERE adm_id=:pPkAdm;";

  const SELECT_ALL_PARTENAIRES_LIENS = "SELECT * FROM cetcal.cetcal_partenaires_liens ORDER BY denomination ASC;";

  const UPDATE_COMMUNES_BY_LIBELLE = "UPDATE cetcal.cetcal_communes SET lat=:pLat, lng=:pLng WHERE libelle=:pLibelle AND id=:pId;";
  const SELECT_ALL_CETCAL_COMMUNES = "SELECT * FROM cetcal.cetcal_communes;";
  const SELECT_ALL_CETCAL_COMMUNES_GEOLOC_SET = "SELECT * FROM cetcal.cetcal_communes WHERE lat <> 'NULL' AND lng <> 'NULL' AND lat <> '' AND lng <> '';";
  const SELECT_COMMUNES_GEOLOC_BY_LIB = "SELECT lat, lng FROM cetcal.cetcal_communes WHERE libelle=:pLibelle;";
  const SELECT_ALL_CETCAL_COMMUNES_GEOLOC_SET_BY_CODEDEPT = "SELECT * FROM cetcal.cetcal_communes WHERE lat <> 'NULL' AND lng <> 'NULL' AND lat <> '' AND lng <> '' AND code_dept IN ([codes_dept]);";
  const SELECT_CETCAL_COMMUNES_BY_ID_LATLNG_EXISTS = "SELECT * FROM cetcal.cetcal_communes WHERE id=:pId AND lat <> 'NULL' AND lng <> 'NULL';";
  const SELECT_COMMUNE_BY_PK = "SELECT * FROM cetcal.cetcal_communes WHERE id=:pId;";
  
  const INSERT_CETCAL_USER = "INSERT INTO cetcal.cetcal_user (user_email, user_usr_name, user_type, user_usr_mdp, user_telport, user_commune, user_ip, identifiant_cet, notifier_info, notifier_achat, notifier_hebdo) VALUES (:pEmail, :pUsrNom, :pUsrType, :pMdpHash, :pTelPort, :pCommune, :pIP, :pCetWebID, :pInfos, :pAchat, :pHebdo);";
  const SELECT_ONE_USER_BY_EMAIL = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail LIMIT 1;";
  const SELECT_CETCAL_USER_BY_EMAIL = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail;";
  const SELECT_CETCAL_USER_BY_EMAIL_AND_PWD_HASH = "SELECT * FROM cetcal.cetcal_user WHERE user_email=:pEmail AND user_usr_mdp=:pMdpHash;";
  const UPDATE_USER_MOT_DE_PASSE = "UPDATE cetcal.cetcal_user SET user_usr_mdp=:pMdpsha WHERE user_email=:pEmail;";

  // Queries pour fiche détaillée producteur
  const SELECT_CETCAL_PRODUCTEUR_BY_PK = "SELECT * FROM cetcal.cetcal_producteur WHERE pk_producteur=:pPk_producteur;";
  const SELECT_PRODUCTEUR_LIEU_JOIN = "SELECT * FROM cetcal.cetcal_lieu, cetcal.producteur_join_lieu WHERE fk_lieu=pk_lieu AND fk_producteur_join=(select pk_producteur from cetcal.cetcal_producteur where pk_producteur = :pPk_producteur) ";
  const SELECT_PRODUIT_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.producteur_join_produits, cetcal.cetcal_produit WHERE fk_produits_join=pk_produit AND fk_producteur_join=:pPk_producteur";
  const SELECT_PRODUIT_BY_FK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_produit WHERE pk_produit IN (SELECT fk_produits_join FROM cetcal.producteur_join_produits WHERE fk_producteur_join=:pFk_producteur);";
  const SELECT_CATEGORIES_PRODUITS_BY_PK_PRODUCTEUR = "SELECT DISTINCT (categorie) FROM cetcal.producteur_join_produits, cetcal.cetcal_produit WHERE fk_produits_join=pk_produit AND fk_producteur_join=:pPk_producteur";
  const UPDATE_USER_SESSION = "UPDATE cetcal.cetcal_user SET session_id=:pSessionId, user_ip=:pUserIp WHERE user_id=:pUserId;";
  const UPDATE_USER_EMAIL_SESSION = "DELETE FROM cetcal.cetcal_producteur;";
  const SELECT_ALL_LIEUX_DIST_PROD_BY_PK = "SELECT * FROM cetcal.cetcal_producteur_lieu_dist WHERE fk_producteur=:pPk_producteur;";

  // TODO check deprecated ??? :
  const SELECT_PRODUCTEUR_WITH_MARCHE = "SELECT * FROM cetcal.producteur_join_lieu JOIN cetcal_lieu WHERE cetcal_lieu.pk_lieu = producteur_join_lieu.fk_lieu AND cetcal_lieu.nom = 'mad1'";
  // TODO check deprecated ??? :
  const SELECT_MARCHE_LIKE = "SELECT * FROM cetcal.cetcal_entite WHERE denomination LIKE CONCAT ('%', :pDenomination, '%') AND type = 'marche';";

  const INSERT_CETCAL_PRODUCTEUR_LIEU_DE_DISTRIBUTION = "INSERT INTO cetcal.cetcal_producteur_lieu_dist (fk_producteur, fk_entite, code_type, type, code_sous_type, sous_type, denomination, crea_marche, precisions, date_lieu, heure_deb, heure_fin, jour) VALUES (:pFk_producteur, :pFk_entite, :pCodeType, :pType, :pCodeSousType, :pSousType, :pDenomination, :pCreaMarche, :pPrecisions, :pDateLieu, :pHeureDeb, :pHeureFin, :pJour);";
  const SELECT_CETCAL_LIEUX_BY_PK_PRODUCTEUR = "SELECT * FROM cetcal.cetcal_producteur_lieu_dist WHERE fk_producteur=:pPk_producteur;";

  const SELECT_ALL_SOUS_TYPE_LIEU_BY_TYPE = "SELECT * FROM cetcal.cetcal_type_lieu WHERE code_type=:pType AND sous_type != 'NULL';";
  const SELECT_DISTINCT_ALL_TYPE_LIEU = "SELECT type, sous_type, code_type, code_sous_type, visibilite_ui, recherche_tbl_entite FROM cetcal.cetcal_type_lieu GROUP BY type;";
  const SELECT_ONE_TYPE_LIEU = "SELECT * FROM cetcal.cetcal_type_lieu WHERE type = :pType;";

  const INSERT_INTO_CETCAL_BIODATA = "INSERT INTO cetcal.cetcal_biodata (fk_producteur, url_org_certif, matricule) VALUES (:pPk_producteur, :pUrl, :pNumCertif);";
  const SELECT_BIODATA = "SELECT * from cetcal.cetcal_biodata;";
  const DELETE_FROM_BIODATA_WHERE_PKPRD = "DELETE FROM cetcal.cetcal_biodata WHERE fk_producteur=:pPk_producteur;";
  const SELECT_BIODATA_BY_FK_PRODUCTEUR = "SELECT * from cetcal.cetcal_biodata WHERE fk_producteur=:pPk_producteur;";
  
}