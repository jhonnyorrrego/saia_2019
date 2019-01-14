function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertar(campo, title) {
	if (campo == null)
		campo = "";
	tinyMCE.execCommand('mceInsertContent', false, campo);
	tinyMCEPopup.close();
}
