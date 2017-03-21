<?php 
 /* if(!isset($_SESSION))
       session_start();*/
  include_once("db.php");
  include_once("librerias_saia.php");

require_once('StorageUtils.php');
  require_once('filesystem/SaiaStorage.php');
  require('vendor/autoload.php');  

include_once("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("iddoc","key","doc");
desencriptar_sqli('form_info');
echo(librerias_jquery());
 
echo(estilo_bootstrap());   
  
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["iddoc"];
	if( @$_REQUEST["key"]){
	    	$_REQUEST["iddoc"]=$_REQUEST["key"];
	}
	
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento(@$_REQUEST["iddoc"],1));
}  
 /* header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", true); 
  header("Pragma: no-cache"); // HTTP/1.0 */
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">     
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
       -->
       </style>";
  echo $style; 
  }
?>
<style type="text/css">
	.phpmaker{
    font-family: Verdana; 
       font-size: 9px;
   }
	body{		
		height:100%;
		width:100%;
		margin:10px;
		padding-left:0px;
	}
	
	form{
		display:inline;
	}
	.imageBox,.imageBoxHighlighted{
		width:130px;	/* Total width of each image box */
		height:160px;	/* Total height of each image box */
		float:left;
	}
	.imageBox_theImage{
		width:110px;	/* Width of image */
		height:125px;	/* Height of image */
		
		/* 
		Don't change these values *
		*/
		background-position: center center;
		background-repeat: no-repeat;		
		margin: 0 auto;
		margin-bottom:2px;
	}
	
	.imageBox .imageBox_theImage{
		border:1px solid #DDD;	/* Border color for not selected images */
		padding:2px;
	}
	.imageBoxHighlighted .imageBox_theImage{
		border:3px solid #316AC5;	/* Border color for selected image */
		padding:0px;

	}
	.imageBoxHighlighted span{	/* Title of selected image */
		background-color: #316AC5;
		color:#FFFFFF;
		padding:2px;
	}
	
	.imageBox_label{	/* Title of images - both selected and not selected */
		text-align:center;
		font-family: arial;
		font-size:9px;		
		padding-top:2px;
		margin: 0 auto;
	}
	
	/* 
	DIV that indicates where the dragged image will be placed	
	*/
	#insertionMarker{
		height:150px;
		width:6px;
		position:absolute;
		display:none;
		

	}
	
	#insertionMarkerLine{
		width:6px;	/* No need to change this value */
		height:145px;	/* To adjust the height of the div that indicates where the dragged image will be dropped */
		
	}
		
	#insertionMarker img{
		float:left;
	}
	
	/*
	DIV that shows the image as you drag it 
	*/
	#dragDropContent{

		opacity:0.4;	/* 40 % opacity */
		filter:alpha(opacity=40);	/* 40 % opacity */

		/* 
		No need to change these three values 
		*/
		position:absolute;
		z-index:10;
		display:none;

			
	}
/*
<Clase>
<Nombre>imagen_seleccionada
<Parametros>tipo-tipo de imagen;doc-id del documento relacionado;
pag-nombre de la pagina que se desea visualizar si es una imagen o enlace al mostrar de la plantilla en 
en caso contrario;id-tipo de plantilla
<Responsabilidades>cuando se hace clic sobre la miniatura redirecciona la pagina a donde sea
necesario segun el tipo de imagen que se desea ver
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/	

	</style>
<script type="text/javascript">

	function imagen_seleccionada(tipo,doc,pag,id)
	{	
	if(tipo=='PAGINA')
	 window.open("comentario_mostrar.php?key="+doc+"&pag="+pag,"_self");
  else
   if(doc=='plantilla')
     window.open("comentario_mostrar.php?iddoc="+id+"&id="+id+"&enlace="+pag,"_self");
    else if(tipo=='PAGINA_REGISTRO')
     window.open("comentario_mostrar.php?tipo=registro&key="+doc+"&pag="+pag,"_self");
     
  }
  </script>	
<script type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, September 2005	
  Funciones que permiten visualizar las paginas de documento en miniatura y al dar click se tendra la imagen en tama�o real, tambien permite cambiar el orden de las paginas del un documento. 
	************************************************************************************************************/	
	var operaBrowser = false;
	if(navigator.userAgent.indexOf('Opera')>=0)operaBrowser=1;
	var MSIE = navigator.userAgent.indexOf('MSIE')>=0?true:false;
	var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g,'$1')/1;
