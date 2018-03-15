<?php
require_once('lib/nusoap.php');
require_once('define_remoto.php');

function radicacion_verificacion($documento_cliente=51){

$cliente1 = new nusoap_client(SERVIDOR_REMOTO.'webservice_saia/verificacion_cliente/servidor_remoto_verificacion.php');
$err = $cliente1->getError();

if ($err) {
// Display the error
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
// At this point, you know the call that follows will fail
}

$hoy = getdate();

//plantilla--------------------------------------------------

$datos['encabezado']=1;
$datos['ft_cliente']=$documento_cliente;
//$datos['ft_cliente']=15765;
$datos['serie_idserie']=903;
$datos['idft_verificacion']="";
$datos['documento_iddocumento']="";
$datos['dependencia']='211';
$datos['firma']='1';
$datos['campo_descripcion']=2792;
//$datos['anterior']=$documento_cliente;
$datos['tipo_radicado']='verificacion';
$datos['funcion']='radicar_plantilla';
$datos['tabla']='ft_verificacion';
$datos['formato']='verificacion';
$datos['continuar']='Solicitar Radicado';
$datos['fecha_verificacion']=$hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
$datos['observaciones']="Disponibilidad Base de datos y espacio en disco. Generado a trav&eacute;s de webservice";

$documento=json_encode($datos);
$resultado = $cliente1->call('radicar_documento_remoto', array($documento));

return($resultado);
}
function radicacion_item_verificacion($idftpapa,$iddoc,$tipo,$valor,$observaciones_item){
    $cliente1 = new nusoap_client(SERVIDOR_REMOTO.'webservice_saia/verificacion_cliente/servidor_remoto_verificacion.php');
$err = $cliente1->getError();

if ($err) {
// Display the error
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
// At this point, you know the call that follows will fail
}
$datos_hijo['ft_verificacion']=$idftpapa;
$datos_hijo['tipo_validacion']=$tipo;
$datos_hijo['valor_verificacion']=$valor;
$datos_hijo['observaciones_item']=$observaciones_item;


$documento_item=json_encode($datos_hijo);

$resultado_item = $cliente1->call('radicar_item_tipo_validacion', array($documento_item));


}
?>