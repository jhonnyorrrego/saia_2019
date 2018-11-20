$(function(){
    let key = localStorage.getItem('key');
    var userInformation = new UserInformation(key);
    var baseUrl = Session.getBaseUrl();
    
    $('#btn_success').on('click', function () {
        $.ajax({
            type: 'POST',
            data: $('#profile_form').serialize(),
            dataType: 'json',
            url: `${baseUrl}app/funcionario/actualiza_funcionario.php`,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#close_modal').trigger('click');
                } else {
                    toastr.error(response.message, 'Error!');
                }
            }
        });
    });

    $("#show_image_modal").on("click", function() {
        $("#edit_photo_modal,#dinamic_modal").modal('toggle');
    });

    setTimeout(() => {
        $("#profile_form").trigger('reset');
    }, 300);
});