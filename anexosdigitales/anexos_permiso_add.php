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

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

include_once("funciones_archivo.php");
//$_REQUEST["idanexo"]=1;
//$idanexo=$_REQUEST["idanexo"];
$propietario=$_REQUEST["prop_l"].$_REQUEST["prop_e"].$_REQUEST["prop_m"];
$dependencia=$_REQUEST["dep_l"].$_REQUEST["dep_e"].$_REQUEST["dep_m"]; 
$cargo=$_REQUEST["car_l"].$_REQUEST["car_e"].$_REQUEST["car_m"];
$todos=$_REQUEST["tod_l"].$_REQUEST["tod_e"].$_REQUEST["tod_m"];
if(isset($_REQUEST["idanexo"])&&$_REQUEST["idanexo"]!=""&&isset($_REQUEST["Guardar"])) // Permisos a una anexo ALMACENADO  
{ $idanexo=$_REQUEST["idanexo"];
//print_r($_REQUEST);die();
  asignar_permiso($idanexo,"CARACTERISTICA_PROPIO","'".$propietario."'");
  asignar_permiso($idanexo,"CARACTERISTICA_DEPENDENCIA","'".$dependencia."'");
  asignar_permiso($idanexo,"CARACTERISTICA_CARGO","'".$cargo."'");  
  asignar_permiso($idanexo,"CARACTERISTICA_TOTAL","'".$todos."'");
  //echo "<br><br>Permisos procesados.<br><br> Por Favor Cierre esta ventana";
  //echo "<script> window.parent.hs.close();</script>";
  redirecciona("anexos_permiso_add.php?idanexo=".$_REQUEST["idanexo"]);
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
     $p_propio=array("l","e","m");
     $p_todos=array("l");   
   }
	  
}
//encriptar_sqli("asigpermiso",1,"form_info",$ruta_db_superior);
?>
<html>  
  <head>    
    <style type="text/css">      
      <!--
            body,text,textarea,submit,tr{
            font-size:12px; font-family: Verdana,Tahoma,arial;
            }
            -->    
    </style>  
  </head>  
  <form name="asigpermiso" id="asigpermiso" action="anexos_permiso_add.php" method="POST"><b>Asignar Permisos al Anexo</b> <br /> <br />  
    <table aling="center" >      
      <tr><td></td><td>Ver</td><td>Eliminar</td><td>Editar</td>      
      </tr>      
      <tr><td>Propietario</td><td align='center'>          
          <input name="prop_l" type="checkbox" id="prop_l" value="l" <?php if(in_array("l",$p_propio)) echo "checked"; ?>> </td><td align='center'>          
          <input name="prop_e" type="checkbox" id="prop_e" value="e" <?php if(in_array("e",$p_propio)) echo "checked"; ?>> </td>          <td align='center'>          
          <input name="prop_m" type="checkbox" id="prop_m" value="m" <?php if(in_array("m",$p_propio)) echo "checked"; ?>> </td>      
      </tr>      
      <tr><td>Dependencia</td><td align='center'>          
          <input name="dep_l" type="checkbox" id="dep_l" value="l" <?php if(in_array("l",$p_dependencia)) echo "checked"; ?>> </td><td align='center'>          
          <input name="dep_e" type="checkbox" id="dep_e" value="e"<?php if(in_array("e",$p_dependencia)) echo "checked"; ?>> </td>         <td align='center'> 
          <input name="dep_m" type="checkbox" id="dep_m" value="m"<?php if(in_array("m",$p_dependencia)) echo "checked"; ?>> </td>      
      </tr>      
      <tr><td>Cargo&nbsp;&nbsp;&nbsp;</td><td align='center'>          
          <input name="car_l" type="checkbox" id="car_l" value="l" <?php if(in_array("l",$p_cargo)) echo "checked"; ?> > </td><td align='center'>          
          <input name="car_e" type="checkbox" id="car_e" value="e" <?php if(in_array("e",$p_cargo)) echo "checked"; ?>> </td>         <td align='center'>          
          <input name="car_m" type="checkbox" id="car_m" value="m" <?php if(in_array("m",$p_cargo)) echo "checked"; ?>> </td>        
      </tr>      
      <tr><td>Todos&nbsp;&nbsp;&nbsp;</td><td align='center'>          
          <input name="tod_l" type="checkbox" id="tod_l" value="l" <?php if(in_array("l",$p_todos)) echo "checked"; ?>> </td><td align='center'>          
          <input name="tod_e" type="checkbox" id="tod_e" value="e" <?php if(in_array("e",$p_todos)) echo "checked"; ?>> </td>         <td align='center'>          
          <input name="tod_m" type="checkbox" id="tod_m" value="m" <?php if(in_array("m",$p_todos)) echo "checked"; ?>> </td>        
      </tr>      
      <tr><td colspan=4>          
          <input type="hidden" name="idanexo" value="<?php echo $_REQUEST["idanexo"];?>">  
              
          <input type="hidden" name="numanexo" value="<?php echo $_REQUEST["numanexo"];?>">   
        
          <input type="submit" name="Guardar" value="Guardar"></td></tr>    
    </table>  
  </form>
</html>