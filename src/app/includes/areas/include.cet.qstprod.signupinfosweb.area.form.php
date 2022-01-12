<div id="cet-infosweb-accordion">
  <div class="card cet-accordion">
    <div class="card-header" id="cet-infosweb-accordion-heading">
      <label class="cet-formgroup-container-label"><small class="form-text">Vos informations <b>Réseaux Sociaux, Web et Cagette</b> : </small></label>
      <h5 class="mb-0">
        <a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-infosweb" aria-expanded="true" aria-controls="cet-infosweb">
          Réseaux Sociaux et Web
        </a>
        <a class="align-middle" href="#" data-toggle="collapse" 
          data-target="#cet-infosweb" aria-expanded="true" 
          aria-controls="cet-infosweb">
          <i id="cet-accordion-icon-infosweb" class="fa fa-hand-o-down cet-accordion-icon"></i>
        </a>
      </h5>
    </div>

    <div id="cet-infosweb" class="collapse" aria-labelledby="cet-infosweb-accordion-heading" data-parent="#cet-infosweb-accordion">
      <div class="card-body">
        <label class="cet-formgroup-container-label" for="qstprod-www"><small class="form-text">Informations web et réseaux sociaux :</small></label>
        <div class="form-group mb-3"> 
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Page Facebook de la ferme :</small></label>
          <input class="form-control" id="qstprod-fb" name="qstprod-fb" type="text" 
          placeholder="Copiez-collez le lien de votre page Facebook"
          value="<?= isset($currentForm['qstprod-fb']) ? $currentForm['qstprod-fb'] : $neant; ?>"
          maxlength="60">
        </div>
        <div class="form-group mb-3"> 
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Quel est votre groupe cagette ?</small></label>
          <input class="form-control" id="qstprod-cagette" name="qstprod-cagette" type="text" 
            placeholder="Indiquer votre groupe cagette"
            value="<?= isset($currentForm['qstprod-cagette']) ? $currentForm['qstprod-cagette'] : $neant; ?>"
            maxlength="60">
        </div>
        <label class="cet-formgroup-container-label" for="qstprod-www"><small class="form-text">Avez-vous un site internet et/ou une boutique en ligne ?</small></label>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Site internet de votre exploitation :</small></label>
          <input class="form-control" id="qstprod-www" name="qstprod-www" type="text" 
          placeholder="Site internet de votre exploitation"
          value="<?= isset($currentForm['qstprod-www']) ? $currentForm['qstprod-www'] : $neant; ?>"
          maxlength="128">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Adresse web de votre boutique ligne :</small></label>
          <input class="form-control" id="qstprod-adrwebboutiqueenligne" name="qstprod-adrwebboutiqueenligne" 
          type="text" placeholder="Adresse web de boutique en ligne"
          value="<?= isset($currentForm['qstprod-adrwebboutiqueenligne']) ? $currentForm['qstprod-adrwebboutiqueenligne'] : $neant; ?>"
          maxlength="128">
        </div>
        <label class="cet-formgroup-container-label" for="qstprod-www"><small class="form-text">Si vous utilisez d'autres réseaux sociaux, dites nous lesquelles :</small></label>
        <div class="form-group mb-3">   
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Page Instagram de la ferme :</small></label>
          <input class="form-control" id="qstprod-ig" name="qstprod-ig" type="text" 
          placeholder="Nom de compte Instagram (si existant)"
          value="<?= isset($currentForm['qstprod-ig']) ? $currentForm['qstprod-ig'] : $neant; ?>"
          maxlength="60">
        </div>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Compte Twitter de la ferme :</small></label>   
          <input class="form-control" id="qstprod-twitter" name="qstprod-twitter" type="text" 
          placeholder="Compte Twitter de la ferme (si existant)"
          value="<?= isset($currentForm['qstprod-twitter']) ? $currentForm['qstprod-twitter'] : $neant; ?>"
          maxlength="60">
        </div>
        <a href="#cet-infosweb-accordion" style="float: right; margin-bottom: 20px; color: white;" 
          class="btn btn-success btn-sm scrolltowards" data-toggle="collapse" data-target="#cet-infosweb">
          <i><?= CetQstprodConstLibelles::close_form_area; ?></i>
          <i class="fa fa-hand-o-up cet-accordion-icon" style="color: white;"></i>
        </a>
      </div>
    </div>
  </div>
</div>