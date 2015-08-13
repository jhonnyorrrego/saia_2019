<?php
include_once("db.php");
$expediente=$_REQUEST["id"];
if(!empty($_GET['idregistro'])){

$actualizar_estado="UPDATE entidad_expediente SET estado=0 WHERE identidad_expediente=".$_GET['idregistro'];
$conn->Ejecutar_Sql($actualizar_estado);  
redirecciona("permiso_expediente_funcionario.php?key=".$_GET['expediente']."&si=si");
}


$entidad=busca_filtro_tabla("","entidad","","",$conn);

$fecha=date("Y-m-d");

echo"<table border='1' style='border-collapse:collapse;' width='100%'><tr >
       <tr >
  <td align='middle'><b>ENTIDAD</b></td><td align='middle'><b>NOMBRE</b></td><td align='middle'><b>PERMISOS</b></td><td align='middle'><b>ACCION</b></td>
 </tr>";
for($i=0;$i<$entidad["numcampos"];$i++){

$entidad_expediente=busca_filtro_tabla("","entidad_expediente","entidad_identidad=".$entidad[$i]["identidad"]." and expediente_idexpediente=".$expediente." and estado=1","",$conn);


if($entidad_expediente["numcampos"]){
$nombre="";
for($l=0;$l<$entidad_expediente["numcampos"];$l++){

if($entidad[$i]["identidad"]==1){
$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$entidad_expediente[$l]["llave_entidad"],"","",$conn);
$nombre=$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"];
}
if($entidad[$i]["identidad"]==2){
$dependencia=busca_filtro_tabla("","dependencia","iddependencia=".$entidad_expediente[$l]["llave_entidad"],"",$conn);
$nombre=$dependencia[0]["nombre"];
}
if($entidad[$i]["identidad"]==4){
$cargo=busca_filtro_tabla("","cargo","idcargo=".$entidad_expediente[$l]["llave_entidad"],"",$conn);
$nombre=$cargo[0]["nombre"];
}

$lista_permisos= explode(",",$entidad_expediente[$l]["permiso"]);
$permiso="";
for($j=0;$j<count($lista_permisos);$j++){

if($lista_permisos[$j]=="a"){
$permiso.="Adicionar";
}
if($lista_permisos[$j]=="m"){
$permiso.="Editar";
}
if($lista_permisos[$j]=="e"){
$permiso.="Eliminar";
}
if($lista_permisos[$j]=="l"){
$permiso.="Ver";
}
if($lista_permisos[$j]=="r"){
$permiso.="Restringir";
}
if($j!=count($lista_permisos)-1){
$permiso.=",";
}
}   
$enlace_eliminar="<a href='lista_permisos_expedientes.php?idregistro=".$entidad_expediente[$l]["identidad_expediente"]."&expediente=".$expediente."'><img src='carrito/remove.gif' border='0' alt='Eliminar' onclick=\"javascript:if(confirm('Esta seguro de eliminar los permisos?'))return true;return false;\"></a>";
echo'<tr><td align="middle">'.$entidad[$i]["nombre"].'</td><td align="middle">'.$nombre.'</td><td align="middle">'.$permiso.'</td><td align="middle">'.$enlace_eliminar.'</td></tr>';

}

}
}
echo "</table>";



?>