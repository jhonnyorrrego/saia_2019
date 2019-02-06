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

include_once $ruta_db_superior . "controllers/autoload.php";

$iddocumento = $_REQUEST["documentId"];
$paginas = Pagina::findAllByAttributes(['id_documento' => $iddocumento]);
?>
<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <link href="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/assets/owl.carousel.css"
        rel="stylesheet" type="text/css" media="screen" />
    <link href="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/assets/owl.theme.default.min.css"
        rel="stylesheet" type="text/css" media="screen" />
    <style>
    .draggable {
        position: absolute;
        width: 30%;
        background: yellow;
    }
    </style>
</head>

<body>
    <div class="container-fluid bg-master-lightest px-4">
        <?php if ($paginas) : ?>
            <div class="row">
                <div class="col-12">
                    <a href="#" id="addNoty" class="btn btn-mini float-right"><i class="fa fa-comment-o"></i></a>
                    <?php if (UtilitiesController::permisoModulo("editar_paginas")) : ?>
                    <a href="listar_pagina.php?iddoc=<?= $iddocumento; ?>" class="btn btn-mini float-right"><i
                            class="fa fa-edit"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 owl-carousel text-center">
                    <?php
                    foreach ($paginas as $key => $Pagina) :
                        $fileMin = $Pagina->getUrlImagenTemp();
                        $fileMax = $Pagina->getUrlRutaTemp();

                        if ($fileMin !== false && $fileMax !== false) : ?>
                        <div data-image="<?= $fileMin; ?>" data-src="<?= $fileMax; ?>" data-toggle="tooltip"
                            data-placement="bottom" title="P&aacute;gina No <?= $Pagina->getPagina(); ?>"
                            data-id="<?= $Pagina->getPK() ?>"></div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12" id="divPagina">
                    <span id="num_pagina" data-id="" class="float-right"></span>
                    <img id="img-pagina" class="w-100" src="" />
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">El documento no tiene páginas digitalizadas</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/owl.carousel.min.js"
        type="text/javascript"></script>
    <script src="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/jquery-ui/jquery-ui.min.js"
        type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        var iddoc = parseInt(<?= $iddocumento; ?>);
        var baseUrl = $("#baseUrl", window.top.document).data('baseurl');
        var nameActual = JSON.parse(window.localStorage.getItem('user')).name;
        var key = window.localStorage.getItem('key');

        var template = function(data) {
            let html =
                `<div class="row draggable" id="${data.id}" style="${data.style}">
                        <div class="col-12">
                            <h3>${data.name}</h3>
                        </div>
                        <div class="col-12">
                            <textarea class="w-100" id="text-${data.id}">${data.text}</textarea>
                        </div>
                        <div class="col-12">
                          <input type="hidden" id="json-${data.id}" value='${data.json}'>
                          <span class="btn btn-complete float-right save" data-id="${data.id}">Guardar</span>
                          <span class="btn btn-danger float-right delete" data-id="${data.id}">Eliminar</span>
                        </div>
                    </div>`;
            return html;
        }

        var initdrag = function() {
            $(".draggable").draggable({
                containment: "parent",
                opacity: 0.35,
                handle: "h3",
                //disabled: true,
                stop: function(event, ui) {
                    let id = ui.helper[0].id;
                    let data = document.getElementById("json-" + id);
                    let infoData = {
                        positionNota: ui.position,
                        tamanioDiv: {
                            width: $("#divPagina").width(),
                            height: $("#divPagina").height()
                        }
                    }
                    data.value = JSON.stringify(infoData);
                }
            });
        }

        var appendNota = function(data = null, ini = 0) {
            let info;
            if (data) {
                info = data;
            } else {
                let infoData = {
                    positionNota: {
                        top: 0,
                        left: 15
                    },
                    tamanioDiv: {
                        width: $("#divPagina").width(),
                        height: $("#divPagina").height()
                    }
                }
                let json = JSON.stringify(infoData);
                info = {
                    id: "d" + $(".draggable").length,
                    name: nameActual,
                    text: "",
                    json: json,
                    style: "left: 15px; top: 0px;"
                }
            }
            $("#divPagina").append(template(info));
            if (ini) {
                initdrag();
            }
        }

        $(document).off("click", "#addNoty");
        $(document).on("click", "#addNoty", function() {
            appendNota(null, 1);
        });

        $(document).off("click", ".delete");
        $(document).on("click", ".delete", function() {
            let id = $(this).data("id");
            $("#" + id).remove();

            $.post(`${baseUrl}app/nota_pagina/eliminar.php`, {
                key: key,
                id: id
            }, function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            }, 'json');
        });

        $(document).off("click", ".save");
        $(document).on("click", ".save", function() {
            let id = $(this).data("id");
            let dataInfo = {
                idnota_pagina: id,
                key: key,
                fk_pagina: $("#num_pagina").data("id"),
                json: $("#json-" + id).val(),
                observacion: $("#text-" + id).val()
            }

            $.ajax({
                url: baseUrl + 'app/nota_pagina/guardarnota_pagina.php',
                data: dataInfo,
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        top.notification({
                            type: 'success',
                            message: data.message
                        });
                    } else {
                        top.notification({
                            type: 'error',
                            message: data.message
                        });
                    }
                },
                error: function() {
                    top.notification({
                        type: 'error',
                        message: 'Error! No es posible actualizar la informaci&oacute;n de la nota'
                    });
                }
            });

        });

        var listarNotas = function() {
            $.ajax({
                url: baseUrl + 'app/nota_pagina/obtenernota_pagina.php',
                data: {
                    fk_pagina: $("#num_pagina").data("id"),
                    key: key,
                    width: $("#divPagina").width(),
                    height: $("#divPagina").height()
                },
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    if (response.success == 1) {
                        for (i = 0; i < response.data.length; i++) {
                            $("#divPagina").append(appendNota(response.data[i], 0));
                        }
                        initdrag();
                    } else {
                        top.notification({
                            type: 'error',
                            message: data.message
                        });
                    }
                },
                error: function() {
                    top.notification({
                        type: 'error',
                        message: 'Error! No es posible cargar la informaci&oacute;n'
                    });
                }
            });
        }
        //---------------------------//

        $('.owl-carousel > div').each(function() {
            var img = $(this).data('image');
            $(this).css({
                'background-image': 'url(' + img + ')',
                'width': '90px',
                'height': '116px'
            });

            $(this).on('click', function(event) {
                var img2 = $(this).data('src');
                $("#img-pagina").attr("src", img2);

                var title = $(this).attr('title');
                $("#num_pagina").empty().text(title);
                $("#num_pagina").data('id', $(this).data('id'));
                $(".draggable").remove();
                listarNotas();
            });
        });
        $('.owl-carousel > div:first').trigger('click');

        var owl = $('.owl-carousel');
        owl.owlCarousel({
            nav: true,
            smartSpeed: 100,
            responsive: {
                0: {
                    items: 3
                },
                480: {
                    items: 6
                }
            },
            navText: ['<span class="btn"><i class="fa fa-chevron-left"></i></span>',
                '<span class="btn"><i class="fa fa-chevron-right"></i></span>'
            ],
        });

    });
    </script>
</body>

</html>