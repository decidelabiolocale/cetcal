/* ***** SELECT ITEMS **********/
const allMarcheBox = document.getElementById('the-basics');
const selectElement = document.querySelector('.select--lieudist');
const sousTypeSelect = document.querySelector('.qstprod--soustype');
const list = document.querySelector('.lieux--list');
const clearLieuxRecap = document.querySelector('.clear--lieux');
const checkboxMarche = document.querySelector('.checkbox--new--marche');
const newMarcheBox = document.querySelector('.unfinded--marche')
const newMarcheProd = document.querySelector('.new--marche');
const btnNewMarcheProd = document.querySelector('.btn--new--marche--prod');
const marcheInputProd = document.querySelector('.marche--prod');
const selectSousType = document.querySelector('.select--sous--type');
const amapTypeahead = document.querySelector('.amap--typeahead');
const adresseMarcheProd = document.querySelector('.adresse--marche--prod');
const precisionsProd = document.querySelector('.qstprod--precisions');
const textAreaProd = document.querySelector("textarea");
const limitTextAlert = document.querySelector('.limit--text--alert');
const addLieu = document.querySelector('.addLieu');
const addCircuit = document.querySelector('.addCircuit');
const dataPost = document.querySelector('#data');
// input post json :
const postJson = document.querySelector('#qstprod-signuplieuxdist-json');
// bouton nav continuer :
const boutonValider = document.getElementById('btn-signuplieuxdist.form-valider');
// bouton nav retour :
const boutonRetour = document.querySelector('#btn-signuplieuxdist.form-retour');

let marches;
let postObjet;
let inputMarche;
let precisions_texte = '';
let pasDeSousType = false;

/**
 * Définition de la structure de données pour lieux de distributions (tous cas confondus).
 */
const PostObj = undefined;

/**
 * DTO JSON pour tous les lieux ajoutés.
 */
let postO = { lieux: [] };
let newMarcheValidator = undefined;

// edit option, Flags :
let editElement;
let editID = "";
let value ="";
let amapFlag = false;
let precisionsFlag = false;
let sousTypeFlag = false;
let checkboxFlag = false;



/** *****************************************************************************************
 * EVENT LISTENERS 
 */
selectElement.addEventListener('change', (event)=> {
  value = selectElement.options[selectElement.selectedIndex].text;

  if (selectElement.options[selectElement.selectedIndex].value === 'NULL') {
    clearInputs();
    clear(amapTypeahead);
    clear(allMarcheBox);
    postObjet = undefined;
    return;
  }

  if (value === 'Marché') {

    pasDeSousType = true;
    if (addLieu != null) {
      addLieu.classList.add('d-none');
    } else {
      clear(amapTypeahead);
      showMarche();
      hideCircuitCourt();
      ajaxCall();
      allMarcheBox.classList.remove('d-none');
      newMarcheBox.classList.remove('d-none');
      precisionsProd.classList.remove('d-none');
      amapFlag = false;
    }

  } else if (value === 'Réseau de vente en circuit court') {

    pasDeSousType = false;
    if (precisionsFlag === true) {
      precisionsProd.classList.add('d-none');
      precisionsFlag = false;
      sousTypeFlag = true;
    }

    if (addLieu != null) {
      addLieu.classList.add('d-none');
    } else {
      clear(allMarcheBox);
      clear(amapTypeahead);
      hideNewMarche();
      showCircuitCout();
      ajaxCall(value);
    }

  } else {

    if (sousTypeFlag === true) {
      sousTypeSelect.classList.add('d-none');
      sousTypeFlag = false;
    }
    amapFlag = false;
    hideNewMarche();
    clear(amapTypeahead);
    clear(allMarcheBox);
    precisionsFlag = true;
    precisionsProd.classList.remove('d-none');
    ajaxCall(value);
  }

});

