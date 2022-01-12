<?php
  ini_set('session.use_cookies', '0');
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<?php
$cetcal_session_id = "";
if (isset($_GET['sitkn']))
{
  $cetcal_session_id = htmlentities(htmlspecialchars($_GET['sitkn']));
  session_id($cetcal_session_id);
  include $_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.qstprod.const.globals.php';
  // 2 heure de Session côté serveur.
  ini_set('session.gc_maxlifetime', CetQstprodConstGlobals::session_life_span);
  // Les clients devront se souvenir de leurs Session ID durant le même lapse de temps :
  session_set_cookie_params(CetQstprodConstGlobals::session_life_span);
  session_start();
}

$reboot = isset($_GET['reboot']) && $_GET['reboot'] == "true";
$anr = isset($_GET['anr']) && $_GET['anr'] == "true";
$scope = $anr ? 'annuaire' : 'qstprod';
$tag_mep = "";
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$PHP_INCLUDES_PATH = $DOC_ROOT.'/src/app/includes/';
$PHP_CONST_PATH = $DOC_ROOT.'/src/app/const/';
$PHP_CONTROLLER_PATH = $DOC_ROOT.'/src/app/controller/';
$PHP_UTILS_PATH = $DOC_ROOT.'/src/app/utils/';

/**
 * Constantes globales de paramétrage app.
 */
// MODE Débug pour laisser passer les var dumps.
$MODE_DEBUG = strpos($_SERVER['REMOTE_ADDR'], "127.0.4") !== false;
// Afficher page de recettes.
$OPEN_PAGE_RECETTES = true;
// Si true, les producteurs non inscrits via questionnaire seront lues pour carto.
$SELECT_PRD_NON_INSCRITS = true;
// Si true, dialog de geoloc utilisateur s'affiche à l'entrée de l'app. Sinon rien ne se passe.
$CLIENT_CARTO_GEOLOCALISE = true;
// Cartographie paramétrable et filtres/recherche détaillée.
$CLIENT_CARTO_AVANCEE = false;
// Permettre ou non le login / signup
$OPEN_LOGIN_SIGNUP = true;

include $PHP_CONST_PATH.'cet.qstprod.const.listes.php';
require_once($PHP_UTILS_PATH.'cet.qstprod.utils.httpdataprocessor.php');
require_once($PHP_UTILS_PATH.'cet.qstprod.html.form.helper.php');
$formHelper = new HtmlFormHelper();
$dataProcessor = new HTTPDataProcessor();
include $PHP_UTILS_PATH.'cet.qstprod.utils.filereader.php';
$listes_arrays = new CetQstprodConstListes(new FileReaderUtils($DOC_ROOT));

/** ***************************************************************************
 * Etats post connection utilisateurs ou producteurs.
 * Utilisé pour libellés de connections et affichages entres autres.
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.login.php');
$cnx = (isset($_GET['cnx']) && !empty($_GET['cnx']) && is_numeric($_GET['cnx'])) ? $dataProcessor->processHttpFormData($_GET['cnx']) : false;
$obl = (isset($_GET['obl']) && !empty($_GET['obl']) && is_numeric($_GET['obl'])) ? $dataProcessor->processHttpFormData($_GET['obl']) : false;
$cnx_done = (is_numeric($cnx) && (
  intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE || 
  intval($cnx) === CetConnectionConst::CONNECTION_UTSR_REUSSIE));
/**************************************************************************** */

/**
 * Includes des libellés et contantes nécessaires aux formulaires.
 */
include $PHP_CONST_PATH.'cet.qstprod.const.textes.php';
include $PHP_CONST_PATH.'cet.qstprod.const.libelles.php';
include $PHP_UTILS_PATH.'cet.qstprod.utils.filarianne.php';
include $PHP_UTILS_PATH.'cet.qstprod.utils.navbar.helper.php';
?>