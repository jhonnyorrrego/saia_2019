<?php 
$ruta_db_superior='';
$ruta_actual='../saia/';
include_once($ruta_actual."db.php");
include_once($ruta_actual."librerias_saia.php");
echo(estilo_bootstrap());
?>
<style>
.typeahead{
    max-height: 200px;
    overflow: auto;    
    left: 50px
}
.typeahead .dropdown-menu{
	position: relative;
	top:0px;
}
</style>
<div class="container">
	<input id="campo1" type="text" data-provide="typeahead" autocomplete="off" name="campo1" class="pull-left">
	<input type="text" id="valor_campo1" class="pull-left"><span id="resultado" class="pull-left badge">0</span>
</div><!-- /.container -->
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
$datos= new stdClass();
$datos->funcionario->campos[]->nombres="*data1*";
$datos->funcionario->campos[]->estado="1";
$datos->funcionario->retorno[]="nombres";
$datos->funcionario->retorno[]="apellidos";
$datos->funcionario->retorno[]="idfuncionario";
$separador="|";
$resultado=2;
$mostrar='cadena[0]+"-- pepito --"+cadena[1]';
?>
<script type="text/javascript">
$(document).ready(function() {
$('#campo1').typeahead({
	minLength:2,
	items:9999,
	source: function (query, process) {
		$.ajax({
			url: 'data.php',
			type: 'POST',
			dataType: 'JSON',
			data: 'data1=' + query+'&typehead_datos=<?php echo(json_encode($datos));?>&separador=<?php echo($separador);?>',
			success: function(data) {
				$("#resultado").html(data.numcampos);			
				if(data.numcampos===0){
					$("#resultado").addClass("badge-important");			
				}
				else{
					$("#resultado").removeClass("badge-success");
					$("#resultado").removeClass("badge-important");			
				}
				process(data.datos);
				
			}
		});
	},
	highlighter: function(item) {
		var cadena=item.split("<?php echo($separador);?>");
    return(<?php echo($mostrar);?>);
  },
  updater: function(item) {    
		var cadena=item.split("<?php echo($separador);?>");
		
		$("#valor_campo1").val(cadena[parseInt(<?php echo($resultado);?>)]);
		$("#resultado").addClass("badge-success");
    $("#resultado").html("1");
    return(<?php echo($mostrar);?>);
	}
});
function htmlentities(txt){
pares = new Array();
pares[0] = new Array("<?php echo utf8_encode('á'); ?>", "&aacute;");
pares[1] = new Array("<?php echo utf8_encode('é'); ?>", "&eacute;");
pares[2] = new Array("<?php echo utf8_encode('í'); ?>", "&iacute;");
pares[3] = new Array("<?php echo utf8_encode('ó'); ?>", "&oacute;");
pares[4] = new Array("<?php echo utf8_encode('ú'); ?>", "&uacute;");
pares[5] = new Array("<?php echo utf8_encode('Á'); ?>", "&Aacute;");
pares[6] = new Array("<?php echo utf8_encode('É'); ?>", "&Eacute;");
pares[7] = new Array("<?php echo utf8_encode('Í'); ?>", "&Iacute;");
pares[8] = new Array("<?php echo utf8_encode('Ó'); ?>", "&Oacute;");
pares[9] = new Array("<?php echo utf8_encode('Ú'); ?>", "&Uacute;");
pares[10] = new Array("<?php echo utf8_encode('ñ'); ?>", "&ntilde;");
pares[11] = new Array("<?php echo utf8_encode('ñ'); ?>", "&Ntilde;");
pares[12] = new Array("<?php echo utf8_encode('ü'); ?>", "&uuml;");
pares[13] = new Array("<?php echo utf8_encode('Ü'); ?>", "&Uuml;");
for (var i = 0; i < 14; i ++){
	txt = txt.replace(pares[i][0], pares[i][1]);
}
return txt;
}
function htmlentities_decode(txt){
pares = new Array();
pares[0] = new Array("<?php echo utf8_encode('á'); ?>", "&aacute;");
pares[1] = new Array("<?php echo utf8_encode('é'); ?>", "&eacute;");
pares[2] = new Array("<?php echo utf8_encode('í'); ?>", "&iacute;");
pares[3] = new Array("<?php echo utf8_encode('ó'); ?>", "&oacute;");
pares[4] = new Array("<?php echo utf8_encode('ú'); ?>", "&uacute;");
pares[5] = new Array("<?php echo utf8_encode('Á'); ?>", "&Aacute;");
pares[6] = new Array("<?php echo utf8_encode('É'); ?>", "&Eacute;");
pares[7] = new Array("<?php echo utf8_encode('Í'); ?>", "&Iacute;");
pares[8] = new Array("<?php echo utf8_encode('Ó'); ?>", "&Oacute;");
pares[9] = new Array("<?php echo utf8_encode('Ú'); ?>", "&Uacute;");
pares[10] = new Array("<?php echo utf8_encode('ñ'); ?>", "&ntilde;");
pares[11] = new Array("<?php echo utf8_encode('ñ'); ?>", "&Ntilde;");
pares[12] = new Array("<?php echo utf8_encode('ü'); ?>", "&uuml;");
pares[13] = new Array("<?php echo utf8_encode('Ü'); ?>", "&Uuml;");
for (var i = 0; i < 14; i ++){
	txt = txt.replace(pares[i][1], pares[i][0]);
}
return txt;
}

});
</script>