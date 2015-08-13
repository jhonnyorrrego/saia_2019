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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
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
include_once($ruta_db_superior."formatos/librerias/num2letras.php");

//MOSTRAR
//********************
function mostrar_informacion_permiso($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_solicitud_permiso A, documento B","A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$tabla_permiso='<table style="width: 100%; border-collapse: collapse; text-align:left;" border="1">';
	$tabla_permiso.='<tbody>';
	$tabla_permiso.='<tr>';
	$tabla_permiso.='<td style="width:20%;"><strong>FECHA SOLICITUD. </strong></td>';
	$tabla_permiso.='<td style="width:80%;" colspan="3">{*fecha_radiccion_permiso*}..</td>';
	$tabla_permiso.='</tr>';
	$tabla_permiso.='<tr>';
	$tabla_permiso.='<td style=""><strong>NOMBRE EMPLEADO</strong></td>';
	$tabla_permiso.='<td style="">{*nombre_empleado*}</td>';
	$tabla_permiso.='<td style=""><strong>CARGO</strong></td>';
	$tabla_permiso.='<td style="">{*nombre_cargo*}</td>';
	$tabla_permiso.='</tr>';
	$tabla_permiso.='<tr>';
	$tabla_permiso.='<td style=""><strong>C.C</strong></td>';
	$tabla_permiso.='<td style="">{*muestra_documento*}</td>';
	$tabla_permiso.='<td style=""><strong>HORA SALIDA</strong></td>';
	$tabla_permiso.='<td style="">{*hora_salida*}</td>';
	$tabla_permiso.='</tr>';
	$tabla_permiso.='<tr>';
	$tabla_permiso.='<td style=""><strong>FECHA CITA</strong></td>';
	$tabla_permiso.='<td style="">{*fecha_hora_cita*}</td>';
	$tabla_permiso.='<td style=""><strong>HORA ENTRADA</strong></td>';
	$tabla_permiso.='<td style="">{*hora_entrada*}</td>';
	$tabla_permiso.='</tr>';
	$tabla_permiso.='<tr>';
	$tabla_permiso.='<td style=""><strong>HORA CITA</strong></td>';
	$tabla_permiso.='<td style="">{*hora_entrada*}</td>';
	$tabla_permiso.='<td>&nbsp;</td>';
	$tabla_permiso.='<td>&nbsp;</td>';
	$tabla_permiso.='</tr>';
	$tabla_permiso.='</tbody>';
	$tabla_permiso.='</table>';
	
	echo($tabla_permiso);
}
   
function crear_ruta_permisos($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_solicitud_permiso","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C,ft_solicitud_permiso D"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario. " AND  D.documento_iddocumento=".$iddoc,"",$conn);
	 

$director=busca_filtro_tabla("A.*","vfuncionario_dc A,ft_solicitud_permiso B","A.idcargo=".$usuario_logeado[0]['cod_padre']."   AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($director);

 
 $gestionH=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_permiso B ","A.iddependencia_cargo=B.gestion_humana  AND  B.documento_iddocumento=".$iddoc,"",$conn);

		    
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado
array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));

