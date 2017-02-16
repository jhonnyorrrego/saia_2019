<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
include_once("../../db.php");

$campos=explode(",",$_REQUEST["campos"]);
$texto='';
$texto.='<table width="500px" >';
foreach($campos as $nombre)
 {
 	if($nombre<>'')
 		$texto.=crear_campo($nombre);
 }
$texto.='</table>';
echo $texto;


function crear_campo($nombre)
{
	global $conn;
	if($nombre=="fecha_nacimiento")
   $datos_ejecutor=busca_filtro_tabla(fecha_db_obtener($nombre,"Y-m-d")." as fecha_nacimiento","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and ejecutor_idejecutor=".$_REQUEST["idejecutor"],"fecha desc",$conn);
 else
   $datos_ejecutor=busca_filtro_tabla($nombre,"datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and ejecutor_idejecutor=".$_REQUEST["idejecutor"],"fecha desc",$conn);

 $texto='<tr><td width="150">
      <label>'.mayusculas(str_replace("_"," ",$nombre)).':</label>
    </td>';
 if($nombre=="titulo")
    {$texto.='<td><div id="div_titulo_ejecutor">
<script type="text/javascript">
    $("#otro_titulo_ejecutor").click(function() {
		$("#div_titulo_ejecutor").empty();
		$("#div_titulo_ejecutor").append('."'".'<input type="text" name="titulo_ejecutor" id="titulo_ejecutor" value="">'."'".');
	});
	</script>
        <select name="titulo_ejecutor" id="titulo_ejecutor" width="100px">';
$titulos=array("Se&ntilde;or","Se&ntilde;ora",'Doctor','Doctora','Ingeniero','Ingeniera');
if(!in_array(@$datos_ejecutor[0][$nombre],$titulos))
  $titulos[]=@$datos_ejecutor[0][$nombre];
for($i=0;$i<count($titulos);$i++){
  $texto.='<option value="'.$titulos[$i].'"';
  if($titulos[$i]==@$datos_ejecutor[0][$nombre])
    $texto.=' selected ';
  $texto.='>'.$titulos[$i].'</option>';
}
    $texto.='
        </select>&nbsp;&nbsp;&nbsp;<a href="#" id="otro_titulo_ejecutor" style="cursor:pointer">Otro</a>
      </div></td></tr>';
    }
  elseif($nombre=="ciudad" || $nombre=="lugar_expedicion" || $nombre=="lugar_nacimiento")
    {$texto.='<td><div id="div_'.$nombre.'_ejecutor">'.generar_ciudad(@$datos_ejecutor[0][$nombre],$nombre).'</div></td></tr>';
    }
  elseif($nombre=="estudios")
    {$texto.='<td><textarea style="font-size:x-small;font-family:verdana" id="'.$nombre.'_ejecutor" cols=35 rows=2>'.@$datos_ejecutor[0][$nombre].'</textarea></td></tr>';
    }
  elseif($nombre=="fecha_nacimiento")
    {include_once("../../calendario/calendario.php");
     if(@$datos_ejecutor[0][$nombre]<>"0000-00-00" && @$datos_ejecutor[0][$nombre]<>"")
       $valor=$datos_ejecutor[0][$nombre];
     else
       $valor="0000-00-00";
     $texto.='<td><input type="text" readonly="true" name="'.$nombre.'" id="'.$nombre.'" value="'.$valor.'">&nbsp;&nbsp;&nbsp;<a href="javascript:showcalendar(\''.$nombre.'\',\'form1\',\'Y-m-d\',\'../../calendario/selec_fecha.php?nombre_campo='.$nombre.'&nombre_form=form1&formato=Y-m-d&anio='.date('Y').'&mes='.date('m').'&css=default.css\',220,225)" ><img src="../../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /></a></td></tr>';
    }
  elseif($nombre=="tipo_documento" ||$nombre=="estado_civil" || $nombre=="sexo")
    {if($nombre=="tipo_documento")
      {if(!$datos_ejecutor["numcampos"])
       $datos_ejecutor[0][$nombre]=1;
       $opciones=array("Seleccionar...","C&eacute;dula de Ciudadan&iacute;a","C&eacute;dula de Extranjer&iacute;a","Tarjeta de identidad","C&eacute;dula Militar","Pasaporte");
      }
     elseif($nombre=="estado_civil")
       $opciones=array("Seleccionar...","Casado","Divorciado","Soltero","Union Libre","Viudo");
     elseif($nombre=="sexo")
       $opciones=array("Seleccionar...","Femenino","Masculino");

     $texto.='<td><select name="'.$nombre.'" id="'.$nombre.'_ejecutor">';
    for($i=0;$i<count($opciones);$i++)
      {$texto.='<option value="'.$i.'" ';
       if($i==@$datos_ejecutor[0][$nombre])
          $texto.=' selected ';
       $texto.=' >'.$opciones[$i].'</option>';
      }
    $texto.='</td></tr>';
    }
  else
  $texto.='<td>
      <input type="text" id="'.$nombre.'_ejecutor" name="cargo_ejecutor" value="'.@$datos_ejecutor[0][$nombre].'"><br />
    </td>
  </tr>';
 return($texto);
}

