<?php
$neant = '';
$opinions = isset($_SESSION['signuprecap.opinions']) ? $_SESSION['signuprecap.opinions'] : "";
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-GLOBAL']) ? $_SESSION['CONTEXTE_MODIF-GLOBAL'] : false;
$pkprd = isset($_SESSION['CONTEXTE_MODIF-PKPRD']) ? $_SESSION['CONTEXTE_MODIF-PKPRD'] : "";
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupgen.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupprods.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signuplieuxdist.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupconso.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/dto/cet.qstprod.signupbesoins.dto.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.sessionshelper.php');
$sessionshelper = new SessionHelper($_SERVER['DOCUMENT_ROOT']);
$infogenerales = $sessionshelper->getDto('signupgen.form', new QstProdGeneraleDTO());
$produits = $sessionshelper->getDto('signupprods.form', new QstProduitDTO());
$lieuxdist = $sessionshelper->getDto('signuplieuxdist.form', new QstLieuxDistributionDTO());
$conso = $sessionshelper->getDto('signupconso.form', new QstConsomateursDTO());
$besoins = $sessionshelper->getDto('signupbesoins.form', new QstBesoinsDTO());
$recapLieuxDist = json_decode($lieuxdist->json);
$whitespace = " ";
?>

<!-- singup récapitulatif html form -->
<!-- -------------------------------------- -->
<!-- ZONE de récap informations générales.   -->
<!-- -------------------------------------- -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <label>
      <small class="form-text text-muted" style="color: rgb(70, 80, 40) !important;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
        <a href="#" class="cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
      </small>
    </label>
    <br>
    <label class="cet-formgroup-container-label">
      <small class="form-text">Récapitulatif de vos informations générales :</small>
    </label>
    <div class="cet-formgroup-container">
      <div class="d-flex justify-content-center">
        <table class="table table-borderless cet-table">
          <tbody>
            <?php if ( strlen($infogenerales->nom) || strlen($infogenerales->prenom) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Nom, prénom :</b></span><?= $infogenerales->nom; ?> <?= $infogenerales->prenom; ?></td>
            </tr>
          <?php endif; ?>
          <?php if ( strlen($infogenerales->email) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Adresse email :</b></span><?= $infogenerales->email; ?></td>
            </tr>
          <?php endif; ?>
          <?php if ( strlen($infogenerales->telfix) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Téléphone fixe :</b></span><?= $infogenerales->telfix; ?></td>
            </tr>
          <?php endif; ?>
          <?php if ( strlen($infogenerales->telport) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Téléphone mobile :</b></span><?= $infogenerales->telport; ?></td>
            </tr>
          <?php endif; ?>
          <?php if ( strlen($infogenerales->nomferme) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Nom de la ferme:</b></span><?= $infogenerales->nomferme; ?></td>
            </tr>
          <?php endif; ?>
          <?php if ( strlen($infogenerales->siret) > 0): ?>
            <tr>
              <td><span class="text-muted"><b>Siret associé à la ferme : </b></span><?= $infogenerales->siret; ?></td>
            </tr>
          <?php endif; ?>
          <?php if (isset($infogenerales->adrLieudit) || isset($infogenerales->adrComplementAdr)) $displayCmplAdr = true; ?>
          <tr>
            <td><span class="text-muted"><b>Adresse postale de la ferme : </b></span><?= $infogenerales->adrNumvoie; ?> <?= $infogenerales->adrRue; ?><?php if ($displayCmplAdr) : ?><br><?= $infogenerales->adrLieudit; ?> <?= $infogenerales->adrComplementAdr; ?><?php endif; ?><br><?= $infogenerales->adrCommune; ?> <?= $infogenerales->adrCodePostal; ?>
          </td>
        </tr>
        <?php if ( strlen($infogenerales->pageFB) > 0): ?>
          <tr>
            <td><span class="text-muted"><b>Page Facebook :</b></span><?= $infogenerales->pageFB; ?></td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->pageIG) > 0): ?>
          <tr>
            <td><span class="text-muted"><b>Page Instagram :</b></span><?= $infogenerales->pageIG; ?></td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->pageTwitter) > 0): ?>
          <tr>
            <td><span class="text-muted"><b>Page Twitter :</b></span><?= $infogenerales->pageTwitter; ?></td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->siteWebUrl) > 0): ?>
          <tr>
            <td><span class="text-muted"><b>Adresse web de votre site dédié :</b></span><?= $infogenerales->siteWebUrl; ?></td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->boutiqueEnLigneUrl) > 0): ?>
          <tr>
            <td>
              <span class="text-muted"><b>Adresse web, Boutique en ligne :</b></span><?= $infogenerales->boutiqueEnLigneUrl; ?>
            </td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->groupeCagette) > 0): ?>
          <tr>
            <td>
              <span class="text-muted"><b>Votre groupe Cagette :</b></span><?= $infogenerales->groupeCagette; ?>
            </td>
          </tr>
        <?php endif; ?>
        <?php if ( strlen($infogenerales->organismeCertificateurBIO) > 0): ?>
          <tr>
            <td>
              <span class="text-muted"><b>Organisme Certificateur BIO :</b></span><?= $infogenerales->organismeCertificateurBIO; ?>
            </td>
          </tr>
        <?php endif; ?>
        <tr>
          <td><span class="text-muted"><b>Type de production :</b></span>
            <?php if (isset($infogenerales->typeDeProduction) && is_array($infogenerales->typeDeProduction) && count($infogenerales->typeDeProduction) > 0): ?>
            <?php $counter = 0; ?>
            <?php foreach ($infogenerales->typeDeProduction as $typeprod): ?>
              <?php echo explode(';', $typeprod)[1].($counter + 1 === count($infogenerales->typeDeProduction) ? '' : ', '); ?>
              <?php ++$counter; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </td>
      </tr>
      <?php if ( strlen($infogenerales->surfaceHectTerres) > 0): ?>
        <tr>
          <td>
            <span class="text-muted"><b>Surface de terres cultivées :</b></span><?= $infogenerales->surfaceHectTerres; ?> <i>Hectares</i>
          </td>
        </tr>
      <?php endif; ?>
      <?php if ( strlen($infogenerales->surfaceHectSousSerre) > 0): ?>
        <tr>
          <td>
            <span class="text-muted"><b>Surface sous serre(s) :</b></span><?= $infogenerales->surfaceHectSousSerre; ?> <i>Ares</i>
          </td>
        </tr>
      <?php endif; ?>
      <?php if ( strlen($infogenerales->nbrTetesBetail) > 0): ?>
        <tr>
          <td>
            <span class="text-muted"><b>Nombre de têtes (si bétail) :</b></span><?= $infogenerales->nbrTetesBetail; ?>
          </td>
        </tr>
      <?php endif; ?>
      <?php if ( strlen($infogenerales->hectolitresParAn) > 0): ?>
        <tr>
          <td>
            <span class="text-muted"><b>Hectolitres / an (si production boissons) :</b></span><?= $infogenerales->hectolitresParAn; ?> <i>Hectolitres</i>
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</div>
</div>
</div>

