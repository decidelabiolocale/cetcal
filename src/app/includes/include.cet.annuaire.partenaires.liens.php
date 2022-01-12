<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$util = new FormatUtils();
$ctrl = new AnnuaireController();
$data = $ctrl->fetchPartenairesLiens();
?>

<br>
<div class="row justify-content-lg-center" style="margin-bottom: 24px;">
  <div class="col-md-6">
    <p class="cet-p" style="margin-bottom: 2px;"> Liens utils :</p> 
    <div class="list-group">
      <?php foreach ($data as $row): ?>
        <?php if (strcmp($row['type'], 'partenaire') !== 0): ?> 
          <a href="<?= $row['url']; ?>" class="list-group-item list-group-item-action cet-p" target="_blank">
            <?= $row['denomination'] ?>
            <span class="cet-span">
              <i class="fa fa-info-circle" aria-hidden="true"></i><small> <?= $row['description'] ?></small>
            </span>
            <?php if (!empty($row['tel'])): ?>
              <br>
              <span class="cet-span" style="float: right;font-weight: bold;">
                <i class="fa fa-phone" aria-hidden="true"></i> <?= $util->formatNTel($row['tel']); ?>
              </span>
            <?php endif; ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="row justify-content-lg-center" style="margin-bottom: 24px;">
  <div class="col-md-6">
    <p class="cet-p" style="margin-bottom: 2px;"> Partenaires du projet cetcal :</p> 
    <div class="list-group">
      <?php foreach ($data as $row): ?>
        <?php if (strcmp($row['type'], 'partenaire') === 0): ?> 
          <a href="<?= $row['url']; ?>" class="list-group-item list-group-item-action cet-p" target="_blank">
            <?= $row['denomination'] ?>
            <span class="cet-span">
              <i class="fa fa-info-circle" aria-hidden="true"></i><small> <?= $row['description'] ?></small>
            </span>
            <?php if (!empty($row['tel'])): ?>
              <br>
              <span class="cet-span" style="float: right; font-weight: bold;">
                <i class="fa fa-phone" aria-hidden="true"></i> <?= $util->formatNTel($row['tel']); ?>
              </span>
            <?php endif; ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
