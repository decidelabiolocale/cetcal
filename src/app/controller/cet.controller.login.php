<?php
require_once('cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/exceptions/cet.login.impossible.exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.login.php');

/**
 * Controlleur de gestion de tous les scénarios de login.
 */
Class LoginController extends AnnuaireController
{

  function __construct() { }

  public function isNotSetForCheck($data) 
  {
    if (isset($data) === false || empty($data) || $data === " " || $data === "") return true;
    else return false;
  }

  /**
   * Retourne true si OK et si l'ouverture session peut être géré par le controlleur appelant.
   * Sinon retourne false si données de login insufisantes ou erronées ou toute 
   * autre raison dont le dénoument est login refusé.
   */
  public function controlLogin($login, $mdp)
  {
    $etat = CetConnectionConst::EMAIL_INCONNU;
    $logedin = false;

    /**
     * Cas 1 : utilisateur.
     * Cas 2 : producteur inscrit.
     */
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.user.model.php');
    $mdl = new QSTPRODProducteurModel();
    $mdl_user = new CETCALUserModel();
    $producteur = $mdl->fetchProducteurByEmailOrIdWWWCET($login);
    $user = $mdl_user->fetchUserByEmail($login);
    
    if ($logedin === false)
    {
      // Cas 1.
      if (count($user) > 1) $etat = CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_UTILISATEURS;
      if (empty($user) || !isset($user) || count($user) === 0) $etat = CetConnectionConst::AUTH_REFUSEE;
      if (count($user) === 1 && strcmp($user[0]['user_usr_mdp'], hash('sha256', $mdp)) === 0) 
      {
        $etat = CetConnectionConst::CONNECTION_UTSR_REUSSIE; 
        $logedin = true;   
      }
    }

    if ($logedin === false)
    {
      // Cas 2.
      if (count($producteur) > 1) $etat = CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_PRODUCTEURS;
      if (empty($producteur) || !isset($producteur) || count($producteur) === 0) $etat = CetConnectionConst::AUTH_REFUSEE;
      if (count($producteur) === 1 && strcmp($producteur[0]['mdpsha'], hash('sha256', $mdp)) === 0) 
      {
        $etat = CetConnectionConst::CONNECTION_PRD_REUSSIE;
        $logedin = true;   
      }
    }

    if ($etat !== CetConnectionConst::CONNECTION_PRD_REUSSIE && 
        $etat !== CetConnectionConst::CONNECTION_UTSR_REUSSIE && 
        $etat > CetConnectionConst::EMAIL_INCONNU) throw new LoginImpossibleException(
      sprintf(CetConnectionConst::ETATS[$etat], $login));

    return $etat;
  }

  /**
   * Si données de connection oubliés, alors chercher qui.
   * Communiquer données de connection temporaires.
   * Si tout se passe bien, retourner true. 
   * Si un élément nécessite une trace dans les logs, logger.
   */
  public function renouvellementMdpCheckClient($login)
  {
    $etat = CetConnectionConst::EMAIL_INCONNU;
    $found = false;
    $contact_mail = '';

    /**
     * Cas 1 : utilisateur.
     * Cas 2 : producteur inscrit.
     * Cas 3 : producteur pré-inscrit avec email renseigné. NON ENCORE IMPLEMENTE.
     */
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.user.model.php');
    $mdl = new QSTPRODProducteurModel();
    $mdl_user = new CETCALUserModel();
    $producteur = $mdl->fetchProducteurByEmailOrIdWWWCET($login);
    $user = $mdl_user->fetchUserByEmail($login);

    if ($found === false)
    {
      // Cas 1.
      if (count($user) > 1) $etat = CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_UTILISATEURS;
      if (empty($user) || !isset($user) || count($user) === 0) $etat = CetConnectionConst::AUTH_REFUSEE;
      if (count($user) === 1 && strcmp($user[0]['user_email'], $login) === 0) 
      {
        $etat = CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK;
        $found = true;
        $contact_mail = $user[0]['user_email'];
      }
    }

    if ($found === false)
    {
      // Cas 2.
      if (count($producteur) > 1) $etat = CetConnectionConst::CRITIQUE_PLUSIEURS_IDENTIFIANTS_PRODUCTEURS;
      if (empty($producteur) || !isset($producteur) || count($producteur) === 0) $etat = CetConnectionConst::AUTH_REFUSEE;
      if (count($producteur) === 1 && strcmp($producteur[0]['email'], $login) === 0) 
      {
        $etat = CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK;
        $found = true;  
        $contact_mail = $producteur[0]['email']; 
      }
    }

    if ($found === false)
    {
      /**
       * Cas 3. producteur pré-inscrit avec email renseigné. NON ENCORE IMPLEMENTE.
       * à implémenter si souhaité.
       * Dans ce cas : si email pré-inscrit trouvé alors créer un MDP et notifier par email.
       * Sinon, le dénouement doit rediriger vers le formulaire de contact "je suis prd référencé
       * mais je n'arrive pas à me connecter".
       */
    }

    if ($etat !== CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK && 
        $etat !== CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK && 
        $etat >= CetConnectionConst::EMAIL_INCONNU) throw new ResetEnvoiMdpImpossibleException(
      sprintf(CetConnectionConst::ETATS[$etat], $login));

    return $etat;
  }

}