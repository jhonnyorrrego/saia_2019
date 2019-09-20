<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

require_once $ruta_db_superior . "core/autoload.php";

$idexpediente = $_REQUEST['idexpediente'];
$Expediente = new Expediente($idexpediente);
if (!$idexpediente || !$Expediente->isResponsable()) {
    return;
}

$Dep=$Expediente->getRelationFk('Dependencia');
$Serie=$Expediente->getRelationFk('Serie');

$ag=[
    0=>'',
    3=>''
];
$ag[$Expediente->agrupador]='checked';

$fecExtIni='';
if($Expediente->fecha_extrema_i){
    $fecExtIni= DateController::convertDate($Expediente->fecha_extrema_i, 'Y-m-d');
}
$fecExtFin='';
if ($Expediente->fecha_extrema_f) {
    $fecExtFin = DateController::convertDate($Expediente->fecha_extrema_f, 'Y-m-d');
}
$params =[
    'agrupador'=> intval($Expediente->agrupador),
    'countDocuments'=> $Expediente->countDocuments(),
    'countTomos' =>$Expediente->countTomos(),
    'baseUrl'=>$ruta_db_superior
];
?>

<div class="card card-default">

    <div class="card-body">

        <form role="form" method="post" name="formularioExp" id="formularioExp">
            <div class="form-group">
                <label>Tipo *</label>
                <div class="radio radio-info">
                    <input type="radio" checked="checked" value="0" name="agrupador" id="AgExp" <?=$ag[0]?> >
                    <label for="AgExp">Expediente</label>
                    <input type="radio"  value="3" name="agrupador" id="AgAgr" <?=$ag[3]?>>
                    <label for="AgAgr">Separador</label>
                </div>
                <span class="help" id="notaAgr"></span>
            </div>

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?=$Expediente->nombre?>">
            </div>

            <div class="form-group ocultar">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"><?=$Expediente->descripcion?></textarea>
            </div>
            
            <div class="form-group ocultar">
                <label>Indice uno </label>
                <input type="text" class="form-control" name="indice_uno" id="indice_uno" value="<?=$Expediente->indice_uno?>">
            </div>

            <div class="form-group ocultar">
                <label>Indice dos </label>
                <input type="text" class="form-control" name="indice_dos" id="indice_dos" value="<?=$Expediente->indice_dos?>">
            </div>

            <div class="form-group ocultar">
                <label>Indice tres </label>
                <input type="text" class="form-control" name="indice_tres" id="indice_tres" value="<?=$Expediente->indice_tres?>">
            </div>

            <div class="form-group ocultar">
                <label>Caja</label>                                    
                <select class="form-control" name="fk_caja" id="fk_caja">
                    <option value="">por favor seleccione</option>
                    <?= Expediente::getHtmlCaja($Expediente) ?>
                </select>
                <input type="hidden" name="cajaAnt" id="cajaAnt" value="<?= $Expediente->getCodPadre()->fk_caja?>">
            </div>

            <div class="form-group ocultar">
                <i id="iconInfAdicional" class="fa fa-minus-square"></i> Información Adicional
            </div>

            <div id="informacionAdicional"> 
                <div class="form-group ocultar">
                    <label>Codigo numero</label>
                    <span class="help">e.j. "Código Dependencia - Código Serie - Numero"</span>
                    <input type="text" class="form-control" name="codDependencia" id="codDependencia" value="<?=$Dep->codigo; ?>" disabled="">
                    <input type="text" class="form-control" name="CodSerie" id="CodSerie" value="<?=$Serie->codigo?>" disabled="">
                    <input type="text" class="form-control" name="codigo_numero" id="codigo_numero" value="<?=$Expediente->codigo_numero?>">
                </div>

                <div class="form-group ocultar">
                    <label>Fondo</label>
                    <input type="text" class="form-control" name="fondo" id="fondo" value="<?=$Expediente->fondo?>">
                </div>

                <div class="form-group ocultar">
                    <label>Proceso</label>
                    <input type="text" class="form-control" name="proceso" id="proceso" value="<?=$Expediente->proceso?>">
                </div>

                <div class="form-group ocultar">
                    <label>Fecha extrema inicial</label>
                    <input type="date" class="form-control" id="fecha_extrema_i" name="fecha_extrema_i" value="<?= $fecExtIni ?>">
                </div>

                <div class="form-group ocultar">
                    <label>Fecha extrema final</label>
                    <input type="date" class="form-control" id="fecha_extrema_f" name="fecha_extrema_f" value="<?= $fecExtFin ?>">
                </div>

                <div class="form-group ocultar">
                    <label>Consecutivo inicial</label>
                    <input type="text" class="form-control" name="consecutivo_inicial" id="consecutivo_inicial" value="<?=$Expediente->consecutivo_inicial?>">
                </div>

                <div class="form-group ocultar">
                    <label>Consecutivo final</label>
                    <input type="text" class="form-control" name="consecutivo_final" id="consecutivo_final" value="<?=$Expediente->consecutivo_final?>">
                </div>

            <div class="form-group ocultar">
                    <label>Unidad de conservación</label>
                    <input type="text" class="form-control" name="no_unidad_conservacion" id="no_unidad_conservacion" value="<?=$Expediente->no_unidad_conservacion?>">
                </div>


            <div class="form-group ocultar">
                    <label>No de folios</label>
                    <input type="text" class="form-control" name="no_folios" id="no_folios" value="<?=$Expediente->no_folios?>">
                </div>

            <div class="form-group ocultar">
                    <label>No de carpeta</label>
                    <input type="text" class="form-control" name="no_carpeta" id="no_carpeta" value="<?=$Expediente->no_carpeta?>">
                </div>

            <div class="form-group ocultar">
                    <label>Soporte</label>
                    <select class="form-control" name="soporte" id="soporte">
                        <option value="">por favor seleccione</option>
                        <?= $Expediente->getHtmlField('soporte', 'select', $Expediente->soporte) ?>
                    </select>
                </div>

            <div class="form-group ocultar">
                    <label>Frecuencia</label>
                    <select class="form-control" name="frecuencia_consulta" id="frecuencia_consulta">
                        <option value="">por favor seleccione</option>
                        <?= $Expediente->getHtmlField('frecuencia_consulta', 'select',$Expediente->frecuencia_consulta) ?>
                    </select>
                </div>

            <div class="form-group ocultar">
                    <label>Notas de transferencia</label>
                    <textarea class="form-control" name="notas_transf" id="notas_transf"><?=$Expediente->notas_transf?></textarea>                                    
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="methodInstance" value="updateExpedienteCont">
                <input type="hidden" name="nameInstance" value="ExpedienteController">

                <input type="hidden" name="setNull" value="1">
                <input type="hidden" id="cod_padre" name="cod_padre" value="<?= $Expediente->cod_padre ?>">
                <input type="hidden" id="idexpediente" name="idexpediente" value="<?= $idexpediente ?>">
                <button id="cancelarExp" type="button" class="btn btn-danger">
                    Cancelar
                </button>
                <button id="guardarExp" type="submit" class="btn btn-complete">
                    Editar
                </button></td>
            </div>

        </form>
    </div>
</div>
<script id="scriptEditExp" src="<?= $ruta_db_superior ?>views/expediente/js/editar_expediente.js" data-params='<?=json_encode($params)?>'></script>
