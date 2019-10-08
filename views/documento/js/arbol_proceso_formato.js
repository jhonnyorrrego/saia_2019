$(function() {
    let params = $('#tree_document_process').data('params');
    //"url" => "app/arbol/proceso_formato.php",

    (function init() {
        $('#tree_container').fancytree({
            selectMode: 3,
            source: {
                url: `${params.baseUrl}app/arbol/proceso_formato.php?documentId=${params.documentId}`
            },
            click: function(event, data) {
                let target = event.originalEvent.target;
                let nodeData = data.node.data;

                if (!target.classList.contains('fancytree-expander')) {
                    top.successModalEvent(nodeData);
                }
            }
        });
    })();
});
