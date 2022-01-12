<?php 
  require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/const/cet.annuaire.const.login.php');
  $usr_identifiant = $dataProcessor->processHttpFormData($_GET['usridf']);
?>
<?php if (isset($obl) && 
         (intval($obl) === CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK || 
          intval($obl) === CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK)): ?>
  <br>
  <div class="row justify-content-lg-center" id="cetcal-obl-done">
    <div class="col-lg-9">
      <div class="alert" role="alert">
        <h4 class="alert-heading">Demande traitée avec succès.</h4>
        <p>Un mot de passe vient de vous être envoyé par email à l'adresse <b><?= $usr_identifiant; ?></b></p>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-green-link cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
      </div>
    </div>
  </div>
<?php elseif (isset($obl) && intval($obl) !== CetConnectionConst::RENOUVELLEMENT_MDP_PRD_OK && 
              intval($obl) !== CetConnectionConst::RENOUVELLEMENT_MDP_UTSR_OK): ?>
  <br>
  <div class="row justify-content-lg-center" id="cetcal-obl-not-done">
    <div class="col-lg-9">
      <div class="alert" role="alert">
        <h4 class="alert-heading">Les informations renseignées ne permettent pas de traiter votre demande.</h4>
        <p>Votre email est inconnu. Demande de renouvellement de mot de passe refusée pour l'adresse <b><?= $usr_identifiant; ?></b></p>
        <ul>
          <li>
            Vous êtes <b>Producteur.e</b> et vous souhaitez bénéficier d'un soutient informatique (aide informatique ou à l'inscription et au référencement, autre) ? Cliquer ci-dessous :
            <br>
            <a href="#" class="btn cet-navbar-btn" style="font-family: Courgette; margin-top: 10px;">Je suis Producteur et souhaite être aidé dans mes démarches</a>
          </li>
        </ul>
        <hr>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-green-link cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <p class="mb-0"><?= CetQstprodConstLibelles::en_cas_de_doute; ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>
<script type="text/javascript">
  setTimeout(function() { 
    //$('#cetcal-obl-done').hide('slow');
    //$('#cetcal-obl-not-done').hide('slow');
  }, 1000 * 5);
</script>
<div style="margin-top: 36px;"></div>