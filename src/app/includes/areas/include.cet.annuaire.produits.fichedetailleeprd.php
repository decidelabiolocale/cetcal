<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
$controller = new CETCALAnnuaireFicheDetailleController();
$produits = $controller->fetchProduitByPkProducteur($pk);
$productsCategories = $controller->fetchCategorieProduitByPkProducteur($pk);
$lieux = $controller->fetchAllLieuDistByPkProducteur($pk);
?>
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-xs-12 col-xl-8 col-md-12">
      <div class="cet-formgroup-container">
          <div class="row d-flex flex-column">
              <div class="mt-2">
                  <div class="ml-2">Types de production</div>
                  <?php foreach ( $productsCategories as $productCategorie) : ?>
                  <p class="cst-produits"><?= $productCategorie->categorie ?></p>
                  <?php endforeach; ?>
              </div>
              <div class="mt-2">
                  <div class="ml-2">Produits</div>
                  <?php foreach ( $produits as $produit) : ?>
                  <p class="cst-produits"><?=  $produit->nom ?></p>
                  <?php endforeach; ?>
              </div>
        </div>
    </div>
        <?php if(!empty($lieux)) :?>
        <div class="col-xs-12 col-md-12 col-xl-8">
            <table class="table mw-100" id="lieux-dist-table-recap-lieux">
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
                    <?php foreach ($lieux as $lieu) :?>
                    <tr>
                        <td><?=$lieu->type ?></td>
                        <td><?=$lieu->denomination ?></td>
                        <td><?=$lieu->date_lieu ?></td>
                        <td><?=$lieu->jour ?></td>
                        <td><?=$lieu->heure_deb ?></td>
                        <td><?=$lieu->heure_fin ?></td>
                        <td><?=$lieu->precisions ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
        <?php endif; ?>
  </div>
</div>