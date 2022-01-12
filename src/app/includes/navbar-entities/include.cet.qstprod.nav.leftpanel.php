<nav class="navbar navbar-expand-xl navbar-light bg-light">
  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 navbar-cet-qstprod">
    <ul class="navbar-nav"> 
      <!-- Lieux de vente -->
      <li class="nav-item" style="margin-right: 4px;">
        <a class="nav-link cet-p-20" href="/?statut=asso.vente&anr=true&type=">
          <i class="fa fa-book" aria-hidden="true"></i>&#160;&#160;Lieux de vente
        </a>
      </li>
      <!-- listing prd complet 
      <li class="nav-item" style="margin-right: 4px;">
        <a class="nav-link cet-p-20" id="cet-annuaire-crt-recherche-btn" 
          href="/?statut=listing.producteurs&anr=true">
          <i class="fas fa-seedling"></i>&#160;&#160;Je souhaite consommer BIO local 
        </a>
      </li>
      -->
      <?php if ($OPEN_PAGE_RECETTES): ?>
        <li class="nav-item" style="margin-right: 4px;">
          <a class="nav-link cet-p-20" href="/?statut=base.recettes&anr=true">
            <i class="fas fa-temperature-high"></i>&#160;&#160;Livret de recettes
          </a>
        </li>
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a id="cet-notre-projet" class="nav-link cet-p-20" href="#"
          style="white-space: nowrap !important;">
          <i class="fas fa-info-circle"></i>&#160;&#160;Notre projet décidelabiolocale.org
        </a>
      </li>
      <!-- PARTENAIRES -->
      <li class="nav-item">
        <a class="nav-link cet-p-20" href="/?statut=partenaires.liens&anr=true">
          <i class="fas fa-hands-helping"></i>&#160;&#160;Partenaires et liens utiles
        </a>
      </li>
    </ul>
  </div>
</nav>