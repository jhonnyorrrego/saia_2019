<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
//ini_set("display_errors",true);
echo(estilo_bootstrap());
$condicional=busca_filtro_tabla("","paso_condicional A, paso_condicional_admin B","B.estado=1 AND A.idpaso_condicional=B.fk_paso_condicional AND A.idpaso_condicional=".$_REQUEST["idpaso_condicional"],"B.orden ASC",$conn);
if($condicional["numcampos"]){
  $nombre_condicional=$condicional[0]["etiqueta"];
}
else{
  $condicional2=busca_filtro_tabla("","paso_condicional","idpaso_condicional=".$_REQUEST["idpaso_condicional"],"",$conn);
  $nombre_condicional=@$condicional2[0]["etiqueta"];
}
?>
Condicionales: <b> <?php echo($nombre_condicional);?></b><br>
<?php 
$texto='';
$texto.='<br><div><b><a href="'.$ruta_db_superior.'bpmn/condicional/adicionar_condicional.php?idpaso_condicional='.$_REQUEST["idpaso_condicional"].'"><i class="icon-plus"></i> Adicionar Condicional</a></b></div><br>';
if($condicional["numcampos"]){
  $texto.='<table class="table">';
  $texto_formato='';
  //TODO: Se debe evaluar si se implementa que no pueda poner varias condiciones direccionadas al mismo paso por problemas de posible entrelazado a posos diferentes en codiciones diferentes, simpre debe direccionar a un paso siguiente o no ????? 
  $texto.='<thead><tr><th>Formato</th><th>campo</th><th>Comparaci&oacute;n</th><th>Valor</th><th>Pasos si cumple</th><th>Pasos no cumple</th><th>estado</th><th>&nbsp;</th></tr></thead>';
  for($i=0;$i<$condicional["numcampos"];$i++){
    $texto_pasos_no='';
    $texto_pasos_si='';
    if($condicional[$i]["estado"]==1){
      $estado="Activo";
    }  
    else{
      $estado="Inactivo";
    } 
    $formato=busca_filtro_tabla("A.etiqueta AS formato,B.etiqueta AS campo","formato A, campos_formato B","A.idformato=B.formato_idformato AND B.idcampos_formato=".$condicional[$i]["fk_campos_formato"],"",$conn);
    $texto_pasos_si=texto_pasos($condicional[$i]["habilitar_pasos_si"]);
    $texto_pasos_no=texto_pasos($condicional[$i]["habilitar_pasos_no"]);  
    $pasos_no=busca_filtro_tabla("","paso","idpaso IN(".implode().")");
    $icono_editar='<a href="'.$ruta_db_superior.'bpmn/condicional/editar_condicional.php?idpaso_condicional_admin='.$condicional[$i]["idpaso_condicional_admin"].'&idpaso_condicional='.$_REQUEST["idpaso_condicional"].'"><i class="icon-edit"></i></a>';
    $texto.='<tr><td>'.@$formato[0]["formato"].'&nbsp;</td><td>'.$formato[0]["campo"].'&nbsp;</td><td align="center">'.$condicional[$i]["comparacion"].'</td><td>'.$condicional[$i]["valor"].'</td><td>'.$texto_pasos_si.'</td><td>'.$texto_pasos_no.'</td><td>'.$estado.'</td><td>'.$icono_editar.'</td><td> <span name="eliminar_condicional" valor="'.$condicional[$i]["idpaso_condicional_admin"].'" style="cursor:pointer;"><i class="icon-remove" ></i> </span>  </td></tr>';
  }
  $texto.='</table>';
  $texto.='<div id="detalles_actividad"></div>';
}
echo($texto);
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());
function texto_pasos($dato_paso){
$texto='';
if($dato_paso){
  $pasos=busca_filtro_tabla("","paso","idpaso IN(".$dato_paso.")","",$conn);
  if($pasos["numcampos"]){
    $texto.='<ul>';
    for($j=0;$j<$pasos["numcampos"];$j++){
      $texto.='<li>'.$pasos[$j]["nombre_paso"].'</li>';
    }
    $texto.='</ul>';
  }
return($texto);
}
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".tooltip_saia").tooltip();
  });  
  
</script>
<script>
	$(document).ready(function(){				
		$('[name="eliminar_condicional"]').click(function(){	
			if(confirm('Esta seguro de eliminar la condicional')){
					var ruta='condicionales_admin.php?idpaso_condicional=<?php echo($_REQUEST["idpaso_condicional"]); ?>';
                    $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "eliminar_condicional.php",
                        data: {
                               idpaso_condicional_admin:$(this).attr('valor')
                        },
                        success: function(datos){
							notificacion_saia('Condicional eliminada satisfactoriamente','success','',4000);
							window.location=ruta;
                        }
                    });	
                    
              } 		
		});
	});	
</script>