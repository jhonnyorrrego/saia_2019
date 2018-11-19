<div class="row pb-2 mx-0">
    <div class="col text-center" id="container_go_back">
        <span class="h6">
            <i style="font-size:1.5rem" class="fa fa-chevron-left" id="go_back" style="cursor:pointer;"></i>
        </span>
    </div>
    <div class="col px-0 mx-0">
        <span class="h6">
            <i style="font-size:1.5rem" class="fa fa-sitemap"></i>
            <i style="font-size:1.5rem" class="fa fa-angle-double-down" style="cursor:pointer;"></i>
        </span>
    </div>
    <div class="col text-center pr-0">
        <span style="cursor:pointer;" class="h6">
            <i style="font-size:1.5rem" class="fa fa-mail-reply"></i><label class="d-none d-sm-inline">&nbsp;Responder</label>
        </span>
    </div>
    <div class="col-auto text-center px-0">
        <span style="cursor:pointer;" class="h6">
            <i style="font-size:1.5rem" class="fa fa-mail-reply-all"></i><label class="d-none d-sm-inline">&nbsp;Responder a todos</label>
        </span>
    </div>
    <div class="col text-center pl-0">
        <span style="cursor:pointer;" class="h6">
            <i style="font-size:1.5rem" class="fa fa-share"></i><label class="d-none d-sm-inline">&nbsp;Reenviar</label>
        </span>
    </div>
    <div class="col-auto">
        <span style="cursor:pointer;" class="h6">
            <i style="font-size:1.5rem" class="fa fa-angle-double-left"></i><label>&nbsp;Opciones</label>
        </span>
    </div>
</div>
<div class="row px-0 mx-0">
    <div class="col-1 px-0 mx-0">
        <span class="thumbnail-wrapper circular inline">
            <img id="profile_image" src="../../temporal/temporal_andres.mendoza/465379127r.jpg" style="width:3rem;height:3rem;">
        </span>
    </div>
    <div class="col-2">
        <div class="row">
            <div class="col-12">
                <span style="font-size:10px;" class="bold">Angélica Gómez</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span style="font-size:10px;">Hace 5 minutos</span>
            </div>
        </div>
    </div>
    <div class="col">
        <span class="h6 px-1" style="cursor:pointer;"><i style="font-size:1.5rem" class="fa fa-flag"></i></span>
        <span class="h6 px-1" style="cursor:pointer;"><i style="font-size:1.5rem" class="fa fa-paperclip"></i></span>
        <span class="h6 px-1" style="cursor:pointer;"><i style="font-size:1.5rem" class="fa fa-comments"></i></span>
        <span class="h6 px-1" style="cursor:pointer;"><i style="font-size:1.5rem" class="fa fa-calendar"></i></span>
        <span class="h6 px-1" style="cursor:pointer;"><i style="font-size:1.5rem" class="fa fa-road"></i></span>
    </div>
    <div class="col-auto">
        vence: <label class="label label-danger" style="cursor:pointer;">Hoy</label>
    </div>
</div>
<div class="row mx-0 px-1">
    <div class="col-1 px-0 mx-0 text-center">
        <span class="bold">PQRS</span>
    </div>
    <div class="col">
        <p style="line-height:1;" class="bold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, iusto fuga. Ea eaque quasi voluptates voluptate eligendi aperiam quidem ab facere nobis, incidunt fugit delectus. Eius odio non modi at.</p>
    </div>
</div>
<div class="row mx-0 px-1">
    <div class="col-12 px-0 mx-0">
        <p style="line-height:1;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum nemo culpa, laborum optio animi fugiat qui, consequuntur rem quia consectetur exercitationem vel iste similique eum quas incidunt eveniet fuga in.</p>
    </div>
</div>
<script>
    $(function(){
        var breakpoint = localStorage.getItem('breakpoint');

        if($.inArray(breakpoint, ['xs', 'sm', 'md']) != -1){
            $('#container_go_back').show();
            $("#go_back").on('click', function(){
                var leftPanel = $("#mailbox", parent.document);
                var rightPanel = $("#right_workspace", parent.document);
                let width = rightPanel.width();
    
                rightPanel.animate({
                    left: width
                },200,function(){
                    leftPanel.show().css('left', 0);
                    rightPanel.hide();
                    window.parent.window.resizeIframe();
                });
            });
        }else{
            $('#container_go_back').hide();
        }
    });
</script>