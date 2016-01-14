<?php
require_once("config.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];

        if (empty($name || empty($weight) || empty($price))) {
            echo "Täida kohustuslikud väljad";
        } else {

            $stmt = $mysqli->prepare("UPDATE goods set name=?, description=?, weight=?, price=? WHERE id=?");
            $stmt->bind_param("ssidi",$name, $description, $weight, $price, $id);
            $stmt->execute();
            echo $stmt->error;
            $stmt->close();

            echo "test";
        }
    }
}
?>

<html>
<head>
    <title>PHP eksam - Rait Avastu</title>
</head>
<body>
    <div id="wrapper">
        <?php include("menu.html"); ?>
        <div id="form">
            <?php

            $stmt = $mysqli->prepare("SELECT * FROM goods WHERE id=?");
            $stmt->bind_param("i", $_GET['id']);

            $stmt->bind_result($did, $dname, $ddescription, $dweight, $dprice, $ddateAdded, $ddateModified, $ddateSold);
            $stmt->execute();

            echo "
            <form method='post' action='update.php'>
                <label>Toote nimi: *</label><input type='text' name='name' value='$dname'><br>
                <label>Toote kirjeldus: </label><textarea  name='description' placeholder='$ddescription'></textarea><br>
                <label>Toote kaal: *</label><input name='weight' type='text' value='$dweight'><br>
                <label>Toote hind: *</label><input name='price' type='text' value='$dprice'><br>
                <input type='hidden' name='id' value='$did'>
                <input type='submit' id='update' name='update' value='Update'>
            </form>
            ";

            $stmt->close();
            ?>
        </div>

    </div>
</body>
</html>

