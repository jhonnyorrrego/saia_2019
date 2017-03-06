<?php
session_start();
include_once("header.php");
include_once("db.php");
include_once("class_transferencia.php");
include_once("librerias_saia.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script language="javascript" type="text/javascript">
////////////////////////////////////////////Autocompletar con jquery /////////////////////////////////////
$().ready(function() {
   function formatItem(row) {
		return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
	}
	function formatResult(row) {
		return row[1].replace(/(<.+?>)/gi, '');
	}
  
	$("#auto0").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:10,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto0").result(function(event, data, formatted) {
		if (data){
      $("#empresa").val(data[0]);	
		}
	});
 $("#auto1").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:10,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto1").result(function(event, data, formatted) {
		if (data){
      $("#responsable").val(data[0]);	
		}
	});
});
</script>
<?php
function formulario()
{
 global $conn;
 if(isset($_REQUEST["docs"]))
  $ucoma=strrpos($_REQUEST["docs"],",");
 else {
  alerta(" No selecciono Documentos por favor seleccione alguno y vuelva a intentar");
  redirecciona("documentolistsal.php?cmd=resetall");
  }
 if($ucoma==(strlen($_REQUEST["docs"])-1))
  $docs=substr($_REQUEST["docs"],0,-1);
 $nombres=busca_filtro_tabla("iddocumento,numero,descripcion,plantilla","documento","iddocumento IN(".$docs.")","",$conn);
 $i=0;
 $j=1;
 $valor_guia = "";
 $guia = busca_filtro_tabla("numero_guia,".fecha_db_obtener("fecha_despacho","Y-m-d H:i:s")." as fecha_despacho","salidas","fecha_despacho >= ".fecha_db_almacenar(date("Y-m-d 07:00:00"),"Y-m-d H:i:s")." and fecha_despacho < ".fecha_db_almacenar(date("Y-m-d 20:00:00"),"Y-m-d H:i:s"),"",$conn);
 if($guia["numcampos"]>0)
  $valor_guia = $guia[0]["numero_guia"];
 echo '<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/salidaslist.png" border="0">&nbsp;&nbsp;DESPACHAR DOCUMENTOS<br><br></span></p>';
 echo "<form name='form1' id='form1' method='post' action='despachar.php'>
      <table align='center'>
      <tr class='encabezado_list'><td>N&uacute;mero de Guia</td><td>Empresa</td><td>Responsable</td></tr>
      <tr><td>
      <input type='text' id='guia' name='guia' value='".$valor_guia."'>
      </td>
      <td align='center'>
                  <input name='empresa' id='empresa' type='hidden' >
                  <input type=\"text\" size=53 name=\"x_empresa0\" id=\"auto0\" >
                </td>";
      
          echo "<td><input name='responsable' id='responsable' title='obligatorio' type='hidden' >
                  <input type=\"text\" size=53 name=\"x_responsable0\" id=\"auto1\" >
                 </td>
      </tr>
      <tr class='encabezado_list'><td>&nbsp</td><td>DOCUMENTO</td><td>PLANTILLA</td></tr>";
 imprime_nombres($nombres); 
 echo "<tr><td colspan='3' align='center'>
      <input type='hidden' id='lista_despachos' name='lista_despachos' value='".$_REQUEST["docs"]."'>
      <input type='hidden' name='transferir' value='1'>
      <input type='button' onclick='validar_despachos();' value='Despachar'>
      <input type='button' onclick='window.history.go(-2);' value='Cancelar'></td></tr></table></form>";
 }
 
 function imprime_nombres($nombres){
  for($i=0;$i<$nombres["numcampos"];$i++)
  {
   echo "<tr><td align='center'><input type='checkbox' id='destino$i' name='destino$i' value='".$nombres[$i]["iddocumento"]."' checked='true' ></td>
         <td><label for='destino$i' >".$nombres[$i]["numero"]."-".delimita($nombres[$i]["descripcion"],100)."</label></td>
         <td><label for='destino$i' >".$nombres[$i]["plantilla"]."</label></td></tr>";
  }
 }

