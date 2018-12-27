$(function(){
    let baseUrl = Session.getBaseUrl();
    let params = $('script[data-params]').data('params');    

    (function init(){
        findPriority(params.id);
    })();        
    
    $('#btn_success').on('click', function(){
        let key = localStorage.getItem('key');

        data = {
            task: params.id || 0,
            key: key,
            priority: $('[name="priority"]:checked').val()
        }
        
        $.post(`${baseUrl}/app/tareas/guardar_prioridad.php`, data, function(response){
            if(response.success){
                top.notification({
                    type: 'success',
                    message: response.message
                });

                $('#close_modal').trigger('click');
            }
        }, 'json')
    });

    function findPriority(id){
        $.post(`${baseUrl}app/tareas/consulta_prioridad.php`, {
            key: localStorage.getItem('key'),
            task: id
        }, function(response){
            if(response.success){
                checkDefault(response.data);
                showHistory(response.data);
            }else{
                top.notification({
                    type: 'error',
                    message: response.message
                })
            }
        }, 'json');
    }

    function showHistory(data){
        if(data.length){
            data.forEach(p => {
                $('#priority_history').append(`
                <tr id="${p.id}">
                <td>${p.date}</td>
                <td>${p.user}</td>
                <td>${p.priorityLabel}</td>
                </tr>
                `);
            });
            $('#priority_history').show();
        }
    }

    function checkDefault(data){
        let active = data.find(p => p.state == 1);
        if(active){
            $(`[name='priority'][value='${active.priority}']`).attr('checked', true);
        }
    }
});