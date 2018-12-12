$(function(){
    $(document).on('click', '#send_comment', function(){
        let user = JSON.parse(localStorage.getItem('user'));
        let date = new Date();
        let meridiem = date.getHours() - 12 > 0 ? 'pm' : 'am';

        let comment = {
            comment: $('#comment').val(),
            documentId: $('[data-documentid]').data('documentid'),
            temporality: `${date.getHours() - 12 }:${date.getMinutes()} ${meridiem}`,
            user : {
                key: localStorage.getItem('key'),
                image: user.cutedPhoto
            }
        };

        showComment(comment)
        Comments.save(comment);
    });

    function showComment(comment){
        let content = Comments.createTemplate(comment);

        if($('#comment_list').find('img').length)
            $('#comment_list').append(content);
        else
            $('#comment_list').html(content);
        
        $('#comment').val('');
    }
})