function updateCartoRechercheAvancee(pk_prds, pk_ents, commune_cp, rayon) {
  clusters.clearLayers();
  var count = 0;
  for (var i = 0; i < marker_collection.length; i++) {
    if (marker_collection[i].type.indexOf('Associations liées à la BIO Locale') === -1 && marker_collection[i].type.indexOf('AMAP') === -1 && marker_collection[i].type.indexOf('Magasin BIO') === -1 && marker_collection[i].type.indexOf('Marché') === -1) {
      var html = marker_collection[i].mrkr._popup._content;
      var pk = $(html).attr('data');
      if (pk_prds.includes(pk)) {
        clusters.addLayer(marker_collection[i].mrkr);
        ++count;
      }
    } else {
      var html = marker_collection[i].mrkr._popup._content;
      var pk = $(html).attr('data');
      if (pk_ents.includes(pk)) {
        clusters.addLayer(marker_collection[i].mrkr);
        ++count;
      }
    }
  }
}

function comparator(a, b) {
   if (a[1] < b[1]) return -1;
   if (a[1] > b[1]) return 1;
   return 0;
 }


function fetchResultatsRechercheAvancee(json_rav) {
  $.ajax({
    type: "POST",
    url: '/src/app/controller/ajaxhandlers/cet.annuaire.controller.ajaxhandler.recherche.avancee.php?json=' + JSON.stringify(json_rav),
    success: function(json) { 
      var global_data = JSON.parse(json);
      var data = global_data.producteurs;
      var data_entites = global_data.entites;
      var resultats = [];
      var pk_rav_producteurs = [];
      var pk_rav_entites = [];
      var pks = [];
      // Table de résultats - Initialisation de variables
      var table_resultats = '';
      var ligne_table = '';
      var n = 0;
      // Table de résultats - Fin initialisation de variables
      $('#resultats-recherche-avancee').empty(); 
      $('#resultats-recherche-avancee').append((data.length + data_entites.length <= 0) ? '<p class="detail-rav-resultats">Aucun résultat.</p>' : '<p class="detail-rav-resultats"><a href="src/scripts/js/cetcal/cetcal.table.resultats.html">' + (data.length + data_entites.length) + ' résultats trouvés.</a></p>'); 
      // Table de résultats - Début et en tête de table
      table_resultats = '<table><tr><th>Num</th><th>Entité</th><th>Commune/Adresse</th><th>Type</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Tel 1</th><th>Tel 2</th></tr>';
      // Table de résultats - Fin début et en tête de table
      for (var i in data) {
        resultats.push([data[i].nomferme, 
          '<div id="bloc-rav-' + data[i].pk + '" class="bloc-rav-element-resultat">'
            + '<div class="row card-last-prd mt-3" data-type="producteur" onmousedown="ravElementFocus(' + data[i].pk + ', ' + '\'producteur\'' + ');">'
            + '<div id="rav-' + data[i].pk + '" class="col-sm rav-element-resultat">'
            + '<b>' + data[i].nomferme + '</b>'
            + '</div>'
            + '<div id="rav-' + data[i].pk + '" class="col-sm rav-element-resultat">'
            + ((data[i].prodInscrit === 'false') ? data[i].adrfermeLtrl : data[i].adrCommune)
            + '</div>'
            + '<div id="rav-' + data[i].pk + '" class="col-sm rav-element-resultat-type">'
            + ((data[i].prodInscrit === 'false') ? '' : data[i].typeDeProduction.replaceAll('µ', ' '))
            + ((data[i].prodInscrit === 'false') ? '' : '<br><a class="cet-crt-rav-resultat-link" href="./?statut=fichedetailleeprd&anr=true&pkprd=' + data[i].pk +'" target="_blank"><i class="fa fa-search-plus" aria-hidden="true"></i> Voir la fiche détaillée</a>')
            + '</div>'
            + '</div>'
            + '</div>']);
        pk_rav_producteurs.push(data[i].pk);
        pks.push(data[i].pk);
        // Table de résultats - Ecriture d'une ligne de résultat producteur  
        n++;
        ligne_table = '<tr><td>' + n + '</td><td>' + data[i].nomferme + '</td>';
        ligne_table = ligne_table + '<td>' + ((data[i].prodInscrit === 'false') ? data[i].adrfermeLtrl : data[i].adrCommune) + '</td>';
        ligne_table = ligne_table + '<td>' + ((data[i].prodInscrit === 'false') ? '' : data[i].typeDeProduction.replaceAll('µ', ' ')) + '</td>';
        ligne_table = ligne_table + '<td>' + data[i].nom + '</td>';
        ligne_table = ligne_table + '<td>' + data[i].prenom + '</td>';
        ligne_table = ligne_table + '<td>' + data[i].email + '</td>';
        ligne_table = ligne_table + '<td>' + data[i].telfix + '</td>';
        ligne_table = ligne_table + '<td>' + data[i].telport + '</td>';
        ligne_table = ligne_table + '</tr>';
        table_resultats = table_resultats + ligne_table;
        // Table de résultats - Fin ecriture d'une ligne de résultat producteur 
      }

      for (var i in data_entites) {
        resultats.push([data_entites[i].denomination,
          '<div id="bloc-rav-' + data_entites[i].pk + '" class="bloc-rav-element-resultat">'
            + '<div class="row card-last-prd card-last-entite mt-3" data-type="entite" onmousedown="ravElementFocus(' + data_entites[i].pk + ', ' + '\'entite\'' + ');">'
            + '<div id="rav-' + data_entites[i].pk + '" class="col-sm rav-element-resultat">'
            + '<b>' + data_entites[i].denomination + '</b>'
            + '</div>'
            + '<div id="rav-' + data_entites[i].pk + '" class="col-sm rav-element-resultat">' + data_entites[i].adresse + '</div>'
            + '<div id="rav-' + data_entites[i].pk + '" class="col-sm rav-element-resultat-type">'
            + data_entites[i].typeLibelle
            + '<br><a class="cet-crt-rav-resultat-link" href="./?statut=fichedetaillee.lieudevente&anr=true&type=' + data_entites[i].type + '&q=' + data_entites[i].denomination + '" target="_blank"><i class="fa fa-search-plus" aria-hidden="true"></i> Voir la fiche détaillée</a>'
            + '</div>'
            + '</div>'
            + '</div>']);
        pk_rav_entites.push(data_entites[i].pk);
        pks.push(data_entites[i].pk);
        // Table de résultats - Ecriture d'une ligne de résultat entité 
        n++;
        ligne_table = '<tr><td>' + n + '</td><td>' + data_entites[i].denomination + '</td>';
        ligne_table = ligne_table + '<td>' + data_entites[i].adresse + '</td>';
        ligne_table = ligne_table + '<td>' + data_entites[i].typeLibelle + '</td>';
        ligne_table = ligne_table + '<td>' + data_entites[i].personne + '</td>';
        ligne_table = ligne_table + '<td></td>';
        ligne_table = ligne_table + '<td>' + data_entites[i].email + '</td>';
        ligne_table = ligne_table + '<td>' + data_entites[i].tels + '</td>';
        ligne_table = ligne_table + '<td></td>';
        ligne_table = ligne_table + '</tr>';
        table_resultats = table_resultats + ligne_table;
        // Table de résultats - Fin ecriture d'une ligne de résultat entité 
      }

      resultats = resultats.sort(comparator);
      for (var i in resultats) $('#resultats-recherche-avancee').append(resultats[i][1]);      
      $('#cet-annuaire-crt-bootstrap-wrapper').attr('class', 'col-sm-6 col-md-6 col-lg-6 col-xl-6');
      $('#cet-annuaire-crt-main').height($(window).height() * 1.0);
      $('#resultats-recherche-avancee').css('height', $('#cet-annuaire-crt-bootstrap-wrapper').height());
      $('#resultats-recherche-avancee').show();
      cetcrtmainmap.invalidateSize();
      scrollTowardsId('cet-annuaire-crt-main-container', 2);
      updateCartoRechercheAvancee(pk_rav_producteurs, pk_rav_entites, json_rav.commune, json_rav.rayon);
      focusOnBounds(pks);
      // Table de résultats - Fin de table et écriture en session
      table_resultats = table_resultats + '</table>';
      sessionStorage.setItem("tableResultats", table_resultats);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      $('#resultats-recherche-avancee').empty();
      $('#resultats-recherche-avancee').append('<p>Erreur sur recherche détaillée.</p>');
      $('#resultats-recherche-avancee').show();
      console.log(errorThrown);
    }
  });
}