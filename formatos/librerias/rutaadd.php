<?php
/*
<Archivo>
<Nombre>rutaadd.php</Nombre>
<Parametros>@$_POST["add"]:accion a ejecutar, @$_POST["x_idruta"]:idruta,  @$_POST["x_origen"]:identificador del origen, @$_POST["x_tipo"]: estado del registro (ACTIVO), @$_POST["x_destino"]:identificador del destino, @$_POST["x_doc"]:iddocumento, $$_POST["x_plantilla"]:plantilla del documento, $_POST["x_orden"]:obligatorio , $_GET["doc"]:iddoccumento, $_GET["plantilla"]:plantilla del documento, $_REQUEST["reset_ruta"]: cambiar_ruta(), $_GET["cancelar"]: cancelar_ruta()</Parametros>
<ruta>saia1.06/formatos/librerias/rutaadd.php</ruta>
<Responsabilidades>Administrar rutas para los documentos, formulario para adicionar ruta utiliza las funciones de db.php agregar_destino_ruta y genera_ruta. Inactiva una ruta. Es importante tener definido el radicador de salida ya que es OBLIGATORIO para crear una ruta de un documento finalizar con el radicador de salida<Responsabilidades>
<Notas>Esta version guarda el idrol de funcionario y no el codigo del funcionario como se hace en otras versiones de produccion.
Para los documentos de formato MEMO, CIRCULAR o parecidos guardan los responsables (los de la ruta que son OBLIGATORIOS) en la tabla del formato como origen(este campo dependiendo del formato)
</Notas>
<Salida>Muestra en pantalla formulario para adicionar ruta</Salida>
</Archivo>
*/
//session_start();
//include_once("SQL.php");
include_once("../../db.php");
include_once("../../class_transferencia.php");
include_once("header_formato.php");
?>
<?php
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT
     {
        font-family: Verdana,Tahoma,arial;
        font-size: 10px;
        /*text-transform:Uppercase;*/
       }
       .phpmaker
       {
       font-family: Verdana,Tahoma,arial;
       font-size: 9px;
       /*text-transform:Uppercase;*/
       }
       .encabezado
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       padding:10px;
       text-align: left;
       }
       .encabezado_list
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       vertical-align:middle;
       text-align: center;
       font-weight: bold;
       }
       table thead td
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
    		text-align: center;
        font-family: Verdana,Tahoma,arial;
        font-size: 9px;
        /*text-transform:Uppercase;*/
        vertical-align:middle;
    	 }
    	 table tbody td
       {
    		font-family: Verdana,Tahoma,arial;
        font-size: 9px;
    	 }
    	 .imagen_internos {vertical-align:middle}
       .internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
       -->
       </style>";
  echo $style;
  }
// Initialize common variables
$x_idruta = Null;
$x_origen = Null;
$x_tipo = Null;
$x_destino = Null;
$x_tipo_origen = Null;
$x_tipo_destino = Null;
$x_tipo_documental_idtipo_documental = Null;
$x_condicion_transferencia = Null;
$x_doc= Null;
$x_orden=Null;
$x_plantilla=Null;

