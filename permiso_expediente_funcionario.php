<?php 
include_once("db.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
include_once("header.php");

$expediente=busca_filtro_tabla("","expediente","idexpediente=".$_REQUEST["key"],"",$conn);
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

$("#enlace").click(function(){
	  $.ajax({
      url: "lista_permisos_expedientes.php",
      type:"POST",
      data:"id=<?php echo $expediente[0]['idexpediente'] ;?>",
      success: function(msg){
      
      $("#prueba").html(msg);   
      }
    });  
    })

	// validar los campos del formato
	$('#asignarserie_entidad').validate();
});
//funcion para cargar los elementos de la entidad seleccionada
function valores_entidad(identidad)
  {
    var radio=$("input[name='seleccion']:checked").val(); 
    if($("#serie_idserie").val()=="")
     alert("Por favor seleccione una serie primero.");
   else if(identidad!="") 
     {$.ajax({url: "arbol_serie_entidad.php" ,
             data:"entidad="+identidad+"&radio="+radio+"&series="+$("#serie_idserie").val()+"<?php if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad']; ?>",
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
{seleccionados=elemento.getAllLeafs();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],true);
 document.getElementById(campo).value=elemento.getAllChecked();   
} 
function ninguno_check(elemento,campo)
{seleccionados=elemento.getAllLeafs();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],false);
 document.getElementById(campo).value="";
} 
//-->
</script>
 <p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;ASIGNAR EXPEDIENTE<br><br />
</span></p>
<form name="asignarexpediente_entidad" id="asignarexpediente_entidad" action="asignarexpediente.php" method="post" >
<?php
if(@$_REQUEST["origen"])
  {echo "<a href='".$_REQUEST["origen"]."view.php?key=".$_REQUEST["llave_entidad"]."'>Volver</a><input type='hidden' value='".$_REQUEST["origen"]."' name='origen' ><br /><br />";
  }
if($_REQUEST["llave_entidad"] && $_REQUEST["tipo_entidad"])
  echo "<input type='hidden' value='".$_REQUEST["llave_entidad"]."' name='llave_entidad' ><input type='hidden' value='".$_REQUEST["tipo_entidad"]."' name='tipo_entidad' >";
if($_REQUEST["filtrar_serie"])
  echo "<input type='hidden' value='".$_REQUEST["filtrar_serie"]."' name='filtrar_serie' >"; 
if($_REQUEST["filtrar_categoria"])
  echo "<input type='hidden' value='".$_REQUEST["filtrar_categoria"]."' name='filtrar_categoria' >";    
?><p>
<input type="hidden" name="expediente_entidad" value="1">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">	
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EXPEDIENTE*</span></td>
		<td bgcolor="#F5F5F5"><B>nombre:</B><?php echo($expediente[0]["nombre"]);?><br /><b>Descripcion:</b><?php echo($expediente[0]["descripcion"]);?>     
</td>
</tr>	
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE SELECCION*</span></td>
		<td bgcolor="#F5F5F5">  <input id="seleccion" type='radio' name='seleccion' value='0' checked >Anidado
 <input id="seleccion" type='radio' name='seleccion' value='1'>No anidado  
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
 <input type='checkbox' name='opcion[]' value='0' checked >Adicionar
 <input type='checkbox' name='opcion[]' value='1'>Editar
 <input type='checkbox' name='opcion[]' value='2'>Eliminar
 <input type='checkbox' name='opcion[]' value='3'>Ver
 <input type='checkbox' name='opcion[]' value='4'>Restringir
</td>
</tr>	
<tr>
	<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION*</span></td>
	<td bgcolor="#F5F5F5"><span class="phpmaker"><a id="enlace" href="#">Listado actuales</a>
</td>     
</tr>	
<tr>
<td bgcolor="#F5F5F5" colspan="2"><div id='prueba' style="background:white"></div></td>
</tr>
<input type='hidden' name='expediente' value='<?php echo $expediente[0]["idexpediente"]; ?>'>
	
</table>
<p>
<input type="submit" name="Action" value="CONTINUAR">
</form>
<?php include ("footer.php") ?>

