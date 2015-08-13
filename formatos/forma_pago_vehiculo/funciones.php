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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function separar_miles_valor_pago($idformato,$iddoc){
  global $conn;
?>
  <script>
    function cargar_puntos(){
      Moneda_r($("#valor_forma_pago").attr('id'));
    }
   
    cargar_puntos();
    $("#valor_forma_pago").keyup(function(){
      Moneda_r($("#valor_forma_pago").attr('id'));
    });
    $("#valor_forma_pago").blur(function(){
      Moneda_r($("#valor_forma_pago").attr('id'));
    });
     
    $('#formulario_formatos').validate({
      submitHandler: function(form){
      	//Valor matricula
        var valor_ =new String($("#valor_forma_pago").val());
        var nuevo_valor = valor_.replace(/\./g,"");
        $("#valor_forma_pago").val(nuevo_valor);
             
        form.submit();  
      }     
    });
      
    function Moneda_r(input){
      var num = $("#"+input).val().replace(/\./g,'');
      if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        $("#"+input).val(num);
      }
    }
  </script>
<?php
}

function cargar_concepto_pago($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_forma_pago_vehiculo A","A.idft_forma_pago_vehiculo=".$_REQUEST['item'],"",$conn);

?>
	<script type="text/javascript">
		$(document).ready(function(){
			var concepto="<?php echo($datos[0]['concepto_pago'])?>";
			$("#concepto_pago option[value="+concepto+"]").attr("selected","selected");
		});
	</script>
<?php
}
?>