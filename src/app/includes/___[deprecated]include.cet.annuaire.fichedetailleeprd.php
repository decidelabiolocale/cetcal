<?php
$neant = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/media/cet.qstprod.controller.media.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.qstprod.controller.certification.bioab.php');
$pk = $_GET['pkprd'];
$controller = new CETCALAnnuaireFicheDetailleController();
$media_controller = new MediaController();
$certif_controller = new CertificationBioABProducteurController();
$data = $controller->fetchProducteurByPk($pk);
$certif_bioab = $certif_controller->getCertificationProducteur($pk);
?>

<div class="container">
  <div class="row d-flex justify-content-center flex-column-reverse flex-md-row flex-xl-row">
    <div class="col-xs-12 col-md-8 col-xl-4">
      <div class="cet-formgroup-container" style="overflow-wrap: break-word;">
        <h4 id="fichedetailleeprd-nom-ferme"><?= ucfirst($data['nom_ferme']); ?></h4>
        <?php if (isset($certif_bioab) && $certif_bioab !== false && strlen($certif_bioab['url_org_certif']) > 7): ?> 
          <div class="row justify-content-center" style="margin-bottom: 12px;">
            <div class="col-8">
              <a href="<?= $certif_bioab['url_org_certif']; ?>" target="_blank">
                <img class="img-fluid" src="/res/content/icons/logos-verts-europe-ab.png"/>
              </a>
            </div>
          </div>
        <?php endif; ?>
        <?php $logo_ferme = $media_controller->selectSrcLogoFemreProducteur($pk); ?>
        <?php if (isset($logo_ferme) && strlen($logo_ferme) > 1): ?> 
          <p>
            <img class="fichedetailleeprd-logo-ferme img-fluid" src="<?= $logo_ferme; ?>"/>
          </p>
        <?php endif; ?>
        <p>
          <span><?= ucfirst($data['prenom']); ?> <?= ucfirst($data['nom']); ?></span><br>
          <?php
            $adr = str_replace("  ", " ", $data['adrferme_numvoie'].' '.$data['adrferme_rue'].' '
              .$data['adrferme_lieudit'].' '.$data['adrferme_commune'].' '
              .$data['adrferme_cp'].' '.$data['adrferme_compladr']);
          ?>
          <span><?= $adr; ?></span><br>
          <span>Tél : <?= $data['telfixe']; ?></span><br>
          <span>Tél mobile : <?= $data['telport']; ?></span><br>
          <span>Email : <?= $data['email']; ?></span><br>
          <span>Site web : <br>
            <a href="<?= $data['url_web']; ?>" target="_blank"><?= $data['url_web']; ?></a>
          </span><br>
          <span>Boutique en ligne : <br>
            <a href="<?= $data['url_boutique']; ?>" target="_blank"><?= $data['url_boutique']; ?></a>
          </span><br>
          <?php if (isset($data['pageurl_fb']) && strlen($data['pageurl_fb']) > 3): ?>
            <span>
              <a href="<?= $data['pageurl_fb']; ?>" target="_blank"><img class="cet-crt-icon" src="/res/content/icons/facebook-flat-icon.png" height="42"/></a>
            </span>
          <?php endif; ?>
          <?php if (isset($data['pageurl_ig']) && strlen($data['pageurl_ig']) > 3): ?>
            <span>
              <a href="<?= $data['pageurl_ig']; ?>" target="_blank"><img class="cet-crt-icon" src="/res/content/icons/ig-flat-icon_256.png" height="42"/></a>
            </span>
          <?php endif; ?>
          <?php if (isset($certif_bioab) && $certif_bioab !== false && strlen($certif_bioab['url_org_certif']) > 7): ?>
            <a class="btn btn-small btn-outline-success" href="<?= $certif_bioab['url_org_certif']; ?>" target="_blank" style="margin-top: 12px;">
              <b><i class="fas fa-stamp"></i>&#160;&#160;Consulter la certification BIO/AB de <?= ucfirst($data['nom_ferme']); ?></b>
            </a>
          <?php endif; ?>
        </p>
      </div>
    </div>
    <div class="col-xs-12 col-md-4 col-xl-4">
      <div style="overflow-wrap: break-word; margin-bottom: 16px !important;">
        <?php $media_data = $media_controller->selectMediasProducteur($pk); $counter = 0; ?>
        <div id="fichedetailleeprd-carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php foreach ($media_data as $media): ?>
              <div class="carousel-item <?= $counter == 0 ? 'active' : $neant; ?>"
                style="">
                <img class="img-fluid" src="<?= $media['urlr']; ?>" style="" />
              </div>
              <?php ++$counter; ?>
            <?php endforeach; ?>  
            <?php if ($counter == 0): ?>
              <div class="carousel-item active" style="">
                <img class="img-fluid" src="/res/content/DCDL_biolocale_1.jpg" style="" />
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $PHP_INCLUDES_PATH.'/areas/include.cet.annuaire.produits.fichedetailleeprd.php'; ?>
<script src="/src/scripts/js/cetcal/cetcal.min.fichedetailleeprd.js"></script>