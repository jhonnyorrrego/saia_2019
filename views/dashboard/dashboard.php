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
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= breakpoint() ?>
    <?= toastr() ?>
    <?= icons() ?>
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="fixed-header ">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
        <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
        <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
        <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            <img src="<?= $ruta_db_superior ?>assets/images/logo_saia.png" alt="logo" class="brand" width="78">
            <div class="sidebar-header-controls">
                <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i
                        class="fa fa-angle-down fs-16"></i>
                </button>
                <button type="button" class="btn btn-link d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none"
                    data-toggle-pin="sidebar"><i class="fa fs-12"></i>
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
    <div class="page-container ">
        <!-- START HEADER -->
        <div class="header" id="header">
            <!-- START MOBILE SIDEBAR TOGGLE -->
            <a href="#" class="btn-link toggle-sidebar d-lg-none" data-toggle="sidebar" id="toggle_sidebar">
                <i class="fa fa-navicon" style="font-size: 1.5rem"></i>
            </a>
            <!-- END MOBILE SIDEBAR TOGGLE -->
            <div class="">
                <div class="brand inline">
                    <img alt="logo" height="47px" id="client_image">
                </div>
                <!--<ul class="d-lg-inline-block d-none notification-list no-margin d-lg-inline-block b-grey b-l b-r no-style p-l-30 p-r-20">
                    <li class="p-r-10 inline">
                        <div class="dropdown">
                            <a href="javascript:;" id="notification-center" class="header-icon fa fa-globe" data-toggle="dropdown">
                                <span class="bubble"></span>
                            </a>
                            <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
                                <div class="notification-panel">
                                    <div class="notification-body scrollable">
                                        <div class="notification-item unread clearfix">
                                            <div class="heading open">
                                                <a href="#" class="text-complete pull-left">
                                                    <i class="fa fa-map-marker fs-16 m-r-10"></i>
                                                    <span class="bold">Carrot Design</span>
                                                    <span class="fs-12 m-l-10">David Nester</span>
                                                </a>
                                                <div class="pull-right">
                                                    <div class="thumbnail-wrapper d16 circular inline m-t-15 m-r-10 toggle-more-details">
                                                        <div><i class="fa fa-angle-left"></i>
                                                        </div>
                                                    </div>
                                                    <span class=" time">few sec ago</span>
                                                </div>
                                                <div class="more-details">
                                                    <div class="more-details-inner">
                                                        <h5 class="semi-bold fs-16">“Apple’s Motivation - Innovation
                                                            <br>
                                                            distinguishes between <br>
                                                            A leader and a follower.”</h5>
                                                        <p class="small hint-text">
                                                            Commented on john Smiths wall.
                                                            <br> via pages framework.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="option" data-toggle="tooltip" data-placement="left" title="mark as read">
                                                <a href="#" class="mark"></a>
                                            </div>
                                        </div>
                                        <div class="notification-item  clearfix">
                                            <div class="heading">
                                                <a href="#" class="text-danger pull-left">
                                                    <i class="fa fa-exclamation-triangle m-r-10"></i>
                                                    <span class="bold">98% Server Load</span>
                                                    <span class="fs-12 m-l-10">Take Action</span>
                                                </a>
                                                <span class="pull-right time">2 mins ago</span>
                                            </div>
                                            <div class="option">
                                                <a href="#" class="mark"></a>
                                            </div>
                                        </div>
                                        <div class="notification-item  clearfix">
                                            <div class="heading">
                                                <a href="#" class="text-warning-dark pull-left">
                                                    <i class="fa fa-exclamation-triangle m-r-10"></i>
                                                    <span class="bold">Warning Notification</span>
                                                    <span class="fs-12 m-l-10">Buy Now</span>
                                                </a>
                                                <span class="pull-right time">yesterday</span>
                                            </div>
                                            <div class="option">
                                                <a href="#" class="mark"></a>
                                            </div>
                                        </div>
                                        <div class="notification-item unread clearfix">
                                            <div class="heading">
                                                <div class="thumbnail-wrapper d24 circular b-white m-r-5 b-a b-white m-t-10 m-r-10">
                                                    <img width="30" height="30" alt="image" >
                                                </div>
                                                <a href="#" class="text-complete pull-left">
                                                    <span class="bold">Revox Design Labs</span>
                                                    <span class="fs-12 m-l-10">Owners</span>
                                                </a>
                                                <span class="pull-right time">11:00pm</span>
                                            </div>
                                            <div class="option" data-toggle="tooltip" data-placement="left" title="mark as read">
                                                <a href="#" class="mark"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notification-footer text-center">
                                        <a href="#" class="">Read all notifications</a>
                                        <a data-toggle="refresh" class="portlet-refresh text-black pull-right" href="#">
                                            <i class="pg-refresh_new"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="p-r-10 inline">
                        <a href="#" class="header-icon pg pg-link"></a>
                    </li>
                    <li class="p-r-10 inline">
                        <a href="#" class="header-icon pg pg-thumbs"></a>
                    </li>
                </ul>-->
                <a href="#" class="search-link d-lg-inline-block d-none" data-toggle="search"><i class="pg-search"></i>Type
                    anywhere to <span class="bold">search</span></a>
            </div>
            <div class="d-flex align-items-center">
                <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
                    <span class="semi-bold" id="user_name"></span>
                </div>
                <div class="dropdown pull-right d-xs-block">
                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="thumbnail-wrapper d32 circular inline">
                            <img id="profile_image" width="32" height="32">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_profile">
                            <i class="fa fa-edit"></i>
                            Editar mi perfil</a>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_photo_modal">
                            <i class="fa fa-photo"></i> Cambiar Foto
                        </a>
                        <a href="#" class="dropdown-item"><i class="fa fa-lock"></i> Cambiar mi Contraseña</a>
                        <a href="#" class="clearfix bg-master-lighter dropdown-item" id="btn_logout">
                            <span class="pull-left">Cerrar Sesión</span>
                            <span class="pull-right"><i class="fa fa-power-off"></i></span>
                        </a>
                    </div>
                </div>
                <!-- END User Info-->
                <a href="#" class="header-icon btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview"
                    data-toggle-element="#quickview" id="close_right_navbar">
                    <i class="pg pg-alt_menu" style="font-size:1.5rem"></i>
                </a>
            </div>
        </div>
        <!-- END HEADER -->
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper mx-0 px-0">
            <!-- START PAGE CONTENT -->
            <div class="content">
               <!-- START CONTAINER FLUID -->
                <div class="container-fluid container-fixed-lg my-0 py-0 mx-0 px-0" id="workspace">
                    <iframe class="container-fluid container-fixed-lg my-0 py-0 mx-0 px-0" frameBorder="0" id="iframe_workspace" width="100%" scrolling="no"></iframe>
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
        <ul class="nav nav-tabs" role="tablist">
            <li class="">            
                <a href="#quickview-notes" data-target="#quickview-notes" data-toggle="tab" role="tab" id="note_tab">Notas</a>
            </li>
        </ul>
        <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview">
            <i class="text-white fa fa-times" id="close_quickview"></i>
        </a>
        <!-- BEGIN TAB PANES -->
        <div class="tab-content">
            <!-- BEGIN Notes !-->
            <div class="tab-pane no-padding" id="quickview-notes">
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
                                    <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views"
                                        data-view-animation="push" id="add_note"><i class="fa fa-plus"></i></a>
                                </li>
                            </ul>
                            <button class="btn-remove-notes btn btn-xs btn-block hide btn-danger" id="delete_notes">
                                <i class="fa fa-times"></i>
                                BORRAR NOTA
                            </button>
                        </div>
                        <ul id="list_note" style="overflow-y:auto;"></ul>
                    </div>
                    <!-- END Note List !-->
                    <div class="view note" id="quick-note">
                        <div>
                            <ul class="toolbar">
                                <li><a href="#" class="close-note-link"><i class="pg-arrow_left"></i></a>
                                </li>
                                <li><a href="#" data-action="Bold" class="fs-12"><i class="fa fa-bold"></i></a>
                                </li>
                                <li><a href="#" data-action="Italic" class="fs-12"><i class="fa fa-italic"></i></a>
                                </li>
                                <li><a href="#" id="save_note" class="fs-12"><i class="fa fa-save"></i></a>
                                </li>
                            </ul>
                            <div class="body">
                                <div>
                                    <div class="top" id="note_header">
                                        <span id="span_note_header"></span>
                                    </div>
                                    <div class="content">
                                        <div class="quick-note-editor full-width full-height js-input" contenteditable="true"
                                            id="note_content"></div>
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
    <!-- START OVERLAY 
    <div class="overlay hide" data-pages="search">
        <div class="overlay-content has-results m-t-20">
            <div class="container-fluid">
                <img class="overlay-brand" alt="logo" width="78" height="22">
                <a href="#" class="close-icon-light overlay-close text-black fs-16">
                    <i class="pg-close"></i>
                </a>
            </div>
            <div class="container-fluid">
                <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Search..."
                    autocomplete="off" spellcheck="false">
                <br>
                <div class="inline-block">
                    <div class="checkbox right">
                        <input id="checkboxn" type="checkbox" value="1" checked="checked">
                        <label for="checkboxn"><i class="fa fa-search"></i> Search within page</label>
                    </div>
                </div>
                <div class="inline-block m-l-10">
                    <p class="fs-13">Press enter to search</p>
                </div>
            </div>
            <div class="container-fluid">
                <span>
                    <strong>suggestions :</strong>
                </span>
                <span id="overlay-suggestions"></span>
                <br>
                <div class="search-results m-t-40">
                    <p class="bold">Pages Search Results</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                    <div>
                                        <img width="50" height="50" alt="image">
                                    </div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on pages</h5>
                                    <p class="hint-text">via john smith</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                    <div>T</div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> related
                                        topics</h5>
                                    <p class="hint-text">via pages</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                    <div><i class="fa fa-headphones large-text "></i>
                                    </div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> music</h5>
                                    <p class="hint-text">via pagesmix</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular bg-info text-white inline m-t-10">
                                    <div><i class="fa fa-facebook large-text "></i>
                                    </div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on facebook</h5>
                                    <p class="hint-text">via facebook</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular bg-complete text-white inline m-t-10">
                                    <div><i class="fa fa-twitter large-text "></i>
                                    </div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5">Tweats on<span class="semi-bold result-name"> ice cream</span></h5>
                                    <p class="hint-text">via twitter</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="thumbnail-wrapper d48 circular text-white bg-danger inline m-t-10">
                                    <div><i class="fa fa-google-plus large-text "></i>
                                    </div>
                                </div>
                                <div class="p-l-10 inline p-t-5">
                                    <h5 class="m-b-5">Circles on<span class="semi-bold result-name"> ice cream</span></h5>
                                    <p class="hint-text">via google plus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    END OVERLAY -->

    <div class="modal fade slide-up disable-scroll" id="edit_profile" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title bold">Datos Personales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" id="profile_form">
                        <div class="modal-body">
                            <div class="col-12">
                                <hr>
                                <div class="form-group-attached">
                                    <div class="row mb-1">
                                        <label for="user" class="col-md-2 control-label text-black" style="line-height: 1;">Email</label>
                                        <div class="offset-md-1 col-md-9">
                                            <input type="email" class="form-control" placeholder="prueba@ejemplo.com"
                                                name="email">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="user" class="col-md-2 control-label text-black" style="line-height: 1;">Clave
                                            de email</label>
                                        <div class="offset-md-1 col-md-9">
                                            <input type="password" class="form-control" placeholder="Clave" name="email_contrasena">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="user" class="col-md-2 control-label text-black" style="line-height: 1;">Dirección</label>
                                        <div class="offset-md-1 col-md-9">
                                            <input type="text" class="form-control" placeholder="Direccion"
                                                name="direccion">
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="user" class="col-md-2 control-label text-black" style="line-height: 1;">Teléfono</label>
                                        <div class="offset-md-1 col-md-9">
                                            <input type="text" class="form-control" placeholder="1234567890."
                                                name="telefono">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-complete">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
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
    <div class="modal" tabindex="-1" role="dialog" id="dinamic_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold" id="modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-complete" id="btn_success">Enviar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <?= jqueryUi() ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/pages/js/pages.min.js" type="text/javascript"></script>
    <!--<script src="<?= $ruta_db_superior ?>assets/theme/assets/js/scripts.js" type="text/javascript"></script>-->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/scripts/jquery.imgareaselect.js" type="text/javascript"></script>
    
    <?= moment() ?>        
    <!-- SESION LIBRARY -->
    <script data-baseurl="<?= $ruta_db_superior ?>" id="baseUrl" src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/session/session.js"></script>
    <!-- USER INTERFACE LIBRARY-->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/ui/ui.js"></script>
    <!-- MODULE LIBRARY-->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/modules/modules.js"></script>
    <!-- NOTE LIBRARY-->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notes/notes.js"></script>    
    <!-- BEGIN LIBRARIES FOR EVENTS-->
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/ui/ui_events.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/modules/module_events.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notes/note_events.js"></script>
    <!-- END LIBRARIES FOR EVENTS-->

    <script>
        $(function(){
            Ui.putColor();
        });
    </script>
</body>

</html>