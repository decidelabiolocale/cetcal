/**
 * Prevent form submit if any necessary fields are unset.
 */
$(function(){
    $('#btn-signupgen-form-valider').on('mousedown', function(e) {
    if (document.querySelector('.is-invalid') !== null || $('#annuaire-contact-problematique').val().length < 2) {
      	e.preventDefault();
      	var text = 'Des informations obligatoires sont manquantes au formulaire.'
      	text += ' Pour traiter votre inscription et créer votre compte, nous avons besoin des éléments suivant :'
      	text += ' Votre email et mot de passe (ainsi que de leurs confirmations), la commune et le code postal de la ferme.';
        $('#modal-questionaire-titre').text('Des informations obligatoires sont manquantes');
	    $('#modal-questionaire-paragraphe').text(text);
	    $('#modal-questionaire-btn-primary').text("J'ai compris");
	    $('#modal-questionaire-btn').click();
      return;
		} else {
			$('#qstprod-signupgen-nav').val('valider');
		}
  });
});

$(document).ready(function() {
  checkFormInput(60, 'qstprod-commune');
  checkFormInputInteger(9, 4, 'qstprod-cp');
  checkValidEmail(60, 'qstprod-email');
  checkValidEmailConfirmation(60, 'qstprod-email', 'qstprod-email-conf');
});

$('#cet-infosweb').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-infosweb').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-infosweb').addClass('fa-hand-o-down');
});

$('#cet-infosweb').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-infosweb').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-infosweb').addClass('fa-hand-o-up');
});

$('#cet-sondage-1').on('hidden.bs.collapse', function () {
  $('#cet-accordion-icon-sondage-1').removeClass('fa-hand-o-up');
  $('#cet-accordion-icon-sondage-1').addClass('fa-hand-o-down');
});

$('#cet-sondage-1').on('shown.bs.collapse', function () {
  $('#cet-accordion-icon-sondage-1').removeClass('fa-hand-o-down');
  $('#cet-accordion-icon-sondage-1').addClass('fa-hand-o-up');
});
