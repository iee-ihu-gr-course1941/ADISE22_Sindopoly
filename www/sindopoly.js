$(function() {
    givedata();
    $('#inbut').click(givedata);

    //$('#outbut').click(getdata);
});

function givedata() {
    $.ajax({
        url: "../api/main.php/show",
        success: cry
    }
    );
}

function cry(data){
    var gamename=data[0].gamename;
    var p1name=data[0].p1name;
    var p2name=data[0].p2name;

    $(resultdiv).html("GAME IS: "+gamename+" P1 NAME IS: "+p1name+" P2 NAME IS: "+p2name);
}






