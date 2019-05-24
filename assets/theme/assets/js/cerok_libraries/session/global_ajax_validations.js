$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    $(document).ajaxSend(() => {
        if (!localStorage.getItem('key') || !localStorage.getItem('token')) {
            top.window.location = `${baseUrl}views/login/login.php`;
        }
    });

    $(document).ajaxComplete((e, xhr) => {
        if (xhr.responseJSON && xhr.responseJSON.notifications) {
            window.socket.send(
                JSON.stringify({
                    action: 'notifications',
                    data: xhr.responseJSON.notifications
                })
            );
        }
    });

    $(document).ajaxError((e, xhr) => {
        if (xhr.status == 200 && xhr.responseText.indexOf('logout') != -1) {
            let node = $(xhr.responseText);
            eval(node.html());
        }
    });
});
