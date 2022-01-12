<?php
$cetcal_session_id = NULL;

try 
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $mdp_administrateur = $dataProcessor->processHttpFormData($_POST['mdp_administrateur']);
  $login_administrateur = $dataProcessor->processHttpFormData($_POST['login_administrateur']);
    
  /**
   * Vérifier les correspondance loggin MDP (avec et après hashsage).
   * Utiliser SHA ou MD5 pour algorythmes de hashage.
   * /!\ Passer $authentification à FALSE par défault et seulement à TRUE si auth réussie.
   */ 
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
  $authModel = new CETCALAdminModel();
  $authentification = $authModel->exists($mdp_administrateur, $login_administrateur, $login_administrateur);
  
  if ($authentification === true) 
  {
    /*
     * Si auth réussie alors, générer un ID de session custom. 
     * Démarrer la session avec pour clé l'ID généré. Puis, 
     * sauvegarder le formulaire de loggin dans la session.
     * Si tout en ordre et pas d'exception levée alors naviguer ve, $login_administrateurrs 
     * /includes/administration/* 
     */ 

    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.identifiantcet.php');
    $idHelper = new IdentifiantCETHelper();
    $cetcal_session_id = (isset($_POST['cetcal_session_id']) && !empty($_POST['cetcal_session_id']) && strlen($_POST['cetcal_session_id']) > 0) ? $dataProcessor->processHttpFormData($_POST['cetcal_session_id']) : hash('sha1', $idHelper->generateRandomString().$idHelper->generateRandomString().$idHelper->generateRandomString());
    session_id($cetcal_session_id);
    session_start();
    session_write_close();

    // Mettre à jour cetcal.cetca.administration.
    $authModel->setTempSessionId($cetcal_session_id, $login_administrateur);
    $admin_data = $authModel->getAdministrateurBySessionId($cetcal_session_id);

    // Apply navigation :
    header('Location: /src/app/includes/administration/include.cet.administration.php/?sitkn='.$cetcal_session_id.'&admlog='.$login_administrateur.'&admpk='.$admin_data['adm_id']);
    exit();
  } 
  else 
  {
      header('Location: /index.php');
      exit();
  }
}
catch (Exception $e) 
{
  error_log('[CONTROLLER ADMIN FORM] '.$e->getMessage());
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err=err-authetification-administrateur');
  exit();
}