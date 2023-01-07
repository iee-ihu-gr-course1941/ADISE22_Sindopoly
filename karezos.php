<!DOCTYPE html>
<html>
  <head>
    <title>My PHP Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <h1>My PHP Page</h1>
    <button id="btn-send-request">Send Request</button>
    <div id="response-container"></div>
    
    <script>
      $(document).ready(function () {
        $('#btn-send-request').click(function () {
          $.ajax({
            type: 'POST',
            url: 'login.php',
            data: { username: 'myusername', password: 'mypassword' },
            loginf: function (response) {
              $('#response-container').html(response);
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