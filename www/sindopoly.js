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






