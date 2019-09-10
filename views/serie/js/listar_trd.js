$(function () {
    //POR EL MOMENTO NO SE USA ESTE SCRIPT=> BORRAR
    let params = $('#listarTrd_script').data('params');
    let baseUrl = params.baseUrl;
    $('#listarTrd_script').removeAttr('data-params');

    (function init() {
        createTree();
    })();

    function createTree() {
        $('#trd_tree').fancytree({
            icon: false,
            source: {
                url: `${baseUrl}app/arbol/arbol_trd.php`
            }
        });
    }
});