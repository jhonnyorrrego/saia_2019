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

//ADICIONAR - EDITAR
//******************
/*function cargar_fecha_limite_respuesta($idformato,$iddoc){
	global $conn;
	$fecha_ochodias=date("Y-m-d",strtotime ('+8 day',strtotime(date("Y-m-d"))));
	echo($fecha." ".$fecha2);
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var fecha_masocho_dias="<?php echo($fecha_ochodias);?>";
			$("#tiempo_respuesta").val(fecha_masocho_dias);			
		});
	</script>
<?php
}*/

function mostrar_radicado_entrada($idformato,$iddoc){
	global $conn;
	if($_REQUEST["iddoc"]){
		$doc=busca_filtro_tabla("","documento a","iddocumento=".$_REQUEST["iddoc"],"",$conn);
		echo '<td><b id="numero_radicado">'.$doc[0]["numero"].'</b></td>'; 
	}
	else
		echo '<td><b id="numero_radicado">'.muestra_contador("radicacion_entrada").'</b></td>';
}
function enviar_adicionar($idformato,$iddoc){
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
	if(is_file($ruta."db.php"))
	{
	$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
	}
	$datos=busca_filtro_tabla("","ft_radicacion_entrada A","documento_iddocumento=".$iddoc,"",$conn);
	if($datos[0]["estado_radicado"]==1){
		if(@$_REQUEST["iddoc"]){
			$enlace="paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=formatos/radicacion_entrada/mostrar_radicacion_entrada.php?iddoc=".$_REQUEST["iddoc"];

		}
		else{
			$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=radicacion_entrada";
		}
		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,"_self");
	}
	else{
		$sql1="UPDATE documento SET estado='INICIADO' WHERE iddocumento=".$iddoc;
		phpmkr_query($sql1);
	}
}
function cambiar_estado($idformato,$iddoc){
	global $conn;
	$doc=busca_filtro_tabla("","documento A","iddocumento=".$iddoc,"",$conn);
	if($doc[0]["estado"]=='INICIADO'){
		$sql1="UPDATE documento SET estado='APROBADO' WHERE iddocumento=".$iddoc;
		phpmkr_query($sql1);
	}
}
function validar_digitalizacion_formato_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;

  if($_REQUEST["digitalizacion"]==1){
  	if(@$_REQUEST["iddoc"]){
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  		//abrir_url($ruta_db_superior."colilla.php?key=".$_REQUEST["iddoc"]."&enlace=paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=".$enlace,'_self');
  		abrir_url($ruta_db_superior."paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace=".$enlace,'centro');
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=radicacion_entrada";
		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=paginaadd.php?key=".$iddoc."&enlace2=".$enlace,'centro');
	}
    //redirecciona($ruta_db_superior."paginaadd.php?&key=".$iddoc."&enlace=".$enlace);
  }elseif($_REQUEST["digitalizacion"]==2 && $_REQUEST['no_sticker'] == 1){
  	abrir_url($ruta_db_superior."formatos/radicacion_entrada/mostrar_radicacion_entrada.php?iddoc=".$iddoc."&idformato=".$idformato,'_self');
  }else if($_REQUEST["digitalizacion"]==2){
  	if(@$_REQUEST["iddoc"]){
  		$iddoc=$_REQUEST["iddoc"];
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=radicacion_entrada";
	}
  		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,'centro');
  }
}
function digitalizar_formato_radicacion($idformato,$iddoc){
	global $conn;
  echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td><td><input name='digitalizacion' type='radio' value='1' checked>Si  <input name='digitalizacion' type='radio' value='2'>No</td></tr>";
}
function actualizar_campos_documento($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_radicacion_entrada A","A.documento_iddocumento=".$iddoc,"",$conn);
	$campo_formato=busca_filtro_tabla("A.valor","campos_formato A","A.formato_idformato=".$idformato." AND A.nombre='anexos_fisicos'","",$conn);
	$filas=explode(";",$campo_formato[0]["valor"]);
	$cant1=count($filas);
	$valores=array();
	for($i=0;$i<$cant1;$i++){
		$datos2=explode(",",$filas[$i]);
		$valores[$datos2[0]]=$datos2[1];
	}
	$ejecutor=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND iddatos_ejecutor=".$datos[0]["persona_natural"],"",$conn);
	$sql1="UPDATE documento SET oficio='".$datos[0]["numero_oficio"]."', anexo='".$valores[$datos[0]["anexos_fisicos"]]."', descripcion_anexo='".$datos[0]["descripcion_anexos"]."', fecha_oficio=".fecha_db_almacenar($datos[0]["fecha_oficio_entrada"],'Y-m-d H:i:s').", municipio_idmunicipio='".$ejecutor[0]["ciudad"]."' WHERE iddocumento=".$iddoc;
	phpmkr_query($sql1);
}
function vincular_flujo($idformato,$iddoc){
global $conn;
actualizar_campos_documento($idformato,$iddoc);
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
include_once($ruta_db_superior."workflow/libreria_paso.php");
$datos=busca_filtro_tabla("","ft_radicacion_entrada A, documento B","documento_iddocumento=iddocumento AND documento_iddocumento=".$iddoc,"",$conn);
//print_r($datos);
if($datos[0]["estado"]=='APROBADO'){
	
	$paso_documento=busca_filtro_tabla("","paso_documento A","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
	if($paso_documento["numcampos"]){
		terminar_actividad_paso($iddoc,'',2,$paso_documento[0]["idpaso_documento"],2);
	}
}
}
function llenar_datos_funcion($idformato,$iddoc){
	global $conn;
	$dato=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	if($dato[0]["estado"]=='INICIADO'){
		$texto='';
		$texto.='<a href="editar_radicacion_entrada.php?no_sticker=1&iddoc='.$iddoc.'&idformato='.$idformato.'">Llenar datos</a>';
		echo $texto;
	}
}
function quitar_descripcion_entrada($idformato,$iddoc){
	global $conn;
	?>
	<script>
	if($("#descripcion").val()=="Pendiente por llenar datos"){
		$("#descripcion").val("");
	}
	if($("#persona_natural").val()=="&nbsp;"){
		$("#persona_natural").val("");
	}
	if($("#destino").val()=="&nbsp;"){
		$("#destino").val("");
	}
	if($("#copia_a").val()=="&nbsp;"){
		$("#copia_a").val("");
	}
	$('#formulario_formatos').validate({
            submitHandler: function(form){
                var fecha = $("#fecha_oficio_entrada").val().split(" ");
				var f = new Date();
				var dia=f.getDate();
				var mes=(f.getMonth() +1);
				if(dia<10){
					dia='0'+dia;
				}
				if(mes<10){
					mes='0'+mes;
				}
				var fecha2=f.getFullYear() + "-" + mes + "-" + dia;
				
				//alert(fecha[0]+' > '+fecha2);
				if(fecha[0]>fecha2){
					$("#fecha_oficio_entrada").after("<font color='red'>La fecha es mayor a la de hoy</font>");
					$("#fecha_oficio_entrada").focus();
					$('#continuar').css('display','inherit');						
					$('#continuar').next('input').hide();						
					return false;
				}
				var destinos=$("#destino").val();
				$.post("contar_funcionarios.php",{destino:destinos},function(respuesta){
					if(respuesta==1){
						var confirmacion=confirm("Esta seguro de transferir el documento a las personas seleccionadas?");
						if(!confirmacion)return false;
					}
					form.submit();
				});
            }        
        });
	</script>
	<?php
}
function validar_sticker($idformato, $iddoc){
	if($_REQUEST['no_sticker']){
		echo('<input type="text" id="no_sticker" name="no_sticker" value="1"></td>');
	}
}
function imagenes_digitalizadas_funcion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	$paginas=busca_filtro_tabla("","pagina a","id_documento=".$iddoc,"consecutivo asc",$conn);
	if($paginas["numcampos"]){
		$tabla='';
		$tabla.='<table>';
		$tabla.='<tr>';
		for($i=0;$i<$paginas["numcampos"];$i++){
			$tabla.='<td><a class="previo_high" enlace="'.$paginas[$i]["consecutivo"].'" tipo="pagina"><img border="1px" style="border-collapse:collapse" src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$paginas[$i]["imagen"].'"></a></td>';
			if(($i%4)==0&&$i<>0)$tabla.='</tr><tr>';
		}
		$tabla.='</tr>';
		$tabla.='</table>';
		echo $tabla;
	}
	$anexos=busca_filtro_tabla("","anexos a","documento_iddocumento=".$iddoc." AND tipo in('jpg','png','gif')","",$conn);
	if($anexos["numcampos"]){
		$tabla='';
		
		$tabla.='<table>';
		$tabla.='<tr>';
		for($i=0;$i<$anexos["numcampos"];$i++){
			if($_REQUEST['carga_highslide']){				
			}else{
				$tabla.='<td><a class="previo_high" enlace="'.$anexos[$i]["ruta"].'" tipo="anexo"><img border="1px" style="border-collapse:collapse" width="90px" height="80px" src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$anexos[$i]["ruta"].'"></a></td>';
			if(($i%4)==0&&$i<>0)$tabla.='</tr><tr>';
			}
			
		}
		$tabla.='</tr>';
		$tabla.='</table>';
		echo $tabla;
	}
	if($_REQUEST["tipo"]!=5){
		?>
		<script>
		$(document).ready(function(){
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				var tipo=$(this).attr("tipo");
				if(tipo=='anexo'){
					top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				}else if(tipo=='pagina'){
					top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:'pantallas/documento/pagina_documento.php?idpagina='+enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				}
			});
		});
		</script>
		<?php
	}
}
function obtener_informacion_proveedor($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_radicacion_entrada A, datos_ejecutor B, ejecutor C","A.persona_natural=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$texto=array();
	$texto[]="<b>Nombre:</b> ".$datos[0]["nombre"];
	$texto[]="<b>Identificaci&oacute;n:</b> ".$datos[0]["identificacion"];
	$texto[]="<b>Cargo:</b> ".$datos[0]["cargo"];
	$texto[]="<b>Empresa:</b> ".$datos[0]["empresa"];
	$texto[]="<b>Direcci&oacute;n:</b> ".$datos[0]["direccion"];
	$texto[]="<b>Tel&eacute;fono:</b> ".$datos[0]["telefono"];
	$texto[]="<b>Email:</b> ".$datos[0]["email"];
	$texto[]="<b>Titulo:</b> ".$datos[0]["titulo"];
	$ciudad=busca_filtro_tabla("A.nombre","municipio A","A.idmunicipio=".$datos[0]["ciudad"],"",$conn);
	$texto[]="<b>Ciudad:</b> ".$ciudad[0]["nombre"];
	
	echo(implode("<br />",$texto));
}
function transferir_con_copia($idformato,$iddoc){
	global $conn;
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
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
	transferencia_automatica($idformato,$iddoc,"copia_a",2,'','COPIA');
}

