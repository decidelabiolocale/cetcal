<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();

$usrpk = isset($_GET['usrpk']) ? $dataProcessor->processHttpFormData($_GET['usrpk']) : false;
$pkent = isset($_GET['pkent']) ? $dataProcessor->processHttpFormData($_GET['pkent']) : false;
$sitkn = $dataProcessor->processHttpFormData($_GET['sitkn']);
$usridf = $dataProcessor->processHttpFormData($_GET['usridf']);
$cible = $dataProcessor->processHttpFormData($_GET['cible']);


if ($usrpk !== false && $pkent === false)
{
  // TDOO gestion sécurité : check sitkn, id, identifiant.
  // Si OK poursuivre vers cible.
  error_log('[CONTROLLER MEDIA Producteur] requete pour cible={'.$cible.'} pk='.$usrpk.'[sitkn='.$sitkn.'][identifiant='.$usridf.']');
  error_log('[CONTROLLER MEDIA Producteur] AUTH OK pour cible={'.$cible.'} pk='.$usrpk);

  /**
   * gérer le fichier ajouté.
   */
  $filesyst_dir = '/res/filesyst/'.$cible.'/'.$usrpk.'/';
  $target_file = $filesyst_dir.basename(date("Ymd_H:i:s").'_'.$_FILES['file']['name']);
  if (!file_exists($_SERVER['DOCUMENT_ROOT'].$filesyst_dir)) mkdir($_SERVER['DOCUMENT_ROOT'].$filesyst_dir, 0777);

  // écriture physique.
  if (file_exists($target_file))
  {
    error_log("[CONTROLLER MEDIA Producteur] ERREUR ecriture, le fichier existe deja dans le file system.");
    echo json_encode(['etat' => 'false', 
      'msg' => 'Une erreur est survenue lors du téléchargement car le fichier existe déjà.']);
    exit();
  }
  else
  {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$target_file)) 
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
      $model = new QSTPRODMediaModel();
      $path_info = pathinfo($target_file);
      $model->insertMediaProducteur("", "img", $path_info['extension'], $target_file, $cible, $usrpk);
      error_log("[CONTROLLER MEDIA Producteur] ecriture et insert cetcal_media OK");
      echo json_encode(['etat' => 'true', 'msg' => 'Fichier ajouté avec succès.']);
      exit();
    }
    else 
    {
      error_log("[CONTROLLER MEDIA Producteur] impossible d ecrire le fichier=".$_FILES['file']['tmp_name']);
      echo json_encode(['etat' => 'false', 'msg' => 'Une erreur est survenue lors du téléchargement.']);
      exit();
    }
  }
}
else if ($usrpk === false && $pkent !== false)
{
  error_log('[CONTROLLER MEDIA Entite] requete pour cible={'.$cible.'} pkent='.$pkent.'[sitkn='.$sitkn.']');

  /**
   * gérer le fichier ajouté.
   */
  $filesyst_dir = '/res/filesyst/'.$cible.'/'.$pkent.'/';
  $target_file = $filesyst_dir.basename(date("Ymd_H:i:s").'_'.$_FILES['file']['name']);
  if (!file_exists($_SERVER['DOCUMENT_ROOT'].$filesyst_dir)) mkdir($_SERVER['DOCUMENT_ROOT'].$filesyst_dir, 0777);

  // écriture physique.
  if (file_exists($target_file))
  {
    error_log("[CONTROLLER MEDIA Entite] ERREUR ecriture, le fichier existe deja dans le file system.");
    echo json_encode(['etat' => 'false', 
      'msg' => 'Une erreur est survenue lors du téléchargement car le fichier existe déjà.']);
    exit();
  }
  else
  {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$target_file)) 
    {
      require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.media.model.php');
      $model = new QSTPRODMediaModel();
      $path_info = pathinfo($target_file);
      $model->insertMediaEntite("", "img", $path_info['extension'], $target_file, $cible, $pkent);
      error_log("[CONTROLLER MEDIA Entite] ecriture et insert cetcal_media OK");
      echo json_encode(['etat' => 'true', 'msg' => 'Fichier ajouté avec succès.']);
      exit();
    }
    else 
    {
      error_log("[CONTROLLER MEDIA Entite] impossible d ecrire le fichier=".$_FILES['file']['tmp_name']);
      echo json_encode(['etat' => 'false', 'msg' => 'Une erreur est survenue lors du téléchargement.']);
      exit();
    }
  }
}
else
{
  error_log("[CONTROL MEDIA ?] erreur : impossible de definir l element a supprimer.");
  echo json_encode(['etat' => 'false', 'msg' => 'Erreur sur aiguillage de votre demande.']);
  exit();
}