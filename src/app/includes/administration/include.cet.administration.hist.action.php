<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/admin/cet.annuaire.controlleur.administration.admins.php');
$ctrl = new AdminController();
$data_adm = $ctrl->selectAllActivite();
?>
<p>
  Utilisateur en cour d'administration : <b><?= $admlog; ?></b>
</p>
<button type="button" class="btn btn-link" 
  onclick="updateVisibiliteHistorique();">
  <i class="fas fa-search"></i>&#160;&#160;Visualiser tout l'historique des actions administrateur
</button>
<div class="table-wrapper-scroll-y custom-scrollbar" id="table-histo-admin-activites-container">
  <table class="table table-sm cetcal-admin-table" id="table-histo-admin-activites">
    <thead>
      <tr>
        <th scope="col">Auteur</th>
        <th scope="col">Action</th>
        <th scope="col">Date/heure</th>
        <th scope="col">Type élément</th>
        <th scope="col">Dénomination élément</th>
        <th scope="col">Commentaire admin</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data_adm as $data): ?>
        <tr class="admin-histo-action-row">
          <td><?= $data['adm_email']; ?></td>
          <td><?= $data['action_libelle_fonctionnel']; ?></td>
          <td><?= $data['date_heure_action']; ?></td>
          <td><?= $data['type_element']; ?></td>
          <td><?= $data['denomination_element']; ?></td>
          <td><?= $data['commentaire']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>