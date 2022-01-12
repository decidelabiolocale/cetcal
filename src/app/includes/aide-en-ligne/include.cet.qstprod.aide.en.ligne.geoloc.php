<div id="aide-en-ligne-geoloc-producteur-container" style="display: none; margin-bottom: 24px;">
  <div class="d-flex justify-content-center">
    <div class="progress" style="height: 16px; width: 68%;">
      <div class="progress-bar bg-success" role="progressbar" id="aide-en-ligne-geoloc-producteur-progress"
        style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <span id="aide-en-ligne-geoloc-producteur-progress-value">étape 1 sur 4</span>
      </div>
    </div>
  </div>
  <div id="aide-en-ligne-geoloc-producteur" class="carousel slide" 
    data-ride="carousel"
    data-interval="false"
    data-wrap="false"
    style="margin: 16px;">
    <div class="carousel-inner" style="color: rgb(30,40,30) !important;">
      <div class="carousel-item active" data="1">
        <div class="d-flex justify-content-center">
          <div class="card" style="width: 68%;">
            <div class="card-header">Aide en ligne de géolocalisation</div>
            <div class="card-body">
              <h5 class="card-title">Première étape :</h5>
              <p class="card-text">Utiliser un outil de cartographie. Nous recomandons <a href="https://www.openstreetmap.org/" target="_blank">Open Street Maps</a>. Ce dernier est utilisé pour cett aide en ligne.</p>
              <p class="card-text">Cliquer sur le lien <a href="https://www.openstreetmap.org/" target="_blank">Open Street Maps</a>, puis localiser votre ferme. Passer à l'étape suivante.</p>
              <p class="card-text">Le service <b>Open Street Maps</b> est utilisé pour la carte cetcal des producteur.e.s <b>car il respect la vie privée des internautes ainsi que leurs données numériques.</b>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item" data="2">
        <div class="d-flex justify-content-center">
          <div class="card" style="width: 68%;">
            <div class="card-body">
              <h5 class="card-title">Deuxième étape :</h5>
              <p class="card-text">Une fois que vous avez localiser votre ferme sur <a href="https://www.openstreetmap.org/" target="_blank">Open Street Maps</a>, faire un <b>click-droit</b> avec votre souris sur l'emplacement précis et <b> sélectionner l'option <i>"Afficher l'adresse"</i></b>.</p>
              <p class="card-text">Un onglet s'ouvre sur la gauche de la page, ce dernier contient les coordonnées du point géographie sélectionné. <b>Exemple : <i>44.77962, -0.12522</i></b>. Passer à l'étape suivante.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item" data="3">
        <div class="d-flex justify-content-center">
          <div class="card" style="width: 68%;">
            <div class="card-body">
              <h5 class="card-title">Troisième étape :</h5>
              <p class="card-text">Copier les coordonnées affichées dans l'onglet. Pour cela, <b>click-droit</b> sur les coordonnées et sélectionner l'option <b>"Copier l'adresse du lien"</b>.<br>Ou bien, sélectionner le texte du lien et copier le dans votre presse papier.</p>
              <p class="card-text">Puis, veuillez <span class="cet-span-link" 
                id="aide-en-ligne-geoloc-copier-presse-papier"
                onmousedown="pasteToInput('data-geoloc-espace-producteur-latlng');">
                Cliquer ici pour ajouter vos coordonnées
              </span> dans le champ situé au-dessus de cette aide en ligne. Finallement, <b>appliquer vos coordonnées de géolocalisation</b>.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item" data="4">
        <div class="d-flex justify-content-center">
          <div class="card" style="width: 68%;">
            <div class="card-body">
              <h5 class="card-title">Dernière étape :</h5>
              <p class="card-text">Afin de vérifier la prise en compte de la nouvelle localisation, <a href="./">retourner à l'accueil</a> et localiser votre ferme (le retour à l'accueil rechargera la carte des producteur.e.s avec vos nouvelles coordonnées).</p>
              <br>
              <p class="card-text" style="float: right;"><a href="./">Merci d'avoir suivi cet aide en ligne</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#aide-en-ligne-geoloc-producteur" role="button" data-slide="prev"
      style="background-color: inherit !important;">
      <span style="color: #DD4215;">
        &#160;<i class="fas fa-arrow-alt-circle-left fa-3x"></i>&#160;
      </span>
    </a>
    <a class="carousel-control-next" href="#aide-en-ligne-geoloc-producteur" role="button" data-slide="next"
      style="background-color: inherit !important;">
      <span style="color: #DD4215;">
        &#160;<i class="fas fa-arrow-alt-circle-right fa-3x"></i>&#160;
      </span>
    </a>
  </div>
</div>
<script type="text/javascript">
  $('#aide-en-ligne-geoloc-producteur').on('slid.bs.carousel', function () {
    var total_items = $('#aide-en-ligne-geoloc-producteur .carousel-item').length;
    var current_index = $('#aide-en-ligne-geoloc-producteur .carousel-item.active').attr('data');
    $('#aide-en-ligne-geoloc-producteur-progress').attr('aria-valuenow', (100 / total_items) * current_index);
    $('#aide-en-ligne-geoloc-producteur-progress').css('width', ((100 / total_items) * current_index) + '%');
    $('#aide-en-ligne-geoloc-producteur-progress-value').text('étape ' + current_index + ' sur ' + total_items);
  })
</script>