<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL_DTO = $DOC_ROOT.'/src/app/model/';
$cetcal_session_id = "";
$data = array();
try 
{
  require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signuprecap-nav']);
  $context = $dataProcessor->processHttpFormData($_POST['qstprod-signuprecap-cntx']);
  $pk_producteur = $dataProcessor->processHttpFormData($_POST['qstprod-signuprecap-pkprd']);
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  $form_opinions = $dataProcessor->processHttpFormData($_POST['qstprod-opinions-producteur']);
  $form_email = $dataProcessor->processHttpFormData($_POST['qstprod-signuprecap-email']);

  // Prepare navigation :
  if ($nav != 'valider' && $nav != 'retour') { /*Error de navigation TODO.*/ $nav = 'retour'; }
  $statut = $nav == 'valider' ? 'signupeffectue.form' : 'signupbesoins.form';

  if ($nav == 'valider')
  {
    /** ***************************************************************************
     * Time to insert it all from SESSION to DB.
     */
    require_once($DOC_ROOT.'/src/app/exceptions/cet.email.deja.present.exception.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.producteurs.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.lieuxdist.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.produits.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.questionnaire.sondage.producteur.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.informations.model.php');
    require_once($PATH_MODEL_DTO.'cet.qstprod.cartographie.model.php');
    require_once($PATH_MODEL_DTO.'cet.annuaire.user.model.php');
    $model = new QSTPRODProducteurModel();
    $model_user = new CETCALUserModel(); 

    session_id($cetcal_session_id);
    session_start();
    
    /**
     * Cette ligne est importante en cas de super adiminsitration des données producteurs.
     * Dans ce cas, il NE FAUT SURTOUT PAS adresser l'email de notification au producteur.
     */
    $CONTEXTE_MODIF_GLOBAL_SUPERADMIN = isset($_SESSION['CONTEXTE_MODIF-GLOBAL-SUPERADMIN']) && $_SESSION['CONTEXTE_MODIF-GLOBAL-SUPERADMIN'] == true ? true : false;
    error_log('[CONTROL SIGNUPRECAP] CONTEXTE_MODIF_GLOBAL_SUPERADMIN='.($CONTEXTE_MODIF_GLOBAL_SUPERADMIN ? 'true' : 'false'));

    /**
     * Garde fou : si toute fois, et à ce stade, l'email est déjà existant en 
     * base de donnée et associé à un compte producteur (inscrit ou préinscrit)
     * alors retourner à l'index via lancement d'exception et signaler. 
     * Toutes saisies perdues. Cas exceptionnel.
     */
    $context_mdif_global = isset($_SESSION['CONTEXTE_MODIF-GLOBAL']) && $_SESSION['CONTEXTE_MODIF-GLOBAL'] == true ? true : false;
    error_log('[CONTROL SIGNUPRECAP] verification unicite email='.$form_email.' pk='.$pk_producteur.' cntx='.$context.' cntx_global='.$context_mdif_global);
    if (($context_mdif_global === false && $model->emailExists($form_email) !== 0) ||
        ($context_mdif_global === true && $model->emailExistsSurAutrePk($form_email, $pk_producteur) !== 0) ||
         $model_user->existsByEmail($form_email) === true)
    {
      throw new EmailDejaExistantException('Un compte producteur est déjà associé à l\'adresse email '.
        $form_email.' renseigné. Votre demande ne peut aboutir.');
    }

    $data = $model->gestionEnvoiQstprod(isset($_SESSION['signupgen.form']) ? $_SESSION['signupgen.form'] : NULL,
      isset($_SESSION['signupprods.form']) ? $_SESSION['signupprods.form'] : NULL,
      isset($_SESSION['signupconso.form']) ? $_SESSION['signupconso.form'] : NULL,
      $form_opinions, $context_mdif_global, $pk_producteur);
    $email_producteur = $data['ev'];
    $model = new QSTPRODLieuModel();
    $model->gestionEnvoiQstprod($data['pk'], 
      isset($_SESSION['signuplieuxdist.form']) ? $_SESSION['signuplieuxdist.form'] : NULL,
      $context_mdif_global, $pk_producteur);
    $model = new QSTPRODProduitsModel();
    $model->gestionEnvoiQstprod($data['pk'], isset($_SESSION['signupprods.form']) ? $_SESSION['signupprods.form'] : NULL, 
      $context_mdif_global, $pk_producteur);
    $model = new QSTPRODSondageProducteurModel();
    $model->gestionEnvoiQstprod($data['pk'], isset($_SESSION['signupgen.form']) ? $_SESSION['signupgen.form'] : NULL, 
      $context_mdif_global, $pk_producteur);
    $model = new QSTPRODInformationsModel();
    $model->gestionEnvoiQstprod($data['pk'], isset($_SESSION['signupbesoins.form']) ? $_SESSION['signupbesoins.form'] : NULL, $context_mdif_global, $pk_producteur);
    
    /**
     * Si contexte de mdif :
     * Finallement, delete de l'entrée cetcal_cartographie pour nouvelle requête API dans le 
     * module de cartographie automatisé. Sans cela, l'adresse potentiellement modifiée ne 
     * sera pas prise en compte pour mappiing des données latitude longitude.
     */
    $model = new CETCALCartographieModel();
    if ($context_mdif_global === true) $model->deleteProducteur($pk_producteur);
    
    session_write_close();

    if ($context_mdif_global === false)
    {
      /** Contexte d'inscription (première inscription) uniquement. */
      /** ***************************************************************************
       ** Database inserts done with success, ***************************************
       *  send email de confirmation inscription anuaire. ***************************/
      require_once($DOC_ROOT.'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
      require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php');
      $mailUtils = new CETMailjetHelper();
      $mailSubject = "Inscription Annuaire enregistrée, bienvenue Producteur.e.s.";
      $mailUtils->send('cet.qstprod.signup.html.mail.content.html', 
        'cet.qstprod.signup.plain.mail.content', $data['ev'], $mailSubject, 
        new FileReaderUtils($DOC_ROOT), 'signup/', 'idcetwww', $data['idcetwww']);

      // Apply navigation :
      header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id.'&ev='.(isset($data['ev']) ? $data['ev'] : "").'&idfcet='.(isset($data['idcetwww']) ? $data['idcetwww'] : ""));
    }
    else if ($context_mdif_global === true)
    {
      /**
       * Contexte de modification questionnaire (première ou n-ième modification).
       * Traiter la session qui n'a plus lieu d'être. Notifier par mail. Finallement, 
       * naviguer vers l'index et notifier sur le bloc producteur.
       * 
       * N'envoyer le mail au producteur QUE si CONTEXTE_MODIF_GLOBAL_SUPERADMIN en 
       * session=TRUE (et donc qu'un super admin est à l'origine des modifications).
       */
      require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.sessionshelper.php');
      require_once($DOC_ROOT.'/src/app/const/cet.annuaire.const.login.php');
      $sessionHelper = new SessionHelper($DOC_ROOT);
      $sessionHelper->unsetSessionUpdateContext($cetcal_session_id);
      $sessionHelper->unsetSessionUpdateContextSuperAdmin($cetcal_session_id);

      if ($CONTEXTE_MODIF_GLOBAL_SUPERADMIN === false)
      {
        error_log('[CONTROL SIGNUPRECAP] Envoi email de notification a '.$email_producteur);
        require_once($DOC_ROOT.'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
        require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php');
        $mailUtils = new CETMailjetHelper();
        $mailSubject = "Mise à jour de vos données sur l'annuaire cetcal.";
        $mailUtils->send('cet.qstprod.modification.html.mail.content.html', 
          'cet.qstprod.signup.plain.mail.content', $email_producteur, $mailSubject, 
          new FileReaderUtils($DOC_ROOT), 'modification_questionnaire/', 'idcetwww', $data['idcetwww']);

        /*
         * Contexte de mdif global, mais pas par un super admin (par le producteur lui même donc).
         * Passer ce producteur en prod_inscrit = true. Active = 1, mise à jour de identifiant_cet.
         * Nécessaire en cas de première modification par un producteur pré-inscrit et donc ne 
         * possédant pas d'identifiant_cet, ne possédant pas de prod_inscrit = true et potentiellement
         * prod_active = 0.
         */
        $model = new QSTPRODProducteurModel();
        $model->updateStatutInscrit($pk_producteur, 'true', 1, $data['idcetwww']);
        error_log('[CONTROL SIGNUPRECAP] producteur update etat inscrit. Contexte mdif producteur pk='.$pk_producteur);

        error_log('[CONTROL SIGNUPRECAP] mdif informations producteur OK pour pk='.$pk_producteur);
        header('Location: /?cnx='.CetConnectionConst::CONNECTION_PRD_REUSSIE.'&usrpk='.$pk_producteur.'&clitype=prd&cnxmsg='.CetConnectionConst::MODIFICATION_QSTPROD_REUSSIE.'&usridf='.$email_producteur.'&sitkn='.$cetcal_session_id);
      }
      else
      {
        /*
         * Passer ce producteur en prod_inscrit = 'amdif' pour modification par admin.
         * Le statut 'amdif' engendre une prise en compte de l'adresse dans la géolocalisation
         * et le process de cartographie.
         * Dans le cas précis ou l'admin prend la main et fait des modifs sur un producteur pré-inscrit 
         * ayant modifier et déclaré ses données (et donc passé inscrit = true), alors même si mise à jour 
         * admin, laisser prod_inscrit = true (le producteur a déclaré et s'est inscrit).
         */
        $model = new QSTPRODProducteurModel();
        $prod_inscrit = $model->findProducteurByPk($pk_producteur)['prod_inscrit'];
        $etat_prod_inscrit = strcmp($prod_inscrit, 'true') === 0 ? 'true' : 'amdif';
        $model->updateStatutInscrit($pk_producteur, $etat_prod_inscrit, 1, $data['idcetwww']);

        error_log('[CONTROL SIGNUPRECAP] producteur update etat inscrit. Contexte mdif SUPER ADMIN');
        header('Location: /?super-admin=administration_producteur_OK_pour_prd-id_'.$pk_producteur);
      }
    }
  }
  else
  {
    header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  }

  exit();
}
catch (EmailDejaExistantException $eDEe) 
{
  error_log('[CONTROL SIGNUPRECAP EmailDejaExistantException] '.$eDEe->getMessage());
  session_write_close();
  header('Location: /?statut='.$statut.'&err=eused&uemail='.$form_email.'&sitkn='.$cetcal_session_id);
  exit();
}
catch (Exception $e) 
{
  error_log('[CONTROL SIGNUPRECAP Exception] '.$e->getMessage());
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}