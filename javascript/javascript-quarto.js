// var me = { username: null, player_id: null, token: null, role: null };
// var game_status = { status: null, p_turn: null, current_piece: null, result: null, win_direction: null, last_change: null };
// var last_update = new Date().getTime();
// var timer = null;
var x = { username: null, pass: null };

$(function() {
    $('#sub').click(login_to_game);
});

function login_to_game() {
    $.ajax({
        url: "api/v1/index.php",
        method: 'POST',
        dataType: "json",
        contentType: 'application/json',
        data: JSON.stringify({ username: $('#username').val(), pass: $('#pass').val() }),
        success: onsuccess
            // error: login_error 
    });

}


function regist_to_game() {
    $.ajax({
        url: "api/v1/register/",
        method: 'GET',
        dataType: "json",
        contentType: 'application/json',
        data: JSON.stringify({ username: $('#username').val(), pass: $('#pass').val() }),
        // success: success,
        error: login_error
    });

}

function onsuccess(data) {

    //var success = data.errormesg;

    //alert(success);

    alert("good job");
}

function login_error(data) {

    var errorm = data.errormesg;
    alert(errorm);
}

function update_info() {
    $('#player_info').html("<h4>Player info</h4> " +
        "<strong> Username:</strong>" + me.username +
        "<strong> id: </strong>" + me.player_id +
        "<strong> token: </strong>" + me.$_COOKIE['tokenC'] +
        "<strong> Player role: </strong> " + me.role +
        "<br><h4>Game info</h4>" +
        "<strong> Game state: </strong>" + game_status.status +
        "<strong> Player turn: </strong>" + game_status.turn +
        "<strong> Current Piece: </strong>" + game_status.current_piece +
        "<strong> Result: </strong>" + game_status.result);
}

function save_player_info(data) {
    me = data[0];
}