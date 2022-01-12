<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
$ctrl = new AnnuaireController();
$data_carto = NULL;
?>
<?php if (isset($cnx) && (intval($cnx) === CetConnectionConst::CONNECTION_UTSR_REUSSIE || 
          intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE)): ?>
  <?php 
    $usr_identifiant = $dataProcessor->processHttpFormData($_GET['usridf']);
    $client_type = $dataProcessor->processHttpFormData($_GET['clitype']);
    $sitkn = $dataProcessor->processHttpFormData($_GET['sitkn']);
    $usrpk = $dataProcessor->processHttpFormData($_GET['usrpk']);
    $cnxmessage = (isset($_GET['cnxmsg'])) ? $dataProcessor->processHttpFormData($_GET['cnxmsg']) : false;

    $libelle_client_type = '';
    if (isset($client_type) && strcmp($client_type, 'prd') === 0) 
    {
      $libelle_client_type = 'Producteur.e';
      $data_carto = $ctrl->getDonneesCartographie($usrpk);
    }
    if (isset($client_type) && strcmp($client_type, 'usr') === 0) $libelle_client_type = 'utilisateur(trice)';

    /**
     * Si connection avérée TRUE alors include l'espace 
     */
    include $PHP_INCLUDES_PATH.'areas/include.cet.annuaire.espace.producteur.utilisateur.php'; 
  ?>

<?php elseif (isset($cnx) && intval($cnx) !== CetConnectionConst::CONNECTION_PRD_REUSSIE && 
              intval($cnx) !== CetConnectionConst::CONNECTION_UTSR_REUSSIE): ?>
  <br>
  <div class="row justify-content-lg-center" id="cetcal-cnx-not-done">
    <div class="col-lg-9">
      <div class="alert" role="alert">
        <h4 class="alert-heading">Les informations renseignées ne permettent pas de vous connecter.</h4>
        <p>Votre saisie, email et/ou mot de passe, ne permet pas de vous connecter. Veuillez essayer à nouveau.</p>
        <ul>
          <li>Vous êtes inscrit mais vous avez oublié vos informations de connection ? Veuillez cliquer sur <i><b>&#171; se connecter &#187;</b></i> puis sur <i><b>&#171; j'ai oublié mon mot de passe et/ou mon identifiant &#187;</b></i>.</li>
          <li><b>Producteur</b>, vous souhaitez vous inscrire pour être référencé ? Cliquer sur <i><b>&#171; Je suis Producteur.e &#187;</b></i> dans la bar de menu.</li>
          <li><b>Professionnel</b> ou particulier, vous souhaitez travailler avec nous : cliquer sur <i><b>&#171; créer un compte &#187;</b></i> dans la bar de menu.</li>
        </ul>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class=" cet-green-link cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
      </div>
    </div>
  </div>
<?php endif; ?>