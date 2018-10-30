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

        $.ajax({
            type: 'POST',
            data: $("#profile_form").serialize(),
            dataType: 'json',
            url: Session.getBaseUrl() + 'app/funcionario/actualiza_funcionario.php',
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

    $('#edit_photo_modal').on('shown.bs.modal', function () {
        Ui.imageAreaSelect();
    });

    $("#file_photo").on('change', function(){
        var data = new FormData();
        jQuery.each($('#file_photo')[0].files, function (i, file) {
            data.append('image', file);
        });

        Pace.track(function () {
            $.ajax({
                type: 'POST',
                data: data,
                dataType: 'json',
                url: Session.getBaseUrl() + 'app/funcionario/guardar_imagen.php',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    Ui.hideImgAreaSelect();
                    return true;
                },
                success: function (response) {
                    if (response.success) {
                        let route = Session.getBaseUrl() + response.data;
                        $("#img_edit_photo").attr("src", route);
                        $("#img_edit_photo").on('load',function(){
                            Ui.imageAreaSelect();
                        });
                    } else {
                        toastr.error('Error en la carga!', 'Error');
                    }
                }
            });
        });
    });

    $('#edit_photo_modal').on('hide.bs.modal', function () {
        Ui.hideImgAreaSelect();
    });

    $("#btn_save_photo").on('click', function(){
        let ias = $("#img_edit_photo").imgAreaSelect({ instance: true });
        let options = ias.getSelection();
        options.imageWidth = $("#img_edit_photo").width();
        options.imageHeight = $("#img_edit_photo").height();

        $.post(Session.getBaseUrl() + 'app/funcionario/guardar_recorte.php', options, function(response){
            if(response.success){
                $("#profile_image").attr('src', Session.getBaseUrl() + response.data);
                $('#edit_photo_modal').modal('hide');
            }
        }, 'json');
    })

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