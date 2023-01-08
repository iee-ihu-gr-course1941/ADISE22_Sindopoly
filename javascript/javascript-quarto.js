// var me = { username: null, player_id: null, token: null, role: null };
// var game_status = { status: null, p_turn: null, current_piece: null, result: null, win_direction: null, last_change: null };
// var last_update = new Date().getTime();
// var timer = null;
var x = { username: null, pass: null };

$(function() {
    $('#inbut').click(givedata);
    $('#outbut').click(getdata);
});

function givedata() {
    $.ajax({
        url: "api/v1/index.php/exchange",
        method: 'POST',
        dataType: "json",
        contentType: 'application/json',
        data: JSON.stringify({ p1name: $('#p1name').val(), p2name: $('#p2name').val() }),
        //success: onsuccess
        // error: login_error 
    });

}
function getdata() {
    var p1=$("$p1name").val();
    alert(p1);
    $.ajax({
        url: "api/v1/index.php/exchange",
        method: 'GET',
        dataType: "json",
        contentType: 'application/json',
    }).done(function(data){
        var result=$.parseJSON(data);
        alert(result);
    });

}






