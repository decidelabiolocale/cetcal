<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();

$ntel = $dataProcessor->processHttpFormData($_POST['annuaire-contact-ntel']);
$email = $dataProcessor->processHttpFormData($_POST['annuaire-contact-email']);
$texte = $dataProcessor->processHttpFormData($_POST['annuaire-contact-problematique']);
$demande = $dataProcessor->processHttpFormData($_POST['annuaire-contact-obj']);
$objet = strcmp($demande, 'jesuisproducteur') === 0 ? 'Demande de prise de contact producteur' : 'Contact CET';

/**  envoyer email de contact cetcal. ***************************/
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.mailjet.helper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
$mailHelper = new CETMailjetHelper();
$mailSubject = $objet;
$params = [
  "[email]" => $email,
  "[ntel]" => $ntel,
  "[texte]" => $texte,
  "[objet]" => $objet
];
$mail_contact_cetcal = 'contact@decidelabiolocale.org';

// Mail client :
$mailHelper->send_paramsMultiples('cet.contact.html.mail.content.html', 
  'cet.contact.plain.mail.content', trim($email), $mailSubject, 
  new FileReaderUtils($_SERVER['DOCUMENT_ROOT']), 'contact/', $params);
// Mail cetcal :
$mailHelper->send_paramsMultiples('cet.contact.interne.html.mail.content.html', 
  'cet.contact.interne.plain.mail.content', $mail_contact_cetcal, $mailSubject, 
  new FileReaderUtils($_SERVER['DOCUMENT_ROOT']), 'contact/', $params);

header('Location: /?statut=contact.form&anr=true&etat=trt&txt='.$texte.'&em='.trim($email).'&ntp='.trim($ntel).'&demande=jesuisproducteur');
exit();