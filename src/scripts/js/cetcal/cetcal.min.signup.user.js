var json_communes;
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {

    var matches, substringRegex;
    // an array that will be populated with substring matches
    matches = [];
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) { if (substrRegex.test(str)) { matches.push(str); } });

    cb(matches);
  };
};

var communes = [];
$.ajax({
  url: '/src/app/controller/cet.annuaire.controller.communes.php',
  success: function(json) {
    var cmns = JSON.parse(json);
    json_communes = cmns;
    for (var i = 0; i < cmns.length; ++i) communes.push(cmns[i].libelle);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
  }
});

$('#cet-annuaire-recherche-communes-conatiner .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'communes',
  source: substringMatcher(communes)
});

$(document).ready(function() {

	$("#annuaire-user-signup-form").submit(function(event) {

    var declaratif = false;
	  var commune = $('#cet-annuaire-recherche-communes-value').val();
	  var email = $('#annuaire-user-signup-email').val();
	  var email_conf = $('#annuaire-user-signup-email-conf').val();
	  var mdp = $('#annuaire-user-signup-mdp').val();
	  var mdp_conf = $('#annuaire-user-signup-mdpconf').val();
    var choix_contacts = $("#annuaire-user-signup-form input:checkbox:checked").length > 0 ?
      'ok' : undefined;
	  var data = [email, email_conf, mdp_conf, mdp, choix_contacts, commune];

	  var r = -1;
		for (var i = 0; i < data.length; i++) {
			var entry = data[i];
			if (entry === undefined || entry == 'undefined' || entry.length < 1) ++r;
		}

    if ($("#qstprod-declaration-valide-honneur").prop('checked')) {
      declaratif = true;
    } else {
      event.preventDefault();
      $('#modal-questionaire-titre').text('Il vous faut déclarer les informations renseignées sur l\'honneur');
      $('#modal-questionaire-paragraphe').text(
        'Afin de pouvoir protéger vos données personnelles et valider votre inscritpion basée sur une déclaration sur l\'honneur, veuillez cocher la case liée au déclaratif.');
      $('#modal-questionaire-btn-primary').text("J'ai compris");
      $('#modal-questionaire-btn').click();
      return false;
    }

	  if (r !== -1 || declaratif === false) {
	  	event.preventDefault();
	  	$('#modal-questionaire-titre').text('Le formulaire d\'inscription est incomplet.');
			$('#modal-questionaire-paragraphe').text(
        'Le formulaire d\'inscription est incomplet. Veuillez vérifier votre saisie. Veuillez également nous indiquer comment vous contacter.');
			$('#modal-questionaire-btn-primary').text("J'ai compris");
			$('#modal-questionaire-btn').click(); 
	  	return false;
	  } else {
	  	return true;
	  }

	});

});