/*
<Clase>
<Nombre>cancelEvent
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function cancelEvent()
	{
		return false;
	}
	var activeImage = false;
	var readyToMove = false;
	var moveTimer = -1;
	var dragDropDiv;
	var insertionMarker;
	
	var offsetX_marker = -3;	// offset X - element that indicates destinaton of drop
	var offsetY_marker = 0;	// offset Y - element that indicates destinaton of drop
	
	var firefoxOffsetX_marker = -3;
	var firefoxOffsetY_marker = -2;
	
	if(navigatorVersion<6 && MSIE){	/* IE 5.5 fix */
		offsetX_marker-=23;
		offsetY_marker-=10;		
	}
	
	var destinationObject = false;
	
	var divXPositions = new Array();
	var divYPositions = new Array();
	var divWidth = new Array();
	var divHeight = new Array();
		
	var tmpLeft = 0;
	var tmpTop = 0;
	
	var eventDiff_x = 0;
	var eventDiff_y = 0;
/*
<Clase>
<Nombre>getTopPos
<Parametros>inputObj
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/	
	function getTopPos(inputObj)
	{		
	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null){	   
	  	if(inputObj.tagName!='HTML'){
	  		returnValue += (inputObj.offsetTop - inputObj.scrollTop);
	  		if(document.all)returnValue+=inputObj.clientTop;
	  	}
	  } 
	  return returnValue;
	}
/*
<Clase>
<Nombre>getLeftPos
<Parametros>inputObj
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function getLeftPos(inputObj)
	{	  
	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null){
	  	if(inputObj.tagName!='HTML'){
	  		returnValue += inputObj.offsetLeft;
	  		if(document.all)returnValue+=inputObj.clientLeft;
	  	}
	  }
	  return returnValue;
	}
/*
<Clase>
<Nombre>selectImage
<Parametros>e
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/			
	function selectImage(e)
	{
		if(document.all && !operaBrowser)e = event;
		var obj = this.parentNode;
		if(activeImage)activeImage.className='imageBox';
		obj.className = 'imageBoxHighlighted';
		activeImage = obj;
		readyToMove = true;
		moveTimer=0;
		
		tmpLeft = e.clientX + Math.max(document.body.scrollLeft,document.documentElement.scrollLeft);
		tmpTop = e.clientY + Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		
		startMoveTimer();	
		
		
		return false;	
	}
/*
<Clase>
<Nombre>startMoveTimer
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function startMoveTimer(){
		if(moveTimer>=0 && moveTimer<10){
			moveTimer++;
			setTimeout('startMoveTimer()',15);
		}
		if(moveTimer==10){
			getDivCoordinates();
			var subElements = dragDropDiv.getElementsByTagName('DIV');
			if(subElements.length>0){
				dragDropDiv.removeChild(subElements[0]);
			}
		
			dragDropDiv.style.display='block';
			var newDiv = activeImage.cloneNode(true);
			newDiv.className='imageBox';	
			newDiv.id='';
			dragDropDiv.appendChild(newDiv);	
			
			dragDropDiv.style.top = tmpTop + 'px';
			dragDropDiv.style.left = tmpLeft + 'px';
							
		}
		return false;
	}
/*
<Clase>
<Nombre>dragDropEnd
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function dragDropEnd()
	{
		readyToMove = false;
		moveTimer = -1;

		dragDropDiv.style.display='none';
		insertionMarker.style.display='none';
		
		if(destinationObject && destinationObject!=activeImage){
			var parentObj = destinationObject.parentNode;
			parentObj.insertBefore(activeImage,destinationObject);
			activeImage.className='imageBox';
			activeImage = false;
			destinationObject=false;
			getDivCoordinates();
		}
		return false;
	}
/*
<Clase>
<Nombre>dragDropMove
<Parametros>e
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function dragDropMove(e)
	{ //alert("a qui");
		if(moveTimer==-1)return;
		if(document.all && !operaBrowser)e = event;
		var leftPos = e.clientX + document.documentElement.scrollLeft - eventDiff_x;
		var topPos = e.clientY + document.documentElement.scrollTop - eventDiff_y;
		dragDropDiv.style.top = topPos + 'px';
		dragDropDiv.style.left = leftPos + 'px';
		
		leftPos = leftPos + eventDiff_x;
		topPos = topPos + eventDiff_y;
		
		if(e.button!=1 && document.all &&  !operaBrowser)dragDropEnd();
		var elementFound = false;
		for(var prop in divXPositions){
			if(divXPositions[prop]/1 < leftPos/1 && (divXPositions[prop]/1 + divWidth[prop]*0.7)>leftPos/1 && divYPositions[prop]/1<topPos/1 && (divYPositions[prop]/1 + divWidth[prop])>topPos/1){
				
				if(document.all ){
					offsetX = offsetX_marker;
					offsetY = offsetY_marker;
				}else{
					offsetX = firefoxOffsetX_marker;
					offsetY = firefoxOffsetY_marker;
				}
				insertionMarker.style.top = divYPositions[prop] - offsetY + 'px';
				insertionMarker.style.left = divXPositions[prop] + offsetX + 'px';
				insertionMarker.style.display='block';	
				destinationObject = document.getElementById(prop);
				elementFound = true;	
				break;	
			}				
		}		
		if(!elementFound){
			insertionMarker.style.display='none';
			destinationObject = false;
		}
		
		return false;
		
	}	
/*
<Clase>
<Nombre>getDivCoordinates
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function getDivCoordinates()
	{ 
		var divs = document.getElementsByTagName('DIV');
		for(var no=0;no<divs.length;no++){	
			if(divs[no].className=='imageBox' || divs[no].className=='imageBoxHighlighted' && divs[no].id){
				divXPositions[divs[no].id] = getLeftPos(divs[no]);			
				divYPositions[divs[no].id] = getTopPos(divs[no]);			
				divWidth[divs[no].id] = divs[no].offsetWidth;			
				divHeight[divs[no].id] = divs[no].offsetHeight;			
			}		
		}
	}
/*
<Clase>
<Nombre>saveImageOrder
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function saveImageOrder()
	{		
    var orderString = "";
		var objects = document.getElementsByTagName('DIV');
		for(var no=0;no<objects.length;no++){
			if(objects[no].className=='imageBox' || objects[no].className=='imageBoxHighlighted'){
				if(orderString.length>0)orderString = orderString + ',';
				orderString = orderString + objects[no].id;
			}			
		}		
		document.ordenar.orden.value=orderString;	
	}
/*
<Clase>
<Nombre>initGallery
<Parametros>
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	function initGallery()
	{
		var divs = document.getElementsByTagName('DIV');
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='imageBox_theImage' || divs[no].className=='imageBox_label'){
				divs[no].onmousedown = selectImage;	
			}
		}		
		var insObj = document.getElementById('insertionMarker');
		var images = insObj.getElementsByTagName('IMG');
		document.body.onselectstart = cancelEvent;
		document.body.ondragstart = cancelEvent;
		document.body.onmouseup = dragDropEnd;
		document.body.onmousemove = dragDropMove;		
		window.onresize = getDivCoordinates;		
		dragDropDiv = document.getElementById('dragDropContent');
		insertionMarker = document.getElementById('insertionMarker');
		getDivCoordinates();		
	}
/*
<Clase>
<Nombre>createNewTab
<Parametros>
<Responsabilidades>crea un tab nuevo con las opciones para editar los documentos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/		
	</script>
	
<?php
/*--------------------------------------------------------------------------------------------
pantalla principal donde se muestran la imagen a tama�o completo y el menu con las
opciones para manipularla
--------------------------------------------------------------------------------------------*/
if(@$_SESSION["LOGIN".LLAVE_SAIA]<>""){
 $url = $_SERVER["PHP_SELF"];
 $cambio_password = "";
$password = busca_filtro_tabla("valor","configuracion","nombre='cambio_password'","",$conn);
if($password["numcampos"] && $password[0]["valor"]==1)
 $cambio_password = "&nbsp;&nbsp;<a href='../changepwd.php'>Cambiar contrase&ntilde;a</a>";
if(strpos($url,'comentario_mostrar.php') || strpos($url,'ordenar.php') || strpos($url,'view.php'))
 $url = "'".$_SESSION["punto_retorno"]."'"; 
else
 $url = "'#' onclick='window.history.go(-1)'"; 

$sig_ant=array();
$sig_ant=documento_siguiente_anterior();
if(isset($_REQUEST["mostrar_doc"])){
  if($_REQUEST["mostrar_doc"]=="ant" && $sig_ant[0]!="")
    redirecciona("ordenar.php?accion=mostrar&key=".$sig_ant[0]."#");
  else if($_REQUEST["mostrar_doc"]=="sig" && $sig_ant[1]!="")
    redirecciona("ordenar.php?accion=mostrar&key=".$sig_ant[1]."#");
}
 
///$sig_ant[0] tiene el valor del Anterior documento en la lista
$llave="";
$orden="";
$list_orden=array();
$actualizar = "";

global $conn;
if(isset($_REQUEST["key"]))     //identificador del documento
 $llave=$_REQUEST["key"]; 
else  
  $llave = @$_SESSION["iddoc"]; 
if($llave)
  @$_SESSION["iddoc"]=$llave;  
unset($_SESSION['pagina_actual']);
?>
<div id="header">
</div>
<?php
 } 
