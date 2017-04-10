<?php include_once ("db.php");  ?>
<html>
<head>
<title>..::ADMINISTRADOR DE ARCHIVO::.. </title>
<?php
 //include_once("cargando.php");
/*if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  redirecciona("login.php?fin=1");
}   */
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
       color:#000000;
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
       -->
       </style>";
  echo $style;
  }
?>
<style type="text/css" media="screen">

	@import "css/title2note.css";

	/* DEMO CSS */
	.nota
  {
	  TEXT-DECORATION: none;
		color:#FFFFFF;
	}
	</style>
<script type="text/javascript" src="js/ordenar_list.js"></script>
<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen">
<script type="text/javascript" src="js/bubble-tooltip.js"></script>

<style type="text/css">
.imagen_internos {vertical-align:middle}
.internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
/* If you wish to highlight current sortable column, add layout effects below */
.highlightedColumn{background-color:#CCC;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<script type="text/javascript">
	function findDOM(objectId)
  {  //funciones para el zoom de las imagenes
    if (document.getElementById)
      {
       return (document.getElementById(objectId));
      }
    if (document.all)
      {
       return (document.all[objectId]);
      }
  }
function zoom(type,imgx,sz,pag)
{ //Aleja y Acerca las paginas del documento
  imgd = findDOM(imgx);
  imgd.width = 750;
  imgd.height = 900;
  if(sz < 100)
    type = "-";
  else if(sz > 100)
    type="+";
  else
  {
    window.location='comentario_mostrar.php?pagina=pagina&key=<?php echo $_SESSION["iddoc"];?>&pag='+pag;
    return;
  }
  if (type=="+" && imgd.width < 1900)
  {
    imgd.width = (sz*imgd.width/100);
    imgd.height = (sz*imgd.height/100);//(30*sz);
  }
  if (type=="-" && imgd.width > 200)
  {
    imgd.width = (sz*imgd.width/100);//30;
    imgd.height = (sz*imgd.height/100);//(30*sz);
  }
}
</script>
<style type="text/css">
.estilotextarea
   {
    width: 140px;
    height:100px;
    border: none;
    background-color: #ffff99;
    font-family: Verdana;
    font-size: 9px;
    text-transform:none;
   }
.ppal
   {
		margin:0px;
		margin-top:0px;
		width:100%;
		background-color:#CCCCCC;
		font-family: Verdana;
	 }
</style>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#iframe_documento').load(function() {
    var alto=$('#iframe_documento').contents().find("body").height();
    $("#iframe_documento").height(parseInt(alto)+80);
	});
});

