<div class="row justify-content-lg-center" id="cetcal-cnx-done" style="background-color: #bdddea; margin-bottom: -36px !important;">
  <div class="col-lg-9">

    <div class="alert" role="alert" style="color: rgb(50,70,50); padding-top: 36px; padding-bottom: 56px;"
      id="espace-prd-header-area">   
      <?php if (intval($cnx) === CetConnectionConst::CONNECTION_UTSR_REUSSIE): ?>
        <h3 class="alert-heading">Bienvenu.</h3>
        <hr>
        <p>Des fonctionnalités vous seront proposées très prochainement</p>
        <p><b>Merci pour votre inscription et engagement</b>,<br>l'équipe decidelabiolocale.org</p>
        <br><br>
      <?php endif; ?>
      <?php if (intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE): ?>
        <?php $nomFerme = $ctrl->fetchDonneeProducteur($usrpk, 'nom_ferme'); ?>
        <h3 class="alert-heading">
          Votre espace Producteur.e dédié à &#171;&#160;<?= $nomFerme; ?>&#160;&#187;</span>
        </h3>
        <hr>
        <?php if ($cnxmessage !== false): ?>
          <?php if (strcmp($cnxmessage, CetConnectionConst::MODIFICATION_QSTPROD_REUSSIE) === 0): ?>
            <h4><i class="far fa-thumbs-up fa-2x" style="color: #17a2b8; margin-bottom: -6px !important;"></i>&#160;Vos données Producteur.e.s ont été mises à jour avec succès.</h4>
            <p>Un email de confirmation vient d'être envoyé sur votre boite mail, à l'adresse <b><?= $usr_identifiant; ?></b></p>
          <?php endif; ?>
          <hr>
        <?php endif; ?>
        
        <span class="form-text cet-qstprod-label-text">
          Pour modifier ou compléter toutes les information renseignées lors de votre inscription, utiliser les fonctionnalités ci-dessous.
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;">
            L'ensemble des données fournies lors de votre inscription sont modifiables. La mise à jour de ces dernières vous permets de préciser ou compléter vos informations mais aussi de mieux vous faire connaître auprès des consomateurs et clients.
          </small>
        </span>
        <br>
        <label>
          <small class="form-text cet-qstprod-label-text" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#" class="cet-green-link cet-conditions-donnees-numerique"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <hr>
      <?php endif; ?>

      <?php if (intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE): ?>
        <script type="text/javascript">$('#cet-qstprod_seconnecter').hide();</script>
        <div class="alert alert-light" role="alert" 
          style="color: rgb(50,70,50); background-color: rgba(255,255,255, 0.2);"
          id="espace-prd-mdif-global-container">   
          <!-- //////////////////////////////////////////////////////// -->
          <form action="/src/app/controller/cet.qstprod.controller.demande.update.php" method="post"
            id="espace-prd-demande-update-qstprod-form">
            <input type="text" name="annuaire-update-prd-sitkn" value="<?= $sitkn; ?>" hidden="hidden">
            <input type="text" name="annuaire-update-prd-pkprd" value="<?= $usrpk; ?>" hidden="hidden">
            <label class="cet-formgroup-container-label"><small class="form-text"><i class="fas fa-info"></i>&#160;&#160;Pour modifier et affiner toutes vos informations déclarées lors de l'inscription ou de la dernière mise à jour :</small></label>
            <button class="btn cet-navbar-btn" type="button" 
              id="espace-prd-demande-update-qstprod-form-button" 
              href="/src/app/controller/cet.qstprod.controller.demande.update.php">
              <i class="fas fa-user-edit"></i>
                &#160;&#160;Modifier les données producteur.e de &#171; <?= $nomFerme; ?> &#187;&#160;
            </button>
            <button id="espace-prd-demande-update-qstprod-form-button-submit" type="submit" hidden="hidden"></button>
            <br>
            <br>
            <p class="cet-a-type-link" id="espace-prd-modifier-mdp">
              <i class="fas fa-key"></i>&#160;&#160;Modifier mon mot de passe de connection au téléservice.
            </p>
            <div id="data-mdp-espace-producteur-container" style="display: none;">
              <p id="espace-prd-modifier-mdp-outcome" style="display: none;"></p>
              <div class="form-group mb-3">
                <label class="cet-input-label"><small class="cet-qstprod-label-text">Veuillez saisir votre ancien mot de passe :</small></label>
                <input class="form-control is-invalid" 
                  id="qstprod-espace-prd-ancien-mdp" name="qstprod-espace-prd-ancien-mdp" 
                  type="password" placeholder="Ancien mot de passe" maxlength="30" 
                  style="max-width: 512px;">
              </div>
              <div class="form-group mb-3">
                <label class="cet-input-label"><small class="cet-qstprod-label-text">Saisissez un nouveau mot de passe :</small></label>
                <input class="form-control is-invalid" 
                  id="qstprod-espace-prd-nouveau-mdp" name="qstprod-espace-prd-nouveau-mdp" 
                  type="password" placeholder="Nouveau mot de passe" maxlength="30" 
                  style="max-width: 512px;">
              </div>
              <div class="form-group mb-3">
                <label class="cet-input-label"><small class="cet-qstprod-label-text">Veuillez confirmer votre nouveau mot de passe :</small></label>
                <input class="form-control is-invalid" 
                  id="qstprod-espace-prd-conf-mdp" name="qstprod-espace-prd-conf-mdp" 
                  type="password" placeholder="Confirmer votre nouveau mot de passe" maxlength="30" 
                  style="max-width: 512px;">
              </div>
              <div style="max-width: 514px; margin-bottom: 64px;">
                <button class="btn cet-navbar-btn cet-navbar-btn-small" type="button" 
                  id="espace-prd-modifier-mdp-envoyer" 
                  data="<?= $usrpk; ?>" sitkn="<?= $sitkn; ?>" usridf="<?= $usr_identifiant; ?>"
                  style="float: right;">
                  Valider votre nouveau mot de passe
                </button>
                <button class="btn cet-navbar-btn cet-navbar-btn-small" type="button" 
                  onmousedown="$('#data-mdp-espace-producteur-container').toggle('slow'); focusContainers();"
                  style="float: right;">
                  Annuler
                </button>
              </div>
              <div class="row justify-content-end">
                <button class="btn btn-success cet-navbar-btn-small" type="button" 
                  onmousedown="$('#data-mdp-espace-producteur-container').toggle('slow'); focusContainers();">
                  <i class="far fa-check-circle"></i>&#160;&#160;J'ai fini avec la modification de mon mot de passe
                </button>
              </div>
            </div>
          </form>
          <!-- //////////////////////////////////////////////////////// -->
        </div>
      <?php endif; ?>

      <?php if (intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE): ?>
        <div class="alert alert-light" role="alert" 
          style="color: rgb(50,70,50); background-color: rgba(255,255,255, 0.2); !important;"
          id="espace-prd-mdif-geoloc-container">   
          <!-- //////////////////////////////////////////////////////// -->
          <form action="/src/app/controller/cet.qstprod.controller.demande.update.php" method="post">
            <input type="text" name="annuaire-update-prd-sitkn" value="<?= $sitkn; ?>" hidden="hidden">
            <input type="text" name="annuaire-update-prd-pkprd" value="<?= $usrpk; ?>" hidden="hidden">
            <p>
              <label class="cet-formgroup-container-label"><small class="form-text"><i class="fas fa-info"></i>&#160;&#160;Vous constatez <b>un problème de localisation de votre ferme sur la carte de l'annuaire ?</b> Mettez à jour vos information de géo-localisation :</small></label>
              <button class="btn cet-navbar-btn" id="espace-prd-modifier-geoloc" onclick="return false;"
                data="<?= $usrpk; ?>" sitkn="<?= $sitkn; ?>" usridf="<?= $usr_identifiant; ?>">
                <i class="fas fa-atlas"></i>
                  &#160;&#160;Gérer manuellement la géolocalisation de ma ferme&#160;
              </button>
            </p>
            <div id="data-geoloc-espace-producteur-container" 
              style="display: none;">
              <span style="margin-left: 4px; color: red; display: none;"
                id="data-geoloc-err-latlng">
                Le format latitude;longitude n'est pas respecté, veuillez vérifier votre saisie :
              </span>
              <span style="margin-left: 4px; color: green; display: none;"
                id="data-geoloc-updated-latlng">
                Vos nouvelles coordonnés sont à jour. Afin de vérifier, nous vous invitons à <a href="./">retourner à l'accueil et de vérifier sur la carte</a>
              </span>
              <div class="input-group mb-3" style="margin-bottom: -2px !important;">
                <div class="input-group-prepend">
                  <span class="input-group-text cet-prepend-span">Vos coordonnées actuelles : </span>
                </div>
                <input class="form-control" id="data-geoloc-espace-producteur-latlng" 
                  name="data-geoloc-espace-producteur-lat" type="text"
                  value="" maxlength="125" style="max-width: 322px;">
                <div class="input-group-append">
                  <button class="btn cet-navbar-btn cet-navbar-btn-small"
                    id="data-geoloc-espace-producteur-latlng-update"
                    type="button" data="<?= $usrpk; ?>" sitkn="<?= $sitkn; ?>" 
                    usridf="<?= $usr_identifiant; ?>">
                    <i class="fas fa-atlas"></i>&#160;&#160;Appliquer ces coordonnées de géolocalisation
                  </button>
                </div>
              </div>
              <p class="cet-a-type-link" 
                onmousedown="$('#aide-en-ligne-geoloc-producteur-container').toggle('slow');">
                <i class="fas fa-question-circle"></i>&#160;&#160;<b>Besoin d'aide ?</b> Cliquer ici et consulter l'aide en ligne pour la mise à jour vos coordonnées de géolocalisation
              </p>
              <?php include $PHP_INCLUDES_PATH.'aide-en-ligne/include.cet.qstprod.aide.en.ligne.geoloc.php'; ?>
              <p class="cet-a-type-link" id="data-geoloc-espace-producteur-set-auto"
                data="<?= $usrpk; ?>" sitkn="<?= $sitkn; ?>" usridf="<?= $usr_identifiant; ?>">
                <i class="fas fa-exclamation-triangle"></i>&#160;
                  <?php if (strcmp($data_carto['update_man'], 'true') === 0): ?>
                    <span style="color: #6C3012 !important;">
                      Actuellement, vous données de géolocalisation sont gérées manuellement et votre <b>localisation sur la carte n'est pas basée sur votre adresse postale</b>. Si vous souhaitez repasser sur une gestion automatique basée sur votre adresse, cliquer ci-dessous.
                    </span>
                    <br>
                  <?php endif; ?>
                <b>Je ne souhaite pas gérer ma géolocalisation manuellement, </b> utiliser mon <b>adresse postale</b> pour me géolocaliser sur la carte.
              </p>
              <div class="row justify-content-end">
                <button class="btn btn-success cet-navbar-btn-small" type="button"
                  id="data-geoloc-espace-producteur-latlng-ok">
                  <i class="far fa-check-circle"></i>&#160;&#160;J'ai fini avec la gestion de ma géolocalisation
                </button>
              </div>
            </div>
          </form>
          <!-- //////////////////////////////////////////////////////// -->
        </div>
      <?php endif; ?>

      <?php if (intval($cnx) === CetConnectionConst::CONNECTION_PRD_REUSSIE): ?>
        <div class="alert alert-light" role="alert" 
          style="background-color: rgba(255,255,255, 0.2); !important;"
          id="espace-prd-mdif-medias-container">   
          <!-- //////////////////////////////////////////////////////// -->
          <link rel="stylesheet" href="/src/scripts/js/dropzone-5.7.0/dist/dropzone.css">
          <p>
            <label class="cet-formgroup-container-label">
              <small class="form-text">
              <i class="fas fa-info"></i>&#160;&#160;Gérer les documents et images associées à votre ferme :
            </small>
            </label>
            <br>
            <button class="btn cet-navbar-btn" id="espace-prd-modifier-media" onclick="return false;"
              data="<?= $usrpk; ?>" sitkn="<?= $sitkn; ?>" usridf="<?= $usr_identifiant; ?>">
              <i class="far fa-folder"></i>
                &#160;&#160;Je souhaite ajouter et associer des images/photos à ma ferme&#160;
            </button>
          </p>
          <div id="data-media-espace-producteur-container" 
            style="display: none;">
            <p style="margin-bottom: 2px; color: #6C3012 !important;">
              &#160;&#160;&#160;
              <i class="fas fa-folder-open"></i>&#160; Vous avez <span id="espace-prd-modifier-count"></span> images/photos dans votre espace producteur.e :
            </p>
            <div class="row" id="espace-prd-media-listing">
              <p style="margin: 12px; color: rgb(30,40,30) !important;">Aucune image pour le moment...</p>
            </div>
            <p style="margin-bottom: 2px; color: #6C3012 !important;">
              &#160;&#160;&#160;
              <i class="fas fa-folder-open"></i>&#160; Pour ajouter de nouveaux éléments, utiliser les fonctionnalités ci-dessous.
            </p>
            <div class="row justify-content-lg-start" id="cet-file-upload-dropzone-bloc-imgferme-container">
              <label class="cet-formgroup-container-label"><small class="form-text">&#160;&#160;&#160;&#160;<i class="fas fa-info"></i>&#160;&#160;Télécharger des images pour ajouter du contenu et personnaliser vos espace producteur (limité à 8 fichiers) :</small></label>
              <div class="col-12 cet-file-upload-dropzone-bloc">
                <form action="/src/app/controller/media/cet.qstprod.controller.media.form.php?usrpk=<?= $usrpk; ?>&sitkn=<?= $sitkn; ?>&usridf=<?= $usr_identifiant; ?>&cible=media-ferme" 
                  enctype="multipart/form-data"
                  class="dropzone cet-file-upload-dropzone"
                  id="cetFileDropzoneImgferme">
                  <div class="dz-message" data-dz-message>
                    <span>
                      &#160;<i class="fas fa-file-upload"></i>&#160;
                      Glisser-déposer ou cliquer pour ajouter des images...
                    </span>
                  </div>
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
              </div>
            </div>
            <div class="row justify-content-lg-start" id="cet-file-upload-dropzone-bloc-logo-container">  
              <label class="cet-formgroup-container-label"><small class="form-text">&#160;&#160;&#160;&#160;<i class="fas fa-info"></i>&#160;&#160;Télécharger le logo de votre ferme ou bien une photo de profil (une seule image) :</small></label>
              <div class="col-12 cet-file-upload-dropzone-bloc">
                <form action="/src/app/controller/media/cet.qstprod.controller.media.form.php?usrpk=<?= $usrpk; ?>&sitkn=<?= $sitkn; ?>&usridf=<?= $usr_identifiant; ?>&cible=logo-ferme" 
                  enctype="multipart/form-data"
                  class="dropzone cet-file-upload-dropzone"
                  id="cetFileDropzoneImglogo">
                  <div class="dz-message" data-dz-message>
                    <span>
                      &#160;<i class="fas fa-file-upload"></i>&#160;
                      Glisser-déposer ou cliquer pour ajouter votre logo ou une image de profil.
                    </span>
                  </div>
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
              </div>            
            </div>
            <div class="row justify-content-end">
              <button class="btn btn-success cet-navbar-btn-small" type="button" onmousedown="$('#data-media-espace-producteur-container').hide('slow'); focusContainers();"
                style="margin-top: 16px;">
                <i class="far fa-check-circle"></i>&#160;&#160;J'ai fini avec la gestion d'images
              </button>
            </div>
          </div>
          <!-- //////////////////////////////////////////////////////// -->
        </div>
      <?php endif; ?>

    </div> <!-- end global alert cet-bloc -->

  </div> <!-- end col -->
</div> <!-- end row -->
<input type="text" id="espace-prd-pkprd-value" value="<?= $usrpk; ?>" hidden="hidden">
<script src="/src/scripts/js/dropzone-5.7.0/dist/dropzone.js"></script>
<script src="/src/scripts/js/cetcal/cetcal.min.espace.dedie.actions.min.js"></script>