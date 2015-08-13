<?php
set_time_limit(0);
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());

$valor_llenado2=@$_REQUEST["valor"];
$filas=explode(";",$valor_llenado2);
$cant=count($filas);
$items=true;

$tipos_opciones="<option>Por favor seleccione...</option><option value='departamento'>Departamento</option><option value='municipio'>Municipio</option><option value='fecha'>Fecha</option>";
?>
<form method="POST" action="cargar_registros.php" class="form-horizontal" name="cargar_registros" id="cargar_registros" enctype="multipart/form-data">
  <fieldset id="content_form_name">
    <legend>&nbsp;&nbsp;CARGAR REGISTROS</legend>
  </fieldset>
  <div class="control-group">  	
  	<label class="control-label">Archivo (.csv)</label>
  	<div class="controls">
  		<input type="file" name="file" id="file">  		
  	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tabla">Tabla</label>
    <div class="controls">
      <?php
      	$cadena="''";
				$tablas=array();
        $ltablas=$conn->Lista_Tabla();
        foreach($ltablas AS $key=>$valor){          
          if($valor[0]!=''){
            array_push($tablas,$valor[0]);
          }
        }
				if(@$_REQUEST["tabla"]){
					$campos=$conn->Busca_tabla($_REQUEST["tabla"]);
					$cadena='[\''.strtolower(implode('\',\'',$campos)).'\']';
				}
      ?>  
    	<input type="text" data-provide="typeahead" data-items="4" name="tabla" id="tabla" data-source='[<?php echo strtolower('"'.implode('","',$tablas)).'"';?>]' value="<?php echo(@$_REQUEST["tabla"]);?>">                   
    </div>
  </div>
  <div class="control-group">
  	<label class="control-label">Campos</label>
  	<div class="controls" id="valor_llenado1">
  		<table class="table table-bordered" style="width:600px;">
      	<thead>
      		<tr>
      		<td style="text-align:center; width:300px;"><b>Nombre</b></td>
      		<td style="text-align:center; width:200px;"><b>Tipo</b></td>
      		<td style="text-align:center;">&nbsp;</td>
      	</tr>
      	</thead>
      	<tbody id="items">
<?php
				if($cant){
					for($i=0;$i<$cant;$i++){
						$datos=explode(",",$filas[$i]);
						if($datos[0]!=''||$datos[1]!=''){							
							$departamento="";
							$municipio="";
							$fecha="";
							
							if($datos[1]=="departamento")$departamento="selected";
							if($datos[1]=="municipio")$municipio="selected";
							if($datos[1]=="fecha")$fecha="selected";
							
							$tipos_opciones="<option>Por favor seleccione...</option><option value='departamento' ".$departamento.">Departamento</option><option value='municipio' ".$municipio.">Municipio</option><option value='fecha' ".$fecha.">Fecha</option>";
							echo "<tr id='fila[]' ><td><input type='text' data-items='4' data-provide='typeahead' class='nombres_campos' style='width:200px' value='".$datos[0]."' class='campos_tabla'></td><td><select class='tipos_llenado'>".$tipos_opciones."</select></td><td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>";
						}
					}
				}
?>
      	</tbody>
      	<tfoot>
      		<tr>
      			<td colspan="3" id="adicionar_item" style="text-align:center;cursor:pointer">+Adicionar</td>
      		</tr>
      	</tfoot>
      </table>
  	</div>
    <input type="hidden" name="valor" id="valor">
  </div>
  <div class="form-actions">
  	<input type="hidden" name="accion" value="guardar">
    <button type="button" class="btn btn-primary" id="enviar_formulario_saia">Aceptar</button>
    <button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		var tabla_propio="";
		var campos="";
		var campos_disponibles=<?php echo $cadena; ?>;
		$(".nombres_campos").typeahead({
			source:campos_disponibles
		});
		
		$("#enviar_formulario_saia").click(function(){
			parsear_items();
			$("#cargar_registros").submit();
		});
		
		$("#adicionar_item").click(function(){
			var tabla_nueva=$("#tabla").val();
			if(tabla_nueva!=tabla_propio){
				$.ajax({
					type:'GET',
					url: "cargar_campos.php",
					data: "tabla="+tabla_nueva,
					async: false,
					success:function(campos2){
						campos=campos2;
					}
				});
			}
			tabla_propio=$("#tabla").val();
			$("#items").append("<tr id='fila[]' ><td><input type='text' data-items='4' data-provide='typeahead' class='nombres_campos' data-source='"+campos+"' style='width:200px'></td><td><select class='tipos_llenado'><?php echo $tipos_opciones; ?></select></td><td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>");
		});
		$(".eliminar_fila").live("click",function(){
			var fila=$(this).parent();
			fila.remove();
		});
	});
	function parsear_items(){
		var nombre=new Array();
		var tipo=new Array();
		$(".nombres_campos").each(function(i){
			if($(this).attr("value"))
				nombre[i]=$(this).attr("value");
		});
		$(".tipos_llenado").each(function(i){
			if($(this).val())
				tipo[i]=$(this).val();
		});
		var cantidad=nombre.length;
		var cadena=new Array();
		for(var i=0;i<cantidad;i++){
			cadena[i]=nombre[i]+","+tipo[i];
		}
		$("#valor").val(cadena.join(";"));
	}
