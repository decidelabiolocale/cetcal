<div id="cet-sondage-1-accordion">
  <div class="card cet-accordion">
    <div class="card-header" id="cet-sondage-1-heading">
      <label class="cet-formgroup-container-label"><small class="form-text">Pour mieux vous connaître - Enquête auprès des Producteur.e.s<br><b>Ces informations sont confidentielles</b></small></label>
      <h5 class="mb-0">
        <a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-sondage-1" aria-expanded="true" aria-controls="cet-sondage-1">
          Répondre à l'enquête.
        </a>
        <a class="align-middle" href="#" data-toggle="collapse" 
          data-target="#cet-sondage-1" aria-expanded="true" 
          aria-controls="cet-sondage-1">
          <i id="cet-accordion-icon-sondage-1" class="fa fa-hand-o-down cet-accordion-icon"></i>
        </a>
      </h5>
    </div>

    <div id="cet-sondage-1" class="collapse" aria-labelledby="cet-sondage-1-heading" data-parent="#cet-sondage-1-accordion">
      <div class="card-body">
        <label class="cet-formgroup-container-label"><small class="form-text"><b><i><?= CetQstprodConstTextes::informatif_sondage; ?></i></b></small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->sondage_divers as $divers): ?>
        <?php for ($i=0; $i < count($divers) - 1; $i++): ?>
          <?php if ($i == 0): ?>
            <br>
            <label class="cet-input-label"><small class="cet-qstprod-label-text"><?= $divers[$i][1]; ?></small></label>
          <?php endif; ?>
          <?php if ($i > 0): ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="<?= implode(';', $divers[$i]); ?>" 
                id="qstprod-sondage-<?= ++$counter; ?>" 
                name="qstprod-sondage[]"
                <?= isset($currentForm['qstprod-sondage']) && in_array(implode(';', $divers[$i]), $currentForm['qstprod-sondage']) ?
                  'checked="checked"' : $neant; ?>>
              <label class="form-check-label cet-input-label" 
                for="qstprod-sondage-<?= $counter; ?>"><?= $divers[$i][1]; ?></label>
            </div>
            <?php ++$counter; ?>
          <?php endif; ?>
        <?php endfor; ?>
        <?php endforeach; ?>
        <br>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Combien d’heures / semaine travaillez vous en moyenne (Hors pics de travail saisonniers) ?</small></label>
          <input class="form-control" id="qstprod-nbrheuressemaine" name="qstprod-nbrheuressemaine" type="number" min="0"
            step="1" placeholder="Nombre d’heures / semaine"
            value="<?= isset($currentForm['qstprod-nbrheuressemaine']) ? $currentForm['qstprod-nbrheuressemaine'] : $neant; ?>">
        </div>
        <label class="cet-input-label"><small class="cet-qstprod-label-text"><b>Votre activité nécessite :</b></small></label>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Nombre de poste de travail :</small></label>
          <input class="form-control" id="qstprod-nbrpostes" name="qstprod-nbrpostes" type="number" min="0"
            step="1" placeholder="Nombre de poste de travail"
            value="<?= isset($currentForm['qstprod-nbrpostes']) ? $currentForm['qstprod-nbrpostes'] : $neant; ?>">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Des emplois saisonniers :</small></label>
          <input class="form-control" id="qstprod-nbrsaisonniers" name="qstprod-nbrsaisonniers" type="number" min="0"
            step="1" placeholder="Nombre d'emplois saisonniers"
            value="<?= isset($currentForm['qstprod-nbrsaisonniers']) ? $currentForm['qstprod-nbrsaisonniers'] : $neant; ?>">
        </div>
        <a href="#cet-sondage-1-accordion" style="float: right; margin-bottom: 20px; color: white;" 
          class="btn btn-success btn-sm scrolltowards" data-toggle="collapse" data-target="#cet-sondage-1">
          <i><?= CetQstprodConstLibelles::close_form_area; ?></i>
          <i class="fa fa-hand-o-up cet-accordion-icon" style="color: white;"></i>
        </a>
      </div>
    </div>
  </div>
</div>