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
    var fuckme=data[0].gamename;
    alert(fuckme);
    $(resultdiv).html(fuckme);
}






