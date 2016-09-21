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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function funcion1_proveedor($idformato,$iddoc){
$provee=busca_filtro_tabla("A.nombre","ejecutor A,datos_ejecutor B,ft_factura_proveedor C"," B.iddatos_ejecutor=C.prooveedor AND A.idejecutor=B.ejecutor_idejecutor AND C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['nombre'];

}
 

function formatear_valor_numero($idformato,$iddoc){
global $conn;
?>
<script>
function cargar_puntos(){
Moneda_r($("#valor_factura").attr('id'));

}

cargar_puntos();
$("#valor_factura").keyup(function(){
Moneda_r($("#valor_factura").attr('id'));
});
$("#valor_factura").blur(function(){
Moneda_r($("#valor_factura").attr('id'));
});
/**/

$('#formulario_formatos').
validate({
submitHandler: function(form){
var valor_ =new String($("#valor_factura").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#valor_factura").val(nuevo_valor);


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
function mostrar_anexos_factura($idformato,$iddoc){
global $conn,$ruta_db_superior;

$anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]>0){
for ($i=0;$i<$anexos["numcampos"];$i++) {
echo "<a href=../../".$anexos[$i]["ruta"].">".html_entity_decode($anexos[$i]["etiqueta"])."</a><br />";
}
} 
}

function validar_digitalizacion_factura_1($idformato,$iddoc)
{global $conn;
//alerta($_REQUEST["digitalizacion"]);
  if($_REQUEST["digitalizacion"]==1){
  	if(@$_REQUEST["iddoc"]){
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  		abrir_url($ruta_db_superior."paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace=".$enlace,'centro');
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=factura_proveedor";
		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=paginaadd.php?key=".$iddoc."&enlace2=".$enlace,'centro');
	}
  }elseif($_REQUEST["digitalizacion"]==2 && $_REQUEST['no_sticker'] == 1){
  	abrir_url($ruta_db_superior."formatos/factura_proveedor/mostrar_factura_proveedor.php?iddoc=".$iddoc."&idformato=".$idformato,'_self');
  }else if($_REQUEST["digitalizacion"]==2){
  	if(@$_REQUEST["iddoc"]){
  		$iddoc=$_REQUEST["iddoc"];
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=factura_proveedor";
	}
  		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,'centro');
  }
} 

function enviar_adicionar_facturas($idformato,$iddoc){
	global $conn;
	if(@$_REQUEST["iddoc"]){
			$enlace="paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=formatos/factura_proveedor/mostrar_factura_proveedor.php?iddoc=".$_REQUEST["iddoc"];

		}
		else{
			$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=factura_proveedor";
		}
		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,"_self");
}

function enlace_item_validacion_factura($idformato,$iddoc){
	global $conn,$ruta_db_superior;
		$dato=busca_filtro_tabla("","ft_factura_proveedor A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
		$item=busca_filtro_tabla("","ft_validacion_factura","ft_factura_proveedor=".$dato[0]['idft_factura_proveedor'],"",$conn);	
		if($_REQUEST['tipo']!=5 && $item['numcampos']==0){
						
				echo '<a href="../validacion_factura/adicionar_validacion_factura.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$dato[0]['idft_factura_proveedor'].'" target="_self">Validacion Factura</a>'; 
		}
}

function mostrar_datos_item_validacion_factura($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	global $conn, $ruta_db_superior;
		
		$tabla='';
		
		$dato=busca_filtro_tabla("","ft_factura_proveedor A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre

		
		if($dato['numcampos']!=0){
								
			$tabla.='
						<table style="width:100%; border-collapse: collapse;" border="1">
						<tbody>
						<tr class="encabezado_list">
							<td>Fecha</td>
							<td>Usuario</td>
							<td>Observaciones</td>
							<td>Correcta</td>
						</tr>
			';
				
				$item=busca_filtro_tabla("","ft_validacion_factura A, ft_factura_proveedor B","idft_factura_proveedor=ft_factura_proveedor and A.ft_factura_proveedor=".$dato[0]['idft_factura_proveedor'],"",$conn);					
			

			if($item['numcampos']!=0){
				
			$correcta=array(1=>"Si",2=>"No");			

			for($j=$item['numcampos']-1;$j>=0;$j--){

	
							$tabla.='		
									<tr>
										<td>'.$item[$j]['fecha_validacion'].'</td>
										<td>'.$item[$j]['usuario_validacion'].'</td>
										<td>'.$item[$j]['observacion_validaci'].'</td>
										<td>'.$correcta[$item[$j]['factura_correcta']].'</td>
									</tr>
									</tbody>
									</table>
							';				
			}	
				echo($tabla);	
			}
		} 

}
?>