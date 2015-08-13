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

function separar_miles_costo_trabajo($idformato,$iddoc){
     global $conn;
?>
    <script>
        function cargar_puntos(){
            Moneda_r($("#costo_trabajo").attr('id'));
        }
       
        cargar_puntos();
        $("#costo_trabajo").keyup(function(){
            Moneda_r($("#costo_trabajo").attr('id'));
        });
        $("#costo_trabajo").blur(function(){
            Moneda_r($("#costo_trabajo").attr('id'));
        });
          
        $('#formulario_formatos').
validate({
            submitHandler: function(form){
                var valor_ =new String($("#costo_trabajo").val());
                var nuevo_valor = valor_.replace(/\./g,"");
                $("#costo_trabajo").val(nuevo_valor);
                     
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
?>