function generar_ciudad($ciudad,$campo){
	global $conn;
if(!$ciudad)
  {$ciudad_conf=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
  if($ciudad_conf["numcampos"]){
    $ciudad_valor=$ciudad_conf[0][0];
  }
  else{
    $ciudad_valor="658";
  }
 }
 else
   $ciudad_valor=$ciudad;
  $municipio=busca_filtro_tabla("idmunicipio,iddepartamento,idpais","municipio A,departamento B, pais C","A.departamento_iddepartamento=B.iddepartamento AND C.idpais=B.pais_idpais AND A.idmunicipio=".$ciudad_valor,"",$conn);
  if($municipio["numcampos"]){
    $paises=busca_filtro_tabla("","pais","","lower(nombre)",$conn);
    $departamentos=busca_filtro_tabla("","departamento","pais_idpais=".$municipio[0]["idpais"],"lower(nombre)",$conn);
    $municipios=busca_filtro_tabla("","municipio","departamento_iddepartamento=".$municipio[0]["iddepartamento"],"lower(nombre)",$conn);
    $texto='<script type="text/javascript">
    $("#pais_ejecutor_'.$campo.'").change(function(){
      actualiza_ciudad_'.$campo.'($("#pais_ejecutor_'.$campo.'").find('."':selected'".').val(),0);
    });
    function boton_guardar_'.$campo.'()
    { parametros="formato=1&pais="+$("#pais_'.$campo.'").val()+"&provincia="+$("#depto_'.$campo.'").val()+"&ciudad="+$("#municipio_'.$campo.'").val();

     if($("#pais_'.$campo.'").val()&&$("#depto_'.$campo.'").val()&&$("#municipio_'.$campo.'").val())
     {$.ajax({
        type:'."'POST'".',
        url:'."'../../municipioadd.php'".',
        data: parametros,
        success: function(datos,exito){
          $("#div_'.$campo.'_ejecutor").html("<input type=\"hidden\" name=\"'.$campo.'\" id=\"'.$campo.'\" value="+datos+">"+$("#municipio_'.$campo.'").val());
        }
      });
     }
     else
      {alert("Faltan datos por llenar");}
    }
    $("#nuevo_municipio_'.$campo.'").click(function(){
        codigo="<table><tr><td>Pais</td><td><input type=\"text\" id=\"pais_'.$campo.'\"></td></tr><tr><td>Estado/Provincia</td><td><input type=\"text\" id=\"depto_'.$campo.'\"></td></tr><tr><td>Ciudad</td><td><input type=\"text\" id=\"municipio_'.$campo.'\"></td></tr><tr><td colspan=2><a href=\"JavaScript:boton_guardar_'.$campo.'();\" id=\"guardar_municipio_'.$campo.'\" >Guardar</a></td></tr></table>";
        $("#div_'.$campo.'_ejecutor").html(codigo);
    });
    $("#departamento_ejecutor_'.$campo.'").change(function(){
      actualiza_ciudad_'.$campo.'($("#pais_ejecutor_'.$campo.'").find('."':selected'".').val(),$("#departamento_ejecutor_'.$campo.'").find('."':selected'".').val());
    });
    function actualiza_ciudad_'.$campo.'(pais,departamento){
      $.ajax({
        type:'."'POST'".',
        url:'."'../librerias/generar_ciudades.php'".',
        data:'."'pais='+pais+'&departamento='+departamento+'&campo=".$campo."',".'
        success: function(datos,exito){
          $("#div_'.$campo.'_ejecutor").empty();
          $("#div_'.$campo.'_ejecutor").append(datos);
        }
      });
    }
  </script>';
    $texto.='<select name="pais_ejecutor_'.$campo.'" id="pais_ejecutor_'.$campo.'">';
    for($i=0;$i<$paises["numcampos"];$i++){
      $texto.='<option value="'.$paises[$i]["idpais"].'"';
      if($paises[$i]["idpais"]==$municipio[0]["idpais"])
        $texto.=" SELECTED ";
      $texto.=">".$paises[$i]["nombre"].'</option>';
    }
    $texto.='</select>&nbsp;&nbsp;&nbsp;<select name="departamento_ejecutor_'.$campo.'" id="departamento_ejecutor_'.$campo.'">';
    for($i=0;$i<$departamentos["numcampos"];$i++){
      $texto.='<option value="'.$departamentos[$i]["iddepartamento"].'"';
      if($departamentos[$i]["iddepartamento"]==$municipio[0]["iddepartamento"])
        $texto.=" SELECTED ";
      $texto.=">".$departamentos[$i]["nombre"].'</option>';
    }
    $texto.='</select>&nbsp;&nbsp;&nbsp;<select name="'.$campo.'" id="'.$campo.'">';
    for($i=0;$i<$municipios["numcampos"];$i++){
      $texto.='<option value="'.$municipios[$i]["idmunicipio"].'"';
      if($municipios[$i]["idmunicipio"]==$municipio[0]["idmunicipio"])
        $texto.=" SELECTED ";
      $texto.=">".$municipios[$i]["nombre"].'</option>';
    }
    $texto.='</select><a style="cursor:pointer" id="nuevo_municipio_'.$campo.'">Otro</a>';

  }
return($texto);
}

?>
