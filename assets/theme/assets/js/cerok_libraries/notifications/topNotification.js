var defaultOptions = {
    message: '', // message to show
    type: 'success', //info, success, warning , error
    duration: 5000, //time for show the notification
    title: '', //notification title
    closeButton: true,
};

function showNotification(options){
    options = $.extend({}, defaultOptions, options);

    top.toastr.options = {
        "closeButton": options.closeButton,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": options.duration,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    
    top.toastr[options.type](options.message, options.title);
}

window.notification = function(options){
    if(typeof top.toastr == 'undefined'){
        let baseUrl = top.jQuery("#baseUrl", window.top.document).data('baseurl');
        top.jQuery.get(`${baseUrl}assets/theme/assets/plugins/toastr/toastr.min.css`, function(r){
            $('head').append($('<style>').html(r));
            top.jQuery.getScript(`${baseUrl}assets/theme/assets/plugins/toastr/toastr.min.js`, function(){
                showNotification(options);
            })
        })
    }else{
        showNotification(options);
    }
}

window.closeNotifications = function(){
    top.toastr.clear();
}