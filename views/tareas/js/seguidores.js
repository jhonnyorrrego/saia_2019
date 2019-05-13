$(function(){
    let baseUrl = Session.getBaseUrl();
    let params = JSON.parse($('script[data-params]').attr('data-params'));

    (function init(){
        findFollowers(params.id);
    })();
    
    $("#follower").select2({
        minimumInputLength: 3,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem("token")
                }
            },
            processResults: function (response) {                                
                return response.success ? {results: response.data} : {};
            }
        }
    });
    
    $('#follower').on('select2:select', function (e) {
        var data = e.params.data;
        modifyFollower(data.id);
        $('#follower').val(null).trigger('change');
    });

    $(document).off('click', '.delete_follower');
    $(document).on('click','.delete_follower', function () {
        let user = $(this).data('user');
        modifyFollower(user, 1);
    });

    function getOptions(selector){
        let data = [];

        if($(selector).children().length){
            $.each($(selector).children(), function(i, e){
                data.push($(e).val());
            });
        }

        return data;
    }

    function findFollowers(id){
        $.post(`${baseUrl}app/tareas/seguidores.php`, {
            key: localStorage.getItem('key'),
            task: id
        }, function(response){
            if(response.success){
                showFollowers(response.data);
            }else{
                top.notification({
                    type: 'error',
                    message: response.message
                })
            }
        }, 'json');
    }

    function showFollowers(data) {
        $('#follower_list').empty();
        data.forEach(i => {
            var template = `<div class="row mx-0 py-1">
                <div class="col-12 px-0 bg-master-lighter" style="border-radius:5px">
                    <div class="media">
                        <img class="align-self-center ml-1 mr-2 my-2 rounded-circle" src="${baseUrl + i.image}" style="width:32px;height:32px;">
                        <div class="media-body my-2">
                            <p class="my-2" style="line-height:1">
                                ${i.label}
                                <span class="float-right pr-3 delete_follower" data-user="${i.user}">
                                    <i class="fa fa-trash cursor f-20"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>`;
            $('#follower_list').prepend(template)
        })
    }

    function modifyFollower(user, remove = 0) {
        $.post(`${baseUrl}app/tareas/guardar_seguidor.php`, {
            key: localStorage.getItem('key'),
            user: user,
            remove: remove,
            taskId: params.id
        }, function (response) {
            if(response.success){
                findFollowers(params.id)
            }
        }, 'json');
    }   
});