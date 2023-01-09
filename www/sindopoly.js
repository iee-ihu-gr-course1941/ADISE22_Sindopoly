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
    var de=data[0];
    alert(de);
    $(resultdiv).html(de);
}






