class UserInformation{
    constructor (iduser){
        this.user = iduser;
        this.baseUrl = Session.getBaseUrl();
        this.find();
    }

    set user(iduser){
        this._iduser = iduser;
    }

    get user(){
        return this._iduser;
    }

    set baseUrl(route) {
        this._baseUrl = route;
    }

    get baseUrl() {
        return this._baseUrl;
    }

    find(){
        let baseUrl = this.baseUrl;
        $.post(`${baseUrl}app/funcionario/consulta_funcionario.php`,{
            key: this.user,
            type: 'userInformation',
            token: localStorage.getItem('token')
        }, function(response){
            if(response.success){
                for(let attribute in response.data){
                   $(`#${attribute}`).text(response.data[attribute]);
                }

                $("#image").attr("src", baseUrl + response.data.cutedPhoto);
                $("#img_edit_photo").attr("src", baseUrl + response.data.originalPhoto);
            }
        }, 'json');
    }
}