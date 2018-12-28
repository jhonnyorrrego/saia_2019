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
        init: function () {
            this.on("success", function (file, response) {
                response = jQuery.parseJSON(response)

                if (response.success) {
                    response.data.forEach(e => {
                        loadedFiles.push(e);
                    });

                    $('#upload').removeAttr('disabled');
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    })
                }
            })
        }
    });

    (function init(){
        findFileHistory(params.id);
    })();

    $('#upload').on('click', function() {
        $.post(`${baseUrl}app/tareas/almacenar_anexos.php`, {
            key: localStorage.getItem('key'),
            routes: loadedFiles,
            description: $('#file_description').val(),
            task: params.id
        }, function (response) {
            if(response.success){
                loadedFiles = [];
                top.notification({
                    type: 'success',
                    message: response.message,
                });

                findFileHistory(params.id);
                $('#upload').attr('disabled', true);
                $('#file_description').val('');
                myDropzone.removeAllFiles();
            }
        }, 'json')
    })

    function findFileHistory(taskId) {
        $.post(`${baseUrl}app/tareas/consulta_anexos.php`, {
            key: localStorage.getItem('key'),
            task: params.id
        }, function (response) {
            if (response.success) {
                fillTable(response.data)
            } else {
                top.notification({
                    type: 'error',
                    message: responsa.message
                })
            }
        }, 'json')
    }

    function fillTable(data) {
        if (data.length) {
            $('#file_history > tbody').find('tr:not(:first)').remove();
            data.forEach(f => {
                $('#file_history > tbody').append(`
                    <tr id="${f.id}">
                        <td>${f.name}</td>
                        <td>${f.version}</td>
                        <td>${f.description}</td>
                        <td>${f.user}</td>
                        <td>${f.date}</td>
                        <td>${f.size}</td>
                    </tr>
                `);
            })
            $('#file_history').show();
        }
    }
});