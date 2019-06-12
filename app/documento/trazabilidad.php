<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';


/*
$iddoc = $_REQUEST['documentId'];
$equivalencia = [
    'BORRADOR' => 'CREACION',
    'TRANSFERIDO' => 'REENVIADO',
    'COPIA' => 'REENVIADO',
    'DEVOLUCION' => 'RESPONDIDO',
    'APROBADO' => 'APROBADO',
    'DISTRIBUCION' => 'ENVIO DE DOCUMENTO POR CORREO',
    'REVISADO' => 'VISTO BUENO',
];

$buzon = busca_filtro_tabla("f.idfuncionario,".concatenar_cadena_sql(["f.nombres","' '","f.apellidos"])." as nombre_funcionario,b.fecha,b.nombre as accion", "buzon_salida b,funcionario f", "b.origen=f.funcionario_codigo and b.archivo_idarchivo=".$iddoc." and b.nombre not like ('ELIMINA_%') and b.nombre<>'LEIDO'", "", $conn);

//ANULADOS
$anulado=busca_filtro_tabla("f.idfuncionario,".concatenar_cadena_sql(["f.nombres","' '","f.apellidos"])." as nombre_funcionario,fecha_anulacion as fecha,'ANULACION' as accion","documento_anulacion d,funcionario f","f.funcionario_codigo=d.funcionario and d.estado='ANULADO' and d.documento_iddocumento=".$iddoc,"",$conn);


//VERSIONAMIENTO DEL DOCUMENTO
$versionamiento=busca_filtro_tabla("f.idfuncionario,".concatenar_cadena_sql(["f.nombres","' '","f.apellidos"])." as nombre_funcionario,v.fecha,'VERSIONAMIENTO' as accion","version_documento v,funcionario f","f.idfuncionario=v.funcionario_idfuncionario and v.documento_iddocumento=".$iddoc,"",$conn);

//ANEXOS
$anexos=busca_filtro_tabla("f.idfuncionario,".concatenar_cadena_sql(["f.nombres","' '","f.apellidos"])." as nombre_funcionario,a.fecha_anexo as fecha,'ANEXOS' as accion","anexos a,permiso_anexo p, funcionario f","a.idanexos=p.anexos_idanexos and p.idpropietario=f.idfuncionario and a.documento_iddocumento=".$iddoc,"",$conn);


//EXPEDIENTE
$expediente=busca_filtro_tabla("null as idfuncionario,null as nombre_funcionario,fecha,'EXPEDIENTE' as accion","expediente_doc e","e.documento_iddocumento=".$iddoc,"",$conn);

//RESPUESTA
$respuesta=busca_filtro_tabla("f.idfuncionario,".concatenar_cadena_sql(["f.nombres","' '","f.apellidos"])." as nombre_funcionario,r.fecha,'RESPUESTA' as accion","respuesta r,documento d,funcionario f","r.origen=d.iddocumento and f.funcionario_codigo=d.ejecutor and d.iddocumento=".$iddoc,"",$conn);


DISTRIBUCION
NOVEDAD

SOLICITUD APROBACION
RECHAZADO


 */


$Response = (object) array(
    'data' => [],
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $Response->success = 1;
    $Response->data = [[
            'id' => uniqid(),    
            'imgRoute' => 'temporal/temporal_amendoza/1215859079r.',
            'userName' => 'jhon valencia',
            'title' => 'titulo de prueba',
            'icon' => 'fa fa-lock',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'url' => 'views/tareas/crear.php',
            'date' => '2019-01-01 01:06:22',
        ]
    ];
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);