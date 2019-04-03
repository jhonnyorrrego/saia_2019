$(function () {
    $("#treegrid").fancytree({
        extensions: ["table"],
        checkbox: true,
        table: {
            indentation: 20,      // indent 20px per node level
            nodeColumnIdx: 2,     // render the node title into the 2nd column
            checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: "prueba.php"
        },
        renderColumns: function (event, data) {
            var node = data.node,
                $tdList = $(node.tr).find(">td");
            // (index #0 is rendered by fancytree by adding the checkbox)
            $tdList.eq(1).text(node.getIndexHier());
            // (index #2 is rendered by fancytree)
            $tdList.eq(3).text(node.key);
            // Rendered by row template:
            //        $tdList.eq(4).html("<input type='checkbox' name='like' value='" + node.key + "'>");
        }
    });
});