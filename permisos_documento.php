<?php
$max_salida=10;
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta;
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

//print_r($_REQUEST);die();

$usuario_actual=usuario_actual("funcionario_codigo");
echo (librerias_jquery("1.7"));
echo (estilo_bootstrap());
echo (librerias_notificaciones());

if($_REQUEST["iddoc"]!="" && $_REQUEST["accion"]!=""){
	switch ($_REQUEST["accion"]) {
		case 'adicionar':
			add_permiso_documento($_REQUEST["iddoc"]);
		break;
		
		case 'editar':
			edit_permiso_documento($_REQUEST["iddoc"],$_REQUEST["id"]);
		break;
		
		case 'guardar':
			guardar_permiso_documento($_REQUEST["iddoc"],$_REQUEST["opcion"]);
		break;

		default:
			funcionarios_permiso_documento($_REQUEST["iddoc"]);
		break;
	}
}

function guardar_permiso_documento($iddoc,$accion){
	$permisos=implode(",",@$_REQUEST["permisos"]);
	if($accion=="adicionar" && $permisos!=""){
		$sql="INSERT INTO permiso_documento (funcionario,documento_iddocumento,permisos) VALUES ('".$_REQUEST["funcionario"]."','".$iddoc."','".$permisos."')";
		phpmkr_query($sql) or die("Error al adicionar el permiso");
	}else if($accion=="editar" && $permisos!=""){
		$sql="UPDATE permiso_documento SET permisos='".$permisos."' WHERE idpermiso_documento=".$_REQUEST["id"];
		phpmkr_query($sql) or die("Error al editar el permiso");
	}else if($accion=="eliminar"){
		$sql="DELETE FROM permiso_documento WHERE idpermiso_documento=".$_REQUEST["id"];
		phpmkr_query($sql) or die("Error al Eliminar el permiso");
	}
	alerta("Datos Actualizados");
	abrir_url("permisos_documento.php?iddoc=".$iddoc."&accion=ver","_self");
	die();
}


function funcionarios_permiso_documento($iddoc){
	global $conn;
	$parte_tabla='';
	$permisos=busca_filtro_tabla("f.nombres,f.apellidos,p.funcionario,p.permisos,p.idpermiso_documento,d.ejecutor","permiso_documento p,funcionario f,documento d","p.funcionario=f.funcionario_codigo and p.documento_iddocumento=d.iddocumento and d.iddocumento=".$iddoc,"",$conn);	
	if($permisos["numcampos"]){
		for ($i=0; $i < $permisos["numcampos"]; $i++) {
			$perm = explode(",", $permisos[$i]["permisos"]);
			$mod = (in_array("m", $perm)) ? "X" : "";
			$eli = (in_array("e", $perm)) ? "X" : "";
			$edit_r = (in_array("r", $perm)) ? "X" : ""; 
			
			$parte_tabla.='<tr>';
			$parte_tabla.='<td>'.ucwords(strtolower($permisos[$i]["nombres"].''.$permisos[$i]["apellidos"])).'</td>';
			$parte_tabla.='<td style="text-align:center">'.$mod.'</td> <td style="text-align:center">'.$eli.'</td> <td style="text-align:center">'.$edit_r.'</td>';
			if(intval($permisos[$i]["funcionario"])==intval($permisos[$i]["ejecutor"])){
					$parte_tabla.='<td style="text-align:center">Creador Documento</td>';
			}else{
					$parte_tabla.='<td style="text-align:center"><a href="permisos_documento.php?accion=editar&id='.$permisos[$i]["idpermiso_documento"].'&iddoc='.$iddoc.'">Editar</a> - <a href="#" class="eliminar" idpermiso="'.$permisos[$i]["idpermiso_documento"].'">Eliminar</a></td>';
			} 
			$parte_tabla.='</tr>';
		}
	}
	?>
	<h6 style="text-align: center">PERMISOS SOBRE EL DOCUMENTO</h6>
	<hr />
	<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
		<tr><td colspan="2"><a href="permisos_documento.php?iddoc=<?php echo $iddoc;?>&accion=adicionar">Adicionar</a></td></tr>
		<tr style="background-color: #57B0DE;"><th style="text-align: center">Funcionario</th> <th style="text-align: center">Modificar</th> <th style="text-align: center">Eliminar</th> <th style="text-align: center">Editar Responsables</th><th>&nbsp;</th></tr>
		<?php echo $parte_tabla;?>
	</table>
	<script>
		$(document).ready(function (){
			$(".eliminar").click(function (){
				var iddoc=parseInt(<?php echo $iddoc;?>);
				var idpermiso=$(this).attr("idpermiso");
				if(confirm("Esta seguro de Eliminar el permisos?")===true){
					window.open("permisos_documento.php?accion=guardar&opcion=eliminar&iddoc="+iddoc+"&id="+idpermiso,"_self");
					return;
				}
			});
		})
	</script>
	<?php
}

