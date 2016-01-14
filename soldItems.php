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
    <h1>Müüdud asjad</h1>
    <?php
    include("menu.html");
    $stmt = $mysqli->prepare("SELECT * FROM goods WHERE dateSold IS NOT NULL");

    $stmt->bind_result($id, $name, $description, $weight, $price, $dateAdded, $dateModified, $dateSold);
    $stmt->execute();

    echo "<table border=1><tr><td>ID</td><td>NIMI</td><td>KIRJELDUS</td><td>LISAMISE AEG</td><td>MÜÜMISE AEG</td></tr>";

    while($stmt->fetch()){
        echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$description</td>
                    <td>$dateAdded</td>
                    <td>$dateSold</td>
                    </tr>
                ";
    }

    echo "</table>";

    ?>
</div>
</body>
</html>