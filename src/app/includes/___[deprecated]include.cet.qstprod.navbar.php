<nav class="navbar navbar-expand-xl navbar-light bg-light">
  <a class="navbar-brand" href="/?">
    DECIDELABIOLOCALE.ORG
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target=".navbar-cet-qstprod" aria-controls="navbar-cet-qstprod" 
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="cet-navbar-toggler" style="font-size: 32px !important;"><i class="fas fa-bars"></i></span>
  </button>
  <div class="navbar-collapse collapse w-100 navbar-cet-qstprod">
    <ul class="navbar-nav mr-auto">
      <?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
        <li class="nav-item">
          <a id="cet-inscription-producteur" class="btn cet-navbar-btn" style="white-space: nowrap !important;" 
            href="#"><i class="fas fas fa-globe-europe fa-lg"></i>&#160;&#160;Je suis Producteur.e</a>
        </li>
      <?php endif; ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle cet-p-20" href="#" id="navbar-qui-nous-sommes-dropdown" 
          role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          &#160;Qui sommes nous ?    
        </a>
        <div class="dropdown-menu" aria-labelledby="navbar-qui-nous-sommes-dropdown">
          <a class="dropdown-item cet-p-20" href="http://castillonnaisentransition.org/" target="_blank">
            L'association CET, à propos...
          </a>
          <a class="dropdown-item cet-p-20" href="https://github.com/j-fish/cetcal" target="_blank">
            Notre projet sur GitHub
          </a>
          <a class="dropdown-item cet-p-20" href="/?statut=contact.form&anr=true&em=&ntp=">
            Des questions ? Contacter l'équipe decidelabiolocale.org
          </a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if ($OPEN_LOGIN_SIGNUP && !$cnx_done && in_array($statut, NavbarHelper::$status_connection_signup)): ?>
        <li class="nav-item">
          <a id="cet-annuaire-user-login" class="btn cet-navbar-btn cet-navbar-btn-small" href="#"
            onmousedown="$('#cet-qstprod_seconnecter').show('slow', function(){ 
              scrollTowardsId('cet-qstprod_seconnecter', -10);
              $('#cetcal-cnx-not-done').hide('slow'); 
              $('#cetcal-obl-done').hide('slow'); 
              $('#cetcal-obl-not-done').hide('slow'); });">
            <i class="fas fa-user"></i>&#160;&#160;Se connecter
          </a>
        </li>
        <li class="nav-item">
          <a id="cet-annuaire-user-signup" class="btn cet-navbar-btn cet-navbar-btn-small" 
            href="/?statut=user.signup&anr=true">
            <i class="fas fa-info-circle"></i>&#160;&#160;Inscription (non producteur.e)
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<?php if (!in_array($statut, CetQstProdFilArianneHelper::$states)): ?>
  <?php include $PHP_INCLUDES_PATH.'navbar-entities/include.cet.qstprod.nav.leftpanel.php'; ?>
<?php endif; ?>

<?php if (strcmp($statut, 'accueil.cet') === 0): ?>
<div class="row justify-content-center">
  <div class="col-lg-4 col-sm-6">
    <p class="cet-p" style="margin-top: 6px;">
      <i class="fa fa-info-circle" aria-hidden="true"></i>&#160;
      Notre objectif à travers cette plateforme est de favoriser la bio locale <a href="./?statut=bio.ytendant&anr=true" target="black_">En savoir plus...</a>
    </p>
  </div>
  <div calss="col-lg-2 col-sm-6">
    <img src="/res/content/icons/logos-verts-europe-ab.png" height="56" alt=""
      style="margin-bottom: 6px; margin-left: 16px;">
  </div>
</div>
<?php endif; ?>

<?php if (strcmp($statut, 'accueil.cet') === 0): ?>
  <nav class="navbar navbar-expand-xl navbar-light bg-light">
    <div class="row justify-content-center">
      <div class="col-6">
        <img class="img-fluid" src="/res/content/DCDL_biolocale_2.jpg" alt="">
        <br>
        <!--<p style="text-align: center;">
          <img src="/res/content/partenaires/logo_gironde.jpg" height="80">
          <img src="/res/content/partenaires/logo_region.jpg" height="80">
          <img src="/res/content/partenaires/logo_FSE.jpg" height="80">
        </p>-->
      </div>
    </div>
  </nav>
<?php else: ?>
  <br>
<?php endif; ?>