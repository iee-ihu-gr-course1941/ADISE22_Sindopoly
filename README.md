ADISE22_Sindopoly
=================
A simplified "hardcore" and much faster version of the Monopoly board game
The API was a solo project of Dimitris Kopsidas.
Although some effort was taken to create a GUI in HTML using JQuery,AJAX and CSS it was too much for a solo project to deliver on time


API URL
=================
https://users.iee.ihu.gr/~it175008/ADISE22_Sindopoly/api/main.php


API Description
=================
Methods:

To create a new game and register it in the database:

```
POST /creategame/
```

To join in an existing game. Requires username and name of the game

```
POST /joingame/
```

To move on the board and buy properties. Payment to the bank or to the other player is dont automatically
```
POST /rolldice/
```

To get all the information of the current game in JSON form.The JSON file is then pruned by different methods and sent to the frontend when needed.Because the project was a solo endeavor creation of a GUI was not possible to deliver on schedule.For this reason most methods dont return JSON data but 'echo' text to be more easily understood in Postman.
```
GET /show/
```
