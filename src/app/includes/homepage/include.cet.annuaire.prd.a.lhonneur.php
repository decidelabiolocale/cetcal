<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.fichedetaillee.producteur.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$utils = new FormatUtils();
$controller = new CETCALAnnuaireFicheDetailleController();
$data = $controller->fetchProducteursDerniersInscrit(5);
?>
<section hidden="hidden">
    <div class="container-fluid pt-3 pb-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center pb-3">
                <span class="prd-highlight">Les derniers producteurs inscrits :</span>
            </div>
            <div class="col-12 d-flex flex-column flex-xl-row justify-content-between">
                <div class="card-last-prd mt-3">
                    <p class="denomination">TOTO</p>
                    <p class="comumne"></p>
                    <p class="lieu-dit"></p>
                    <p class="codepostal"></p>
                    <p class="type-production"></p>
                </div>
                <div class="card-last-prd mt-3">
                    <p class="denomination">TOTO</p>
                    <p class="comumne"></p>
                    <p class="lieu-dit"></p>
                    <p class="codepostal"></p>
                    <p class="type-production"></p>
                </div>
                <div class="card-last-prd mt-3">
                    <p class="denomination">TOTO</p>
                    <p class="comumne"></p>
                    <p class="lieu-dit"></p>
                    <p class="codepostal"></p>
                    <p class="type-production"></p>
                </div>
                <div class="card-last-prd mt-3">
                    <p class="denomination">TOTO</p>
                    <p class="comumne"></p>
                    <p class="lieu-dit"></p>
                    <p class="codepostal"></p>
                    <p class="type-production"></p>
                </div>
                <div class="card-last-prd mt-3">
                    <p class="denomination">TOTO</p>
                    <p class="comumne"></p>
                    <p class="lieu-dit"></p>
                    <p class="codepostal"></p>
                    <p class="type-production"></p>
                </div>
            </div>
        </div>
    </div>
</section>
