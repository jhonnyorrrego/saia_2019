/*<Clase>
 <Nombre></Nombre>
 <Parametros></Parametros>
 <Responsabilidades><Responsabilidades>
 <Notas>YA NO SE USA</Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>
 function whichButton(objeto) {
 group1Checked=1;

 for (var i=0; i<document.formulario_formatos[objeto.name].length; i++) {

 if (document.formulario_formatos[objeto.name][i].checked) {
 group1Checked = 0;
 }

 }
 return(group1Checked);
 }  */

/*<Clase>
 <Nombre>auto_save</Nombre>
 <Parametros>campos:nombre de los campos separados por comas;formato:nombre del formato</Parametros>
 <Responsabilidades>Guardar en la bd el contenido de los campos del formulario marcados con autoguardado<Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>  */
function auto_save(campos, formato) {

	vector = campos.split(",");
	for ( i = 0; i < vector.length; i++) {
		if (document.getElementById(vector[i]).type == "textarea") {
			var content = tinyMCE.get(vector[i]);
			content = escape(content.getContent());
		} else {
			var content = document.getElementById(vector[i]).value;
		}
		content = content.replace("+", "%2B");
		content = content.replace("/", "%2F");
		vector[i] = vector[i] + "=" + content;
	}
	valores = vector.join("&");

	$.ajax({
		url : "../librerias/autoguardado.php",
		type : "POST",
		data : valores + "&campos=" + campos + "&formato=" + formato
	});
}

/*<Clase>
 <Nombre></Nombre>
 <Parametros></Parametros>
 <Responsabilidades><Responsabilidades>
 <Notas>YA NO SE USA</Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>
 function validar_formato()
 {  alert("entra aqui");
 var vacios=0;
 if(typeof(tinyMCE)!='undefined')
 tinyMCE.triggerSave();
 //alert(document.forms['formulario_formatos'].elements['destino'].value);
 //vacios = 1;
 for(i=0;i<document.getElementById("formulario_formatos").elements.length;i=i+1)
 {var objeto=document.getElementById("formulario_formatos").elements[i];
 alert(onjeto.name);
 if(objeto.name=='copiainterna');
 alert("cipia "+objeto.value);
 if(objeto.obligatorio=="obligatorio")
 {
 if(objeto.value=="" && objeto.type!="radio" && objeto.type!="checkbox")
 {vacios=1;
 alert("Debe digitar un valor en el campo "+objeto.name);
 objeto.focus();
 break;
 }
 else if(objeto.type=="radio" || objeto.type=="checkbox")
 {vacios=whichButton(objeto);
 if(vacios)
 {alert("Debe elegir un valor en el campo "+objeto.name.replace("[]",""));
 break;
 }
 }
 }
 if(objeto.tipo=="fecha")
 {
 //alert('entre');
 if(!validar_fecha(objeto.value))
 {
 vacios=1;
 objeto.focus();
 break;
 }
 }
 }
 if(typeof(tree_calidad) != 'undefined')
 {var list_estructuras = tree_calidad.getAllChecked();
 var estructuras = list_estructuras.split(",");
 for(i=0; i<estructuras.length; i++)
 { var cuantos=estructuras[i].indexOf ("_");
 if(cuantos>0)
 {estructuras[i]=estructuras[i].substr(0,cuantos);
 }
 }
 document.getElementById('estructura').value=estructuras.join(',');
 }
 if(typeof(tree_calidad) != 'undefined' && document.getElementById('estructura').value=="")
 {alert("Debe elegir por lo menos una estructura para el documento.");
 vacios=1;
 }
 if(vacios==0)
 {
 alert("final");
 //document.getElementById("formulario_formatos").submit();
 }
 }

 function validar_fecha(fecha){
 //alert(fecha);
 return(1);
 }  */
/*
 <Clase>
 <Nombre> autocompletar
 <Parametros>idcomponente-id del componente;digitado-valor digitado
 <Responsabilidades>llama la función en php que consulta la bd y llena la lista de opciones
 <Notas>para el autocompletar
 <Excepciones>
 <Salida>una lista de los valores coincidentes
 <Pre-condiciones>
 <Post-condiciones>
 */
function autocompletar(idcomponente, digitado, tipo) {
	llamado("../../Autocompletar.php", "comple" + idcomponente, "op=autocompl&idcomponente=" + idcomponente + "&digitado=" + digitado + "&depende=1&tipo=" + tipo);
	document.getElementById("comple" + idcomponente).style.display = "inline";
}