function tipo_radicado_radicacion($idformato,$iddoc){//en el adicionar
	global $conn,$ruta_db_superior;
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("","vfuncionario_dc a","estado_dc=1 AND a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    ?>
        <script>
            $(document).ready(function(){
                $('#fecha_oficio_entrada').addClass('required');
                $('#destino').addClass('required');
                $('#persona_natural').addClass('required');
                $('#destino').addClass('required');
                $('#tr_tipo_destino').hide(); 
                
                tree_area_responsable.setOnLoadingEnd(chekeararbol);
                $('#area_responsable').parent().parent().hide();
                $('#persona_natural_dest').parent().parent().hide();
                $('#tr_tipo_mensajeria').hide();
                $('#tipo_mensajeria0').parent().hide();
                
                $('[name="tipo_origen"]').click(function(){
                
                    var tipo=$(this).val();
                    if(tipo==1){
                        $('[name="tipo_radicado"]').val('radicacion_entrada');
                        
                        $('#area_responsable').parent().parent().hide();
                        $('#area_responsable').removeClass('required');
                        $('#destino').addClass('required');
                        $('#tr_tipo_destino').hide();
                        $('input:radio[name="tipo_destino"]').filter('[value="2"]').attr('checked', true);
                        $('#destino').parent().parent().show();
                        $('#copia_a').parent().parent().show();
                        $('#persona_natural_dest').parent().parent().hide();
                        $('#persona_natural_dest').removeClass('required');
                        $('#tr_tipo_mensajeria').hide();
                        $('[name="tipo_mensajeria"]').removeClass('required');
                        
                        $('#fecha_oficio_entrada').addClass('required');
                        $('#fecha_oficio_entrada').parent().parent().parent().show();
                        $('#numero_oficio').parent().parent().show();
                        $('#persona_natural').addClass('required');
                        $('#persona_natural').parent().parent().show();
                        $('#anexos_digitales').parent().parent().show();
                        
                    }else{
                        $('[name="tipo_radicado"]').val('radicacion_salida');
                        
                        $('#area_responsable').parent().parent().show();
                        $('#area_responsable').addClass('required');
                        $('#tr_tipo_destino').show();
                        
                        $('#fecha_oficio_entrada').removeClass('required');
                        $('#fecha_oficio_entrada').parent().parent().parent().hide();
                        $('#numero_oficio').parent().parent().hide();
                        $('#persona_natural').removeClass('required');
                        $('#persona_natural').parent().parent().hide();
                        $('#anexos_digitales').parent().parent().hide();
                        $('#tr_tipo_mensajeria').show();
                        $('[name="tipo_mensajeria"]').addClass('required');
                        
                    }
                    $.ajax({ 
                        type:'POST',
                        dataType: 'json',
                        url: "tipo_contador.php",
                        data: {
                                        tipo_radicacion:tipo
                        },
                        success: function(datos){
                            
                            $('#numero_radicado').html(datos[0]);
                            
                        }
                    });
                });
                
                $('[name="tipo_destino"]').click(function(){
                    var tipo=$(this).val();
                    if(tipo==1){
                        $('#destino').removeClass('required');
                        $('#destino').parent().parent().hide();
                        $('#copia_a').parent().parent().hide();
                        $('#persona_natural_dest').parent().parent().show();
                        $('#persona_natural_dest').addClass('required');
                        $('#tipo_mensajeria0').parent().show();
                    }else{
                        $('#destino').addClass('required');
                        $('#destino').parent().parent().show();
                        $('#copia_a').parent().parent().show();
                        $('#persona_natural_dest').parent().parent().hide();
                        $('#persona_natural_dest').removeClass('required');
                        $('#tipo_mensajeria0').parent().hide();
                    }
                });
            });
            function chekeararbol(){
                tree_area_responsable.setCheck('<?php echo $cargo[0]["iddependencia_cargo"];?>',true);
                $('#area_responsable').val(<?php echo $cargo[0]["iddependencia_cargo"];?>);
            }
        </script>
    <?php
}

function ingresar_item_destino_radicacion($idformato,$iddoc){//posterior al adicionar
	global $conn,$ruta_db_superior;
	$padre=busca_filtro_tabla("","ft_radicacion_entrada A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
	$item=busca_filtro_tabla("","ft_destino_radicacion","ft_radicacion_entrada=".$padre[0]["idft_radicacion_entrada"],"",$conn);
	if ($item['numcampos']==0) {
		if($padre[0]['tipo_destino']==1){
		    $campo="persona_natural_dest";
		}else{
		    $campo="destino";
		}
		    $destino=explode(",",$padre[0]["$campo"]);
		    for($i=0; $i < (count($destino)); $i++){
		        $cadena='INSERT INTO ft_destino_radicacion (ft_radicacion_entrada,nombre_destino, nombre_origen, tipo_origen, tipo_destino) VALUES ('.$padre[0]['idft_radicacion_entrada'].','.$destino[$i].', '.$padre[0]['ejecutor'].', '.$padre[0]['tipo_origen'].', '.$padre[0]['tipo_destino'].')';
		        phpmkr_query($cadena);
		    }
		    
	}
}


function mostrar_item_destino_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$padre=busca_filtro_tabla("","ft_radicacion_entrada A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
	$datos=busca_filtro_tabla("","ft_destino_radicacion","ft_radicacion_entrada=".$padre[0]["idft_radicacion_entrada"],"",$conn);

	if($padre[0]['despachado']==0){
    	$tabla='<form id="item_prerequisitos" action="actualizar_item_destino_radicacion.php"><table class="table-bordered adicionar_campo" style="width: 95%; font-size:10px; text-align:center;" border="1">
    	<tr class="encabezado_list">
        	<th>NOMBRE ORIGEN</th>
        	<th>NOMBRE DESTINO</th>
       		<th>CARGO</th>
        	<th>UBICACION</th>
        	<th>OBSERVACIONES</th>
      	</tr>
    	';
    	for ($i=0; $i < $datos['numcampos']; $i++) {
    	    $origen=busca_filtro_tabla("a.nombres, a.apellidos","funcionario a","a.funcionario_codigo=".$datos[$i]['nombre_origen'],"",$conn);
    	    if($datos[$i]['tipo_destino']==1){
    	        $destino=busca_filtro_tabla("b.nombre, a.cargo","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[$i]['nombre_destino'],"",$conn);
    	        $ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$destino[0]['ciudad'],"",$conn);
    	        $ubicacion=$ciudad[0]['nombre'].' '.$destino[0]['direccion'];
    	    }else{
    	        $destino=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre, cargo, dependencia","vfuncionario_dc","iddependencia_cargo=".$datos[$i]['nombre_destino'],"",$conn);
    	        $ubicacion=$destino[0]['dependencia'];
    	    }
    	    
    	    $tabla.="
    	        <tr>
    	            <td>".$origen[0]['nombres']." ".$origen[0]['apellidos']."</td>
    	            <td>".$destino[0]['nombre']."</td>
    	            <td>".$destino[0]['cargo']."</td>
    	            <td></td>
    	            <td></td>
    	        </tr>
    	    
    	    ";
    	}
	}
	
	
	
	echo $tabla;
	
}
?>