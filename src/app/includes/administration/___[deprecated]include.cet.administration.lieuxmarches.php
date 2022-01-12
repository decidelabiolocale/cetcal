<div id="cet-admin-1-accordion">
  <div class="card cet-accordion-admin">
  	<div class="card-header" id="cet-admin-1-heading">
  	  <label class="cet-formgroup-container-label"><small class="form-text">
  	  	Cette section vous aidera à administrer les marchés et lieux de distribution.
  	  </small></label>
      <h5 class="mb-0">
      	<a class="badge badge-success cet-accordion-badge" href="#" data-toggle="collapse" data-target="#cet-admin-1" aria-expanded="true" aria-controls="cet-admin-1">
            Administrer les marchés.
  	    </a>
      	<a class="align-middle" href="#" data-toggle="collapse" 
        		data-target="#cet-admin-1" aria-expanded="true" 
        		aria-controls="cet-admin-1">
        		<i id="cet-accordion-icon-admin-main-1" class="fa fa-hand-o-down cet-accordion-icon"></i>
      	</a>
  	  </h5>
    </div>

    <div id="cet-admin-1" class="collapse" aria-labelledby="cet-admin-1-heading" data-parent="#cet-admin-1-accordion">
      <div class="card-body">
      	
        <!-- Start Formulaire -->
        <form class="form" action="/src/app/controller/cet.annuaire.controller.administration.actions.php" method="post">
          <!-- le premier input hidden déffini l'action, en dure. -->
          <input name="admin_action_cible" id="admin_action_cible" type="text" hidden="hidden" value="marcheslieux">
          
          <?php
            require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.controller.marches.castillonnais.php');
            $ctrl = new MarchesCastillonnaisController();
            $data_lieux_marches = $ctrl->selectAll();
          ?>

          <?php
            // itérer sur data_lieux_marches : context modification. Pour le moment : var dump :
            var_dump($data_lieux_marches);
          ?>

        </form>
        <!-- End Formulaire -->

      </div>
    </div>
  </div>
</div>