selectSousType.addEventListener('change', (e) => {
  const req = selectSousType.options[selectSousType.selectedIndex].text
  if (req === "AMAP") {
    precisionsProd.classList.remove('d-none');
    amapTypeahead.classList.remove('d-none');
    showAmap();
    ajaxCall(req);
    amapFlag = true;
    sousTypeFlag = true;
  } else {
    amapFlag = false;
    clear(amapTypeahead);
    precisionsProd.classList.remove('d-none');
    sousTypeFlag = true;
    postObjet = new LieuDistPost('NULL', value, req, null, false, null, null, null, null, null);
  }

});

checkboxMarche.addEventListener('change', (event) => {
  if (checkboxMarche.checked) {
    newMarcheProd.classList.remove('d-none');
    allMarcheBox.classList.add('d-none');
    checkboxFlag = true;
    newMarcheValidator = new FormValidator();
  } else {
    newMarcheProd.classList.add('d-none');
    allMarcheBox.classList.remove('d-none');
    checkboxFlag = false;
    if (newMarcheValidator !== undefined) {
      newMarcheValidator.clear();
      newMarcheValidator = undefined;
    }
  }
});

// Event : Ajout des lieux.
addCircuit.addEventListener('mousedown', () => {

  if (postObjet === undefined && checkboxMarche.checked === false) {
    alerter('Aucun le lieu de distribution renseigné', 'Veuillez renseigner tous les choix et sous-catégories proposés.', 'J\'ai compris');
    return;
  } 

  if (!pasDeSousType && selectSousType.selectedIndex === 0) {
    alerter('Le lieu de distribution est incomplet', 
      'Veuillez renseigner la sous-catégorie depuis la liste proposée.', 'J\'ai compris');
    return;
  }

  // Cas particulier des nouveaux marchés.
  if (checkboxMarche.checked) {
    if (!newMarcheValidator.isDataValidated()) {
      alerter('Des informations sont manquantes concernant ce marché.', 
        'Veuillez, dans la mesure du possible, renseigner toutes les informations demandées.', 'J\'ai compris');
      return;
    } else {
      postObjet = new LieuDistPost();
      postObjet.crea_marche = true;
      postObjet.type = 'Marché';
      postObjet.pk_entite = null;
      postObjet.denomination = $('#nv-marche-lieuxdist-nom').val();
      postObjet.adr = $('#nv-marche-lieuxdist-adr').val();
      postObjet.heure_deb = $('#timeInput-heure-deb').val();
      postObjet.heure_fin = $('#timeInput-heure-fin').val();
      postObjet.date = $('#timeInput-date').val();
      postObjet.jour = $('#timeInput-jour').val();
      newMarcheValidator.clear();
      newMarcheValidator = undefined;
    }

  } else {
    postObjet.crea_marche = false;
  }

  // dans tous les cas :
  postObjet.precs = textAreaProd.value;
  postObjet.code_type = selectElement.options[selectElement.selectedIndex].value;
  postObjet.code_sous_type = pasDeSousType ? 'NULL' : selectSousType.options[selectSousType.selectedIndex].value; 

  if (!pkPresent(postObjet.pk_entite) && !denominationPresente(postObjet.denomination)) {
    
    postO.lieux.push(postObjet); 
    $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));

    postObjet = undefined;
    // finalement ré-initialiser le formulaire et reconstruire le récap.
    clearInputs();
    buildRecapLieux();

  } else {
    alerter('Lieux de distribution déjà renseigné', 
      'Le lieux de distribution ' + postObjet.denomination + ' est déjà sélectionné dans votre liste.', 
      'J\'ai compris');
  }

});

// Limitation textarea :
textAreaProd.addEventListener("input", event => {

  const target = event.currentTarget;
  const maxLength = target.getAttribute("maxlength");
  const currentLength = target.value.length;
  if (currentLength >= maxLength) {
    limitTextAlert.textContent = "limite de caractères atteinte";
  } else if (currentLength > 0) {
    limitTextAlert.textContent = `${maxLength - currentLength} caractères restants`;
  } else {
    limitTextAlert.textContent = "Aucune saisie pour le moment.";
  }

  precisions_texte = target.value;
});

