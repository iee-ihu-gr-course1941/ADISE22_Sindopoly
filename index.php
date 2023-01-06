<html> 
    <body>
        <form action="queries.php" method="get">
            ACTION: 
            <select name="action">
                    <option value="INSERT">INSERT</option>
                    <option value="UPDATE">UPDATE</option>
                    <option value="DELETE">DELETE</option>
                    <option value="SELECT">SELECT</option>
            </select>
            <br>
            NAME: 
            <input name="name">
            <br>ID:
            <input name="id">
            <br>PASSWORD:
            <input name="pass">
            <br>
            <input type="submit">
        </form>
        
        
        

        <?php
        //include_once 'dbconnection.php';
        print "<ul>
        <li><a href=\"Ajax.html\">Goto Ajax</a>.</li>
        <li><a href=\"dbconnection.php\">Goto DBConnection</a>.</li>
        <li><a href=\"Login.html\">Goto Login</a>.</li>
        </ul>";
        echo "<br>HELP ME";
        ?>


    </body>
</html>