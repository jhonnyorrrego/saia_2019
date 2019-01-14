<div class="container" id="task_comments"></div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}views/tareas/js/comentarios.js`);
    })
</script>