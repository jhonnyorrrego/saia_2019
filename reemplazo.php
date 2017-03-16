<?php
/*
<Archivo>
<Nombre>reemplazo.php</Nombre> 
<Parametros>$_REQUEST["formato_adicionar"]:indica que se va a adicionar un registro, $_REQUEST["antiguo"]=idrol del funcionario antiguo, $_REQUEST["nuevo"]: idrol del funcionario nuevo, $_REQUEST["formato_revertir"]:muetra el listado de todos los reemplazos para desactivarlos, $_REQUEST["revertir"]:id de reemplazo a inactivar</Parametros>
<ruta>saia1.06/reemplazo.php</ruta>
<Responsabilidades>Administra los reemplazon de funcionarios en SAIA<Responsabilidades>
<Notas>Se basa en cambio de roles y delegacion de documentos</Notas>
<Salida>Formulario en pantalla para adicionar, inactivar y litar reemplazos</Salida>
</Archivo>
*/
include_once("db.php");
include_once("header.php");
/*
<Clase>
<Nombre>mostrar_funcionarios</Nombre> 
<Parametros></Parametros>
<Responsabilidades>muestra una lista con los funcionarios donde el valor es iddependencia_cargo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_funcionarios($campo)
  {global $conn; 
   ?>
 Buscar: 
<input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),1)"> 
  <img src="botones/general/anterior.png"border="0px"></a>                   
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),0,1)">
  <img src="botones/general/buscar.png"border="0px"></a>                                              
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value))">
  <img src="botones/general/siguiente.png"border="0px"></a>                            <br />
<div id="esperando_<?php echo $campo; ?>">
  <img src="imagenes/cargando.gif">
</div>
<div id="treeboxbox_<?php echo $campo; ?>" height="90%">
</div>
<input type="hidden" maxlenght="11"  class="required"  name="<?php echo $campo; ?>" id="<?php echo $campo; ?>"   value="" >
<label style="display:none" class="error" for="<?php echo $campo; ?>">Campo obligatorio.
</label>
<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_<?php echo $campo; ?>","100%","100%",0);
                			tree_<?php echo $campo; ?>.setImagePath("imgs/");
                			tree_<?php echo $campo; ?>.enableIEImageFix(true);
                      tree_<?php echo $campo; ?>.enableCheckBoxes(1);
                      tree_<?php echo $campo; ?>.enableRadioButtons(true);
                      tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.enableSmartXMLParsing(true);
                      tree_<?php echo $campo; ?>.loadXML("test.php?rol=1");
                	    tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
                      function onNodeSelect_<?php echo $campo; ?>(nodeId)
                      {valor_destino=document.getElementById("<?php echo $campo; ?>");
 
                       if(tree_<?php echo $campo; ?>.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "none";
                      }
 
                      function cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
   <?php                
  }
/*
<Clase>
<Nombre>ejecuta_sql_partes</Nombre> 
<Parametros>$sql:sentencia sql;$numero_registros:cantidad de registros</Parametros>
<Responsabilidades>ejecuta consulta con limit<Responsabilidades>
<Notas>Esta funcion no se utiliza </Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/  
function ejecuta_sql_partes($sql,$numero_registros){
global $conn;  
$retorno["sql"]=$sql;
$retorno["numcampos"]=0;
$inicio=0;
if($sql<>""&&$numero_registros){ 
  do{ 
    $rs=@phpmkr_query($sql." LIMIT $inicio,$numero_registros ",$conn);
    $temp=phpmkr_fetch_array($rs);
    $i=0;
    for(;$temp;$temp=phpmkr_fetch_array($rs),$i++)
      array_push($retorno,$temp);
    $retorno["numcampos"]+=$i;
    //echo("<br />".$sql.$i."<br />");   
    $inicio+=$numero_registros;  
    phpmkr_free_result($rs);   
  }while($i>=$numero_registros);
}
return($retorno);
}
/*
<Clase>
<Nombre>buscar_pendientes</Nombre> 
<Parametros>$codigo:codigo del funcionario</Parametros>
<Responsabilidades>busca los documentos pendientes que tiene el funcionario, realiza la busqueda en tabla asignacion<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/  
function buscar_pendientes($codigo)
{
  global $conn;
 $resultados= array();
  $doc_usuario = busca_filtro_tabla("DISTINCT documento_iddocumento","asignacion","entidad_identidad=1 and llave_entidad = '$codigo' and tarea_idtarea=2 and estado = 'PENDIENTE'","",$conn); 
 
  if($doc_usuario["numcampos"]>0)
   for($i=0; $i<$doc_usuario["numcampos"]; $i++)
    $resultados[]=$doc_usuario[$i]["documento_iddocumento"];
  
  $resultados=array_unique($resultados);
  return($resultados);
}
  
if(isset($_REQUEST["formato_adicionar"]))
{include_once("calendario/calendario.php"); 
 include_once("formatos/librerias/header_formato.php");      
?>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script>
$().ready(function() {
	// validar los campos del formato
	$('#form1').validate();
	
});
</script><img class="imagen_internos" src="botones/configuracion/reemplazo.png" border="0">ASIGNAR REEMPLAZO
<br><br>
<a href="reemplazo.php?formato_revertir=1">Desactivar Reemplazo </a>
<br><br>
<form name="form1" id="form1" method="post" action="reemplazo.php">
<table border="0">
<tr >
<td class="encabezado" >FUNCIONARIO ACTUAL*</td>
<td bgcolor="#F5F5F5">
<?php
mostrar_funcionarios("antiguo");
?>
</td>
</tr>
<tr>
<td class="encabezado" >REEMPLAZO*</td>
<td bgcolor="#F5F5F5">
<?php
mostrar_funcionarios("nuevo");
?>
</td>
</tr>
<tr>
<td class="encabezado">FECHA DE ACTIVACI&Oacute;N*</td>
<td bgcolor="#F5F5F5">
<input type="text" class="required" name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y/m/d H:i:s'); ?>" readonly="true" >
</td>
</tr>
<tr>
<td class="encabezado">FECHA FINALIZACI&Oacute;N*</td>
<td bgcolor="#F5F5F5">
<input type="text" name="fecha_fin" class="required" id="fecha_fin" value="" readonly="true" >
<?php selector_fecha("fecha_fin","0","Y/m/d",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA"); ?>
</td>
</tr>
</table>
<input type="submit" value="Continuar" >
<input type="hidden" name="adicionar" value="1">
</form>
<?php
}
else if(isset($_REQUEST["adicionar"]))
{
 //include_once("class_transferencia.php");
  $codigo=busca_filtro_tabla("funcionario_codigo,idfuncionario","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$_REQUEST["antiguo"],"",$conn);
  $codigo2=busca_filtro_tabla("funcionario_codigo,idfuncionario","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo =".$_REQUEST["nuevo"],"",$conn);   /*
  /* compartir los buzones de pendientes y proceso con la persona nueva */
  $ejecutor = usuario_actual("id");
  $nuevo = "insert into permiso_funcionario (entidad_propietaria,llave_propietaria,entidad_compartida,llave_compartida,fecha,asignado_por,vigencia_inicial,vigencia_final) VALUES (1,".$codigo2[0]["idfuncionario"].",1,'".$codigo[0]["funcionario_codigo"]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",$ejecutor,".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".fecha_db_almacenar($_POST["fecha_fin"],"Y-m-d").")";  
  phpmkr_query($nuevo,$conn);
  //die();
   reemplazo_funcionario();  
   redirecciona("reemplazo.php?formato_revertir=1");
}
else if(isset($_REQUEST["formato_revertir"]))
{$reemplazos=busca_filtro_tabla("reemplazo.*,".fecha_db_obtener("fecha_inicio","Y-m-d")." as fecha_inicio","reemplazo","activo=1","",$conn);
 if($reemplazos["numcampos"]>0)
 {
?><img class="imagen_internos" src="botones/configuracion/reemplazo.png" border="0">DESACTIVAR REEMPLAZO<br><br>
<a href="reemplazo.php?formato_adicionar=1"> Asignar Reemplazo </a><br><br>
<form name="form1" action="reemplazo.php" method="post">
<table width="90%" border="1">
 <tr class="encabezado_list">
  <td>FUNCIONARIO ANTIGUO</td>
  <td>REEMPLAZO</td>
  <td>FECHA INICIO</td>
  <td>FECHA FIN</td>
  <td>&nbsp;</td>
 </tr>
 <?php
 for($i=0;$i<$reemplazos["numcampos"];$i++)
   {$antiguo=busca_filtro_tabla("nombres,apellidos","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazos[$i]["antiguo"],"",$conn);
   $nuevo=busca_filtro_tabla("nombres,apellidos","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazos[$i]["nuevo"],"",$conn);
   echo '<tr >
    <td>'.ucwords($antiguo[0]["nombres"]." ".$antiguo[0]["apellidos"]).'</td>
    <td>'.ucwords($nuevo[0]["nombres"]." ".$nuevo[0]["apellidos"]).'</td>
    <td align="center">'.$reemplazos[$i]["fecha_inicio"].'</td>
    <td align="center">'.$reemplazos[$i]["fecha_fin"].'</td>
    <td align="center"><a href="reemplazo.php?revertir='.$reemplazos[$i]["idreemplazo"].'">Desactivar</a></td>
   </tr>';
   }
  }
  else
   echo "<br /><span class='phpmaker'>No hay registros para desactivar.<br /><br /></span><a href='reemplazo.php?formato_adicionar=1' >Asignar reemplazo</a>";  
 ?>
</table>
</form>
<?php
}
else if(isset($_REQUEST["revertir"]))
{  revertir();
   redirecciona("reemplazo.php?formato_revertir=1");
}
/*
<Clase>
<Nombre>reemplazo_funcionario</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Inactiva el funcionario que sale al igual que su rol y fecha final. Al funcionario que lo reemplaza primero se inactiva su rol y fecha final y seguidamente se le asigna el rol del funcionario que estar� reemplazando este cargo estar� seguido de (E). Se crea registro en tabla reemplazo<Responsabilidades>
<Notas>recibe los valores nuevo y antiguo del $_REQUEST del formulario</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function reemplazo_funcionario()
{ global $conn;  
  $idrol= 0;
  $cargo_nuevo=busca_filtro_tabla("dependencia_cargo.*,nombre","dependencia_cargo,cargo","cargo_idcargo=idcargo and iddependencia_cargo=".$_REQUEST["nuevo"],"",$conn);
  $cargo_antiguo=busca_filtro_tabla("cargo_idcargo,nombre,funcionario_idfuncionario,dependencia_iddependencia","dependencia_cargo,cargo","cargo_idcargo=idcargo and iddependencia_cargo=".$_REQUEST["antiguo"],"",$conn);
  
   //desactivo el funcionario que sale y su rol
   $sql="UPDATE funcionario set estado=0 where idfuncionario=".$cargo_antiguo[0]["funcionario_idfuncionario"];
    phpmkr_query($sql,$conn);  
    $sql="UPDATE dependencia_cargo set estado=0, fecha_final=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where iddependencia_cargo=".$_REQUEST["antiguo"];
     phpmkr_query($sql,$conn);
$cargoe=busca_filtro_tabla("idcargo","cargo","nombre='".$cargo_antiguo[0]["nombre"]." (E)'","",$conn);
   //si existe actualizo el rol
    $anio=date("Y");
    $fecha_fin= date("Y-m-d", mktime( 0, 0, 0,1, 1,$anio+1));
    $fecha_final = $fecha_fin;
   if($cargoe["numcampos"])
    {     
     $sql= "INSERT INTO dependencia_cargo (funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final) values (".$cargo_nuevo[0]["funcionario_idfuncionario"].",".$cargo_antiguo[0]["dependencia_iddependencia"].",".$cargoe[0]["idcargo"].",1,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s').")";
     phpmkr_query($sql,$conn);
    }
   else//si no existe lo creo y actualizo el rol
    {$sql="INSERT INTO cargo(nombre) values('".$cargo_antiguo[0]["nombre"]." (E)')";
     phpmkr_query($sql,$conn);
     $idcargo=phpmkr_insert_id();   
     $sql= "INSERT INTO dependencia_cargo (funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final) values (".$cargo_nuevo[0]["funcionario_idfuncionario"].",".$cargo_antiguo[0]["dependencia_iddependencia"].",".$idcargo.",1,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".fecha_db_almacenar($fecha_final,'Y-m-d H:i:s').")";
    //echo $sql."<br />";
     phpmkr_query($sql,$conn); 
    }
    $idrol = phpmkr_insert_id();
    //guardo los datos del reemplazo
   $sql="INSERT INTO reemplazo(antiguo,nuevo,fecha_inicio,fecha_fin,cargo_nuevo) values('".$_REQUEST["antiguo"]."','".$_REQUEST["nuevo"]."',".fecha_db_almacenar($_REQUEST["fecha_inicio"],'Y-m-d H:i:s').",".fecha_db_almacenar($_REQUEST["fecha_fin"],'Y-m-d').",'$idrol')";
    phpmkr_query($sql,$conn);    
}
/*
<Clase>
<Nombre>revertir</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Devolver los cambios del reemplazo, se activa el funcionario que se fue con sus datos respectivos en rol y reasigna el rol del funcionario que lo reemplazo. Se inactiva el registro en tabla reemplazo.<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function revertir()
{
 global $conn;
 $datos=busca_filtro_tabla("","reemplazo","idreemplazo=".$_REQUEST["revertir"],"",$conn);
  //datos del rol de quien estaba haciendo el reemplazo 
  $datos_anteriores=busca_filtro_tabla("*","dependencia_cargo","iddependencia_cargo=".$datos[0]["nuevo"],"",$conn);
  //datos del funcionario que estaba haciendo el reemplazo 
  $reemplazo=busca_filtro_tabla("*","funcionario","idfuncionario=".$datos_anteriores[0]["funcionario_idfuncionario"],"",$conn); 
   
   $anio=date("Y");
   $fecha_fin= fecha_db_almacenar(date("Y-m-d", mktime( 0, 0, 0,1, 1,$anio+1)),"Y-m-d");
   //datos del rol de la persona que sali� temporalmente  
   $antiguo=busca_filtro_tabla("*","dependencia_cargo","iddependencia_cargo=".$datos[0]["antiguo"],"iddependencia_cargo DESC",$conn);
   //datos del funcionario que estaba haciendo el reemplazo 
  $usuinicial=busca_filtro_tabla("*","funcionario","idfuncionario=".$antiguo[0]["funcionario_idfuncionario"],"",$conn); 
   //le pongo el cargo anterior al reemplazo   
   $sql="update dependencia_cargo set estado=0,fecha_final=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where iddependencia_cargo=".$datos[0]["cargo_nuevo"];
   phpmkr_query($sql,$conn);
   $sql= "INSERT INTO dependencia_cargo (funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final) values (".$antiguo[0]["funcionario_idfuncionario"].",".$antiguo[0]["dependencia_iddependencia"].",".$antiguo[0]["cargo_idcargo"].",1,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$fecha_fin)";
    phpmkr_query($sql,$conn);
    $sql="update funcionario set estado=1 where idfuncionario=".$antiguo[0]["funcionario_idfuncionario"];
    phpmkr_query($sql,$conn);
    //actualizo la fecha de finalizacion del reemplazo
   $sql="update reemplazo set activo=0,fecha_fin=".fecha_db_almacenar(date("Y-m-d"),"Y-m-d")." where idreemplazo=".$_REQUEST["revertir"];
   phpmkr_query($sql,$conn);
   //cambio la fecha de vigencia par compartir los documentos  
  $sql = "update permiso_funcionario set vigencia_final=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." where llave_propietaria='".$reemplazo[0]["idfuncionario"]."' and llave_compartida='".$usuinicial[0]["funcionario_codigo"]."' and entidad_propietaria=1 and entidad_compartida=1";  
  phpmkr_query($sql,$conn); 
}

include_once("footer.php");
?>