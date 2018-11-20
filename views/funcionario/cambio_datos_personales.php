<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="container">
        <div class="row pb-2">
            <div class="col-3 text-center">
                <span class="thumbnail-wrapper circular inline w-100">
                    <img id="image" class="cuted_photo" >
                </span>
                <a style="cursor:pointer" href="#" id="show_image_modal">
                    <small>Cambiar</small>
                </a>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <span id="name"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="email"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="direction"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="phoneNumber"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-12">
                <form role="form" id="profile_form">
                    <div class="row mb-1 pb-2">
                        <label class="col-md-2 control-label text-black" style="line-height: 1;">Email</label>
                        <div class="offset-md-1 col-md-9">
                            <input type="email" class="form-control" placeholder="Correo electrónico" name="email">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-md-2 control-label text-black" style="line-height: 1;">Contraseña del email</label>
                        <div class="offset-md-1 col-md-9">
                            <input type="password" class="form-control" placeholder="****" name="email_contrasena">
                        </div>
                    </div>
                    <div class="row mb-1 pb-2">
                        <label class="col-md-2 control-label text-black" style="line-height: 1;">Dirección</label>
                        <div class="offset-md-1 col-md-9">
                            <input type="text" class="form-control" placeholder="Dirección de Residencia" name="direccion">
                        </div>
                    </div>
                    <div class="row mb-1 pb-2">
                        <label class="col-md-2 control-label text-black" style="line-height: 1;">Teléfono</label>
                        <div class="offset-md-1 col-md-9">
                            <input type="text" class="form-control" placeholder="Teléfono de Contacto" name="telefono">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>   
    <script>    
        if(typeof UserInformation == 'undefined'){
            $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/userInformation.js`, function(){
                $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/information_events.js`);
            });
        }else{
            $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/information_events.js`);
        }
    </script>    
</body>
</html>