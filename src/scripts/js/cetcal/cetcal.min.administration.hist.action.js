/**
 * Logger l'activité admin : 
 */
function admlog(sitkn, pk_adm, adm_log, action_code, type_element, denomination_element, pk_element, commentaire) {
  $.ajax({
    url: '../../../controller/admin/cet.annuaire.controlleur.ajax.hist.action.php?sitkn=' + sitkn,
    type: 'POST',
    data: { 
        admpk : pk_adm, 
        admlog : adm_log,
        admactcde : action_code,
        type : type_element,
        denom : denomination_element,
        pk : pk_element,
        cmt : commentaire
      },
    success: function (json) { }, 
    error: function(jqXHR, textStatus, errorThrown) { console.log(textStatus, errorThrown); }
  });
}

function updateNomFermePourGeoloc() {
  var pkprd = $('#producteur-geoloc-pkproducteur').val();
  if (pkprd.length < 1) { $('#producteur-geoloc-nomferme').val(''); return; }
  var prdcible = $('#admin-modifier-producteur-link-' + pkprd).attr('prd-cible');
  $('#producteur-geoloc-nomferme').val(prdcible);
}

function updateNomFermePourCertif() {
  var pkprd = $('#producteur-bioab-pk').val();
  if (pkprd.length < 1) { $('#producteur-certif-nomferme').val(''); return; }
  var prdcible = $('#admin-modifier-producteur-link-' + pkprd).attr('prd-cible');
  $('#producteur-certif-nomferme').val(prdcible);
}

function updateDenominationEntitePourGeoloc() {
  var pkent = $('#entite-geoloc-pkentite').val();
  if (pkent.length < 1) { $('#entite-geoloc-denomination').val(''); return; }
  var entcible = $('#admin-entite-link-' + pkent).attr('ent-cible');
  $('#entite-geoloc-denomination').val(entcible);
}

function initAdmLog() {

  // Log actions admin sur entités :
  $('#admin-entite-form').on('submit', function() {
    const queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var action = $('input#admin_action_cible').val();
    var action_entite = '';
    if (action === 'insert-entite') action_entite = 'creent'; 
    else if (action === 'update-entite') action_entite = 'majent'; 
    else if (action === 'delete-entite') action_entite = 'supent';
    admlog(urlParams.get('sitkn'), urlParams.get('admpk'), urlParams.get('admlog'), action_entite, 
      $('#entite-entite-type').find(":selected").text(), 
      $('#entite-entite-denomination').val(), $('#admin-pk-entite').val(), $('#commentaire-action-admin').val());
  });

  // Log actions admin sur géolocalisation producteur :
  $('#admin-geoloc-form-prd').on('submit', function() {
    const queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var action = 'geoprd';
    var type = 'producteur';
    admlog(urlParams.get('sitkn'), urlParams.get('admpk'), urlParams.get('admlog'), action, 
      type, $('#producteur-geoloc-nomferme').val(), $('#producteur-geoloc-pkproducteur').val(), $('#commentaire-action-admin').val());
  });

  // Log actions admin sur géolocalisation entités :
  $('#admin-geoloc-form-entite').on('submit', function() {
    const queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var action = 'geoent';
    var type = 'entité';
    admlog(urlParams.get('sitkn'), urlParams.get('admpk'), urlParams.get('admlog'), action, 
      type, $('#entite-geoloc-denomination').val(), $('#entite-geoloc-pkentite').val(), $('#commentaire-action-admin').val());
  });

  $('#admin-certif-form').on('submit', function() {
    const queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var action = undefined;
    if ($('#admin_action_cible_certif').val() === 'certif-bioab-prd') action = 'crtfpr';
    else if ($('#admin_action_cible_certif').val() === 'certif-null-prd') action = 'uncrpr';
    else return;
    var type = 'producteur';
    admlog(urlParams.get('sitkn'), urlParams.get('admpk'), urlParams.get('admlog'), action, 
      type, $('#producteur-certif-nomferme').val(), $('#producteur-bioab-pk').val(), $('#commentaire-action-admin').val());
  });

}