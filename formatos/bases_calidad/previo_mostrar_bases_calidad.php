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
    $condicion="";
    if($iddoc!='todos'){
        $condicion=" AND a.documento_iddocumento=".$iddoc;
    }
    
    
    $datos=busca_filtro_tabla("","ft_bases_calidad a, documento b","b.iddocumento=a.documento_iddocumento AND lower(b.estado)='aprobado'".$condicion,"",$conn);
    
    
    
    $style='
        <style>
            .table{
                margin:10px;
                width:97%;
                border-radius:5px;
            }
            .table tr th{
                text-align:center;
                font-size:12pt;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
            }
            .version_estado span{
                font-weight:bold;
            }
        </style>
    
    ';
    
    for($i=0;$i<$datos['numcampos'];$i++){
        $serie_seleccionada=busca_filtro_tabla("","serie","estado=1 and idserie=".$datos[$i]['tipo_base_calidad'],"",$conn);
        
        $tabla=$style.'<table class="table table-bordered">';
        
        $tabla.='
            <tr>
                <th class="encabezado_list">'.strtoupper(utf8_encode(html_entity_decode($serie_seleccionada[0]['nombre']))).'</th>
            </tr>
            <tr>
                <td>'.$datos[0]['descripcion_base'].'</td>
            </tr> 
            <tr>
                <td class="version_estado"><span>Version:</span> &nbsp; '.$datos[0]['version_base_calidad'].'</td>
            </tr>
            <tr>
                <td class="version_estado"><span>Estado:</span> &nbsp; '.$datos[0]['estado_base_calidad'].' </td>
            </tr>         
        ';
        
        
        $tabla.='</table>';        
        
    }
    

    echo($tabla);
}

die();
?>