let iziDefaultOptions = {
    id: null,
    class: '',
    title: '',
    titleColor: '',
    titleSize: '',
    titleLineHeight: '',
    message: '',
    messageColor: '',
    messageSize: '',
    messageLineHeight: '',
    backgroundColor: '',
    theme: 'light', // dark
    color: '', // blue, red, green, yellow
    icon: '',
    iconText: '',
    iconColor: '',
    iconUrl: null,
    image: '',
    imageWidth: 50,
    maxWidth: null,
    zindex: null,
    layout: 1,
    balloon: false,
    close: true,
    closeOnEscape: false,
    closeOnClick: false,
    displayMode: 0, // once, replace
    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
    target: '',
    targetFirst: true,
    timeout: 5000,
    rtl: false,
    animateInside: true,
    drag: true,
    pauseOnHover: true,
    resetOnHover: false,
    progressBar: false,
    progressBarColor: '',
    progressBarEasing: 'linear',
    overlay: false,
    overlayClose: false,
    overlayColor: 'rgba(0, 0, 0, 0.6)',
    transitionIn: 'fadeInUp',
    transitionOut: 'fadeOut',
    transitionInMobile: 'fadeInUp',
    transitionOutMobile: 'fadeOutDown',
    buttons: {},
    inputs: {},
    onOpening: function () { },
    onOpened: function () { },
    onClosing: function () { },
    onClosed: function () { }
};

function showNotification(options) {
    options = $.extend({}, iziDefaultOptions, options);

    if (options.type) {
        options.color = convertTypeToColor(options.type);
    }
    iziToast.show(options);
}

function convertTypeToColor(type) {
    let data = {
        success: 'green',
        error: 'red',
        info: 'blue',
        warning: 'yellow'
    }

    return data[type];
}

window.notification = function (options) {
    if (typeof top.toastr == 'undefined') {
        let baseUrl = top.jQuery("#baseUrl", window.top.document).data('baseurl');
        top.jQuery.get(`${baseUrl}assets/theme/assets/plugins/iziToast/css/iziToast.min.css`, function (r) {
            $('head').append($('<style>').html(r));
            top.jQuery.getScript(`${baseUrl}assets/theme/assets/plugins/iziToast/js/iziToast.min.js`, function () {
                showNotification(options);
            })
        })
    } else {
        showNotification(options);
    }
}