<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
if($_REQUEST["idpantalla"]){
  $pantalla=busca_filtro_tabla("","pantalla","idpantalla=".$_REQUEST["idpantalla"],"",$conn);
  $pantalla_accion=busca_filtro_tabla("","pantalla_accion","fk_pantalla=".$_REQUEST["idpantalla"],"",$conn);
  $pantalla_campos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$_REQUEST["idpantalla"],"",$conn);
  $pantalla_encabezado=busca_filtro_tabla("","pantalla_encabezado","fk_pantalla=".$_REQUEST["idpantalla"],"",$conn);
  $pantalla_rutas=busca_filtro_tabla("","pantalla_ruta","fk_pantalla=".$_REQUEST["idpantalla"],"",$conn);
  $pantalla_funcion_exe=busca_filtro_tabla("","pantalla_funcion_exe","pantalla_idpantalla=".$_REQUEST["idpantalla"],"",$conn);
?>
<input type="hidden" name="idpantalla" value="<?php $_REQUEST['idpantalla']?>">
<div class="alert alert-danger"> <h5>Est&aacute; absolutamente seguro? </h5>Esta acci&oacute;n <b>NO SE PUEDE DESHACER</b> ser&aacute; eliminado el registro por completo con todo lo que se encuentre relacionado.</div>
<div calss="listado">Los siguientes son los registros que ser&aacute;n borrados de la pantalla <b><?php echo($pantalla[0]["etiqueta"]);?></b>:<br>
<?php
  if($pantalla_campos["numcampos"]){
    echo("<b>Listado de campos:</b><ul>");
    for($i=0;$i<$pantalla_campos["numcampos"];$i++){
      echo("<li>".$pantalla_campos[$i]["etiqueta"]."</li>");
    }
    echo("</ul>");
  }
  if($pantalla_funcion_exe["numcampos"]){
    echo("<b>Listado de funciones relacionadas:<br></b><ul>");
    for($i=0;$i<$pantalla_funcion_exe["numcampos"];$i++){
      $pantalla_funcion=busca_filtro_tabla("","pantalla_funcion","idpantalla_funcion=".$pantalla_funcion_exe[$i]["fk_idpantalla_funcion"],"",$conn);
      $pantalla_param_exec=busca_filtro_tabla("","pantalla_func_param","fk_idpantalla_funcion_exe=".$pantalla_funcion_exe[$i]["idpantalla_funcion_exe"],"",$conn);
      $lparametros=extrae_campo($pantalla_param_exec,"nombre");
      echo("<li>".$pantalla_funcion[0]["nombre"]."(".implode(",",$lparametros).")</li>");
    }
    echo("</ul>&nbsp;&nbsp;<b>NOTA</b>:se eliminan los par&aacute;metros vinculados a la ejuci&oacute;n en la pantalla, las funciones no ser&aacute;n borradas.");
  }
?>
</div>
<input type="hidden" name="idpantalla" id="idpantalla" value="<?php echo($_REQUEST['idpantalla']);?>">
<div class="alert alert-danger"> Debe confirmar la eliminac&oacute;n haciendo click en el bot&oacute;n<br><div id="confirmar_eliminar" class="btn btn-mini btn-danger" >Confirmaci&oacute;n de borrado</div><div id="cargando_enviar" class="pull-right" style="display:hidden"></div></div>
<?php
}
//echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
echo(librerias_bootstrap());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click","#confirmar_eliminar",function(){
			$("#cargando_enviar").show();
				$.ajax({
					type:"POST",
					url: "<?php echo($ruta_db_superior);?>pantallas/generador/delete_pantalla.php",
				  data: "ejecutar_pantalla=delete_pantalla&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&idpantalla="+$("#idpantalla").val(),
					success: function(html){
						if(html){
							var objeto=jQuery.parseJSON(html);
							if(objeto.exito){
								$("#cargando_enviar").html("Terminado ...");
                notificacion_saia(objeto.mensaje,"success","",2500);
                eliminar_info_paneles_kaiten($("#idpantalla").val());
                cerrar_kaiten();
							}
							else{
								$("#cargando_enviar").html("Terminado ...");
                notificacion_saia(objeto.mensaje,"error","",8500);
							}
						}
					}
				});
		});
	});
</script>