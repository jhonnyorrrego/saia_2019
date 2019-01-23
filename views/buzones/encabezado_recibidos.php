<div class="row w-100 mx-0 my-auto" id="mail_initial_info">
    <div class="col-auto mr-auto text-left px-0 h-100">
        <span id="actual_date">.</span>
    </div>        
</div>
<div class="row w-100 mx-0 bg-info text-white my-auto" style="display:none" id="component_actions">
    <div class="col-auto mr-auto text-left pr-0 pl-2 my-auto">
        <span class="fa fa-arrow-left pr-3 cursor" style="font-size:20px" id="uncheck_list"></span>
        <span id="selected_rows" style="font-size:20px"></span>
    </div> 
    <div class="col-auto text-right px-0 my-auto">
        <span class="cursor py-0 px-2" data-toggle="tooltip" data-placement="bottom" title="Reenviar Documento" id="share_document">
            <i class="fa fa-share" style="font-size:20px"></i>
        </span>
        <span class="cursor py-0 px-2" data-toggle="tooltip" data-placement="bottom" title="Sacar de mi Buzón">
            <i class="fa fa-sign-out" style="font-size:20px"></i>
        </span>            
        <div class="dropdown d-inline">
            <span class="py-0 px-1 priority_dropdown" data-toggle="tooltip" data-placement="bottom" title="Prioridad">
                <i class="fa fa-flag" style="font-size:20px"></i>
            </span>
            <div  id="priority_menu" class="dropdown-menu priority_dropdown" role="menu" id="menu_user_info" x-placement="bottom-end" style="position: absolute; transform: translate3d(-70px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a href="#" class="dropdown-item prioritize_document" data-priority="1">
                    <i class="fa fa-flag text-danger"></i>Alta
                </a>
                <a href="#" class="dropdown-item prioritize_document" data-priority="0">
                    <i class="fa fa-flag hint-text"></i>Normal
                </a>
            </div>
        </div>
        <span class="cursor py-0 px-2" data-toggle="tooltip" data-placement="bottom" title="Etiquetar" id="mark_document">
            <i class="fa fa-tag" style="font-size:20px"></i>
        </span>
        <span class="cursor py-0 px-2" data-toggle="tooltip" data-placement="bottom" title="Mover a Expediente">
            <i class="fa fa-folder" style="font-size:20px"></i>
        </span>
    </div>
</div>