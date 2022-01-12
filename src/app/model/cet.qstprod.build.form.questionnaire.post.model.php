<?php
require_once('cet.qstprod.model.php');
require_once('cet.qstprod.producteurs.model.php');
require_once('cet.qstprod.querylibrary.php');

/**
 * MODEL class.
 * Recharge les données producteur si contexte modification demandé par
 * producteur inscrit et authentifié.
 */
class QSTPRODProducteurPOSTModel extends QSTPRODProducteurModel 
{

  private $listes_arrays = NULL;

  /**
   * Recharger tous les formulaire $_POST dans un array associatif pour tromper la vues.
   */
  public function reloadForms($pk) 
  {
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.qstprod.const.listes.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.filereader.php');
    $this->listes_arrays = new CetQstprodConstListes(new FileReaderUtils($_SERVER['DOCUMENT_ROOT']));

    $producteur['signupgen.form.post'] = $this->toInfosGenForm(
        $this->findProducteurByPk($pk), 
        $pk
      );
    $producteur['signuplieuxdist.form.post'] = $this->toLieuxDistForm(
        $this->findLieuxDistByPk($pk),
        $pk
      );
    $producteur['signupprods.form.post'] = $this->toProduitsForm(
        $this->findProduitByFkProducteur($pk),
        $this->findSpecificitesProduitsByPkProducteur($pk),
        $pk
      );
    $producteur['signupconso.form.post'] = $this->toInfosConsomateursForm(
        $this->findInfosConsomateursByPkProducteur($pk)
      );
    $producteur['signupbesoins.form.post'] = $this->toBesoinsForm(
        $this->findBesoinsByPkProducteur($pk)
      );
    $producteur['signuprecap.opinions'] = $this->getOpinionsInscription($pk);

    return $producteur;
  }

  /* ****************************************************************************************
   * Méthodes/fonctions privées.
   */

  /**
   * Charger les données liés aux besoins producteur.
   */
  private function toBesoinsForm($data)
  {
    return array(
      'qstprod-besoins-solsprods' => 
        $this->getArrayKVStringParChampVal($data, 'sl01', 'clef_information', 'information'),
      'qstprod-besoins-actions' => 
        $this->getArrayKVStringParChampVal($data, 'sl02', 'clef_information', 'information'),
      'qstprod-besoins-groupesres' => 
        $this->getArrayKVStringParChampVal($data, 'sr01', 'clef_information', 'information'),
      'qstprod-question-reseaux-participation' => 
        $this->getReponseOuiNon($data, 'srq1', 'clef_information', 'information')
    );
  }

  /**
   * Charger les données liés aux modes de consomation.
   */
  private function toInfosConsomateursForm($data)
  {
    return array(
      'qstprod-consoachats' => 
        $this->getArrayKVStringParChampVal($data, 'c001', 'clef_mode_conso', 'val_mode_conso'),
      'qstprod-receptions' => 
        $this->getArrayKVStringParChampVal($data, 'c002', 'clef_mode_conso', 'val_mode_conso'),
      'qstprod-paiments' => 
        $this->getArrayKVStringParChampVal($data, 'c003', 'clef_mode_conso', 'val_mode_conso'),
    );
  }

  /**
   * Reconstuire le formulaire pour les produits.
   */
  private function toProduitsForm($data, $data_specs, $pk)
  {
    $tmp_specs = array();
    foreach ($data_specs as $row) array_push($tmp_specs, 
      $row['clef_specificite'].';'.$row['val_specificite']);

    $signupprods = array(
      'qstprod-produits-legumes' => 
        $this->getArrayKVStringParChampVal($data, 'pl01', 'clef_produit', 'nom'),
      'qstprod-produits-viandes' => 
        $this->getArrayKVStringParChampVal($data, 'pv01', 'clef_produit', 'nom'),
      'qstprod-produits-laitiers' => 
        $this->getArrayKVStringParChampVal($data, 'pla1', 'clef_produit', 'nom'),
      'qstprod-produits-mielsruches' => 
        $this->getArrayKVStringParChampVal($data, 'pr01', 'clef_produit', 'nom'),
      'qstprod-produits-fruits' => 
        $this->getArrayKVStringParChampVal($data, 'pf01', 'clef_produit', 'nom'),
      'qstprod-produits-champignons' => 
        $this->getArrayKVStringParChampVal($data, 'pc01', 'clef_produit', 'nom'),
      'qstprod-produits-boissons' => 
        $this->getArrayKVStringParChampVal($data, 'pb01', 'clef_produit', 'nom'),
      'qstprod-produits-plantes' => 
        $this->getArrayKVStringParChampVal($data, 'pp01', 'clef_produit', 'nom'),
      'qstprod-produits-semences' => 
        $this->getArrayKVStringParChampVal($data, 'ps01', 'clef_produit', 'nom'),
      'qstprod-produits-transformes' => 
        $this->getArrayKVStringParChampVal($data, 'pt01', 'clef_produit', 'nom'),
      'qstprod-produits-cereales' => 
        $this->getArrayKVStringParChampVal($data, 'pcr1', 'clef_produit', 'nom'),
      'qstprod-produits-hygienes' => 
        $this->getArrayKVStringParChampVal($data, 'phy1', 'clef_produit', 'nom'),
      'qstprod-produits-entretiens' => 
        $this->getArrayKVStringParChampVal($data, 'pnt1', 'clef_produit', 'nom'),
      'qstprod-produits-animaux' => 
        $this->getArrayKVStringParChampVal($data, 'pna1', 'clef_produit', 'nom'),
      'qstprod-produits-poissons' => 
        $this->getArrayKVStringParChampVal($data, 'ppc1', 'clef_produit', 'nom'),
      'qstprod-typescultures' => $tmp_specs,
      'qstprod-produit-autre-autre' => 
        $this->getNomProduit($this->findAutreProduitInconnuByPk($pk))
    );

    return $signupprods;
  }