/** *****************************************************************************************
 * FUNCTIONS
 */
function clearInputs() {
  $('#nv-marche-lieuxdist-nom').val('');
  $('#nv-marche-lieuxdist-adr').val('');
  $('#timeInput-heure-deb').val('');
  $('#timeInput-heure-fin').val('');
  $('#timeInput-date').val('');
  $('#timeInput-jour').val('');
  // Remove class .is-valid pour nouveaux marchés.
  $('.nouveau-marche-error-message').hide();
  textAreaProd.value = '';
  $('input.typeahead').val('');
  checkboxMarche.checked = false;
  $('.unfinded--marche').hide();
  precisionsProd.classList.add('d-none');
  sousTypeSelect.classList.add('d-none');
  clear(amapTypeahead);
  selectElement.options[0].selected = 'selected';
  clear(allMarcheBox);
  pasDeSousType = false;

  var evt = document.createEvent("HTMLEvents");
  evt.initEvent("change", false, true);
  checkboxMarche.dispatchEvent(evt);
}

function showMarche(event) {
  $('.unfinded--marche').show();
  let action = "Marché";
  const element = document.createElement('input');
  element.type = "text";
  element.classList.add('typeahead');
  element.classList.add('form-control');
  element.classList.add('lieux-dist-recherche-typeahead');
  element.setAttribute('placeholder', 'Rechercher votre marché ...');
  let newEl = allMarcheBox.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl);
  inputMarche = document.querySelector('.typeahead');
  ajaxCall(action);
}

function showAmap() {
  const element = document.createElement('input');
  element.type = "text";
  const classTypeAhead = ["typeahead", "tt-input", "form-control", "lieux-dist-recherche-typeahead"];
  element.classList.add(...classTypeAhead);
  element.setAttribute('placeholder', 'Rechercher votre AMAP ...');
  let newEl = amapTypeahead.appendChild(element);
  document.body.insertAdjacentHTML('beforeend', newEl);
  inputMarche = document.querySelector('.typeahead');
}

function hideCircuitCourt(){
  sousTypeSelect.classList.add("d-none");
}

function hideNewMarche(){
  newMarcheBox.classList.add("d-none");
  newMarcheProd.classList.add("d-none");
  checkboxMarche.checked = false;
}

function clear(divToClear) {
  while (divToClear.firstChild) divToClear.removeChild(divToClear.firstChild);
}

function showCircuitCout() {
  sousTypeSelect.classList.remove("d-none");
}

// vérifie si pk est présente : 
function pkPresent(pk_ent) {
  return (pk_ent !== undefined && pk_ent !== 'undefined' && pk_ent !== null && pk_ent !== '') && 
    postO.lieux.some(entite => entite.pk_entite === pk_ent);
}

// vérifie si la dénomination est présent : 
function denominationPresente(nom) {
  if (nom === 'NULL') return false;
  return postO.lieux.some(entite => entite.denominationPresente === nom);
}

