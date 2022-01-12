function ajouterMarche(idAdrMarche, idJoursMarche) {
	
	var selected = $(".qstprod-lieux-jour-marche-checkbox").get();
	var idTableMarches = '#listing-lieux-marches';
	var jours = '';
	for (var i = 0; i < selected.length; i++) {
		var valeur = selected[i].value.split(';')[1];
		jours += selected[i].checked ? valeur + ', ' : '';
	}

	jours = jours.length > 2 ? jours.substring(0, jours.length - 2) : jours;
	var resultText = $('#' + idAdrMarche).val() + (jours.length > 0 ? ' (Jours de présence : ' + jours + ')' : '');
	var inputMarche = '<div class="form-check"><input class="form-check-input" type="checkbox" value="mad1;' + 
		resultText + 
		'" name="qstprod-joursmarche-sasies[]" id="qstprod-joursmarche-sasies-' + i + '" checked="checked">' + 
		'<label class="form-check-label cet-qstprod-label-text">' + resultText + '</label></div>';
	if ($('#' + idAdrMarche).val().length > 0) $(idTableMarches).append(inputMarche);

	for (var i = 0; i < selected.length; i++) selected[i].checked = false;
	$('#' + idAdrMarche).val('');
}

$('#qstprod-adr-marche').on('keydown', function(evt) {
    
	var e = event || window.event;  // get event object
    var key = e.keyCode || e.which; // get key cross-browser
    if (key == 53 || key == 169) { 
        if (e.preventDefault) e.preventDefault();
        e.returnValue = false;
    }
});