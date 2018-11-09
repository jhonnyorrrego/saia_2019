var topModalDefaults = {
    url : '',
    size: '',
    title: '',
    buttons :[]
}

function topModal(options){
    var modal = $("#dinamic_modal", window.top.document);
    var options = $.extend({}, topModalDefaults, options);

    if(options.url){
        modal.find("#modal_body").load(options.url, function(response, xhr, status){
            modal.find("#modal_body").prepend('<hr>');
            modal.find("#modal_title").text(options.title);
            modal.modal({
                backdrop : false
            });
        });
    }else{
        console.log('undefined url');
    }
}