?>
<div  align="center">
<?php
menu_ordenar($llave);
?>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<span class="internos"></span>
<?php 
if(!(isset($_GET["accion"]) && $_GET["accion"]=="mostrar"))
 {
   echo "<script type=\"text/javascript\">	window.onload = initGallery; </script>";
 }
$llave="";
$orden="";
$list_orden=array();
$actualizar = "";
  
global $conn;
if(isset($_REQUEST["key"]))     //identificador del documento
 $llave=$_REQUEST["key"]; 
else  
  $llave = @$_SESSION["iddoc"]; 
if($llave)
  @$_SESSION["iddoc"]=$llave; 
//datos del documento
if(isset($_REQUEST["tipo"]))     //identificador del documento
 $tipo=$_REQUEST["tipo"]; 
else if(isset($_SESSION["tipo_doc"]))
  $tipo = $_SESSION["tipo_doc"];
else $tipo="";  
 $codigo=usuario_actual("funcionario_codigo");
 leido($codigo,$llave);
 $mostrar = "DOCUMENTO:";   
//die($llave);  
if($tipo=="registro")
  {$detalle_doc = busca_filtro_tabla("codigo as numero,titulo as descripcion,tipo_documental_idtipo_documental as serie","archivo","idarchivo=".$llave,"",$conn);
    //print_r($detalle_doc);
    //echo($sql);
   $mostrar= "REGISTRO:";
  }
