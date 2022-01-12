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

$produits = $controller->fetchProduitByPkProducteur($pk);
$productsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);
$lieux = $controller->fetchAllLieuDistByPkProducteur($pk);
?>
<div class="container-fluid ficheprd__wrapper">

  <div class="container d-flex justify-content-center">
    <!--debut wrapper-->
    <div class="wrapper__ficheprd">
      <section>
        <div class="row">
          <div class="col-12 d-flex justify-content-center p-0">
            <img class="w-75 w-xl-auto mw-100" src="res/documentation/images-site/qui-sommes-nous.png" alt="Max-width 100%" >
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-12">
            <!--logos-->
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-12 d-flex justify-content-center p-0">
            <div class="card__producteur d-flex justify-content-center align-items-center">
              <h2 class="text-center"><?= $data['nom_ferme'] ?></h2>
            </div>
            <div class="card__producteur">
              <?php $media_data = $media_controller->selectMediasProducteur($pk); $counter = 0; ?>
              <div id="fichedetailleeprd-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <?php foreach ($media_data as $media): ?>
                    <div class="carousel-item <?= $counter == 0 ? 'active' : $neant; ?>"
                     style="">
                     <img class="img__producteur" src="<?= $media['urlr']; ?>" style="" />
                   </div>
                   <?php ++$counter; ?>
                 <?php endforeach; ?>
                 <?php if ($counter == 0): ?>
                  <div class="carousel-item active" style="">
                    <img class="img__producteur" src="/res/content/DCDL_biolocale_1.jpg" style="" />
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>
        <section hidden="hidden">
          <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center p-0">
              <!--texte-->
              <div class="d-flex align-items-center text__presentation">
                <p class="text-center">
                </p>
              </div>

            </div>
          </div>
        </section>

        <section class="d-flex justify-content-center">
          <div class="wrapper_infoprd">
            <div class="row">
              <div class="col-12 d-flex">
                <div class="col-6 card__coordonnees">
                  <!-- coordonnées-->
                  <h3>Coordonnées</h3>
                  <p><?= ucfirst($data['prenom']); ?> <?= ucfirst($data['nom']); ?></p>
                  <address>
                    <?php
                    $adr = str_replace("  ", " ", $data['adrferme_numvoie'].' '.$data['adrferme_rue'].' '
                      .$data['adrferme_lieudit'].' '.$data['adrferme_commune'].' '
                      .$data['adrferme_cp'].' '.$data['adrferme_compladr']);
                      ?>
                      <p><?= $adr?></p>
                      <?=  (isset($data["telfixe"]))  ?  "<p>".$data['telfixe'] . "</p>" : "" ?>
                      <?=  (isset($data["telport"]))  ?  "<p>".$data['telport'] . "</p>" : "" ?>
                      <?=  (isset($data["email"]))  ?  "<p class='card_mail'>".$data['email'] . "</p>" : "" ?>
                    </address>
                    <div>
                      <?=  (strlen($data["url_web"]) > 0)  ?  "<a class='cst-pills' href=".$data["url_web"].">"."site web" . "</a>" : "" ?>
                      <?=  (strlen($data["pageurl_fb"]) > 0)  ?  "<a class='cst-pills' href=".$data["pageurl_fb"].">"."facebook" . "</a>" : "" ?>

                    </div>
                  </div>
                  <div class="col-6 card__production">
                    <!--production-->
                    <h3>Production</h3>
                    <div>
                      <?php foreach ($produits as $produit) : ?>
                        <span class="cst-pills"><?=  $produit->nom ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 d-flex">
                  <div class="col-6 card__autre">
                    <!--ouverture au public-->
                  </div>
                  <div class="col-6 card__lieuxvente">
                    <!--Lieux de vente-->
                    <h3>Lieux de vente</h3>
                    <div>
                      <?php foreach ($lieux as $lieu): ?>
                        <div class="lieux-vente-producteur">
                          <p><?= $lieu->denomination?></p>
                          <p><?= $lieu->precisions?></p>
                        </div>
                      <?php endforeach;?>
                    </div>
                  </div>
                </div>
              </div>
              <!--end of row-->

            </div>
          </section>
          <?php if($certif_bioab != false): ?>
            <section>
              <div class="row">
                <div class="col-12 p-0">
                  <div class="wrapper__certif ">
                    <!--logos AB-->
                    <div class="d-flex align-items-center">
                      <img src="/res/content/icons/logos-verts-europe-ab.png">
                      <a href="<?= $certif_bioab['url_org_certif']; ?>">consulter la certification bio AB</a>
                    </div>
                  </div>
                </div>
                <!--end of row-->
              </div>
            </section>
          <?php endif;?>
        </div>
      </div>
      <!--Fin wrapper-->

    </div>


