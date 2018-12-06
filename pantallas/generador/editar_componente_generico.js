//var palabras = ["y", "o", "e", "u", "el", "la", "los", "las", "un", "uno", "una", "unos", "unas", "lo", "al", "del", "a", "de", "en", "con"];

var palabras = ["y", "o", "e", "u", "lo", "al", "del", "a", "de", "en", "con"];

function recortar(palabras, numLetras=22, union='_') {
	var txt = palabras.join(union);
	var minsize=3;
	var longitud = palabras.length;
	var i = 0;
	var maximo = txt.length;
	if(maximo <= numLetras) {
		return txt;
	}
	for (var iteraciones = 0; iteraciones < maximo; iteraciones++) {
		if(palabras[i].length > minsize) {
			palabras[i] = palabras[i].slice(0,-1);
		}
		if(palabras.join(union).length <= numLetras) {
			break;
		}
		i++;
		if(i >= longitud) {
			i = 0;
		}
	}
	var resp = palabras.join(union);
	if(resp.length > numLetras) {
		resp = resp.slice(0, numLetras);
	}
	return resp;
} // end funcion

var normalizar = (function() {
	  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
	      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuuNncc",
	      mapping = {};

	  for(var i = 0, j = from.length; i < j; i++ ) {
	      mapping[from.charAt(i)] = to.charAt(i);
	  }
	  return function(str) {
	      var ret = [];
	      for(var i = 0, j = str.length; i < j; i++) {
	          var c = str.charAt(i);
	          if(mapping.hasOwnProperty(str.charAt(i))) {
	              ret.push(mapping[c]);
	          }  else {
	              ret.push(c);
	          }
	      }
	      // replace(/\s+/g, '_' )
	      var normal = ret.join('').toLowerCase().replace(/[^a-z0-9\s]+/g, '');
	      var cadenas = normal.split(/\s+/);
	      var resp = [];
	      for(var i = 0, j = cadenas.length; i < j; i++) {
	    	  var index = palabras.indexOf(cadenas[i]);
	    	  if (index === -1) {
	    		  resp.push(cadenas[i]);
	    	  }
	      }
	      return recortar(resp, 22, '_');
	  }

	})();
