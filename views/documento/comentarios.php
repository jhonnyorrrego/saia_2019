<div class="container">
    <div class="row mx-0">
        <div class="col-12 px-0" id="comment_list"></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <textarea class="form-control" id="comment" rows="3" placeholder="Comentario..."></textarea>
            </div>
        </div>
        <div class="col-auto px-0 ">
            <button class="btn btn-sm btn-complete" id="send_comment">Enviar</button>
        </div>
    </div>
</div>
<script data-documentid="<?= $_REQUEST['documentId'] ?>">
    $(function(){
        if(typeof Comments == 'undefined'){
            let baseUrl = Session.getBaseUrl();
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/comments/comments.js`, function(){
                $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/comments/comment_events.js`, function(){
                    start();
                }); 
            });
        }else{
            start();
        }

        function start(){
            let userId = localStorage.getItem('key');
            let documentId = "<?= $_REQUEST['documentId'] ?>";
            var comments = new Comments(userId, documentId);
            
            $("#comment_list").html(comments.createList());
        }
    });
</script>