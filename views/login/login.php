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

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SAIA - SGDEA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />

    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <?= jquery() ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/session/session.js" data-baseurl="<?= $ruta_db_superior ?>" id="baseUrl"></script>
    <script>
        if (Session.check("<?= $ruta_db_superior ?>")) {
            window.location = Session.getBaseUrl() + 'views/dashboard/dashboard.php';
        }
    </script>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
    <?= breakpoint() ?>

    <script type="text/javascript">
        window.onload = function () {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/pages/css/windows.chrome.fix.css" />'
        }
    </script>
</head>

<body class="bg-white">
    <div class="container-fluid m-0 p-0">
        <div class="row bg-white m-0 p-0" id="content">
            <!-- carousel-->
            <div class="d-none d-md-block col-md-8 mx-0 px-0" id="carousel_container">
                <div id="myCarousel" class="carousel slide mx-0 px-0" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators" id="indicators"></ol>
                    <div class="carousel-inner mx-0 px-0" id="homepageItems"></div>

                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- carousel-->
            <!-- login form-->
            <div class="col-12 col-md-4 px-5 py-5" id="form-container">
                <div class="row">
                    <div class="col-12">
                        <img id="logo" width="201">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5 class="bold">INICIO DE SESIÓN</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- START Login Form -->
                        <form id="form_login" role="form">
                            <!-- START Form Control-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group form-group-default">
                                        <label><i class="fa fa-user"></i> Usuario</label>
                                        <div class="controls">
                                            <input type="text" name="username" placeholder="Nombre de Usuario" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <!-- END Form Control-->
                                    <!-- START Form Control-->
                                    <div class="form-group form-group-default">
                                        <label><i class="fa fa-lock"></i> Contraseña</label>
                                        <div class="controls">
                                            <input type="password" class="form-control" name="password" placeholder="Clave de acceso" required autocomplete>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- START Form Control-->
                            <div class="row">
                                <div class="col-12 text-right">
                                    <label>
                                        <a href="#" onclick="javascript:$('#recovery_modal').modal('show')" class="text-info small">Necesita
                                            ayuda para ingresar <i class="fa fa-question-circle"></i> </a>
                                    </label>
                                </div>
                            </div>
                            <!-- END Form Control-->
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-lg btn-complete m-t-10" type="submit">Ingresar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Login Right Container-->
        </div>
        <div class="row mx-0 px-0 bg-complete fixed-bottom" id="footer">
            <div class="col-12">
                <p class="text-left text-white my-auto"><b>© 2019 CERO K. Todos los derechos reservados.</b></p>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade slide-up disable-scroll" id="recovery_modal" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title bold">¿No puedes acceder a tu cuenta?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" id="recovery_form">
                        <div class="modal-body">
                            <div class="col-12">
                                <hr>
                                <div class="form-group-attached">
                                    <div class="row">
                                        <label for="user" class="col-md-2 control-label text-black" style="line-height: 1;">Escribe
                                            tu login</label>
                                        <div class="offset-md-1 col-md-9">
                                            <input type="text" class="form-control" id="user" placeholder="Nombre de usuario."
                                                name="username" required>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <label for="message" class="col-md-2 control-label text-black" style="line-height: 1;">Mensaje
                                            para el administrador</label>
                                        <div class="offset-md-1 col-md-9">
                                            <textarea class="form-control" id="message" placeholder="Mensaje para el adminstrador."
                                                name="message"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-complete" id="btn_recovery">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notifications/topNotification.js"></script>
    <script>
        $(function () {
            var baseUrl = Session.getBaseUrl();
            resize();

            $('#form_login').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: baseUrl + 'verificar_login.php',
                    dataType: 'json',
                    data: {
                        userid: $("[name='username']").val(),
                        passwd: $("[name='password']").val()
                    },
                    success: function (response) {
                        if (response.ingresar) {
                            window.location = baseUrl + 'views/dashboard/dashboard.php';
                        } else {
                            top.notification({
                                message: response.mensaje,
                                type: 'error',
                                title: 'Error!'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.status, 'Error!');
                    }
                });
            });

            $('#recovery_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: baseUrl + 'app/funcionario/solicitar_cambio_clave.php',
                    dataType: 'json',
                    data: $("#recovery_form").serialize(),
                    success: function (response) {
                        if (response.success) {
                            top.notification({
                                message: response.message,
                                type: 'success'
                            });
                            $('#recovery_modal').modal('toggle');
                        } else {
                            top.notification({
                                message: response.message,
                                type: 'error',
                                title: 'Error!'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.status, 'Error!');
                    }
                });
            });

            (function getImage() {
                var logo = localStorage.getItem('logo');

                if (!logo) {
                    $.get(baseUrl + 'app/configuracion/consulta_configuraciones.php',{
                        configurations : ['logo']
                    }, function (response) {
                        if (response.success) {
                            localStorage.setItem('logo', response.data[0].value);
                            $('#logo').attr('src', response.data[0].value);
                        }
                    }, 'json');
                } else {
                    $('#logo').attr('src', logo);
                }
            })();

            function loadCarousel(){
                if($("#carousel_container").is(':visible') && !$("#homepageItems").children().length){
                    $.ajax({
                        url: baseUrl + 'app/carrusel/consulta_carousel.php',
                        dataType: 'json',
                        success: function (response) {
                            if(!$("#homepageItems").children().length){
                                var data = '',
                                    indicator = '';

                                for (var i = 0; i < response.data.length; i++) {
                                    data += `
                                    <div class="carousel-item mx-0 px-0">
                                        <img src="` + baseUrl + response.data[i].image + `" alt="` + response.data[i].image + `">
                                        <div class="carousel-caption d-none d-md-block bg-info" style="opacity: 0.7">
                                            <h3 class="text-white" style="opacity: 1">`+ response.data[i].title + `</h3>
                                            <p class="text-white" style="opacity: 1">` + response.data[i].content + `<p>
                                        </div>
                                    </div>`;
                                    indicator += '<li data-target="#myCarousel" data-slide-to="' + i + '"></li>';
                                }
                                
                                $('#homepageItems').append(data);
                                $('#indicators').append(indicator);
                                $('.carousel-item > img')
                                    .attr('height', $(window).height() - $("#footer").height())
                                    .attr('width', $("#carousel_container").width());
                                $('.carousel-item').first().addClass('active');
                                $('.carousel-indicators > li').first().addClass('active');                        
                                $("#myCarousel").carousel();                        
                            }
                        }
                    });
                }
            }
            
            $(window).resize( function(){
                resize();
            });

            window.addEventListener("orientationchange", function () {
                setTimeout(() => {
                    resize();
                }, 500);
            }, false);

            function resize(){
                breakpoint = checkSize();
                $('.carousel-item > img')
                    .attr('height', $(window).height() - $("#footer").height())
                    .attr('width', $("#carousel_container").width());
                
                loadCarousel();
            }
        });
        
    </script>
</body>

</html>