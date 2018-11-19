<script>
$(function(){
    var baseUrl = $("#baseUrl").data('baseurl');
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

    $(document).on('click', '.show_document', function(){
        let url = $(this).data('url');
        let breakpoint = localStorage.getItem('breakpoint');
        let actualUrl = $("#iframe_right_workspace").attr('src');
        
        if(actualUrl != baseUrl + url){
            $("#iframe_right_workspace").attr('src', baseUrl + url);
        }

        if($.inArray(breakpoint, ['xs', 'sm', 'md']) != -1){
            let width = $('#mailbox').width();

            $("#right_workspace").show().css('left', 0);
            $('#mailbox').animate({
                left: -width
            },300,function(){
                $('#mailbox').hide();
            });
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