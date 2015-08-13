<?php
if(!isset($_SESSION))
    session_start();
include_once("../../db.php");
/*$con=new Conexion("");
$buscar=new SQL ($con->Obtener_Conexion(),$con->Motor);*/
global $conn;
$fun=@$_SESSION["usuario_actual"];
if(!$fun) $fun=0;
$ciudades=busca_filtro_tabla("distinct funcionario_codigo,nombres,apellidos","funcionario,dependencia_cargo,cargo","funcionario_idfuncionario=idfuncionario AND cargo_idcargo=idcargo AND dependencia_iddependencia=".$_POST["dep"]." AND cargo.estado=1 AND funcionario.estado=1 and dependencia_cargo.estado=1 AND funcionario_codigo not like ".$fun,"nombres,apellidos",$conn);
if($ciudades["numcampos"]>0)
  {echo '<select name="'.$_POST["nombre"].'" id="obligatorio">
         <option value="" selected>Seleccionar...</option>';
   for($i=0;$i<$ciudades["numcampos"];$i++)
      echo "<option value='".$ciudades[$i]["funcionario_codigo"]."'>".ucwords($ciudades[$i]["nombres"]." ".$ciudades[$i]["apellidos"])."</option>";
   echo '</select>';   
  }
else
  {echo '<select name="'.$_POST["nombre"].'">
         <option value="" selected>Seleccionar...</option>
         </select>';
  }  
?>