function add_permiso_documento($iddoc){
	global $conn;
	$existe=busca_filtro_tabla("funcionario","permiso_documento","documento_iddocumento=".$iddoc,"",$conn);
	$parte="";
	if($existe["numcampos"]){
		$func=extrae_campo($existe,"funcionario");
		$parte=" and funcionario_codigo not in (".implode(",", $func).")";
	}
	$option_funcionarios='<option value="">Seleccione</option>';
	$funcionarios=busca_filtro_tabla("f.nombres,f.apellidos,f.funcionario_codigo","funcionario f","f.estado=1 ".$parte,"f.nombres,f.apellidos",$conn);
	if($funcionarios["numcampos"]){
		for ($i=0; $i < $funcionarios["numcampos"]; $i++) { 
			$option_funcionarios.='<option value="'.$funcionarios[$i]["funcionario_codigo"].'">'.ucwords(strtolower($funcionarios[$i]["nombres"].' '.$funcionarios[$i]["apellidos"])).'</option>';
		}
	}
	?>
	<h6 style="text-align: center">ADICIONAR PERMISOS SOBRE EL DOCUMENTO</h6>
	<hr />
	<form name="permiso_documento" id="permiso_documento" method="post">
		<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
			<tr>
				<td style="width:30%;background-color: #57B0DE;"><b>Funcionario</b></td>
				<td style="width:40%;">
				<select id="funcionario" name="funcionario">
					<?php echo $option_funcionarios;?>
				</select>
				</td>
			</tr>
			<tr>
				<td style="background-color: #57B0DE;"><b>Permisos</b></td>
				<td>
					<table border="0">
						<tr>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='m'></td> <td style="border:0">Modificar</td>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='e'></td> <td style="border:0">Eliminar</td>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='r'></td> <td style="border:0">Editar Responsables</td>
						</tr>
					</table>
				</td>
			</tr>			
			<tr>
				<td colspan="2" style="text-align: center">
					<input type="hidden" name="accion" id="accion" value="guardar">
					<input type="hidden" name="opcion" id="opcion" value="adicionar">
					<input type="hidden" name="iddoc" id="iddoc" value="<?php echo $iddoc; ?>">
					<button class="btn btn-primary btn-mini" id="submit_cancelar">
						Cancelar
					</button>
					<button class="btn btn-primary btn-mini" id="submit_adicionar">
						Adicionar
					</button>
				</td>
			</tr>
		</table>
	</form>
	<script>
		$(document).ready(function (){
			$("#submit_adicionar").click(function( event ) {
				event.preventDefault();
			  var funcionario=$("#funcionario").val();
			  var permiso=false;
				$("[type='checkbox']").each(function(){
					if($(this).is(':checked')===true){
						permiso=true;
					}
				});
			  if(funcionario!="" && permiso===true){
			  	$("#permiso_documento").submit();
			  }else{
			  	//alert("Todos los campos son obligatorios");
			  	notificacion_saia('<b>ATENCI&Oacute;N</b><br>Todos los campos son obligatorios','warning','',4000);
			  }
			});
			$("#submit_cancelar").click(function (){
				event.preventDefault();
				var iddoc=$("#iddoc").val();
				window.location.href="permisos_documento.php?iddoc="+iddoc+"&accion=ver";
			});
		})
	</script>
<?php
}
//encriptar_sqli("permiso_documento",1);

function edit_permiso_documento($iddoc,$idpermiso){
	global $conn;
	$funcionarios=busca_filtro_tabla("f.nombres,f.apellidos,f.funcionario_codigo,permisos","funcionario f,permiso_documento p","f.funcionario_codigo=p.funcionario and p.idpermiso_documento=".$idpermiso,"f.nombres,f.apellidos",$conn);
	$perm = explode(",", $funcionarios[0]["permisos"]);
	$mod = (in_array("m", $perm)) ? "checked" : "";
	$eli = (in_array("e", $perm)) ? "checked" : "";
	$edit_r = (in_array("r", $perm)) ? "checked" : ""; 
	?>
	<h6 style="text-align: center">EDITAR PERMISOS SOBRE EL DOCUMENTO</h6>
	<hr />
	<form name="edit_permiso_documento" id="edit_permiso_documento" method="post">
		<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
			<tr>
				<td style="width:30%;background-color: #57B0DE;"><b>Funcionario</b></td>
				<td style="width:40%;">
					<?php echo $funcionarios[0]["nombres"]." ".$funcionarios[0]["apellidos"];?>
				</td>
			</tr>
			<tr>
				<td style="background-color: #57B0DE;"><b>Permisos</b></td>
				<td>
					<table border="0">
						<tr>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='m' <?php echo $mod;?>></td> <td style="border:0">Modificar</td>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='e' <?php echo $eli;?>></td> <td style="border:0">Eliminar</td>
							<td style="border:0"><input type='checkbox' name='permisos[]' value='r' <?php echo $edit_r;?>></td> <td style="border:0">Editar Responsables</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align: center">
					<input type="hidden" name="accion" id="accion" value="guardar">
					<input type="hidden" name="iddoc" id="iddoc" value="<?php echo $iddoc; ?>">
					<input type="hidden" name="id" id="id" value="<?php echo $idpermiso;?>">
					<input type="hidden" name="opcion" id="opcion" value="editar">
					<button class="btn btn-primary btn-mini" id="submit_cancelar">
						Cancelar
					</button>
					<button class="btn btn-primary btn-mini" id="submit_editar">
						Editar
					</button>
				</td>
			</tr>
		</table>
	</form>
	<script>
		$(document).ready(function (){
			$("#submit_editar").click(function( event ) {
				event.preventDefault();
			  var permiso=false;
				$("[type='checkbox']").each(function(){
					if($(this).is(':checked')===true){
						permiso=true;
					}
				});
			  if(permiso===true){
			  	$("#edit_permiso_documento").submit();
			  }else{
			  	//alert("Ingrese al menos un permiso");
			  	notificacion_saia('<b>ATENCI&Oacute;N</b><br>Ingrese al menos un permiso','warning','',4000);
			  }
			});
			$("#submit_cancelar").click(function (){
				event.preventDefault();
				var iddoc=$("#iddoc").val();
				window.location.href="permisos_documento.php?iddoc="+iddoc+"&accion=ver";
			});
		})
	</script>
<?php
}
//encriptar_sqli("edit_permiso_documento",1);
?>