if($usuario<>$director[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$director[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
	} 
   
 if($usuario<>$gestionH[0]['funcionario_codigo']){
   array_push($ruta,array("funcionario"=>$gestionH[0]['funcionario_codigo'],"tipo_firma"=>2));
    }
   
 
if(count($ruta)>1){
  // $radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
  //array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
//print_r($ruta);die();
phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}     
  
function insertar_otro($idformato,$iddoc)
{global $conn;
 /*$consulta=busca_filtro_tabla("","ft_reporte_permisos","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
  $condiciones=explode(",",$consulta[0]["motivo_permiso"]);
  
  if($_REQUEST["iddoc"]!=""){
   for($i=0;$i<count($condiciones);$i++){
    if($condiciones[$i]==13){     */
      ?>
       <script type="text/javascript">
        /* $().ready(function() {$("#otro").show();         
          }); */
        </script>
     <?php
 /*    } 
   }
  }   */
?>  
<script type="text/javascript">
$().ready(function() {
 if ($('#motivo_permiso12').attr('checked'))
   $("#otro").show();
 else
   {$("#otro").hide();
    $("#otro").val("");
   }

 $("#motivo_permiso12").click(function(){ 
 if ($('#motivo_permiso12').attr('checked')) {
    $("#otro").attr("class","required");  
    $("#otro").show();
}
else
{   $("#otro").attr("class",""); 
    $("#otro").hide();
    $("#otro").val("");
}
 	});
 	
});
</script>
<?php
}

function nombre_empleado($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
$nombre_funcionario=busca_filtro_tabla("","funcionario a","a.funcionario_codigo=".$consulta[0]["ejecutor"],"",$conn);
echo($nombre_funcionario[0]["nombres"]." ".$nombre_funcionario[0]["apellidos"]);

}  

function nombre_cargo($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
$nombre_funcionario=busca_filtro_tabla("","funcionario a, dependencia_cargo b, cargo c","c.idcargo=b.cargo_idcargo and 	b.funcionario_idfuncionario=a.idfuncionario    and a.funcionario_codigo=".$consulta[0]["ejecutor"],"",$conn);
echo($nombre_funcionario[0]["nombre"]);

}

function nombre_identificacion($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
$nombre_funcionario=busca_filtro_tabla("","funcionario a, dependencia_cargo b","a.funcionario_codigo=".$consulta[0]["ejecutor"],"",$conn);
echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$consulta[0]["ejecutor"]);

}  
 
function cita_fecha($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_reporte_permisos","documento_iddocumento=".$iddoc,"",$conn);
$fecha=explode(" ",$consulta[0]["fecha_cita"]);
echo $fecha[0];
}

function cita_hora($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_solicitud_permiso","documento_iddocumento=".$iddoc,"",$conn);
$fecha=explode(" ",$consulta[0]["fecha_cita"]);
echo($fecha[1]);
}
function muestra_documento($idformato,$iddoc){
global $conn;

if ($_REQUEST["tipo"]<>5){
	$usuario=usuario_actual("funcionario_codigo");
}
$documento=busca_filtro_tabla("A.idfuncionario","vfuncionario_dc A,ft_solicitud_permiso B","A.funcionario_codigo=".$usuario."  AND  B.documento_iddocumento=".$iddoc,"",$conn);
echo $id=$documento[0]['idfuncionario'];
}

function motivo($idformato,$iddoc)//---->daña el pdf
{global $conn;
$consulta=busca_filtro_tabla("","ft_solicitud_permiso","documento_iddocumento=".$iddoc,"",$conn);
$permisos=busca_filtro_tabla("A.nombre","serie A,ft_solicitud_permiso B","A.cod_padre=856 AND B.documento_iddocumento=".$iddoc,"",$conn);
$condiciones=explode(",",$consulta[0]["motivo_permiso"]);

///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro 
$v1="&nbsp;";
$v2="&nbsp;";
$v3="&nbsp;";
$v4="&nbsp;";
$v5="&nbsp;";
$v6="&nbsp;";
$v7="&nbsp;";
$v8="&nbsp;";
$v9="&nbsp;";
$v10="&nbsp;";
$v11="&nbsp;";
$v12="&nbsp;";
$v13="&nbsp;";

	for($i=0;$i<count($condiciones);$i++){
	
		if($condiciones[$i]==857){
			$v1="X";
		}		
		if($condiciones[$i]==858){		
			$v2="X";
		}
		if($condiciones[$i]==859){
			$v3="X";
		}
		if($condiciones[$i]==860){
			$v4="X";
		}
		if($condiciones[$i]==861){
			$v5="X";
		}
		if($condiciones[$i]==862){
			$v6="X";
		}
		if($condiciones[$i]==863){
			$v7="X";
		}
		if($condiciones[$i]==864){
			$v8="X";
		}
		if($condiciones[$i]==865){
			$v9="X";
		}
		if($condiciones[$i]==866){
			$v10="X";
		
		}
		if($condiciones[$i]==867){
			$v11.="X";
		}
		
		if($condiciones[$i]==868){
			$v12.="X";
		}
		if($condiciones[$i]==870){
			$v13="X";
		}
		if($condiciones[$i]==871){
			$valor.=$consulta[0]['motivo_otro'];
			$v14="X";
		}	
	}
///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro

	$texto='<table style="width: 100%; text-align:left;" border="0">
	<tbody>
	<tr>
	<td style="width:35%;">'.$permisos[0]['nombre'].'</td>
	<td style="text-align: center;border:1px solid #000000; width:5%;">'.$v1.'</td>
	<td style="width:20%;">&nbsp;</td>
	<td style="width:35%;">'.$permisos[1]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000; width:5%;">'.$v2.'</td>
	</tr>
	<tr>
	<td>'.$permisos[2]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v3.'</td>
	<td>&nbsp;</td>
	<td>'.$permisos[3]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;" >'.$v4.'</td>
	</tr>
	<tr>
	<td>'.$permisos[4]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v5.'</td>
	<td>&nbsp;</td>
	<td>'.$permisos[5]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v6.'</td>
	</tr>
	<tr>
	<td>'.$permisos[6]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v7.'</td>
	<td>&nbsp;</td>
	<td>'.$permisos[7]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v8.'</td>
	</tr>
	<tr>
	<td>'.$permisos[8]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v9.'</td>
	<td>&nbsp;</td>
	<td>'.$permisos[9]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v10.'</td>
	</tr>
	<tr>
	<td>'.$permisos[10]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v11.'</td>
	<td>&nbsp;</td>
	<td>'.$permisos[11]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v12.'</td>
	</tr>
	<tr>
	<td>'.$permisos[12]['nombre'].'</td>
	<td style="text-align: center; border: 1px solid #000000;">'.$v14.'</td>
	<td>&nbsp;</td>
	<td colspan="2">'.$valor.'</td>
	</tr>
	
	</tbody>
	</table>';
	echo $texto;
}    

function consultar_directivo1($idformato,$iddoc){
global $conn;

$funcionario=usuario_actual("funcionario_codigo");
$consulta_funcionario=busca_filtro_tabla("","funcionario","estado =1 and funcionario_codigo=".$funcionario,"",$connn);
$dependencia_cargo=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo","estado=1 and funcionario_idfuncionario=".$consulta_funcionario[0]["idfuncionario"],"",$conn);
$funcionario_dependencia=busca_filtro_tabla("c.funcionario_codigo","dependencia_cargo a, cargo b, funcionario c","a.funcionario_idfuncionario=c.idfuncionario and a.estado=1 and a.dependencia_iddependencia=".$dependencia_cargo[0]["dependencia_iddependencia"]." and a.cargo_idcargo=b.idcargo and (b.nombre like '%DIRECTOR%' OR b.nombre like '%LIDER%' OR b.nombre like '%JEFE%')","",$conn);

return($funcionario_dependencia[0]["funcionario_codigo"]);
}

  
function fecha_permiso($idformato,$iddoc){
global $conn;

      
$fecha=busca_filtro_tabla(fecha_db_obtener("fecha","d-m-Y"),"documento ","iddocumento=".$iddoc,"",$conn);
echo $fecha[0][0]; 
}

function terminar_actividad_paso_permisos($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$ejecutor = busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	if($ejecutor[0]["ejecutor"] != usuario_actual("funcionario_codigo")){
		include_once($ruta_db_superior.'workflow/libreria_paso.php');
		$paso = busca_filtro_tabla("","paso_actividad","idpaso_actividad=32","",$conn);
		$paso_doc = busca_filtro_tabla("","paso_documento a","documento_iddocumento=".$iddoc." and paso_idpaso=".$paso[0]["paso_idpaso"],"",$conn);
		$paso_documento = $paso_doc[0]["idpaso_documento"];
		terminar_actividad_paso($iddoc,'',2,$paso_documento,32);
	}
}  
    
    
function validar_horas($idformato,$iddoc)
{global $conn;

?>
<script type="text/javascript">

$('#formulario_formatos').validate({
     submitHandler: function(form){
     var entrada = $("#hora_entrada").val();
     var salida  =$("#hora_salida").val();
     var cita = $("#fecha_cita").val();
     var hora_cita = cita.split(" ");
     //alert(hora_cita[1]);
     
     if(salida>hora_cita[1]){
       alert("La hora de salida es mayor a la hora de la cita");
       return false;
     
     }else if(entrada<hora_cita[1] && entrada<salida){
       alert("La hora de entrada es menor a la hora de la cita ");
       return false;
     
     }else if(salida>entrada){
       alert("La hora de salida es mayor a la hora de entrada");
       return false;
     }else{
        form.submit();	
      } 
               //	form.submit();
            }        
        });
    
</script>

<?php

}   
 ?>