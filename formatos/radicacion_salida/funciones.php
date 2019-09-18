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
function mostrar_radicado_salida($idformato,$iddoc){
	
	echo '<td><b>'.muestra_contador("radicacion_salida").'</b></td>';
}
function enviar_adicionar_salida($idformato,$iddoc){
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
	$datos=busca_filtro_tabla("","ft_radicacion_salida A","documento_iddocumento=".$iddoc,"");
	if($datos[0]["estado_radicado"]==1){
		if(@$_REQUEST["iddoc"]){
			$enlace="views/documento/paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=formatos/radicacion_salida/mostrar_radicacion_salida.php?iddoc=".$_REQUEST["iddoc"];

		}
		else{
			$enlace="busqueda_categoria.php?idcategoria_formato=3&defecto=radicacion_salida";
		}
		abrir_url($ruta_db_superior."app/documento/colilla.php?key=".$iddoc."&enlace=".$enlace,"_self");
	}
	else{
		$sql1="UPDATE documento SET estado='INICIADO' WHERE iddocumento=".$iddoc;
		phpmkr_query($sql1);
	}
}
function cambiar_estado_salida($idformato,$iddoc){
	
	$doc=busca_filtro_tabla("A.estado, B.descripcion_salida","documento A, ft_radicacion_salida B","iddocumento=".$iddoc." and A.iddocumento=B.documento_iddocumento","");
	if($doc[0]["estado"]=='INICIADO'){
		$sql1="UPDATE documento SET estado='APROBADO', descripcion='".$doc[0]["descripcion_salida"]."' WHERE iddocumento=".$iddoc;
		phpmkr_query($sql1);
	}
}
function validar_digitalizacion_formato_salida($idformato,$iddoc){
	
	$max_salida=6;
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
if($_REQUEST["digitalizacion"]==1){
  	if(@$_REQUEST["iddoc"]){
  		$enlace="pantallas/buscador_principal.php?idbusqueda=13";
  		abrir_url($ruta_db_superior."app/documento/colilla.php?key=".$_REQUEST["iddoc"]."&enlace=views/documento/paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=".$enlace,'centro');
  		die();
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=3&defecto=radicacion_salida";
		abrir_url($ruta_db_superior."app/documento/colilla.php?key=".$iddoc."&enlace=views/documento/paginaadd.php?key=".$iddoc."&enlace2=".$enlace,'centro');
		die();
	}
    //redirecciona($ruta_db_superior."views/documento/paginaadd.php?&key=".$iddoc."&enlace=".$enlace);
  }
  else if($_REQUEST["digitalizacion"]==2){
  	if(@$_REQUEST["iddoc"]){
  		$iddoc=$_REQUEST["iddoc"];
  		$enlace="pantallas/buscador_principal.php?idbusqueda=13";
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=3&defecto=radicacion_salida";
	}
  		abrir_url($ruta_db_superior."app/documento/colilla.php?key=".$iddoc."&enlace=".$enlace,'centro');
			die();
  }
}
function digitalizacion_formato_salida()
{echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td>
<td><input name='digitalizacion' type='radio' value='1' checked>Si  <input name='digitalizacion' type='radio' value='2' >No</td></tr>";
}//$('#tbox').attr('readonly', false);
function radicado_funcion($idformato,$iddoc){
	
	echo '<td>'.muestra_contador("radicacion_salida").'</td>';	
}
function llenar_datos_funcion_salida($idformato,$iddoc){
	
	$dato=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"");
	if($dato[0]["estado"]=='INICIADO'){
		$texto='';
		$texto.='<a href="editar_radicacion_salida.php?iddoc='.$iddoc.'&idformato='.$idformato.'">Llenar datos</a>';
		echo $texto;
	}
}
function mostrar_mensajeros($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$mensajero=busca_funcionarios("cargo","mensajero");
    $nmensajeros=count($mensajero);
    if($nmensajeros){
        echo('<td><select name="mensajeros" id="mensajeros">');
        for($i=0;$i<$nmensajeros;$i++){
        $dato_mensajero=busca_filtro_tabla("A.idfuncionario,".concatenar_cadena_sql(array("A.nombres","' '","A.apellidos"))." as nombre","funcionario A","A.idfuncionario=".$mensajero[$i],"");
        //redirecciona(implode("-",$dato_mensajero));
        if($dato_mensajero["numcampos"])              
          echo("<option value=".$dato_mensajero[0]["idfuncionario"].">".ucwords(strtolower($dato_mensajero[0]["nombre"]))."</option>");
        }
        echo('</select></td>');
      }
	?>
	<script>
	$(document).ready(function(){
		$("#mensajeros").parent().parent().hide();
		<?php
		if($_REQUEST["iddoc"]!=''){
			$dato=busca_filtro_tabla("","ft_radicacion_salia A","A.documento_iddocumento=".$_REQUEST["iddoc"],"");
			if($dato[0]["tipo_mensajeria"]==2){
				echo '$("#mensajeros").parent().parent().show();';
			}
		}
		?>
		
		$("input[name='tipo_mensajeria']").click(function(){
			if($(this).val()==2){//si es mensajeria interna.
				$("#mensajeros").parent().parent().show();
			}
			else{
				$("#mensajeros").parent().parent().hide();
			}
		});
	});
	</script>
	<?php
}
function registrar_salida($idformato,$iddoc){
	
	if($_REQUEST["iddoc"]!=''){
		$iddoc=$_REQUEST["iddoc"];
	}
	$dato=busca_filtro_tabla("","ft_radicacion_salida A","A.documento_iddocumento=".$iddoc,"");
	$x_tipo_despacho=$dato[0]["tipo_mensajeria"];
	$x_mensajero=$dato[0]["mensajeros"];
	$x_ejecutor=$dato[0]["persona_natural"];
  	if($x_tipo_despacho==2){
		$sql1="INSERT INTO salidas(documento_iddocumento,responsable,tipo_despacho) VALUES(".$iddoc.",".$x_mensajero.",'2')";
    	phpmkr_query($sql1);
  	}	///tipo de despacho personal
  	elseif($x_tipo_despacho==3){
    	$sql1="INSERT INTO salidas(documento_iddocumento,responsable,tipo_despacho) VALUES(".$iddoc.",".$x_ejecutor.",'3')";
    	phpmkr_query($sql1);
  	}
}
function quitar_descripcion_salida($idformato,$iddoc){
	
	?>
	<script>
	if($("#descripcion_salida").val()=="Pendiente por llenar datos"){
		$("#descripcion_salida").val("");
	}
	if($("#persona_natural").val()=="&nbsp;"){
		$("#persona_natural").val("");
	}
	if($("#area_responsable").val()=="&nbsp;"){
		$("#area_responsable").val("");
	}
	</script>
	<?php
}
function obtener_informacion_proveedor_salida($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_radicacion_salida A, datos_ejecutor B, ejecutor C","A.persona_natural=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor AND A.documento_iddocumento=".$iddoc,"");
	
	$texto=array();
	$texto[]="<b>Nombre:</b> ".$datos[0]["nombre"];
	$texto[]="<b>Identificaci&oacute;n:</b> ".$datos[0]["identificacion"];
	$texto[]="<b>Cargo:</b> ".$datos[0]["cargo"];
	$texto[]="<b>Empresa:</b> ".$datos[0]["empresa"];
	$texto[]="<b>Direcci&oacute;n:</b> ".$datos[0]["direccion"];
	$texto[]="<b>Tel&eacute;fono:</b> ".$datos[0]["telefono"];
	$texto[]="<b>Email:</b> ".$datos[0]["email"];
	$texto[]="<b>Titulo:</b> ".$datos[0]["titulo"];
	$ciudad=busca_filtro_tabla("A.nombre","municipio A","A.idmunicipio=".$datos[0]["ciudad"],"");
	$texto[]="<b>Ciudad:</b> ".$ciudad[0]["nombre"];
	
	echo(implode("<br />",$texto));
}
?>