<!-- -------------------------------------- -->
<!-- ZONE de récap lieux de distribution.   -->
<!-- -------------------------------------- -->

<?php if (!empty($recapLieuxDist)): ?>
  <div class="row justify-content-lg-center">
    <div class="col-lg-6">
      <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos points de vente / distribution :</small></label>
      <div class="cet-formgroup-container">
        <div class="d-flex justify-content-center">
          <table class="table cet-table" id="lieux-dist-table-recap-lieux">
            <thead>
              <tr>
                <th scope="col">Type</th>
                <th scope="col">Nom</th>
                <th scope="col">Date</th>
                <th scope="col">Jour</th>
                <th scope="col">Heure de début</th>
                <th scope="col">Heure de fin</th>
                <th scope="col">Vos précisions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recapLieuxDist->lieux as $value): ?>
                <tr>
                  <?php if ( strlen($value->type) > 0): ?>
                    <td>
                      <span class="text-muted"><?=$value->type; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if ( strlen($value->denomination) > 0): ?>
                    <td>
                      <span class="text-muted"><?=$value->denomination; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if ( isset($value->date) ): ?>
                    <td>
                      <span class="text-muted"><?=$value->date; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if ( isset($value->jour) ): ?>
                    <td>
                      <span class="text-muted"><?=$value->jour; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if (isset($value->heure_deb) ): ?>
                    <td>
                      <span class="text-muted"><?=$value->heure_deb; ?></span>
                    </td>
                  <?php else  :?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if ( isset($value->heure_fin)) :?>
                    <td>
                      <span class="text-muted"><?=$value->heure_fin; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                  <?php if ( strlen($value->precs) > 0): ?>
                    <td>
                      <span class="text-muted"><?=$value->precs; ?></span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="text-muted"><?=$whitespace;?></span>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <div class="row justify-content-lg-center">
    <div class="col-lg-6">
      <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos points de vente / distribution :</small></label>
      <div class="cet-formgroup-container">
        <div class="d-flex justify-content-center">
         <p><b>Aucun lieu de distribution renseigné</b></p>
       </div>
     </div>
   </div>
 </div>
