<div class="cet-module row justify-content-lg-center" id="parametres-recherche-detaillee-carto-cet" style="display: none;">
  <div class="col-lg-9">
    <div class="alert alert-light cet-borderless-alert" role="alert" style="color: rgb(50,70,50);">
      <button type="button" id="parametres-recherche-detaillee-carto-cet-toggle" class="close" label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">Aide et paramètres de cartographie.</h4>
      <hr>
      <p>Lexique des icônes : </p>
      <ul id="liste-icones-fonctions"></ul>
      
      <div style="display: none;">
        <p>Changer le style de la cartographie CETCAL :</p>
        <div class="input-group">
          <select class="custom-select" name="liste-styles-mapbox-style" 
            id="liste-styles-mapbox-style">
            <?php $counter = 0; ?>
            <?php foreach ($listes_arrays->styles_mapbox as $style): ?>
              <?php $dstyle = explode(";", $style) ?>
              <option value="<?= $dstyle[0] ?>" <?= ++$counter === 1 ? "selected" : ""; ?>><?= $dstyle[1] ?></option>
            <?php endforeach; ?>
          </select>
          <div class="input-group-append" id="siste-styles-mapbox-style-appliquer">
            <button id="" class="btn btn-outline-success" type="button">Appliquer</button>
          </div>
        </div>
      </div>
      <hr>
      <p class="mb-0"></p>
    </div>
  </div>
</div>