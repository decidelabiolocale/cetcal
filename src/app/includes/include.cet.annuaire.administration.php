<div class="cet-module row justify-content-lg-center" id="cet-qstprod_seconnecter" style="margin-bottom: 56px; margin-top: 32px;">
  <div class="col-lg-5"> 
    <div class="alert cet-bloc" role="alert">
      <h5 class="alert-heading">Bienvenue Administrateur cetcal !</h5>
      <form class="form" action="/src/app/controller/cet.annuaire.controller.administrateur.form.php" method="post">
        <label>Veuillez renseigner votre identifiant et mot de passe :
          <small class="form-text text-muted" style="margin-top: 2px;"><?= CetQstprodConstLibelles::lib_general_entete_garantit; ?><br>
            <a href="#"><?= CetQstprodConstLibelles::lib_general_entete_donnees; ?></a>
          </small>
        </label>
        <div class="input-group mb-3">
          <input class="form-control" name="login_administrateur" id="login_administrateur" type="text" placeholder="Email, n°de téléphone ou identifiant" aria-label="email ou identifiant">
        </div>
        <div class="input-group mb-3">
          <input class="form-control" name="mdp_administrateur" id="mdp_administrateur" type="password" placeholder="Mot de passe" aria-label="Mot de passe">
        </div>
        <button class="btn cet-navbar-btn" type="submit" style="margin-top: 8px; float: right;">Se connecter</button>
        <a href="/" class="btn cet-navbar-btn" 
          style="margin-top: 8px; margin-right: 4px; float: right;">
          Retourner à l'accueil
        </a> 
        <br>
      </form>
      <p>En cas de perte de mot passe et/ou identifiant, veuillez contacter votre équipe technique.</p>
    </div>
  </div>
</div>