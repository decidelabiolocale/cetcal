class FormValidator {

    newMarche = undefined;

    constructor(form) {
        this.form = form;
    }

    initialize() {
        this.getFieldsOfForm();
        this.validateOnEntry();
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


    validateOnEntry() {
        let self = this;
        const fields = self.getFieldsOfForm();
        fields.forEach(field => {
            const input = document.querySelector(`#${field}`);
            input.addEventListener('change', event => {
                self.validateFields(input);
            })
        })
    }

    validateFields(field) {
        // vérifie la présence de valeur
        if (field.value.trim() === "") {
            this.setStatus(field, `${field.previousElementSibling.innerText} ce champ ne peut pas être vide`, "error");
        } else {
            console.log(field.value);
            this.setStatus(field, null, "success");
            if(field.id === "nv-marche-lieuxdist-nom" || "nv-marche-lieuxdist-adr" && field.id !== undefined ) {
               this.newMarche = this.createNewMarche(field, field.value);
            }
        }
        // controle de la validité des heures
        if (field.id === "timeInput-heure-fin" || field.id === "timeInput-heure-deb") {
            const heureDeb = this.form.querySelector('#timeInput-heure-deb');
            const heureFin = this.form.querySelector('#timeInput-heure-fin');
            if (field.value.trim() === "") {
                this.setStatus(field, "Merci de préciser votre heure de départ.", "error");
            } else if (heureFin.value <= heureDeb.value && heureFin.value !== "" ) {
                if(field.id === "timeInput-heure-deb" ) {
                    this.setStatus(field, `${field.previousElementSibling.innerText} est supérieure ou égale à l'heure de départ`, "error");
                } else if (field.id === "timeInput-heure-fin"){
                    this.setStatus(field, `${field.previousElementSibling.innerText} est inférieure ou égale à l'heure d'arrivée`, "error");
                }
            } else {
                this.setStatus(field, null, "success");
                this.newMarche = this.createNewMarche(field.id, field.value);
            }
        }
    }


    setStatus(field, message, status) {
        const errorMessage = field.parentElement.querySelector('.error-message')
        // selectionner les icones erreurs
        if (status === "success") {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            return status
        }

        if (status === "error") {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            field.parentElement.querySelector('.error-message').innerText = message;
            //this.submit.classList.add('d-none');
        }

    }
    // creer un nouveau marché
    createNewMarche(field, value){
        const newMarcheToPost = new PostValidator();
        newMarcheToPost.crea_marche = true;
        newMarcheToPost.type = 'Marché';
        switch (field.id) {
            case 'nv-marche-lieuxdist-nom':
                newMarcheToPost.denomination = value;
                break;
            case 'nv-marche-lieuxdist-adr':
                newMarcheToPost.denomination = value;
                break;
            case 'timeInput-heure-deb':
                newMarcheToPost.denomination = value;
                break;
            case 'timeInput-heure-fin':
                newMarcheToPost.denomination = value;
                break;
        }
        newMarcheToPost.heure_fin = document.querySelector('#qstprod--precisions--prod').value;

        console.log(newMarcheToPost);

        // Si problème retourner FALSE. Sinon retourner l'instance.
    }


    getNewMarche() {
      return this.newMarche;
    }

}