  /**
   * Correspond à la page 2 du questionnaire.
   * Données issues de la table cetcal_producteur_lieu_dist.
   */
  private function toLieuxDistForm($data, $pk)
  {
    $json = ["lieux" => array()];
    foreach ($data as $lieu) 
    {
      array_push($json['lieux'], [
        "pk_entite" => $lieu['fk_entite'],
        "code_type" => $lieu['code_type'],
        "type" => $lieu['type'],
        "code_sous_type" => $lieu['code_sous_type'],
        "sous_type" => $lieu['sous_type'],
        "denomination" => $lieu['denomination'],
        "crea_marche" => $lieu['crea_marche'],
        "precs" => $lieu['precisions'],
        "date" => $lieu['date_lieu'],
        "heure_deb" => $lieu['heure_deb'],
        "heure_fin" => $lieu['heure_fin'],
        "jour" => $lieu['jour']
      ]);
    }

    $json = json_encode($json);
    $lieuxdist = array();
    $lieuxdist['qstprod-signuplieuxdist-json'] = rawurlencode($json);

    return $lieuxdist;
  }

  /**
   * corresponda à la page 1 du questionnaire producteur : 
   * infos générales ou signupgen.form.php
   * Données issues de deux tables : cetcal_producteur & cetcal_sondage.
   */
  private function toInfosGenForm($data, $pk)
  {
    require_once('cet.qstprod.questionnaire.sondage.producteur.model.php');
    $model_sondage = new QSTPRODSondageProducteurModel();
    $sondage = $model_sondage->fetchSondageKVAsString($pk);

    $infosgen = array();
    $infosgen['qstprod-nom'] = $data['nom'];
    $infosgen['qstprod-prenom'] = $data['prenom'];
    $infosgen['qstprod-email'] = $data['email'];
    $infosgen['qstprod-email-conf'] = $data['email_bu'];
    $infosgen['qstprod-numbtel-fix'] = $data['telfixe'];
    $infosgen['qstprod-numbtel-port'] = $data['telport'];
    $infosgen['qstprod-nomferme'] = $data['nom_ferme'];
    $infosgen['qstprod-bio-certifs-ab-org'] = $data['orgcertifbio'];
    $infosgen['qstprod-bio-certifs-ab'] = $data['niv_certif_ab'];
    $infosgen['qstprod-siret'] = $data['siret'];
    $infosgen['qstprod-numvoie'] = $data['adrferme_numvoie'];
    $infosgen['qstprod-rue'] = $data['adrferme_rue'];
    $infosgen['qstprod-lieudit'] = $data['adrferme_lieudit'];
    $infosgen['qstprod-commune'] = $data['adrferme_commune'];
    $infosgen['qstprod-cp'] = $data['adrferme_cp'];
    $infosgen['qstprod-cmpladrs'] = $data['adrferme_compladr'];
    $infosgen['qstprod-fb'] = $data['pageurl_fb'];
    $infosgen['qstprod-ig'] = $data['pageurl_ig'];
    $infosgen['qstprod-twitter'] = $data['pageurl_twitter'];
    $infosgen['qstprod-www'] = $data['url_web'];
    $infosgen['qstprod-adrwebboutiqueenligne'] = $data['url_boutique'];
    $infosgen['qstprod-besoins-activites'] = explode('µ', $this->getTypesProductionCleValAsString($pk));
    $infosgen['qstprod-surfacepc'] = $data['surfacehectterres'];
    $infosgen['qstprod-supserre'] = $data['surfacesousserre'];
    $infosgen['qstprod-nbrtetes'] = $data['tetes_betail'];
    $infosgen['qstprod-hectolitresparan'] = $data['hl_par_an'];
    $infosgen['qstprod-sondagedifficultes'] = $sondage;
    $infosgen['qstprod-sondage'] = $sondage;
    $infosgen['qstprod-cagette'] = $data['groupe_cagette'];
    $infosgen['qstprod-nbrpostes'] = $model_sondage->getReponseParClef($sondage, 'snbp');
    $infosgen['qstprod-nbrsaisonniers'] = $model_sondage->getReponseParClef($sondage, 'snbs');
    $infosgen['qstprod-nbrheuressemaine'] = $model_sondage->getReponseParClef($sondage, 'snhs');

    return $infosgen;
  }

  /* ****************************************************************************************
   * Méthodes/fonctions utilitaires et communes.
   */

  /**
   * Filtrer les données par clef/valeur (par catégories produits parexemple : p001;tomates).
   * écarte les saisies libres.
   */
  private function getArrayKVStringParChampVal($data, $clef, $champ_clef, $champ_val)
  {
    $tmp = array();
    foreach ($data as $row) 
    {
      if (strcmp($row[$champ_clef], $clef) === 0) array_push($tmp, $row[$champ_clef].';'.$row[$champ_val]);
    }

    return $tmp;
  }

  /**
   * Utilisé pour les radios boutons : reconstruire l'éntrée formulaire pour ces derniers.
   * Recharchercher la valeure associé au radio boutton. Si présent, retourner cette valeure.
   * Sinon, retourner '' si aucune correspondance.
   */
  private function getReponseOuiNon($data, $clef, $champ_clef, $champ_val)
  {
    foreach ($data as $row) if (strcmp($row[$champ_clef], $clef) === 0) return $row[$champ_val];
    return '';
  }

  private function getNomProduit($data)
  {
    if (count($data) === 1) return $data[0]['nom'];
    return '';
  }

}