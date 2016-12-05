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
include_once($ruta_db_superior."header.php");
           include_once($ruta_db_superior.'librerias_saia.php');
           	echo(librerias_jquery("1.7"));
           	echo(librerias_jqcrop());
            echo(estilo_bootstrap());

if(@$_REQUEST["proceso"]){
  if(@$_REQUEST["w"]>10 && @$_REQUEST["h"]>10){
    $sql="UPDATE ft_proceso SET coordenadas='".$_REQUEST["x"].",".$_REQUEST["y"].",".$_REQUEST["x2"].",".$_REQUEST["y2"]."' WHERE idft_proceso=".$_REQUEST["proceso"];
    //echo($sql);
    phpmkr_query($sql,$conn);
  }
  
}

if(is_uploaded_file(@$_FILES['imagen_mapa']['tmp_name']) && $_FILES['imagen_mapa']['size']){
  rename("mapa_proceso.jpg","mapa_proceso_".date("YmdHis").".jpg");
  if(move_uploaded_file(@$_FILES['imagen_mapa']['tmp_name'],"mapa_proceso.jpg"))
    alerta("Imagen Modificada con Exito");  
    
} 
 
 

$arreglo=array("vision","mision","objetivos_calidad","politica_calidad","manual_calidad");
foreach($arreglo AS $imagen){

if(is_uploaded_file(@$_FILES['imagen_'.$imagen]['tmp_name'])){

$anexo_ext=explode(".",$_FILES['imagen_'.$imagen]['name']);
$cantidad=count($anexo_ext)-1;
$mayus=strtoupper($anexo_ext[$cantidad]);

$fecha_temp=date("YmdHis"); 
$extension=buscar_archivo($imagen);

rename($ruta_db_superior."imagenes/".strtoupper($imagen).".".$extension,$ruta_db_superior."imagenes/".strtoupper($imagen)."_".$fecha_temp.".".$extension);
  if(move_uploaded_file(@$_FILES['imagen_'.$imagen]['tmp_name'],$ruta_db_superior."imagenes/".strtoupper($imagen).".".$mayus)){
   alerta($imagen." Modificada con Exito");
  } else{
  rename($ruta_db_superior."imagenes/".strtoupper($imagen)."_".$fecha_temp.$extension,"".strtoupper($imagen).$extension);
  } 

}
} 


 
function buscar_archivo($imagen){

$path2="../../imagenes";

$prueba=file_exists($path2);

$directorio=dir($path2);
  
while ($archivo = $directorio->read())
{  
$nom_arc=explode(".",$archivo);
$ultimo=count($nom_arc)-1;

if($nom_arc[0]==strtoupper($imagen)){
$ext= ($nom_arc[1]);

}
}
 
 return $ext; 
}

function encontrar_extension ($fichero) {  
       
$fichero = strtolower($fichero) ;  
$extension = split("[/\\.]", $fichero) ;  
$n = count($extension)-1;  
$extension = $extension[$n];  
return $extension;  
}   
  


if(is_uploaded_file(@$_FILES['imagen_mision']['tmp_name']) && $_FILES['imagen_mision']['size']){
  rename("MISION.JPG","vision_".date("YmdHis").".JPG");
  if(move_uploaded_file(@$_FILES['imagen_mision']['tmp_name'],"../../imgenes/MISION.JPG"))
    alerta("Imagen Modificada con Exito");  
    
}

if(is_uploaded_file(@$_FILES['imagen_objetivos']['tmp_name']) && $_FILES['imagen_objetivos']['size']){
  rename("OBJETIVOS DE CALIDAD.JPG","OBJETIVOS DE CALIDAD_".date("YmdHis").".JPG");
  if(move_uploaded_file(@$_FILES['imagen_objetivos']['tmp_name'],"../../imgenes/OBJETIVOS DE CALIDAD.JPG"))
    alerta("Imagen Modificada con Exito");  
    
}

if(is_uploaded_file(@$_FILES['imagen_politicas']['tmp_name']) && $_FILES['imagen_politicas']['size']){
  rename("POLITICA DE CALIDAD.JPG","POLITICA DE CALIDAD_".date("YmdHis").".JPG");
  if(move_uploaded_file(@$_FILES['imagen_politicas']['tmp_name'],"../../imgenes/POLITICA DE CALIDAD.JPG"))
    alerta("Imagen Modificada con Exito");  
    
}


