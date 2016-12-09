<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");

//if(usuario_actual("login") == "0k"){
	ini_set("display_errors",true);
//}

function enlace_planes($idformato,$iddoc){
  global $conn;
  $seg=busca_filtro_tabla("idft_seguimiento_indicador","ft_seguimiento_indicador","documento_iddocumento=".$iddoc,"",$conn);  
  if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1)
    echo"<a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 500, height:300,preserveContent:false } )'  href='../indicadores_calidad/planes_relacionados.php?tipo=seguimiento&seguimiento_indicador=".$seg[0]["idft_seguimiento_indicador"]."'>Ver Planes</a>";
    
    
    //<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )"  href="planes_relacionados.php?tipo=indicador&seguimiento_indicador=' . $seg[$j]["idft_seguimiento_indicador"] . '">Ver Planes</a>
}
function formulario_variables($idcampo,$idformato,$iddoc=NULL){
  global $conn;
  if($iddoc==NULL&&!@$_REQUEST["iddoc"]){
    $formula=busca_filtro_tabla("nombre","ft_formula_indicador","documento_iddocumento=".$_REQUEST["anterior"],"",$conn);   
  }else{
  	if(@$_REQUEST["iddoc"])$iddoc=$_REQUEST["iddoc"];
    $formula=busca_filtro_tabla("nombre","ft_formula_indicador","documento_iddocumento=(select origen from respuesta where destino='$iddoc')","",$conn);
  } 
  preg_match_all("([A-Za-z_]+[0-9]*)",$formula[0]["nombre"],$resultados);
  $lista=implode(";",$resultados[0]);
  $variables=busca_filtro_tabla("resultado","ft_seguimiento_indicador","documento_iddocumento=$iddoc","",$conn);
  echo "<td><table width='100%'><input type='hidden' id='resultado' class='required' name='resultado' value='".@$variables[0][0]."'>";
  if($iddoc<>NULL){
    $valores=array();
    $vector=explode(";",$variables[0][0]);
    foreach($vector as $fila){
      $aux=explode(":",$fila);
      $valores[$aux[0]]=$aux[1];
    }
  } 
  foreach($resultados[0] as $var){
    echo "<tr><td>".$var."*</td><td><input type='text' name='".$var."' id='".$var."' value='".@$valores[$var]."' onkeyup='validar_variables(\"$lista\")' class='required number' ></td></tr>";
  }   
  echo "</table></td>";
}
function mostrar_variables($idformato,$iddoc){
  global $conn;
  $variables=busca_filtro_tabla("resultado","ft_seguimiento_indicador","documento_iddocumento=$iddoc","",$conn);
  echo "<table>";
  for($i=0;$i<=count($resultados);$i++){
    $valores=array();
    $vector=explode(";",$variables[0][0]);
    foreach($vector as $fila){
      $aux=explode(":",$fila);
      echo "<tr><td width='30%' ><b>".$aux[0].":</b></td><td>".$aux[1]."</td></tr>";
    }
  }
  echo "</table>";      
} 
function validar_fecha_seguimiento($idformato,$iddoc){
  global $conn;
  
?>
	<script>
		$('#formulario_formatos').validate({
        	submitHandler: function(form){
            	var fecha = $("#fecha_seguimiento").val().split(" ");
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
	
				if(fecha[0]>fecha2){
					alert('La fecha no puede ser superior a la de hoy!');
					$("#fecha_seguimiento").focus();
					return false;
				}
				form.submit();
	    	}        
		});
	</script>
<?php  
  	
}
?>
<script>
function validar_variables(lista){
  vector=lista.split(";");
  vacios=0;
  valores=new Array;
  for(i=0;i<vector.length;i++){
    if($("#"+vector[i]).valid()==0){
      vacios++;
      break;
    }
    else
      valores[i]=vector[i]+":"+$("#"+vector[i]).val(); 
   }
 if(vacios==0){
   $("#resultado").val(valores.join(";"));
 }  
}
</script>
