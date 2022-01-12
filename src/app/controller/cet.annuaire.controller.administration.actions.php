<?php
$cetcal_session_id = "";
try 
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/admin/cet.annuaire.controlleur.administration.entites.php');
  $subControlleur = new AdminEntitesCastillonnaisController();
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $cetcal_session_id = $dataProcessor->processHttpFormData($_GET['sitkn']);
  session_id($cetcal_session_id);
  session_start();
  
  /**
   * TODO : vérifier l'id de session.
   * Si l'id de session de la table cetcal.cetcal_administration ne
   * corrèspond pas à celui reçu depuis GET sitkn alors erreur et
   * rediriger vers la racine.
   */
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.cetcal.administrateur.model.php');
  $authModel = new CETCALAdminModel();
  $invalidAuth = $authModel->authTempSessionId($cetcal_session_id);
  if ($invalidAuth < 1) 
  {
    header("HTTP/1.0 403 Forbidden");
    exit();
  }

  $admin_data = $authModel->getAdministrateurBySessionId($cetcal_session_id);

  // Prepare traitement :
  $nav = $dataProcessor->processHttpFormData($_POST['admin_action_cible']);

  /** ***********************************************************************
   * La table cetcal.catcal_entite est traité ici :
   */
  if (strcmp($nav, 'insert-entite') === 0)
  {
  	$result = $subControlleur->insertEntite($_POST);
  	if (!$result) throw new Exception("Erreur sur insert administration entité.", 1);
  }
  else if (strcmp($nav, 'delete-entite') === 0)
  {
    $result = $subControlleur->deleteEntite($_POST);
    if (!$result) throw new Exception("Erreur sur suppression administration entité.", 1);
  }
  else if (strcmp($nav, 'update-entite') === 0)
  {
    $result = $subControlleur->updateEntite($_POST);
    if (!$result) throw new Exception("Erreur sur suppression mise à jour entité.", 1);
  }
  else if (strcmp($nav, 'get-entite') === 0)
  {
  	$pk = $dataProcessor->processHttpFormData($_POST['pkid']);
  	$subControlleur = new AdminEntitesCastillonnaisController();
  	$result = $subControlleur->selectByPk($pk);
  	echo json_encode($result);
	  exit;
  }
  else if (strcmp($nav, 'certif-bioab-prd') === 0)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
    $pk_prd = $dataProcessor->processHttpFormData($_POST['producteur-bioab-pk']);
    $url = $dataProcessor->processHttpFormData($_POST['producteur-bioab-url-org']);
    $num_certif = $dataProcessor->processHttpFormData($_POST['producteur-bioab-numcertif']);
    $subControlleur = new CertificationBioABProducteurController();
    $subControlleur->certifierProducteur($pk_prd, $url, $num_certif);
  }
  else if (strcmp($nav, 'certif-null-prd') === 0)
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
    $pk_prd = $dataProcessor->processHttpFormData($_POST['producteur-bioab-pk']);
    $subControlleur = new CertificationBioABProducteurController();
    $subControlleur->decertifierProducteur($pk_prd);
  }
  else if (strcmp($nav, 'sup-producteur') === 0)
  {
    $pk = $dataProcessor->processHttpFormData($_POST['pkid']);
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
    $prdmodel = new QSTPRODProducteurModel();
    $prdmodel->desactiverProducteurByPk($pk);
  }
  else if (strcmp($nav, 'admin-geoloc-prd') === 0)
  {
    $pk = $dataProcessor->processHttpFormData($_POST['producteur-geoloc-pkproducteur']);
    $geoloc = $dataProcessor->processHttpFormData($_POST['producteur-geoloc-coordonnees']);

    $latlng_array = null;
    try 
    {
      $latlng = trim($geoloc);
      $latlng = str_replace(" ", "", $latlng);
      $latlng = str_replace(",", ";", $latlng);
      $latlng_array = explode(';', $latlng);

      error_log("[UPDATE admin latlng ferme producteur] pk producteur=".$pk);
      error_log("[UPDATE admin latlng ferme producteur] coordonnees=".$geoloc);
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
      $crt_model = new CETCALCartographieModel();
      $crt_model->updateManuelLatLng($pk, $latlng_array);
    } 
    catch (Exception $e) 
    {
      error_log("[Administration UPDATE Error] pour mise a jour de geoloc. pk producteur=".$pk. " err=".$e->getMessage());
    }
  }
  else if (strcmp($nav, 'admin-geoloc-entite') === 0)
  {
    $pk = $dataProcessor->processHttpFormData($_POST['entite-geoloc-pkentite']);
    $geoloc = $dataProcessor->processHttpFormData($_POST['entite-geoloc-coordonnees']);
    $latlng_array = null;
    try 
    {
      $latlng = trim($geoloc);
      $latlng = str_replace(" ", "", $latlng);
      $latlng = str_replace(",", ";", $latlng);
      $latlng_array = explode(';', $latlng);

      error_log("[UPDATE admin latlng entite] pk entite=".$pk);
      error_log("[UPDATE admin latlng entite] coordonnees entite=".$geoloc);
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.cartographie.model.php');
      $crt_model = new CETCALCartographieModel();
      $crt_model->updateManuelLatLngEntite($pk, $latlng_array);
    } 
    catch (Exception $e) 
    {
      error_log("[Administration UPDATE Error] pour mise a jour de geoloc. pk producteur=".$pk. " err=".$e->getMessage());
    }
  }
  /* FIN traitement cetcal.cetcal_entite.
  ** ***********************************************************************/

  // Apply navigation :
  header('Location: /src/app/includes/administration/include.cet.administration.php/?sitkn='.$cetcal_session_id.'&admlog='.$admin_data['adm_email'].'&admpk='.$admin_data['adm_id'].'&refresh=true');
  exit();
}
catch (Exception $e) 
{
  session_write_close();
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}