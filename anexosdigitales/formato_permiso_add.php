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
$validar_enteros=array("idformato",);
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

include_once("funciones_archivo.php");
//$_REQUEST["idformato"]=1;
//$idformato=$_REQUEST["idformato"];
$propietario=1; // Por defecto el propietario es un codigo arbitrario para los formatos flata generar la posibilidad de propietarios individuales
$dependencia=$_REQUEST["dep_l"].$_REQUEST["dep_e"]; 
$cargo=$_REQUEST["car_l"].$_REQUEST["car_e"];
$todos=$_REQUEST["tod_l"].$_REQUEST["tod_e"];

if(isset($_REQUEST["idformato"])&&$_REQUEST["idformato"]!=""&&isset($_REQUEST["Guardar"])) // Permisos a una anexo ALMACENADO  
{ $idformato=$_REQUEST["idformato"];
  asignar_permiso_formato($idformato,"CARACTERISTICA_PROPIO","'".$propietario."'");
  asignar_permiso_formato($idformato,"CARACTERISTICA_DEPENDENCIA","'".$dependencia."'");
  asignar_permiso_formato($idformato,"CARACTERISTICA_CARGO","'".$cargo."'");  
  asignar_permiso_formato($idformato,"CARACTERISTICA_TODOS","'".$todos."'");
  exit();
  }
/*  
elseif(isset($_REQUEST["Guardar"])) // Preserva el valor en el formulario
{  $permisos=$propietario.";".$dependencia.";".$cargo.";".$todos;
   echo '<script>obj=parent.document.getElementById("permisos_anexos");if(obj.value!="")
    obj.value+='."'|".$_REQUEST["numanexo"] .";".$permisos."'".';
   else 
    obj.value='."'".$_REQUEST["numanexo"] .";".$permisos."'".';
   </script>';
   exit();
}*/

?>
<html>
<head>
</head>

<form name="asigpermiso" id="asigpermiso" action="formato_permiso_add.php" method="POST">
<b>Asignar Permisos Formato</b>
<table aling="center">
<tr><td></td><td>Ver</td></tr>
<tr><td>Propietario</td><td><input name="prop_l" type="checkbox" id="prop_l" value="l" checked> </td></tr>
<tr><td>Dependencia</td><td><input name="dep_l" type="checkbox" id="dep_l" value="l"> </td></tr>
<tr><td>Cargo&nbsp;&nbsp;&nbsp;</td><td><input name="car_l" type="checkbox" id="car_l" value="l"> </tr>
<tr><td>Todos&nbsp;&nbsp;&nbsp;</td><td><input name="tod_l" type="checkbox" id="tod_l" value="l" checked> </td></tr>
<tr><td><input type="hidden" name="idformato" value="<?php echo $_REQUEST["idformato"];?>"></td></tr>
<tr><td><input type="hidden" name="numanexo" value="<?php echo $_REQUEST["numanexo"];?>"></td></tr>
<tr><td><input type="submit" name="Guardar" value="Guardar"></td><td></td>
</table>
</form>
</html>
<?php encriptar_sqli("asigpermiso",1,"form_info",$ruta_db_superior);?>