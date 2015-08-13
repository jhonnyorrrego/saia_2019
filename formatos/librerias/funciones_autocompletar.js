function autocompletar(idcomponente, digitado,tabla,mostrar,guardar)
{
  llamado("../../autocompletar_formatos.php","comple"+idcomponente,"idcomponente="+idcomponente+"&digitado="+digitado+"&tabla="+tabla+"&mostrar="+mostrar+"&guardar="+guardar);
  
}
/*
<Clase>
<Nombre>Teclados
<Parametros>
<Responsabilidades>llama las funciones necesarias dependiendo de la tecla
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
elementoSeleccionado=0;
function Teclados(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;

  //para la flecha abajo
	if(teclaPresionada==40)
	 {	if(elementoSeleccionado<document.getElementById("interno" + numero).childNodes.length-1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)+1)), numero);
		}
		return 0;
    }
    //para la flecha arriba
	else if(teclaPresionada==38)
	 {	if(elementoSeleccionado>1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)-1)), numero);
		}
		return 0;
	 }	
		//para el tab
	
//si es una letra, espacio, backspace, suprimir o un numero		
	else if((teclaPresionada>=65 && teclaPresionada<=90) || teclaPresionada==32 || teclaPresionada==109 || teclaPresionada==110 || teclaPresionada==8  || teclaPresionada==46 || (teclaPresionada>=48 && teclaPresionada<=57) || (teclaPresionada>=96 && teclaPresionada<=105))
	  {
	   elementoSeleccionado=0;
	   return 1;
	  }
	else 
	  return (0); 
}

/*
<Clase>
<Nombre>ParaelTab
<Parametros>
<Responsabilidades>autocompletar con el valor seleccionado al presionar tab
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function ParaelTab(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
	 if(elementoSeleccionado!=0)
		  {
         clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado), "auto" + numero, "comple" + numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value, numero);
		  }
	 if(teclaPresionada==13)
		{
        evento.preventDefault();
        evento.stopPropagation();   

		}
	}
}

/*
<Clase>
<Nombre>clickLista
<Parametros>elemento-seleccionado; inputLista-input donde se pondrá el valor; divLista-div con las opciones
<Responsabilidades>Se ejecuta cuando se hace clic en algun elemento de la lista. Se coloca en el input el
	valor del elemento clickeado
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function clickLista(elemento, inputLista, divLista, codigo, numero)
{	v=1;
	valor=elemento.innerHTML; 
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none"; 
	elemento.style.backgroundColor="#EAEAEA"; 
	//elementoSeleccionado = 0;
	campo="nombre"+numero;
	document.getElementById(campo).value=codigo;
}
/*
<Clase>
<Nombre>eliminarespacio
<Parametros>elemento-componente el cual voy a validar
<Responsabilidades>valida que la propiedad value del componente no contenga varios espacios seguidos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function eliminarespacio(elemento)
{
  var cadena = elemento.value;
  var inicio = 0, j=0;
  var nuevo="", palabra="";
  for(var i=0; i<cadena.length; i++)
  {
    if(cadena.charAt(i)==" ")
    {
      nuevo += palabra + " ";
      palabra = "";
      while(cadena.charAt(i)==" " && i<cadena.length)
        i++;
      i--;
    }
    else
      palabra += cadena.charAt(i);
  }
  nuevo += palabra;
  elemento.value = nuevo;
}

/*
<Clase>
<Nombre>mouseFuera
<Parametros>numero-del elemento sobre el cual se encontraba el mouse
<Responsabilidades>Des-selecciono el elemento actualmente seleccionado, si es que hay alguno
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function mouseFuera(numero)
{
	if(elementoSeleccionado!=0) 
    {
	    document.getElementById("d" + numero + "comp" + elementoSeleccionado).style.color="#000000";
	  }
}

/*
<Clase>
<Nombre>mouseDentro
<Parametros>elemento-sobre el cual está el mouse;numero-del elemento sobre el cual se encuentra el mouse
<Responsabilidades>Establezco el nuevo elemento seleccionado
<Notas>se utiliza para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function mouseDentro(elemento, numero)
{
	mouseFuera(numero);
	elemento.style.color="#CC0000";
	elemento.style.cursor="pointer";
	elementoSeleccionado=elemento.title;
}
