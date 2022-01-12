<div class="modal fade" tabindex="-1" id="modal-cet-carto-gestion" role="dialog" 
  style="display: none;">
  <div class="modal-dialog modal-lg" role="document" style="overflow-y: initial !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title cet-qstprod-label-text" style="color: rgb(30,40,30) !important;">Aide et paramètres de cartographie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cet-bloc" id="modal-cet-carto-gestion-body"
        style="height: 72vh; overflow-y: auto;">
        <p>Lexique des icônes : </p>
        <ul id="liste-icones-fonctions"></ul>
        <p><i>Questions, réponses :</i></p> 
        <ul>
          <li>
            <i><b>Comment faire si je ne trouve pas ma commune dans le champ de recherche ?</b></i><br>
            <span style="margin: 6px; display: inline-block;">La liste de communes n'est pas encore exhaustive. Pour le moment, si votre commune ne vous est pas proposée dans la recherche, veuillez rechercher une commune à proximité.</span>
          </li>
          <li>
            <i><b>Sur la carte, je constate une information faisant défaut, que faire ?</b></i><br>
            <span style="margin: 6px; display: inline-block;">Notre projet est collaboratif et votre aide est précieuse !<br>Dans ce cas, <u>veuillez nous contacter depuis le formulaire suivant :</u></span>
            <p style="text-align: center;"><br><a class="btn cet-navbar-btn cet-navbar-btn-small" href="/?statut=contact.form&anr=true&em=&ntp=&demande=jeconstateuneerreurdecarto">Je constate un défaut de localité ou d'information sur la carte</a></p>
            <span style="margin: 6px; display: inline-block;">Merci par avance.</u></span>
          </li>
        </ul>
        
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
              <button id="" class="btn cet-navbar-btn cet-navbar-btn-small" type="button">Appliquer</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer cet-bloc">
        <button type="button" class="btn cet-navbar-btn" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-success" id="modal-cet-carto-gestion-btn" data-toggle="modal" data-target="#modal-cet-carto-gestion" hidden="hidden"></button>