$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    (function init() {
        listProfile();
    })();

    function listProfile() {
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem("key")
            },
            function (response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $("#profile_list").append(`<li class="profile_item list-group-item d-flex justify-content-between align-items-center p-1" data-profileid="${element.idperfil}">
                        <input type="checkbox" class="checkbox_profile">
                        <div class="">
                            <input type="text" readOnly class="item_profile_name form-control text-dark bg-white" value="${element.nombre}" style="border:0px">
                            <small class="error pl-2" class="profile_name_error"></small>
                        </div>
                        <span>
                            <span class="p-1 cursor delete_profile profile_options">
                                <i class="fa fa-trash"></i>
                            </span>
                            <span class="p-1 cursor edit_profile profile_options">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span class="p-1 cursor save_profile profile_options" style="display:none">
                                <i class="fa fa-save"></i>
                            </span>
                        </span>
                    </li>`);
                    });
                }
            },
            "json"
        );
    }
});

function save(profile){
    let baseUrl = Session.getBaseUrl();
    let retorno = 0;
    $.post(`${baseUrl}app/permisos/guardar.php`, profile, (response) => {
        retorno = response.success;
        if (response.success) {
            if(!parseInt(profile.idperfil))
                $('li.profile_item[data-profileid=0]').attr('data-profileid', response.data);
        }else{
            top.notification({
                message: response.message,
                type: 'error',
                title: 'Error!'
            });
        }
    }, 'json');
    return retorno;
}

function del(profile){
    let baseUrl = Session.getBaseUrl();
    let retorno = 0;
    $.post(`${baseUrl}app/permisos/borrar_perfil.php`, profile, (response) => {
        retorno = response.success;
        if(!response.success){
            top.notification({
                message: response.message,
                type: 'error'
            });
        } else {
            top.notification({
                message: response.message,
                type: 'success',
                title: 'Perfil eliminado!'
            });
        }
    }, 'json');
    return retorno;
}