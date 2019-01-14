$(function(){
    if(typeof Comments == 'undefined'){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/comments/comments.js`, function(){
            start();
        });
    }else{
        start();
    }

    function start(){
        let params = JSON.parse($('script[data-params]').attr('data-params'));
        let user = JSON.parse(localStorage.getItem('user'));
        let options = {
            selector: '#task_comments',
            baseUrl: Session.getBaseUrl(),
            placeholder: 'Escriba su mensaje',
            order: 'desc',
            userData: {
                id: user.iduser,
                name: user.name,
                image: user.cutedPhoto
            },
            source: function (){
                let data = new Object();
                $.ajax({
                    url: `${this.baseUrl}app/tareas/consulta_comentarios.php`,
                    dataType: 'json',
                    type: 'POST',
                    async: false,
                    data: {
                        key: this.userData.id,
                        relation: params.id
                    },
                    success: function(response){
                        if(response.success){
                            data = response.data;
                        }else{
                            top.notification({
                                message: response.message,
                                type: 'error',
                                title: 'Error!'
                            });
                        }
                    }
                });

                return data;
            },
            save: function(comment){
                let data = false;
                $.ajax({
                    url: `${this.baseUrl}app/tareas/guardar_comentarios.php`,
                    dataType: 'json',
                    type: 'POST',
                    async: false,
                    data: {
                        key: this.userData.id,
                        relation: params.id,
                        comment: comment
                    },
                    success: function(response){
                        if(response.success){
                            data = true;
                        }else{
                            top.notification({
                                message: response.message,
                                type: 'error',
                                title: 'Error!'
                            });
                        }
                    }
                });

                return data;
            }
        }
        var comments = new Comments(options);
    }
});