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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?= cssBootstrap() ?>
    <?= cssTheme() ?>
    <?= icons() ?>
    <link rel="manifest" href="<?= $ruta_db_superior ?>manifest.json">
    <link rel="icon" type="image/png" href="<?= $ruta_db_superior ?>assets/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= $ruta_db_superior ?>assets/images/favicon-16x16.png" sizes="16x16" />
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body class="fixed-header">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
        <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
        <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
        <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            <img src="<?= $ruta_db_superior ?>assets/images/logo_saia.png" alt="logo" class="brand" width="78">
            <div class="sidebar-header-controls">
                <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
                </button>
                <button type="button" class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
                </button>
            </div>
        </div>
        <!-- END SIDEBAR MENU HEADER-->
        <!-- START SIDEBAR MENU -->
        <div class="sidebar-menu">
            <ul class="menu-items mt-2" id="module_list"></ul>
            <div class="clearfix"></div>
        </div>
        <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
        <!-- START HEADER -->
        <div class="header" id="header">
            <!-- START MOBILE SIDEBAR TOGGLE -->
            <a href="#" class="btn-link toggle-sidebar d-lg-none" data-toggle="sidebar" id="toggle_sidebar">
                <i class="fa fa-navicon" style="font-size: 1.5rem"></i>
            </a>
            <!-- END MOBILE SIDEBAR TOGGLE -->
            <div class="">
                <div class="brand inline">
                    <img alt="logo" id="client_image" style="max-height:40px" class="d-none">
                </div>
                <div class="dropdown d-lg-inline-block d-none">
                    <button class="btn bg-institutional mx-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="new_action">
                        <i class="fa fa-plus"></i> Nuevo
                    </button>
                    <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                        <a href="#" class="dropdown-item new_add" data-type="folder">
                            <i class="fa fa-folder-open"></i> Expediente
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="task">
                            <i class="fa fa-calendar-o"></i> Tarea o Recordatorio
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="comunication">
                            <i class="fa fa-file-text-o"></i> Comunicaciones Oficiales
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="process">
                            <i class="fa fa-share-alt"></i> Procesos Generales
                        </a>
                    </div>
                </div>
                <div class="d-lg-inline-block align-middle d-none">
                    <div class="input-group transparent">
                        <div class="input-group-prepend">
                            <span class="input-group-text transparent">
                                <div class="dropdown">
                                    <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-chevron-down"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                                        <a href="#" class="dropdown-item finder_option" data-type="document">
                                            <i class="fa fa-file"></i> Documento
                                        </a>
                                        <a href="#" class="dropdown-item finder_option" data-type="task">
                                            <i class="fa fa-calendar-o"></i> Tarea
                                        </a>
                                        <a href="#" class="dropdown-item finder_option" data-type="folder">
                                            <i class="fa fa-folder-open"></i> Expediente
                                        </a>
                                        <a href="#" class="dropdown-item finder_option" data-type="file">
                                            <i class="fa fa-paperclip"></i> Anexos
                                        </a>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <input id="document_finder" type="text" class="form-control" placeholder="Buscar..." style="width:250px">
                        <div class="input-group-append ">
                            <span class="input-group-text transparent">
                                <i class="fa fa-times pr-3" id="clean_finder"></i>
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
                    <span class="semi-bold" id="user_name"></span>
                </div>
                <div class="dropdown pull-right d-xs-block">
                    <button class="profile-dropdown-toggle cursor" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user_info">
                        <span class="thumbnail-wrapper d32 circular inline">
                            <img id="profile_image" class="cuted_photo" width="32" height="32">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu" id="menu_user_info">
                        <a href="#" class="dropdown-item" id="config_profile">
                            <i class="fa fa-user"></i>Configurar perfil
                        </a>
                        <a href="#" class="dropdown-item" id="change_password">
                            <i class="fa fa-lock"></i>Cambiar mi contraseña
                        </a>
                        <a href="#" class="clearfix bg-master-lighter dropdown-item" id="btn_logout">
                            <span class="pull-left">Cerrar Sesión</span>
                            <span class="pull-right"><i class="fa fa-power-off"></i></span>
                        </a>
                    </div>
                </div>
                <!-- END User Info-->
                <a href="#" class="header-icon btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview" id="toggle_right_navbar">
                    <i class="fa fa-th-list" style="font-size:1.5rem"></i>
                </a>
            </div>
        </div>
        <!-- END HEADER -->
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper mx-0 px-0">
            <!-- START PAGE CONTENT -->
            <div class="content">
                <!-- START CONTAINER FLUID -->
                <div class="container mw-100 m-0 p-0" id="workspace" style="position:absolute;">
                    <iframe class="m-0 p-0" frameBorder="0" id="iframe_workspace" width="100%" scrolling="no" style="position:absolute;z-index:0;"></iframe>
                    <div class="d-inline d-block d-lg-none rounded-circle bg-white text-center" style="z-index:1;position:absolute;width:60px;height:60px;" id="new_action_mobile_container">
                        <span class="p-0 m-0 rounded-circle w-100 h-100" id="new_action_mobile" style="cursor:pointer;">
                            <i class="fa fa-plus-circle text-institutional" style="font-size:60px"></i>
                        </span>
                    </div>
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!--START QUICKVIEW -->
    <div id="quickview" class="quickview-wrapper" data-pages="quickview">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs text-white pl-1" role="tablist">
            <li class="">
                <a class="active show text-white" href="#quickview-notes" data-target="#quickview-notes" data-toggle="tab" role="tab" id="note_tab">Notas</a>
            </li>
        </ul>
        <a class="btn-link quickview-toggle cursor" data-toggle-element="#quickview" data-toggle="quickview">
            <i class="text-white fa fa-times" id="close_quickview" data-toggle="tooltip" data-placement="bottom" title="Ocultar ventana"></i>
        </a>
        <!-- BEGIN TAB PANES -->
        <div class="tab-content">
            <!-- BEGIN Notes !-->
            <div class="tab-pane no-padding active show" id="quickview-notes">
                <div class="view-port clearfix quickview-notes" id="note-views">
                    <!-- BEGIN Note List !-->
                    <div class="view list" id="quick-note-list">
                        <div class="toolbar clearfix">
                            <ul class="pull-right ">
                                <li id="empty_notes"><small><i>No existen notas creadas.</i></small></li>
                                <li>
                                    <a href="#" class="delete-note-link"><i class="fa fa-trash-o"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views" data-view-animation="push" id="add_note"><i class="fa fa-plus"></i></a>
                                </li>
                            </ul>
                            <button class="btn-remove-notes btn btn-xs btn-block hide btn-danger" id="delete_notes">
                                Borrar Nota
                            </button>
                        </div>
                        <ul id="list_note" style="overflow-y:auto;"></ul>
                    </div>
                    <!-- END Note List !-->
                    <div class="view note" id="quick-note">
                        <div>
                            <ul class="toolbar">
                                <li>
                                    <a href="#" class="close-note-link" data-toggle="tooltip" data-placement="bottom" title="Regresar">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-action="Bold" class="fs-12">
                                        <i class="fa fa-bold"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-action="Italic" class="fs-12">
                                        <i class="fa fa-italic"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="save_note" class="fs-12">
                                        <i class="fa fa-save"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="body">
                                <div>
                                    <div class="top" id="note_header">
                                        <span id="span_note_header"></span>
                                    </div>
                                    <div class="content">
                                        <div class="quick-note-editor full-width full-height js-input" contenteditable="true" id="note_content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Notes !-->
        </div>
        <!--END TAB PANES -->
    </div>
    <!-- END QUICKVIEW-->
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="edit_photo_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center mt-2">
                    <img id="img_edit_photo" width="100%">
                </div>
                <div class="modal-footer">
                    <label class="btn btn-danger">Cargar imagen
                        <input type="file" style="display:none" id="file_photo">
                    </label>
                    <div class="btn btn-complete" id="btn_save_photo">Guardar</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <button data-toggle="modal" data-target="#dinamic_modal" style="display:none"></button>
    <div class="modal" tabindex="-1" role="dialog" id="dinamic_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title bold" id="modal_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body"></div>
                <div class="modal-footer">
                    <button type="button" id="close_modal"></button>
                    <button type="submit" id="btn_success"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
    <?= jquery() ?>
    <?= jsBootstrap() ?>
    <?= jqueryUi() ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <?= jsTheme() ?>

    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/scripts/jquery.imgareaselect.js" type="text/javascript"></script>

    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notifications/topNotification.js" type="text/javascript"></script>

    <?= breakpoint() ?>
    <script data-baseurl="<?= $ruta_db_superior ?>" id="baseUrl" src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/session/session.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/ui/ui.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/ui/ui_events.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/modules/modules.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notes/notes.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/modules/module_events.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/autocomplete/autocomplete_events.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notes/note_events.js"></script>
    <?= topModal() ?>
    <?= moment() ?>
    <script>
        $(function() {
            if (localStorage.getItem('key') > 0) {
                $('[data-toggle="tooltip"]').tooltip();

                Ui.putColor();
                Ui.inactiveTime();
                Ui.bindServiceWorker();
                Ui.bindNotifications();
            }
        });
    </script>
</body>

</html>