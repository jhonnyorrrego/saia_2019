<?php		
// Initialize common variables
$x_idfuncionario = Null;
$x_funcionario_codigo = Null;
$x_login = Null;
$x_nombres = Null;
$x_apellidos = Null;
$x_nit = Null;
$x_fecha_fin_inactivo = Null;
include_once("db.php");
include_once("librerias_saia.php");
include_once("calendario/calendario.php");
echo(estilo_bootstrap()); 
// Load Key Parameters
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = explode(",",$sKey);
// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	//ob_end_clean();
	redirecciona("funcionariolist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idfuncionario=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {
			redirecciona("funcionariolist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sKey,$conn)) {
      $_SESSION["ewmsg"] = "Borrado Exitoso de la Llave= " . stripslashes($sKey);
      //			redirecciona("funcionariolist.php");
			exit();
		}
		break;
}

?>
<?php include ("header.php") ?>
<p><span class="internos"><br><br>&nbsp;&nbsp;CAMBIAR ESTADO FUNCIONARIOS<br></span></p>
<form action="funcionariodelete.php" method="post" id="formulario_funcionario">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="1" class="table table-bordered table-striped" width="100%">
  <thead>
	<tr class="encabezado_list phpmaker">
		
		<th>IDENTIFICACI&Oacute;N</th>
		<th>LOGIN</th>
    <th>NOMBRES</th>
    <th>APELLIDOS</th>
		
    <th>CAMBIAR ESTADO</th>
	</tr>
  </thead>
<?php

