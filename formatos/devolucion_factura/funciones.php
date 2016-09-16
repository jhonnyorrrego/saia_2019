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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
function eliminar_pendientes($idformato,$iddoc)
{global $conn;
 $factura=buscar_papa_formato($idformato,$iddoc,'ft_factura_proveedor');
 $sql='delete from asignacion where tarea_idtarea=2 and documento_iddocumento='.$factura;
 phpmkr_query($sql);
 $ir=busca_filtro_tabla("o.documento_iddocumento","ft_factura_proveedor f,ft_otras_compras o","ft_factura_proveedor=idft_factura_proveedor and f.documento_iddocumento=".$factura,"",$conn);
 for($i=0;$i<$ir['numcampos'];$i++)
    {$sql='delete from asignacion where tarea_idtarea=2 and documento_iddocumento='.$ir[$i][0];
     phpmkr_query($sql);
    }
 $op=busca_filtro_tabla("p.documento_iddocumento","ft_factura_proveedor f,ft_otras_compras o,ft_orden_pago p","ft_factura_proveedor=idft_factura_proveedor and ft_otras_compras=idft_otras_compras and f.documento_iddocumento=".$factura,"",$conn);
 for($i=0;$i<$op['numcampos'];$i++)
    {$sql='delete from asignacion where tarea_idtarea=2 and documento_iddocumento='.$op[$i][0];
     phpmkr_query($sql);
    }
    
}
function validar_ingreso_devolucion($idformato,$iddoc){
  global $conn;
  if($iddoc==NULL)
    {$devoluciones=busca_filtro_tabla("iddocumento","ft_devolucion_factura a,documento d","ft_factura_proveedor=".$_REQUEST['padre']." and documento_iddocumento=iddocumento and d.estado not in('ELIMINADO','ANULADO')","",$conn);
     if($devoluciones['numcampos'])
      {alerta(utf8_encode('Ya existe una devoluci�n para esta factura.'));
       redirecciona('../../vacio.php');
       die();
      }
    }
}
function datos_proveedor_devolucion($idformato,$iddoc)
{global $conn;
$padre=busca_filtro_tabla("","ft_factura_proveedor A","A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
$datos_proveedor=busca_filtro_tabla("","datos_ejecutor, ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$padre[0]["prooveedor"],"",$conn);
$texto="<b>".strtoupper($datos_proveedor[0]["nombre"])."</b><br>".$datos_proveedor[0]["identificacion"]."<br>".$datos_prooveedor[0]["empresa"]."<br>".$datos_proveedor[0]["direccion"]."<br>".$datos_proveedor[0]["email"]."<br>";
echo($texto);
//print_r($datos_proveedor);
}
function dependencia_creador($idformato,$iddoc)
{global $conn;
$datos=busca_filtro_tabla("","ft_devolucion_factura","documento_iddocumento=".$iddoc,"",$conn);
$consulta=busca_filtro_tabla("","dependencia_cargo","iddependencia_cargo=".$datos[0]["dependencia"],"",$conn);
$dependencia=busca_filtro_tabla("","dependencia","iddependencia=".$consulta[0]["dependencia_iddependencia"],"",$conn);
echo($dependencia[0]["nombre"]);
}

function nombre_devolucion($idformato,$iddoc)
{global $conn;
$datos=busca_filtro_tabla("","ft_devolucion_factura","documento_iddocumento=".$iddoc,"",$conn);
$consulta=busca_filtro_tabla("","dependencia_cargo, funcionario","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$datos[0]["dependencia"],"",$conn);


echo($consulta[0]["nombres"]." ".$consulta[0]["apellidos"]);
}


//numero_factura_proveedor
function numero_factura_proveedor($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","ft_devolucion_factura","documento_iddocumento=".$iddoc,"",$conn);
$padre=busca_filtro_tabla("","ft_factura_proveedor","idft_factura_proveedor=".$consulta[0]["ft_factura_proveedor"],"",$conn);
echo($padre[0]["num_factura"]);
}

function datos_centro_costos($idformato,$iddoc)
{global $conn;
$datos=busca_filtro_tabla("","ft_devolucion_factura","documento_iddocumento=".$iddoc,"",$conn);
$consulta=busca_filtro_tabla("","dependencia_cargo","iddependencia_cargo=".$datos[0]["dependencia"],"",$conn);
$dependencia=busca_filtro_tabla("","dependencia","iddependencia=".$consulta[0]["dependencia_iddependencia"],"",$conn);
echo($dependencia[0]["codigo"]);
}

function datos_creador($idformato,$iddoc){
 $resultado=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);

 $nombres=explode(" ",$resultado[0]["nombres"]);
 $apellidos=explode(" ",$resultado[0]["apellidos"]);
 $iniciales=$nombres[0][0]."".$nombres[1][0]."".$apellidos[0][0]."".$apellidos[1][0];
  echo($iniciales);
}

function campos_adicionar_devolucion($idformato,$iddoc)
{global $conn;
 $supervisor=busca_filtro_tabla("nombre,identificacion,cargo","ft_factura_proveedor,ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=prooveedor and documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
 $datos="Nombre: ".$supervisor[0]["nombre"]."\nIdentificacion: ".$supervisor[0]["identificacion"]."\nCargo: ".$supervisor[0]["cargo"]."\nEmpresa: ".$supervisor[0]["empresa"]."\nDireccion: ".$supervisor[0]["direccion"]."\nTelefono: ".$supervisor[0]["telefono"]."\nEmail: ".$supervisor[0]["email"];   
 $texto.="<tr id='tr_datos_proveedor'> 
          <td class='encabezado' width='20%'' title=''>DATOS PROVEEDOR*</td>
          <td bgcolor='#F5F5F5'> 
            <textarea  tabindex='9'  name='descripcion_reclmacion' readonly id='descripcion_reclmacion' cols='60' rows='7' reonlyclass='tiny_basico required'>".$datos."</textarea></td></tr>
<tr id='tr_proveedor1'>
                     <td class='encabezado' width='20%' title=''>CAMBIAR PROVEEDOR*</td><td bgcolor='#F5F5F5'><table border='0'><tr><td><label for='proveedor_tipo0'><input type='radio' class='required' name='proveedor_tipo' id='proveedor_tipo0' value='1'>Si</label></td><td><label for='proveedor_tipo1'><input type='radio'  name='proveedor_tipo' id='proveedor_tipo1' value='2'>No</label></td><tr><td colspan='3'></td></tr></table></td></tr>";            
echo($texto);    
}  

function validar_cambio_proveedor($idformato,$iddoc)
{global $conn;
 $supervisor=busca_filtro_tabla("nombre","ft_factura_proveedor,ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=prooveedor and documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
 ?>  
<script>

 $("#tr_proveedor").hide();
 $('[name="proveedor_tipo"]').click(function(){
    tipo=$(':checked[name="proveedor_tipo"]').val();
    if(tipo==1)
    {
     $("#tr_proveedor").show();
     }else if(tipo==2){
      $('#proveedor').val('<?php echo $supervisor[0]["proveedor"]; ?>');   
 direccion=$('#frame_proveedor').attr('src');
 $('#frame_proveedor').attr('src',direccion+'&destinos=".$supervisor[0]["proveedor"]."');
   $("#tr_proveedor").hide(); 
    }
  })
</script>
<?php
}
function mostrar_anexos_devolucion($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_devolucion_factura","documento_iddocumento=".$iddoc,"",$conn);


$anexo1=busca_filtro_tabla("","anexos","documento_iddocumento=$iddoc and campos_formato=2921","",$conn);
$arr=array();
for($j=0;$j<$anexo1["numcampos"];$j++){
$etiqueta=$anexo1[$j]['etiqueta'];
array_push($arr,'<a href="'.$ruta_db_superior.'../../anexosdigitales/parsea_accion_archivo.php?idanexo='.$anexo1[$j]["idanexos"].'&accion=descargar">'.html_entity_decode($etiqueta).'</a>');
}
$texto1.=implode(", ",$arr);
if($anexo1["numcampos"]){echo("Anexos:".$texto1);}

}
$datos=Null;



function archivo_papa($idformato,$iddoc){
	global $conn,$datos;
	echo $datos[0]["archivo_ubicacion"];
}
function transferir_devolucion($idformato,$iddoc){
	global $conn;
global $conn;
  $ruta=array();     
  $contabilida=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_devolucion_factura B","lower(A.cargo) like '%jefe%rea%' AND lower(A.dependencia) like '%contabilidad%' AND B.documento_iddocumento=". $iddoc,"",$conn);
 //print_r($contabilida);
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado

array_push($ruta,array("funcionario"=>$contabilida[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
if(count($ruta)>0){
  phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo=.'$iddoc'. and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}
?>