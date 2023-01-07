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
            type: 'POST',
            url: 'login.php',
            
            success: function (response) {
              $('#rescon').html(response);
            },
            error: function (error) {
              console.error('Error:', error);
            }
        });
        });
      });
    </script>
  </body>
</html>
