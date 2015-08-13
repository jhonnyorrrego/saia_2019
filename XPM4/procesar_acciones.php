<?php
include_once("class_correo.php");
$correo=new correo_saia();
$correo->seleccionar_carpeta($_REQUEST["carpeta"]);
include_once("../header.php");
include_once("../db.php");
?>
<script>
document.getElementById("header").style.display="none";
document.getElementById("ocultar").style.display="none";
</script>
<?php
if($_REQUEST['accion']=='vista_previa'&&$_REQUEST["key"])
  {visualizar_correo();
  }
elseif($_REQUEST['accion']=='configurar_formatos')
  {configurar_formatos();
  }
elseif($_REQUEST['accion']=='listar_campos')
  {if($_REQUEST['campo']=="contenido_mensaje")
      $_REQUEST['campo']="contenido";
   buscar_campos($_REQUEST['idformato'],$_REQUEST['tipo'],$_REQUEST['campo']);
  }  
elseif($_REQUEST['accion']=='guardar_configuracion')
  {guardar_configuracion_formato();
  } 
elseif($_REQUEST['accion']=='actualizar_correos'&&$_REQUEST['carpeta'])
  {$correo->actualizar_correos($_REQUEST['carpeta']);
  } 
elseif($_REQUEST['accion']=='eliminar_mensaje'&&$_REQUEST['idmensaje'])
  {$correo->copiar_mover_mensaje($_REQUEST['idmensaje'],"[Gmail]/Papelera","mover");
  } 
elseif($_REQUEST['accion']=='no_leido'&&$_REQUEST['idmensaje'])
  {$correo->marcar_no_leido($_REQUEST['idmensaje']);
  }  
elseif($_REQUEST['accion']=='formulario_buscar'&&$_REQUEST['carpeta'])
  {formulario_buscar($_REQUEST['carpeta']);
  } 
elseif($_REQUEST['accion']=='procesar_busqueda'&&$_REQUEST['carpeta'])
  {procesar_busqueda();
  }  
            
