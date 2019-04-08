$(function(){
    var baseUrl = Session.getBaseUrl();
    var params = JSON.parse($('script[data-params]').attr('data-params'));

    (function init(){
        findState(params.id);
    })();        
    
    $('#save_state').on('click', function(){
        $.post(`${baseUrl}/app/tareas/guardar_estado.php`, {
            task: params.id,
            key: localStorage.getItem('key'),
            state: $('[name="state"]:checked').val(),
            description: $('#state_description').val()
        }, function(response){
            if(response.success){
                top.notification({
                    type: 'success',
                    message: response.message
                });
                
                findState(params.id);
                $('#state_description').val('');
                top.successModalEvent();
            }
        }, 'json')
    });

    function findState(id){
        $.post(`${baseUrl}app/tareas/consulta_estado.php`, {
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
            $('#state_history > tbody').find('tr:not(:first)').remove();
            data.forEach(s => {
                $('#state_history > tbody').append(`
                    <tr id="${s.id}">
                        <td>${s.date}</td>
                        <td>${s.user}</td>
                        <td>${s.description || ''}</td>
                        <td>${s.stateLabel}</td>
                    </tr>
                `);
                
            });
            $('#state_history').show();
        }
    }

    function checkDefault(data){
        let active = data.find(p => p.state == 1);
        if(active){
            $(`[name='state'][value='${active.value}']`).attr('checked', true);
        }
    }
});