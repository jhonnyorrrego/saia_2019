<div class="container-fluid px-1">
    <div class="row w-100 mx-0">
        <div class="col-auto mr-auto text-left px-0">
            <span><small>HOY Septiembre 20 de 2018</small></span>
        </div>
        <div class="col-auto text-right px-0" style="display:none" id="component_actions">
            <span class="btn btn-link py-0 px-1" data-toggle="tooltip" data-placement="bottom" title="Reenviar Documento" id="share_document">
                <i class="fa fa-share"></i>
            </span>
            <span class="btn btn-link py-0 px-1" data-toggle="tooltip" data-placement="bottom" title="Sacar de mi Buzón">
                <i class="fa fa-sign-out"></i>
            </span>            
            <div class="dropdown d-inline">
                <span class="py-0 px-1 priority_dropdown" data-toggle="tooltip" data-placement="bottom" title="Prioridad">
                    <i class="fa fa-flag"></i>
                </span>
                <div  id="priority_menu" class="dropdown-menu priority_dropdown" role="menu" id="menu_user_info" x-placement="bottom-end" style="position: absolute; transform: translate3d(-105px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a href="#" class="dropdown-item prioritize_document" data-priority="1">
                        <i class="fa fa-flag text-danger"></i>Alta
                    </a>
                    <a href="#" class="dropdown-item prioritize_document" data-priority="0">
                        <i class="fa fa-flag hint-text"></i>Normal
                    </a>
                </div>
            </div>
            <span class="btn btn-link py-0 px-1" data-toggle="tooltip" data-placement="bottom" title="Etiquetar" id="mark_document">
                <i class="fa fa-tag"></i>
            </span>
            <span class="btn btn-link py-0 px-1" data-toggle="tooltip" data-placement="bottom" title="Mover a Expediente">
                <i class="fa fa-folder"></i>
            </span>
            <span class="btn btn-link py-0 px-1">
                <i class="fa fa-ellipsis-v"></i>
            </span>
        </div>
    </div>
</div>