$nRecCount = 0;
foreach ($arRecKey as $sRecKey) {
	$sRecKey = trim($sRecKey);
	$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
	$nRecCount = $nRecCount + 1;
	if (LoadData($sRecKey,$conn)) {
?>
	<tr>
		
		<td><?php echo $x_nit; ?> &nbsp;</td>  
		<td><?php echo $x_login; ?> &nbsp;</td>
    <td><?php echo $x_nombres; ?> &nbsp;</td>
    <td><?php echo $x_apellidos; ?> &nbsp;</td>
		
    <td>Fecha fin de inactividad<br>
    	<?php if($x_fecha_fin_inactivo)echo $x_fecha_fin_inactivo."<br>"; ?>
    	<input type="text" name="fecha_fin_inactivo<?php echo $x_idfuncionario; ?>" id="fecha_fin_inactivo<?php echo $x_idfuncionario; ?>" value="<?php echo date('Y-m-d'); ?>" style="width:100px">
    	<?php selector_fecha("fecha_fin_inactivo".$x_idfuncionario,"formulario_funcionario","Y-m-d",date("m"),date("Y"),"default.css","",""); ?>&nbsp;&nbsp;
    	<?php validar_estado_funcionario($sRecKey); ?>
    	</td>
	</tr>
<?php
	}
}
?>
</table>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	global $x_idfuncionario;
	global $x_funcionario_codigo;
	global $x_login;
  global $x_nombres;
  global $x_apellidos;
	global $x_nit;
	global $x_fecha_fin_inactivo;
  $row=busca_filtro_tabla(fecha_db_obtener('fecha_fin_inactivo','Y-m-d')." as fecha_fin_inactivox, a.*","funcionario a","idfuncionario=".$sKey,"",$conn);
	if ($row["numcampos"]== 0) {
    $LoadData = false;
		return(false);
	}else{
		$LoadData = true;
		// Get the field contents
		$x_idfuncionario = $row[0]["idfuncionario"];
		$x_funcionario_codigo = $row[0]["funcionario_codigo"];
		$x_login = $row[0]["login"];
		$x_nit = $row[0]["nit"];
    $x_nombres = $row[0]["nombres"];
    $x_apellidos = $row[0]["apellidos"];
    $x_fecha_fin_inactivo=$row[0]["fecha_fin_inactivox"];
	}
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey,$conn)
{
	global $_SESSION;
	$sSql = "SELECT A.* FROM funcionario A";
	$sSql .= " WHERE " . $sqlKey;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);

  $temp=phpmkr_fetch_array($rs);
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
     phpmkr_free_result($rs);

	return($i);
}
//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($key,$conn){
	global $_SESSION;
  $funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$key,"",$conn);
  print_r($key);
  die("Eliminar Funcionario");
	/*$sSql = "UPDATE funcionario SET estado=0 WHERE $sqlKey";	
	phpmkr_query($sSql,$conn) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$update_rol = "UPDATE dependencia_cargo SET estado=0 WHERE funcionario_idfuncionario=".substr($sqlKey,16);
	phpmkr_query($update_rol,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $update_rol);*/
	return true;
}
function validar_estado_funcionario($idfuncionario){
//$estados=array(array("eliminar","icon-remove","danger"),array("inactivar","icon-remove","info"),array("inactivar_temporal","icon-remove","info"),array("reemplazar","icon-remove","info"));
$estados=array(array("inactivar_temporal","icon-remove","info"));
$cant_estados=count($estados);
$texto='';
for($i=0;$i<$cant_estados;$i++){
  $texto.='<div class="btn btn-mini btn-'.$estados[$i][2].' tooltip_saia accion_funcionario" accion="'.$estados[$i][0].'_funcionario" idregistro="'.$idfuncionario.'" titulo="'.$estados[$i][0].'"><i class="'.$estados[$i][1].'"></i></div>';
}
echo($texto);
}
function permitir_accion_funcionario($accion,$idfuncionario){
  switch($accion[0]){
    
  }
}
function cambiar_estado_funcionario($idfuncionario){
/*		$reemplazo = busca_filtro_tabla("nuevo,antiguo,iddependencia_cargo as id","reemplazo,dependencia_cargo,funcionario","funcionario_idfuncionario=idfuncionario and funcionario_codigo = $codigo and (nuevo=iddependencia_cargo or antiguo=iddependencia_cargo) and reemplazo.activo=1","",$conn);
		if($reemplazo["numcampos"]>0)
		 for($i=0; $i<$reemplazo["numcampos"]; $i++)
     {
      if($theValue==0 && $reemplazo[$i]["id"]==$reemplazo[$i]["nuevo"])
      {
       $nombre_r=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazo[$i]["antiguo"],"",$conn);
       confirmacion("El funcionario no se puede desactivar porque esta reemplazando a ".$nombre_r[0]["nombre"].". Desea desactivar el reemplazo ?");
       $theValue=1;
       return false;
      }
      if($theValue==1 && $reemplazo[$i]["id"]==$reemplazo[$i]["antiguo"])
      {
       $nombre_r=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazo[$i]["nuevo"],"",$conn);
       confirmacion("No se puede activar porque el funcionario ".$nombre_r[0]["nombre"]." lo esta reemplazando. Desea desactivar el reemplazo ?");
       $theValue=0; 
       return false;      
      }
     }		
		if($theValue==0)
		{
     phpmkr_query("update dependencia_cargo set estado=0 where funcionario_idfuncionario=$sKeyWrk",$conn) or error("Fallo inactivar los roles del funcioanrio");
    }
    $rol = busca_filtro_tabla("","dependencia_cargo a,funcionario_salario b","dependencia_cargo_iddependencia_cargo=iddependencia_cargo AND funcionario_idfuncionario=".$sKeyWrk." AND a.estado=1","iddependencia_cargo desc",$conn);
	if($rol["numcampos"] > 0){
		$sql = "UPDATE funcionario_salario SET salario='".@$_POST["x_salario"]."' WHERE dependencia_cargo_iddependencia_cargo=".$rol[0]["iddependencia_cargo"];
		phpmkr_query($sql);
	}
	else {
		$rol = busca_filtro_tabla("","dependencia_cargo a","funcionario_idfuncionario=".$sKeyWrk." AND a.estado=1","",$conn);
		$sql = "INSERT INTO funcionario_salario (salario,dependencia_cargo_iddependencia_cargo) values('".@$_POST["x_salario"]."',".$rol[0]["iddependencia_cargo"].")";
		phpmkr_query($sql);
	} */
}  
echo(librerias_jquery("1.7"));
echo(librerias_acciones_kaiten());
echo(librerias_tooltips());
?>
<script type="text/javascript">
  iniciar_tooltip();
  $(document).ready(function(){
    $(".accion_funcionario").click(function(){
      var accion=$(this).attr("accion");
      var idfun=$(this).attr("idregistro");
      var fecha_fin=$("#fecha_fin_inactivo"+idfun).val();
      $.ajax({
        type:'post',
        url: "pantallas/funcionario/cambiar_estados.php",
        data: "accion="+accion+"&idfuncionario="+$(this).attr("idregistro")+"&fecha_fin_inactivo="+fecha_fin,
        success: function(html){
          if(html){
			      var objeto=jQuery.parseJSON(html);
            switch(accion){
              case "eliminar_funcionario":
                if(objeto.exito){
                  tipo_notificacion="success";
                }
                else{
                  tipo_notificacion="error";                
                }
                top.noty({text: objeto.mensaje,type: tipo_notificacion,layout: "topCenter",timeout:4500});
                eliminar_panel_actual_kaiten();
              break;
              default:
                if(objeto.exito){
                  tipo_notificacion="success";
                }
                else{
                  tipo_notificacion="error";                
                }
                top.noty({text: objeto.mensaje,type: tipo_notificacion,layout: "topCenter",timeout:4500});
                if(objeto.redirecciona){            
                  window.open(objeto.redirecciona,"_self");
                }
                
              break;
            }
            window.open("funcionario_detalles.php?key="+idfun,"detalle_fun");
          }
        }
      });   
    });      
  });
/*if(confirm("<?php echo $texto ;?>"))
 window.open("reemplazo.php?formato_revertir=1","centro"); 
*/
</script>