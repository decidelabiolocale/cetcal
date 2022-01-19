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
$datas = $ctrl->init($type);
$filtre = false;

if (isset($_GET['q']) && !empty($_GET['q']))
{
    $filtre = $dataProcessor->processHttpFormData($_GET['q']);
    $datas = $ctrl->loadQuery($filtre, $type);
}
$data = $datas[0];
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
                            <h2 class="text-center"><?=(isset($data)) ? $data->denomination : "" ?></h2>
                        </div>
                        <div class="card__producteur">
                            <div id="fichedetailleeprd-carousel" class="carousel slide" data-ride="carousel">
                                 <div class="carousel-item active" style="">
                                     <img class="img__producteur" src="/res/content/DCDL_biolocale_1.jpg" style="" />
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
                                <p></p>
                                <address>
                                    <p><?=(isset($data)) ? $data->denomination :""?></p>
                                    <p><?=(isset($data)) ? $data->adresse : ""?></p>
                                    <?=(isset($data) && strlen($data->tels) > 0) ?  "<p>".$data->tels . "</p>" : " " ?>
                                    <?= (isset($data) && strlen($data->email) > 0) ? "<p class='card_mail'>".$data->email . "</p>" : "" ?>
                                </address>
                                <div>
                                    <?=  (isset($data) && strlen($data->urlwww) > 0)  ?  "<a class='cst-pills' href=".$data->urlwww.">"."site web" . "</a>" : "" ?>
                                </div>
                            </div>
                            <div class="col-6 card__horaires">
                                <!--Jour/horaires-->
                                <h3>Jours / Horaires</h3>
                                <div>
                                    <?= (isset($data) && strlen($data->infoscmd) > 0) ? "<p class=''>".$data->infoscmd . "</p>" : "" ?>
                                    <?= (isset($data) && strlen($data->jourhoraire) > 0) ? "<p class=''>".$data->jourhoraire . "</p>" : "" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!--Fin wrapper-->
</div>