function buildRecapLieux() {
  var html_thead = '<thead>' 
    + '<tr><th scope="col"></th><th scope="col">Type</th>' 
    + '<th scope="col">Nom</th>'
    + '<th scope="col">Date</th>'
    + '<th scope="col">Jour</th>'
    + '<th scope="col">Heure de début</th>' 
    + '<th scope="col">Heure de fin</th>'
    + '<th scope="col">Vos précisions</th></tr>'
    + '</thead>'
  var html_table = '';
  for (var i = 0; i < postO.lieux.length; i++) {
    html_table += '<tr><td style="text-align: center;"><span class="lieux-dist-recap-liste-sup" data="' + i 
      + '"><i class="fas fa-minus-square"></i><span></td>'
      + '<td><i>' + emptyIfNullOrUndefined(getTypeOuSousType(postO.lieux[i].type, postO.lieux[i].sous_type)) + '</i></td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].denomination) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].date) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].jour) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_deb) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(postO.lieux[i].heure_fin) + '</td>'
      + '<td>' + emptyIfNullOrUndefined(substrIfNeeded(postO.lieux[i].precs)) + '</td>'
      + '</tr>';
  }
  html_table = '<table class="table table-sm" id="lieux-dist-table-recap-lieux">' 
    + html_thead 
    + '<tbody>' 
    + html_table + '</tbody></table>';
  $('#lieux-dist-recap-liste').empty();
  $('#lieux-dist-recap-liste').append(html_table);
  $('#lieux-dist-recap-avant-envoi').show('slow');

  setupLieuDeleteEvent();
  if (postO.lieux.length <= 0) $('#lieux-dist-recap-avant-envoi').hide('slow');
  $('#qstprod-signuplieuxdist-json').val(encodeURIComponent(JSON.stringify(postO)));
}

function emptyIfNullOrUndefined(data) {
  return data === undefined || data === 'undefined' || data == 'null' || data === null || data === 'NULL' ? '' : data;
}

function getTypeOuSousType(type, sousType) {
  return (sousType !== undefined && sousType !== null && sousType !== '') ? type + ' (' + sousType + ')' : type;
}

function substrIfNeeded(str) {
  return str.length > 37 ? str.substring(0, 34) + '...' : str;
}

function setupLieuDeleteEvent() {
  $('.lieux-dist-recap-liste-sup').off();
  
  $('.lieux-dist-recap-liste-sup').on('mousedown', function() {

    try {

      for (var i = 0; i < postO.lieux.length; i++) {
        if (i == parseInt($(this).attr('data'))) {
          $('#cet-modal-alerte-titre').text('Veuillez confirmer la suppression');
          $('#cet-modal-alerte-paragraphe').text('Veuillez confirmer la suppression du lieu de distribution "' 
            + postO.lieux[i].denomination + '".');
          $('#cet-modal-alerte-btn-primary').text('Supprimer');
          $('#cet-modal-alerte-btn-primary').attr('data', i);
          $('#cet-modal-alerte-btn-primary').off();
          $('#cet-modal-alerte-btn-primary').on('mousedown', function() { 
            postO.lieux.splice(parseInt($(this).attr('data')), 1);
            $('#cet-modal-alerte').modal('hide');
            buildRecapLieux();
          });
          $('#cet-modal-alerte-btn-annuler').text('Annuler');
          $('#cet-modal-alerte-btn').click();
        }
      }
    } catch (error) { 
      postO = { lieux: [] };
    }
  });
}

function alerter(titre, texte, texte_boutton) {
  $('#cet-modal-alerte-titre').text(titre);
  $('#cet-modal-alerte-paragraphe').text(texte);
  $('#cet-modal-alerte-btn-primary').text(texte_boutton);
  $('#cet-modal-alerte-btn-primary').off();
  $('#cet-modal-alerte-btn-primary').on('mousedown', function() { 
    $('#cet-modal-alerte').modal('hide');
  });
  $('#cet-modal-alerte-btn-annuler').hide();
  $('#cet-modal-alerte-btn').click();
}

/** *****************************************************************************************
 * AJAXs.
 */
