$(function () {
    var session = new Session();
    var xDown = null;
    var yDown = null;
    
    Ui.putLogo();
    Ui.showUserInfo(session.user);
    
    $("#iframe_workspace").height($(window).height() - $("#header").height() - 9);

    $("#btn_logout").on('click', function (event) {
        event.preventDefault();
        Ui.close();
    });

    $("#profile_form").on('submit', function (event) {
        event.preventDefault();

        var data = new FormData();
        data.append('email', $("[name='email']").val());
        data.append('email_contrasena', $("[name='email_contrasena']").val());
        data.append('direccion', $("[name='direccion']").val());
        data.append('telefono', $("[name='telefono']").val());

        jQuery.each($('#image')[0].files, function (i, file) {
            data.append('image', file);
        });

        $.ajax({
            type: 'POST',
            data: data,
            dataType: 'json',
            url: Session.getBaseUrl() + 'app/funcionario/actualiza_funcionario.php',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $("#edit_profile").modal('toggle');
                } else {
                    toastr.error(response.message, 'Error!');
                }
            }
        });
    });

    $(".tab-content").on('touchstart', function (evt) {
        xDown = getTouches(evt)[0].clientX;
        yDown = getTouches(evt)[0].clientY;
    });

    $(".tab-content").on('touchmove', function (evt) {
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {/*most significant*/
            if (xDiff > 0) {
                /** right swipe*/
            } else {
                $("#close_right_navbar").trigger('click');
            }
        } else {
            if (yDiff > 0) {/** up swipe*/ } else {/** Dowsn swipe*/ }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    });

    function getTouches(evt) {
        return evt.touches || evt.originalEvent.touches;
    }
});