/*
<Clase>
<Nombre>mostrar_ruta</Nombre>
<Parametros>$iddoc: identificador del documento</Parametros>
<Responsabilidades>Mostrar en pantalla la ruta que ese asociada a un documento<Responsabilidades>
<Notas>Esta funcion se muestra cuando se esta asignando la ruta a un documento, solo se muestra esta tabla cuando se le está asignando MAS DE UNA FIRMA sin contar con la del creador al documento.</Notas>
<Excepciones></Excpciones>
<Salida>Tabla con ruta en pantalla si no tiene no muestra nada</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_ruta($iddoc)
{ global $plantilla,$conn;
   $datos_doc=busca_filtro_tabla("lower(plantilla) as plantilla,descripcion","documento","iddocumento=$iddoc","",$conn);
   $plantilla=$datos_doc[0]["plantilla"];
   $descripcion=$datos_doc[0]["descripcion"];
   $ruta_actual=busca_filtro_tabla("*","ruta A","A.documento_iddocumento=".$iddoc." AND A.tipo='ACTIVO'","idruta",$conn);
   $origen = @$ruta_actual[0]["origen"];
 echo("<div style='bgcolor:blue;' class='phpmaker'>Ruta Actual Asignada a ".$plantilla." - ".$descripcion." </div><br><br>");
  if($ruta_actual["numcampos"]>0)
  {
  ?>
    <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    	<!-- Table header -->
    	<tr class="encabezado_list">
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
            De
    		</span></td>
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    	     Para
    		</span></td>
    		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
          Firma
    		</span></td>
    <!--td>&nbsp;</td-->
    	</tr>
      <?php
        for($i=0;$i<$ruta_actual["numcampos"];$i++){
        	$sItemRowClass = " bgcolor=\"#FFFFFF\"";
        	// Display alternate color for rows
        	if ($i % 2 <> 0) {
        		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
        	}
          echo('<tr'.$sItemRowClass.'><td><span class="phpmaker" >'.busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen"])."</span></td>");
          echo('<td><span class="phpmaker" >'.busca_entidad_ruta($ruta_actual[$i]["tipo_destino"],$ruta_actual[$i]["destino"])."</span></td>");
          if($ruta_actual[$i]["obligatorio"])
            echo('<td><span class="phpmaker" >'.busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen"])."</span></td>");
          else  echo('<td><span class="phpmaker" >&nbsp;</span></td>');
          echo('<!--td><a href="rutaedit.php?key='.$ruta_actual[$i]["idruta"].'">Editar</a></td--></tr>');
        }
      ?>
    </table>
  <?php
  }
}
?>
<?php include ("../../phpmkrfn.php"); ?>
<script type="text/javascript">
////////////////////////////////////////////Juan 24 Mayo Autocompletar /////////////////////////////////////

elementoSeleccionado=0;
v=1;
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
		{ // en caso que sea una versión antigua
		 try
			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
			}
		 catch (e){}
		}
 	}
 else
	return false
 pagina_requerida.onreadystatechange=function(){ // función de respuesta
 	if(pagina_requerida.readyState==4)
   {
		if(pagina_requerida.status==200)
        {
  			 cargarpagina(pagina_requerida, id_contenedor);
  		  }
     else if(pagina_requerida.status==404)
        {
			   document.write("La página no existe");
		    }
	  }

 }

 pagina_requerida.open('POST', url, true); // asignamos los métodos open y send
 pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
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
function autocompletar(idcomponente, digitado, tipo)
{
  if(idcomponente==2)
    document.getElementById('x_origen').value='';
  else
    document.getElementById('x_destino').value='';
  if(tipo==0)
  {
    alert('Debe seleccionar primero el tipo');
    if(idcomponente==1)
      document.getElementById('x_nombre_destino').value='';
    else
      document.getElementById('x_nombre_origen').value='';
  }
  else
    llamado("../../Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo);
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
function ParaelTab(evento,numero)
{
  var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
	if(teclaPresionada==9 || teclaPresionada==13)
	{
   if(elementoSeleccionado!=0)
	 {
       clickLista(document.getElementById("d" + numero + "comp" + elementoSeleccionado), "auto" + numero, "comple" + numero, document.getElementById("d"+numero+"valor"+elementoSeleccionado).value);
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
        if(numero==2)
          document.getElementById('x_orden').focus();
        else
        {
          var nombrecondicion = document.getElementsByName('x_condicion_transferencia');
          nombrecondicion[0].focus();
        }
      }
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
function clickLista(elemento, inputLista, divLista, codigo)
{
  v=1;
	valor=elemento.innerHTML;
	document.getElementById(inputLista).value=valor;
	document.getElementById(divLista).style.display="none";
	elemento.style.backgroundColor="#EAEAEA";
	document.getElementById('Action').disabled=false;
	elementoSeleccionado = 0;
	if(inputLista=='auto2')
	 document.getElementById("x_origen").value=codigo;
  else
    document.getElementById("x_destino").value=codigo;
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
<?php

// Elimina la ruta y la vuelve a crear
  if(isset($_REQUEST["reset_ruta"])&&$_REQUEST["reset_ruta"])
   {
     cambiar_ruta($_REQUEST["doc"]);
   }
 if(isset($_GET["cancelar"]))
  {
   cancelar_ruta($_GET["doc"],strtolower($_GET["plantilla"]));
   $formato=busca_filtro_tabla("lower(plantilla) as formato,b.mostrar_pdf","documento a, formato b","iddocumento=".$_GET["doc"]." and lower(plantilla)=lower(b.nombre)","",$conn);
   if($formato[0]["mostrar_pdf"] == 1){
   	redirecciona($ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=".$_GET["doc"]."&actualizar_pdf=1");
	 }else if($formato[0]["mostrar_pdf"]==2){
	  	$iddoc=$_GET["doc"];
		$from_externo=1;
	  	$ruta_db_superior='../../';
		$_REQUEST['from_externo']=1;
	  	include($ruta_db_superior.'pantallas/lib/PhpWord/exportar_word.php');
	  	redirecciona($ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=".$_GET["doc"]."&pdf_word=1");
	 }else{
	 	redirecciona($ruta_db_superior. FORMATOS_CLIENTE .$formato[0][0]."/mostrar_".$formato[0][0].".php?iddoc=".$_GET["doc"]);
	 }
  }
// Get action
$id_dependencia =  @$_GET["dependencia"];
$sAction = @$_POST["add"];
if (($sAction == "") || (($sAction == NULL))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{
	// Get fields from form
	$x_idruta = @$_POST["x_idruta"];
	$x_origen = @$_POST["x_origen"];
	//$x_cargo_origen = @$_POST["x_cargo_origen"];
	//$x_cargo_destino = @$_POST["x_cargo_destino"];
	$x_tipo = @$_POST["x_tipo"];
	$x_destino = @$_POST["x_destino"];
	if(isset($_POST["x_tipo_origen"])&&$_POST["x_tipo_origen"])
	  $x_tipo_origen = $_POST["x_tipo_origen"];
	else
	  $x_tipo_origen = 5;
	$x_tipo_destino = 5;
	$x_condicion_transferencia = @$_POST["x_condicion_transferencia"];
	$x_doc = @$_POST["x_doc"];
	$x_plantilla=@$_POST["x_plantilla"];
	$x_orden = @$_POST["x_orden"];
}

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			redirecciona("../../rutalist.php?dependencia=0");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$adicional='';
			if(@$_REQUEST['cargar']){
				$adicional='&cargar=1';
			}
			redirecciona("rutaadd.php?doc=".$x_doc."&x_plantilla=".$_REQUEST["x_plantilla"]."&x_orden=$x_orden&origen=".$x_destino."&tipo_origen=5".$adicional);
			exit();
		}
		else {
			redirecciona("../../rutalist.php?dependencia=0");
			exit();
			}
		break;
  case "T":
    if (AddData($conn)) { // Add New Record
     	exit();
		}
		else {
			redirecciona("../../rutalist.php?dependencia=0");
			exit();
			}
		break;
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {

if(document.getElementById('x_origen').value=='')
{
  alert('El origen no es valido');
  return false;
}
 var list_funcionarios = tree2.getAllChecked();
 var funcionarios = list_funcionarios.split(",");
 var func ="";
 for(i=0; i<funcionarios.length; i++)
  { if(funcionarios[i]!="")
    { if(func=="")
        func = funcionarios[i];
      else
        func += ","+funcionarios[i];
    }
  }
 if(func.indexOf(",")!= -1)
 { alert("Solo puede seleccionar un solo funcionario"); return false;}
 else
  EW_this.x_destino.value=func;

if(EW_this.x_destino.value=='')
{
  alert('Debe seleccionar un destino');
  return false;
}

if(EW_this.origen.value==EW_this.x_destino.value){
  alert('El origen no puede ser igual al destino por favor seleccione otro usuario.');
  return(false);
}
return true;
}
//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="../../botones/configuracion/ruta.gif" border="0">&nbsp;&nbsp;RUTA DE LOS DOCUMENTOS
</span></p><!--span class="phpmaker">
<br><br><a href="rutalist.php">Ver Todas Las Rutas</a></span></p-->
<?php
mostrar_ruta($_GET['doc']);
?>
<form name="rutaadd" id="rutaadd" action="rutaadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="add" id='add' value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
      <tr>
        <td class="encabezado""><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">SERIE DOCUMENTAL</span></font></td>
        <td colspan="4" bgcolor="#F5F5F5">
        <?php
          if(isset($_GET['doc'])){
            $x_doc=$_GET['doc'];
            $x_plantilla=@$_GET['x_plantilla'];
            ?>
            <input type="hidden" name="x_doc" value=<?php echo $x_doc;?>>
            <input type="hidden" name="x_plantilla" value=<?php echo @$_REQUEST["x_plantilla"];?>>
            <?php
            $temp=busca_filtro_tabla("A.serie,A.iddocumento,A.descripcion","documento A","A.iddocumento=".$x_doc,"",$conn);
            if($temp["numcampos"]){
              $x_serie=$temp[0]["serie"];
              }
            else $x_serie=0;
            }
          else $x_doc=0;
?>
<input type="hidden" name="x_serie" value=<?php echo $x_serie;?>>
<?php $temp2=busca_filtro_tabla("nombre","serie","idserie=".$x_serie,"",$conn);
  if($temp2["numcampos"])
    echo($temp2[0]["nombre"]);
?>
</td>
</tr>
      <tr>
        <td class="encabezado""><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span style="color: #FFFFFF">DOCUMENTO </span></font></td>
        <td colspan="4" bgcolor="#F5F5F5">
        <?php
         echo $temp[0]["descripcion"];
        echo "<input type='hidden' name='x_doc' value='$x_doc'>";
?> </td>
      </tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ORIGEN DEL DOCUMENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		  <?php
      $orig=0;
      if(isset($_REQUEST["origen"])&& $_REQUEST["tipo_origen"]=="1")
        {$funcionario=busca_filtro_tabla("idfuncionario,nombres,apellidos,funcionario_codigo","funcionario","funcionario_codigo='".$_REQUEST["origen"]."'","",$conn);
         echo $funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"];
         echo("<input type='hidden' name='x_origen' value='".$funcionario[0]["funcionario_codigo"]."'><input type='hidden' name='x_tipo_origen' value='1'>");
         $orig=1;
        }
      elseif(isset($_REQUEST["origen"])&& $_REQUEST["origen"]<>""){
	      $origen=busca_filtro_tabla("iddependencia_cargo,funcionario_codigo AS codigo,".concatenar_cadena_sql(array("nombres","' '","apellidos"))." AS nombres,dependencia.nombre AS dependencia","funcionario,dependencia_cargo,dependencia","iddependencia_cargo='".$_REQUEST["origen"]."' AND funcionario_idfuncionario=idfuncionario AND dependencia_iddependencia=iddependencia AND dependencia.estado=1 AND funcionario.estado=1 AND dependencia_cargo.estado=1","",$conn);
	      if($origen["numcampos"]){
          $orig=1;
          echo($origen[0]["nombres"]."-".$origen[0]["dependencia"]);
          echo("<input type='hidden' name='x_origen' id='x_origen' value='".$origen[0]["iddependencia_cargo"]."'>");
        }
       else
        {$funcionario=busca_filtro_tabla("idfuncionario,nombres,apellidos,funcionario_codigo","funcionario,dependencia_cargo","iddependencia_cargo='".$_REQUEST["origen"]."' AND funcionario_idfuncionario=idfuncionario","",$conn);

		  $roles_actuales=busca_filtro_tabla("cargo.nombre,dependencia.nombre as dep,iddependencia_cargo","dependencia_cargo,dependencia,cargo","funcionario_idfuncionario='".$funcionario[0]["idfuncionario"]."' AND cargo_idcargo=idcargo and dependencia_iddependencia=iddependencia and dependencia_cargo.estado=1","iddependencia_cargo desc",$conn);

         if($roles_actuales["numcampos"])
           {echo $funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]."<br /><select name='x_origen' id='x_origen'>";
            for($i=0;$i<$roles_actuales["numcampos"];$i++)
            {echo '<option value="'.$roles_actuales[$i]["iddependencia_cargo"].'" ';
             if($i==0)
               echo " selected ";
             echo '>'.$roles_actuales[$i]["nombre"]."(".$roles_actuales[$i]["dep"].")".'</option>';
            }

            echo "</select>";
            $orig=1;
           }
         else
          {echo $funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"];
           echo("<input type='hidden' name='x_origen' value='".$funcionario[0]["funcionario_codigo"]."'><input type='hidden' name='x_tipo_origen' value='1'>");
           $orig=1;
          }
        }
		  }
		 ?>
      </td>
	</tr>
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">RESPONSABLE DE APROBACION DEL DOCUMENTO</span></td>
<td bgcolor="#F5F5F5">
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<input type="hidden" name="x_destino" id="x_destino">
	<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="../../botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="../../botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="../../botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="../../imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("../../imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
			tree2.setOnLoadingStart(cargando_func);
      tree2.setOnLoadingEnd(fin_cargando_func);
      tree2.enableSmartXMLParsing(true);
			tree2.loadXML("../../test.php?rol=1&sin_padre=1");
			tree2.setOnCheckHandler(onNodeSelect_tree2);
        function onNodeSelect_tree2(nodeId)
        {valor_destino=document.getElementById("x_destino");
         if(tree2.isItemChecked(nodeId))
           {if(valor_destino.value!=="")
            tree2.setCheck(valor_destino.value,false);
            if(nodeId.indexOf("_")!=-1)
               nodeId=nodeId.substr(0,nodeId.indexOf("_"));
            valor_destino.value=nodeId;
           }
         else
           {valor_destino.value="";
           }
        }
			function fin_cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "";
      }
	-->
	</script>
	</td></tr>
	<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Solicitud de Firma</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <table border="0"><tr>
	  	<td title="La Firma electronica se muestra en el documento">
      <input type="radio" name="x_orden" id="si" value="1" checked><label for="si">Requiere Firma del Funcionario</label>
      </td></tr><tr><td title="Se incluye en parte inferior del documento :  Reviso : Funcionario - Cargo se indica si la revision esta pendiente o ya se realizo">
      <input type="radio" name="x_orden" id="rv" value="2" ><label for="no">Requiere Revisado del Funcionario</label>
      </td></tr><tr><td title="El funcionario debe aprobar el documento para el tramite del mismo y su aprobacion, pero no aparecen ni su firma ni su revisado en el documento">
      <input type="radio" name="x_orden" id="no" value="0" ><label for="no">Responsable Sin Firma ni Revisado</label></span>
      </td></tr>

      <tr><td title="El funcionario debe firmar primero por medio del enlace firmar, despues de firmar saldra su firma correspondiente">
      <input type="radio" name="x_orden" id="no" value="5" ><label for="no">Requiere firma manual</label></span>
      </td></tr>

      </table> </td>
	</tr>
	</table>
  <p>
  <input type="hidden" name="x_tipo" value="ACTIVO">
  <input type="hidden" name="obligatorio" value="<?php
  if(isset($_REQUEST["x_orden"]))
    echo $_REQUEST["x_orden"];
  else
    echo $_REQUEST["obligatorio"];
  ?>">

  <?php
  	if(@$_REQUEST['cargar']){
  		?>
  		<input type="hidden" name="cargar" value="1"/>
  		<?php
  	}

  	if(@$_REQUEST['doc']){
  		$datos_pdf_word=busca_filtro_tabla("b.mostrar_pdf","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".@$_REQUEST['doc'],"",$conn);

		if($datos_pdf_word['numcampos']){
			if($datos_pdf_word[0]['mostrar_pdf']==2){

				echo('<input type="hidden" name="exportar_pdf_word" id="exportar_pdf_word" value="1">');

				if(@$_REQUEST['from_mostrar']){
					$_SESSION['abrir_centro']=1;
				}



			} //fin if mostra_pdf ==2
		} //fin if datos pdf word numcampos
  	}//fin if request doc

  ?>

  <input type="hidden" name="x_condicion_transferencia" value="POR_APROBAR">
  <input type="submit" name="Action" id="Action" value="AGREGAR OTRO RESPONSABLE" onclick="add.value='A';">
  <input type="submit" name="terminar" value="CONTINUAR" onclick="add.value='T';">
  </p>
  </form>
<?php include ("../../footer.php") ?>
<?php

/*
<Clase>
<Nombre>LoadData</Nombre>
<Parametros>$sKey:identificador de la ruta;$conn: conexion a bd</Parametros>
<Responsabilidades>Busca los datos de la ruta<Responsabilidades>
<Notas>No se utiliza esta funcion</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Definicion de las variables globales<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/

function LoadData($sKey,$conn)
{
	global $_SESSION;

	global $x_idruta;
	global $x_origen;
	global $x_tipo;
	global $x_destino;
	global $x_tipo_documental_idtipo_documental;
	global $x_condicion_transferencia;
	global $doc;

	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.* FROM ruta A";
	$sSql .= " WHERE A.idruta = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Falló al Ejecutar la Búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
  if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idruta = $row["idruta"];
		$x_origen = $row["origen"];
		$x_tipo = $row["tipo"];
		$x_destino = $row["destino"];
		$x_tipo_documental_idtipo_documental = $row["idtipo_documental"];
		$x_condicion_transferencia = $row["condicion_transferencia"];
		$x_doc=$row["documento_iddocumento"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables
/*
<Clase>
<Nombre>AddData</Nombre>
<Parametros>$conn: conexion a bd</Parametros>
<Responsabilidades>adicionar los registros de ruta en la bd<Responsabilidades>
<Notas>Al final se valida si el documento tiene campos en el formato donde se almacena los responsables del documento (personas que firman) como por ejemplo formato memorando campo origen </Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Debe haber un funcionario radicador creado en la tabla configuarcion (radicador_salida) que corresponde al login de un funcionario craado en SAIA con rol estado activo, este es el ultimo en la ruta de los documentos<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function AddData($conn)
{
	global $_SESSION;
	global $_POST;
	global $_POST_FILES;
	global $_ENV;
  global $x_doc;
  global $x_plantilla;
  global $x_origen;
  global $x_tipo, $x_destino, $x_tipo_documental_idtipo_documental, $x_condicion_transferencia,$dat_orig;
  global $x_tipo_origen, $x_tipo_destino, $x_orden;
	// Add New Record

  $sSql = "SELECT A.* FROM ruta A";
	$sSql .= " WHERE 0 = 1";
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}

	// Field origen
	$theValue = ($x_origen != "") ? intval($x_origen) : "NULL";
	$fieldList["origen"] = $theValue;

	// Field tipo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo) : $x_tipo;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["tipo"] = $theValue;

	// Field destino
	$fieldList["destino"] = $x_destino;

	// Field tipo_documental_idtipo_documental
	$theValue = ($x_tipo_documental_idtipo_documental != "") ? intval($x_tipo_documental_idtipo_documental) : "NULL";
	$fieldList["idtipo_documental"] = $theValue;
	// Field documento
  if($x_doc != "")
	 $fieldList["documento_iddocumento"] = intval($x_doc);
  else
    $fieldList["documento_iddocumento"] = "NULL";

	// Field condicion_transferencia
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_condicion_transferencia) : $x_condicion_transferencia;
	$theValue = ($theValue != ""||$x_condicion_transferencia=='NINGUNO') ? $theValue  : "NULL";
	$fieldList["condicion_transferencia"] = $theValue;

	if(isset($_REQUEST["obligatorio"]))
	   $fieldList["obligatorio"]=intval($_REQUEST["obligatorio"]);
  else
     $fieldList["obligatorio"]=intval($x_orden);
  if($x_orden<>"")
    $obligatorio=intval($x_orden);
  else
    $obligatorio=0;

  $fieldList["orden"]=0;

  $destino=array();
  $destino=agregar_destino_ruta($destino,$x_tipo_origen,$fieldList["origen"],"",$fieldList["condicion_transferencia"], $fieldList["obligatorio"]);
  $destino=agregar_destino_ruta($destino,$x_tipo_destino,$fieldList["destino"],"",$fieldList["condicion_transferencia"], $obligatorio);

    if($fieldList["destino"]=="")
    {alerta("Debe elegir un funcionario destino.");
     echo "<script>window.history.go(-1);</script>";
     return false;
    }
  else
   {global $sql,$conn;

  if($_POST["add"]=="T"){
    $rs=busca_filtro_tabla("A.*,valor","configuracion A","nombre like 'radicador_salida'","",$conn);
    if($rs["numcampos"]>0){
      //$func=busca_cargo_funcionario(6,$rs[0]["valor"],"",$conn);
      $func=busca_filtro_tabla("estado,funcionario_codigo","funcionario","login='".$rs[0]['valor']."'","",$conn);
      //print_r($func);die();

      if($func["numcampos"]>0&&$func[0]["estado"]){
        $destino=agregar_destino_ruta($destino,1,$func[0]["funcionario_codigo"],1,"APROBADO",$obligatorio);
      }
      else alerta("No se puede encontrar el usuario Radicador de Salidas por favor verifique su Configuracion.");
    }
   $busca_memo=busca_filtro_tabla("A.*","ft_memorando A","A.documento_iddocumento=".$fieldList["documento_iddocumento"],"",$conn);

   if($busca_memo["numcampos"])
      {$sql2="update ft_memorando set origen='".$fieldList["destino"]."' where idft_memorando=".$busca_memo[0]["idft_memorando"];
       phpmkr_query($sql2,$conn);
      }
   $busca_cc=busca_filtro_tabla("A.*","ft_nota_interna A","A.documento_iddocumento=".$fieldList["documento_iddocumento"],"",$conn);
   if($busca_cc["numcampos"])
      {$sql2="update ft_nota_interna set origen='".$fieldList["destino"]."' where idft_nota_interna=".$busca_cc[0]["idft_nota_interna"];
       phpmkr_query($sql2,$conn);
      }
  }
  genera_ruta($destino,$fieldList["idtipo_documental"],$fieldList["documento_iddocumento"]);

  if($_POST["add"]=="T"){
  $plantilla=busca_filtro_tabla("lower(plantilla) as plantilla,idformato,mostrar_pdf","documento,formato","iddocumento=".$fieldList["documento_iddocumento"]." and lower(plantilla)=lower(nombre)","",$conn);
    //aprobar($fieldList["documento_iddocumento"]);
  if($plantilla[0]["mostrar_pdf"]==1){
  	$sql1="UPDATE documento SET pdf=null WHERE iddocumento=".$fieldList["documento_iddocumento"];
  	phpmkr_query($sql1);

  	if(!@$_REQUEST["x_plantilla"]){
			abrir_url("../../pantallas/documento/visor_documento.php?iddoc=".$fieldList["documento_iddocumento"]."&actualizar_pdf=1","_self");
			die();
		}
  }

  if(@$_REQUEST['exportar_pdf_word'] && $plantilla[0]["mostrar_pdf"]==2){
  	$iddoc=$fieldList["documento_iddocumento"];
  	$ruta_db_superior='../../';
	$_REQUEST['from_externo']=1;
  	include_once($ruta_db_superior.'pantallas/lib/PhpWord/exportar_word.php');
  }
  $target="_self";
  if(@$_SESSION['abrir_centro']){
  	$ruta="../ordenar.php?key=".$fieldList["documento_iddocumento"]."&accion=mostrar&mostrar_formato=1";
    $target="centro";
  	unset($_SESSION['abrir_centro']);
  }

  if(@$_REQUEST['cargar']){
  	abrir_url("../../" . FORMATOS_CLIENTE . $plantilla[0]["plantilla"]."/mostrar_".$plantilla[0]["plantilla"].".php?iddoc=".$fieldList["documento_iddocumento"]."&idformato=".$plantilla[0]["idformato"],"_self");

  }else{
  	abrir_url("../../" . FORMATOS_CLIENTE . $plantilla[0]["plantilla"]."/detalles_mostrar_".$plantilla[0]["plantilla"].".php?iddoc=".$fieldList["documento_iddocumento"]."&idformato=".$plantilla[0]["idformato"]."&key=".$fieldList["documento_iddocumento"],"_self");
  }



  }
	return true;
	}
}

/*
<Clase>
<Nombre>cambiar_ruta</Nombre>
<Parametros>$iddoc: identificador del documento</Parametros>
<Responsabilidades>cambiar de estado a toda la ruta del documento a estado INACTIVO en la tabla ruta<Responsabilidades>
<Notas></Notas>
<Excepciones>El estado debe estar activo para poder ser editad la ruta</Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function cambiar_ruta($iddoc){
	global $conn;
  $temp=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);

     $condicion_not_borrador=" AND A.nombre NOT LIKE('BORRADOR') ";
     $adiciona_in_borrador='';
    if(@$_REQUEST['reset_borrador']){
        $condicion_not_borrador='';
        $adiciona_in_borrador="'BORRADOR',";
    }


	if($temp[0]["estado"]=='ACTIVO'){
	$sql="UPDATE ruta A SET A.tipo='INACTIVO' WHERE A.documento_iddocumento=".$temp[0]["iddocumento"];
	phpmkr_query($sql,$conn);
	$sql="UPDATE buzon_entrada A SET A.nombre=".concatenar_cadena_sql(array("'ELIMINA_'","A.nombre"))." WHERE A.archivo_idarchivo=".$temp[0]["iddocumento"]." AND A.nombre NOT LIKE('ELIMINA_%') ".$condicion_not_borrador." AND A.nombre IN(".$adiciona_in_borrador."'POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')";
	phpmkr_query($sql,$conn);
	$sql="UPDATE buzon_salida A SET A.nombre=".concatenar_cadena_sql(array("'ELIMINA_'","A.nombre"))."  WHERE A.archivo_idarchivo=".$temp[0]["iddocumento"]." AND A.nombre NOT LIKE('ELIMINA_%') ".$condicion_not_borrador." AND A.nombre IN(".$adiciona_in_borrador."'POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')";
	phpmkr_query($sql,$conn);
	$sql1="DELETE FROM asignacion where tarea_idtarea=2 and documento_iddocumento=".$temp[0]["iddocumento"];
	phpmkr_query($sql1,$conn);


    if(@$_REQUEST['reset_borrador']){ //se recrea el borrador con un nuevo usuario
        $new_user_borrador=@$_REQUEST['new_user_borrador'];

        $sqlbe="
        INSERT INTO buzon_entrada (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,tipo,activo,ruta_idruta,ver_notas) VALUES
            (".$temp[0]["iddocumento"].",'BORRADOR','".$new_user_borrador."',1,".fecha_db_almacenar(date("Y-m-d h:i:s"),'Y-m-d H:i:s').",'".$new_user_borrador."',1,'ARCHIVO',0,0,0)
        ";
        phpmkr_query($sqlbe,$conn);

        $sqlbs="
        INSERT INTO buzon_salida (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,tipo,ruta_idruta,ver_notas) VALUES
            (".$temp[0]["iddocumento"].",'BORRADOR','".$new_user_borrador."',1,".fecha_db_almacenar(date("Y-m-d h:i:s"),'Y-m-d H:i:s').",'".$new_user_borrador."',1,'ARCHIVO',0,0)
        ";
        phpmkr_query($sqlbs,$conn);
    }


	if($temp[0]["plantilla"]=="")
		$temp[0]["plantilla"]="Documento";
	}else if($temp[0]["estado"]!='ACTIVO'){
		alerta("El documento no puede ser editado, Si desea modificar la Ruta Comuniquese con el Administrador ");
		redirecciona("documentoview.php?key=".$temp[0]["iddocumento"]."&tipo_destino=1");
	}else
		echo("<div style='color:blue;'>No existe una Ruta Asignada</div>");
}

/*
<Clase>
<Nombre>busca_entidad_ruta</Nombre>
<Parametros>$tipo: tipo de entidad, $llave identificador e la entidad</Parametros>
<Responsabilidades>dependiendo de la entidad busca el nombre y apellido del funcionario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>string con nombres y apellidos</Salida>
<Pre-condiciones>El documento debe tener ruta<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function busca_entidad_ruta($tipo,$llave){
global $conn;
switch($tipo){
  case 1:// Funcionario
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo='".$llave."'","",$conn);
    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
  break;
  case 5:
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A,dependencia_cargo","A.idfuncionario=funcionario_idfuncionario and iddependencia_cargo='".$llave."'","",$conn);
   // print_r($dato);
    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
  break;
}
}

/*
<Clase>
<Nombre>cancelar_ruta</Nombre>
<Parametros>$doc:identificador del documento; $plantilla:tipo  de formato del documento</Parametros>
<Responsabilidades>cambiar de estado a toda la ruta del documento en INACTIVO y crear en buzon_entrada el registro solo como responsable del documento la persona que lo creo.<Responsabilidades>
<Notas>Al final se valida si el documento tiene campos en el formato donde se almacena los responsables del documento (personas que firman) en este caso seria el funcionario creador del documento que es el que firma. como por ejemplo formato memorando campo origen </Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Debe haber un funcionario radicador creado en la tabla configuarcion (radicador_salida) que corresponde al login de un funcionario craado en SAIA con rol estado activo, este es el ultimo en la ruta de los documentos<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function cancelar_ruta($doc,$plantilla){
 global $conn;
	$sql="UPDATE ruta SET tipo='INACTIVO' WHERE documento_iddocumento=".$doc;
	phpmkr_query($sql);
	$buzones =busca_filtro_tabla("idtransferencia,nombre","buzon_entrada","archivo_idarchivo=".$doc." AND nombre NOT LIKE('ELIMINA_%') AND nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')","",$conn);
	for($i=0; $i<$buzones["numcampos"]; $i++){
		phpmkr_query("UPDATE buzon_entrada SET nombre=('ELIMINA_".$buzones[$i]["nombre"]."') WHERE idtransferencia=".$buzones[$i]["idtransferencia"],$conn);
	}
	phpmkr_query("UPDATE buzon_salida SET nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." WHERE archivo_idarchivo=".$doc." and nombre NOT LIKE ('ELIMINA_%') AND nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')",$conn);
	$sql1="DELETE FROM asignacion WHERE tarea_idtarea=2 and documento_iddocumento=".$doc;
	phpmkr_query($sql1);
	$sql1="UPDATE documento SET activa_admin=0 WHERE iddocumento=".$doc;
	phpmkr_query($sql1);
	$usuario = $_SESSION["usuario_actual"];
	$radicador = busca_filtro_tabla("F.funcionario_codigo as codigo","configuracion A,funcionario F","A.nombre like 'radicador_salida' and A.valor like F.login","",$conn);
	$sql="INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(".$usuario.",'ACTIVO',".$radicador[0]["codigo"].",NULL,'POR_APROBAR',".$doc.",1,1,1)";
	phpmkr_query($sql,$conn) or error("No se puede Generar una Ruta");
  $idruta=phpmkr_insert_id();

	phpmkr_query("INSERT INTO buzon_entrada (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,activo,ruta_idruta) VALUES (".$doc.",'POR_APROBAR','$usuario',1,".fecha_db_almacenar(date("Y-m-d h:m:s"),'Y-m-d H:i:s').",'".$radicador[0]["codigo"]."',1,1,".$idruta.")");

}
?>
