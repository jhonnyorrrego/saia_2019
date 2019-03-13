$(function() {
    var notes = new Notes(localStorage.getItem("key"));

    $(document).on("click", ".note_item", function() {
        notes.active = $(this).data("noteid");

        let date = notes.getInfoFromActive().fecha;
        let formated = moment(date, "YYYY-MM-DD ").format("DD-MM-YYYY");
        $("#span_note_header").html(formated);
    });

    $("#note_tab").on("click", function() {
        notes.refreshList();
    });

    $(".close-note-link").on("click", function() {
        let content = $("#note_content").html();

        if (content) {
            $("#save_note").attr("disabled", true);
            $("#list_note > li[data-noteid='" + notes.active + "']").remove();
            notes.save(content);
        }
    });

    $("#add_note").click(function() {
        notes.active = 0;
    });

    $("#save_note").on("click", function() {
        $(".close-note-link").trigger("click");
    });

    $("#delete_notes").on("click", function() {
        let list = [];

        $.each($(".checkbox_note:checked"), function(i, element) {
            list.push(element.value);
            $("#list_note > li[data-noteid='" + element.value + "']").remove();
        });

        notes.selected = list;
        notes.delete();
    });
});
