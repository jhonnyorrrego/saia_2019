<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once("../db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idformato");
include_once($ruta_db_superior."librerias_saia.php");
$validar_enteros=array("idformato");
desencriptar_sqli('form_info');
echo(librerias_jquery());
include_once("../header.php");
include_once("librerias/header_formato.php");
include_once("librerias/funciones_acciones.php");
include_once("librerias/funciones.php"); 
?>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type='text/javascript'>
  $().ready(function() {
	$("#asignar_funcion_formato").validate({
		submitHandler: function(form) {
			<?php encriptar_sqli("asignar_funcion_formato",0,"form_info",$ruta_db_superior);?>
			form.submit();
			    
		},		
  rules: {
    entidad1: {
      required: "#tipo1:checked"
    },
   entidad2: {
      required: "#tipo2:checked"
    } 
  }
});
	
  $('#tipo1').click(function(){
    $('#tr_arbol_func').show(); 
    $('#tr_campo_formato').hide();
    $("#entidad1").valid();
  })   
  $('#tipo2').click(function(){
    $('#tr_arbol_func').hide();
    $('#tr_campo_formato').show(); 
    $("#entidad2").valid();
  })
  
});
</script>
<?php
$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
if(@$_REQUEST["adicionar"]==1){

  if($_REQUEST["tipo_transferencia"]==1)
    $entidad=str_replace(",","@",$_REQUEST["entidad1"]);
  else
    $entidad=$_REQUEST["entidad2"];  
  $sql="insert into funciones_formato(nombre,nombre_funcion,descripcion,etiqueta,parametros,formato,ruta,acciones) values('{*transferencia_automatica*}','transferencia_automatica','transferencia_automatica','transferencia_automatica','$entidad,".$_REQUEST["tipo_transferencia"]."','".$_REQUEST["idformato"]."','../librerias/funciones_generales.php',NULL)";
  guardar_traza($sql,$formato[0]["nombre_tabla"]);
 phpmkr_query($sql); 
 $idfunc=phpmkr_insert_id();
 if(adicionar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$idfunc,@$_REQUEST["momento"],@$_REQUEST["estado"])){
    alerta("Asignacion realizada Correctamente");
  }
  else alerta("Problemas al realizar la asignacion");   
}
else if(@$_REQUEST["editar"]==1 && @$_REQUEST["idformato"]){
  if($_REQUEST["tipo_transferencia"]==1)
    $entidad=str_replace(",","@",$_REQUEST["entidad1"]);
  else
    $entidad=$_REQUEST["entidad2"]; 
    $sql="update funciones_formato set parametros='$entidad,".$_REQUEST["tipo_transferencia"]."' where idfunciones_formato in(select idfunciones_formato from funciones_formato_accion where idfunciones_formato_accion=".$_REQUEST["accion_funcion"].")";
    guardar_traza($sql,$formato[0]["nombre_tabla"]);
  phpmkr_query($sql);
  if(modificar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$_REQUEST["funciones"],@$_REQUEST["momento"],@$_REQUEST["estado"],@$_REQUEST["accion_funcion"])){
    alerta("Asignacion Editada Correctamente");
  }
  else alerta("Problemas al editar la asignacion");
}
else if(@$_REQUEST["eliminar"]==1 && @$_REQUEST["idformato"]){
  if(eliminar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$_REQUEST["funciones"],@$_REQUEST["momento"],@$_REQUEST["estado"],@$_REQUEST["accion_funcion"])){
    alerta("Asignacion eliminada Correctamente");
    redirecciona("transferencias_automaticas.php?idformato=".$_REQUEST["idformato"]);
  }
  else alerta("Problemas al eliminar la funcion");
}

