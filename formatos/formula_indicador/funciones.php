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
include_once($ruta_db_superior."librerias_saia.php");
echo( librerias_jquery('1.7') );


function validar_formula_llenar(){
?>
  <script>
  $().ready(function() {
  	$('#nombre').after('<br /><a id="link_validar" href="#">Probar formula</a>  <a href="ayuda_formulas.php" target="_blank">Ayuda</a>');
    $('#link_validar').click(function(){
  	if($('#nombre').val())
  	  validar_formula($('#nombre').val(),1);
  	else
  	  alert("Por favor digite primero la formula.");
    });
  });
  </script>
<?php
}
function validar_formula_mostrar($idformato,$iddocumento){
  $valor=busca_filtro_tabla("nombre","ft_formula_indicador","documento_iddocumento=$iddocumento","",$conn);
?>
  <div id='formula'></div>
   
   <script>
   $(document).ready(function() {
  	validar_formula("<?php echo $valor[0][0];?>",2);
  });
</script>
<?php
}
?>
<script>
function validar_formula(valor,opcion){
  if(valor!=""){
    $.ajax({
    url: "probar_formulas.php",
    data:"formula="+valor.replace(/\+/g,"{mas}"),
    type:"post",
    success: function(retorno)
     {vector=retorno.split("|");
      if(opcion==1)
        {if(!isNaN(vector[1])&&vector[1]!="")
    	     alert("La formula funciona correctamente.\nReemplazando todas las variables por 1: "+vector[2]+"="+vector[1]);
    	   else
           alert("Su formula tiene errores.\nReemplazando todas las variables por 1:  "+vector[2]+"="+vector[1]);  
        }
      else if(isNaN(vector[1])||vector[1]=="")  
        $("#formula").html("<font color='red'>Su f&oacute;rmula tiene errores</font>"+vector[1]);
     }
    });
  } 	      
}
</script>
<?php
function rango_colores_funcion($idformato,$iddoc){
	global $conn;
	if(@$_REQUEST["iddoc"]){
		$iddoc=$_REQUEST["iddoc"];
		$seleccionado=busca_filtro_tabla("rango_colores","ft_formula_indicador A","A.documento_iddocumento=".$iddoc,"",$conn);
		$datos=explode(",",$seleccionado[0]["rango_colores"]);
	}
	?>
	<td>
		<input type="hidden" name="rango_colores" id="rango_colores" value="<?php echo($seleccionado[0]["rango_colores"]); ?>">
		<table>
			<tr>
				<td>Limite inferior</td>
				<td><input type="text" id="limite_inferior" class="campo_separador" value="<?php echo($datos[0]); ?>"></td>
			</tr>
			<tr>
				<td>Limite superior</td>
				<td><input type="text" id="limite_superior" class="campo_separador" value="<?php echo($datos[1]); ?>"></td>
			</tr>
		</table>
	</td>
	<script>
	cargar_puntos();
	function cargar_puntos(){
  	$("#limite_inferior").val(Moneda_r($("#limite_inferior").val()));
  	$("#limite_superior").val(Moneda_r($("#limite_superior").val()));
  }
  $(".campo_separador").keyup(function(){
      $(this).val(Moneda_r($(this).val()));
  });
  $(".campo_separador").blur(function(){
      $(this).val(Moneda_r($(this).val()));
  });
	function Moneda_r(valor){
    var num=valor.replace(/\./g,'');
    if(!isNaN(num)){
      num=num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num=num.split('').reverse().join('').replace(/^[\.]/,'');
      return(num);
    }
  }
  $('#formulario_formatos').validate({
    submitHandler:function(form){
    	
      var valor_1=new String($("#limite_inferior").val());
      var nuevo_valor1=valor_1.replace(/\./g,"");
      
      var valor_2=new String($("#limite_superior").val());
      var nuevo_valor2=valor_2.replace(/\./g,"");
      
      if(parseInt(nuevo_valor1)>parseInt(nuevo_valor2)){
      	alert("El valor de limite inferior es mayor al valor de limite superior");
      	$("#continuar").show();
      	$("#disables_submit").hide();
      	return false;
      }
      $("#limite_inferior").val(nuevo_valor1);
      $("#limite_superior").val(nuevo_valor2);
      
      $("#rango_colores").val(nuevo_valor1+","+nuevo_valor2);
      form.submit();
    }
  });
	</script>
	<?php
}
?>