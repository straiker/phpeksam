<?php
require_once("config.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
?>

<html>
    <head>
        <title>PHP eksam - Rait Avastu</title>
    </head>
    <body>
        <div id="wrapper">
            <h1>Laos olevad tooted</h1>
            <?php
            include("menu.html");
            $stmt = $mysqli->prepare("SELECT * FROM goods WHERE dateSold IS NULL");

            $stmt->bind_result($id, $name, $description, $weight, $price, $dateAdded, $dateModified, $dateSold);
            $stmt->execute();

            echo "<table border=1><tr><td>ID</td><td>NIMI</td><td>KIRJELDUS</td><td>KAAL</td><td>HIND</td><td>LISAMISE AEG</td><td>MUUDA/KUSTUTA</td></tr>";

            while($stmt->fetch()){
                echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$description</td>
                    <td>$weight</td>
                    <td>$price</td>
                    <td>$dateAdded</td>
                    <td><a href='update.php?id=$id'> UPDATE</a>|<a href='delete.php?id=$id'>KUSTUTA</a>|<a href='sell.php?id=$id'>MÜÜ</a></td>
                    </tr>
                ";
            }

            echo "</table>";

            ?>
        </div>
    </body>
</html>