class Validator {

    constructor(form) {
       this.form = form;
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
        const errorMessage = field.parentElement.querySelector('.error-message')

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

class FormValidator extends Validator {

    /*    //mandatory Inputs

        mandatoryChecker(){
            if(this.mandatoryInputs){
               // console.log("inputs obligatoires")
            }else{
            //    console.log("inputs non obligatoires")
            }

        }*/

    // validate on submit

    validateFields(field) {
        super.validateFields(field);
        
        // controle de la validité des heures
        if (field.id === "timeInput-heure-fin" || field.id === "timeInput-heure-deb") {
            const heureDeb = this.form.querySelector('#timeInput-heure-deb');
            const heureFin = this.form.querySelector('#timeInput-heure-fin');
            if (field.value.trim() === "") {
                this.setStatus(field, "Merci de préciser votre heure de départ.", "error");
            } else if (heureFin.value <= heureDeb.value && heureFin.value !== "" ) {
                if(field.id === "timeInput-heure-deb" ) {
                    this.setStatus(field, `${field.previousElementSibling.innerText} est supérieure ou égale à l'heure d'arrivée`, "error");
                } else if (field.id === "timeInput-heure-fin"){
                    this.setStatus(field, `${field.previousElementSibling.innerText} est inférieure ou égale à l'heure d'arrivée`, "error");
                }
            } else {
                this.setStatus(field, null, "success");
            }
        }
    }

}


