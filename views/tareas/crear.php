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

foreach($_REQUEST as $key => $value){
    $$key = $value;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css" media="screen">
    
</head>
<body>
    <ul class="nav nav-tabs" id="taskTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Tarea</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comentarios</a>
        </li>
    </ul>
    <div class="tab-content" id="taskTabContent">
        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
            <div class="form-group">
                <label class="my-0" for="name">Nombre de la tarea</label>
                <input type="email" class="form-control" id="name" placeholder="Qué desea que se realice?">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="my-0" for="manager">Responsable</label>
                        <select class="form-control" id="manager" multiple="multiple" placeholder="Quien desea que la realice?"></select>                                
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="send_notification">
                        <label class="form-check-label" for="send_notification">Desea notificar por email?</label>
                    </div>                            
                </div>
            </div>
            <div class="form-group">
                <label class="my-0" for="date_ranger">Fecha limite</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" id="final_date">
                    <div class="input-group-append ">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="my-0" for="priority">Prioridad de la tarea</label>
                <select id="priority" class="form-control">
                    <option value="">Ninguna</option>
                    <option value="1">Alta</option>
                    <option value="2">Media</option>
                    <option value="3">Baja</option>
                </select>
            </div>
            <div class="form-group">
                <label class="float-right toggle_advanced"><i class="fa fa-plus-circle f-12"></i>&nbsp;&nbsp;Más opciones</label>
                <label class="float-right toggle_advanced" style="display:none"><i class="fa fa-minus-circle f-12"></i>&nbsp;&nbsp;Menos opciones</label>
            </div>
            <div class="form-group advanced" style="display:none">
                <label for="description">Descripción detallada para esta tarea</label>
                <textarea class="form-control" id="description" rows="3"></textarea>
            </div>
            <div class="form-group advanced" id="followers_container">
                <label class="my-0" for="followers">Seguidores</label>
                <select class="form-control" id="followers" multiple="multiple"></select>
            </div>
            <div class="form-group advanced" style="display:none">
                <div class="dropzone no-margin" id="task_files">
                    <div class="fallback">
                    <input name="file" type="file" multiple/>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            listado de comentarios    
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/dropzone.min.js"></script>
    <script src="<?= $ruta_db_superior ?>views/tareas/js/crear.js" data-params='<?= json_encode($_REQUEST) ?>'></script>
</body>
</html>