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
echo(estilo_bootstrap());

if(@$_REQUEST['iddoc']){
    $iddoc=$_REQUEST['iddoc'];
    
    $datos=busca_filtro_tabla("","ft_bases_calidad a, documento b","b.iddocumento=a.documento_iddocumento AND lower(b.estado)='aprobado' AND a.documento_iddocumento=".$iddoc,"",$conn);
    $serie_seleccionada=busca_filtro_tabla("","serie","estado=1 and idserie=".$datos[0]['tipo_base_calidad'],"",$conn);
    
    
    $style='
        <style>
            .table{
                margin:10px;
                width:97%;
                border-radius:5px;
            }
            .table th{
                text-align:center;
                font-size:12pt;
               
                border-top-left-radius: 5px;
            }
            .table td{
                
            }
        </style>
    
    ';
    
    $tabla=$style.'<table class="table table-bordered">';
    
    $tabla.='
        <tr>
            <th class="encabezado_list">'.strtoupper(utf8_encode(html_entity_decode($serie_seleccionada[0]['nombre']))).'</th>
        </tr>
        <tr>
            <td>'.$datos[0]['descripcion_base'].'</td>
        </tr>        
    ';
    
    
    $tabla.='</table>';
    echo($tabla);
}

die();
?>