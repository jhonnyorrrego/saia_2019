$(function(){
    let baseUrl = Session.getBaseUrl();
    let userId = localStorage.getItem('key');
    let params = JSON.parse($('script[data-params]').attr('data-params'));

    if(typeof Tags == 'undefined'){
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tags.js`, r => {
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tag_events.js`, r => {
                showTags(userId, params.id);
            }); 
        });
    }else{
        showTags(userId, params.id);
    }

    $('#save_tags').on('click', e => {
        let tags = {};

        $('.checkbox_tag').each(function(i, c){
            let tagId = $(c).parents('li.tag_item').data('tagid');

            if($(c).is(':checked')){
                tags[tagId] = 1;
            }else{
                tags[tagId] = 0;
            }
        });

        $.post(`${baseUrl}app/tareas/guardar_etiquetas.php`, {
            key: userId,
            task: params.id,
            tags: tags
        }, function(response){
            if(response.success){
                top.notification({
                    message: response.message,
                    type: 'success'
                })
            }else{
                top.notification({
                    message: response.message,
                    type: 'error',
                    title: 'Error!'
                });
            }
        }, 'json')
    });

    function showTags(userId, selections){
        var tags = new Tags(userId);
        tags.selections = selections;
        tags.dataBind = 'task';
        $('#tag_list').html(tags.createList());
        tags.check();
    }
});