$(function () {
    let baseUrl = Session.getBaseUrl();
    let params = JSON.parse($('script[data-params]').attr('data-params'));
    let loadedFiles = [];
    let myDropzone = new Dropzone("#dropzone", {
        url: `${baseUrl}app/temporal/cargar_anexos.php`,
        maxFilesize: 3,
        maxFiles: 3,
        dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
        dictMaxFilesExceeded: 'Máximo 3 archivos',
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
            task: taskId
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
                        <td class="text-center">${f.version}</td>
                        <td>${f.description}</td>
                        <td>${f.user}</td>
                        <td class="text-center">${f.date}</td>
                        <td class="text-center">${f.size}</td>
                    </tr>
                `);
            })
            $('#file_history').show();
        }
    }
});