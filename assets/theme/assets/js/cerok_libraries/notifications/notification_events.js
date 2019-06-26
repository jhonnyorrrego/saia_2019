$(function() {
    let baseUrl = Session.getBaseUrl();
    let options = {
        baseUrl: baseUrl,
        key: localStorage.getItem('key'),
        token: localStorage.getItem('token'),
        counterSelector: '#notification_counter',
        listSelector: '#notification_list'
    };

    let notification = new Notification(options);

    (function setPanelHeight() {
        let breakpoint = localStorage.getItem('brekpoint');
        let height = $(window).height();

        if (breakpoint != 'xs' && breakpoint != 'sm') {
            height = height * 0.8;
        }
        $('#notification_list').css({
            'max-height': `${height}px`,
            'overflow-y': 'auto'
        });
    })();

    $('#show_notifications').on('click', function() {
        $(this)
            .find('.notification')
            .removeClass('animated');
        notification.showList();
    });

    $(document).on('click', '#more_notifications', function(e) {
        e.stopPropagation();
        notification.more();
    });
});
