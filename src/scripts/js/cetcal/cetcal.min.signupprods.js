/**
 * Prevent form submit if any necessary fields are unset.
 */
 $(document).on("submit", "form", function(e) {
  if ($('#qstprod-signupprods-nav').val() == 'ajouter' && !$("input.is-invalid").length <= 0) {

    e.preventDefault(e);
    $('#modal-questionaire-titre').text("La fiche produit n'est pas complète");
    $('#modal-questionaire-paragraphe').text("Pour compléter une fiche produit il faut renseigner les champs obligatoires.");
    $('#modal-questionaire-btn-primary').text("J'ai compris");
    $('#modal-questionaire-btn').click(); 
    return false;
  }
});

/**
 * Specific to removal navigation.
 * Prepare form for submit in a delete array entry context.
 */
 function removeProductFromTable(pIndex) {
  $('#qstprod-signupprods-nav').val('supprimer');
  $('#qstprod-signupprods-nav-pindex').val(pIndex);
}

function displayFicheProduit() {
  $('#cet-fiche-produit').toggle(400, 
    function() { 
      $('#cet-types-produits').toggle(400); 
    }
    );
}

function ajouterRechercheAFicheProduit(id) {
  
  var data = null;
  var pclass = null;
  var saisie_libre = false;
  var type = null;
  var hinputValue = $('#qstprod-produits-recherche-hidden').val();
  if (hinputValue.indexOf(':') <= -1) saisie_libre = true;

  if (saisie_libre) {
    type = 'dark';
  } else {
    data = $('#qstprod-produits-recherche-hidden').val().split(':');
    pclass = data[0];
    if (pclass === 'fruit') type = 'warning';
    else if (pclass === 'legume') type = 'success';
    else if (pclass === 'fromage') type = 'secondary';
    else if (pclass === 'fleur') type = 'danger';
    else type = 'dark'; pclass = 'null'; // Saisie libre, pas de catégorie... Pour l'instant, type = par defaut DARK.
  }

  $('#cet-produits-zone-recap').fadeIn();
  $('#qstprod-produits-recherche-recap').append('<button type="button" ' + 
    'class="' + pclass + ' cet-recherche-produit-element-btn btn btn-sm btn-outline-' + type + 
    ' cet-btn-produit-' + type + '">' + $('#qstprod-produits-recherche').val() + ' <span aria-hidden="true">&times;</span></button>');
  $('#label-resultats-recherche-produits').hide();
  $('#qstprod-produits-recherche').val('');
}

document.querySelector('input[list]').addEventListener('input', function(e) {
  var option = null;
  var input = e.target,
      list = input.getAttribute('list'),
      options = document.querySelectorAll('#' + list + ' option'),
      hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
      inputValue = input.value;

  hiddenInput.value = inputValue;
  for(var i = 0; i < options.length; i++) {
      option = options[i];
      if(option.innerText === inputValue) {
          hiddenInput.value = option.getAttribute('data-value');
          break;
      }
  }
});