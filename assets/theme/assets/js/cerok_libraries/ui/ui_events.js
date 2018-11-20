$(function () {
    var session = new Session();
    var baseUrl = Session.getBaseUrl();
    var xDown = null;
    var yDown = null;
    
    Ui.putLogo();
    Ui.showUserInfo(session.user);
    Ui.resizeIframe();
    
    $('#btn_logout').on('click', function (event) {
        event.preventDefault();
        Ui.close();
    });

    $('#profile_image').mouseover(function() {
        $('#user_info').trigger('click');
    });

    $('#menu_user_info').mouseleave(function() {
        $('#user_info').trigger('click');
    });

    $('#config_profile').on('click', function(){
        let modal_options = {
            url: `${baseUrl}views/funcionario/cambio_datos_personales.php`,
            params: {
                baseUrl: baseUrl
            },
            size: 'modal-lg',
            title: 'Datos Personales',
        }
        topModal(modal_options);
    });
    
    $('#edit_photo_modal').on('shown.bs.modal', function () {console.log(123);
        Ui.imageAreaSelect();
    });

    $('#file_photo').on('change', function(){
        var data = new FormData();
        $.each($('#file_photo')[0].files, function (i, file) {
            data.append('image', file);
        });

        $.ajax({
            type: 'POST',
            data: data,
            dataType: 'json',
            url: `${baseUrl}app/funcionario/guardar_imagen.php`,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('#img_edit_photo')
                    .hide()
                    .parent()
                    .addClass('progress-circle-indeterminate');
                Ui.hideImgAreaSelect();
                return true;
            },
            success: function (response) {
                if (response.success) {
                    let route = baseUrl + response.data;
                    $('#img_edit_photo').attr('src', route);
                    $('#img_edit_photo').on('load',function(){
                        $('#img_edit_photo')
                            .show()
                            .parent()
                            .removeClass('progress-circle-indeterminate');
                        Ui.imageAreaSelect();
                    });
                } else {
                    toastr.error('Error en la carga!', 'Error');
                }
            }
        });
    });

    $('#edit_photo_modal').on('hide.bs.modal', function () {
        Ui.hideImgAreaSelect();
    });

    $('#btn_save_photo').on('click', function(){
        let ias = $('#img_edit_photo').imgAreaSelect({ instance: true });
        let options = ias.getSelection();
        options.imageWidth = $('#img_edit_photo').width();
        options.imageHeight = $('#img_edit_photo').height();

        $.post(`${baseUrl}app/funcionario/guardar_recorte.php`, options, function(response){
            if(response.success){
                $(".cuted_photo").attr("src", baseUrl + response.data.foto_recorte);
                $('#img_edit_photo').attr('src', baseUrl + response.data.foto_original);
                $("#edit_photo_modal,#dinamic_modal").modal('toggle');
            }
        }, 'json');
    });

    $('.tab-content').on('touchstart', function (evt) {
        xDown = getTouches(evt)[0].clientX;
        yDown = getTouches(evt)[0].clientY;
    });

    $('.tab-content').on('touchmove', function (evt) {
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
                $('#close_right_navbar').trigger('click');
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

    window.addEventListener('orientationchange', function () {
        setTimeout(() => {
            Ui.resizeIframe();
        }, 500);
    }, false);
});
