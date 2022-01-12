<?php
require_once('cet.controller.login.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.login.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/exceptions/cet.login.impossible.exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/exceptions/cet.renouvellement.mdp.impossible.exception.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.annuaire.user.model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
$dataProcessor = new HTTPDataProcessor();
$user_model = new CETCALUserModel();
$producteur_model = new QSTPRODProducteurModel();
$loginctrl = new LoginController();
error_log("{{{LOGIN CONNEXION CAL:".$dataProcessor->processHttpFormData($_POST['login-email'])."}}}");

/**
 * les cas de navigation possibles pour nav : 
 * cnx = connection, prd = je suis producteur et souhaite m'inscrire, obl = oubli mdp ou id.
 */
$nav = $dataProcessor->processHttpFormData($_POST['login-nav']);
$client_ip = 
$cetcal_session_id = '';
$param_get_sitkn = '';
$param_clitype = '';

if (strcmp($nav, 'obl') === 0)
{
  $email = $dataProcessor->processHttpFormData($_POST['login-oublie-email']);
  $telp = $dataProcessor->processHttpFormData($_POST['login-oublie-telport']);
  $jesuisproducteur = isset($_POST['login-oublie-jesuisproducteur']) && strcmp($dataProcessor->processHttpFormData($_POST['login-oublie-jesuisproducteur']), 'jesuisproducteur') === 0 ? true : false;

  /**
   * cas de demande de contact producteur pour le dépatouiller. Redirection en passant email
   * et numéro de téléphone portable prérempli.
   */
  if ($jesuisproducteur) 
  {
    header('Location: /?statut=contact.form&anr=true&em='.trim($email).'&ntp='.trim($telp).'&demande=jesuisproducteur'); 
    exit();
  }

  try
  {
    if ($loginctrl->isNotSetForCheck(trim($email))) throw new ResetEnvoiMdpImpossibleException(
      sprintf(CetConnectionConst::ETATS[CetConnectionConst::EMAIL_INCONNU], $email));

    /**
     * Soit le producteur est trouvé sur la base de son adresse email ou identifiant_cet.
     * Dans ce cas, facile : update mdp + envoi de mail avec mot de passe généré - fait. Le
     * producteur pourras ensuite de logger et modifier sont contenu.
     * 
     * Soit le producteur est trouvé mais non inscrit : dans ce cas il faut qu'il passe par 
     * l'inscription et un mot de passe sera saisie + identifient_cet généré.
     * 
     * Sinon, le login est inconnu et aucune correspondance alors soit c'est un producteur 
     * inscrit mais qui essaye de se connecter avec un autre mail ou n° de téléphone, soit c'est
     * un producteur non inscrit, soit c'est un utilisateur non inscrit. 
     * Dans tous les cas : inscription absolument indispensable : aucun envoi de mail et/ou 
     * génération d'identifiant_cet.
     */
    $outcome = $loginctrl->renouvellementMdpCheckClient(trim($email));
  }
  catch (ResetEnvoiLoginImpossibleException $rELIe)
  {
    error_log('ResetEnvoiLoginImpossibleException '.$rELIe->getMessage());
    $outcome = CetConnectionConst::HTTP_FORBIDDEN;
  }
  catch (Exception $e)
  {
    error_log('Exception '.$e->getMessage());
    $outcome = CetConnectionConst::HTTP_FORBIDDEN;
  }
  finally
  {
    if (intval($outcome) === CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK || 
        intval($outcome) === CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK)
    {
      /**
       * Générer un mdp temporaire. Avec l'email trouvé en correspondance,
       * envoyer le mail de reinitialisation. Si envoi mail sans erreurs (et
       * seulement dans ce cas) alors update de la table user ou producteur pour
       * affecter le nouveau mot de passe temporaire.
       */
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
      $idHelper = new IdentifiantCETHelper();
      $mdp_tmp = $idHelper->generateRandomString();

      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
      $mailHelper = new CETMailjetHelper();
      $mailSubject = "Renouvellement de votre mot de passe";
      $reset_done = $mailHelper->send('cet.user.renouvellement.html.mail.content.html', 
        'cet.user.renouvellement.plain.mail.content', trim($email), $mailSubject, 
        new FileReaderUtils($_SERVER['DOCUMENT_ROOT']), 'renouvellement/', '[idcetwww]', $mdp_tmp);

      error_log('[CONTROL LOGIN] mail envoye pour nouveau mdp pour email='.$email.' etat='.$reset_done);
      if ($reset_done) 
      {
        if (intval($outcome) === CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK) 
        {
          error_log('[CONTROL LOGIN] update nouveau mdp pour utilisateur email='.$email);
          $user_model->updateMdpByEmail(trim($email), $mdp_tmp);
        }
        else if (intval($outcome) === CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK) 
        {
          error_log('[CONTROL LOGIN] update nouveau mdp pour producteur email='.$email);
          $producteur_model->updateMdpByEmail(trim($email), $mdp_tmp);
        }
      }
    }

    header('Location: /?'.$nav.'='.$outcome.'&usridf='.trim($email)); 
    exit();
  }
}
else if (strcmp($nav, 'cnx') === 0)
{
  /**
   * Ici, on gère les demande de type cnx=connections.
   * Deux types de clients possible à ce jour (février 2021) : producteurs ou utilisateurs.
   * A noter que les producteurŝ peuvent se connecter avec leurs identifiant_cet, les 
   * utilisateurs ne le peuvent pas (email uniquement).
   */
  $email = $dataProcessor->processHttpFormData($_POST['login-email']);
  $mdp = $dataProcessor->processHttpFormData($_POST['login-motdepasse']);

  try
  {
    if ($loginctrl->isNotSetForCheck(trim($email))) throw new LoginImpossibleException(
      sprintf(CetConnectionConst::ETATS[CetConnectionConst::EMAIL_INCONNU], $email));
    if ($loginctrl->isNotSetForCheck(trim($mdp))) throw new LoginImpossibleException(
      sprintf(CetConnectionConst::ETATS[CetConnectionConst::EMAIL_INCONNU], $mdp));

    $outcome = $loginctrl->controlLogin(trim($email), trim($mdp));
  }
  catch (LoginImpossibleException $lIe)
  {
    error_log($lIe->getMessage());
    $outcome = CetConnectionConst::HTTP_FORBIDDEN;
  }
  catch (Exception $e)
  {
    error_log($e->getMessage()); 
    $outcome = CetConnectionConst::HTTP_FORBIDDEN;
  }
  finally
  {
    if (intval($outcome) === CetConnectionConst::CONNECTION_UTSR_REUSSIE || 
        intval($outcome) === CetConnectionConst::CONNECTION_PRD_REUSSIE)
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
      $idHelper = new IdentifiantCETHelper();
      $cetcal_session_id = hash('sha1', $idHelper->generateRandomString().$idHelper->generateRandomString().$idHelper->generateRandomString());
      session_id($cetcal_session_id);
      session_start();
      session_write_close();

      if (intval($outcome) === CetConnectionConst::CONNECTION_UTSR_REUSSIE) 
      {
        $user_pk = $user_model->fetchPKByEmailAndPWD(trim($email), trim($mdp));
        $user_ip = $user_model->getClientIP();
        $user_model->setTempSessionId($cetcal_session_id, $user_ip, $user_pk);
        $param_clitype = '&clitype=usr';
        $param_usrpk = '&usrpk='.$user_pk;
      }
      else if (intval($outcome) === CetConnectionConst::CONNECTION_PRD_REUSSIE) 
      {
        $producteur_pk = $producteur_model->fetchPKByEmailORIDwwwCETAndPWD(trim($email), trim($mdp));
        $productuer_ip = $producteur_model->getClientIP();
        $producteur_model->setTempSessionId($cetcal_session_id, $productuer_ip, $producteur_pk);
        $param_clitype = '&clitype=prd';
        $param_usrpk = '&usrpk='.$producteur_pk;
      }   

      $param_get_sitkn = '&sitkn='.$cetcal_session_id;
    }

    header('Location: /?'.$nav.'='.$outcome.$param_usrpk.'&usridf='.$email.$param_clitype.$param_get_sitkn); 
    exit();
  }
}
else if (strcmp($nav, 'prd') === 0 || $nav === NULL)
{
  /**
   * Simple lien vers l'inscription et questionnaire producteur. 
   * Obligation de le laisser en place car fait comme tel historiquement.
   */
  $statut = 'signupgen.form';
  header('Location: /?statut='.$statut);
  exit();
}
else
{
  header('Location: /?');
  exit();
}