/*
 <Clase>
 <Nombre>adicionar_anexo</Nombre>
 <Parametros></Parametros>
 <Responsabilidades>Se encarga del manenjo del ingreso de los anexos físicos</Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones></Pre-condiciones>
 <Post-condiciones></Post-condiciones>
 </Clase>
 */
function adicionar_anexo() {
	var nombre = prompt('Por favor digite el nombre del anexo.', '');
	if (nombre != false && nombre != null) {
		anexos1 = document.getElementById("anexos_fisicos");
		if (anexos1.value == "")
			anexos1.value = nombre;
		else
			anexos1.value = anexos1.value + "," + nombre;
		mostrar_archivos2.innerHTML = mostrar_archivos2.innerHTML + "<li>" + nombre + "</li>";
	}
}

/*
 <Clase>
 <Nombre>llamado
 <Parametros>url-pagina que se quiere cargar; id_contenedor-id del elemento donde se van a escribir los resultados;
 parametros-parámetros que serán pasados por el post a la pagina que vamos a llamar
 <Responsabilidades>llamado asincrono a la pagina (ajax)
 <Notas>utiliza la función cargarpagina
 <Excepciones>
 <Salida>
 <Pre-condiciones>
 <Post-condiciones>
 */
function llamado(url, id_contenedor, parametros) {
	var pagina_requerida = false
	if (window.XMLHttpRequest) {// Si es Mozilla, Safari etc
		pagina_requerida = new XMLHttpRequest();
	} else if (window.ActiveXObject) {// pero si es IE
		try {
			pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {// en caso que sea una versión antigua
			try {
				pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
			}
		}
	} else
		return false
	pagina_requerida.onreadystatechange = function() {// función de respuesta
		if (pagina_requerida.readyState == 4) {
			if (pagina_requerida.status == 200) {
				cargarpagina(pagina_requerida, id_contenedor);
			} else if (pagina_requerida.status == 404) {
				document.write("La página no existe");
			}
		}

	}

	pagina_requerida.open('POST', url, true);
	// asignamos los métodos open y send
	pagina_requerida.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	pagina_requerida.send(parametros);

}

/*
 <Clase>
 <Nombre>cargarpagina
 <Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondrán los datos
 <Responsabilidades> poner la información requerida en su sitio en la pagina xhtml
 <Notas>
 <Excepciones>si no se encuentra un elemento con el id id_contenedor genera un error,
 si hay errores en el codigo html presenta problemas
 <Salida>
 <Pre-condiciones>
 <Post-condiciones>
 */
function cargarpagina(pagina_requerida, id_contenedor) {
	if (pagina_requerida.readyState == 4 && (pagina_requerida.status == 200 || window.location.href.indexOf("http") == -1))
		document.getElementById(id_contenedor).innerHTML = pagina_requerida.responseText;
}

function validar_destino(id, nombre, tipo) {
	if (tipo == "copia") {
		casilla = "nombre_copias";
		casilla2 = "destinos_copias";
	} else {
		casilla = "nombre";
		casilla2 = "destinos_nombres";
	}
	var elegidos = window.parent.document.getElementById(casilla).value.split(',');
	if (tipo == "eliminar") {
		var nuevos = "";
		for ( i = 0; i < elegidos.length; i++) {
			if (id != elegidos[i]) {
				if (nuevos == "")
					nuevos = elegidos[i];
				else
					nuevos = nuevos + "," + elegidos[i];
			}
		}
		window.parent.document.getElementById(casilla).value = nuevos;
	} else if (elegidos == "" && nombre.replace(/^\s*|\s*$/g, "") != "") {
		window.parent.document.getElementById(casilla).value += id;
		window.parent.document.getElementById(casilla2).value += nombre;
	} else {
		var encontrado = 0;
		for ( i = 0; i < elegidos.length; i++) {
			if (id == elegidos[i])
				encontrado = 1;
		}
		if (encontrado == 0 && nombre.replace(/^\s*|\s*$/g, "") != "") {
			window.parent.document.getElementById(casilla).value += "," + id;
			window.parent.document.getElementById(casilla2).value += "," + nombre;
		}
	}
}

/*<Clase>
 <Nombre>eliminar_destino</Nombre>
 <Parametros>destino</Parametros>
 <Responsabilidades><Responsabilidades>
 <Notas>YA NO SE USA</Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>
 function eliminar_destino(destino)
 {var lista=parent.document.getElementById("nombre").value.split(",");
 lista2=new Array();
 for(i=0;i<lista.length;i++)
 {if(lista[i]!=destino)
 lista2.push(lista[i]);
 }
 parent.document.getElementById("nombre").value=lista2.join(",");
 document.getElementById("tr"+destino).style.display="none";
 } */

/*<Clase>
 <Nombre>eliminarItem</Nombre>
 <Parametros>conjunto:lista de valores separados por coma;valor:valor que se desea quitar</Parametros>
 <Responsabilidades>Toma una cadena de valores separados por coma y quita el dato especificado en 'valor'<Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>  */
function eliminarItem(conjunto, valor) {
	j = 0;
	vector = new Array();
	lista = conjunto.split(",");

	for ( ind = 0; ind < lista.length; ind++) {
		if (lista[ind] != valor) {
			vector[j] = lista[ind];
			j = j + 1;
		}
	}
	return (vector.join(","));
}

/*<Clase>
 <Nombre>adicionarItem_padre</Nombre>
 <Parametros>campo:nombre del campo;valor:valor que se va a adicionar;tabla:nombre de la tabla en la bd;campos:campos que se muestran en pantalla;formato:id del formato</Parametros>
 <Responsabilidades>Adiciona el id que viene en 'valor' a la lista de los seleccionados y actualiza el frame en el formato padre que muestra los datos que se han insertado en el formato de tipo item<Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>  */
function adicionarItem_padre(campo, valor, tabla, campos, formato) {
	j = 0;
	nuevo = new Array();
	//if(typeof(parent.document.getElementById(campo)) != 'undefined')
	objeto = parent.document.getElementById(campo);
	//else
	//  objeto=window.document.getElementById(campo);

	if (objeto.value == "") {
		objeto.value = valor;
	} else {
		objeto.value += "," + valor;
	}
	parent.document.getElementById("listar_" + campo).src = "../librerias/funciones_item.php?accion=listar_item&tabla=" + tabla + "&campos=" + campos + "&seleccionados=" + objeto.value + "&campo=" + campo + "&formato=" + formato + "&padre=" + campo;
}

/*<Clase>
 <Nombre>buscarItem</Nombre>
 <Parametros>conjunto:cadena de valores separados por comas;valor:dato a buscar</Parametros>
 <Responsabilidades>busca un dato en una cadena de caracteres separados por coma<Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida>devuelve -1 en caso de no encontrarla, de lo contrario devuelve un valor mayor o igual a cero</Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>  */
function buscarItem(conjunto, valor) {
	var ind,
	    pos;
	lista = conjunto.split(",");
	for ( ind = 0; ind < lista.length; ind++) {
		if (lista[ind] == valor)
			break;
	}
	pos = (ind < lista.length) ? ind : -1;
	return (pos);
}

/*<Clase>
 <Nombre>eliminarItem_padre</Nombre>
 <Parametros>campo:nombre del campo;valor:valor que se va a adicionar;tabla:nombre de la tabla en la bd;campos:campos que se muestran en pantalla;formato:id del formato</Parametros>
 <Responsabilidades>Elimina el id que viene en 'valor' de la lista de los seleccionados y actualiza el frame en el formato padre que muestra los datos que se han insertado en el formato de tipo item<Responsabilidades>
 <Notas></Notas>
 <Excepciones></Excepciones>
 <Salida></Salida>
 <Pre-condiciones><Pre-condiciones>
 <Post-condiciones><Post-condiciones>
 </Clase>  */
function eliminarItem_padre(campo, valor, tabla, campos, formato) {
	var ind;
	j = 0;
	nuevo = new Array();
	lista = parent.document.getElementById(campo).value.split(",");
	for ( ind = 0; ind < lista.length; ind++) {
		if (lista[ind] != valor) {
			nuevo[j] = lista[ind];
			j = j + 1;
		}
	}
	parent.document.getElementById(campo).value = nuevo.join(",");
	document.location = "../librerias/funciones_item.php?accion=listar_item&tabla=" + tabla + "&campos=" + campos + "&seleccionados=" + parent.document.getElementById(campo).value + "&campo=" + campo + "&formato=" + formato + "&padre=" + campo;
}
