function checkForm(form) {
	for (var i = 0;i < form.elements.length;i++) {
		if ((form.elements[i].value == "") && (!form.elements[i].disabled)) {
			alert("Не заповнені всі поля");
			return false;
		}
	}
	return true;
}