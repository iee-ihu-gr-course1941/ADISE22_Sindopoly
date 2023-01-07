<!DOCTYPE html>
<html>
  <head>
    <title>My PHP Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  </head>
  <body>
    <h1>My PHP Page</h1>
    <button id="btn">Send Request</button>
    <div id="rescon">fk</div>
    
    <script>
      $(document).ready(function () {
        $('#btn').click(function () {
          $.ajax({
            type: 'GET',
            url: 'kar.txt',
            dataType:"text",
            success: function(response){
        //if request if made successfully then the response represent the data
        $( "#rescon" ).html( response );
        }
        });
        }}
    </script>
  </body>
</html>
