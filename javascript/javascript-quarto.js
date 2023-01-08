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
        //data: JSON.stringify({ username: $('#username').val(), pass: $('#pass').val() }),
        //success: onsuccess
        // error: login_error 
    });

}
function getdata() {
    $.ajax({
        url: "api/v1/index.php/exchange",
        method: 'GET',
        dataType: "json",
        contentType: 'application/json',
        //data: JSON.stringify({ username: $('#username').val(), pass: $('#pass').val() }),
        //success: onsuccess
        // error: login_error 
    });

}





