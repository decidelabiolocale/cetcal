<div id="cet-admin-3-accordion">
  <div class="card cet-accordion-admin-critique">
  	<div class="card-header" id="cet-admin-3-heading">
  	  <label class="cet-formgroup-container-label"><small class="form-text">
  	  	Cette section permet la gestion des administrateurs et habilitations decidelabiolocale.org
  	  </small></label>
      <h5 class="mb-0">
    	<a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-3" aria-expanded="true" aria-controls="cet-admin-3">
          Administrer les habilitations.
	    </a>
    	<a class="align-middle" href="#" data-toggle="collapse" 
      		data-target="#cet-admin-3" aria-expanded="true" 
      		aria-controls="cet-admin-3">
      		<i id="cet-accordion-icon-admin-main-3" class="fa fa-hand-o-down cet-accordion-icon"></i>
    	</a>
  	  </h5>
    </div>

    <div id="cet-admin-3" class="collapse" aria-labelledby="cet-admin-3-heading" data-parent="#cet-admin-3-accordion">
      <div class="card-body">
        <?php
          require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/admin/cet.annuaire.controlleur.administration.admins.php');
          $ctrl = new AdminController();
          $data_admins = $ctrl->selectAll();
        ?>

        <table class="table table-sm cetcal-admin-table">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Email</th>
              <th scope="col">Nom d'utilisateur</th>
              <th scope="col" colspan="6">Habilitations</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_admins as $data): ?>
              <tr id="row-admin-cetcal-<?= $data['adm_id']; ?>">
                <td class="cetcal-admin-table-td"><?= $data['adm_id']; ?></td>
                <td class="cetcal-admin-table-td">
                  <?= $data['adm_email']; ?>
                </td>
                <td class="cetcal-admin-table-td">
                  <?= $data['adm_usr_name']; ?>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_producteurs[]" id="hab_producteurs_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_producteurs'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Producteurs</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_certif_bioab[]" id="hab_certif_bioab_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_certif_bioab'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Certifications BIO/AB</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_entites[]" id="hab_entites_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_entites'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Entités (marchés, AMAPs ect...)</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_geoloc[]" id="hab_geoloc_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_geoloc'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Géolocalisations</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_admins[]" id="hab_admins_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_admins'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Gestion des admins</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td">
                  <div class="form-check">
                    <input class="form-check-input" value="<?= $data['adm_id']; ?>" type="checkbox" 
                      name="hab_histo[]" id="hab_histo_<?= $data['adm_id']; ?>"
                      <?= strcmp($data['hab_histo'], 'true') === 0 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" style="color: black !important;">Accès à l'historique d'activités admins</label>
                  </div>
                </td>
                <td class="cetcal-admin-table-td" style="text-align: center;">
                  <div class="btn-group" style="padding: 6px;">
                    <button class="administration-desactiver-admin btn-small btn btn-outline-danger" 
                      title="Désactiver l'administrateur n°<?= $data['adm_id']; ?>"
                      data="<?= $data['adm_id']; ?>"
                      style="padding: 4px !important;">
                      <i class="fas fa-user-times"></i>
                    </button> 
                    <button class="administration-update-admin btn-small btn btn-outline-primary" 
                      title="Mettre à jour l'administrateur n°<?= $data['adm_id']; ?>"
                      data="<?= $data['adm_id']; ?>"
                      style="padding: 4px !important;">
                      <i class="fas fa-user-check"></i>
                    </button> 
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>