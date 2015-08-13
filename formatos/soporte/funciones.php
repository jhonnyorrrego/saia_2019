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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function ligth_box($idformato, $iddoc){
    global $ruta_db_superior;
echo(librerias_highslide());
?>

<script type="text/javascript">
$(document).ready(function(){
    $("select[name=activos]").change(function(){
    	var enlaces='<?php echo($ruta_db_superior)?>formatos/activo_fijo/mostrar_activo_fijo.php?iddoc='+$(this).val()+'&idformato=231';	
		hs.htmlExpand( this, {
			src: enlaces,					
			objectType: 'iframe', 
			outlineType: 'rounded-white', 
			wrapperClassName: 'highslide-wrapper drag-header', 
			preserveContent: false,				
			width: 600,
			height: 600								 
		});	
  });
});
</script>
<?php
  }
  function crear_ruta_soporte($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_sooporte","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario,"",$conn);

 $director=busca_filtro_tabla("A.*","vfuncionario_dc A","A.idcargo=".$usuario_logeado[0]['cod_padre']."  AND A.iddependencia = ".$usuario_logeado[0]['dependencia_iddependencia'],"",$conn);
// print_r($director);
 //$responsable=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_soporte B ","A.iddependencia_cargo=B.responsable  AND  B.documento_iddocumento=".$iddoc,"",$conn);

		    
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado
array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));

if($usuario<>$director[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$director[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
	} 
   
 /*if($usuario<>$gestionH[0]['funcionario_codigo']){
   array_push($ruta,array("funcionario"=>$responsable[0]['funcionario_codigo'],"tipo_firma"=>2));
    }*/
   
 
if(count($ruta)>1){
    $radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));

phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
  //print_r($insertar_ruta);
  //die();
 }
 
}     
  
?>