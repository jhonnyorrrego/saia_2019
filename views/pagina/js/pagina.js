$(function() {
    let params = $("script[data-pages-params]").data("pagesParams");
    let key = localStorage.getItem("key");

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

    $("#add_comment").on("click", function() {
        $("#content-wrapper img").css("cursor", "crosshair");
    });

    $(document).off("click", ".page_thumbnail");
    $(document).on("click", ".page_thumbnail", function() {
        $("#content-wrapper")
            .html($(this).html())
            .attr("data-page", $(this).data("page"));
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
        if (e.keyCode == 13) {
            let annotation = {
                y: $(this)
                    .parent()
                    .css("top")
                    .replace('px', ''),
                x: $(this)
                    .parent()
                    .css("left")
                    .replace('px', ''),
                content: $(this).val()
            };
            createAnnotation(annotation);
        }
    });

    $(document).off("click", ".annotation");
    $(document).on("click", ".annotation", function(e) {
        $("#comment-wrapper").removeClass("d-none");
        $("#comment_input")
            .parent()
            .remove();

        alert("consultar nota " + $(this).data("key"));
    });

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

    function createAnnotation(annotation) {
        let relationId = $("#content-wrapper").data("page");
        annotation.uuid = generateAnnotationId(relationId);
        commentId = generateCommentId(annotation.uuid);

        $.post(
            `${params.baseUrl}app/visor/guardar_nota.php`,
            {
                key: key,
                type: "NOTA_PAGINA",
                typeId: relationId,
                annotation: {
                    type: "point",
                    x: annotation.x,
                    y: annotation.y,
                    class: "annotation",
                    page: relationId,
                    uuid: annotation.uuid
                },
                comment: {
                    class: "Comment",
                    annotation: annotation.uuid,
                    uuid: commentId,
                    content: annotation.content
                }
            },
            function(response) {
                if (response.success) {
                    $("#comment_input")
                        .parent()
                        .html(annotationTemplate(annotation));
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    }

    function annotationTemplate(annotation) {
        annotation.id = 1;
        return `<span class='fa fa-file text-white f-20 annotation' data-key='${
            annotation.id
        }'></span>`;
    }

    function generateAnnotationId(relationId){
        let date = new Date();
        return `${params.id}-${relationId}-${date.getTime()}`;
    }

    function generateCommentId(annotationId){
        let date = new Date();
        return `${annotationId}-${date.getTime()}`;
    }
});
