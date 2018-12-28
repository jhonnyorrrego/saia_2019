$(function () {    
    let baseUrl = Session.getBaseUrl();
    let params = $('script[data-params]').data('params');
    let loadedFiles = [];
    let myDropzone = new Dropzone("#dropzone", {
        url: `${baseUrl}app/tareas/cargar_anexos.php`,
        dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
        params: {
            key: localStorage.getItem('key')
        },
        paramName: 'task_file',
        init: function() {
            this.on("success", function(file, response) {
                response = jQuery.parseJSON(response)

                if(response.success){
                    response.data.forEach(e => {
                        loadedFiles.push(e);
                    })
                }else{
                    top.notification({
                        type: 'error',
                        message: response.message
                    })
                }
            })
        }
    });
});