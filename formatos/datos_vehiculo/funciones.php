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

function separar_miles_valor_vehiculo($idformato,$iddoc){
  global $conn;
?>
  <script>
    function cargar_puntos(){
      Moneda_r($("#valor_vehiculo").attr('id'));
    }
   
    cargar_puntos();
    $("#valor_vehiculo").keyup(function(){
      Moneda_r($("#valor_vehiculo").attr('id'));
    });
    $("#valor_vehiculo").blur(function(){
      Moneda_r($("#valor_vehiculo").attr('id'));
    });
      
    $('#formulario_formatos').validate({
      submitHandler: function(form){
        var valor_ =new String($("#valor_vehiculo").val());
        var nuevo_valor = valor_.replace(/\./g,"");
        $("#valor_vehiculo").val(nuevo_valor);
             
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

function mostrar_imagen_vehiculo($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("A.ruta","anexos A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddoc,"",$conn);
	$imagen="<img src='../../".$datos[0]['ruta']."' title='Imagen Vehículo' style='width:200px; height:150px;'>";
	echo($imagen);
}

function mostrar_accesorios_vehiculo($idformato,$iddoc){
	global $conn;
	
	$estado_doc=busca_filtro_tabla("","ft_datos_vehiculo A, documento B","A.documento_iddocumento = B.iddocumento AND B.estado<>'ELIMINADO' AND A.documento_iddocumento=".$iddoc,"",$conn);
	//Datos ITEM
	$datos=busca_filtro_tabla("B.*","ft_datos_vehiculo A,ft_accesorios_vehiculo B","A.idft_datos_vehiculo=B.ft_datos_vehiculo AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$datos_papa=busca_filtro_tabla("","ft_datos_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);

	if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5 && !$_REQUEST['ventana']){
		$enlace_accesorios="<a href='http://".RUTA_PDF."/formatos/accesorios_vehiculo/adicionar_accesorios_vehiculo.php?pantalla=padre&idpadre=".$iddoc."&idformato=".$idformato."&padre=".$datos_papa[0]['idft_datos_vehiculo']."' style='font-size:12px;'>Adicionar ACCESORIOS VEHÍCULO</a><br/><br/>";
		echo($enlace_accesorios);
	}else{
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form2").hide();
			$("input[name='editar_ruta']").hide();
		});
	</script>
<?php
	}
	
	$tabla_accesorios="";
	
	if($datos['numcampos']){
		$tabla_accesorios.="<table style='border-collapse: collapse; font-size:10pt; width: 100%;' border='1'>";
		$tabla_accesorios.="<tbody>";
		$tabla_accesorios.="<tr>";
		$tabla_accesorios.="<td class='encabezado_list'>Accesorio</td>";
		$tabla_accesorios.="<td class='encabezado_list' style='width: 30%;'>Valor del accesorio</td>";
		//Verifico que no se este cargando el documento desde el HighSlide de Confirmacion de Negociacion
		if(!$_REQUEST['ventana']){
			if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
				$tabla_accesorios.="<td style='width:10%;'>&nbsp;</td>";
			}
		}
		$tabla_accesorios.="</tr>";	
		for($i=0;$i<$datos['numcampos'];$i++){
			$accesorio=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[$i]['accesorio_vehiculo'],"",$conn);
			$tabla_accesorios.="<tr>";
			$tabla_accesorios.="<td>".utf8_encode(html_entity_decode($accesorio[0]['nombre']))."</td>";
			$tabla_accesorios.="<td style='text-align:right;'>$".number_format($datos[$i]['valor_accesorio'],0,"",".")."</td>";
			//Verifico que no se este cargando el documento desde el HighSlide de Confirmacion de Negociacion
			if(!$_REQUEST['ventana']){
				if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
					$tabla_accesorios.="<td style='text-align:center;'>";
					$tabla_accesorios.="<a href='http://".RUTA_PDF."/formatos/accesorios_vehiculo/editar_accesorios_vehiculo.php?idformato=259&item=".$datos[$i]['idft_accesorios_vehiculo']."'><img border='0' src='../../botones/comentarios/editar_documento.png' title='Editar'></a>&nbsp;";
					$tabla_accesorios.="<a onclick='if(confirm(\"¿En realidad desea borrar este accesorio?\")) window.location=\"../librerias/funciones_item.php?formato=259&idpadre=".$iddoc."&accion=eliminar_item&tabla=ft_accesorios_vehiculo&id=".$datos[$i]['idft_accesorios_vehiculo']."\";' href='#'><img border='0' src='../../images/eliminar_pagina.png' title='Eliminar'></a>";
					$tabla_accesorios.="</td>";
				}	
			}					
			$tabla_accesorios.="</tr>";
		}
		$tabla_accesorios.="</tbody>";
		$tabla_accesorios.="</table>";
	}
	echo($tabla_accesorios);
}
?>