else
$detalle_doc = busca_filtro_tabla("numero,descripcion,serie,plantilla,pdf,estado","documento","iddocumento=".$llave,"",$conn);
//imprime en pantalla la descripcion del documento y numero de radicado
?> 
<span class="phpmaker">DOCUMENTO:&nbsp; 
<?php echo $detalle_doc[0]["numero"]." - ".str_replace(chr(10), "<br>", stripslashes($detalle_doc[0]["descripcion"]));
if($detalle_doc[0]["estado"]=="ANULADO")
  echo "<font color='red'> (ANULADO)</font>";
  if(isset($detalle_doc[0]["plantilla"]))
    $plantilla = $detalle_doc[0]["plantilla"];
  else $plantilla="";    
  $serie = $detalle_doc[0]["serie"];
?>
</span>
<hr>

<?php
if($plantilla<>"")
    {$tabla=busca_filtro_tabla("tabla_imagenes","plantillas","plantilla='".strtolower($plantilla)."'","",$conn);
     if($tabla["numcampos"] && $tabla[0]["tabla_imagenes"]<>"")
        $tabla_imagenes=$tabla[0]["tabla_imagenes"];
     else
        $tabla_imagenes="pagina";   
    }
else
   $tabla_imagenes="pagina";

if(isset($_POST["orden"]))   //solo es posible para los usuarios que tienen permiso de ordenar paginas.
 {
  $orden = $_POST["orden"];  //string con el orden de las paginas  
  $list_orden = split(",",$orden);  
  for($i=0; $i<count($list_orden)-1; $i++)
  { 
    $actualizar = "update $tabla_imagenes A set pagina='".($i+1)."' where consecutivo = ".$list_orden[$i];            
    phpmkr_query($actualizar,$conn);    
  }  
 redirecciona("ordenar.php?key=".$llave."&accion=mostrar");        
 }