<?php endif;?>



<!-- -------------------------------------- -->
<!-- ZONE de récap produits.                -->
<!-- -------------------------------------- -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <label class="cet-formgroup-container-label"><small class="form-text">Récapitulatif de vos produits :</small></label>
    <div class="cet-formgroup-container">
      <div class="d-flex justify-content-center">
        <table class="table table-borderless cet-table">
          <tbody>
            <tr>
              <td>
                <span class="text-muted">Vos produits : </span>
                <?php foreach ($produits->listAllProducts() as $k => $v): ?>
                  <?php foreach ($v as $prd): ?>
                    <span class="cst-produits"><?= $prd; ?></span>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <div class="cet-formgroup-container">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p><small class="cet-qstprod-label-text"><b><?= CetQstprodConstTextes::recap_questionnaire_declaratif_a; ?></b></small></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="form-group mb-3">
        <label class="cet-input-label"><small class="cet-qstprod-label-text">Vos idées, remarques :</small></label>
        <textarea class="form-control" id="qstprod-opinions-producteur" name="qstprod-opinions-producteur"
        placeholder="votre avis nous intéresse..." form="signuprecap.form.declaratif"
        value="" maxlength="512"><?= $cntxmdf ? $opinions : $neant; ?></textarea>
      </div>
      <label>
        <small class="form-text cet-qstprod-label-text">Souhaitez-vous valider <?= $cntxmdf ? 'vos modifications' : 'votre inscription'; ?> et envoyer votre questionnaire ? Si oui, merci de déclarer vos informations :</small>
      </label>
      <div class="input-group mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="qstprod-declaration-valide"
          name="qstprod-declaration-valide" value="oui"
          checked="false">
          <label class="form-check-label">Oui, je déclare que les informations renseignées sont exactes et vérifiées.</label>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signuprecap.form.declaratif" class="form" method="post" action="/src/app/controller/cet.qstprod.controller.signuprecap.form.php">

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit"
          onmousedown="$('#qstprod-signuprecap-nav').val('retour');"
          id="btn-signuprecap.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn cet-navbar-btn" type="submit" id="btn-signuprecap-form-valider"
          onmousedown="$('#qstprod-signuprecap-nav').val('valider');">Valider <?= $cntxmdf ? 'vos modifications' : 'votre inscription'; ?></button>
        </div>
      </div>

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuprecap-nav" id="qstprod-signuprecap-nav" value="unset" hidden="hidden">
      <input type="text" name="qstprod-signuprecap-cntx" id="qstprod-signuprecap-cntx"
      value="<?= $cntxmdf ? 'mdif' : 'insc'; ?>" hidden="hidden">
      <input type="text" name="qstprod-signuprecap-pkprd" id="qstprod-signuprecap-pkprd"
      value="<?= $pkprd ?>" hidden="hidden">
      <input type="text" name="qstprod-signuprecap-email" id="qstprod-signuprecap-email"
      value="<?= $infogenerales->email; ?>" hidden="hidden">
    </form>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.min.signuprecap.js"></script>