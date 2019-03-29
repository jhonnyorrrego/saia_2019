<?php
/*
<Archivo>
<Nombre>compartir_documentos.php</Nombre> 
<Parametros>$_REQUEST["funcionario"],$_REQUEST["idfun"]:identificador del funcionario, $_REQUEST["accion"]: define la accion que se va a realizar, </Parametros>
<ruta>saia1.06/compartir_documentos.php</ruta>
<Responsabilidades>Se encarga de administrar el proceso de que un funcionario puede ver los documentos de las bandejas pendientes y procesos de otros funcionarios.<Responsabilidades>
<Notas></Notas>
<Salida>Formulario de adicionar permisos para un funcionario y de inactivar</Salida>
</Archivo>
*/
include_once("db.php");
include_once("calendario/calendario.php");
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
       padding:1px; 
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
       .imagen_internos {vertical-align:middle} 
       .internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
       </style>";
  echo $style;
  }
?>
<script type="text/javascript"> 
//funcion de ajax para actualizar la posicion del comentario en la imagen.
  function ver_detalle(idmodulo,func)
  {   
   var param="modulo="+idmodulo+"&detalle="+func;
   if(idmodulo=='editar')
    llamado("compartir_documentos.php?accion=editar","detalle",param);          
   else   
    llamado("compartir_documentos.php?accion=detalle","detalle",param);
  }
 
  function llamado(url, id_contenedor,parametros)
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

function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;      
      //alert("comentarios.php?key="+doc+"&pag="+pag);
    //parent.centroimg.location="comentario_mostrar.php?key="+doc+"&pag="+pag;  
  }

function EW_checkMyForm(EW_this) 
{ 
  var list_funcionarios = tree2.getAllChecked();      
  var funcionarios = list_funcionarios.split(",");
  var func ="";   
  for(i=0; i<funcionarios.length; i++)
  { if(funcionarios[i]!="" && funcionarios[i].indexOf("#")==-1)     
     { 
      if(func=="")  
        func = funcionarios[i];
      else
        func += ","+funcionarios[i];
     }        
  }   
  EW_this.x_funcionario_destino.value=func;   
   if(EW_this.x_funcionario_destino && EW_this.x_funcionario_destino.value == "")
   { alert("Por favor ingresar un funcionario para asignar el permiso");
    return false;
   }	
return true;
}
</script>
<?php

if(isset($_REQUEST["funcionario"]) && $_REQUEST["funcionario"]!="")
 almacenar();
 
if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="detalle")
 detalle(); 
else{
}
if(isset($_REQUEST["editar"]) && $_REQUEST["editar"]!="")
 guardar_cambios(); 

//print_r($_REQUEST);
if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="mostrar")
  mostrar_jerarquia($_REQUEST["idfun"]);
  
if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="adicionar")
 adicionar_permiso($_REQUEST["idfun"]);  

if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="editar")
 editar($_REQUEST["detalle"]);  
 
if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="mostrar_todo")
 mostrar_todo();  

if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="mover_documentos_adicionar")
 mover_documentos_adicionar($_REQUEST["idfun"]);

if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="mover_documentos_accion")
 mover_documentos_accion();
 
if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="ver_documentos_adicionar")
 ver_documentos_adicionar($_REQUEST["idfun"]);

if(isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="ver_documentos_accion")
 ver_documentos_accion($_REQUEST["idfun"]); 

