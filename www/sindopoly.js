$(function() {
    //givedata();
    $('#inbut').click(dome);

    //$('#outbut').click(getdata);
});

function dome() {
    $.ajax({
        url: "../api/main.php/creategame",
        //success: cry
        method: "POST",
        dataType: "json",
        contentType: 'application/json',
        data: JSON.stringify( {"gamename":"solid","p1name":"snake","p2name":"badass"}),
        success: letsgo
    }
    );
}


function letsgo(){
    alert("NICE JOB");
}
function cry(data){
    var gamename=data[0].gamename;
    var p1name=data[0].p1name;
    var p2name=data[0].p2name;

    $(resultdiv).html("GAME IS: "+gamename+" P1 NAME IS: "+p1name+" P2 NAME IS: "+p2name);
}






