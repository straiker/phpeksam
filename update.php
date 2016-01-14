<?php
require_once("config.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];

        if (empty($name || empty($weight) || empty($price))) {
            echo "Täida kohustuslikud väljad";
        } else {
            echo "test";
            $stmt = $mysqli->prepare("UPDATE goods set name=?, description=?, weight=?, price=? WHERE id=?");
            $stmt->bind_param("ssidi",$name, $description, $weight, $price, $_GET['id']);
            $stmt->execute();
            $stmt->close();
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

            $stmt->bind_result($id, $name, $description, $weight, $price, $dateAdded, $dateModified, $dateSold);
            $stmt->execute();

            echo "
            <form method='post' action='update.php'>
                <label>Toote nimi: *</label><input type='text' name='name' value='$name'><br>
                <label>Toote kirjeldus: </label><textarea  name='description' value='$description'></textarea><br>
                <label>Toote kaal: *</label><input name='weight' type='text' value='$weight'><br>
                <label>Toote hind: *</label><input name='price' type='text' value='$price'><br>
                <input type='submit' id='update' name='update'>
            </form>
            ";
            ?>
        </div>

    </div>
</body>
</html>

