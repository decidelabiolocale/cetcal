<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$utils = new FormatUtils();
$controller = new CETCALAnnuaireFicheDetailleController();
$data = $controller->fetchProducteursDerniersInscrit(5);
?>
<!-- login & signup html forms -->
<div class="cet-module row justify-content-lg-center" style="margin-bottom: 6px;">
  <div class="col-lg-9">
    <div class="alert alert-light cet-bloc cet-borderless-alert" role="alert" style="background-color: white !important;">    
      <table class="table bordered-table">
        <tr>
          <td colspan="2" style="border-top: none !important;"><h4 class="alert-heading"><i class="far fa-thumbs-up fa-2x" style="color: #009c31;"></i> Les derniers Producteur.e.s inscrits à ce jour :</h4></td>
        </tr>
        <?php foreach ($data as $prdDto): ?>
          <?php 
            $adr = $prdDto->prodInscrit === 'false' ? $prdDto->adrfermeLtrl : 
              str_replace("  ", " ", $prdDto->adrNumvoie.' '.$prdDto->adrRue.' '.$prdDto->adrLieudit.' '.
              $prdDto->adrCommune.' '.$prdDto->adrCodePostal.' '.$prdDto->adrComplementAdr);
          ?>
          <tr class="prd-a-lhonneur-row">
            <td class="w-25">
              <span class="prd-a-lhonneur-denomination" onmousedown="cartographieFlyTo('<?= $prdDto->getLatLng(); ?>','/');">
                <?= html_entity_decode($utils->formatDenominationUpperCases(trim($prdDto->nomferme))); ?>                   
              </span>
            </td>
            <td class="w-75">
              &#160;<?= trim($adr); ?>, (<?= $utils->formatTypesProduction($prdDto->typeDeProduction); ?>).
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>