//funcion de ajax para actualizar la posicion del comentario en la imagen.
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function posicion(x,y,id,doc,pag)
  {
   var param="x="+x+'&y='+y+'&id='+id+'&doc='+doc+'&pag='+pag+'&op=cambiar_pos';
   llamado("posicion.php","otro",param,doc,pag);
  }
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
  function llamado(url, id_contenedor,parametros,doc,pag)
  {
   var pagina_requerida = false
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
  			 cargarpagina(pagina_requerida, id_contenedor,doc,pag);
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
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cargarpagina(pagina_requerida, id_contenedor,doc,pag)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
  }
 /*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function no_enter(evt)
  {
   evt = (evt) ? evt : event;
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
       ((evt.which) ? evt.which : 0));
   if (charCode == 13){
      return false;
   }
   return true;
  }
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function enlace(id,doc)
{
 var param=document.getElementById("x_comentario"+id).value;
  //alert(param);
 if(confirm('Desea guardar los cambios del comentario?'))
  window.open("comentario_img.php?key="+doc+"&id="+id+"&editar=m&x_comentario="+param,"_self");
 return false;
}
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
 function pagina(doc,pag)
 {
  if(pag=='0')
   return;
  window.open("comentario_mostrar.php?pagina=pagina&pag="+pag,"_self");
 }
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprimir(enlace)
 {
   document.getElementById("tool").style.display="none";
   document.getElementById("header").style.display="none";
   window.print();
   document.getElementById("header").style.display="block";
   document.getElementById("tool").style.display="block";
 }
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprimir_sin(enlace)
{
   document.getElementById("tool").style.display="none";
   document.getElementById("header").style.display="none";
   document.getElementById("notas").style.display="none";
   window.print();
   document.getElementById("header").style.display="block";
   document.getElementById("tool").style.display="block";
   document.getElementById("notas").style.display="block";
}
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function ocultar_enlaces()
{
  // window.frames[0].document.getElementById("div1").style.display="none";
   window.frames[0].document.getElementById("header").style.display="none";
}

</script>
</head>
<body style="background-color: transparent; position:absolute;width:99%"  marginheight="0" topmargin="0" vspace="0"
marginwidth="0" leftmargin="0" hspace="0" style="margin:0; padding:0">
<div id="div_contenido">
<?php
if (@$sExport == "")
{
?><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<!-- right column -->
<td width="100%" valign="top" >
<?php
}
menu_ordenar($_REQUEST['key']);
?>
</div>
<?php
echo "</br></br>";
$x_comentario = Null;
$accion="";
$enlace = "";
if(isset($_REQUEST["key"]) && $_REQUEST["key"]<>"")
$llave=$_REQUEST["key"];
else
$llave=$_REQUEST["iddoc"];

$frame="centro";
$plantilla=busca_filtro_tabla("plantilla","documento","iddocumento=$llave","",$conn);
if($plantilla[0][0]<>"")
 $frame="detalles";

if(isset($_SESSION["pagina_actual"]))       //identificador de la pagina
 {
   if(isset($_SESSION["tipo_pagina"]) && strstr($_SESSION["tipo_pagina"],".php"))
    {$enlace = $_SESSION["tipo_pagina"]."&comentario=1";
     $pag=$_SESSION["pagina_actual"];
     $tipo_pag = "PLANTILLA";
    }
   else
   { $tipo_pag = "PAGINA";
     $pag=$_SESSION["pagina_actual"];
     $valida_pag = busca_filtro_tabla("*","pagina","id_documento=$llave AND consecutivo=$pag","",$conn);
     if(!($valida_pag["numcampos"]) && !(isset($_POST["adicion"])))
       echo codifica_encabezado("<script type='text/javascript'>alert('Debe seleccionar una p�gina del documento'); window.open('ordenar.php?key=".$llave."&accion=mostrar','_self');</script>");
   }
 }
else
 {
  echo codifica_encabezado("<script type='text/javascript'>alert('Debe seleccionar una p�gina del documento'); window.open('ordenar.php?key=".$llave."&accion=mostrar','_self');</script>");
 }

// Se inserta un nuevo comentario a la imagen en la base de datos
if(isset($_POST["adicion"]) && $_POST["adicion"])
{ $x_comentario = $_POST["x_comentario"];
  $add = "INSERT INTO comentario_img (documento_iddocumento,comentario,tipo,pagina,posx,posy,funcionario,fecha) VALUES (".$_POST["key"].",'".$x_comentario."','".$_POST["tipo"]."',".$_POST["pag"].",0,0,'".$usuactual."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
  phpmkr_query($add, $conn) or error("Fall� al Ejecutar la adicion" . phpmkr_error() . ' SQL:' . $add);
  redirecciona("comentario_img.php?key=".$_POST["key"]."&pag=".$_POST["pag"]."&accion=mostrar");
}

// Se modifica un comentario de la imagen en la base de datos
if(isset($_GET["editar"]) && $_GET["editar"])
{ $x_comentario = $_GET["x_comentario"];
  $editar = "UPDATE comentario_img SET comentario='".$x_comentario."' WHERE idcomentario_img=".$_GET["id"];
  phpmkr_query($editar, $conn) or error("Fall� al Ejecutar la actualizacion " . phpmkr_error() . ' SQL:' . $editar);
  redirecciona("comentario_img.php?key=".$llave."&pag=".$_SESSION["pagina_actual"]."&accion=mostrar");
}

// Se Elimina un comentario de la imagen en la base de datos
if(isset($_GET["eliminar"]) && $_GET["eliminar"])
{ $datos=busca_filtro_tabla("","comentario_img","idcomentario_img=".$_GET["id"],"",$conn);
  $eliminar = "DELETE FROM comentario_img WHERE idcomentario_img=".$_GET["id"];
   phpmkr_query($eliminar, $conn);
	 if(is_object($datos[0]["fecha"]))$datos[0]["fecha"]=$datos[0]["fecha"]->format('Y-m-d');
   $detalle="comentario creado por:".$datos[0]["funcionario"].", el: ".$datos[0]["fecha"].", texto: ".$datos[0]["comentario"];
   registrar_accion_digitalizacion($datos[0]["documento_iddocumento"],'ELIMINACION COMENTARIO',$detalle);
   redirecciona("comentario_img.php?key=".$llave."&pag=".$_SESSION["pagina_actual"]."&accion=mostrar");
   if($_SESSION["tipo_pagina"]!="pagina")
   {
    $ruta=strtolower($_REQUEST["plantilla"])."/mostrar_".strtolower($_REQUEST["plantilla"]).".php?tipo=1&iddoc=$llave";
    redirecciona("comentario_mostrar.php?enlace=" . FORMATOS_CLIENTE . "$ruta&id=$llave");
  }
   else
     redirecciona("comentario_mostrar.php?key=".$llave."&pag=".$_SESSION["pagina_actual"]."&accion=mostrar");
}

//se muestra el div con el formulario para adicionar un nuevo comentario a la pagina.
if (isset($_GET["accion"]) && $_GET["accion"]=="adicionar")
{
 if($pag=="" OR $pag==Null)
 {
  echo "<script language=\"javascript\">";
  echo "alert(\"El documento no tiene paginas para adicionar un comentario, Por favor adicione una pagina\");";
	echo "window.open('ordenar.php?key=".$llave."&accion=mostrar','_self');";
  echo "</script>";
 }
 else
 { $doc = busca_filtro_tabla("*", "pagina","id_documento=".$llave,"",$conn);
   $accion = "add";
   $permisos =true;
   if($doc["numcampos"]>0 OR $tipo_pag=="PLANTILLA")
   {
     if($tipo_pag =="PAGINA")
      $pag=$_SESSION["pagina_actual"];

	 $recuadro_postit='
	    <div id="adicionar">
	    <form action="comentario_img.php" method="post" name="adicionar_nota" id="adicionar_nota">
	    <input type="hidden" name="adicion" value="A">
	    <input type="hidden" name="key" value='.$llave.'>
	    <input type="hidden" name="tipo" value='.$tipo_pag.'>
	    <input type="hidden" name="pag" value='.$pag.'>
	    <textarea  class="estilotextarea" id="x_comentario" name="x_comentario" onkeypress="return no_enter(event)"></textarea><br />
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  value="Adicionar">
	    </form>
	    </div>
		<script>
			$( "#adicionar" ).hide();
			$( "#adicionar_nota" ).submit();
		</script>
	 ';


	 $valida_formato_pdf=busca_filtro_tabla("", "documento a, formato b","lower(a.plantilla)=b.nombre  and a.iddocumento=".$llave,"",$conn);


	 if($valida_formato_pdf[0]['mostrar_pdf']==1){
		include_once("librerias_saia.php");
		echo(librerias_notificaciones());
		?>
		<script>
		notificacion_saia('No es posible adicionar Notas a documentos en PDF','warning','',4000);
		</script>
		<?php
		abrir_url('pantallas/documento/visor_documento.php?iddoc='.$llave,'_self');
		die();
	 }else{
	 	echo($recuadro_postit);
	 }

   }
 }
}
?>
<script type="text/javascript" src="js/wz_dragdrop.js"></script>
<?php $detalle_doc = busca_filtro_tabla("numero,descripcion,plantilla","documento","iddocumento=$llave","",$conn);

$plantilla = $detalle_doc[0]["plantilla"];
?>
<div id="tool" style="display:none">
<span class="phpmaker" margin-top="0">DOCUMENTO:&nbsp;
<?php echo $detalle_doc[0]["numero"]." - ".str_replace(chr(10), "<br>", stripslashes($detalle_doc[0]["descripcion"]));?>
</span>
<hr>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
 <td align="center">
   <a href="javascript:void(0)"; onclick="imprimir(<?php echo $llave;?>)" target="_self"><img src="enlaces/imprimir.gif" border="0" ALT="Imprimir documento"></a>
   <a href="javascript:void(0)"; onclick="imprimir_sin(<?php echo $llave;?>)" target="_self"><img src="enlaces/imprimir.gif" border="0" ALT="Imprimir documento sin comentarios"></a>
 </td>
 <td align="center">
   <a href="comentario_mostrar.php?rotar=izq" target="<?php echo $frame?>"><img src="botones/comentarios/rotar_derecha.gif" alt="Girar a la derecha" border="0"></a>&nbsp
   <a href="comentario_mostrar.php?rotar=derecha" target="<?php echo $frame?>"><img src="botones/comentarios/rotar_izquierda.gif" alt="Girar a la izquierda" border="0"></a>&nbsp
  </td>
  <td align="center">
   <a href="#ancla" onclick="zoom('-','prueba',92/66)"><img src="botones/comentarios/lupa-.gif" border="0" alt="Alejar"></a>
   <a name="ancla">
   <a href="#ancla" onclick="zoom('+','prueba',92/66)"><img src="botones/comentarios/lupa+.gif" border="0" alt="Acercar"></a>
  </td><td align="center"><br>
     <?php
     agrega_boton("images","images/eliminar_pagina.gif","paginadelete.php","$frame","","","eliminar_pagina");
     ?>
     </td>
     <td align="center" valign="middle" width="40%"></td>
  <td align="center" valign="middle">
   <a href="comentario_mostrar.php?pagina=inicio" target="_self"><img src="imagenes/principio.gif" alt="Primera P&aacute;gina" border="0"></a>
   <a href="comentario_mostrar.php?pagina=ant" target="_self"><img src="imagenes/atras.gif" alt="P&aacute;gina anterior" border="0"></a>&nbsp;
   <?php
   $pagina_navegador = busca_filtro_tabla("consecutivo","pagina","id_documento=".$llave,"pagina",$conn);
   $paginas=0;
   $paginas=$pagina_navegador["numcampos"];
   $select_pag= "<select id=\"idpagina\" onchange=\"pagina(".$llave.",idpagina.value);\">";
   $select_pag.="<option value='0'>..</option>";
   for($i=0; $i<$paginas; $i++)
   {
     $select_pag.="<option value=\"".$paginas_doc[$i]["consecutivo"]."\"";
     if($paginas_doc[$i]["consecutivo"]==$pag)
       $select_pag.=" selected ";
     $select_pag.= ">".($i+1)."</option>";  ;
   }
   echo $select_pag."</select>";
   ?>
   <a href="comentario_mostrar.php?pagina=sig" target="_self"><img src="imagenes/adelante.gif" alt="Siguiente P&aacute;gina" border="0"></a>
   <a href="comentario_mostrar.php?pagina=fin" target="_self"><img src="imagenes/final.gif" alt="&Uacute;ltima P&aacute;gina" border="0"></a>&nbsp;
   </td>
</tr>
</table><hr>
</div>

<?php

if($enlace!="")  //si no se trata de una pagina sino de un formato se crea un frame con el formato
{ //error($enlace);
 ?>
 <iframe name="formato" style="position:relative; left:10px; top:-10;" id="iframe_documento" name="iframe_documento" height="1200" width="100%" scrolling="no" frameborder="no" src="<?php echo $enlace; ?>" allowtransparency="yes" onload="ocultar_enlaces();" class="alto_frame"></iframe>
 <?php
}
else  //se muestra la pagina actual con sus comentarios
{
 $listado=busca_filtro_tabla("A.*","pagina A","id_documento=".$llave." AND consecutivo=".$pag,"pagina",$conn);
}


if($listado["numcampos"]>0 || $tipo_pag != "PAGINA")  //Se muestarn la pagna o el formato con los comentarios.
{
  if($tipo_pag=="PAGINA")
  {
    $ruta=$listado[0]["ruta"];
    ?>
    <div class="ppal"><br><br>
    <div align="center" ><img src="<?php echo $ruta; ?>"><div id='otro'> </div></div><br><br>
    <?php
  }
  $componentes="";
  if($accion!="add")
  {
    $comentario=busca_filtro_tabla("A.*","comentario_img A","documento_iddocumento=".$llave." AND tipo='$tipo_pag' AND pagina=".$pag,"",$conn);
    if($comentario["numcampos"]>0)
    {echo '<div id="notas" style="display:block;">';
      $permisos =false;
      for($i=0; $i<$comentario["numcampos"]; $i++)
      {
         $posx=$comentario[$i]["posx"];
         $posy=$comentario[$i]["posy"];
         $texto=$comentario[$i]["comentario"];
         $id = $comentario[$i]["idcomentario_img"];

         //Se validan los permisos del usuario
         $permiso = busca_filtro_tabla("idcomentario_img,funcionario","comentario_img","idcomentario_img=$id AND funcionario='".$usuactual."'","",$conn);
         if($permiso["numcampos"]>0)
         {
           $permisos =true;
           ?>
           <div  id="d<?php echo $id; ?>" style="position:absolute; top:<?php echo $posy; ?>px; left:<?php echo $posx; ?>px" onclick="posicion(dd.elements.d<?php echo $id; ?>.x,dd.elements.d<?php echo $id; ?>.y,<?php echo $id.",".$llave.",".$pag; ?>)">
           <table border="0" cellspacing="0" cellpadding="0"><tr>
           <td colspan="2" style="background-color:#ffff99;"><img src="imagenes/cabecera.gif"></td>
           <tr><td colspan="2" style="background-color:#ffff99;">&nbsp;
           <textarea class="estilotextarea" id="<?php echo "x_comentario".$id?>" name="x_comentario"><?php echo $texto; ?></textarea>&nbsp;</td></tr>
           <input type="hidden" name="editar" value="A">
           <input type="hidden" name="key" value=<?php echo $llave; ?>>
           <tr><td style="background-color:#ffff99;" align="right">
           <input type="image" name="editar" src="images/editar_nota.gif" alt="Guardar cambios" onclick="enlace(<?php echo $id.",".$llave;?>)">
           <input type="image" name="eliminar" src="images/eliminar_nota.gif" alt="Eliminar comentario" onclick="<?php echo codifica_encabezado("javascript:if(confirm('Esta seguro de eliminar el comentario?'))parent.$frame.location ='comentario_img.php?eliminar=e&id=$id&key=$llave&plantilla=$plantilla';return false;");?>"></td></tr>
           </table>
           </div>



           <?php
           $componentes.="'d".$id."',";
         }
         else
         {
          ?>
  <div id="bubble_tooltip">
	<div class="bubble_top"></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content"></span></div>
	<div class="bubble_bottom"></div>
</div>
           <!--table width="28px" height="35px" style="position:absolute; top:<?php echo ($posy-2); ?>px; left:<?php echo ($posx-2); ?>px">
           <tr><td align="center" class="tooltip_text" href="#" onmousemove="showToolTip(event,'<?php echo $texto."<br><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Autor:".$comentario[$i]["funcionario"];?>'); return false" onmouseout="hideToolTip()" align="center" background="images/mostrar_nota.gif"><?php echo ($i+1);?></td></tr>
           </table-->
           <table class="tooltip_text" href="#" onmousemove="showToolTip(event,'<?php echo trim($texto); ?>','<?php echo ($posy); ?>'); return false" onmouseout="hideToolTip()" width="20px" height="20px" style="position:absolute; top:<?php echo ($posy+115); ?>px; left:<?php echo ($posx+25); ?>px">
       <tr><td  align="center" background="images/mostrar_nota.png"><?php echo ($i+1);?></td></tr>
       </table>
           <?php
         }
         $nombre_usuario_nota = busca_filtro_tabla("nombres, apellidos","funcionario","login='".$comentario[$i]["funcionario"]."'","",$conn);
         echo "<span class='phpmaker'>".($i+1).": ".$texto."&nbsp;&nbsp;&nbsp;&nbsp; Autor: ".$nombre_usuario_nota[0]["nombres"]." ".$nombre_usuario_nota[0]["apellidos"]."<br></span>";
      } // fin de for de los comentarios
       echo '</div>';
    } // fin de if(comentarios["numcampos"])
    else{
    	abrir_url("ordenar.php?key=".$llave."&accion=mostrar&mostrar_formato=1","_parent");
    }
  } //Fin de muestra los comentarios de la pagina si no es la accion de adicionar
  echo("<script type=\"text/javascript\">");
  echo("SET_DHTML(CURSOR_MOVE,".$componentes." \"anotherLayer\", \"lastImage\");");
  echo("function IMG1_onclick() {}");
  echo("</script>");
}
 else
  echo "<span class='phpmaker'><center>El documento no tiene p&aacute;gina</center></span>";

if($permisos == false)
 {
  alerta("<b>ATENCI&Oacute;N</b><br>No tiene permisos para editar los comentarios, pero puede adicionar uno nuevo","warning");
 }
?>
</div>
<?php include("footer.php");?>

</html>
