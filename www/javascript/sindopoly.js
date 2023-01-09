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
        url: "../api/index.php/",
        type: "POST"
    }
    );

    /*
    var p1=$("#p1name").val();
    var p2=$("#p2name").val();
    alert(p1,p2);

    $.post("api/v1/index.php",
    {
        p1name: p1
    },
    function(res,status){
        var data=JSON.parse(res);

    })
    






    $.ajax({
        url: "api/v1/index.php/exchange",
        method: 'POST',
        dataType: "json",
        contentType: 'application/json',
        data: JSON.stringify({ p1name: p1, p2name: p2 }),
    });
    */
}

function cry(data){
    alert(data[0]);
}
function getdata() {
    

    /*
    $.ajax({
        url: "api/v1/index.php/exchange",
        method: 'GET',
        dataType: "json",
        contentType: 'application/json',
    }).done(function(data){
        var result=$.parseJSON(data);
        alert(result);
    });
    */
}