</script>
<?php
if(@$_REQUEST["accion"]=="guardar"){
	guardar_registros();
}
function guardar_registros(){
	global $ruta_db_superior;
	if(guardar_anexo()){
		$tabla=$_REQUEST["tabla"];
		$datos=$_REQUEST["valor"];
		
		$campos=explode(";",$datos);
		$cant=count($campos);
		for($i=0;$i<$cant;$i++){
			$datos2=explode(",",$campos[$i]);
			if($datos2[0]){
				$campo[]=$datos2[0];
				$tipo[]=$datos2[1];
			}
		}
		
		$archivo=fopen($ruta_db_superior."cargar_anexos/files/carga_registros.csv",'r');
		while($linea=fgetcsv($archivo,0,",")){
			$valores=array();
			for($i=0;$i<$cant;$i++){
				$linea[$i]=trim($linea[$i]);
				switch($tipo[$i]){
					case 'fecha': $value=parsear_fecha($campo[$i],$linea[$i]);
						break;
					case 'municipio' : $value=parsear_municipio($campo[$i],$linea[$i]);
						break;
					case 'departamento' : $value=parsear_departamento($campo[$i],$linea[$i]);
						break;
					default: $value="'".$linea[$i]."'";
						break;
				}
				$valores[]=$value;
			}
			$sql1="insert into ".$tabla."(".implode(",",$campo).")values(".implode(",",$valores).")";
			phpmkr_query($sql1);
		}
		fclose($archivo);
		alerta("Accion realizada");
	}
}
function parsear_fecha($campo,$valor){
	$cadena=fecha_db_almacenar($valor,'Y-m-d');
	return $cadena;
}
function parsear_municipio($campo,$valor){
	$valor=reemplazar_caracteres($valor);
	$municipio=busca_filtro_tabla("","municipio a","lower(a.nombre) like '%".str_replace(" ","%",strtolower($valor))."%'","",$conn);
	if($municipio["numcampos"])return $municipio[0]["idmunicipio"];
	else return 0;
}
function parsear_departamento($campo,$valor){
	$valor=reemplazar_caracteres($valor);
	$departamento=busca_filtro_tabla("","departamento a","lower(a.nombre) like '%".str_replace(" ","%",strtolower($valor))."%'","",$conn);
	if($departamento["numcampos"])return $departamento[0]["iddepartamento"];
	else return 0;
}
function reemplazar_caracteres($cadena){
	$cadena=str_replace("á","a",$cadena);
	$cadena=str_replace("é","e",$cadena);
	$cadena=str_replace("í","i",$cadena);
	$cadena=str_replace("ó","o",$cadena);
	$cadena=str_replace("ú","u",$cadena);
	$cadena=str_replace("Á","A",$cadena);
	$cadena=str_replace("É","E",$cadena);
	$cadena=str_replace("Í","I",$cadena);
	$cadena=str_replace("Ó","O",$cadena);
	$cadena=str_replace("Ú","U",$cadena);
	return $cadena;
}
function guardar_anexo(){
	global $ruta_db_superior;
	$tipo=explode(".",$_FILES["file"]["name"]);
	$cant=count($tipo);
	$extension=$tipo[$cant-1];
	if($extension=="csv"){
		rename($_FILES["file"]["tmp_name"],$ruta_db_superior."cargar_anexos/files/carga_registros.csv");
		chmod($ruta_db_superior."cargar_anexos/files/carga_registros.csv",PERMISOS_ARCHIVOS);
	}
	else{
		alerta("El archivo anexo no es csv");
		return false;
	}
	return true;
}
?>