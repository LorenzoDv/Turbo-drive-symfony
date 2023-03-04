$(function() {
    $( "#set div" ).draggable({
        stack: "#set div",
        stop: function(event, ui) {
            var pos_x = ui.offset.left;
            var pos_y = ui.offset.top;
            var need = ui.helper.data("need");

            console.log(pos_x);
            console.log(pos_y);
            console.log(need);

            //Do the ajax call to the server
            $.ajax({
                type: "POST",
                url: "your_php_script.php",
                data: { x: pos_x, y: pos_y, need_id: need}
            }).done(function( msg ) {
                alert( "Data Saved: " + msg );
            });
        }
    });
});

$(function(){
    $('#set div').draggable({ scroll: true, cursor: "move"});
});