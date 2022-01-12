<?php
/**
 * LIEN pour MAIL test = http://127.0.0.4/src/app/admin/cet.qstprod.admin.mail.php?mhtmlfl=cet.qstprod.inscription.html.mail.content.html&mplainfl=cet.qstprod.inscription.plain.mail.content&mlstfl=cet.qstprod.maillist.equipe.cet&msbj=cet.qstprod.inscription.mail.subject&prfx=inscription
 *
 * LIEN pour MAIL production = http://127.0.0.4
/src/app/admin/cet.qstprod.admin.mail.php?mhtmlfl=cet.qstprod.inscription.html.mail.content.html&mplainfl=cet.qstprod.inscription.plain.mail.content&mlstfl=maillist.tmp&msbj=cet.qstprod.inscription.mail.subject&prfx=inscription
 */

// annuaire-cet@outlook.fr
// prénom : annuaire
// nom : cet
// 01/01/2000

$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$errparamsget = (isset($_GET['mhtmlfl']) && isset($_GET['mplainfl']) && 
  isset($_GET['mlstfl']) && isset($_GET['msbj']) && isset($_GET['prfx']));
$errsending = false;
include $DOC_ROOT.'/src/app/utils/cet.qstprod.utils.mail.php';
include $DOC_ROOT.'/src/app/utils/cet.qstprod.utils.filereader.php';

try
{
  $mailUtils = new CETQstprodMailUtils();
  $mailHtmlFile = $_GET['mhtmlfl'];
  $mailPlainFile = $_GET['mplainfl'];
  $mailList = $_GET['mlstfl'];
  $mailSubject = $_GET['msbj'];
  $prefix = $_GET['prfx'];
  $mailUtils->init(true);
  $mailUtils->send($mailHtmlFile, $mailPlainFile, $mailList, 
    $mailSubject, new FileReaderUtils($DOC_ROOT), $prefix."/");
}
catch (Exception $e) 
{
  $errsending = true;
  var_dump($e);
}
?>
