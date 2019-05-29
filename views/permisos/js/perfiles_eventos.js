$(function(){
    $(document).on('click', '#add_profile', function(){
        $('#add_profile,#save_profile,#profile_name').toggle();
        $('#profile_name').focus();
    });

    $(document).on('click', '#save_profile', function(){
        if($('#profile_name').val().length){
            $('#save_profile,#add_profile,#profile_name').toggle();
            $('#profile_name_error').text('');
    
            let profile = {
                nombre: $('#profile_name').val(),
                key: localStorage.getItem('key')
            };
            
            Perfil.save(profile);
            
        }else{
            $('#profile_name_error').text('Ingrese el nombre');
        }
    });

    $(document).on('click', '.delete_profile', function(){
        let profileId = $(this).parents('li.profile_item').data('profileid');
        let data = {
            profileId: profileId,
            key: localStorage.getItem('key')
        };

        if (Perfil.del(data)) {
            deleteprofile(data.profileId);
        }
    });

    $(document).on('click', '.edit_profile', function(){
        let li = $(this).parents('li.profile_item');
        li.find('.profile_options').toggle();
        li.find('input:text')
            .removeAttr('readOnly')
            .focus()
            .select();
    });

    $(document).on('click', '.save_profile', function(){
        let li = $(this).parents('li.profile_item');
        let profilename = li.find('.item_profile_name').val();
        
        if(profilename.length){
            li.find('.profile_name_error').text('');
            li.find('.profile_options').toggle();
            li.find('input:text').attr('readOnly', true);
            
            let profile = {
                nombre: profilename,
                idPerfil: li.data('profileid'),
                key: localStorage.getItem('key')
            };
            Perfil.save(profile);
        }else{
            li.find('.profile_name_error').text('Ingrese el nombre');
        }
    });

    function addprofile(profile){
        $('#profile_name').val('');
        let template = `<li class="tag_item list-group-item d-flex justify-content-between align-items-center p-1" data-tagid="${profile.idperfil}">
            <div class="">
                <input type="text" readOnly class="item_tag_name form-control text-dark bg-white" value="${profile.nombre}" style="border:0px">
                <small class="error pl-2" class="tag_name_error"></small>
            </div>
            <span>
                <span class="p-1 cursor delete_tag tag_options">
                    <i class="fa fa-trash"></i>
                </span>
                <span class="p-1 cursor edit_tag tag_options">
                    <i class="fa fa-edit"></i>
                </span>
                <span class="p-1 cursor save_tag tag_options" style="display:none">
                    <i class="fa fa-save"></i>
                </span>
            </span>
        </li>`;
        
        if($('li.profile_item').length){
            $('#profile_list').append(template)
        }else{
            $('#profile_list').html(template)
        }
    }

    function deleteprofile(profileId) {
        $(`li.profile_item[data-profileid=${profileId}]`).remove();      
    }

});