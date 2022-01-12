class FormValidator {

  idsNewMarche = [
    'nv-marche-lieuxdist-nom', 
    'nv-marche-lieuxdist-adr', 
    'timeInput-heure-deb', 
    'timeInput-heure-fin', 
    'timeInput-jour'];
  newMarcheToPost = undefined
  fieldArray = []

  constructor() {
    this.newMarcheToPost = new LieuDistPost();
    this.initialize();
  }

  initialize() {
    this.appendEventListeners();
  }

  appendEventListeners() {
    this.fieldArray = [];
    this.idsNewMarche.forEach(fieldid => { this.fieldArray.push(document.getElementById(fieldid)); });
    this.fieldArray.forEach(element => {
      element.addEventListener('change', event => { this.validateFields(element); })
    });
  }


  // Logique principale de validation de tous les champs.
  validateFields(field) {

    this.completeNewMarche(field, field.value);

    // controle de la validité des heures
    if (field.id === "timeInput-heure-fin" || field.id === "timeInput-heure-deb") {
      const heureDeb = document.getElementById('timeInput-heure-deb');
      const heureFin = document.getElementById('timeInput-heure-fin');
      if (field.value.trim() === "") this.setStatus(field, "Merci de préciser une heure.", "error");
      if (heureFin.value !== "" && heureDeb.value !== "" && heureFin.value <= heureDeb.value) {
        if (field.id === "timeInput-heure-deb" ) {
          this.setStatus(field, `${field.previousElementSibling.innerText} est supérieure ou égale à l'heure de départ`, "error");
        } else if (field.id === "timeInput-heure-fin"){
          this.setStatus(field, `${field.previousElementSibling.innerText} est inférieure ou égale à l'heure d'arrivée`, "error");
        }
      } else {
        if (heureDeb.value !== "") this.setStatus(heureDeb, '', "success");
        if (heureFin.value !== "") this.setStatus(heureFin, '', "success");
      }
    } else if (field.id === "timeInput-jour") {
      // vérifie le jour de présence. 
      if (field.value.trim() === "non-renseigné") {
        this.setStatus(field, `${field.previousElementSibling.innerText} ce champ doit être renseigné`, "error");
      } else {
        this.setStatus(field, '', "success");
      }
    } else {
      // vérifie la présence de valeur. 
      if (field.value.trim() === "") {
        this.setStatus(field, `${field.previousElementSibling.innerText} ce champ ne peut pas être vide`, "error");
      } else {
        this.setStatus(field, '', "success");
      }
    }
  }

  // Affecter le message d'erreur ou le code couleur de validation pour saisies valides.
  setStatus(field, message, status) {

    const errorMessage = field.parentElement.querySelector('.nouveau-marche-error-message')

    // selectionner les icones erreurs
    if (status === "success") {
      field.classList.add('is-valid');
      field.classList.remove('is-invalid');
      field.parentElement.querySelector('.nouveau-marche-error-message').innerText = message;
      field.parentElement.querySelector('.nouveau-marche-error-message').style.display = 'none';
      return status
    }

    if (status === "error") {
      field.classList.add('is-invalid');
      field.classList.remove('is-valid');
      field.parentElement.querySelector('.nouveau-marche-error-message').innerText = message;
      field.parentElement.querySelector('.nouveau-marche-error-message').style.display = 'inline';
      this.newMarcheToPost.validated = false;
    }
  }

  // Compéter l'instance avec les valeurs des inputs / selects.
  completeNewMarche(field, value) {

    switch (field.id) {
      case 'nv-marche-lieuxdist-nom':
      this.newMarcheToPost.denomination = value;
      break;
      case 'nv-marche-lieuxdist-adr':
      this.newMarcheToPost.adr = value;
      break;
      case 'timeInput-heure-deb':
      this.newMarcheToPost.heure_deb = value;
      break;
      case 'timeInput-heure-fin':
      this.newMarcheToPost.heure_fin = value;
      break;
      case 'timeInput-jour':
      this.newMarcheToPost.jour = value;
      break;
    }

    this.newMarcheToPost.validated = this.globalValidation();
  }

  globalValidation() {
    try {
      return this.newMarcheToPost.denomination.length > 0
      && this.newMarcheToPost.adr.length > 0
      && this.newMarcheToPost.heure_deb.length > 0
      && this.newMarcheToPost.heure_fin.length > 0
      && this.newMarcheToPost.jour.length > 0 
      && this.newMarcheToPost.jour !== 'non-renseigné';
    } catch (error) {
      return false;
    }
    
  }

  clear() {
    this.fieldArray.forEach(element => {
      element.classList.remove('is-invalid');
      element.classList.remove('is-valid');
      element.removeEventListener('change', event => { this.validateFields(element); });
      element.value = '';
    });
  }

  isDataValidated() {
    return this.newMarcheToPost.validated;
  }

  getNewMarche() {
    return this.newMarcheToPost;
  }

}