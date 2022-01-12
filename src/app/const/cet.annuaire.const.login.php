<?php 
/**
 * Constantes de connection.
 */
Class CetConnectionConst
{
  const HTTP_FORBIDDEN = 403;

  const CONNECTION_PRD_REUSSIE  = 20;
  const MODIFICATION_QSTPROD_REUSSIE  = 21;
  const CONNECTION_UTSR_REUSSIE = 10;
  const RENOUVELLEMENT_MDP_PRD_OK = 19;
  const RENOUVELLEMENT_MDP_UTSR_OK = 9;
  const EMAIL_INCONNU = 0;
  const CRITIQUE_PLUSIEURS_IDENTIFIANTS_PRODUCTEURS = 1;
  const CRITIQUE_PLUSIEURS_IDENTIFIANTS_UTILISATEURS = 11;
  const AUTH_REFUSEE = 2;

  const ETATS = [
    CetConnectionConst::EMAIL_INCONNU => 
      "Email inconnu.",
    CetConnectionConst::CONNECTION_PRD_REUSSIE => 
      "Authentification réussie. Bienvenu Producteur.e.s !",
    CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK => 
      "Renouvellement de mot de passe producteur réussie.",
    CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_PRODUCTEURS => 
      "|!!! Erreur critique !!!| Plusieurs producteurs trouves pour l'identifiant=%s",
    CetConnectionConst::AUTH_REFUSEE => 
      "|??? Authentification impossible pour login=%s - pas de correspondance en base. ???|",
    CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_UTILISATEURS => 
      "|!!! Erreur critique !!!| Plusieurs utilisateurs trouves pour l'identifiant=%s",
    CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK => 
      "Renouvellement de mot de passe utilisateur réussie.",
    CetConnectionConst::CONNECTION_UTSR_REUSSIE => 
      "Authentification réussie. Bienvenu !"
  ];

}