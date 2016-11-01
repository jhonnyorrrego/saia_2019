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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php");

//ini_set("display_errors",true);
//ADICIONAR - EDITAR
//******************
function cargar_fecha_limite_respuesta($idformato,$iddoc){
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
}

function mostrar_radicado_entrada($idformato,$iddoc){
	global $conn;
	$fecha=date('Y-m-d');
	if($_REQUEST["iddoc"]){
		$doc=busca_filtro_tabla("","documento a","iddocumento=".$_REQUEST["iddoc"],"",$conn);
		echo '<td id="numero_radicado"><b>'.$doc[0]["numero"].'</b></td>'; 
	}
	else
		echo '<td id="numero_radicado">'.$fecha."-<b>".muestra_contador("radicacion_entrada").'</b>-E</td>';
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
			$enlace="paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=formatos/radicacion_entrada/detalles_mostrar_radicacion_entrada.php?iddoc=".$_REQUEST["iddoc"];

		}
		else{
			$enlace=$ruta_db_superior."formatos/radicacion_entrada/detalles_mostrar_radicacion_entrada.php?iddoc=".$iddoc."&idformato=".$idformato;
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
		$enlace=$ruta_db_superior."formatos/radicacion_entrada/detalles_mostrar_radicacion_entrada.php?iddoc=".$iddoc."&idformato=".$idformato;
	}
  		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,'centro');
  		//abrir_url($ruta_db_superior."colilla.php?key=".$iddoc,"_self");
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
	    $sql="UPDATE ft_radicacion_entrada SET tipo_origen=".$dato[0]['tipo_radicado']." WHERE documento_iddocumento=".$iddoc;
	    phpmkr_query($sql);
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
	
	$tipo_origen=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);
	
	if($tipo_origen[0]['tipo_origen']==1){
	    $datos=busca_filtro_tabla("","ft_radicacion_entrada A, datos_ejecutor B, ejecutor C","A.persona_natural=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$texto=array();
	$texto[]="<b>Nombre:</b> ".$datos[0]["nombre"];
	$texto[]="<b>Identificaci&oacute;n:</b> ".$datos[0]["identificacion"];
	$texto[]="<b>Cargo:</b> ".$datos[0]["cargo"];
	$texto[]="<b>Empresa:</b> ".$datos[0]["empresa"];
	//$texto[]="<b>Direcci&oacute;n:</b> ".$datos[0]["direccion"];
	//$texto[]="<b>Tel&eacute;fono:</b> ".$datos[0]["telefono"];
	//$texto[]="<b>Email:</b> ".$datos[0]["email"];
	//$texto[]="<b>Titulo:</b> ".$datos[0]["titulo"];
	//$ciudad=busca_filtro_tabla("A.nombre","municipio A","A.idmunicipio=".$datos[0]["ciudad"],"",$conn);
	//$texto[]="<b>Ciudad:</b> ".$ciudad[0]["nombre"];
	
	echo(implode(", &nbsp;",$texto));
	}else{
	    $origen=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre, dependencia, cargo","vfuncionario_dc","iddependencia_cargo IN(".$tipo_origen[0]['area_responsable'].")","",$conn);
	    $texto=array();
	$texto[]="<b>Nombre:</b> ".$origen[0]["nombre"];
	$texto[]="<b>Dependencia:</b> ".$origen[0]["dependencia"];
	$texto[]="<b>Cargo:</b> ".$origen[0]["cargo"];
	echo(implode("<br />",$texto));
	}
	
	
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
    $cargo=busca_filtro_tabla("iddependencia,iddependencia_cargo","vfuncionario_dc a","estado_dc=1 AND a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    
	$dependencia_principal=buscar_dependencias_principal($cargo[0]["iddependencia"]);

	?>
        <script>
            $(document).ready(function(){
                var dependencia_principal='<?php echo($dependencia_principal); ?>';
                 
                
                
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
                        //$('#anexos_digitales').parent().parent().show();
                        
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
                        //$('#anexos_digitales').parent().parent().hide();
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
    if($_REQUEST['tipo']!=5 && $padre[0]['despachado']!=1){
						
				echo '<a href="../destino_radicacion/adicionar_destino_radicacion.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$padre[0]['idft_radicacion_entrada'].'" target="_self">Adicionar destino</a>'; //
		}
	if($padre[0]['despachado']==0){
    	$tabla='<form id="item_prerequisitos" action="actualizar_item_destino_radicacion.php"><table class="table table-bordered adicionar_campo" style="width: 100%; font-size:10px; text-align:left;" border="1">
    	<tr>
        	<th style="text-align:center;">Nombre origen</th>
        	<th style="text-align:center;">Nombre destino</th>
       		<th style="text-align:center;">Cargo</th>
        	<th style="text-align:center;">Ubicación</th>
        	<th style="text-align:center;">Observaciones</th>
      	</tr>
    	';
    	for ($i=0; $i < $datos['numcampos']; $i++) {
    	    $origen=busca_filtro_tabla("a.nombres, a.apellidos","funcionario a","a.funcionario_codigo=".$datos[$i]['nombre_origen'],"",$conn);
    	    if($datos[$i]['tipo_destino']==1){
    	        $destino=busca_filtro_tabla("b.nombre, a.cargo , a.ciudad, a.direccion","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[$i]['nombre_destino'],"",$conn);
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
    	            <td style='text-align:center;'>".$destino[0]['cargo']."</td>
    	            <td style='text-align:center;'>".$ubicacion."</td>
    	            <td><textarea name='observaciones[]'>".$padre[0]['descripcion_anexos']."</textarea></td>
    	            <input type='hidden' id='id_".$datos[$i]['idft_destino_radicacion']."' value='".$datos[$i]['idft_destino_radicacion']."' name='id[]'/>
    	        </tr>
    	    ";
    	    
    	}
    	$tabla.="</table><br/>
    	       <input type='hidden' name='iddoc' value='$iddoc'/>
    	       <input style='float:right;' type='submit' value='Confirmar datos de distribución'/>
    	       </form>
    	";
	}else{
	    $tabla='<table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">
    	<tr>
        	<th style="text-align:center;">Nombre origen</th>
        	<th style="text-align:center;">Nombre destino</th>
       		<th style="text-align:center;">Cargo</th>
        	<th style="text-align:center;">Ubicación</th>
        	<th style="text-align:center;">Observaciones</th>
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
    	            <td style='text-align:center;'>".$destino[0]['cargo']."</td>
    	            <td style='text-align:center;'>".$ubicacion."</td>
    	            <td>".$datos[$i]['observacion_destino']."</td>
    	        </tr>
    	    ";
    	    
    	}
    	$tabla.="</table><br/>";
	}
	
	
	
	echo $tabla;
	
}

function mostrar_destino_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);
	$nombres="";
	if($datos[0]['tipo_destino']==1){
    	        $destino=busca_filtro_tabla("b.nombre","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor IN(".$datos[0]['persona_natural_dest'].")","",$conn);
    	        
    	    }else{
    	        $destino=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo IN(".$datos[0]['destino'].")","",$conn);
    	        
    	    }
    	    for($i=0; $i < $destino['numcampos']; $i++) {
    	            $nombres.=$destino[$i]['nombre'].'</br>';
    	        }
    	    return $nombres;
}

function campos_adicionales_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
    
    $datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);
    $tabla='<table class="table-bordered" style="width: 100%; border-collapse: collapse; font-size: 7pt;" border="1">';
    
    
    $tabla.='</table>';
    echo $tabla;
}

