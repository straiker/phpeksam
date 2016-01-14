<?php
require_once("config.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);



if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];

        if (empty($name || empty($weight) || empty($price))) {
            echo "Täida kohustuslikud väljad";
        } else {
            echo "test";
            $stmt = $mysqli->prepare("INSERT INTO goods (name, description, weight, price) VALUES (?,?,?,?)");
            $stmt->bind_param("ssid",$name, $description, $weight, $price);
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
        <div id="menu">
            <ul>
                <li><a href="index.php"> Back to home!</a></li>
            </ul>
        </div>
        <div id="form">
            <form method="post" action="add.php">
                <label>Toote nimi: *</label><input type="text" name="name"><br>
                <label>Toote kirjeldus: </label><textarea  name="description"></textarea><br>
                <label>Toote kaal: *</label><input name="weight" type="text"><br>
                <label>Toote hind: *</label><input name="price" type="text"><br>
                <input type="submit" id="add" name="add">
        </div>

    </div>
</form>
</body>
</html>