function ajaxCall(action) {

  if (action === undefined) return;
  $(document).ready(function() {

    $.ajax({ url: 'src/app/controller/ajaxhandlers/cet.qstprod.ajaxhandler.controller.signuplieuxdist.php',
      type: 'POST',
      data: {'action': action },
      dataType: 'JSON',
      success: function(response) {
      // Début si réseau de vente en circuit court
        if (action === "Réseau de vente en circuit court") {
          clear(selectSousType);
          const initOpt = document.createElement("option");
          initOpt.value ="0";
          initOpt.text = "-- Choississez un mode de distribution --";
          selectSousType.add(initOpt, selectSousType.options[0]);
          const test = response.map((item) => `<option value="${item.code_sous_type}">${item.sous_type}</option>`).join(' ');
          selectSousType.insertAdjacentHTML('beforeend', test);
        // fin si
        //Début si amap
        } else if (action === "AMAP" || action === "Marché") {

          let engine = new Bloodhound({
            local: response,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("denomination")
          });
          engine.initialize();

          var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
              var matches, substringRegex;
              // an array that will be populated with substring matches
              matches = [];
              // regex used to determine if a string contains the substring `q`
              substrRegex = new RegExp(q, 'i');
              // iterate through the pool of strings and for any string that
              // contains the substring `q`, add it to the `matches` array
              $.each(strs, function (i, str) {
                if (substrRegex.test(str)) matches.push(str);
              });
              
              cb(matches);
            };
          };
if (action === "AMAP") {

  $('#amap .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'engine',
        display: function(item){
          return item.denomination
        },
        source: engine.ttAdapter(),
      });

  $('#amap').on('typeahead:selected', function (e, datum) {
    postObjet = new LieuDistPost(datum.denomination, action, value, datum.pk_entite, null, null, null, null, null, null);
  });
}
else if ( action === "Marché") {

  $('#the-basics .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'engine',
        display: function(item){
          return item.denomination
        },
        source: engine.ttAdapter(),
      });


  $('#the-basics').on('typeahead:selected', function (e, datum) {
    postObjet = new LieuDistPost(datum.denomination, action, null, datum.pk_entite, null, null, null, null, null, null);
  });
      } else if (action !== 'Réseau de vente en circuit court') {
        postObjet = new LieuDistPost('NULL', action, null, null, null, null, null, null, null, null);   
      }

        // fin si
        } else {
          clear(selectSousType);
          var initOpt = document.createElement("option");
          initOpt.value ="0";
          initOpt.text = "-- Préciser votre choix --";
          selectSousType.add(initOpt, selectSousType.options[0]);
          for (var i = 0; i < response.length; i++) {
            initOpt = document.createElement("option");
            initOpt.value = response[i].code_sous_type;
            initOpt.text = response[i].sous_type;
            selectSousType.add(initOpt, selectSousType.options[i + 1]);
          }
          if (response.length > 0) {
            showCircuitCout();
            pasDeSousType = false;
          } else {
            postObjet = new LieuDistPost('NULL', selectElement.options[selectElement.selectedIndex].text, 
              null, null, null, null, null, null, null, null);   
            pasDeSousType = true;
          }
        }
      }, // END Ajax success.
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    }); // END Ajax.
  }); // END document.ready.
} // END fonction ajaxCall.

/** *****************************************************************************************
 * On DOM ready et inits libs.
 */
/** TIMEPICKER */
$(function() { $('#timeInput-heure-deb').timepicker({
  timeFormat: 'HH:mm',
  minTime: '03:00:00',
  maxHour: 20,
  startTime: new Date(0,0,0,7,0,0),
  interval: 30
});
});
$(function() { $('#timeInput-heure-fin').timepicker({
  timeFormat: 'HH:mm',
  minTime: '03:00:00',
  maxHour: 20,
  startTime: new Date(0,0,0,13,0,0),
  interval: 30
});
});
$(function() { $('[data-toggle="datepicker"]').datepicker({
  autoHide: true,
  language: 'FR',
  format: 'dd/mm/yyyy'
}); });
/** persistance des lieux sélectionnés */
$(document).ready(function() {
  try {
    postO = JSON.parse(decodeURIComponent($('#qstprod-signuplieuxdist-json').val()));
    buildRecapLieux();
  } catch (error) {
    console.log(error);
    postO = { lieux: [] };
  }
});