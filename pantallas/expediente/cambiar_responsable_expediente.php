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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>

<table class="table table-bordered">
  <tr class="contenedor_autocompletar_responsable_expediente">
  	<td class="prettyprint"><b>Seleccionar Nuevo responsable:</b></td>
  	<td colspan="3">
  	    <input type="text" id="nuevo_funcionario_responsable">
        <?php autocompletar_funcionario_responsable_expediente($_REQUEST['idexpediente']); ?>
  	</td>
  </tr>
</table>  
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" id="cancel_formulario_expediente">Cancelar</button> 
<?php
function autocompletar_funcionario_responsable_expediente($idexpediente) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "librerias_saia.php");
	global $raiz_saia;
	$raiz_saia = $ruta_db_superior;
	echo (librerias_notificaciones ());
	?>
<style>
.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li:hover {
	background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height: 10px;
	overflow: hidden;
}
</style>
<script>
$(document).ready(function(){
	
  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#nuevo_funcionario_responsable").hide();
  $("#nuevo_funcionario_responsable").parent().append("<input type='text' id='buscar_radicado' size='50' name='buscar_radicado'><div id='ul_completar' class='ac_results'></div>");
  $("#buscar_radicado").keyup(function (){
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar").load( "<?php echo($ruta_db_superior); ?>pantallas/expediente/autocompletar_funcionario_responsable_expediente.php", { num_radicado: x_valor });
                  },500);
          }
  });
  
});
function cargar_datos(iddoc,descripcion){
  $("#ul_completar").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado").length){
                  $("#buscar_radicado").after("<table class='table table-bordered' id='informacion_buscar_radicado'></table>");
          }
          $("#informacion_buscar_radicado").append("<tr id='fila_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado("+iddoc+");'></td></tr>");
          
          $("#nuevo_funcionario_responsable").val(iddoc);
          $("#buscar_radicado").val("");
          $("#buscar_radicado").attr('readonly',true);

  }else{
          $("#buscar_radicado").val("");
          $("#nuevo_funcionario_responsable").val(0);
  }
  
};
function eliminar_asociado(iddoc){
  $("#fila_"+iddoc).remove();
  $("#informacion_buscar_radicado").remove();
  $("#nuevo_funcionario_responsable").val('');
  $("#buscar_radicado").attr('readonly',false);
}
</script>
<?php
}
?>