<script>
$(function(){
    var baseUrl = $("#baseUrl").data('baseurl');
    sessionStorage.setItem('documentSelected', 0);

    $('#table').on('check.bs.table uncheck.bs.table', function () {
        if ($(this).data('selections').length){
            if ($('#component_actions').is(':hidden')){
                $('#mail_initial_info').slideUp(100, function(){
                    $('#component_actions').slideDown(100,function(){
                        $(this).parent().toggleClass('bg-master-lightest bg-info');
                    });
                });
            }
        }else{
            $('#component_actions').slideUp(100,function(){
                $(this).parent().toggleClass('bg-master-lightest bg-info');
                $('#mail_initial_info').slideDown(100);
            });
        }
    });

    $(document).on('click', '.priority_dropdown', function(){
        $("#priority_menu").toggleClass('show');
    });

    $(document).on('click', '.prioritize_document', function(){
        var priority = $(this).data('priority');
        var selections = $('#table').data('selections');
        var key = localStorage.getItem('key');

        $.post(`${baseUrl}app/documento/asignar_prioridad.php`,{
            priority: priority,
            selections: selections,
            key: key
        }, function(response){
            if(response.success){
                toastr.success(response.message);
                
                selections = selections.split(',').map(Number);
                $("i.priority").each(function(i, e){
                    let element = $(e);
                    let key = element.data('key');
                    
                    if($.inArray(key, selections) != -1){
                        if(priority){
                            element.show();
                        }else{
                            element.hide();
                        }
                    }
                });
                
                let documentSelected = sessionStorage.getItem('documentSelected') || 0;
                if($.inArray(+documentSelected, selections) != -1){
                    let selected = $("#iframe_right_workspace").contents().find(`.priority[data-key='${documentSelected}']`);
                    if(selected.length){
                        if(priority){
                            selected.addClass('text-danger');
                        }else{
                            selected.removeClass('text-danger');
                        }
                    }
                };
            }else{
                toastr.error(response.message);
            }
        }, 'json')
    })
    
    $(document).on('click', '.show_document', function(){
        executeAction($(this));
    });

    $(document).on('click', '.btn_expiration', function(){
        top.topModal({
            url: `${baseUrl}views/documento/asignar_vencimiento.php`
        })
    });

    $(document).on('click', '#share_document', function(){
        top.topModal({
            url: `${baseUrl}views/documento/transferir.php`,
            title: 'Reenviar'
        })
    });

    $(document).on('click', '#mark_document', function(){
        let selections = $('#table').data('selections');
        top.topModal({
            url: `${baseUrl}views/documento/etiquetar.php`,
            title: 'Etiquetas',
            size: 'modal-sm',
            params: {
                selections: selections
            },
            buttons: {
                success: {
                    label: 'Guardar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            },
        })
    });

    $(document).on('click', 'tr[data-index]', function(e){
        if(!$(e.target).hasClass('action')){
            let node = $(this).find('.principal_action');
            executeAction(node);
        }            
    });

    $(document).on('click', '#uncheck_list', function(){
        $('#table').data('selections', '');
        $(':checkbox[data-index]:checked').trigger('click');
    });

    function executeAction(node){
        let iframe = $("#iframe_right_workspace"),
            url = node.data('url'),
            actualUrl = iframe.attr('src');

        let documentSelected = node.parent().find('.identificador').val();
        sessionStorage.setItem('documentSelected', documentSelected);

        if(actualUrl != baseUrl + url){
            iframe.attr('src', baseUrl + url);
        }

        if($("#right_workspace").is(':hidden')){
            $("#mailbox,#right_workspace").toggleClass('d-none');
        }

        node.parents('tr[data-index]').addClass('selected');
    }

    (function setDate(){
        let interval = setInterval(() => {
            if($("#actual_date").length){
                var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        
                let date = new Date();
                let text = `Hoy ${date.getDate()} de ${months[date.getMonth()]} del ${date.getFullYear()} `
                $("#actual_date").text(text);
                clearInterval(interval);
            }
        }, 50);        
    })();
    
});
</script>