else
 {
  $codigo="";
  $listado = busca_filtro_tabla("A.*","pagina A","A.id_documento=".$llave,"A.pagina",$conn);  //busca las paginas del documento  
	if ($listado["numcampos"] > 0) {
		for($i = 0; $i < $listado["numcampos"]; $i++) { // muestra las miniaturas de las paginas del documento
			$var = md5(time()); // para evitar el cache
			//$arr_alm = StorageUtils::resolver_ruta($listado[$i]["imagen"]);
			$contenido_imagen = StorageUtils::get_binary_file($listado[$i]["imagen"]);
      $codigo.= "<div class=\"imageBox\" id=\"".$listado[$i]["consecutivo"]."\">";
			$codigo .= "<div class=\"imageBox_theImage\" style=\"background-image:url('" . $contenido_imagen . "')\" onclick=\"imagen_seleccionada('PAGINA'," . $llave . "," . $listado[$i]["consecutivo"] . ",'');\"></div>";
      $codigo.="<div class=\"imageBox_label\"><span>P&aacute;gina ".$listado[$i]["pagina"]."</span></div></div>";
    }        
  }
  else
   $codigo="<span class=\"imageBox_label\"><center><label style='font-family: Verdana;font-size: 9px;'><b>El documento no tiene p&aacute;ginas digitalizadas.</b></center></span>";
  echo "<div class='container'>".$codigo."</div><br><br><br><br><br><br><br>";
  //muestra los formatos que esta relacionado con el documento    
$destino='targee="centro"';
  if($plantilla<>"")  
   {
   $destino='target="_parent"';
   $etiqueta = busca_filtro_tabla("etiqueta,idformato","formato","lower(nombre)='".strtolower($plantilla)."'","",$conn);
   if($etiqueta["numcampos"]>0)
   { $nombre_plantilla = $etiqueta[0]["etiqueta"];
   }
   else
    $nombre_plantilla = $plantilla;
   }
    $tipo_documento = busca_filtro_tabla("A.serie","documento A","A.iddocumento=".$llave,"",$conn);
    $serie = busca_filtro_tabla("","serie","idserie=".$tipo_documento[0]["serie"],"",$conn);
    $tabla=@$serie[0]["nombre"];    
    $serie = strtolower($tabla);            
  ?>
  <div class="container">   

  <!-- el div es parte del codigo que muestra las miniaturas -->
  <div id="insertionMarker">
  	<img src="images/marker_top.gif">
  	<img src="images/marker_middle.gif" id="insertionMarkerLine">
  	<img src="images/marker_bottom.gif">
  </div>
  
  <div id="dragDropContent"></div>
  <div id="debug" style="clear:both"></div>
  <div style="clear:both;padding-bottom:10px">

  	
  	
  <?php
  /*------------------------------------------------------------------------------------
  crea la lista con las respuestas del documento y los enlaces para visualizarlas
  ------------------------------------------------------------------------------------*/
  
  /*
  
  $respuestas=busca_filtro_tabla("B.numero,B.descripcion,A.destino,A.plantilla","respuesta A,documento B","B.iddocumento=A.destino and B.estado in ('APROBADO','CENTRAL','HISTORICO','GESTION') and A.origen=".$llave,"", $conn);
  $ruta = "";
  if($respuestas["numcampos"]>0)
    {
     echo "<br /><center><label style='font-family: Verdana;font-size: 9px;'>Documentos asociados como Respuesta</label></center>";
     echo "<table border=0 cellspacing=2 align=center>
           <tr class='encabezado_list' align=center style='font-family: Verdana; font-size: 9px; color:#ffffff' bgcolor='#000066'>
           <td width='70px'>N&Uacute;MERO</td><td width='200px'>DESCRIPCI&Oacute;N</td>
           <td width='100px'>TIPO</td><td width='70px'>RESPUESTA</td></tr>";
     
     for($i=0;$i<$respuestas["numcampos"];$i++)
        { //http://192.168.2.51/saia1.06/ordenar.php?accion=mostrar&mostrar_formato=1&key=282  
         $ruta="ordenar.php?accion=mostrar&mostrar_formato=1&key=".$respuestas[$i]["destino"];        
         echo "<tr bgcolor='#CCCCCC' style='font-family: Verdana;font-size: 9px;'><td align=center>".$respuestas[$i]["numero"]."</td>
               <td>".$respuestas[$i]["descripcion"]."</td><td>".$respuestas[$i]["plantilla"]."</td>
               <td align=center><a href='$ruta' ".$destino." >Ver</a></td></tr>";
        }
     echo "</table>";   
    }
  else  
    echo "<br /><center><label style='font-family: Verdana;font-size: 9px;'>
          <b>El documento no tiene respuestas asociadas.</b></label></center>";
   
   */
   
   
  /*------------------------------------------------------------------------------------
  Busca si el documento actual es una respuesta, para mostrar su documento asociado
  ------------------------------------------------------------------------------------*/

  /*  
  
  global $conn;        
  $respuestas=busca_filtro_tabla("B.iddocumento,B.numero,B.descripcion","respuesta A,documento B","B.iddocumento=A.origen and A.destino=".$llave,"",$conn); 
    if($respuestas["numcampos"]>0)
    {
     echo "<br /><center><label style='font-family: Verdana;font-size: 9px;'>Documento Original al que pertenece la respuesta</label></center>";
     echo "<table border=0 cellspacing=2 align=center>
           <tr class='encabezado_list' align=center style='font-family: Verdana; font-size: 9px; color:#ffffff' bgcolor='#000066'>
           <td width='70px'>N&Uacute;MERO</td><td width='200px'>DESCRIPCI&Oacute;N</td>
           <td width='70px'>Documento</td></tr>";
     for($i=0; $i<$respuestas["numcampos"]; $i++)
        {
        $ruta="ordenar.php?accion=mostrar&mostrar_formato=1&key=".$respuestas[$i]["iddocumento"];
        echo "<tr bgcolor='#CCCCCC' style='font-family: Verdana;font-size: 9px;'><td align=center>".$respuestas[$i]["numero"]."</td>
               <td>".$respuestas[$i]["descripcion"]."</td>
               <td align=center><a href='".$ruta."' ".$destino.">Ver</a></td>
               </tr>";
        }
      echo "</table>";   
    }

   */   
    
/*	 
//si tiene anexos imprimo un texto con la cantidad
$anexos=busca_filtro_tabla("count(*)","anexos","documento_iddocumento=".$llave,"",$conn); 
if($anexos[0][0]>0)
  echo "<br /><center><b>El documento tiene <a href='anexosdigitales/anexos_documento.php?key=$llave&no_menu=1&iddoc=$llave'>".$anexos[0][0]." anexos digitales</a></b></center>";
else
  echo "<br /><center><b>El documento no tiene anexos digitales</b></center>";     
  
*/  
         
  ?>  
 
  <form id="ordenar" name="ordenar" action="ordenar_paginas.php" method="POST">
    <input type="hidden" name="key" value="<?php echo $llave;?>">
    <input type="hidden" name="orden">
    <?php    
    if(isset($_GET["accion"]))  
     $accion = substr(@$_GET["accion"],0,7);     
     if(!(isset($_GET["accion"]) && $accion =="mostrar") && $listado["numcampos"]>0)
     {
    ?> 
    	 <input type="button" class="btn btn-mini btn-danger" value="Cancelar" onclick="window.history.back(-1);">
    	<input type="submit" class="btn btn-mini btn-primary" value="Guardar orden" onclick="saveImageOrder()">
    <?php 
     }
    ?>
    <br />
    <!--center><label style='font-family: Verdana;font-size: 9px;'>Adjuntar Anexos</label></center>
  <div align=center>
  <iframe src="upload.php?iddoc=<?php echo $llave; if($plantilla=="CALIDAD") echo("&calidad=1"); ?>" width="450" height="90" frameborder=0 scrolling="no" marginwidth=0>
  </iframe> 
  </div>  	
  <iframe name='listar_archivos' id='listar_archivos' src="listar_anexos.php?iddoc=<?php echo $llave;if($plantilla=="CALIDAD") echo("&calidad=1");?>" width="100%" height="100%" frameborder=0 scrolling="no" marginwidth=0>
  </iframe-->
  </form>
  </div>
  </div>
  
<?php
 }
function documento_siguiente_anterior(){
 $siguiente="";
 $anterior="";
  if(isset($_SESSION["ldocs"])&& isset($_SESSION["iddoc"])){
    if(is_array($_SESSION["ldocs"]))
     $ldocs=$_SESSION["ldocs"];
    else 
    $ldocs=explode(",",$_SESSION["ldocs"]);
    $actual=array_search($_SESSION["iddoc"],$ldocs);
    if($actual!==FALSE){
      if(isset($ldocs[$actual+1])){
        $siguiente=$ldocs[$actual+1];
      }
      else $siguiente="";
      if(isset($ldocs[$actual-1])){
        $anterior=$ldocs[$actual-1];
      }
      else $anterior="";
    }
    else {
      $siguiente="";
      $anterior="";
    }
  }
else  
  $_SESSION["ldocs"]="";//alerta("Su sesion ha Expirado");
return(array($siguiente,$anterior));  
}
encriptar_sqli("ordenar",1);
?>  
</body>
</html>