/*
<Clase>
<Nombre>mostrar_jerarquia</Nombre> 
<Parametros>$idfun: identificador del funcionario</Parametros>
<Responsabilidades>Muestra los datos de la tabla permiso funcionario que corresponden al idfun (fecha, asignado por, vigenciena inicial y final)<Responsabilidades>
<Notas>En la funcion detalle muestra la informacion detallada de los funcionarios que se le asignaron</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_jerarquia($idfun)
{ global $conn;
  $dato = busca_filtro_tabla("permiso_funcionario.*,".fecha_db_obtener("vigencia_inicial","Y-m-d")." as vigencia_inicial,".fecha_db_obtener("vigencia_final","Y-m-d")." as vigencia_final,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","permiso_funcionario","llave_propietaria=$idfun","",$conn);    
 if($dato["numcampos"]>0)
 { echo '<table border=1><tr class="encabezado_list"><td></td><td>Fecha Creaci&oacute;n</td><td>Asignado Por:</td><td>Vigencia Inicial</td><td>Vigencia Final</td><td></td><td></td></tr>';   
   for($i=0; $i<$dato["numcampos"]; $i++)
   {
    $ejecutor = busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$dato[$i]["asignado_por"],"",$conn);
    echo '<tr><td>'.($i+1).'</td><td>'.$dato[$i]["fecha"].'</td><td>'.$ejecutor[0][0].' '.$ejecutor[0][1].'</td>
        <td>'.$dato[$i]["vigencia_inicial"].'</td><td>'.$dato[$i]["vigencia_final"].'</td>
        <td><a href="#" onclick="ver_detalle(\'detalle\',\''.$dato[$i]["llave_compartida"].'\')">Detalles</a></td>
        <td><a href="compartir_documentos.php?accion=editar&detalle='.$dato[$i][0].'">Editar</a></td></tr>';    
   }
  echo '</table><br /><br /><div id="detalle"></div>'; 
 }  
 else
  echo "<b>No tiene funcionarios asignados para compartir documentos.</b>";  
}

/*
<Clase>
<Nombre>detalle</Nombre> 
<Parametros></Parametros>
<Responsabilidades> Funcion ejecutada con AJAX, muestra la informacion de los funcionarios (rol) que fueron compartidos en cada registro en la tabla permiso_funcionario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function detalle()
{ global $conn;
 /*$usuario = busca_filtro_tabla("distinct iddependencia_cargo,nombres,apellidos,cargo.nombre as nombrec,dependencia.nombre","funcionario,dependencia_cargo,cargo,dependencia","cargo_idcargo=idcargo and iddependencia=dependencia_iddependencia and idfuncionario = funcionario_idfuncionario and idfuncionario in (".$_REQUEST["detalle"].")","",$conn);
 print_r($usuario);                                       */
  $usuario = busca_filtro_tabla("nombres,apellidos,login","funcionario","funcionario_codigo in (".$_REQUEST["detalle"].")","",$conn);

    echo '<table border=1>
     <tr class="encabezado_list"><td colspan="4" align="center">FUNCIONARIOS QUE COMPARTEN SUS DOCUMENTOS</td></tr>
     <tr class="encabezado_list"><td>Nombres</td><td>Login</td></tr>';
    for($j=0; $j<$usuario["numcampos"]; $j++)
    {
     echo '<tr><td>'.ucwords($usuario[$j]["nombres"].' '.$usuario[$j]["apellidos"]).'</td>
               <td>'.$usuario[$j]["login"].'</td>
           </tr>'; 
    }
    echo '</table><br />';
}
/*
<Clase>
<Nombre>adicionar_permiso</Nombre> 
<Parametros>$idfun=identificador del funcionario</Parametros>
<Responsabilidades>Formulario para asignar permiso para compartir documentos entre los funcionarios<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function adicionar_permiso($idfun="")
{ global $conn;
	$where='';
	if($idfun!='')$where=" and idfuncionario=".$idfun." ";
  echo "<form name='compartir' action='compartir_documentos.php' method='POST'  onSubmit='return EW_checkMyForm(this);'>
        <table>";
  $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","estado=1".$where,"nombres,apellidos",$conn);
  echo '<tr><td class="encabezado">FUNCIONARIO:</td><td>';
  echo '<select name="funcionario"><option>Seleccionar..</option>';
  for($i=0; $i<$fun["numcampos"]; $i++)
  { echo '<option value='.$fun[$i]["idfuncionario"];
    if($fun[$i]["idfuncionario"]==$idfun)
      echo ' selected';
    echo '>'.$fun[$i]["nombres"]." ".$fun[$i]["apellidos"].'</option>';     
  }
  echo '</select></td></tr>';
  echo '<tr><td class="encabezado">FUNCIONARIOS QUE COMPARTEN SUS DOCUMENTOS:</td><td>';
  ?>
  <input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino">
   <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="assets/images/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="assets/images/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="imagenes/cargando.gif"></div>
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
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.setOnLoadingStart(cargando_func);
      tree2.setOnLoadingEnd(fin_cargando_func);
			tree2.enableThreeStateCheckboxes(true);
      tree2.enableSmartXMLParsing(true);
			tree2.loadXML("test.php");
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
  <tr>
  <td class="encabezado" >VIGENCIA ENTRE      
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <input type="text" name="fecha_inicial" id="fecha_inicial" value="" size="22">
  &nbsp;  
  <?php selector_fecha("fecha_inicial","compartir","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>
  &nbsp;&nbsp;&nbsp;     
    <label >Y</label>   
  &nbsp;&nbsp;&nbsp;
  <input type="text" name="fecha_final" id="fecha_final" value="" size="22">
  &nbsp;  
  <?php selector_fecha("fecha_final","compartir","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,11,00,"PM"); ?>
  </span></td>
  </tr>   
  <tr><td colspan="2" align="center"><input type="submit" name="Aceptar" value="Aceptar"></td></tr>
 </table></form>
 <?php
  return true;
}
/*
<Clase>
<Nombre>editar</Nombre> 
<Parametros>$id=identificador del registro a editar</Parametros>
<Responsabilidades>Formulario para editar las fechas vigentes del registro en compartir documentos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function editar($id)
{ global $conn;
  $datos = busca_filtro_tabla("permiso_funcionario.*,".fecha_db_obtener("vigencia_inicial","Y-m-d")." as vigencia_inicial,".fecha_db_obtener("vigencia_final","Y-m-d")." as vigencia_final","permiso_funcionario","idpermiso_funcionario=$id","",$conn);  
   echo "<form name='compartir_edit' action='compartir_documentos.php' method='POST'>
        <table>";
  $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","idfuncionario=".$datos[0]["llave_propietaria"],"",$conn);
  echo '<tr><td class="encabezado">FUNCIONARIO:</td><td>';
  echo $fun[0][1].' '.$fun[0][2].'</td></tr>';
  echo '<tr><td class="encabezado">FUNCIONARIOS ASIGNADOS:</td><td>';
  $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","funcionario_codigo in (".$datos[0]["llave_compartida"].")","nombres,apellidos",$conn);
   echo '<ul>';
   for($i=0; $i<$fun["numcampos"]; $i++)   
    echo '<li>'.$fun[$i][1].' '.$fun[$i][2]."</li></br>";   
  echo '</ul></td></tr>';
  ?>
  <tr>
  <td class="encabezado" >VIGENCIA ENTRE      
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <input type="text" name="fecha_inicial" id="fecha_inicial" value="<?php echo $datos[0]["vigencia_inicial"] ?>" size="22">
  &nbsp;  
  <?php selector_fecha("fecha_inicial","compartir_edit","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false); ?>
  &nbsp;&nbsp;&nbsp;     
    <label >Y<br /></label>
  <input type="text" name="fecha_final" id="fecha_final" value="<?php echo $datos[0]["vigencia_final"] ?>"  size="22">
  &nbsp;  
  <?php selector_fecha("fecha_final","compartir_edit","Y-m-d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false); ?>
  </span></td>
  </tr><input type="hidden" name="editar" value="<?php echo $datos[0][0]; ?>">
  <input type="hidden" name="idfun" value="<?php echo $datos[0]["llave_propietaria"]; ?>">   
  <tr><td colspan="2" align="center"><input type="submit" name="Aceptar" value="Aceptar"></td></tr>
 </table></form> 
<?php
}
/*
<Clase>
<Nombre>almacenar</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Almacena el  registro en la tabla permiso_funcionario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Recibe los datos del formulario $_REQUEST<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function almacenar()
{ global $conn;    
  $ejecutor = usuario_actual("id");
  $nuevo = "insert into permiso_funcionario (entidad_propietaria,llave_propietaria,entidad_compartida,llave_compartida,fecha,asignado_por,vigencia_inicial,vigencia_final) VALUES (1,".$_POST["funcionario"].",1,'".$_POST["x_funcionario_destino"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",$ejecutor,".fecha_db_almacenar($_POST["fecha_inicial"],"Y-m-d H:i:s").",".fecha_db_almacenar($_POST["fecha_final"],"Y-m-d H:i:s").")";  
  phpmkr_query($nuevo,$conn);

  redirecciona("compartir_documentos.php?accion=mostrar&idfun=".$_POST["funcionario"]);
}
/*
<Clase>
<Nombre>guardar_cambios</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Actualiza el  registro en la tabla permiso_funcionario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Recibe los datos del formulario $_REQUEST<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function guardar_cambios()
{ global $conn;
  phpmkr_query("update permiso_funcionario set vigencia_inicial=".fecha_db_almacenar($_REQUEST["fecha_inicial"],"Y-m-d").",vigencia_final=".fecha_db_almacenar($_REQUEST["fecha_final"],"Y-m-d")." WHERE idpermiso_funcionario=".$_REQUEST["editar"],$conn);
  mostrar_jerarquia($_REQUEST["idfun"]);
  return true;
}
/*
<Clase>
<Nombre>mostrar_todo</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Muestra todos los datos de la tabla permiso funcionario <Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_todo()
{ global $conn;
  $dato = busca_filtro_tabla("*","permiso_funcionario","","",$conn);    
 if($dato["numcampos"]>0)
 { echo '<table border=1><tr class="encabezado_list"><td>Funcionraio Propietario</td><td>Fecha Creaci&oacute;n</td><td>Asignado Por:</td><td>Funcionario Compartidos</td><td>Vigencia Inicial</td><td>Vigencia Final</td><td></td></tr>';   
   for($i=0; $i<$dato["numcampos"]; $i++)
   {
    $ejecutor = busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$dato[$i]["asignado_por"],"",$conn);
    $prop = busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$dato[$i]["llave_propietaria"],"",$conn);
    echo '<tr><td>'.$prop[0][0].' '.$prop[0][1].'</td><td>'.$dato[$i]["fecha"].'</td><td>'.$ejecutor[0][0].' '.$ejecutor[0][1].'</td>';
    $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","funcionario_codigo in (".$dato[$i]["llave_compartida"].")","nombres,apellidos",$conn);
   echo '<td><ul>';
   for($j=0; $j<$fun["numcampos"]; $j++)   
    echo '<li>'.$fun[$j][1].' '.$fun[$j][2]."</li></br>";   
   echo '</ul></td>';
   echo '<td>'.$dato[$i]["vigencia_inicial"].'</td><td>'.$dato[$i]["vigencia_final"].'</td>
        <td><a href="compartir_documentos.php?accion=editar&detalle='.$dato[$i][0].'">Editar</a></td>
        </tr>';   
   }
  echo '</table><br />'; 
 }  
 else
  echo "<b>No existen registros de funcionarios compartiendo los documentos.</b>";  
}

/*
<Clase>
<Nombre>mover_documentos_adicionar</Nombre> 
<Parametros>$idfun=identificador del funcionario</Parametros>
<Responsabilidades>Formulario para transferir los documentos de un funcionario a otro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mover_documentos_adicionar($idfun="")
{ global $conn;
	$where='';
	if($idfun!='')$where=" idfuncionario=".$idfun." ";
  echo "<a href='compartir_documentos.php?idfun=".$idfun."&accion=ver_documentos_adicionar' style='font-family:Verdana,Tahoma,arial;font-size: 9px;'>Permiso pendientes</a>
  <form name='compartir' action='compartir_documentos.php' method='POST'  onSubmit='return EW_checkMyForm(this);'>
        <table>";
  $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","".$where,"nombres,apellidos",$conn);
 
  echo '<tr><td class="encabezado">FUNCIONARIO:</td><td>';
  echo '<select name="origen"><option>Seleccionar..</option>';
  for($i=0; $i<$fun["numcampos"]; $i++){
  	echo '<option value='.$fun[$i]["idfuncionario"];
    if($fun[$i]["idfuncionario"]==$idfun)
      echo ' selected';
    echo '>'.$fun[$i]["nombres"]." ".$fun[$i]["apellidos"].'</option>';     
  }
  echo '</select></td></tr>';
  echo '<tr><td class="encabezado">FUNCIONARIOS QUE<br>COMPARTEN SUS DOCUMENTOS:</td><td>';
  ?>
  <input type="hidden" name="destino" id="x_funcionario_destino">
   <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="assets/images/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="assets/images/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="imagenes/cargando.gif"></div>
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
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.setOnLoadingStart(cargando_func);
      tree2.setOnLoadingEnd(fin_cargando_func);
			tree2.enableThreeStateCheckboxes(true);
      tree2.enableSmartXMLParsing(true);
			tree2.loadXML("test.php?rol=1");
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
  <tr>
  <td class="encabezado" >MOVER DOCUMENTOS EN:
  <td bgcolor="#F5F5F5">
  <input type="checkbox" name="mover_docs[]" value="pendientes" checked="true">PENDIENTES<!--br>
  <input type="checkbox" name="mover_docs[]" value="proceso">PROCESO-->
  </td>
  </tr>   
  <tr><td colspan="2" align="center"><input type="submit" name="Aceptar" value="Aceptar"></td></tr>
 </table>
 <input type="hidden" name="accion" value="mover_documentos_accion">
 </form>
 <?php
  return true;
}

/*
<Clase>
<Nombre>mover_documentos_accion</Nombre> 
<Parametros>$_REQUEST["origen"]=funcionario origen quien tiene los documentos
 * $_REQUEST["destino"]=funcionario destino al cual se le van a enviar los documentos
 * $_REQUEST["mover_docs"]=Buzon sobre el cual se le van a enviar los documentos ejem: pendientes, proceso, etc.
 * </Parametros>
<Responsabilidades>Funcion que se encarga de hacer las validaciones necesarias para el movimiento de documentos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mover_documentos_accion(){
	global $conn;
	include_once("class_transferencia.php");
	$origen=$_REQUEST["origen"];
	$origen_codigo=busca_filtro_tabla("","funcionario","idfuncionario=".$origen,"",$conn);
	$origen2=$origen_codigo[0]["funcionario_codigo"];
	$destino=explode(",",$_REQUEST["destino"]);
	$tipo=$_REQUEST["mover_docs"];
	
	foreach($tipo as $valor){
		$documentos=retornar_documentos($valor,$origen2);
	}
	$destinos=array();
	foreach($destino as $valores){
		$a=0;
		$codigo=busca_filtro_tabla("","funcionario a, dependencia_cargo b","funcionario_idfuncionario=idfuncionario and b.iddependencia_cargo=".$valores,"",$conn);
		$destinos[$a]=$codigo[0]["funcionario_codigo"];
		$a++;
	}
	$cantidad=count($documentos);
	for($i=0;$i<=$cantidad;$i++){
		if($documentos[$i]!=''){
			$datos=array();
			$notas='';
			
			$datos["archivo_idarchivo"]=$documentos[$i];
			$datos["nombre"]="DELEGADO";
			$datos["fecha"]=date('Y-m-d H:i:s');
			$datos["respuesta"]='';
			$datos["entregado"]=1;
			$datos["recibido"]=1;
			$datos["notas"]=$notas;
			$datos["ver_notas"]=0;
			$datos["transferencia_descripcion"]=0;
			$datos["tipo"]='';
			$datos["ruta_idruta"]='';
			$datos["tipo_destino"]=1;
			$datos["serie"]='';
			$datos["origen"]=$origen2;
			
			$datos_adicionales=$notas;
			transferir_archivo_prueba($datos,$destinos,$datos_adicionales);
		}
	}
	if($_REQUEST["sin_redireccion"]!=1)
		abrir_url("compartir_documentos.php?accion=mover_documentos_adicionar&idfun=".$origen,"_self");
}
/*
<Clase>
<Nombre>ver_documentos_adicionar</Nombre> 
<Parametros>$idfun=identificador del funcionario</Parametros>
<Responsabilidades>Formulario para transferir los documentos de un funcionario a otro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function ver_documentos_adicionar($idfun="")
{ global $conn;
	$where='';
	if($idfun!='')$where=" idfuncionario=".$idfun." ";
  echo "<a href='compartir_documentos.php?idfun=".$idfun."&accion=mover_documentos_adicionar' style='font-family:Verdana,Tahoma,arial;font-size: 9px;'>Compartir documentos</a>
  <form name='compartir' action='compartir_documentos.php' method='POST' onSubmit='return EW_checkMyForm(this);'>
        <table>";
  $fun = busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","".$where,"nombres,apellidos",$conn);
 
  echo '<tr><td class="encabezado">Funcionario:</td><td>';
  echo '<select name="origen"><option>Seleccionar..</option>';
  for($i=0; $i<$fun["numcampos"]; $i++){
  	echo '<option value='.$fun[$i]["idfuncionario"];
    if($fun[$i]["idfuncionario"]==$idfun)
      echo ' selected';
    echo '>'.$fun[$i]["nombres"]." ".$fun[$i]["apellidos"].'</option>';     
  }
  echo '</select></td></tr>';
  echo '<tr><td class="encabezado">Ver pendientes de:</td><td>';
	$seleccionados=busca_filtro_tabla("entidad_compartida, llave_compartida","permiso_funcionario A","(A.entidad_propietaria=1 AND llave_propietaria=".$idfun.")","",$conn);
	$funcionarios_arreglo=array();
	$roles=extrae_campo($seleccionados,"llave_compartida");
	for($i=0;$i<$seleccionados["numcampos"];$i++){
		$datos_usuario=busca_filtro_tabla("A.nombres, A.apellidos","vfuncionario_dc A","A.iddependencia_cargo=".$seleccionados[$i]["llave_compartida"],"",$conn);
		$funcionarios_arreglo[]=ucwords(strtolower($datos_usuario[0]["nombres"]." ".$datos_usuario[0]["apellidos"]));
	}
	$funcionarios_arreglo=array_unique($funcionarios_arreglo);
	echo(implode(", ",$funcionarios_arreglo));
  ?>
  <br />
  <input type="hidden" name="destino" id="x_funcionario_destino">
   <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="assets/images/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="assets/images/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="imagenes/cargando.gif"></div>
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
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.setOnLoadingStart(cargando_func);
      tree2.setOnLoadingEnd(fin_cargando_func);
			tree2.enableThreeStateCheckboxes(true);
      tree2.enableSmartXMLParsing(true);
			tree2.loadXML("test.php?rol=1&seleccionado=<?php echo(implode(",",$roles)); ?>");
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
  <tr><td colspan="2" align="center"><input type="submit" name="Aceptar" value="Aceptar"></td></tr>
 </table>
 <input type="hidden" name="accion" value="ver_documentos_accion">
 </form>
 <?php
  return true;
}
/*
<Clase>
<Nombre>mover_documentos_accion</Nombre> 
<Parametros>$_REQUEST["origen"]=funcionario origen quien tiene los documentos
 * $_REQUEST["destino"]=funcionario destino al cual se le van a enviar los documentos
 * $_REQUEST["mover_docs"]=Buzon sobre el cual se le van a enviar los documentos ejem: pendientes, proceso, etc.
 * </Parametros>
<Responsabilidades>Funcion que se encarga de hacer las validaciones necesarias para el movimiento de documentos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function ver_documentos_accion(){
	global $conn;
	include_once("class_transferencia.php");
	$origen=$_REQUEST["origen"];
	$destino=explode(",",$_REQUEST["destino"]);
	
	$adicionados=busca_filtro_tabla("A.llave_compartida","permiso_funcionario A","(A.llave_propietaria=".$origen." AND A.entidad_propietaria=1)","",$conn);
	$datos=extrae_campo($adicionados,'llave_compartida','U');
	$quitar=array_diff($datos,$destino);
	$quitar=array_merge($quitar);
	
	$adicionales=array_diff($destino,$datos);
	$adicionales=array_merge($adicionales);
	
	$cantidad_eliminar=count($quitar);
 	$cantidad_adicionar=count($adicionales);
	
	if($cantidad_eliminar){
 		$sql1="DELETE FROM permiso_funcionario WHERE llave_propietaria=".$origen." AND entidad_propietaria=1 AND llave_compartida in(".implode(",",$quitar).")";
	 	phpmkr_query($sql1);
 	}
	$a=0;
	foreach($destino as $valores){
		$sql1="INSERT INTO permiso_funcionario(entidad_propietaria, llave_propietaria, entidad_compartida, llave_compartida, fecha, asignado_por, vigencia_inicial, vigencia_final)values(1,".$origen.", 5, ".$valores.", ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').", ".usuario_actual('idfuncionario').",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').", ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
		phpmkr_query($sql1);
		$a++;
	}
	if($_REQUEST["sin_redireccion"]!=1)abrir_url("compartir_documentos.php?accion=ver_documentos_adicionar&idfun=".$origen,"_self");
}
function retornar_documentos($tipo,$fun){
	global $conn;
	switch($tipo){
		case 'pendientes': 
		
		$doc_usuario = busca_filtro_tabla("documento_iddocumento","asignacion","entidad_identidad=1 and llave_entidad=$fun and  estado='PENDIENTE' and tarea_idtarea=2","",$conn);
			
		for($i=0; $i<$doc_usuario["numcampos"]; $i++)
 			$resultados[]=$doc_usuario[$i]["documento_iddocumento"];
    
		if(!isset($resultados))
		    $resultados[0]=0;
		$resultados=array_unique($resultados);   
		
			break;
		case 'proceso' : 
			break; 
	}
	return $resultados;
}
?>