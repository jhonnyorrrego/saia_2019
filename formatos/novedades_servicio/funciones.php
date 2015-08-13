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
//**************************
function fecha_disabled($idformato,$iddoc){
	echo "<td><input type='text' value='".date('Y-m-d')."'  readonly></td>";
	//dejar por defecto NO en MOSTRAR ENCABEZADO:
	echo "<script>
		$( document ).ready(function() {  
	$('#eno').attr('checked',true); 
		});
	</script>";
}

function carga_asunto_novedad_servicio($idformato,$iddoc){
	global $conn;
	//Busco primero el iddoc del papa anterior
	$iddoc_recepcion=busca_filtro_tabla("A.idformato, A.nombre","formato A, documento B","lower(A.nombre) like lower(B.plantilla) AND B.iddocumento=".$_REQUEST['anterior'],"",$conn);
	//Busco el iddoc del papa que necesito
  $doc_padre=buscar_papa_formato($iddoc_recepcion[0]['idformato'],$_REQUEST['anterior'],"ft_radica_doc_mercantil");
	
	$datos_recepcion=busca_filtro_tabla("A.numero","documento A","A.iddocumento=".$doc_padre,"",$conn);
	//print_r($datos_recepcion);
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var asunto="REMISION DE NOVEDADES DE AFILIACION SOLICITUD No. <?php echo($datos_recepcion[0]['numero'])?>";
			$("#asunto").attr("value",asunto);
		});
	</script>
<?php
}

//MOSTRAR
//*************************
function mostrar_asunto_carta($idformato,$iddoc){
	global $conn;	
	$datos_asunto=busca_filtro_tabla("A.asunto","ft_novedades_servicio A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	$temporal_asunto=strtolower($datos_asunto[0]['asunto']);
	$asunto=ucfirst($temporal_asunto);//Primera letra en mayuscula.
	echo $asunto;	
}

function tamanio_texto_anexos($idformato,$iddoc){
	global $conn;
	if(@$_REQUEST['tipo']!=5){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("table tbody tr td a font").css("font-size","12pt");
			});
		</script>
	<?php		
	}
}

function mostrar_copias_comunicacion($idformato,$iddoc=NULL){
	global $conn;
	$datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
	$inf_memorando=busca_filtro_tabla("copia,copiainterna,vercopiainterna",$datos[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
	
	if($inf_memorando[0][0]<>""){
		echo '<span>Copia: ';
		$destinos=explode(",",$inf_memorando[0][0]);
		$destinos=array_unique($destinos);
		sort($destinos);
		$lista=array();
		for($i=0;$i<count($destinos);$i++){
			$ejecutores=busca_filtro_tabla("nombre,cargo","ejecutor e,datos_ejecutor de","de.ejecutor_idejecutor=e.idejecutor and iddatos_ejecutor=".$destinos[$i],"",$conn);
			if($ejecutores[0][1]!=""){
				$cargo=",".ucwords(strtolower($ejecutores[0][1]));
			}
			$lista[]=ucwords(strtolower($ejecutores[0][0])).$cargo;
		}    
		echo implode(", ",$lista);
		if($inf_memorando[0]['vercopiainterna']==1 && $inf_memorando[0]['copiainterna']<>""){
			$copiainterna=mostrar_cop_interna($inf_memorando[0]['copiainterna']);
			echo ",".implode(", ",$copiainterna);
		}      
		echo '</span><br/><br/>';         
	}elseif($inf_memorando[0]['vercopiainterna']==1 && $inf_memorando[0]['copiainterna']<>""){
		echo '<span>Copia: ';
		$copiainterna=mostrar_cop_interna($inf_memorando[0]['copiainterna']);
		echo implode(", ",$copiainterna).'</span><br/><br/>';
	}    
}

function mostrar_cop_interna($copiainterna){
global $conn;
 $destinos=explode(",",$copiainterna);
 $destinos=array_unique($destinos);
 sort($destinos);
 $lista=array();
 for($i=0;$i<count($destinos);$i++){//si el destino es una dependencia
   if(strpos($destinos[$i],"#")>0){
      	$resultado=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
			  $lista[]=ucwords(strtolower($resultado[0]["nombre"]));
      }else{
   		$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","funcionario,cargo c,dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$destinos[$i],"",$conn);                 
      $lista[]=ucwords(strtolower($resultado[0]["nombres"]." ".$resultado[0]["apellidos"]));
			if($resultado[0]['nombre']<>""){
				 $lista[]=ucwords(strtolower($resultado[0]["nombre"]));
			}
   }
  }    
return $lista;
} 

function mostrar_anexos_ext($idformato,$iddoc){
	$fisicos=mostrar_valor_campo('anexos_fisicos',210,$iddoc,1);
	$digitales=mostrar_valor_campo('anexo_formato',210,$iddoc,1);
	if($fisicos!="" || $digitales!=""){
		$digitales=preg_replace("%(<div.*?>)(.*?)(<\/div.*?>)%is","",$digitales);
		echo "Anexos: ".$fisicos." ".strip_tags($digitales, '<a>')."<br/><br/>";
	}
}

function mostrar_informacion_verificacion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_folios_recibi, A.numero_folios_verifi, A.presenta_inconsisten, A.observacion_verifica, A.documento_iddocumento","ft_verifica_informacion A, ft_novedades_servicio B","A.idft_verifica_informacion=B.ft_verifica_informacion AND B.documento_iddocumento=".$iddoc,"",$conn);
	$idformato_verifica=busca_filtro_tabla("A.idformato","formato A","A.nombre='verifica_informacion'","",$conn);
	
	$datos_verificacion='<b>Número de Folios Remitidos :</b> '.$datos[0]['numero_folios_verifi'].'<br/>';
	$datos_verificacion.='<b>Número de Folios Recibidos :</b> '.$datos[0]['numero_folios_recibi'].'<br/>';
	$datos_verificacion.='<b>Presenta Inconsistencias :</b> '.mostrar_valor_campo("presenta_inconsisten",$idformato_verifica[0]['idformato'],$datos[0]['documento_iddocumento'],1).'<br/>';
	$datos_verificacion.='<b>Observaciones :</b> '.strip_tags($datos[0]['observacion_verifica']).' <br/>';
	echo($datos_verificacion);
}


function mostrar_radicado_novedad($idformato, $iddoc){
	global $conn;
	$datos_radicacion = busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	$nombre_empresa = busca_filtro_tabla("valor","configuracion","LOWER(nombre) LIKE'nombre'","",$conn);
	$ejecutor =  busca_filtro_tabla("","funcionario","funcionario_codigo=".$datos_radicacion[0]['ejecutor'],"",$conn);
	$datos="<div style='float:right; border: solid 1px; padding:10px; font-size: 11px; border-radius: 5px; margin-top:37px;'>";
	$datos.="<b style='float:rigth;'>CORRESPONDENCIA ENVIADA</b><br />";
	$datos.="<b >Radicación No:</b> CK-".$datos_radicacion[0]['numero'].'-2014<br />';
	$datos.="<b>Fecha:</b> ".$datos_radicacion[0]['fecha'].'<br />';
	$datos.="</div>";
	echo($datos);	
}
?>