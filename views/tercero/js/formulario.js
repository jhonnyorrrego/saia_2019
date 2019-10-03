$(function() {
    let params = $('#external_script').data('params');
    $('#external_script').removeAttr('data-params');

    $('#btn_success').on('click', function() {
        alert('guardando');
        top.successModalEvent({
            id: 1,
            text: 'nombre del nuevo tercero'
        });
    });
});
