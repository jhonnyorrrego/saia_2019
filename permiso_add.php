<?php
include_once("permisos_tabla.php");
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());


$tabla=@$_REQUEST["tabla"];
if(!$tabla){
  $tabla="expediente";
}
$propietario=@$_REQUEST["prop_l"].@$_REQUEST["prop_e"].@$_REQUEST["prop_m"];
$dependencia=@$_REQUEST["dep_l"].@$_REQUEST["dep_e"].@$_REQUEST["dep_m"];
$cargo=@$_REQUEST["car_l"].@$_REQUEST["car_e"].@$_REQUEST["car_m"];
$todos=@$_REQUEST["tod_l"].@$_REQUEST["tod_e"].@$_REQUEST["tod_m"];
if(@$_REQUEST["key"]&&@$_REQUEST["key"]!=""&&@$_REQUEST["Guardar"]){
  // Permisos a una anexo ALMACENADO
  $idanexo=@$_REQUEST["key"];
  asignar_permiso($idanexo,"CARACTERISTICA_PROPIO",$tabla,$propietario);
  asignar_permiso($idanexo,"CARACTERISTICA_DEPENDENCIA",$tabla,$dependencia);
  asignar_permiso($idanexo,"CARACTERISTICA_CARGO",$tabla,$cargo);
  asignar_permiso($idanexo,"CARACTERISTICA_TOTAL",$tabla,$todos);
  echo "<script> parent.hs.close();</script>";
  alerta("Su permiso ha sido adicionado",'success',4000);
  exit();
}
else{ // Carga los permisos si estan definidos*/
  $idanexo=@$_REQUEST["key"];
  $permisos_actuales = busca_filtro_tabla("","permiso_".$tabla,$tabla."_id".$tabla."=".$idanexo,"",$conn);
  if($permisos_actuales["numcampos"]){
    $p_cargo=str_split($permisos_actuales[0]["caracteristica_cargo"]);
    $p_dependencia=str_split($permisos_actuales[0]["caracteristica_dependencia"]);
    $p_propio=str_split($permisos_actuales[0]["caracteristica_propio"]);
    $p_todos=str_split($permisos_actuales[0]["caracteristica_total"]);
  }
  else{
    $p_cargo=array();
    $p_dependencia=array();
    $p_propio=array("l","e","m");
    $p_todos=array("l");
  }
}

?>
<style>td{font-family:verdana;}.celda_permiso{font-size:10px;text-align:"center";}.celda_encabezado{font-size:11px;text-align:"center";}
</style>
<form name="asigpermiso" id="asigpermiso" action="permiso_add.php" method="POST">
  <table aling="center" border="1px" style="border-collapse:collapse">
    <tr>
      <td colspan="4" style="font-size:12px;" bgcolor="silver" align="center"><b>Asignar Permisos</b></td>
    </tr>
    <tr>
      <td class="celda_permiso">&nbsp;</td>
      <td class="celda_permiso">Ver</td>
      <td class="celda_permiso">Eliminar</td>
      <td class="celda_permiso">Editar</td>
    </tr>
    <tr>
      <td class="celda_encabezado">Propietario</td>
      <td class="celda_permiso">
        <input name="prop_l" type="checkbox" id="prop_l" value="l" <?php if(in_array("l",$p_propio)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="prop_e" type="checkbox" id="prop_e" value="e" <?php if(in_array("e",$p_propio)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="prop_m" type="checkbox" id="prop_m" value="m" <?php if(in_array("m",$p_propio)) echo "checked"; ?>> </td>
    </tr>
    <tr>
      <td class="celda_encabezado">Dependencia</td>
      <td class="celda_permiso">
        <input name="dep_l" type="checkbox" id="dep_l" value="l" <?php if(in_array("l",$p_dependencia)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="dep_e" type="checkbox" id="dep_e" value="e"<?php if(in_array("e",$p_dependencia)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="dep_m" type="checkbox" id="dep_m" value="m" <?php if(in_array("m",$p_dependencia)) echo "checked"; ?>> </td>
    </tr>
    <tr>
      <td class="celda_encabezado">Cargo&nbsp;&nbsp;&nbsp;</td>
      <td class="celda_permiso">
        <input name="car_l" type="checkbox" id="car_l" value="l" <?php if(in_array("l",$p_cargo)) echo "checked"; ?> > </td>
      <td class="celda_permiso">
        <input name="car_e" type="checkbox" id="car_e" value="e" <?php if(in_array("e",$p_cargo)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="car_m" type="checkbox" id="car_m" value="m" <?php if(in_array("m",$p_cargo)) echo "checked"; ?>> </td>
    </tr>
    <tr>
      <td class="celda_encabezado">Todos&nbsp;&nbsp;&nbsp;</td>
      <td class="celda_permiso">
        <input name="tod_l" type="checkbox" id="tod_l" value="l" <?php if(in_array("l",$p_todos)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="tod_e" type="checkbox" id="tod_e" value="e" <?php if(in_array("e",$p_todos)) echo "checked"; ?>> </td>
      <td class="celda_permiso">
        <input name="tod_m" type="checkbox" id="tod_m" value="m" <?php if(in_array("m",$p_todos)) echo "checked"; ?>> </td>
    
        <input type="hidden" name="key" value="<?php echo @$_REQUEST["key"];?>">
        <input type="hidden" name="numanexo" value="<?php echo @$_REQUEST["numanexo"];?>"></td>
    </tr>
    <tr>
      <td class="celda_permiso" colspan=5 align=center>
        <input type="submit" name="Guardar" value="Guardar"></td>
      <td class="celda_permiso"></td>
  </table>
</form>
</html>
<?php encriptar_sqli("asigpermiso",1);?>