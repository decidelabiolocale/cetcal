<?php
$neant = '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/const/cet.annuaire.const.types.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.annuaire.controller.asso.vente.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/media/cet.qstprod.controller.media.php');
$media_controller = new MediaController();
$dataProcessor = new HTTPDataProcessor();
$ctrl = new AssoDistributeursController();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
$LieuxDeVenteCtrl = new MarchesCastillonnaisController();
$typesDeLieux = $LieuxDeVenteCtrl->showAllTypes();
$type = $dataProcessor->processHttpFormData($_GET['type']);
$counter = 0;
$data = $ctrl->init($type);
$filtre = false;

if (isset($_GET['q']) && !empty($_GET['q'])) 
{
  $filtre = $dataProcessor->processHttpFormData($_GET['q']);
  $data = $ctrl->loadQuery($filtre, $type);
}
?>
<!--<div class="container">-->
<div class="row justify-content-center">
  <div class="col-lg-9">
    <p class="form-text text-muted">
      Les lieux de vente connues de CETCAL.<br>
      Filtrer par mot type de lieu de vente (<b><?= count($data); ?></b> résultats pour la sélection &#171; 
        <b><?= CetAnnuaireConstTypes::TYPE_ENTITE[$type]; ?></b> &#187;) :
    </p>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-4">
    <div class="input-group mb-3">
      <select id="cet-annuaire-select-filter" class="form-control" aria-label="Default select example">
        <option value="">Tous les lieux</option>
        <?php foreach ($typesDeLieux as $typeLieu): ?>
          <option value="<?= $typeLieu->type; ?>" 
            <?= strcmp($type, $typeLieu->type) === 0 ? 'selected' : ''; ?>>
            <?= CetAnnuaireConstTypes::TYPE_ENTITE[$typeLieu->type]; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <div class="input-group-append">
        <a class="btn cet-navbar-btn cet-navbar-btn-small" id="cet-annuaire-button-filter" href="/?statut=asso.vente&anr=true&type=">valider</a>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher par mot clé, commune, activité, marché..."
        aria-label="Recherche par mot clé" id="cet-annuaire-recherche-filtre"
        name="cet-annuaire-recherche-filtre" value="<?= $filtre !== false ? $filtre : $neant; ?>">
      <div class="input-group-append">
        <a class="btn cet-navbar-btn cet-navbar-btn-small" id="cet-annuaire-recherche-filtrer"
          href="/?statut=asso.vente&anr=true&type=<?= $type; ?>&q=">
          Rechercher&#160;&#160;<i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
</div>
<?php if ($filtre !== false && is_array($data) && count($data) === 0): ?>
  <div class="row justify-content-lg-center" style="margin-bottom: 80px;">
    <div class="col-9">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p>
          Aucun résultat pour le mot clé "<span class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".<br>
          <i class="fa fa-info-circle" aria-hidden="true"> </i> Essayer avec le nom d'une commune, un
          territoire, une activité...
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="" style="margin-bottom: 60px;">
  <?php foreach ($data as $row): ?>
    <?php ++$counter; ?>
    <?php if ($counter === 1): ?>
      <div class="row justify-content-center">
      <?php endif; ?>
      <div class="col-lg-3" style="padding-left: 6px !important; padding-right: 6px;">
        <div class="card cet-bloc" style="margin-bottom: 12px;">
          <div class="card-body">
            <h4 class="card-text"><?= $row['denomination']; ?></h4>
            <?php $logo_entite = $media_controller->selectSrcLogoEntite($row['pk_entite']); ?>
            <?php if (isset($logo_entite) && strlen($logo_entite) > 1): ?> 
              <p class="lieuxdevente-logo-entite-container">
                <img class="lieuxdevente-logo-entite img-fluid" src="<?= $logo_entite; ?>"/>
              </p>
            <?php endif; ?>
            <p class="card-text"><?= $row['activite']; ?> <?= $row['specificites']; ?></p>
            <p class="card-text"><?= $row['adresse']; ?></p>
            <?php if (isset($row['infoscmd']) && !empty($row['infoscmd'])): ?>
            <p class="card-text"><i class="fa fa-warning-circle"
              aria-hidden="true"></i> <?= $row['infoscmd']; ?></p>
            <?php endif; ?>
            <?php if (isset($row['jourhoraire']) && !empty($row['jourhoraire'])): ?>
            <p class="card-text">Jours/Horaires : <?= $row['jourhoraire']; ?></p>
          <?php endif; ?>
        </div>
        <ul class="list-group list-group-flush">
          <?php if (isset($row['email']) && !empty($row['email'])): ?>
          <li class="list-group-item" style="border: none !important;">
            <?php foreach ($ctrl->splitData("#", $row['email']) as $value): ?>
              <div class="input-group mb-3">
                <input type="text" class="form-control copier-element-presse-papier-input"
                value="<?= $value; ?>" disabled="disabled">
                <div class="input-group-append">
                  <button class="btn btn-success copier-element-presse-papier" type="button"
                  onmousedown="copierPressePapier('<?= $value; ?>');">
                  <small>copier</small>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </li>
      <?php endif; ?>
      <?php if (isset($row['tels']) && !empty($row['tels'])): ?>
      <li class="list-group-item" style="border: none !important;">
        <?php foreach ($ctrl->splitData("#", $row['tels']) as $value): ?>
          <a href="tel:<?= $value; ?>" class="card-link">
            <?= $value; ?>
          </a>
        <?php endforeach; ?>
      </li>
    <?php endif; ?>
    <?php if (isset($row['urlwww']) && !empty($row['urlwww'])): ?>
    <li class="list-group-item" style="border: none !important;">
      <?php foreach ($ctrl->splitData("#", $row['urlwww']) as $value): ?>
        <a href="<?= $value; ?>" class="card-link" target="_blank">
          <?= $value; ?>
        </a>
      <?php endforeach; ?>
    </li>
  <?php endif; ?>
</ul>
</div>
</div>
<?php if ($counter === 3): ?>
</div>
<?php $counter = 0; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($counter !== 3): // close div if it hasn't been done in loop.  ?>
</div>
<?php endif; ?>
</div>
<!--</div>-->
<script src="/src/scripts/js/cetcal/cetcal.recherche.min.js"></script>