function transferir()
{
  global $conn,$sql; 
  $notificacion = false;
  $envio = busca_filtro_tabla("valor","configuracion","nombre='correo_despacho'","",$conn);
  if($envio["numcampos"]>0 && $envio[0]["valor"]==1)
   $notificacion = true;
  $destinos=explode(",",$_REQUEST["lista_despachos"]);
  $empresa=@$_REQUEST["x_empresa0"];
  $guia=@$_REQUEST["guia"];
  $responsable=(htmlspecialchars_decode(html_entity_decode((trim($_REQUEST["x_responsable0"])))));
  $lresponsable=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE '".$responsable."'","",$conn); 
  if($lresponsable["numcampos"] ){
    $idresponsable=$lresponsable[0]["idejecutor"];
  } 
  else if($responsable<>"")
  {
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$responsable."')";    
    phpmkr_query($sql,$conn);
    $idresponsable=phpmkr_insert_id();
  }  
  $lempresa=busca_filtro_tabla("A.*","ejecutor A","A.nombre LIKE'".$empresa."'","",$conn); 
  if($lempresa["numcampos"] ){
    $idempresa=$lempresa[0]["idejecutor"];
  }
  else if($empresa<>""){
    $sql="INSERT INTO ejecutor(nombre) VALUES('".$empresa."')";
    phpmkr_query($sql,$conn);
    $idempresa=phpmkr_insert_id();
  }  
  if($idresponsable<>"" ){
    $datos["origen"]=usuario_actual("funcionario_codigo");
    $enviado=usuario_actual("login");
    for($i=0;$i<count($destinos);$i++){
    	$ejecutores=array();
      $ejecutor["numcampos"]=0;
      $ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$destinos[$i],"",$conn);
      if($ejecutor["numcampos"]){
        array_push($ejecutores,$ejecutor[0]["ejecutor"]);
        $ejecutores=array_unique($ejecutores);
      }
      if($idempresa=="")
         $valores="'".$guia."','".$destinos[$i]."',NULL,'$idresponsable'";
      elseif($idresponsable=="")
         $valores="'".$guia."','".$destinos[$i]."','".$idempresa."',NULL";
      else 
         $valores="'".$guia."','".$destinos[$i]."','".$idempresa."','$idresponsable'";    
      $valores.= ",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s"); 
      $sql="INSERT INTO salidas(numero_guia,documento_iddocumento,empresa,responsable,fecha_despacho,tipo_despacho) VALUES (".$valores.",'1')";
      //die($sql);
      phpmkr_query($sql,$conn);
       $sql="update documento set estado='GESTION',tipo_despacho='1' where iddocumento=".$destinos[$i];      
      phpmkr_query($sql,$conn);
      $datos["archivo_idarchivo"]=$destinos[$i];
      $datos["tipo_destino"]=1;
      $datos["tipo"]="";
      $datos["nombre"]="DISTRIBUCION";
      $otros["notas"]="'Documento despachado En $empresa ($responsable) con Guia: $guia Por $enviado'";      
      transferir_archivo_prueba($datos,$ejecutores,$otros);
      //Envio de notificacion sobre el despacho de un documento al ejecutor
      if($notificacion)
      {
      $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=".$destinos[$i],"",$conn);
      $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
      $x_tipo_envio[] = 'msg';
      $x_tipo_envio[] = 'e-interno';                         
      $destino_mns[0] = $ejecutores;             
      enviar_mensaje("origen",$destino_mns,$mensaje);
     } 
    }
  }
  else {
    alerta("No se puede realizar el despacho");
  }
	$radicados=busca_filtro_tabla("numero","documento A","A.iddocumento in(".implode(",",$destinos).")","",$conn);
	$numeros=extrae_campo($radicados,"numero");
	//echo(estilo_bootstrap());
	//echo(librerias_bootstrap());

	//echo("<br /><div class='alert alert-warning fade in'><b>Documento(s) ".implode(",",$numeros)." despachado(s) con n&uacute;mero de gu&iacute;a ".$guia.".</b></div>");
  redirecciona("documentolistsal.php?cmd=resetall");
}
?>
<script>
function validar_despachos()
{var elegidos="";
 for(i=0;i<document.getElementById("form1").elements.length;i=i+1)
    {objeto=document.getElementById("form1").elements[i];
     if(objeto.checked==true)
        {
         if(elegidos=="")
            elegidos+=objeto.value;
         else
            elegidos+=","+objeto.value;   
        }
    }
 if(document.getElementById("auto1").value=="")
  { alert("Debe existir un responsable para el despacho");
    return false;
  }
 if(elegidos==""){
    alert("Seleccione por lo menos un destino o haga click en cancelar.");    
    return(false);
 }    
 else
   {document.getElementById("lista_despachos").value=elegidos;
    form1.submit();
   }      
}
</script>
<?php
if(isset($_REQUEST["transferir"]) && $_REQUEST["transferir"]==1)
  transferir();