function configurar_formatos()
{global $conn;
 $formatos=busca_filtro_tabla("etiqueta,idformato","formato","mostrar=1","lower(etiqueta)",$conn);
 $opciones='<option value="">Seleccionar...</option>';
 for($i=0;$i<$formatos["numcampos"];$i++)
   $opciones.='<option value="'.$formatos[$i]["idformato"].'">'.$formatos[$i]["etiqueta"].'</option>';
?>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.validate.js"></script>
<script>
function listar_campos(formato,tipo,div)
  {$.ajax({
      url: "procesar_acciones.php",
      data:"accion=listar_campos&idformato="+formato+"&tipo="+tipo+"&campo="+div, 
      type: "post",
      success: function(msg){
        datos=msg.split("|@|"); 
        $("#div_"+div).html("<select name='"+div+"'><option value=''>Seleccionar...</option>"+datos[1]+"</select>");
      }
    });
   
  }
$().ready(function() {
  $('#form1').validate(); 
  $("#formato").change(function(){
   listar_campos($("#formato option[selected]").val(),"datetime,text,textarea","fecha");
   listar_campos($("#formato option[selected]").val(),"text,textarea","de");
   listar_campos($("#formato option[selected]").val(),"text,textarea","para");
   listar_campos($("#formato option[selected]").val(),"text,textarea","asunto");
   listar_campos($("#formato option[selected]").val(),"textarea","contenido_mensaje");
  })
});
</script><b>RELACION ENTRE LOS CAMPOS DEL MENSAJE Y LOS DEL FORMATO</b>
<form name="form1" id="form1">
  <table>
    <tr>
      <td class="encabezado">Formato:</td><td>
        <select name="formato" class="required" id="formato">
          <?php echo $opciones; ?>
        </select></td>
    </tr>
    <tr>
      <td class="encabezado">Fecha:</td><td>
        <div id="div_fecha">
        </div></td>
    </tr>
    <tr>
      <td class="encabezado">De:</td><td>
        <div id="div_de">
        </div></td>
    </tr>
    <tr>
      <td class="encabezado">Para:</td><td>
        <div id="div_para">
        </div></td>
    </tr>
    <tr>
      <td class="encabezado">Asunto:</td><td>
        <div id="div_asunto">
        </div></td>
    </tr>
    <tr>
      <td class="encabezado">Contenido:</td><td>
        <div id="div_contenido_mensaje">
        </div></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" value="Guardar">
        <input type="hidden" name="accion" value="guardar_configuracion"></td>
    </tr>
  </table>
</form>
<?php
}
function guardar_configuracion_formato()
{phpmkr_query("delete from mensaje_formato where formato_idformato=".$_REQUEST["formato"]);
 if($_REQUEST["para"])
    phpmkr_query("insert into mensaje_formato(formato_idformato,campo_mensaje,campo_formato) values('".$_REQUEST["formato"]."','para','".$_REQUEST["para"]."')");
 if($_REQUEST["de"])
    phpmkr_query("insert into mensaje_formato(formato_idformato,campo_mensaje,campo_formato) values('".$_REQUEST["formato"]."','de','".$_REQUEST["de"]."')");
 if($_REQUEST["asunto"])
    phpmkr_query("insert into mensaje_formato(formato_idformato,campo_mensaje,campo_formato) values('".$_REQUEST["formato"]."','asunto','".$_REQUEST["asunto"]."')");
 if($_REQUEST["fecha"])
    phpmkr_query("insert into mensaje_formato(formato_idformato,campo_mensaje,campo_formato) values('".$_REQUEST["formato"]."','fecha','".$_REQUEST["fecha"]."')");
 if($_REQUEST["contenido_mensaje"])
    phpmkr_query("insert into mensaje_formato(formato_idformato,campo_mensaje,campo_formato) values('".$_REQUEST["formato"]."','contenido','".$_REQUEST["contenido_mensaje"]."')");
 alerta("Datos guardados.");
 echo '<script>window.parent.hs.close();</script>';               
}
function buscar_campos($idformato,$tipo,$campo)
{global $conn;
 $cadena="";
 $seleccionado=busca_filtro_tabla("campo_formato","mensaje_formato","formato_idformato=$idformato and campo_mensaje='".$campo."'","",$conn);
 $listado=extrae_campo($seleccionado,"campo_formato","");
 $formatos=busca_filtro_tabla("etiqueta,etiqueta_html,nombre","campos_formato","formato_idformato=$idformato and etiqueta_html in('".implode("','",explode(",",$tipo))."')","lower(etiqueta)",$conn);
 for($i=0;$i<$formatos["numcampos"];$i++)
   {$cadena.='<option value="'.$formatos[$i]["nombre"].'"';
    if(in_array($formatos[$i]["nombre"],$listado))
      $cadena.=' selected ';
    $cadena.='>'.$formatos[$i]["etiqueta"]."(".$formatos[$i]["etiqueta_html"].')</option>';
   }
 echo '|@|'.$cadena."|@|";  
}
function visualizar_correo()
{global $correo,$conn;
 $info=$correo->listar_mensaje($_REQUEST["key"]);
 phpmkr_query("update correo_usuario set estado='Read' where idcorreo=".$_REQUEST["key"]);
 $formatos=busca_filtro_tabla("etiqueta,ruta_adicionar,nombre","formato","mostrar=1","lower(etiqueta)",$conn);
   echo '<script src="../js/jquery.js"></script>
         <script>
         window.parent.actualizar_grid();
         function procesar_formulario()
           {$("#form1").attr("action","../formatos/"+$("#ruta option[selected]").val());
            
            //$("#anexos_mensaje_post").val($(":checkbox").map(function() {return this.value;}).get().join(","));
            $("#form1").submit();
           }
         </script>
         <form name="form1" id="form1" method="post">
         <table width="100%">
         <tr><td class="encabezado">Usar los campos para crear</td><td><select name="ruta" id="ruta">';
  for($i=0;$i<$formatos["numcampos"];$i++)
     echo '<option value="'.$formatos[$i]["nombre"].'/'.$formatos[$i]["ruta_adicionar"].'">'.$formatos[$i]["etiqueta"].'</option>';      
  echo '<input type="button" value="Crear" onclick="procesar_formulario()"></td></tr>
         <tr><td class="encabezado">Adjuntos</td><td>';
  $lista=agregar_checkboxes($info["anexos"]);
  echo   $lista;
  echo   '</td></tr>
         <tr><td class="encabezado">Fecha</td><td>'.$info["fecha"].'
         <input type="hidden" name="post_fecha" value="'.urlencode($info["fecha"]).'">
         </td></tr>
         <tr><td class="encabezado">De</td><td>'.$info["de"].'
         <input type="hidden" name="post_de" value="'.urlencode($info["de"]).'">
         </td></tr>
         <tr><td class="encabezado">Para</td><td>'.$info["para"].'
         <input type="hidden" name="post_para" value="'.urlencode($info["para"]).'">
         </td></tr>
         <tr><td class="encabezado">Copia</td><td>'.$info["copia"].'
         <input type="hidden" name="post_para" value="'.urlencode($info["copia"]).'">
         </td></tr>
         <tr><td class="encabezado">Copia oculta</td><td>'.$info["copia_oculta"].'
         <input type="hidden" name="post_para" value="'.urlencode($info["copia_oculta"]).'">
         </td></tr>
         <tr><td class="encabezado">Asunto</td><td>'.$info["asunto"].'
         <input type="hidden" name="post_asunto"  id="post_asunto" value="'.urlencode($info["asunto"]).'">
         </td></tr>
         <tr><td class="encabezado">Contenido</td><td>'.nl2br($info["contenido"]).'      <input type="hidden" name="post_contenido" id="post_contenido" value="'.urlencode(nl2br($info["contenido"])).'">
         </td></tr>
         <input type="hidden" name="parsear_post" value="1">
         <input type="hidden" name="post_carpeta_mensaje" value="'.$info["carpeta"].'">
         </table>
         </form>';
} 
function agregar_checkboxes($listado)
{$nuevo=array();
 foreach($listado as $fila)
   $nuevo[]="<input type='checkbox' name='post_anexos_mensaje[]' value='".$fila["mensaje"]."@".$fila["parte"]."'><a href='descargar_anexo.php?parte=".$fila["parte"]."&mensaje=".$fila["mensaje"].'&carpeta='.$_REQUEST["carpeta"]."'>".$fila["nombre"].'</a>';
 return(implode(" ",$nuevo));  
}
function formulario_buscar($carpeta)
{include_once("../calendario/calendario.php");
 ?> <b>BUSCAR MENSAJES EN LA CARPETA 
  <?php echo $carpeta; ?></b><br /><br /> 
<form name="form1" method="post"> 
  <table> 
    <tr> 
      <td class="encabezado">FECHA</td> <td>Mayor o igual que   
        <input type="text" name="SINCE">
        <?php selector_fecha("SINCE","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR"); ?>   
        <br>y Menor o igual que 
        <input type="text" name="BEFORE">
        <?php selector_fecha("BEFORE","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR"); ?> </td> 
    </tr> 
    <tr> 
      <td class="encabezado">DE</td> <td>
        <input type="text" name="FROM"></td> 
    </tr> 
    <tr> 
      <td class="encabezado">PARA</td> <td>
        <input type="text" name="TO"></td> 
    </tr> 
    <tr> 
      <td class="encabezado">ASUNTO</td> <td>
        <input type="text" name="SUBJECT"></td> 
    </tr> 
    <tr> 
      <td class="encabezado">CONTENIDO</td> <td>
        <input type="text" name="BODY"></td> 
    </tr> 
    <tr> 
      <td class="encabezado">ESTADO</td> <td>
        <input type="radio" name="estado" value='SEEN'>Le&iacute;do 
        <input type="radio" name="estado" value='UNSEEN'>No Le&iacute;do</td> 
    </tr> 
    <tr> 
      <td colspan="2"> 
        <input type="submit" value="Buscar"> 
        <input type="hidden" value="procesar_busqueda" name="accion"> 
        <input type="hidden" value="<?php echo $carpeta; ?>" name="carpeta"> </td> 
    </tr> 
  </table> 
</form> 
<?php
}
function procesar_busqueda()
{global $correo;
 $campos=array("BEFORE","SINCE","SUBJECT","TO","FROM","BODY","estado");
 $condicion="";
 if($_REQUEST["BEFORE"]==$_REQUEST["SINCE"] && $_REQUEST["SINCE"]<>"")
   {$condicion.=" ON \"".$_REQUEST["BEFORE"]."\" ";
    $_REQUEST["BEFORE"]=$_REQUEST["SINCE"]="";
   }
 foreach($campos as $nombre)
   {if($_REQUEST[$nombre]<>"")
      {if($nombre=="estado") 
         $condicion.=" ".$_REQUEST[$nombre]." ";
       else
         $condicion.=" ".$nombre." \"".$_REQUEST[$nombre]."\" ";  
      }
   }
 if(!$correo->buscar_mensajes($condicion))
   {alerta("No se encontraron mensajes que coincidan con la busqueda.");
    volver(1);
   }
 else
   {alerta("Mensajes encontrados.");
    echo '<script>window.parent.actualizar_grid(); window.parent.hs.close();</script>';
   }  
}   
include_once("../footer.php");  
?>