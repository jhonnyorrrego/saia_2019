<script>
function cerrar(){
if(parent.window.hs) {
		var exp = parent.window.hs.getExpander("el_<?php echo $_REQUEST["idanexo"];?>");
		if (exp) {
			exp.close();
		}
	}
}

function recargar_centro()
{
  parent.location.reload();
  
}
</script>
<?php 
//die("INGRESE");
include_once("funciones_archivo.php");
//$_REQUEST["idanexo"]=1;
//$idanexo=$_REQUEST["idanexo"];
$propietario=$_REQUEST["prop_l"].$_REQUEST["prop_e"];
$dependencia=$_REQUEST["dep_l"].$_REQUEST["dep_e"]; 
$cargo=$_REQUEST["car_l"].$_REQUEST["car_e"];
$todos=$_REQUEST["tod_l"].$_REQUEST["tod_e"];
if(isset($_REQUEST["idanexo"])&&$_REQUEST["idanexo"]!=""&&isset($_REQUEST["Guardar"])) // Permisos a una anexo ALMACENADO  
{ $idanexo=$_REQUEST["idanexo"];
  asignar_permiso($idanexo,"CARACTERISTICA_PROPIO","'".$propietario."'");
  asignar_permiso($idanexo,"CARACTERISTICA_DEPENDENCIA","'".$dependencia."'");
  asignar_permiso($idanexo,"CARACTERISTICA_CARGO","'".$cargo."'");  
  asignar_permiso($idanexo,"CARACTERISTICA_TOTAL","'".$todos."'");
  echo "<br><br>Permisos procesados.<br><br> Por Favor Cierre esta ventana";
  echo "<script> cerrar();</script>";
  exit();
  }
elseif(isset($_REQUEST["Guardar"])) // Preserva el valor en el formulario
{  $permisos=$propietario.";".$dependencia.";".$cargo.";".$todos;
   echo '<script>obj=parent.document.getElementById("permisos_anexos");if(obj.value!="")
    obj.value+='."'|".$_REQUEST["numanexo"] .";".$permisos."'".';
   else 
    obj.value='."'".$_REQUEST["numanexo"] .";".$permisos."'".';
   </script>';
   exit();
}
else // Carga los permisos si estan definidos 
{ $idanexo=$_REQUEST["idanexo"];
  $permisos_actuales = busca_filtro_tabla("","permiso_anexo","anexos_idanexos=".$idanexo,"",$conn);
 
 if($permisos_actuales["numcampos"]>0)
   {
    $p_cargo=str_split($permisos_actuales[0]["caracteristica_cargo"]);
    $p_dependencia=str_split($permisos_actuales[0]["caracteristica_dependencia"]);
    $p_propio=str_split($permisos_actuales[0]["caracteristica_propio"]);
    $p_todos=str_split($permisos_actuales[0]["caracteristica_total"]);
   }
   else
   { $p_cargo=array();
     $p_dependencia=array();
     $p_propio=array("l","e");
     $p_todos=array("l");   
   }
	  
}

?>
<html>
<head>
</head>

<form name="asigpermiso" id="asigpermiso" action="anexos_permiso_add.php" method="POST">
<b>Asignar Permisos al Anexo</b>
<table aling="center">
<tr><td></td><td>Ver</td><td>Eliminar</td></tr>
<tr><td>Propietario</td><td><input name="prop_l" type="checkbox" id="prop_l" value="l" <?php if(in_array("l",$p_propio)) echo "checked"; ?>> </td><td><input name="prop_e" type="checkbox" id="prop_e" value="e" <?php if(in_array("e",$p_propio)) echo "checked"; ?>> </td></tr>
<tr><td>Dependencia</td><td><input name="dep_l" type="checkbox" id="dep_l" value="l" <?php if(in_array("l",$p_dependencia)) echo "checked"; ?>> </td><td><input name="dep_e" type="checkbox" id="dep_e" value="e"<?php if(in_array("e",$p_dependencia)) echo "checked"; ?>> </td></tr>
<tr><td>Cargo&nbsp;&nbsp;&nbsp;</td><td><input name="car_l" type="checkbox" id="car_l" value="l" <?php if(in_array("l",$p_cargo)) echo "checked"; ?> > </td><td><input name="car_e" type="checkbox" id="car_e" value="e" <?php if(in_array("e",$p_cargo)) echo "checked"; ?>> </td></tr>
<tr><td>Todos&nbsp;&nbsp;&nbsp;</td><td><input name="tod_l" type="checkbox" id="tod_l" value="l" <?php if(in_array("l",$p_todos)) echo "checked"; ?>> </td><td><input name="tod_e" type="checkbox" id="tod_e" value="e" <?php if(in_array("e",$p_todos)) echo "checked"; ?>> </td></tr>
<tr><td><input type="hidden" name="idanexo" value="<?php echo $_REQUEST["idanexo"];?>"></td></tr>
<tr><td><input type="hidden" name="numanexo" value="<?php echo $_REQUEST["numanexo"];?>"></td></tr>
<tr><td><input type="submit" name="Guardar" value="Guardar"></td><td></td>
</table>
</form>
</html>
