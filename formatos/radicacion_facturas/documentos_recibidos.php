<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."assets/librerias.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
echo(bootstrap());
echo(librerias_arboles());
echo(jquery());

if(isset($_REQUEST['aprobar'])){
	$insert="insert into ft_item_recibidos (ft_radicacion_facturas,fecha_recibida,tipo_recibido,observaciones_reci,creador_recibida) values (".$_REQUEST['idft'].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$_REQUEST['tipo_recibido']."','".$_REQUEST['observaciones']."','".usuario_actual('funcionario_codigo')."')";
	phpmkr_query($insert); 
	   
	if($_REQUEST['tipo_recibido']==2 || $_REQUEST['tipo_recibido']==3){
		$funcionario=busca_filtro_tabla("v.funcionario_codigo","ft_radicacion_facturas a,ft_item_facturas b,vfuncionario_dc v","a.idft_radicacion_facturas=b.ft_radicacion_facturas and  b.responsable=v.iddependencia_cargo and a.documento_iddocumento=".$_REQUEST['iddoc'],"");
		if($funcionario['numcampos']){
			transferencia_automatica($_REQUEST['idformato'],$_REQUEST['iddoc'],$funcionario[0]['funcionario_codigo'],3);
		}
	}
	
	echo "<script>
	        window.parent.hs.close();
	        window.parent.location.reload();
		</script>";
}
?>

<form  role="form">
  <div class="form-group">
    <div>
		<input type="text" name="fecha" id="fecha" readonly="readonly">
	</div><br>

	<label for="ejemplo_email_3" class="col-lg-2 control-label">Documentos fisicos recibidos?</label>
    <div class="col-lg-10">
      <input type="radio" name="tipo_recibido" value="1" class="form-control">&nbsp;Si
      <input type="radio" name="tipo_recibido" value="2" class="form-control">&nbsp;No
      <input type="radio" name="tipo_recibido" value="3" class="form-control">&nbsp;Incompleto
      
    </div><br/>
    <div>
    	<label for="ejemplo_email_3" class="col-lg-2 control-label">Observaciones:</label>
    	 <textarea rows="3" id="observaciones" required="true" name="observaciones"></textarea>
    </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" id="aprobar" name="aprobar" class="btn btn-primary">APROBAR</button>
      <input type="hidden" name="idft" value="<?php echo $_REQUEST['idft'];?>">
      <input type="hidden" name="iddoc" value="<?php echo $_REQUEST['iddoc'];?>">
      <input type="hidden" name="idformato" value="<?php echo $_REQUEST['idformato'];?>">
    </div>
  </div>
 </div>
</form>
<script>
	$(document).ready(function(){
		$("#fecha").val('<?php echo date("Y-m-d H:i:s");  ?>');
	});
	
</script>