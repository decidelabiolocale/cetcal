<div id="homepage-seachbar-container">
    <section class="bg-slogan">
        <!--SEARCH BAR DEBUT VERSION DESKTOP-->
        <div class="d-none col-sm-12 col-md-12 col-lg-12 col-xl-12 searchbar-wrapper d-md-block d-lg-block d-xl-block p-0">
            <div class=" col-12 col-md-12 col-lg-12 col-xl-12 p-0">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12 input-wrapper w-100 d-flex justify-content-center flex-row flex-xl-row p-0">

                    <div class="col-3 d-flex p-0" id="cet-annuaire-recherche-communes-homepage-container">
                        <input class="search-input text-center searchtxt-bleu typeahead"
                               placeholder="Rechercher votre commune"
                               aria-label=""
                               id="cet-annuaire-recherche-communes-homepage-value"
                               name="cet-annuaire-recherche-communes-homepage-value"/>
                    </div>

                    <div class="d-flex col-3 p-0 perimeter-search justify-content-center align-items-center">

                        <div class="d-flex align-items-center ml-3 mr-3">
                            <span class="mt-0 searchtxt-rayon">rayon</span>
                        </div>
                        <div class="d-flex align-items-start flex-column">
                            <p class="mb-0 searchtxt-blanc">10km</p>
                            <input type="radio" id="perim-10" class="align-self-center rav-hp-perim" name="perim"
                                   value="10" checked="checked"/>
                            <label class="mb-0 searchtxt-blanc" for="perim-10"></label>
                        </div>
                        <div class="d-flex align-items-start flex-column ml-3">
                            <p class="mb-0 searchtxt-blanc">20km</p>
                            <input type="radio" id="perim-15" class="align-self-center rav-hp-perim" name="perim"
                                   value="20">
                            <label class="mb-0 searchtxt-blanc" for="perim-15"></label>
                        </div>
                        <div class="d-flex align-items-start flex-column ml-3">
                            <p class="mb-0 searchtxt-blanc">30km</p>
                            <input type="radio" id="perim-20" class="align-self-center rav-hp-perim" name="perim"
                                   value="30">
                            <label class="mb-0 searchtxt-blanc" for="perim-20"></label>
                        </div>
                        <div class="d-flex align-items-start flex-column ml-3 mr-3">
                            <p class="mb-0 searchtxt-blanc">40km</p>
                            <input type="radio" id="perim-40" class="align-self-center rav-hp-perim" name="perim"
                                   value="40">
                            <label class="mb-0 searchtxt-blanc" for="perim-40"></label>
                        </div>
                    </div>

                    <div class="col-3 d-flex p-0">
                        <label class="label" for="search-input"></label>
                        <input class="search-input text-center searchtxt-bleu" type="text"
                               placeholder="Nom, adresse, mot-clé, etc"
                               id="rav-homepage-critere" name="rav-homepage-critere"/>
                    </div>

                    <div class="col-2 p-0">
                        <div class="btn-wrapper d-flex">
                            <button class="btn-search text-center" id="rav-homepage-envoyer">Rechercher</button>
                            <a class="btn-search text-center" href="/?statut=recherche.avancee&anr=true"
                               id="afficher-recherche-avancee">Recherche avancée</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--SEARCH BAR FIN VERSION DESKTOP-->

        <!--SEARCH BAR DEBUT VERSION MOBILE-->
        <div class="d-block col-12 p-0 searchbar-wrapper d-sm-block d-md-none d-lg-none d-xl-none">
            <div class="col-12 p-0">
                <div class="col-12 p-0 input-wrapper w-100 d-flex flex-row flex-wrap">
                    <div class="col-12 d-flex p-0">
                        <label class="label" for="search-input"></label>
                        <input class="search-input text-center searchtxt-bleu" type="text"
                               placeholder="Rechercher votre commune" autocomplete="false"/>
                    </div>

                    <div class="col-12 d-flex p-0">
                        <div class="col-6 p-0">
                            <select class="form-control form-control-lg" id="rayon">
                                <option>----- Rayon -----</option>
                                <option>5 km</option>
                                <option>20 km</option>
                                <option>30 km</option>
                                <option>40 km</option>
                            </select>
                        </div>
                        <div class="col-6 p-0">
                            <div class="">
                                <button class="btn-search text-center">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--SEARCH BAR FIN VERSION MOBILE-->
    </section>

</div>