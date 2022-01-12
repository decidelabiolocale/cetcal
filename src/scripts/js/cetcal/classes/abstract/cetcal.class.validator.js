class Validator {

    constructor(form) {
       this.form = form;
    }

    toto() {
      console.log('Validator->toto');
    }

    validateFields(field) { 

      // vérifie la présence de valeur
      if (field.value.trim() === "") {
          this.setStatus(field, `${field.previousElementSibling.innerText} ce champ ne peut pas être vide`, "error");
      } else {
          console.log(field.value);
          this.setStatus(field, null, "success");
      }
    }

    initialize() {
        this.getFieldsOfForm();
        /*
                this.mandatoryChecker();
        */
        this.validateOnEntry();
        //this.validateOnsubmit();
    }

    getFieldsOfForm() {
        let self = this;
        let AllFields = [...this.form.querySelectorAll('input')];
        let hasSelect = [...this.form.querySelectorAll('select')];
        const fields = AllFields.map(field => field.id);
        if (hasSelect) {
        }

        return fields;
    }

    // validate on entry
    validateOnEntry() {
        let self = this;
        const fields = self.getFieldsOfForm();
        fields.forEach(field => {
            const input = document.querySelector(`#${field}`);
            input.addEventListener('change', event => {
                self.validateFields(input);
            });
        })
    }

    setStatus(field, message, status) {
        const errorMessage = field.parentElement.querySelector('.error-message');

        // selectionner les icones erreurs
        if (status === "success") {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            return status;
        }
        if (status === "error") {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            field.parentElement.querySelector('.error-message').innerText = message;
        }
    }
}

