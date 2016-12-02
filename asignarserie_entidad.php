<?php 
include_once("db.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
include_once("header.php");
include_once("formatos/librerias/header_formato.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/cmxforms.js"></script>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript"> 
<!--
$().ready(function() {
	// validar los campos del formato
	$('#asignarserie_entidad').validate();
});
//funcion para cargar los elementos de la entidad seleccionada
function valores_entidad(identidad)
  {if($("#serie_idserie").val()=="")
     alert("Por favor seleccione una serie primero.");    
   else if(identidad!=""){
      $.ajax({url: "arbol_serie_entidad.php" ,
             data:"entidad="+identidad+"&series="+$("#serie_idserie").val()+"<?php if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad']; ?>",
             type: "POST",
             success: function(msg){
             $("#sub_entidad").html(msg);
            }});        
     }       
  }
$.ajax({url: "arbol_serie_entidad.php" ,
       data:"entidad=serie<?php if(@$_REQUEST['filtrar_serie']) echo '&filtrar_serie='.$_REQUEST['filtrar_serie'];  if(@$_REQUEST['filtrar_categoria']) echo '&filtrar_categoria='.$_REQUEST['filtrar_categoria']; if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad'];?>",
       type: "POST",
       success: function(msg){
       $("#divserie").html(msg);
      }});
function todos_check(elemento,campo)
{seleccionados=elemento.getAllUnchecked();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],true);
 document.getElementById(campo).value=elemento.getAllChecked();   
} 
function ninguno_check(elemento,campo)
{seleccionados=elemento.getAllChecked();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],false);
 document.getElementById(campo).value="";
} 
//-->
</script>
 <p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;ASIGNAR O QUITAR SERIE/CATEGORIA<br><br />
</span></p>
<form name="asignarserie_entidad" id="asignarserie_entidad" action="asignarserie.php" method="post" >
<?php
if(@$_REQUEST["origen"])
  {echo "<a href='".$_REQUEST["origen"]."view.php?key=".$_REQUEST["llave_entidad"]."'>Volver</a><input type='hidden' value='".$_REQUEST["origen"]."' name='origen' ><br /><br />";
  }
if(@$_REQUEST["llave_entidad"] && @$_REQUEST["tipo_entidad"])
  echo "<input type='hidden' value='".$_REQUEST["llave_entidad"]."' name='llave_entidad' ><input type='hidden' value='".$_REQUEST["tipo_entidad"]."' name='tipo_entidad' >";
if(@$_REQUEST["filtrar_serie"])
  echo "<input type='hidden' value='".$_REQUEST["filtrar_serie"]."' name='filtrar_serie' >"; 
if(@$_REQUEST["filtrar_categoria"])
  echo "<input type='hidden' value='".$_REQUEST["filtrar_categoria"]."' name='filtrar_categoria' >";
if(@$_REQUEST["pantalla"])
  echo "<input type='hidden' value='".$_REQUEST["pantalla"]."' name='pantalla' >";
?><p>
<input type="hidden" name="serie_entidad" value="1">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">	
 <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE/CATEGORIA*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <div id="divserie"></div>        
</td>
</tr>	
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE ENTIDAD*</span></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$entidad = busca_filtro_tabla("*","entidad","","nombre",$conn);
$select_entidad = "<select class='required' name='tipo_entidad' onchange='valores_entidad(this.value);'><option value=''>Seleccionar..</option>";
if($entidad["numcampos"]>0)
for($i=0; $i<$entidad["numcampos"]; $i++)
{ 
 if($entidad[$i]["identidad"]!=3 && $entidad[$i]["identidad"]!=5) 
  {$select_entidad.="<option value=".$entidad[$i]["identidad"];
   if(@$_REQUEST["tipo_entidad"] && $entidad[$i]["identidad"]==@$_REQUEST["tipo_entidad"])
      $select_entidad.=" selected ";
   $select_entidad.=">".ucfirst($entidad[$i]["nombre"])."</option>";
  } 
}
if(@$_REQUEST["tipo_entidad"])
  echo '<script>valores_entidad("'.$_REQUEST["tipo_entidad"].'");</script>';
$select_entidad.="</select>";
echo $select_entidad;
?>     
</td>
</tr>	 
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ENTIDAD*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
 <div id="sub_entidad">
 </div>
 </td>
	</tr>	
<tr>
<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
 <input type='radio' name='opcion' value='1' checked >Adicionar&nbsp;&nbsp;
 <input type='radio' name='opcion' value='0'>Quitar
</td>
</tr>		
</table>
<p>
<input type="submit" name="Action" value="CONTINUAR">
</form>
<?php include ("footer.php") ?>