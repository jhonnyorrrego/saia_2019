class Perfil {
    constructor(userId) {
        this.user = userId;
    }

    listProfile() {
        let baseUrl = Session.getBaseUrl();
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem("key")
            },
            function (response) {
                if (response.success) {
                    response.data.forEach(element => {
                        if (element.idperfil == 1) {
                            $("#profile_list").append(`<li class="profile_item list-group-item d-flex justify-content-between align-items-center p-1" data-profileid="${element.idperfil}">
                                <div class="">
                                    <input type="text" readOnly class="item_profile_name form-control text-dark bg-white" value="${element.nombre}" style="border:0px">
                                    <small class="error pl-2" class="profile_name_error"></small>
                                </div>
                            </li>`);
                        } else {
                            $("#profile_list").append(`<li class="profile_item list-group-item d-flex justify-content-between align-items-center p-1" data-profileid="${element.idperfil}">
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
                        }   
                    });
                }
            },
            "json"
        );
    }


    static save(profile){
    let baseUrl = Session.getBaseUrl();
    let retorno = 0;

    $.ajax({
        type:'POST', async: false, url: `${baseUrl}app/permisos/guardar.php`, dataType: "json",
        data: profile,
        success: function (response) {
            if (response.success) {
                retorno = response;
                if (!parseInt(profile.idPerfil)) {
                    $("#profile_list").append(`<li class="profile_item list-group-item d-flex justify-content-between align-items-center p-1" data-profileid="${response.data}">
                            <div class="">
                                <input type="text" readOnly class="item_profile_name form-control text-dark bg-white" value="${profile.nombre}" style="border:0px">
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
                }
            }else{
                top.notification({
                    message: response.message,
                    type: 'error',
                    title: 'Error!'
                });
            }
        }
    });
    return retorno;
}

    static del(profile){
    let baseUrl = Session.getBaseUrl();
    let retorno = 0;

    $.ajax({
        type:'POST', async: false, url: `${baseUrl}app/permisos/borrar_perfil.php`, dataType: "json",
        data: profile,
        success: function (response) {
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
        }
    });
    return retorno;
}
}