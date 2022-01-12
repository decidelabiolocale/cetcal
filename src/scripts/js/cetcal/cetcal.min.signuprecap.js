/**
 * Prevent form submit if any necessary fields are unset.
 */
  $(function(){
    $('#btn-signuprecap-form-valider').on('mousedown', function(e) {
        if ($('#qstprod-declaration-valide').is(':checked')) {
        	   $('#qstprod-signuprecap-nav').val('valider'); 
    		} else {
    			  e.preventDefault();
            	var text = 'Il vous faut accepter nos conditions et engagements liées aux données numériques.'
            	text += ' Pour traiter votre inscription et créer votre compte, nous avons besoins de votre accord et déclaration.';
    	        $('#modal-questionaire-titre').text('Merci de déclarer votre accord en cochant la case "Oui, je déclare..."');
    		    $('#modal-questionaire-paragraphe').text(text);
    		    $('#modal-questionaire-btn-primary').text("J'ai compris");
    		    $('#modal-questionaire-btn').click();
            return false;
    		}
    });
 });

$(document).ready(function() {
  $('input[name=qstprod-declaration-valide]').prop('checked', false);
 });