<!-- login & signup html forms -->
<div class="cet-module row justify-content-lg-center" id="cet-qstprod_intro" style="margin-bottom: 56px; display: none;">
  <div class="col-lg-9">
    <div class="alert alert-light cet-bloc" role="alert">
      <h4 class="alert-heading">Bonjour Producteur.e.s !</h4>
      <p><?= CetQstprodConstTextes::login_intro_block_textinf_e; ?></p>
      <p style="text-align: center;">
        <a class="btn cet-navbar-btn" 
          href="/src/app/controller/cet.qstprod.controller.login.form.php"
          style="font-size: 18px;">
          <i class="fas fas fa-globe-europe fa-lg"></i>&#160;&#160;&#160;S'inscrire sur l'annuaire des Producteur.e.s
        </a>
      </p>
      <p>
        <?= CetQstprodConstTextes::login_intro_block_textinf_d; ?>&#160;<a href="#" onclick="return false;" onmousedown="lireLaSuite('intro-prd-lire-plus');">Lire la suite...</a>
      </p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_a; ?></p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_b; ?></p>
      <p class="intro-prd-lire-plus"><?= CetQstprodConstTextes::login_intro_block_textinf_c; ?></p>
    </div>
  </div>
</div>