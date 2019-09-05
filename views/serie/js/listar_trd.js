$(function () {
    let params = $('#listarTrd_script').data('params');
    let baseUrl = params.baseUrl;
    $('#listarTrd_script').removeAttr('data-params');

    (function init() {
        createTree();
    })();

    function createTree() {
        $('#trd_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 1,
            source: {
                url: `${baseUrl}arboles/arbol_trd.php`,
                data: {
                    expandir: 1,
                    unSelectables: unSelectables
                }
            },
            init: function () {
                if (parentId) {
                    let tree = $('#areas_tree').fancytree('getTree');
                    let node = tree.getNodeByKey(parentId);
                    node.setSelected(true);
                    $("[name='cod_padre'").val(parentId);
                }
            },
            click: function (event, data) {
                $("[name='cod_padre'").val(data.node.key);
            }
        });
    }
});