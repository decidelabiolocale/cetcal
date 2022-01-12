<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PATH_MODEL = $DOC_ROOT.'/src/app/model/';
require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($PATH_MODEL.'cet.qstprod.producteurs.model.php');
$producteur_model = new QSTPRODProducteurModel();
$dataProcessor = new HTTPDataProcessor();

$pk = $dataProcessor->processHttpFormData($_GET['pk']);
$sitkn = $dataProcessor->processHttpFormData($_GET['sitkn']);
$usridf = $dataProcessor->processHttpFormData($_GET['usridf']);
$ancien_mdp = $dataProcessor->processHttpFormData($_GET['amdp']);
$nouveau_mdp = $dataProcessor->processHttpFormData($_GET['nvmdp']);
$nouveau_mdp_conf = $dataProcessor->processHttpFormData($_GET['nvmdpcnf']);

if (!isset($pk) || !isset($sitkn) || !isset($usridf) || 
    !isset($ancien_mdp) || !isset($nouveau_mdp) || !isset($nouveau_mdp_conf) ||
    empty($pk) || empty($sitkn) || empty($usridf) || 
    empty($ancien_mdp) || empty($nouveau_mdp) || empty($nouveau_mdp_conf))
{
  error_log("[CONTROL UPDATE MDP producteur] /!\ erreur sur saisies pour pk=".$pk);
  echo json_encode(['etat' => 'false', 'msg' => 'Données renseignées insuffisantes.']);
  exit();
}
else
{
  $outcome = $producteur_model->updateMdp($pk, $sitkn, $usridf, $ancien_mdp, $nouveau_mdp);
  if ($outcome === 1) 
  {
    // Envoi mail de confirmation.
    require_once($DOC_ROOT.'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
    require_once($DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
    $utils = new FormatUtils();
    $mailUtils = new CETMailjetHelper();
    $mailSubject = "Modification de votre mot de passe le ".$utils->getDateTimeFr();
    $mailUtils->send('cet.qstprod.mdfmdp.html.mail.content.html', 
      'cet.qstprod.mdfmdp.plain.mail.content', $usridf, $mailSubject, 
      new FileReaderUtils($DOC_ROOT), 'modifmdp/', '[email]', $usridf);
    error_log("[CONTROL UPDATE MDP producteur] OK pour pk producteur=".$pk);
    echo json_encode(['etat' => 'true', 'msg' => 'Votre mot de passe a été modifier avec succès. Un email de notification vient de vous être envoyé à l\'adresse '.$usridf]);
    exit();
  }
  else
  {
    error_log("[CONTROL UPDATE MDP producteur] /!\ erreur sur update MDP pour pk=".$pk);
    echo json_encode(['etat' => 'false', 'msg' => 'Les données renseignées ne permettent pas de mettre à jour votre mot de passe. Assurez-vous que votre ancien mot de passe soit correct.']);
    exit();
  }
}