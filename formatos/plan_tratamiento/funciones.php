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

//ADICIONAR - EDITAR
//**********************
function separar_miles_valor_tratamiento($idformato,$iddoc){
	global $conn;

?>
    <script>
        function cargar_puntos(){
            Moneda_r($("#valor_plan_tratamiento").attr('id'));
        }
       
        cargar_puntos();
        $("#valor_plan_tratamiento").keyup(function(){
            Moneda_r($("#valor_plan_tratamiento").attr('id'));
        });
        $("#valor_plan_tratamiento").blur(function(){
            Moneda_r($("#valor_plan_tratamiento").attr('id'));
        });
          
        $('#formulario_formatos').
validate({
            submitHandler: function(form){
                var valor_ =new String($("#valor_plan_tratamiento").val());
                var nuevo_valor = valor_.replace(/\./g,"");
                $("#valor_plan_tratamiento").val(nuevo_valor);
                     
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

//MOSTRAR
//*****************************
function mostrar_valor_plan_tratamiento($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_plan_tratamiento A","A.documento_iddocumento=".$iddoc,"",$conn);
	$valor="$".number_format($datos[0]['valor_plan_tratamiento'],0,"",".");
	echo($valor);
}
?>