$formato=busca_filtro_tabla("idformato,nombre,ruta_mostrar","formato","nombre_tabla='ft_proceso'","",$conn);
$proceso=busca_filtro_tabla("","ft_proceso A, documento B","documento_iddocumento=iddocumento AND lower(B.estado)='aprobado'","",$conn);
$ok=@$_REQUEST["editar"]; 
?>
<html>
	<head>
	<?php if($ok){  ?>
		<script src="../../js/jquery.js"></script>
		<script src="../../js/jquery.Jcrop.pack.js"></script>
		<link rel="stylesheet" href="../../css/jquery.Jcrop.css" type="text/css" />
		<script type='text/javascript'>
    	// Remember to invoke within jQuery(window).load(...)
			// If you don't, Jcrop may not initialize properly
			jQuery(document).ready(function(){
        // validar los campos del formato
	      //jQuery('#formulario_formatos').validate();
				jQuery('#cropbox').Jcrop({
					onSelect: showCoords
				});
			// Our simple event handler, called from onChange and onSelect
			// event handlers, as per the Jcrop invocation above
			function showCoords(c){
				jQuery('#x').val(c.x);
				jQuery('#y').val(c.y);
				jQuery('#x2').val(c.x2);
				jQuery('#y2').val(c.y2);
				jQuery('#w').val(c.w);
				jQuery('#h').val(c.h);
			 };
			});
    -->
		</script>
		<?php } ?>
	</head>
	<body>
	<style>
		img{
			max-width:none;
		} 	
	</style>

        <style>
            .table{
                margin:10px;
                max-width:96%;
                width:96%;
                border-radius:5px;
            }
            .table tr th{
                text-align:center;
                font-size:12pt;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
            }
            .version_estado .pull-left span{
                font-weight:bold;
            }
            .version_estado .pull-right span{
                font-weight:bold;
            }            
            .version_estado .pull-left,.pull-right{
                font-size:7pt;
            }
           
        </style>
    
	    
	    
	<table border="0px" class="table">
	<?php if($ok){ ?>                                            
		<?php }
    ?>

    <?php
    $nombre_mapa_proceso=busca_filtro_tabla("etiqueta","formato","lower(nombre)='proceso'","",$conn);
    ?>


    <tr><th colspan="2" class="encabezado_list"><?php echo(html_entity_decode($nombre_mapa_proceso[0]['etiqueta'])); ?></th></tr>
    <tr><td colspan="2" style="text-align:center;">
    
    <?php
    $iddoc_mapa_proceso=busca_filtro_tabla("a.descripcion_base,a.documento_iddocumento","ft_bases_calidad a, serie b,documento c","lower(c.estado)='aprobado' AND a.documento_iddocumento=c.iddocumento AND a.tipo_base_calidad=b.idserie AND lower(b.nombre) LIKE'mapa de proceso%' ","",$conn);
    $mapa_proceso=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc_mapa_proceso[0]['documento_iddocumento'],"",$conn);
    if(!$mapa_proceso['numcampos']){
       include_once($ruta_db_superior.'librerias_saia.php');
       echo(estilo_bootstrap());        
        echo('<hr/><div class="well alert-warning"><strong>ATENCI&Oacute;N</strong> <br/>A&uacute;n no s&eacute; ha creado el Mapa de Proceso</div><hr/></td></tr></table>');
        die();
    }    
    ?>
        
        
    <img src="<?php echo($ruta_db_superior.$mapa_proceso[0]['ruta']); ?>" id="cropbox" border="0" usemap="#Map" />    
    <!-- img src="mapa_proceso.jpg" id="cropbox" border="0" usemap="#Map" / -->
		<map name="Map">
		
		<?php
      for($i=0;$i<$proceso["numcampos"];$i++){
        echo('<area shape="rect" coords="'.$proceso[$i]["coordenadas"].'" href="Javascript: seleccionar_doc(\''.$proceso[$i]["idft_proceso"].'\',\''.$formato[0]["idformato"].'\',\''.$proceso[$i]["documento_iddocumento"].'\')">
        ');
      } 
    ?>
    </map>
    <script>
    function seleccionar_doc(id,formato,doc)
      {window.parent.frames[0].tree_calidad.selectItem(formato+"-idft_proceso-"+id,true,false);
       window.location="mostrar_proceso.php?iddoc="+doc+"&idformato="+formato;
      }
    </script>
    </td>
    </tr>
    
    <?php
    

      
    if(!$ok){
    ?>
        <tr>
            <td colspan="2">
                <?php echo($iddoc_mapa_proceso[0]['descripcion_base']); ?>
            </td>
        </tr>      
        <?php 
        $permiso_admin_calidad=new Permiso();
		$permiso_modulo_admin_calidad=$permiso_admin_calidad->acceso_modulo_perfil("administracion_calidad");
		if($permiso_modulo_admin_calidad){
        ?>
        <tr>
            <td colspan="2">
                <a class="btn btn-mini pull-left" title="Administración del arbol de calidad." href="../proceso/previo_mostrar_proceso.php?editar=1"  onclick=" ">	    
                    <i class="icon-pencil"></i>	<span>Editar</span> 
                </a>
                <a class="btn btn-mini pull-left" title="Administración del arbol de calidad." href="<?php echo($ruta_db_superior); ?>documento_trasladar2.php"  onclick=" ">	    
                    <i class="icon-share"></i>	<span>Trasladar Documentos</span> 
                </a>                
            </td>
        </tr>
        <?php 
		} //fin permiso administracion_calidad  
        ?>
    <?php
    }
    ?>
    
   <?php
   if($ok){
   ?>
    <tr><td>
		<form action="#" method="POST" enctype="multipart/form-data" name="formluario_formatos">

			<input type="hidden" size="4" id="x" name="x" />
			<input type="hidden" size="4" id="y" name="y" />
			<input type="hidden" size="4" id="x2" name="x2" />
			<input type="hidden" size="4" id="y2" name="y2" />
			<input type="hidden" size="4" id="w" name="w" />
			<input type="hidden" size="4" id="h" name="h" />
      <input type="hidden" size="4" id="editar" name="editar"  value="0" />
      </td>
      </tr>
      <tr>
       
      <td class="encabezado">Asignar al proceso:</td><td><select name="proceso"><option value="0" selected>Seleccione...</option>
			<?php
       for($i=0;$i<$proceso["numcampos"];$i++){
          echo('<option value="'.$proceso[$i]["idft_proceso"].'">'.$proceso[$i]["nombre"]."</option>");
        }   
      ?>
      </select> 
      
      <script>
          $(document).ready(function(){
              $('[name="proceso"]').change(function(){
                var idft_proceso=$(this).val();
                if(idft_proceso!=0){
                    $.ajax({
                            type:'POST',
                            dataType: 'json',
                            url: "traer_cordenadas_proceso.php",
                            data: {
                                idft_proceso:idft_proceso
                            },
                            success: function(datos){
                                if(datos.coordenadas){
                                    vector_coordenadas=datos.coordenadas.split(',');
                                    $('#cropbox').Jcrop({
                                        setSelect:[parseInt(vector_coordenadas[0]),parseInt(vector_coordenadas[1]),parseInt(vector_coordenadas[2]),parseInt(vector_coordenadas[3])],
                                    });
                                }else{
                                    $('#cropbox').Jcrop({
                                    	setSelect:[0,0,0,0],
                                    });
                                }
                            }
                    });                     
                }else{
                    $('#cropbox').Jcrop({
                    	setSelect:[0,0,0,0],
                    });                    
                }
              });
          });
      </script>
      </td>
      </tr>
      <!-- tr><td class="encabezado">
      Nuevo mapa de proceso:<b></td>
      <td><input type="file" name="imagen_mapa"><br />
      </td>
    </tr>
    <- tr><td class="encabezado" width="20%" title="Anexos digitales"><b>Visi&oacute;n<b></td>
    <td><input type="file" maxlenght="3000"  class='multi'  name="imagen_vision"></td></tr>
    <tr><td class="encabezado" width="20%" title="Anexos digitales"><b>Misi&oacute;n<b></td>
    <td><input type="file" maxlenght="3000"  class='multi'  name="imagen_mision"></td></tr>
    <tr> <td class="encabezado" width="20%" title="Anexos digitales"><b>Pol&iacute;ticas de calidad<b></td>
    <td><input type="file" maxlenght="3000"  class='multi'  name="imagen_politica_calidad"></td></tr>
    <tr><td class="encabezado" width="20%" title="Anexos digitales"><b>Objetivos de calidad<b></td>
    <td><input type="file" maxlenght="3000"  class='multi'  name="imagen_objetivos_calidad"></td></tr>
    <!--tr><td class="encabezado" width="20%" title="Anexos digitales"><b>Manual de Operaciones y calidad<b></td>
    <td><input type="file" maxlenght="3000"  class='multi'  name="imagen_manual_calidad"></td></tr-->
    <tr><td colspan="2" align="center"><input class="btn btn-mini" type="submit" value="Vincular"></td></tr>
    
		</form>
   <?php
   }
   ?> 
   </table>
	</body>
</html>
<?php include_once("../../footer.php");?>