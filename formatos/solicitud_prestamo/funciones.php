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


function mostrar_solicitante($idformato,$iddoc){
	global $conn;
	$usuario=usuario_actual("funcionario_codigo"); 
	 $campo_solitante=busca_filtro_tabla("nombres,apellidos,iddependencia_cargo","vfuncionario_dc","funcionario_codigo=".$usuario,"",$conn);
	 echo "<td><input type='hidden' name='nombre_solicita' id='nombre_solicita' value='".$campo_solitante[0]['iddependencia_cargo']."'>".$campo_solitante[0]['nombres']." ".$campo_solitante[0]['apellidos']."</td>";
	
}

function solicitante($idformato,$iddoc){
	global $conn;
	 $campo_solitante=busca_filtro_tabla("A.nombres,A.apellidos","vfuncionario_dc A,ft_solicitud_prestamo B","A.iddependencia_cargo=B.nombre_solicita and B.documento_iddocumento=".$iddoc,"",$conn);
	 echo $campo_solitante[0]['nombres']."  ".$campo_solitante[0]['apellidos'];
	
}
           
function ruta_autoriza($idformato,$iddoc){
	global $conn;
	/*$autoriza=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_prestamo B ","A.iddependencia_cargo=B.persona_autoriza  AND  B.documento_iddocumento=".$iddoc,"",$conn);
	
	$ruta=array();
	$usuario=usuario_actual("funcionario_codigo");
	array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>1));
	if($autoriza[0]["funcionario_codigo"]!=$usuario){
		array_push($ruta,array("funcionario"=>$autoriza[0]['funcionario_codigo'],"tipo_firma"=>1));
	}
	
	if(count($ruta)>1){
		$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia desc",$conn);
    array_push($ruta,array("funcionario"=>1,"tipo_firma"=>0)); 
    phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
		phpmkr_query("delete from ruta where documento_iddocumento='$iddoc'");
    insertar_ruta_solicitud_prestamo($ruta,$iddoc);
	}*/
}

function insertar_ruta_solicitud_prestamo($ruta,$iddoc){
	global $conn;
 for($i=0;$i<count($ruta)-1;$i++){
 	if(!isset($ruta[$i]["tipo_firma"]))
    $ruta[$i]["tipo_firma"]=1;
    $sql="insert into ruta (destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".	$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',1,1,$i,".$ruta[$i]["tipo_firma"].")" ;
    phpmkr_query($sql);
    $idruta=phpmkr_insert_id();
    $sql="insert into buzon_entrada (origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
    phpmkr_query($sql);
   }
}
/*POSTERIOR APROBAR*/
function transferir_coordinador_archivo($idformato,$iddoc){
	global $conn;
	$documento=busca_filtro_tabla("documento_archivo","ft_solicitud_prestamo","documento_iddocumento=".$iddoc,"",$conn);
	$archivo=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A","lower(cargo) like 'coordinador(a) archivo'","",$conn);
	if($documento[0]['documento_archivo']==1){
		transferencia_automatica($idformato,$iddoc,$archivo[0]['funcionario_codigo'],3);
	}
}


function seleccion_responsables_solicitud($idformato,$iddoc){
    global $conn,$ruta_db_superior;
  
  ?>
    <script>
    
      $(document).ready(function(){
       
        $('input[name=firmado][value=una]').attr('checked', 'checked');
        $('input[name=obligatorio][value=1]').attr('checked', 'checked');
        
      });
    </script>
    <?php
}

?>