else
  formulario();  
?>
<script>


elementoSeleccionado=0;
v=1;

/*
<Clase>
<Nombre>llamado
<Parametros>url-pagina que se quiere cargar; id_contenedor-id del elemento donde se van a escribir los resultados;
parametros-par�metros que ser�n pasados por el post a la pagina que vamos a llamar
<Responsabilidades>llamado asincrono a la pagina (ajax)
<Notas>utiliza la funci�n cargarpagina
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function llamado(url, id_contenedor,parametros)
{var pagina_requerida = false
 if (window.XMLHttpRequest) 
	{// Si es Mozilla, Safari etc
	 pagina_requerida = new XMLHttpRequest();
	} 
 else if (window.ActiveXObject)
	{ // pero si es IE
	 try 
		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
		} 
	 catch (e)
		{ // en caso que sea una versi�n antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // funci�n de respuesta
   	if(pagina_requerida.readyState==4)
     { 	
  		if(pagina_requerida.status==200)
          {
    			 cargarpagina(pagina_requerida, id_contenedor);
    		  }
       else if(pagina_requerida.status==404)
          {
  			   document.write("La p�gina no existe");
  		    }
  	  }
   
   }
 
 pagina_requerida.open('POST', url, true); // asignamos los m�todos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 pagina_requerida.send(parametros);

}
/*
<Clase>
<Nombre>cargarpagina
<Parametros>pagina_requerida-objeto XMLHttpRequest ;id_contenedor-id del componente donde se pondr�n los datos
<Responsabilidades> poner la informaci�n requerida en su sitio en la pagina xhtml
<Notas>
<Excepciones>si no se encuentra un elemento con el id id_contenedor genera un error,
si hay errores en el codigo html presenta problemas
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
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
<Parametros>elemento-sobre el cual est� el mouse;numero-del elemento sobre el cual se encuentra el mouse
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

/*
<Clase>
<Nombre> autocompletar
<Parametros>idcomponente-id del componente;digitado-valor digitado
<Responsabilidades>llama la funci�n en php que consulta la bd y llena la lista de opciones
<Notas>para el autocompletar
<Excepciones>
<Salida>una lista de los valores coincidentes
<Pre-condiciones>
<Post-condiciones>
*/ 
function autocompletar(idcomponente, digitado,tipo,nombre)
{
  llamado("Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo+"&nombre="+nombre);
  document.getElementById("comple"+idcomponente).style.display="inline";
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
function Teclados(evento,numero)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;

  switch(teclaPresionada)
	{ //para la flecha abajo
		case 40:
		if(elementoSeleccionado<document.getElementById("interno" + numero).childNodes.length-1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)+1)), numero);
		}
		return 0;
		//para la flecha arriba
		case 38:
		if(elementoSeleccionado>1)
		{
			mouseDentro(document.getElementById("d" + numero + "comp" + (parseInt(elementoSeleccionado)-1)), numero);
		}
		return 0;
		//para el tab
		case 9:
		return 0;
		
		default: elementoSeleccionado=0;return 1;
	}
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
function ParaelTab(evento,numero,nombre)
{
	var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
	 if(elementoSeleccionado!=0)
		  {
       clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado),"auto"+numero, "comple"+numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value,nombre);
		  }
	 if(teclaPresionada==13)
		{
		  if(document.all)
		  {
        evento.keyCode=9;
      }
      else
      {
        evento.preventDefault();
        evento.stopPropagation();
      }
      
		}
	}
}

/*
<Clase>
<Nombre>clickLista
<Parametros>elemento-seleccionado; inputLista-input donde se pondr� el valor; divLista-div con las opciones
<Responsabilidades>Se ejecuta cuando se hace clic en algun elemento de la lista. Se coloca en el input el
	valor del elemento clickeado
<Notas>Para el autocompletar
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
function clickLista(elemento,inputLista, divLista,codigo,nombre)
{	v=1;
	valor=elemento.innerHTML; 
	pos=valor.indexOf("(");
	if(pos>0)
	{valor=valor.substring(0,pos);
	}
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none"; 
	elemento.style.backgroundColor="#EAEAEA"; 
	elementoSeleccionado = 0;
	document.getElementById(nombre).value=codigo;
}

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
</script>
<?php include_once("footer.php"); ?>
