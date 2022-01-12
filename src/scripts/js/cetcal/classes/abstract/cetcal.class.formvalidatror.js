class FormValidator extends Validator {

    toto() {
      super.toto();
      console.log('FormValidator->toto');
    }

    // méthode non présente dans la class mère.
    timeCheckValidator(field) {
      console.log('class mère... rien n\'est fait ici.');
    }

}