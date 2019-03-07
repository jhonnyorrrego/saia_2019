$(function() {
    let params = $("script[data-pages-params]").data("pagesParams");
    let key = localStorage.getItem("key");
    let annotations = [];

    (function getPages() {
        $.post(
            `${params.baseUrl}app/pagina/documento.php`,
            {
                key: key,
                documentId: params.id
            },
            function(response) {
                if (response.success) {
                    createThumbnails(response.data);
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    })();

    $("button.thumbnails").on("click", function() {
        $("#thumbnails").toggle();
    });

    $("#add_comment").on("click", function() {
        $("#content-wrapper img").css("cursor", "crosshair");
    });

    $(document).off("click", ".page_thumbnail");
    $(document).on("click", ".page_thumbnail", function() {
        $("#content-wrapper")
            .html($(this).html())
            .attr("data-page", $(this).data("page"));
        $("#content-wrapper img").removeClass("w-100");
        $("#item_parent,#comment-wrapper").height(
            $("#content-wrapper img").height()
        );

        findNotes();
        annotations.forEach(a => {
            if (a.class == "annotation") {
                $("#content-wrapper").append(
                    $("<div>")
                        .css({
                            top: a.y,
                            left: a.x,
                            position: "absolute"
                        })
                        .html(annotationTemplate(a))
                );
            }
        });
    });

    $(document).off("click", "#content-wrapper img");
    $(document).on("click", "#content-wrapper img", function(e) {
        $("#comment-wrapper").addClass("d-none");
        $("#comment_input")
            .parent()
            .remove();

        let cursor = $(this).css("cursor");

        if (cursor == "crosshair") {
            var x = e.pageX - $(this).offset().left;
            var y = e.pageY - $(this).offset().top;

            $(this)
                .parent()
                .append(
                    $("<div>")
                        .append(
                            $("<input>", {
                                id: "comment_input"
                            })
                        )
                        .css({
                            top: y,
                            left: x,
                            position: "absolute"
                        })
                );
            $("#comment_input").focus();
        }
    });

    $(document).off("keyup", "#comment_input");
    $(document).on("keyup", "#comment_input", function(e) {
        if (e.keyCode == 13 && $("#comment_input").val().length) {
            let commentContent = $(this).val();
            let position = {
                y: $(this)
                    .parent()
                    .css("top")
                    .replace("px", ""),
                x: $(this)
                    .parent()
                    .css("left")
                    .replace("px", "")
            };

            createAnnotation(position, commentContent);
        }
    });

    $(document).off("click", ".annotation");
    $(document).on("click", ".annotation", function(e) {
        $("#comment-wrapper").removeClass("d-none");
        $("#comment_input")
            .parent()
            .remove();

        let annotationId = $(this).data("key");
        showComments(annotationId);
    });

    function showComments(annotationId) {
        let options = commentOptions(annotationId);
        new Comments(options);
    }

    function createThumbnails(data) {
        data.forEach(element => {
            $("#item_parent").append(
                $("<div>", {
                    class: "py-2 page_thumbnail"
                })
                    .append(
                        $("<img>", {
                            src: params.baseUrl + element.route,
                            class: "w-100"
                        })
                    )
                    .attr("data-page", element.id)
            );
        });

        $(".page_thumbnail:first").trigger("click");
    }

    function findNotes() {
        let output = false;

        $.ajax({
            url: `${params.baseUrl}app/visor/consulta_notas.php`,
            type: "POST",
            dataType: "json",
            async: false,
            data: {
                key: key,
                type: "NOTA_PAGINA",
                typeId: $("#content-wrapper").attr("data-page")
            },
            success: function(response) {
                if (response.success) {
                    annotations = response.data;
                    output = true;
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            }
        });

        return output;
    }

    function createAnnotation(position, commentContent) {
        let relationId = $("#content-wrapper").attr("data-page");
        let annotation = {
            type: "point",
            x: position.x,
            y: position.y,
            class: "annotation",
            page: 1,
            uuid: generateAnnotationId(relationId)
        };

        if (saveComment(commentContent, annotation)) {
            $("#comment_input")
                .parent()
                .html(annotationTemplate(annotation));
        }
    }

    function annotationTemplate(annotation) {
        return `<span class='fa fa-file text-white f-20 annotation' data-key='${
            annotation.uuid
        }'></span>`;
    }

    function generateAnnotationId(relationId) {
        let date = new Date();
        return `${params.id}-${relationId}-${date.getTime()}`;
    }

    function generateCommentId(annotationId) {
        let date = new Date();
        return `${annotationId}-${date.getTime()}`;
    }

    function commentOptions(annotationId) {
        return {
            selector: ".comment-list-container",
            baseUrl: params.baseUrl,
            showForm: true,
            order: "asc",
            placeholder: "Comentario.",
            userData: {
                id: localStorage.getItem("key")
            },
            source: function() {
                findNotes();
                let comments = annotations.filter(
                    a => a.class == "Comment" && a.annotation == annotationId
                );
                return comments.map(c => {
                    c.temporality = c.date;
                    c.comment = c.content;

                    return c;
                });
            },
            save: function(comment) {
                let annotation = annotations.find(
                    a => a.uuid == annotationId && a.class == "annotation"
                );
                return saveComment(comment.comment, annotation);
            }
        };
    }

    function saveComment(content, annotation) {
        let output = false;

        $.ajax({
            url: `${params.baseUrl}app/visor/guardar_nota.php`,
            type: "POST",
            dataType: "json",
            async: false,
            data: {
                key: key,
                type: "NOTA_PAGINA",
                typeId: $("#content-wrapper").attr("data-page"),
                annotation: annotation,
                comment: {
                    class: "Comment",
                    annotation: annotation.uuid,
                    uuid: generateCommentId(annotation.uuid),
                    content: content
                }
            },
            success: function(response) {
                if (!response.success) {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                } else {
                    output = true;
                }
            }
        });

        return output;
    }
});
