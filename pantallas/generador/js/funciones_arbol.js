$(".buscar_arboles").hide();
$("#contenido_arbol").css({
    "margin-top": "8px"
});

function evento_click(event, data) {
    var nodeId = data.node.key;
    var title = data.node.title;
    var elemento_evento = $.ui.fancytree.getEventTargetType(
        event.originalEvent
    );
    if (elemento_evento == "title") {
        var currentFrame = window.location.pathname;
        window.location.href = currentFrame + "?idformato=" + nodeId;
    }
}