function campos_numericos_radicacion_correspondencia($idformato,$iddoc){
	global $conn,$ruta_db_superior;
    	?>
<script>
$('#numero_folios').keyup(function(){
    var valor=$(this).val();
    valor=valor.replace(/[^0-9]/g, '');
    $(this).val(valor);

});

function cargar_puntos(){
Moneda_r($("#numero_folios").attr('id'));

}

cargar_puntos();
$("#numero_folios").keyup(function(){
Moneda_r($("#numero_folios").attr('id'));
});
$("#numero_folios").blur(function(){
Moneda_r($("#numero_folios").attr('id'));
});
/**/

$('#form1').
validate({
submitHandler: function(form){
var valor_ =new String($("#numero_folios").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#numero_folios").val(nuevo_valor);


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

function mostrar_informacion_general_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$fecha_radicacion=mostrar_fecha($idformato,$iddoc,$tipo=1);
	$numero_radicado=formato_numero($idformato,$iddoc,$tipo=1);
	$datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);
	$tipo_documento=busca_filtro_tabla("nombre","serie","idserie=".$datos[0]["serie_idserie"],"",$conn);
	$anexos=busca_filtro_tabla("etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
	$nombre_anexos='';
	for ($i=0; $i < $anexos['numcampos']; $i++) {
	    $nombre_anexos.=$anexos[$i]['etiqueta'];
		if($i < $anexos['numcampos']-1){
			$nombre_anexos.=', ';
		}
	}
	
	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
		if($codigo_qr['numcampos']){
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"  />';
		}else{
			generar_codigo_qr_carta($idformato,$iddoc);
			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';
		}
		//echo($img);
	}
	
    $tabla='
        <table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">
  <tr>
    <td style="width: 25%;"><b>Fecha de radicación:</b></td>
    <td style="width: 20%;">'.$fecha_radicacion.'</td>
    <td style="width: 20%;"><b>Número de radicado:</b></td>
    <td style="width: 20%;">'.$numero_radicado.'</td>
    <td style="text-align:center; " colspan="2" rowspan="3">'.$img.'</td>
  </tr>
  <tr>
    <td><b>Tipo de documento:</b></td>
    <td colspan="3">'.$tipo_documento[0]["nombre"].'</td> 
  </tr>
  <tr>
    <td><b>Descripción o asunto:</b></td>
    <td colspan="3">'.$datos[0]["descripcion"].'</td>
  </tr>
  <tr>
    <td><b>Descripción de anexos físicos:</b></td>
    <td colspan="5">'.$datos[0]["descripcion_anexos"].'</td>
  </tr>
  <tr>
    <td><b>Anexos digitales:</b></td>
    <td colspan="2">'.$nombre_anexos.'</td>
    <td><b>No. Folios:</b></td>
    <td colspan="2">'.$datos[0]["numero_folios"].'</td>
  </tr>

    ';
    if($datos[0]['tipo_origen']==1){
        $tabla.="<tr>
                    <td><strong>Número de documento:</strong></td>
                    <td colspan='2'>".$datos[0]['numero_oficio']."</td>
                    <td><strong>Fecha oficio entrante:</strong></td>
                    <td colspan='2'>".$datos[0]['fecha_oficio_entrada']."</td>
                 </tr>";
    }
    $tabla.='</table>';
    echo $tabla;
    
}

function mostrar_informacion_destino_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
    
    $tipo_destino=array(1=>"EXTERNO",2=>"INTERNO");
	$datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);
	$destino=mostrar_destino_radicacion($idformato,$iddoc);
    $tabla='
        <table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">
  <tr>
    <td style="width: 25%;"><b>Tipo de Destino:</b></td>
    <td>'.$tipo_destino[$datos[0]['tipo_destino']].'</td>
  </tr>
  <tr>
    <td><b>Destino:</b></td>
    <td>'.$destino.'</td>
  </tr>
    ';
    if($datos[0]['tipo_destino']==2){
        $datos_copia="";
        $copia=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo IN(".$datos[0]['copia_a'].")","",$conn);
        
        for($i=0; $i < $copia['numcampos']; $i++) {
            $datos_copia.=$copia[$i]['nombre']."</br>";
        }
        $tabla.='
            <tr>
                <td><b>Copia a:</b></td>
                <td>'.$datos_copia.'</td>
            </tr>
        ';
    }
    
    $tabla.='</table>';
    echo $tabla;
    
}

function datos_editar_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
    if($datos[0]['tipo_origen']==1){
        ?>
                <script>
                    $(document).ready(function(){
                        $('#tipo_origen1').parent().hide();
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
                    });
                </script>
        <?php
    }else{
        ?>
                    <script>        
                        $('#tipo_origen0').parent().hide();
                        
                        $('#area_responsable').parent().parent().show();
                        $('#area_responsable').addClass('required');
                        $('#tr_tipo_destino').show();
                        
                        $('#fecha_oficio_entrada').removeClass('required');
                        $('#fecha_oficio_entrada').parent().parent().parent().hide();
                        $('#numero_oficio').parent().parent().hide();
                        $('#persona_natural').removeClass('required');
                        $('#persona_natural').parent().parent().hide();
                        //$('#anexos_digitales').parent().parent().hide();
                        $('#tr_tipo_mensajeria').show();
                        $('[name="tipo_mensajeria"]').addClass('required');
                    </script>
        <?php
    }
    ?>
        <script>
            $(document).ready(function(){
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
        </script>
    <?php
}
function buscar_dependencias_principal($iddependencia){
	$cod_dep=busca_filtro_tabla("cod_padre","dependencia","cod_padre is not null and iddependencia=".$iddependencia,"",$conn);
	
	if($cod_dep['numcampos']){
	    return(buscar_dependencias_principal($cod_dep[0]["cod_padre"]));
	}else{
		return($iddependencia);
	}
}
function serie_documental_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$dependencia_actual=busca_filtro_tabla("iddependencia","vfuncionario_dc","estado_dep=1 AND estado_dc=1 AND funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	$dependencia_principal=buscar_dependencias_principal($dependencia_actual[0]["iddependencia"]);
	$primeros_hijos=busca_filtro_tabla("iddependencia","dependencia","cod_padre=".$dependencia_principal,"",$conn);
	
	for($i=0;$i<$primeros_hijos['numcampos'];$i++){
	    $arreglo[]=$primeros_hijos[$i]['iddependencia'];
	}
	$cargo='"'.implode('","',$arreglo).'"';
	?>
	<script>
	$(document).ready(function(){
	    var dependencia_principal='<?php echo($dependencia_principal); ?>';
	    tree_serie_idserie.setOnLoadingEnd(cargar_arbol());
                function cargar_arbol(){
                setTimeout(function(){  
                    tree_serie_idserie.deleteChildItems(0); 
                    tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&admin=1&dependencia=38&mostrar_nodos=dsa&sin_padre_dependencia=1&solo_dependencias=1&carga_partes_serie=1");
                }, 1000);
                }
	    var cargado=[<?php echo($cargo); ?>];
	    cargado.push(dependencia_principal);

	    //Busca las dependencias del rol actual para que no carguen duplicados en la recursion del abrol de series
	    $.ajax({
	        type:'POST',
            dataType: 'json',
            url: "ajax_serie.php",
            data:{rol:$('#dependencia').val()},
            async: false,
            success: function(datos){
                for (var i=1; i<datos.length; i++){
                    cargado.push(datos[i]);
                 }
            }
        });
	    tree_destino.setOnCheckHandler(onNodeSelect);
	    
        function onNodeSelect(nodeId){
	        var numeral=nodeId.indexOf("#");
	        
	        
	        if(numeral>=0){
	            var padre=tree_destino.getParentId(nodeId);
	            padre=padre.replace("#","");
	            var dependencia=nodeId.replace("#","");
	        }else{
	            
	            
	            var dependencia=tree_destino.getParentId(nodeId);
	            var padre=tree_destino.getParentId(dependencia);
	            
	            if(padre==0){
	                padre=dependencia;
	            }
	            
	            padre=padre.replace("#","");
	            dependencia=dependencia.replace("#","");
	        }
	        alert(padre);
	       if(padre==0){
	           
	       }else{
	           tree_serie_idserie.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&mostrar_nodos=dsa&sin_padre_dependencia=1&cargar_series=1&carga_partes_serie=1&iddependencia="+dependencia);
	           tree_serie_idserie.smartRefreshItem("d"+padre);  
	       }
	        
	        

        }
        
        $('#tipo_origen1').click(function(){
//tree_serie_idserie.deleteChildItems(0); 
  //                  tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_serie_funcionario2.php?tabla=dependencia&admin=1&dependencia=38&sin_padre=1");
    //                tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_serie_funcionario2.php?tabla=dependencia&admin=1&sin_padre=1&uid=1477409126024&id=d"+dependencia_principal);
                    
                    var dependencia=$('#dependencia').val();
                tree_serie_idserie.setOnLoadingEnd(obtener_dependencia(dependencia));
                
                function obtener_dependencia(rol){
                    $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "obtener_dependencia.php",
                        data: {
                                        iddependencia_cargo:rol
                        },
                        async: false,
                        success: function(datos){
                            //alert(datos[1]);
                            var x = Math.floor((Math.random() * 100000) + 1);
                   //         tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_serie_funcionario2.php?tabla=dependencia&admin=1&dependencia="+datos[1]+"&sin_padre=1&uid="+x+"&id=d"+datos[2]);
                            cargado.push(datos[1]);
                        }
                    });  
                }
        });
        
        $('#tipo_origen0').click(function(){
          //  tree_serie_idserie.deleteChildItems(0); 
            //tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_serie_funcionario2.php?tabla=dependencia&admin=1&dependencia=38&sin_padre=1");
            //tree_serie_idserie.loadXML("<?php echo($ruta_db_superior); ?>test_serie_funcionario2.php?tabla=dependencia&admin=1&sin_padre=1&uid=1477409126024&id=d"+dependencia_principal);
        });
        
	});
        
    </script>
    <?php
}
    
?>