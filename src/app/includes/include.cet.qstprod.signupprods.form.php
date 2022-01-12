<?php
$neant = '';
$currentForm = isset($_SESSION['signupprods.form.post']) ? $_SESSION['signupprods.form.post'] : array();
$cntxmdf = isset($_SESSION['CONTEXTE_MODIF-signupprods']) ? $_SESSION['CONTEXTE_MODIF-signupprods'] : false;
?>
<!-- singup produits html form -->
<div class="row justify-content-lg-center">
  <div class="col-lg-6">
    <form id="signupprods.form" class="form" method="post" 
      action="/src/app/controller/cet.qstprod.controller.signupprods.form.php"
      onload="setupRechercheProduit();">
      <?php include $PHP_INCLUDES_PATH.'areas/include.cet.qstprod.signup.entete.form.php'; ?>
      <!-- ------------------------- -->
      <!-- INPUTS formulaire START : ---
      <input class="form-control" id="qstprod-" name="qstprod-" type="text" placeholder="">
      ---- ------------------------- -->
      <br>
      <label class="cet-formgroup-container-label"><small class="form-text">Spécificités de vos produits, Label, type d'agriculture, etc :</small></label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Spécificités de vos produits, Label, type d'agriculture, etc. (plusieurs options possibles) :</small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->type_culture as $typeculture): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $typeculture); ?>" id="qstprod-typeculture-<?=$counter; ?>" 
            name="qstprod-typescultures[]"
            <?= isset($currentForm['qstprod-typescultures']) && in_array(implode(';', $typeculture), $currentForm['qstprod-typescultures']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-typeculture-<?= $counter; ?>"><?= $typeculture[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>  
          <input class="form-control" id="qstprod-typeculture-autre" name="qstprod-typeculture-autre" 
            type="text" placeholder="Quel autre spécificité, label ou type d'agriculture ?" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-typescultures'], $listes_arrays->type_culture); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-typeculture-autre']) ? $currentForm['qstprod-typeculture-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
      </div>

      <label class="cet-formgroup-container-label"><small class="form-text">Quels produits vendez-vous ?</small></label>
      <div class="cet-formgroup-container">        
        <label><small class="form-text">Quels <b>légumes</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_legumes as $pv4Legumes): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $pv4Legumes); ?>" id="qstprod-produit-legume-<?= $counter; ?>" 
            name="qstprod-produits-legumes[]"
            <?= isset($currentForm['qstprod-produits-legumes']) && in_array(implode(';', $pv4Legumes), $currentForm['qstprod-produits-legumes']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-legume-<?= $counter; ?>"><?= $pv4Legumes[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-legume-autre" name="qstprod-produit-legume-autre" 
            type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-legumes'], $listes_arrays->produits_v4_legumes); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-legume-autre']) ? $currentForm['qstprod-produit-legume-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quelles <b>viandes</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_viandes as $pv4viande): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $pv4viande); ?>" id="qstprod-produit-viande-<?= $counter; ?>" 
            name="qstprod-produits-viandes[]"
            <?= isset($currentForm['qstprod-produits-viandes']) && in_array(implode(';', $pv4viande), $currentForm['qstprod-produits-viandes']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-viande-<?= $counter; ?>"><?= $pv4viande[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-viande-autre" name="qstprod-produit-viande-autre" 
            type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-viandes'], $listes_arrays->produits_v4_viandes); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-viande-autre']) ? $currentForm['qstprod-produit-viande-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>produits laitiers</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_laitiers as $pv4laitier): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $pv4laitier); ?>" id="qstprod-produit-laitier-<?= $counter; ?>" 
            name="qstprod-produits-laitiers[]"
            <?= isset($currentForm['qstprod-produits-laitiers']) && in_array(implode(';', $pv4laitier), $currentForm['qstprod-produits-laitiers']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-laitier-<?= $counter; ?>"><?= $pv4laitier[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-laitier-autre" 
            name="qstprod-produit-laitier-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-laitiers'], $listes_arrays->produits_v4_laitiers); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-laitier-autre']) ? $currentForm['qstprod-produit-laitier-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>produits de la ruche</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_mielruche as $pv4mielruche): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $pv4mielruche); ?>" id="qstprod-produit-mielruche-<?= $counter; ?>" 
            name="qstprod-produits-mielsruches[]"
            <?= isset($currentForm['qstprod-produits-mielsruches']) && in_array(implode(';', $pv4mielruche), $currentForm['qstprod-produits-mielsruches']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-mielruche-<?= $counter; ?>"><?= $pv4mielruche[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-mielruche-autre" 
            name="qstprod-produit-mielruche-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-mielsruches'], $listes_arrays->produits_v4_mielruche); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-mielruche-autre']) ? $currentForm['qstprod-produit-mielruche-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>fruits</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_fruits as $fruit): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $fruit); ?>" id="qstprod-produit-fruit-<?= $counter; ?>" 
            name="qstprod-produits-fruits[]"
            <?= isset($currentForm['qstprod-produits-fruits']) && in_array(implode(';', $fruit), $currentForm['qstprod-produits-fruits']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-fruit-<?= $counter; ?>"><?= $fruit[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-fruit-autre" name="qstprod-produit-fruit-autre" type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-fruits'], $listes_arrays->produits_v4_fruits); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-fruit-autre']) ? $currentForm['qstprod-produit-fruit-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>champignons</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_champignons as $champignon): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $champignon); ?>" id="qstprod-produit-champignon-<?= $counter; ?>" 
            name="qstprod-produits-champignons[]"
            <?= isset($currentForm['qstprod-produits-champignons']) && in_array(implode(';', $champignon), $currentForm['qstprod-produits-champignons']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-champignon-<?= $counter; ?>"><?= $champignon[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-champignon-autre" name="qstprod-produit-champignon-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-champignons'], $listes_arrays->produits_v4_champignons); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-champignon-autre']) ? $currentForm['qstprod-produit-champignon-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quelles <b>boissons</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_boissons as $boisson): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $boisson); ?>" id="qstprod-produit-boisson-<?= $counter; ?>" 
            name="qstprod-produits-boissons[]"
            <?= isset($currentForm['qstprod-produits-boissons']) && in_array(implode(';', $boisson), $currentForm['qstprod-produits-boissons']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-boisson-<?= $counter; ?>"><?= $boisson[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-boisson-autre" 
            name="qstprod-produit-boisson-autre" type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-boissons'], $listes_arrays->produits_v4_boissons); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-boisson-autre']) ? $currentForm['qstprod-produit-boisson-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quelles <b>plantes</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_plantes as $plante): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $plante); ?>" id="qstprod-produit-plante-<?= $counter; ?>" 
            name="qstprod-produits-plantes[]"
            <?= isset($currentForm['qstprod-produits-plantes']) && in_array(implode(';', $plante), $currentForm['qstprod-produits-plantes']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-plante-<?= $counter; ?>"><?= $plante[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-plante-autre" name="qstprod-produit-plante-autre" 
            type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-boissons'], $listes_arrays->produits_v4_boissons); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-boisson-autre']) ? $currentForm['qstprod-produit-boisson-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>plants et semences</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_semences as $semence): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $semence); ?>" id="qstprod-produit-semence-<?= $counter; ?>" 
            name="qstprod-produits-semences[]"
            <?= isset($currentForm['qstprod-produits-semences']) && in_array(implode(';', $semence), $currentForm['qstprod-produits-semences']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-semence-<?= $counter; ?>"><?= $semence[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-semence-autre" 
            name="qstprod-produit-semence-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-semences'], $listes_arrays->produits_v4_semences); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-semence-autre']) ? $currentForm['qstprod-produit-semence-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
      </div>

      <label class="cet-formgroup-container-label"><small class="form-text">Quels autres produits vendez-vous ?</small></label>
      <div class="cet-formgroup-container">
        <label><small class="form-text">Quels <b>produits transformés</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_transformes as $transforme): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $transforme); ?>" id="qstprod-produit-transforme-<?= $counter; ?>" 
            name="qstprod-produits-transformes[]"
            <?= isset($currentForm['qstprod-produits-transformes']) && in_array(implode(';', $transforme), $currentForm['qstprod-produits-transformes']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-transforme-<?= $counter; ?>"><?= $transforme[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-transforme-autre" 
            name="qstprod-produit-transforme-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-transformes'], $listes_arrays->produits_v4_transformes); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-transforme-autre']) ? $currentForm['qstprod-produit-transforme-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quelles <b>céréales et dérivés/légumineuses</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_cereales as $cereale): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $cereale); ?>" id="qstprod-produit-cereale-<?= $counter; ?>" 
            name="qstprod-produits-cereales[]"
            <?= isset($currentForm['qstprod-produits-cereales']) && in_array(implode(';', $cereale), $currentForm['qstprod-produits-cereales']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-cereale-<?= $counter; ?>"><?= $cereale[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-cereale-autre" 
            name="qstprod-produit-cereale-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-cereales'], $listes_arrays->produits_v4_cereales); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-cereale-autre']) ? $currentForm['qstprod-produit-cereale-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>produits d'hygiène</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_hygienes as $hygiene): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $hygiene); ?>" id="qstprod-produit-hygiene-<?= $counter; ?>" 
            name="qstprod-produits-hygienes[]"
            <?= isset($currentForm['qstprod-produits-hygienes']) && in_array(implode(';', $hygiene), $currentForm['qstprod-produits-hygienes']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-hygiene-<?= $counter; ?>"><?= $hygiene[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-hygiene-autre" 
            name="qstprod-produit-hygiene-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-hygienes'], $listes_arrays->produits_v4_hygienes); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-hygiene-autre']) ? $currentForm['qstprod-produit-hygiene-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>produits d'entretien</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_entretiens as $entretien): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $entretien); ?>" id="qstprod-produit-entretien-<?= $counter; ?>" 
            name="qstprod-produits-entretiens[]"
            <?= isset($currentForm['qstprod-produits-entretiens']) && in_array(implode(';', $entretien), $currentForm['qstprod-produits-entretiens']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-entretien-<?= $counter; ?>"><?= $entretien[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-entretien-autre" 
            name="qstprod-produit-entretien-autre" type="text"
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-entretiens'], $listes_arrays->produits_v4_entretiens); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-entretien-autre']) ? $currentForm['qstprod-produit-entretien-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>nourriture pour animaux</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_animaux as $animal): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $animal); ?>" id="qstprod-produit-animal-<?= $counter; ?>" 
            name="qstprod-produits-animaux[]"
            <?= isset($currentForm['qstprod-produits-animaux']) && in_array(implode(';', $animal), $currentForm['qstprod-produits-animaux']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-animal-<?= $counter; ?>"><?= $animal[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-animal-autre" name="qstprod-produit-animal-autre" type="text" 
            placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-animaux'], $listes_arrays->produits_v4_animaux); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-animal-autre']) ? $currentForm['qstprod-produit-animal-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quels <b>poissons ou coquillage</b> vendez-vous ? (plusieurs options possibles) : </small></label>
        <?php $counter = 0; ?>
        <?php foreach ($listes_arrays->produits_v4_poissons as $poisson): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="<?= implode(';', $poisson); ?>" id="qstprod-produit-poisson-<?= $counter; ?>" 
            name="qstprod-produits-poissons[]"
            <?= isset($currentForm['qstprod-produits-poissons']) && in_array(implode(';', $poisson), $currentForm['qstprod-produits-poissons']) ? 
              'checked="checked"' : $neant; ?>>
          <label class="form-check-label cet-qstprod-label-text" for="qstprod-produit-poisson-<?= $counter; ?>"><?= $poisson[1]; ?></label>
        </div>
        <?php ++$counter; ?>
        <?php endforeach; ?>
        <div class="form-group mb-3">
          <label class="cet-input-label"><small class="cet-qstprod-label-text">Si autre, merci de préciser :</small></label>   
          <input class="form-control" id="qstprod-produit-poisson-autre" name="qstprod-produit-poisson-autre" 
            type="text" placeholder="Dites-nous quel autre produit" maxlength="45"
            <?php if ($cntxmdf): ?> 
              value="<?= $formHelper->getSaisieAutreSiExiste($currentForm['qstprod-produits-poissons'], $listes_arrays->produits_v4_poissons); ?>"
            <?php else: ?>
              value="<?= isset($currentForm['qstprod-produit-poisson-autre']) ? $currentForm['qstprod-produit-poisson-autre'] : $neant; ?>"
            <?php endif; ?>
          >
        </div>
        <br>
        <label><small class="form-text">Quel <b>autre produit</b> vendez-vous ? (si les réponses font défaut, merci de nous renseigner) : </small></label>
        <div class="form-group mb-3">
          <input class="form-control" id="qstprod-produit-autre-autre" 
            name="qstprod-produit-autre-autre" type="text" 
            placeholder="Dites-nous quel autre produit"
            value="<?= isset($currentForm['qstprod-produit-autre-autre']) ? $currentForm['qstprod-produit-autre-autre'] : $neant; ?>"
            maxlength="45">
        </div>
      </div>

      <div class="row cet-qstprod-btnnav">
        <div class="col text-center">
          <button class="btn cet-navbar-btn" type="submit" onmousedown="$('#qstprod-signupprods-nav').val('retour');"
            id="btn-signupprods.form-retour"><?= CetQstprodConstLibelles::form_retour; ?></button>
          <button class="btn cet-navbar-btn" type="submit" onmousedown="$('#qstprod-signupprods-nav').val('valider');"
            id="btn-signupprods.form-valider"><?= CetQstprodConstLibelles::form_valider; ?></button>
        </div>
      </div>

      <input type="text" name="cetcal_session_id" id="cetcal_session_id" value="<?= $cetcal_session_id; ?>" hidden="hidden">
      <input type="text" name="qstprod-signupprods-nav" id="qstprod-signupprods-nav" value="unset" hidden="hidden">
      <input type="text" name="qstprod-signupprods-nav-pindex" id="qstprod-signupprods-nav-pindex" value="unset" hidden="hidden">
    </form>
  </div>
</div>
<script src="/src/scripts/js/cetcal/cetcal.min.signupprods.js"></script>