if(@$_REQUEST["idformato"]){
  $texto='<div align="center">';
  if(@$_REQUEST["accion_ejecutar"]==1){
    $texto.="<b>EDITANDO ASIGNACION ";
  }
  else if(@$_REQUEST["accion_ejecutar"]==2){
    $texto.="<b>ELIMINANDO ASIGNACION";
  }
  else {
    $texto.="<b>ASIGNANDO";
  }
  $idformato=$_REQUEST["idformato"];
  $formato=busca_filtro_tabla("etiqueta","formato","idformato=$idformato","",$conn);
  $texto.=' Transferencia Automatica ('.$formato[0]["etiqueta"].')<br /><br /></b></div><div><a href="formatoview.php?key='.$_REQUEST["idformato"].'">Regresar</a>
  &nbsp;&nbsp;<a href="transferencias_automaticas.php?idformato='.$_REQUEST["idformato"].'">Asignar Transferencia</a>
  &nbsp;&nbsp;<a href="funciones_formato_ordenar.php?idformato='.$_REQUEST["idformato"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Ordenar Funciones</a>
  <br /><form method="POST" name="asignar_funcion_formato" id="asignar_funcion_formato"><table style="border-collapse:collapse;" border="1px" width="100%">';
  
  $lacciones=busca_filtro_tabla("","accion","","",$conn);


  $accion_formato=0;
  if(@$_REQUEST["accion_funcion"]){
    $accion_formato=$_REQUEST["accion_funcion"];
  }
  $accion_funcion=busca_filtro_tabla("","funciones_formato_accion","idfunciones_formato_accion=".$accion_formato,"",$conn);
  
  if($lacciones["numcampos"]){
    
    $texto.='<tr><td class="encabezado" title="momento en que se debe realizar la accion">Momento *: </td><td class="celda_normal"><input type="radio" name="momento" id="momento" class="required" value="ANTERIOR" ';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["momento"]== "ANTERIOR")
        $texto.=" CHECKED ";
    $texto.='> ANTERIOR A &nbsp;&nbsp;&nbsp;<input type="radio" name="momento" id="momento" value="POSTERIOR" ';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["momento"]== "POSTERIOR")
        $texto.=" CHECKED ";
    $texto.='> POSTERIOR A</td></tr>';
    $texto.='<tr><td class="encabezado" title="accion que se debe tener en cuenta a la hora de realizar la consulta por ejemplo: editar, adicionar, aprobar en las acciones de los scripts sse deben adicionar estas acciones, la ruta es relativa a la carpeta formato">Accion a validar: </td><td class="celda_normal"><select name="acciones" id="acciones">';

    for($i=0;$i<$lacciones["numcampos"];$i++){
      $texto.='<option value="'.$lacciones[$i]["idaccion"].'"';
      if($accion_funcion["numcampos"] && $accion_funcion[0]["accion_idaccion"]== $lacciones[$i]["idaccion"])
        $texto.=" SELECTED ";
      $texto.='>'.$lacciones[$i]["nombre"]." (".$lacciones[$i]["ruta"].')</option>';
    }
  $texto.='</select></td></tr>';
  
  $texto.='<tr><td class="encabezado" title="De donde se toma el listado de persona para la transferencia">Tipo de transferencia: </td><td class="celda_normal">';
  $destinos="";
  $tipo_trans="";
  $nombre_seleccionados="";
  $funcion=busca_filtro_tabla("parametros","funciones_formato","idfunciones_formato=".$accion_funcion[0]["idfunciones_formato"],"",$conn);
  if($funcion["numcampos"])
    {$vector=explode(",",$funcion[0][0]);
     $destinos=$vector[0];
     $tipo_trans=$vector[1];
    }
  $texto.='<input type="radio" id="tipo1"  class="required" name="tipo_transferencia" value="1" ';
  if($tipo_trans==1)
    {$texto.=' checked ';
     $nombres_seleccionados=arbol_seleccionados($destinos);
    }
  $texto.='>Funcionarios fijos&nbsp;&nbsp;<input type="radio" id="tipo2" name="tipo_transferencia" value="2" ';
  if($tipo_trans==2)
    $texto.=' checked ';
  $texto.='>Funcionarios tomados de un campo del formato</td></tr>';  
  $texto.='<tr id="tr_campo_formato" ';
  if($tipo_trans==""||$tipo_trans=="1")
    $texto.='style="display:none"';
  $texto.='><td class="encabezado" title="Entidad a quien se debe transferir el documento">Campo del formato de donde se toman los destinos: </td><td class="celda_normal">';

  $campos=busca_filtro_tabla("nombre,etiqueta","campos_formato","etiqueta_html in('arbol') and formato_idformato=".$_REQUEST["idformato"],"etiqueta",$conn);
   if($campos["numcampos"]){
   $texto.='<select name="entidad2" id="entidad2">
            <option value="">Seleccionar...</option>';
   for($i=0;$i<$campos["numcampos"];$i++)
     {$texto.='<option value="'.$campos[$i]["nombre"].'" ';
      if($destinos==$campos[$i]["nombre"])
        $texto.=" selected ";
      $texto.='>'.$campos[$i]["etiqueta"].'</option>';
     }
   $texto.='</select>';  
  }      
  $texto.='</td></tr>';  
  $texto.='<tr id="tr_arbol_func" ';
  if($tipo_trans==""||$tipo_trans=="2")
    $texto.='style="display:none"';
  $texto.='><td class="encabezado" title="Entidad a quien se debe transferir el documento">Transferir automaticamente a *: </td><td class="celda_normal">
  <input type="hidden" name="entidad1" id="entidad1" value="'.$destinos.'" >
  <link rel="STYLESHEET" type="text/css" href="../css/dhtmlXTree.css">
	<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="../js/dhtmlXTree.js"></script>';
  $texto.=$nombres_seleccionados.'Buscar:<br><input type="text" id="stext_3" width="200px" size="20" >      
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById(\'stext_3\').value),1)">
      <img src="../botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById(\'stext_3\').value),0,1)">
      <img src="../botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById(\'stext_3\').value))">
      <img src="../botones/general/siguiente.png" border="0px" alt="Siguiente"></a>  
    <br /><div id="esperando_serie">
    <img src="../imagenes/cargando.gif"></div>
    <div id="treeboxbox_tree3"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
			tree3.setImagePath("../imgs/");
			tree3.enableIEImageFix(true);
			tree3.enableCheckBoxes(1);
			tree3.setOnLoadingStart(cargando_serie);
      tree3.setOnLoadingEnd(fin_cargando_serie);
			tree3.loadXML("../test.php?rol=1&seleccionado='.str_replace("@",",",str_replace("#","d",$destinos)).'");
			tree3.setOnCheckHandler(onNodeSelect_tree3);
      function onNodeSelect_tree3(nodeId)
      {seleccionados=tree3.getAllChecked();
       document.getElementById("entidad1").value=seleccionados;
      }
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval(\'document.getElementById("esperando_serie")\');
        else if (browserType == "ie")
           document.poppedLayer =
              eval(\'document.getElementById("esperando_serie")\');
        else
           document.poppedLayer =
              eval(\'document.layers["esperando_serie"]\');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval(\'document.getElementById("esperando_serie")\');
        else if (browserType == "ie")
           document.poppedLayer =
              eval(\'document.getElementById("esperando_serie")\');
        else
           document.poppedLayer =
               eval(\'document.layers["esperando_serie"]\');
        document.poppedLayer.style.visibility = "visible";
      }              
	--> 		
	</script>';
    $texto.='</td></tr>';  
    $texto.='<input type="hidden"  class="required"  name="estado" id="estado" value="1" >';
    if(@$_REQUEST["accion_ejecutar"]==1){
      $texto.='</select><input type="hidden" name="editar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"><input type="hidden" name="idaccion_funcion" value="'.$_REQUEST["accion_funcion"].'"></td></tr>';
    }
    else if(@$_REQUEST["accion_ejecutar"]==2){
      $texto.='</select><input type="hidden" name="eliminar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"><input type="hidden" name="idaccion_funcion" value="'.$_REQUEST["accion_funcion"].'"></td></tr>';
    }
    else
      $texto.='</select><input type="hidden" name="adicionar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"></td></tr>';
    $texto.='<tr align="center"><td class="celda_normal" colspan="2"><input type="submit" ></td></tr>';
  }
  $texto.='</table></form><br /><br />';
}
$lasignadas=busca_filtro_tabla("A.nombre AS accion, A.ruta AS ruta_accion,B.etiqueta AS funcion, B.ruta AS ruta_funcion, C.estado AS estado_af, B.parametros,C.idfunciones_formato_accion","funciones_formato_accion C,accion A,funciones_formato B","C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato and B.nombre_funcion='transferencia_automatica' AND C.formato_idformato=".$_REQUEST["idformato"],"",$conn);
if($lasignadas["numcampos"]){
  $texto.='<table style="border-collapse:collapse;" border="1px" width="80%">';
  $texto.='<tr class="encabezado_list"><td>Accion</td><td>Ruta<br />Acci&oacute;n</td><td>Funcion</td><td>Ruta<br />Funci&oacute;n</td><td>Se ejecuta</td><td>&nbsp</td><td>&nbsp;</td></tr>';
  for($j=0;$j<$lasignadas["numcampos"];$j++){
    if($lasignadas[$j]["estado_af"]==1){
      $estado='<img src="../botones/general/mas.png" border="0px">';
    }
    else
      $estado='<img src="../botones/general/menos.png" border="0px">';
      $texto.='<tr class="celda_normal"><td>'.$lasignadas[$j]["accion"].'&nbsp;</td><td>'.$lasignadas[$j]["ruta_accion"].'&nbsp;</td><td>'.$lasignadas[$j]["funcion"].'&nbsp;</td><td>'.$lasignadas[$j]["ruta_funcion"].'&nbsp;</td><td align="center">'.$estado.'</td><td><a href="transferencias_automaticas.php?idformato='.@$_REQUEST["idformato"].'&accion_ejecutar=1&accion_funcion='.$lasignadas[$j]["idfunciones_formato_accion"].'"><img src="../botones/general/editar.png" border="0px" alt="Editar"></a></td><td><a href="transferencias_automaticas.php?idformato='.@$_REQUEST["idformato"].'&accion_ejecutar=2&accion_funcion='.$lasignadas[$j]["idfunciones_formato_accion"].'"><img src="../botones/general/menos.png" border="0px" alt="Eliminar"></a></td></tr>';
  }
  $texto.='</table>';
}
echo($texto."</div>");

function arbol_seleccionados($destinos)
{global $conn;
 $retorno=array();
 $vector=explode("@",$destinos);
 foreach($vector as $fila)
   {if(strpos($fila,"#"))
      $nombre=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
    else 
      $nombre=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=$fila","",$conn);
    if($nombre["numcampos"])
     $retorno[]=$nombre[0]["nombre"];  
   }
  return(implode(", ",$retorno)."<br />"); 
}

include_once("../footer.php");
?>