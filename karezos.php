<!DOCTYPE html>
<html>
  <head>
    <title>My PHP Page</title>
    
  </head>
  <body>
    <h1>My PHP Page</h1>
    <button id="btn-send-request">Send Request</button>
    <div id="response-container"></div>
    <!--
    <script>
      $(document).ready(function () {
        $('#btn-send-request').click(function () {
          $.ajax({
            type: 'POST',
            url: '/login.php',
            data: { action: 'cry'},
            success: function (response) {
              $('#response-container').html(response);
            },
            error: function (error) {
              console.error('Error:', error);
            }
          });
        });
      });
    </script>-->
  </body>
</html>