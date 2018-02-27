<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
function habilita_tipo_solicitud($idformato,$iddoc){
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			//$("#amortizacion").removeClass('tiny_sin_tiny required');
			//$("#amortizacion").parent().parent().hide();
			$("#tipo_solicitud").change(function(){
				var option = $(this).find('option:selected');
			    var valor = option.val();//to get content of "value" attrib
			    if(valor>5){
					if(valor==6 || valor==7){
						//$("#amortizacion").addClass('tiny_sin_tiny required');
						//$("#amortizacion").parent().parent().show();
					}else{
						//$("#amortizacion").removeClass('tiny_sin_tiny required');
						//$("#amortizacion").parent().parent().hide();
					}
					$("#tipo").removeClass('tiny_sin_tiny required');
					$("#tr_tipo").hide();	
				}else{
					$("#tipo").addClass('tiny_sin_tiny required');
					$("#tr_tipo").show();
					//$("#amortizacion").removeClass('tiny_sin_tiny required');
					//$("#amortizacion").parent().parent().hide();
				}
			});
		});			
	</script>
	<?php
}
function valida_valor_solicitud($idformato,$iddoc){
?>
	<script type="text/javascript">
		$(document).ready(function(){
			function cargar_puntos(){
				Moneda_r($("#valor").attr('id'));				
			}
			
			cargar_puntos();
			$("#valor").keyup(function(){
				Moneda_r($("#valor").attr('id'));
			});
			
			$("#valor").blur(function(){
				Moneda_r($("#valor").attr('id'));
			});
			
			
			$('#formulario_formatos').submit(function(){
				var valor_nuevo=new String($("#valor").val());
				var nuevo_valor = valor_nuevo.replace(/\./g,"");
				$("#valor").val(nuevo_valor);
				return(true);
			});   
			function Moneda_r(input){
				var num = $("#"+input).val().replace(/\./g,'');
				if(!isNaN(num)){
				num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
				num = num.split('').reverse().join('').replace(/^[\.]/,'');
				$("#"+input).val(num);
				}
			}
			$("#valor").keydown(function (e) {
				// Permite: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				// Permite: Ctrl+A
				(e.keyCode == 65 && e.ctrlKey === true) ||
				// Permite: home, end, left, right
				(e.keyCode >= 35 && e.keyCode <= 39)) {
				// solo permitir lo que no este dentro de estas condiciones es un return false
				return;
				}
				// Aseguramos que son numeros
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
				}
			});
		});
	</script>
	<?php
}
function validar_items_tipo_solicitud($idformato,$iddoc){
	global $conn;
	$editar = $_REQUEST["item"];
	if($editar){
		$datos_solicitudes=busca_filtro_tabla("v.documento_iddocumento, tipo_solicitud","ft_validacion_tramite v left join ft_item_add_solicit s on v.idft_validacion_tramite=s.ft_validacion_tramite","s.idft_item_add_solicit=".$editar,"",$conn);
		$id_papa = $datos_solicitudes[0]["documento_iddocumento"];
		$id_tipo_solicitud = $datos_solicitudes[0]["tipo_solicitud"];	
		?>
		<script>
		$(document).ready(function(){				
			$("#tipo_solicitud option[value='<?php echo $id_tipo_solicitud; ?>']").attr('selected',true);
		});
		</script>
		<?php
		
		$datos_solicitudes=busca_filtro_tabla("","ft_validacion_tramite v left join ft_item_add_solicit s on v.idft_validacion_tramite=s.ft_validacion_tramite","s.tipo_solicitud not in(".$id_tipo_solicitud.") and v.documento_iddocumento=".$id_papa,"",$conn);
		if($datos_solicitudes["numcampos"]){
			for($i=0;$i<$datos_solicitudes["numcampos"];$i++){
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						var opcion = "<?php echo $datos_solicitudes[$i]["tipo_solicitud"]; ?>";
						$("#tipo_solicitud option[value='"+opcion+"']").remove();
					});
				</script>
				<?php
			}		
		}
	}
	$idpadre=$_REQUEST["idpadre"];
	$datos_solicitudes=busca_filtro_tabla("","ft_validacion_tramite v left join ft_item_add_solicit s on v.idft_validacion_tramite=s.ft_validacion_tramite","v.documento_iddocumento=".$idpadre,"",$conn);
	if($datos_solicitudes["numcampos"]){
		for($i=0;$i<$datos_solicitudes["numcampos"];$i++){
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					var opcion = "<?php echo $datos_solicitudes[$i]["tipo_solicitud"]; ?>";
					$("#tipo_solicitud option[value='"+opcion+"']").remove();
				});
			</script>
			<?php
		}		
	}	 
}
function validacion_crear_solicitud($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$idpadre=$_REQUEST["idpadre"];	
	$datos_solicitudes=busca_filtro_tabla("","ft_item_add_solicit s left join ft_validacion_tramite v on v.idft_validacion_tramite=s.ft_validacion_tramite","v.documento_iddocumento=".$idpadre,"",$conn);
	if($datos_solicitudes["numcampos"]){
		alerta("Este item solo se puede realizar una sóla vez");
		//die();
		redirecciona($ruta_db_superior.'formatos/validacion_tramite/mostrar_validacion_tramite.php?iddoc='.$_REQUEST["idpadre"]);
	}
}
?>
