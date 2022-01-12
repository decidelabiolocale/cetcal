<?php
$cetcal_session_id = "";

try 
{
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
  $dataProcessor = new HTTPDataProcessor();
  $cetcal_session_id = $dataProcessor->processHttpFormData($_POST['cetcal_session_id']);
  session_id($cetcal_session_id);
  session_start();
  
  // Prepare navigation :
  $nav = $dataProcessor->processHttpFormData($_POST['qstprod-signupprods-nav']);
  if ($nav != 'valider' && $nav != 'retour') 
  {
    /*Error de navigation TODO.*/ $nav = 'retour';
  }
  $statut = $nav == 'valider' ? 'signupconso.form' : 'signuplieuxdist.form';
  /* *****************************************************************************/
  /* HTTP POST : var setup : *****************************************************/
  // POST form logic - dans l'ordre du formulaire HTML :
  $form_typescultures = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-typescultures']) ? $_POST['qstprod-typescultures'] : NULL);
  $form_typescultureAutre = $dataProcessor->processHttpFormData($_POST['qstprod-typeculture-autre']);
  $form_legumes = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-legumes']) ? $_POST['qstprod-produits-legumes'] : NULL);
  $form_legumeAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-legume-autre']);
  $form_viandes = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-viandes']) ? $_POST['qstprod-produits-viandes'] : NULL);
  $form_viandeAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-viande-autre']);
  $form_laitiers = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-laitiers']) ? $_POST['qstprod-produits-laitiers'] : NULL);
  $form_laitierAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-laitier-autre']);
  $form_mielsruches = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-mielsruches']) ? $_POST['qstprod-produits-mielsruches'] : NULL);
  $form_mielsrucheAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-mielruche-autre']);
  $form_fruits = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-fruits']) ? $_POST['qstprod-produits-fruits'] : NULL);
  $form_fruitAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-fruit-autre']);
  $form_champignons = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-champignons']) ? $_POST['qstprod-produits-champignons'] : NULL);
  $form_champignonAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-champignon-autre']);
  $form_boissons = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-boissons']) ? $_POST['qstprod-produits-boissons'] : NULL);
  $form_boissonAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-boisson-autre']);
  $form_plantes = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-plantes']) ? $_POST['qstprod-produits-plantes'] : NULL);
  $form_planteAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-plante-autre']);
  $form_semences = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-semences']) ? $_POST['qstprod-produits-semences'] : NULL);
  $form_semenceAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-semence-autre']);
  $form_transformes = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-transformes']) ? $_POST['qstprod-produits-transformes'] : NULL);
  $form_transformeAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-transforme-autre']);
  $form_cereales = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-cereales']) ? $_POST['qstprod-produits-cereales'] : NULL);
  $form_cerealeAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-cereale-autre']);
  $form_hygienes = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-hygienes']) ? $_POST['qstprod-produits-hygienes'] : NULL);
  $form_hygieneAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-hygiene-autre']);
  $form_entretiens = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-entretiens']) ? $_POST['qstprod-produits-entretiens'] : NULL);
  $form_entretienAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-entretien-autre']);
  $form_animaux = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-animaux']) ? $_POST['qstprod-produits-animaux'] : NULL);
  $form_animauxAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-animal-autre']);
  $form_poissons = $dataProcessor->processHttpFormArrayData(
    isset($_POST['qstprod-produits-poissons']) ? $_POST['qstprod-produits-poissons'] : NULL);
  $form_poissonAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-poisson-autre']);
  $form_autreAutre = $dataProcessor->processHttpFormData($_POST['qstprod-produit-autre-autre']);

  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
  $dtoProdProduits = new QstProduitDTO($form_typescultures, $form_typescultureAutre, $form_legumes, $form_legumeAutre, $form_viandes, $form_viandeAutre, 
    $form_laitiers, $form_laitierAutre, $form_mielsruches, 
    $form_mielsrucheAutre, $form_fruits, $form_fruitAutre, $form_champignons,
    $form_champignonAutre, $form_plantes, $form_planteAutre, $form_semences,
    $form_semenceAutre, $form_transformes, $form_transformeAutre, 
    $form_cereales, $form_cerealeAutre, $form_hygienes, $form_hygieneAutre,
    $form_entretiens, $form_entretienAutre, $form_animaux, 
    $form_animauxAutre, $form_autreAutre, $form_boissons, $form_boissonAutre, 
    $form_poissons, $form_poissonAutre);
  $_SESSION['signupprods.form'] = serialize($dtoProdProduits);

  $_SESSION['signupprods.form.post'] = $_POST;
  $_SESSION['CONTEXTE_MODIF-signupprods'] = false;
  session_write_close();
  /* *****************************************************************************/

  // Apply navigation :
  header('Location: /?statut='.$statut.'&sitkn='.$cetcal_session_id);
  exit();
}
catch (Exception $e) 
{
  session_write_close();
  header('Location: /src/app/controller/cet.qstprod.controller.generique.erreure.php/?err='.$e->getMessage().'&sitkn='.$cetcal_session_id);
  exit();
}