<?php
include_once("../../db.php");

function codigo_autocom(){
  global $conn; 
 $iddoc= $_REQUEST["iddoc"];
  $codigo=busca_filtro_tabla("codigo_ciiu","ft_certificado_vertimiento","documento_iddocumento=".$iddoc,"",$conn);
    //print_r($codigo);
    echo '<td>
           <input type="text" name="codigo_ciiu" id="codigo_ciiu" value="'.$codigo[0]["codigo_ciiu"].'" size="25">              
           </td>'; 
 
  ?>
  <script type='text/javascript' src='../../js/jquery.js'></script>
<script type='text/javascript' src='../../js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="../../css/jquery.autocomplete.css"/>
<script>
 $(document).ready(function(){
     $("#codigo_ciiu").autocomplete('seleccionar_codigo.php',{
        width: 250,
        max:10,
        scroll: true,
        scrollHeight: 150,
        matchContains: true,
        minChars:1,
        formatItem: formatItem,
        formatResult: function(row) {
        return row[0];
    }
    });
   // alert("#codigo_ciiu");
   // alert($("#codigo_ciiu").attr("value"));  
    $("#codigo_ciiu").result(function(event, data, formatted) {
    $("#codigo_ciiu").val(data[0]);
    $("#nombre").val(data[1]);
    $("#actividad").val(data[2]);
    $("#direccion").val(data[3]);
    $("#descripcion").val(data[4]);
    });
    function formatItem(row) {
      return " (<strong>Documento: " + row[0] + "</strong>)";
    }
    function formatResult(row) {
    return row[0].replace(/(<.+?>)/gi, '');
    }
    });</script><?php 
   
}

function mostrar_vencimiento($idformato,$iddoc=NULL)
{global $conn;

$resultado=busca_filtro_tabla(fecha_db_obtener("fecha_certificado_vertimiento","Y-m-d")." as fecha","ft_certificado_vertimiento","documento_iddocumento=$iddoc","",$conn);
echo fecha(date('Y-m-d',strtotime($resultado[0][0].' + 1 year')));

/* 
$resultado=busca_filtro_tabla(fecha_db_obtener("fecha_certificado_vertimiento","Y-m-d")." as fecha","ft_certificado_vertimiento","documento_iddocumento=$iddoc","",$conn);
echo fecha($resultado[0][0]);*/
}

function insertar_ruta($ruta,$iddoc)
{global $conn;

 for($i=0;$i<count($ruta)-1;$i++)
  {$sql="insert into ".DB.".ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden) values('".$ruta[$i+1]."','".$ruta[$i]."','$iddoc','POR_APROBAR',1,1,$i)" ;
   phpmkr_query($sql);
   $idruta=phpmkr_insert_id();
   $sql="insert into ".DB.".buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]."','".$ruta[$i]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
   phpmkr_query($sql);
  }
}


function crear_ruta($idformato,$iddoc)
{global $conn;
 $ruta[0]=usuario_actual("funcionario_codigo");
 if($_REQUEST["formato"] == "certificado_vertimiento")
  {$ruta[1]="97";// codigo del funcionario que debe firmar luego de quien lo crea
   //$ruta[2]="123";// codigo del funcionario que sigue en la ruta....
  }

 if(count($ruta)>1)
  {$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
   $ruta[]=$radicador_salida[0][0];
   phpmkr_query("delete from buzon_entrada where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
   insertar_ruta($ruta,$iddoc);
  }

}

?>
