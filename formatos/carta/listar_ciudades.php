<?php
include_once("../../db.php");
//$con=new Conexion("");
//$buscar=new SQL ($con->Obtener_Conexion(),$con->Motor);
global $conn;
if($_POST["dep"]<>"")
  $ciudades=busca_filtro_tabla("idmunicipio,nombre","municipio","departamento_iddepartamento=".$_POST["dep"],"nombre",$conn);
else $ciudades="";  
if($ciudades["numcampos"]>0)
  {echo '<select name="'.$_POST["nombre"].'" id="obligatorio">
         <option value="" selected>Seleccionar...</option>';
   for($i=0; $i<$ciudades["numcampos"];$i++)
      echo "<option value='".$ciudades[$i]["idmunicipio"]."'>".$ciudades[$i]["nombre"]."</option>";
   echo '</select>';   
  }
else
  {echo '<select name="ciudad_destino">
         <option value="" selected>Seleccionar...</option>
         </select>';
  }  
?>
