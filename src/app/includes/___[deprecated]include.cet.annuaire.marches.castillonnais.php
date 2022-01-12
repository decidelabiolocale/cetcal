<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$filtre = isset($_GET['q']) ? $dataProcessor->processHttpFormData($_GET['q']) : false; 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
$ctrl = new MarchesCastillonnaisController();
$data = !$filtre ? $ctrl->init('marche') : $ctrl->loadQuery($filtre, 'marche');
$resultNull = is_array($data) && count($data) === 0;
$counter = 0;
?>

<div class="row justify-content-lg-center" style="margin-bottom: 8px;">
  <div class="col-md-6">
    <p class="form-text text-muted">Filtrer/Rechercher des Marchés par mot clé (commune, code postal, mot clé...) :</p>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher par mot clé, commune, code postal..." 
        aria-label="Recherche par mot clé" id="cet-annuaire-recherche-filtre" name="cet-annuaire-recherche-filtre"
        value="<?= $filtre !== false ? $filtre : ''; ?>">
      <div class="input-group-append">
        <a class="btn btn-outline-success" id="cet-annuaire-recherche-filtrer"
          href="/?statut=marches.castillonnais&anr=true&q=">
          Rechercher  <i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>

<?php if ($resultNull): ?>
<div class="row justify-content-lg-center" style="margin-bottom: 80px;">
  <div class="col-md-6">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <p>
        Aucun résultat pour le mot clé "<span class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".<br>
        <i class="fa fa-info-circle" aria-hidden="true"> </i> Essayer avec le nom d'une commune ou un code postal...
      </p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
<?php endif; ?>

<div style="margin-bottom: 60px; margin-top: 30px;">
  <?php foreach ($data as $row): ?>
  <?php ++$counter; ?>
  <?php if ($counter === 1): ?> 
    <div class="row justify-content-lg-center" style="margin-bottom: 8px;">
  <?php endif; ?>
      <div class="col-md-3">
        <div class="card border-warning cet-carte-info">
          <div class="card-header text-white border-warning"><?= $row['denomination']; ?></div>
          <div class="card-body">
            <p class="card-text"><span class="text-muted">Jours/horaires : </span><br><?= $row['jourhoraire']; ?></p>
            <p class="card-text"><span class="text-muted">Pour s'y rendre : </span><br><a href="#"><?= $row['adresse']; ?></a></p>
          </div>
        </div>
      </div>
  <?php if ($counter === 3): ?>
    </div>
    <?php $counter = 0; ?>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php if ($counter !== 3): // close div if it hasn't been done in loop. ?>
    </div>
  <?php endif; ?>
</div>
<script src="/src/scripts/js/cetcal/cetcal.recherche.min.js"></script>