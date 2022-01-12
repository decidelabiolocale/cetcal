<?php
$neant = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$util = new FormatUtils();
$ctrl = new AnnuaireController();
$data = $ctrl->fetchRecettes();
?>

<div class="row justify-content-lg-center" style="margin-bottom: 42px; margin-top: 32px;">
  <div class="col-md-6">
    <div id="cetcal-recette-accordion">
      <?php foreach ($data as $recette): ?>
        <div class="card cet-bloc">
          <div class="card-header cetcal-recette-header" 
            id="cetcal-recette-header-<?= $recette['pk_recette'] ?>"
            style="background-color: #CAE3EE !important;"
            onmousedown="$('#cetcal-recette-button-control-<?= $recette['pk_recette'] ?>').click();">
            <p style="display: inline;">
              <a class="btn btn-link collapsed" data-toggle="collapse" aria-expanded="false"
                id="cetcal-recette-button-control-<?= $recette['pk_recette'] ?>"
                data-target="#cetcal-recette-detail-<?= $recette['pk_recette'] ?>"
                aria-controls="cetcal-recette-detail-<?= $recette['pk_recette'] ?>"
                style="color: #6C3012; text-decoration: none !important; font-size: 24px !important;">  
                <i><?= strlen($recette['titre']) > 0 ? $recette['titre'] : "Recette"; ?></i>
              </a>
              <span><i>(<?= $util->separatorToComaSpace(';', $recette['mots_cles_produits']); ?>)</i></span>
            </p>
            <span style="float: right;">
              <?php if (strpos($recette['file_path'], '/cet/') !== false): ?>
                <img src="/res/content/icons/cetcal_logo_alpha.png" height="52" alt="" style="display: inline;">
              <?php elseif (strpos($recette['file_path'], '/antigaspi_cet/') !== false): ?>
                <img src="/res/content/icons/antigaspi_002.png" height="64" alt="" style="display: inline; margin-top: -10px;">
              <?php endif; ?>
            </span>
            <span style="float: right; margin-right: 16px;">
              <?php if (strlen($recette['auteurs']) > 0): ?>
               [<b>Auteurs : </b><?= $recette['auteurs'] ?>]&#160;
              <?php endif; ?>
              <?php if (strlen($recette['nombre_personnes']) > 0): ?>
                Pour <?= $recette['nombre_personnes'] ?> personne.
              <?php endif; ?>
              <?php if (strlen($recette['temps_preparation']) > 0): ?>
                &#160;Préparation : <?= $recette['temps_preparation'] ?>.
              <?php endif; ?>
              <?php if (strlen($recette['temps_cuisson']) > 0): ?>
                &#160;Cuisson : <?= $recette['temps_cuisson'] ?>.
              <?php endif; ?>
            </span>
          </div>
          <div id="cetcal-recette-detail-<?= $recette['pk_recette'] ?>" class="collapse" 
            aria-labelledby="cetcal-recette-header-<?= $recette['pk_recette'] ?>" 
            data-parent="#cetcal-recette-accordion">
            <div class="card-body" style="background-color: rgb(250,250,250) !important; color: rgb(30,30,45);">
              <div class="row">
                <div class="col-8">
                <?php if (strlen($recette['nombre_personnes'].$recette['temps_preparation'].$recette['temps_cuisson']) > 0): ?>  
                  <p>
                    <i>
                    <?php if (strlen($recette['nombre_personnes']) > 0): ?>
                      Pour <?= $recette['nombre_personnes'] ?> personne.
                    <?php endif; ?>
                    <?php if (strlen($recette['temps_preparation']) > 0): ?>
                      <br>Temps de préparation : <?= $recette['temps_preparation'] ?>.
                    <?php endif; ?>
                    <?php if (strlen($recette['temps_cuisson']) > 0): ?>
                      <br>Temps de cuisson : <?= $recette['temps_cuisson'] ?>.
                    <?php endif; ?>
                    </i>
                  </p>
                  <?php endif; ?>
                  <?php if (strlen($recette['ingredients_et_recette']) > 0): ?>
                    <p><i><b>Ingrédients et recette :</b></i></p>
                    <p><?= $recette['ingredients_et_recette'] ?></p>
                  <?php elseif (strlen($recette['ingredients']) > 0): ?>
                    <p><i><b>Ingrédients :</b></i></p>
                    <p><?= $recette['ingredients'] ?></p>
                    <?php if (strlen($recette['recette']) > 0): ?>
                      <p><i><b>Recette :</b></i></p>
                      <p><?= $recette['recette'] ?></p>
                    <?php endif; ?>  
                  <?php else: ?>
                    <p>Pas d'information concernant cette recette.</p>
                  <?php endif; ?>
                </div>
                <div class="col-4">
                  <?php if (strlen($recette['notes']) > 0): ?>
                    <p><i><b>Notes : </b></i><br><?= $recette['notes'] ?></p>
                  <?php endif; ?>
                  <?php if (strlen($recette['auteurs']) > 0): ?>
                    <p><i><b>Les auteurs de la recette : </b></i><?= $recette['auteurs'] ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="card-body" style="background-color: rgb(250,250,250) !important; color: rgb(30,30,45);">
              <div class="row">
                <div class="col-12">
                  <p>
                    Chez quel(le)s Producteur.e.s trouvez les produits associés à cette recette ?&#160;&#160;
                    <i class="far fa-hand-point-down"></i>
                  </p>
                  <button class="btn cet-navbar-btn cet-navbar-btn-small" id="action-recherche-prd-recette-<?= $recette['pk_recette']; ?>" style="float: left;"
                    onmousedown="rechercherProducteurPourProduits('<?= $recette['mots_cles_produits'] ?>', 
                      'cetcal-producteurs-recette-table-<?= $recette['pk_recette']; ?>', this.id);">
                    <i class="fas fa-search"></i>
                    &#160;&#160;Rechercher des Producteur.e.s les produits 
                    &#171; <?= $util->separatorToComaSpace(';', $recette['mots_cles_produits']); ?>  &#187;
                  </button>
                  <br>
                  <table class="table table-borderless cetcal-table-producteurs-recette" 
                    id="cetcal-producteurs-recette-table-<?= $recette['pk_recette']; ?>">
                  </table>
                </div>
                <div class="col-3">
                  <!--<button class="btn cet-navbar-btn cet-navbar-btn-small" style="float: right;">
                    <i class="fas fa-pencil-alt"></i>&#160;&#160;&#160; Modifier cette recette
                  </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.annuaire.recettes.min.js"></script>