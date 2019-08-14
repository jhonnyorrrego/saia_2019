$(function() {
    let params = $('#script_version_details').data('params');
    $('#script_version_details').removeAttr('data-params');

    (function init() {
        findDetails();
    })();

    function findDetails() {
        $.post(
            `${params.baseUrl}app/documento/detalles_version.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                versionId: params.versionId
            },
            function(response) {
                if (response.success) {
                    console.log(response);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }
});
