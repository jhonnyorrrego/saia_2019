$(function(){
    $(document).on('click', '#add_tag', function(){
        $('#add_tag,#save_tag,#tag_name').toggle();
        $('#tag_name').focus();
    });

    $(document).on('click', '#save_tag', function(){
        if($('#tag_name').val().length){
            $('#save_tag,#add_tag,#tag_name').toggle();
            $('#tag_name_error').text('');
    
            let tag = {
                nombre: $('#tag_name').val(),
                idetiqueta: '0',
                key: localStorage.getItem('key')
            };
            
            addTag(Tags.createTemplate(tag));
            Tags.save(tag);
        }else{
            $('#tag_name_error').text('Ingrese el nombre');
        }
    });

    $(document).on('click', '.delete_tag', function(){
        let tagId = $(this).parents('li.tag_item').data('tagid');
        let data = {
            tagId: tagId,
            key: localStorage.getItem('key')
        };
        
        deleteTag(tagId);
        Tags.delete(data);
    });

    $(document).on('click', '.edit_tag', function(){
        let li = $(this).parents('li.tag_item');
        li.find('.tag_options').toggle();
        li.find('input:text')
            .removeAttr('readOnly')
            .focus()
            .select();
    });

    $(document).on('click', '.save_tag', function(){
        let li = $(this).parents('li.tag_item');
        let tagname = li.find('.item_tag_name').val();
        
        if(tagname.length){
            li.find('.tag_name_error').text('');
            li.find('.tag_options').toggle();
            li.find('input:text').attr('readOnly', true);
            
            let tag = {
                nombre: tagname,
                idetiqueta: li.data('tagid'),
                key: localStorage.getItem('key')
            };
            
            Tags.save(tag);
        }else{
            li.find('.tag_name_error').text('Ingrese el nombre');
        }
    });

    function addTag(template){
        $('#tag_name').val('');

        if($('li.tag_item').length){
            $('#tag_list').append(template)
        }else{
            $('#tag_list').html(template)
        }
    }

    function deleteTag(tagId){
        $(`li.tag_item[data-tagid=${tagId}]`).remove();

        if(!$('li.tag_item').length)
            $('#tag_list').html(Tags.noDataFound());
    }

    function updateTag(tagId){
        let label = $('#tag_name').val();
        $(`li.tag_item[data-tagid=${tagId}]`)
            .find('.item_tag_name')
            .val(label);
    }
});