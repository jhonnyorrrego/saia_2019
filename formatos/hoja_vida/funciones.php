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
function calcular_edad_hv($idformato,$iddoc){
$edad=busca_filtro_tabla(fecha_db_obtener("fecha_nacimiento","Y-m-d")." AS fecha_dif","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
if($edad[0]["fecha_dif"]){ 
  tiempo_transcurrido($edad[0]["fecha_dif"],'2011-09-01');
}
}

function tiempo_transcurrido($fecha_inicial, $fecha_control){
   if(!strlen($fecha_control)){
      $fecha_control = date('Y-m-d');
   }
   // separamos en partes las fechas 
   $array_inicial = date_parse($fecha_inicial ); 
   $array_actual = date_parse($fecha_control ); 

   $anos =  $array_actual["year"] - $array_inicial["year"]; // calculamos a�os 
   $meses = $array_actual["month"] - $array_inicial["month"]; // calculamos meses 
   $dias =  $array_actual["day"] - $array_inicial["day"]; // calculamos d�as 

   //ajuste de posible negativo en $d�as 
   if ($dias < 0){ 
      --$meses; 
      if($meses<0){
        $anos--;
        $meses=$meses + 12;   
        if($array_actua["month"]==1)
          $mes_actual=12;
        else   
          $mes_actual=($array_actual["month"]-1);
      }
      
      $mes = mktime( 0, 0, 0, $mes_actual,1, $array_actual["year"]  );
      $dias=$dias + date('t',$mes);
   }
   echo($anos." A&ntilde;os ".$meses." Meses ".$dias." D&iacute;as");
}

function mostrar_informacion_academica($idformato,$iddoc){

$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$formacion_academica=busca_filtro_tabla("","ft_formacion_academica","ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"idft_formacion_academica DESC",$conn);
$texto="";
if($formacion_academica["numcampos"]){

$texto.='<table border="1" width="100%">';

for($i=0;$i<$formacion_academica["numcampos"];$i++){
  $formacion=mostrar_valor_campo("tipo_formacion",156,$formacion_academica[$i]["documento_iddocumento"],1);
  $texto.= '<tr><td style=font-size:12px><b>'.$formacion.'T&iacute;tulo:</b> '.$formacion_academica[$i]["titulo_formacion"].'</td><td  style=font-size:12px><b>Instituci&oacute;n:</b> '.$formacion_academica[$i]["institucion_formacion"].'</td></tr>';
}
$texto.='</table>';
echo $texto;
}

}
function mostrar_seminarios_cursos($idformato,$iddoc){
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$diplomado=array();
$cursos=array();
$seminario=array(); 
$seminarios=busca_filtro_tabla("","ft_seminario_cursos"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"",$conn);
$texto="";
$texto.='<table border="1" width="100%">';
if($seminarios["numcampos"]){
  for($i=0;$i<$seminarios["numcampos"];$i++){
    switch($seminarios[$i]["tipo_seminario"]){
      case 1: 
        array_push($diplomado,$seminarios[$i]["titulo_seminario"]);
      break;
      case 2: 
        array_push($cursos,$seminarios[$i]["titulo_seminario"]);
      break;
      case 3: 
        array_push($seminario,$seminarios[$i]["titulo_seminario"]);
      break;
    }    
  }
}
if(!empty($diplomado)){
  $texto.= '<tr><td style=font-size:12px><b>Diplomado:</b><br /> '.implode(", ",$diplomado).'</td></tr>';
}
if(!empty($curso)){
  $texto.= '<tr><td  style=font-size:12px><b>Curso:</b><br /> '.implode(", ",$curso).'</td></tr>';
}
if(!empty($seminario)){
  $texto.= '<tr><td  style=font-size:12px><b>Seminario:</b><br /> '.implode(", ",$seminario).'</td></tr>';
}
$texto.='</table>';
echo $texto;
         
}

function mostrar_experiencia_laboral($idformato,$iddoc){
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$experiencia=busca_filtro_tabla("","ft_experiencia_laboral"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"fecha_ingreso DESC",$conn);
$texto='<style>.borde{border:1px solid;}</style><table style="width:100%;border-collapse:collapse;border:1px solid;">';
for($i=0;$i<$experiencia["numcampos"];$i++){
  $texto.='<tr class="borde">';
  $texto.='<td style=font-size:12px;class="borde" colspan="2"><b>Nombre de la empresa:</b>'.$experiencia[$i]["nombre_empresa"].'</td><td style=font-size:12px ;class="borde"><b>Direcci&oacute;n:</b>'.$experiencia[$i]["direccion"].'</td><td style=font-size:12px;class="borde"><b>Tel&eacute;fono:</b>'.$experiencia[$i]["telefonos"].'</td>';
  $texto.='</tr><tr>';
  $texto.='<td style=font-size:12px;colspan="2" class="borde"><b>Nombre Jefe inmediato:</b>'.$experiencia[$i]["jefe_inmediato"].'</td><td colspan="3" class="borde"><b style=font-size:12px>Cargo(s) desempe&ntilde;ado(s):</b><b style=font-size:12px;>'.$experiencia[$i]["cargo_realizado"].'</b></td>';
  $texto.='</tr><tr>';
  $texto.='<td style=font-size:12px; colspan="4" class="borde"><b>Funciones Realizadas:</b>'.$experiencia[$i]["funciones_realizadas"].'</td>';
  $texto.='</tr><tr>';
  $texto.='<td style=font-size:12px;class="borde"><b>Fecha de ingreso:</b><br>'.$experiencia[$i]["fecha_ingreso"].'</td><td style=font-size:12px;class="borde"><b>Fecha de Retiro:</b><br>'.$experiencia[$i]["fecha_retiro"].'</td><td style=font-size:12px;class="borde"><b>Sueldo inicial:<br>$ '.number_format($experiencia[$i]["salario_inicial"],0,",",".").'</b></td><td style=font-size:12px;class="borde"><b>Sueldo final o actual:<br>$ '.number_format($experiencia[$i]["salario_final"],0,",",".").'</b></td>';
  $texto.='</tr><tr>';
  $texto.='<td colspan="5" class="borde"><b style=font-size:12px;>Motivo del Retiro:</b>'.$experiencia[$i]["motivo_retiro"].'</td>';
  $texto.='</tr>';
}
$texto.='</table>';
echo($texto);
}
function mostrar_referencias($idformato,$iddoc){
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$referencias_personales=busca_filtro_tabla("","ft_referencias_personales"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"",$conn);
$referencias_comerciales=busca_filtro_tabla("","ft_referencias_comerciales"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"",$conn);

$texto1='<table width="100%"><tr><td width="50%"><table style="border-collpase:collapse; border:1px; width:100%;"><tr class="encabezado_list"><td style=font-size:12px>PERSONALES</td></tr>';
for($i=0;$i<$referencias_personales["numcampos"];$i++){
  $texto1.='<tr><td style=font-size:12px;class="borde"><b>Nombre:</b>'.$referencias_personales[$i]["nombre"].'</td></tr>';
  $texto1.='<tr><td style=font-size:12px;class="borde"><b>Tel&eacute;fono:</b>'.$referencias_personales[$i]["telefono"].'</td></tr>';
  $texto1.='<tr><td style=font-size:12px;class="borde"><b>Ocupaci&oacute;n:</b>'.$referencias_personales[$i]["ocupacion"].'</td></tr>';
}
$texto1.='</table></td><td valign="top">';

$texto1.='<table style="border-collpase:collapse;  ;width:100% "><tr class="encabezado_list"><td style=font-size:12px;>COMERCIALES</td></tr>';
for($i=0;$i<$referencias_comerciales["numcampos"];$i++){
  $texto1.='<tr><td style=font-size:12px;class="borde;"><b>Entidad:</b>'.$referencias_comerciales[$i]["entidad"].'</td></tr>';
  $texto1.='<tr><td style=font-size:12px;class="borde"><b>Nombre:</b>'.$referencias_comerciales[$i]["nombre"].'</td></tr>';
  $texto1.='<tr><td style=font-size:12px;class="borde"><b>Tel&eacute;fono:</b>'.$referencias_comerciales[$i]["telefono"].'</td></tr>';
  
}
$texto1.='</table></td></tr></table>';
echo($texto1);
}

function verificacion_experiencias_laborales($idformato,$iddoc){
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$experiencia=busca_filtro_tabla("","ft_experiencia_laboral"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"fecha_ingreso DESC",$conn);

$texto='<table style="width:100%;border-collapse:collapse;border:1px solid;"><tr class="encabezado_list"><td style=font-size:12px;>Entidad</td><td style=font-size:12px;>Cumple</td><td style=font-size:12px;>No cumple</td></tr>';
for($i=0;$i<$experiencia["numcampos"];$i++){
    
    $texto.='<tr class="borde">';
     $texto.='<td class="borde"; style=font-size:12px; >'.$experiencia[$i]["nombre_empresa"].'</td>';
  if($experiencia[$i]["verificado"]==1){
    $texto.='<td class="borde"; style=font-size:12px; align="center" id="si_verifica'.$i.'">Si <img src="../../images/check.jpg" onclick="cambiar_estado(\''.$experiencia[$i]["documento_iddocumento"].'\',1,'.$i.');"></td><td></td>';
  
  }
  else if($experiencia[$i]["verificado"]==2){
    $texto.='<td style=font-size:12px;class="borde" align="center" id="si_verifica">&nbsp;</td><td class="borde" align="center" id="no_verifica">'.$experiencia[$i]["verificacado"].'</td>';
  }
  else{
    $texto.='<td style=font-size:12px;class="borde" align="center" id="si_verifica'.$i.'">Si  <img src="../../images/check.jpg" onclick="cambiar_estado(\''.$experiencia[$i]["documento_iddocumento"].'\',1,'.$i.');"></td><td class="borde" align="center" id="no_verifica'.$i.'">No  <img src="../../images/check.jpg" onclick="cambiar_estado(\''.$experiencia[$i]["documento_iddocumento"].'\',2,'.$i.');"></td>';
  }
  $texto.='</tr>';                       
}
$texto.='</table>';
echo($texto);
?>                           
<script type='text/javascript' src='../../js/jquery0.js'></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

<script>
  function cambiar_estado(doc,verifica,indice){
    $.ajax({
      type:'POST',
      url:'actualizar_verificacion_hoja_vida.php',
      data:'iddoc='+doc+'&verifica='+verifica,
      success: function(datos,exito){
        if(datos){
          if(verifica==1){
            $("#si_verifica"+indice).html(datos);
            $("#no_verifica"+indice).html("");
          }  
          else if(verifica==2){
            $("#no_verifica"+indice).html(datos);
            $("#si_verifica"+indice).html("");
          }    
        }
      }
    });
  }
</script>
<?php
}
function 	mostrar_verifiacion_documentos($idformato,$iddoc){
global $conn;
$estructura_hv=186;
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$estructuras=busca_filtro_tabla("","ft_estructura_hoja_vida","1=1","",$conn);
$texto='<table style="border:1px collapse; width:100%"><tr><td class="encabezado_list" style=font-size:12px;>INFORMACION</td><td class="encabezado_list" style=font-size:12px;>FECHA DE VIGENCIA</td>';
for($k=0;$k<$estructuras["numcampos"];$k++){
  $anexos_hoja=busca_filtro_tabla("","ft_anexos_hoja_vida","ft_hoja_vida =".$hoja_vida[0]["idft_hoja_vida"]." AND estado_anexo=1 AND estructura_hoja_vida=".$estructuras[$k]["idft_estructura_hoja_vida"],"",$conn);
  $i=0;
  if($anexos_hoja["numcampos"]){
    if($anexos_hoja[$i]["fecha_vigencia"]==""){
      $vigencia="Sin vigencia";
    }
    else{
      $vigencia=$anexos_hoja[$i]["fecha_vigencia"];
    }
    $existe='<a href="../anexos_hoja_vida/mostrar_anexos_hoja_vida.php?idformato='.$estructura_hv.'&iddoc='.$anexos_hoja[$i]["documento_iddocumento"].'"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 550, height:400,preserveContent:false } )">'.$vigencia."</a>";
  }
  else{
    if($estructuras[$k]["obligatoriedad"]){
      $existe='<a href="../anexos_hoja_vida/adicionar_anexos_hoja_vida.php?padre='.$hoja_vida[0]["idft_hoja_vida"].'&anterior='.$iddoc.'&idformato='.$idformato.'">Pendiente Obligatorio</a>';
    }
    else{
     $existe='<a href="../anexos_hoja_vida/adicionar_anexos_hoja_vida.php?padre='.$hoja_vida[0]["idft_hoja_vida"].'&anterior='.$iddoc.'&idformato='.$idformato.'">Sin Anexo</a>'; 
    }  
  }
  $texto.='<tr><td class="borde"style=font-size:12px>'.$estructuras[$k]["nombre"].'</td><td class="borde">'.$existe.'</td></tr>';
}  
$texto.='</table>';
echo($texto);
}
function cargar_pais_dept($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	?>
	<script>
	$(document).ready(function(){
			$("#Departamento2201 option[value=11]").attr("selected","selected");
			$("#Departamento2202 option[value=11]").attr("selected","selected");
	});
	</script>
	<?php
}
function departamento_funcion(){}
function validar_digitalizacion2($idformato,$iddoc)
{global $conn;
//echo "dfdsfs";
//alerta($_REQUEST["digitalizacion"]);
  if($_REQUEST["digitalizacion"]==1){
    redirecciona($ruta_db_superior."paginaadd.php?&key=".$iddoc."&x_enlace=mostrar");
  }
}

////

function digitalizacion_documento_interno()
{echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td><td><input name='digitalizacion' type='radio' value='1'>Si  <input name='digitalizacion' type='radio' value='0' checked>No</td></tr>";
}
function mostrar_contrato_laboral($idformato,$iddoc){
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$contrato=busca_filtro_tabla("","ft_contrato_laboral"," ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"],"",$conn);

$texto1='<table width="100%"><tr><td width="50%"><table style="border-collpase:collapse; width:100%;"><tr class="encabezado_list"><td style=font-size:12px;>CONTRATO LABORAL</td></tr>';
for($i=0;$i<$contrato["numcampos"];$i++){
  $texto1.='<tr><td class="borde"style=font-size:12px><b>Numero de Contrato:</b>'.$contrato[$i]["num_contarto"].'</td></tr>';
  $texto1.='<tr><td class="borde" style=font-size:12px><b>Tipo de Contrato:</b>'.$contrato[$i]["tipo_contrato"].'</td></tr>';
  $texto1.='<tr><td class="borde"style=font-size:12px><b>Fecha de Inicio:</b>'.$contrato[$i]["fecha_inicio"].'</td></tr>';
  $texto1.='<tr><td class="borde" style=font-size:12px><b>Fecha de Finalizacion:</b>'.$contrato[$i]["fecha_final"].'</td></tr>';
  $texto1.='<tr><td class="borde"></td></tr>';
}
$texto1.='</table></td></tr></table>';
echo($texto1);
}
function validar_cedula($idformato, $iddoc){
    global $conn;
    ?><script>
        $('#formulario_formatos').validate({
            submitHandler: function(form){
                var documento_identidad = $("#documento_identidad").val();
                $.post(
                      "verificar_cedula.php",{
                      documento_identidad : documento_identidad
                  },
                  function(exito){
                      if(exito == 1){
                          alert("Numero de identificacion ya se encuentra registrado");
                          return false;
                      }
                      else{
                          form.submit();
                      }
                  }
                );
            }        
        });
    </script><?php
}
/*function foto_pagina($idformato,$iddoc){
global $conn,$ruta_db_superior;
  $foto=busca_filtro_tabla("consecutivo,imagen,ruta","pagina","id_documento=".$iddoc,"pagina ASC LIMIT 0,1",$conn);
  if($foto["numcampos"]){
    echo("<a href='../../comentario_mostrar.php?key=".$iddoc."&pag=".$foto[0]["consecutivo"]."' border='0' target='centro'><img src='../../".$foto[0]["imagen"]."'></a>");
  }
  else echo("<a href='".$ruta_db_superior."paginaadd.php?key=".$iddoc."&no_menu=1'><img src='".$ruta_db_superior."imagenes/sin_foto.jpg'></a>");
}*/


?>
