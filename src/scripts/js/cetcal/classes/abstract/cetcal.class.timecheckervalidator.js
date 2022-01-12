class TimeCheckerValidator extends FormValidator {

    toto() {
      super.toto();
      console.log('TimeCheckerValidator->toto');
    }

    // devient une surcharge de la Class FormValidator;
    timeCheckValidator(field) { }

}


