<script>
$(function(){
    var baseUrl = $("#baseUrl").data('baseurl');
    var documentSelected = 0;

    $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/topModal/topModal.js`);

    $('#table').on('check.bs.table uncheck.bs.table', function () {
        if ($(this).data('selections').length){
            if ($('#component_actions').is(':hidden')){
                $('#component_actions').show('slide');
            }
        }else{
            $('#component_actions').hide('slide');
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
                        element.removeClass('text-dark text-danger');

                        if(priority){
                            element.addClass('text-danger');
                        }else{
                            element.addClass('text-dark');
                        }
                    }
                });
                
                if($.inArray(documentSelected, selections) != -1){
                    let selected = $("#iframe_right_workspace").contents().find(`.priority[data-key='${documentSelected}']`);
                    if(selected.length){
                        selected.removeClass('text-dark text-danger');

                        if(priority){
                            selected.addClass('text-danger');
                        }else{
                            selected.addClass('text-dark');
                        }
                    }
                };
            }else{
                toastr.error(response.message);
            }
        }, 'json')
    })
    
    $(document).on('click', '.show_document', function(){
        let iframe = $("#iframe_right_workspace"),
            url = $(this).data('url'),
            actualUrl = iframe.attr('src');

        documentSelected = +$(this).parent().find('.identificador').val();
        
        if(actualUrl != baseUrl + url){
            iframe.attr('src', baseUrl + url);
        }

        if($("#right_workspace").is(':hidden')){
            $("#mailbox,#right_workspace").toggleClass('d-none');
        }
    });

    $(document).on('click', '.btn_expiration', function(){
        topModal({
            url: `${baseUrl}views/documento/asignar_vencimiento.php`
        })
    });

    $(document).on('click', '#share_document', function(){
        topModal({
            url: `${baseUrl}views/documento/transferir.php`,
            title: 'Reenviar'
        })
    });

    $(document).on('click', '#mark_document', function(){
        topModal({
            url: `${baseUrl}views/documento/etiquetar.php`
        })
    });
    
});
</script>