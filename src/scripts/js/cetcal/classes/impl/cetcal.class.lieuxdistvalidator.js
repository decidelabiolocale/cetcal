class timeCheckValidator  {


    timeCheckValidator() {

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
