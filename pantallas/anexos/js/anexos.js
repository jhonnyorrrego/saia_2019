function tamanio_archivo(peso , decimales) {
	clase = new Array(" B", " KB", " MB", " GB", " TB");
	var i=Math.floor(Math.log(peso)/Math.log(1024));
	var valor=Math.round(peso/Math.pow(1024,i),decimales);
	return valor.toString()+clase[i];
}