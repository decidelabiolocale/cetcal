$(function(){  
  $('#btn-contact-form-valider').on('mousedown', function(e) {
    checkValidEmail(60, 'annuaire-contact-email');
    checkFormInput(10, 'annuaire-contact-ntel');
    if (document.querySelector('.is-invalid') !== null || 
        $('#annuaire-contact-problematique').val().length < 1 ||
        !$('#annuaire-contact-antispan').is(':checked')) {
      e.preventDefault();
      var text = 'Le formulaire de contact est incomplet.';
      text += ' Pour traiter votre demande nous avons besoin des éléments suivant :';
      text += ' Votre email, un numéro de téléphone pour vous joindre ainsi que la description de votre demande.';
      $('#cet-modal-alerte-titre').text('Le formulaire de contact est incomplet');
      $('#cet-modal-alerte-paragraphe').text(text);
      $('#cet-modal-alerte-btn-primary').text("J'ai compris");
      $('#cet-modal-alerte-btn-annuler').hide();
      $('#cet-modal-alerte-btn').click();
      return;
    }
  });
});